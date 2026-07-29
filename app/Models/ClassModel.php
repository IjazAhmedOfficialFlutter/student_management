<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table = 'Classes';

    protected $primaryKey = 'ClassID';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'ClassName'
    ];

    protected $useTimestamps = false;
}