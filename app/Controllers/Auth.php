<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $email = $this->request->getPost('Email');
        $password = $this->request->getPost('Password');

        $model = new UserModel();

        $user = $model->where('Email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email does not exist.');
        }

        if (!password_verify($password, $user['Password'])) {
            return redirect()->back()->with('error', 'Invalid Password.');
        }

        session()->set([
            'UserID'   => $user['UserID'],
            'FullName' => $user['FullName'],
            'Email'    => $user['Email'],
            'Role'     => $user['Role'],
            'isLoggedIn' => true
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}