<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'Users';

    protected $primaryKey = 'UserID';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
    'FullName',
    'Email',
    'Password',
    'Role',
    'Status',
    'FailedAttempts',
    'LastLogin',
    'CreatedAt',
    'UpdatedAt'
];
    protected $useTimestamps = false;

    public function findByEmail(string $email)
{
    return $this->where('Email', $email)->first();
}

public function updateLastLogin(int $userId)
{
    return $this->update($userId, [
        'LastLogin' => date('Y-m-d H:i:s')
    ]);
}

public function resetFailedAttempts(int $userId)
{
    return $this->update($userId, [
        'FailedAttempts' => 0
    ]);
}

public function incrementFailedAttempts(int $userId)
{
    $user = $this->find($userId);

    return $this->update($userId, [
        'FailedAttempts' => $user['FailedAttempts'] + 1
    ]);
}
}

