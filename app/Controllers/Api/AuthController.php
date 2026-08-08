<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use App\Helpers\JwtHelper;
class AuthController extends BaseApiController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
public function login()
{
    $rules = [
        'Email' => 'required|valid_email',
        'Password' => 'required',
    ];

    if (!$this->validate($rules)) {
        return $this->validationError($this->validator->getErrors());
    }

    $email = $this->request->getPost('Email');
    $password = $this->request->getPost('Password');

    $user = $this->userModel->findByEmail($email);

    if (!$user) {
        return $this->errorResponse(
            'Invalid email or password.',
            401
        );
    }

    if ($user['Status'] !== 'Active') {
        return $this->errorResponse(
            'Your account is inactive.',
            403
        );
    }

    if (!password_verify($password, $user['Password'])) {
        return $this->errorResponse(
            'Invalid email or password.',
            401
        );
    }
    $token = JwtHelper::generateToken([
    'UserID' => $user['UserID'],
    'Email'  => $user['Email'],
    'Role'   => $user['Role'],
]);

    $this->userModel->resetFailedAttempts($user['UserID']);
    $this->userModel->updateLastLogin($user['UserID']);

  return $this->successResponse(
    [
        'user' => [
            'UserID'   => $user['UserID'],
            'FullName' => $user['FullName'],
            'Email'    => $user['Email'],
            'Role'     => $user['Role'],
        ],
        'token' => $token,
    ],
    'Login successful.'
);
}


}