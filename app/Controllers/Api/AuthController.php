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
    // Read JSON request body
    $input = $this->request->getJSON(true);

    $email = trim($input['email'] ?? '');
    $password = $input['password'] ?? '';

    // Validate request
    $rules = [
        'email' => 'required|valid_email',
        'password' => 'required',
    ];

    $validationData = [
        'email' => $email,
        'password' => $password,
    ];

    if (!$this->validateData($validationData, $rules)) {
        return $this->validationError(
            $this->validator->getErrors()
        );
    }

    try {
        // Send login request to ASP.NET API
        $response = $this->apiService->post(
            'api/auth/login',
            [
                'email' => $email,
                'password' => $password,
            ]
        );

    

    }
     catch (\Throwable $e) {

        return $this->errorResponse(
            'Authentication service is unavailable.',
            503
        );
    }
}

}

