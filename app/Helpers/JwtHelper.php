<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper
{
    public static function generateToken(array $payload): string
    {
        $issuedAt = time();
        $expire = $issuedAt + (int) env('JWT_EXPIRE', 3600);

        $token = [
            'iat'  => $issuedAt,
            'exp'  => $expire,
            'data' => $payload,
        ];

        return JWT::encode(
            $token,
            env('JWT_SECRET'),
            'HS256'
        );
    }

    public static function verifyToken(string $token)
    {
        return JWT::decode(
            $token,
            new Key(env('JWT_SECRET'), 'HS256')
        );
    }
}