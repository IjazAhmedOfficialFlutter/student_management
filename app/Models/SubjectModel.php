<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table = 'Subjects';

    protected $primaryKey = 'SubjectID';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'SubjectName',
        'ClassID',
    ];

    protected $useTimestamps = false;
}