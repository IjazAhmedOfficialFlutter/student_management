<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'Students';

    protected $primaryKey = 'StudentID';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'RollNo',
        'StudentName',
        'FatherName',
        'Email',
        'Phone',
        'Gender',
        'DOB',
        'Address',
        'Photo',
        'ClassID',
        'Section',
        'CNIC',
        'Status'
    ];

    protected $useTimestamps = false;
}