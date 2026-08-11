<?php

namespace App\Controllers\Api;

use App\Services\ApiService;

class AuthController extends BaseApiController
{
    protected ApiService $apiService;

    public function __construct()
    {
        $this->apiService = new ApiService();
    }


public function login()
{
    $rules = [
        'Email' => 'required|valid_email',
        'Password' => 'required',
    ];

    if (!$this->validate($rules)) {
        return $this->validationError(
            $this->validator->getErrors()
        );
    }

    $email = $this->request->getPost('Email');
    $password = $this->request->getPost('Password');

    try {
        // Send login request to ASP.NET API
        $response = $this->apiService->post(
            'api/auth/login',
            [
                'email' => $email,
                'password' => $password,
            ]
        );

        // TEMPORARY DEBUG OUTPUT
        echo '<h2>ASP.NET API RESPONSE</h2>';

        echo '<pre>';
        var_dump($response);
        echo '</pre>';

        exit;

    } catch (\Throwable $e) {
        return $this->errorResponse(
            'Authentication service is unavailable.',
            503
        );
    }
}



    // public function login()
    // {
    //     // Validate request
    //     $rules = [
    //         'Email' => 'required|valid_email',
    //         'Password' => 'required',
    //     ];

    //     if (!$this->validate($rules)) {
    //         return $this->validationError(
    //             $this->validator->getErrors()
    //         );
    //     }

    //     $email = $this->request->getPost('Email');
    //     $password = $this->request->getPost('Password');

    //     try {
    //         // Send login request to ASP.NET API
    //         $response = $this->apiService->post(
    //             'api/auth/login',
    //             [
    //                 'email' => $email,
    //                 'password' => $password,
    //             ]
    //         );
           

    //         // TEMPORARY DEBUG OUTPUT 
    //         echo '<h2>ASP.NET API RESPONSE</h2>'; echo '<pre>'; var_dump($response); echo '</pre>'; exit;
    //         // Print API response for confirmation echo '<pre>'; print_r($apiResponse); echo '</pre>'; exit;
    //         } catch (\Throwable $e) {
    //         return $this->errorResponse(
    //             'Authentication service is unavailable.',
    //             503
    //         );
    //     }

    //     $statusCode = $response['statusCode'];
    //     $data = $response['data'];

    //     // Login failed
    //     if ($statusCode !== 200) {
    //         return $this->errorResponse(
    //             $data['message'] ?? 'Invalid email or password.',
    //             $statusCode
    //         );
    //     }

    //     // Login successful
    //     $loginData = $data;

    //     // Store authenticated user in PHP session
    //     session()->set([
    //         'isLoggedIn' => true,
    //         'user' => $loginData['user'],
    //         'token' => $loginData['token'],
    //     ]);

    //     return $this->successResponse(
    //         [
    //             'user' => $loginData['user'],
    //             'token' => $loginData['token'],
    //         ],
    //         'Login successful.'
    //     );
    // }
}

