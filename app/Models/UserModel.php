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
        'Role'
    ];

    protected $useTimestamps = false;
}