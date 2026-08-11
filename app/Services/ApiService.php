<?php

namespace App\Services;

use Config\App;

class ApiService
{
    private string $baseURL;

    public function __construct()
    {
        $config = new App();

        $this->baseURL = rtrim(
            $config->apiBaseURL,
            '/'
        );
    }

    /**
     * POST request to ASP.NET API
     */
    public function post(
        string $endpoint,
        array $data,
        bool $authenticated = false
    ): array {
        return $this->request(
            'POST',
            $endpoint,
            $data,
            $authenticated
        );
    }

    /**
     * GET request to ASP.NET API
     */
    public function get(
        string $endpoint,
        bool $authenticated = false
    ): array {
        return $this->request(
            'GET',
            $endpoint,
            [],
            $authenticated
        );
    }

    /**
     * Common API request handler
     */
private function request(
    string $method,
    string $endpoint,
    array $data = [],
    bool $authenticated = false
): array {

    $method = strtoupper($method);

    $url = $this->baseURL . '/' . ltrim($endpoint, '/');

    $ch = curl_init($url);

    $headers = [
        'Content-Type: application/json',
        'Accept: application/json',
    ];

    /*
     * Add JWT when endpoint requires authentication
     */
    if ($authenticated) {

        $token = session()->get('token');

        if (!$token) {
            throw new \RuntimeException(
                'Authentication token not found in session.'
            );
        }

        $headers[] = 'Authorization: Bearer ' . $token;
    }

    /*
     * Common cURL options
     */
    $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_CUSTOMREQUEST => $method,
    ];

    /*
     * Send JSON body for methods that support a request body
     */
    if (in_array($method, ['POST', 'PUT', 'PATCH'], true)) {

        $options[CURLOPT_POSTFIELDS] = json_encode($data);
    }

    /*
     * Execute cURL request
     */
    curl_setopt_array($ch, $options);

    $response = curl_exec($ch);

    if ($response === false) {

        $error = curl_error($ch);

        curl_close($ch);

        throw new \RuntimeException(
            'Unable to connect to API: ' . $error
        );
    }

    /*
     * Get HTTP status code
     */
    $statusCode = curl_getinfo(
        $ch,
        CURLINFO_HTTP_CODE
    );

    curl_close($ch);

    /*
     * Decode API response
     */
    $decoded = json_decode(
        $response,
        true
    );

    return [
        'statusCode' => $statusCode,
        'data' => $decoded,
    ];
}


    /**
 * PUT request to ASP.NET API
 */
public function put(
    string $endpoint,
    array $data,
    bool $authenticated = false
): array {
    return $this->request(
        'PUT',
        $endpoint,
        $data,
        $authenticated
    );
}
public function delete(
    string $endpoint,
    bool $authenticated = false
): array {
    return $this->request(
        'DELETE',
        $endpoint,
        [],
        $authenticated
    );
}


/**
 * PATCH request to ASP.NET API
 */
public function patch(
    string $endpoint,
    array $data = [],
    bool $authenticated = false
): array {
    return $this->request(
        'PATCH',
        $endpoint,
        $data,
        $authenticated
    );
}

}