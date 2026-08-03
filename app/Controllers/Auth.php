<?php

namespace App\Controllers;

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
    // Validation Rules
    $rules = [
        'Email'    => 'required|valid_email|max_length[100]',
        'Password' => 'required|min_length[6]|max_length[255]'
    ];

    // Validate Request
    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    // Get Form Data
    $email = trim($this->request->getPost('Email'));
    $password = $this->request->getPost('Password');

    // Load User Model
    $model = new UserModel();

    // Find User by Email
    $user = $model->findByEmail($email);

    // User Not Found
    if (!$user) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid email or password.');
    }

    // Check Account Status
    if ($user['Status'] !== 'Active') {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Your account is inactive. Please contact the administrator.');
    }

    // Verify Password
    if (!password_verify($password, $user['Password'])) {

        // Increase Failed Login Attempts
        $model->incrementFailedAttempts($user['UserID']);

        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid email or password.');
    }

    // Reset Failed Attempts
    $model->resetFailedAttempts($user['UserID']);

    // Update Last Login Time
    $model->updateLastLogin($user['UserID']);

    // Regenerate Session ID (Security)
    session()->regenerate();

    // Create User Session
    session()->set([
        'UserID'      => $user['UserID'],
        'FullName'    => $user['FullName'],
        'Email'       => $user['Email'],
        'Role'        => $user['Role'],
        'isLoggedIn'  => true
    ]);

    // Redirect to Dashboard
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