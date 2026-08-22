<?php

namespace App\Controllers;

use App\Services\ApiService;

class PasswordResetController extends BaseController
{
    private ApiService $apiService;

    public function __construct()
    {
        $this->apiService = new ApiService();
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function sendResetLink()
    {
        $email = trim(
            $this->request->getPost('email')
        );

        if (empty($email)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Email address is required.'
                );
        }

        try {

            $response = $this->apiService->post(
                'api/password-reset/forgot',
                [
                    'email' => $email
                ]
            );

            if ($response['statusCode'] >= 200 &&
                $response['statusCode'] < 300) {

                return redirect()
                    ->back()
                    ->with(
                        'success',
                        'If this email exists, a password reset link has been sent.'
                    );
            }

            $message =
                $response['data']['message']
                ?? 'Unable to process password reset request.';

            return redirect()
                ->back()
                ->with(
                    'error',
                    $message
                );

        } catch (\Throwable $e) {

            log_message(
                'error',
                'Password reset error: ' . $e->getMessage()
            );

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Unable to connect to password reset service.'
                );
        }
    }

    public function resetPassword()
    {
        $token = $this->request->getGet('token');

        if (empty($token)) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Invalid password reset link.'
                );
        }

        return view(
            'auth/reset_password',
            [
                'token' => $token
            ]
        );
    }

    public function updatePassword()
    {
        $token =
            $this->request->getPost('token');

        $newPassword =
            $this->request->getPost('newPassword');

        $confirmPassword =
            $this->request->getPost('confirmPassword');

        if (empty($token)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Reset token is missing.'
                );
        }

        if (empty($newPassword)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'New password is required.'
                );
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Passwords do not match.'
                );
        }

        try {

            $response = $this->apiService->post(
                'api/password-reset/reset',
                [
                    'token' => $token,
                    'newPassword' => $newPassword
                ]
            );

            if ($response['statusCode'] >= 200 &&
                $response['statusCode'] < 300) {

                return redirect()
                    ->to('/login')
                    ->with(
                        'success',
                        'Password reset successfully. You can now login.'
                    );
            }

            $message =
                $response['data']['message']
                ?? 'Unable to reset password.';

            return redirect()
                ->back()
                ->with(
                    'error',
                    $message
                );

        } catch (\Throwable $e) {

            log_message(
                'error',
                'Password update error: ' . $e->getMessage()
            );

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Unable to connect to password reset service.'
                );
        }
    }
}