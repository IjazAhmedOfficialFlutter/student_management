<?php

namespace App\Controllers;
use App\Services\ApiService;
use App\Models\UserModel;
use App\Models\StudentModel;
class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }


public function authenticate()
{
    // Validate request
    $rules = [
        'Email'    => 'required|valid_email|max_length[100]',
        'Password' => 'required|min_length[6]|max_length[255]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    // Get form data
    $email = trim($this->request->getPost('Email'));
    $password = $this->request->getPost('Password');

    try {
 $apiService = new ApiService();

      
        $response = $apiService->post(
            'api/auth/login',
            [
                'email' => $email,
                'password' => $password
            ]
        );

    } 
    catch (\Throwable $e) {

        return redirect()->back()
            ->withInput()
            ->with(
                'error',
                'Authentication service is unavailable.'
            );
    }

    // API response
    $statusCode = $response['statusCode'];
    $data = $response['data'];

    // Login failed
    if ($statusCode !== 200) {

        return redirect()->back()
            ->withInput()
            ->with(
                'error',
                $data['message'] ?? 'Invalid email or password.'
            );
    }

    // Login successful
    $user = $data['user'];
    $token = $data['token'];

    // Regenerate session ID
    session()->regenerate();

    // Store authenticated user
    session()->set([
        'isLoggedIn' => true,
        'UserID'     => $user['userID'],
        'FullName'   => $user['fullName'],
        'Email'      => $user['email'],
        'Role'       => $user['role'],
        'Status'     => $user['status'],
        'user'       => $user,
        'token'      => $token
    ]);

    // Redirect
    return redirect()->to('/dashboard');
}



    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }


    public function resetPassword($id)
{
    $model = new UserModel();

    $user = $model->find($id);

    if (!$user) {
        return redirect()->to('/users')
            ->with('error', 'User not found.');
    }

    $data = [
        'title' => 'Reset Password',
        'user'  => $user
    ];
return view('auth/reset_password', $data);
}



public function updatePassword($id)
{
    $rules = [
        'Password' => 'required|min_length[6]|max_length[255]',
        'ConfirmPassword' => 'required|matches[Password]'
    ];

    if (!$this->validate($rules)) {

        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    $model = new UserModel();

    $user = $model->find($id);

    if (!$user) {

        return redirect()->to('/dashboard')
            ->with('error', 'User not found.');
    }

    $model->update($id, [

        'Password' => password_hash(
            $this->request->getPost('Password'),
            PASSWORD_DEFAULT
        )

    ]);

    return redirect()->to('/dashboard')
        ->with('success', 'Password reset successfully.');
}

}