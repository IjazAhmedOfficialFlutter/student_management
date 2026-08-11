<?php

namespace App\Filters;
/** @var \CodeIgniter\HTTP\IncomingRequest $request */
use App\Helpers\JwtHelper;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class JwtFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
{
    $header = $request->getHeaderLine('Authorization');

    if (empty($header)) {
        return service('response')
            ->setStatusCode(401)
            ->setJSON([
                'success' => false,
                'message' => 'Authorization token is missing.'
            ]);
    }

    if (!preg_match('/Bearer\s+(\S+)/', $header, $matches)) {
        return service('response')
            ->setStatusCode(401)
            ->setJSON([
                'success' => false,
                'message' => 'Invalid authorization header.'
            ]);
    }

    $token = $matches[1];

    try {

        JwtHelper::verifyToken($token);

     

    } catch (\Exception $e) {

        return service('response')
            ->setStatusCode(401)
            ->setJSON([
                'success' => false,
                'message' => 'Invalid or expired token.'
            ]);
    }
}
  

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}