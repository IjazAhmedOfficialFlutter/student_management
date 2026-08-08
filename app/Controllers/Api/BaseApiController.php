<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BaseApiController extends BaseController
{
    /**
     * Success Response
     */
    protected function successResponse(
        mixed $data = [],
        string $message = 'Success',
        int $statusCode = ResponseInterface::HTTP_OK
    ) {
        return $this->response
            ->setStatusCode($statusCode)
            ->setJSON([
                'success' => true,
                'message' => $message,
                'data'    => $data,
            ]);
    }

    /**
     * Error Response
     */
    protected function errorResponse(
        string $message = 'Something went wrong',
        int $statusCode = ResponseInterface::HTTP_BAD_REQUEST,
        mixed $errors = null
    ) {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return $this->response
            ->setStatusCode($statusCode)
            ->setJSON($response);
    }

    /**
     * Validation Error Response
     */
    protected function validationError(array $errors)
    {
        return $this->errorResponse(
            'Validation failed.',
            ResponseInterface::HTTP_UNPROCESSABLE_ENTITY,
            $errors
        );
    }

    /**
     * Not Found Response
     */
    protected function notFound(string $message = 'Record not found.')
    {
        return $this->errorResponse(
            $message,
            ResponseInterface::HTTP_NOT_FOUND
        );
    }

    /**
     * Created Response
     */
    protected function createdResponse(
        mixed $data = [],
        string $message = 'Created successfully.'
    ) {
        return $this->successResponse(
            $data,
            $message,
            ResponseInterface::HTTP_CREATED
        );
    }
}