<?php

namespace App\Filters;

use App\Helpers\JwtHelper;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApiRoleFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
{
    $header = $request->getHeaderLine('Authorization');

    if (!$header || !str_starts_with($header, 'Bearer ')) {
        return service('response')
            ->setStatusCode(401)
            ->setJSON([
                'success' => false,
                'message' => 'Authorization token is missing.'
            ]);
    }

    $token = substr($header, 7);

    try {

        $decoded = JwtHelper::verifyToken($token);

        $userRole = $decoded->data->Role;

        if (!empty($arguments) && !in_array($userRole, $arguments)) {

            return service('response')
                ->setStatusCode(403)
                ->setJSON([
                    'success' => false,
                    'message' => 'Access denied.'
                ]);
        }

    } catch (\Exception $e) {

        return service('response')
            ->setStatusCode(401)
            ->setJSON([
                'success' => false,
                'message' => 'Invalid token.'
            ]);
    }
}

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}