<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table = 'Teachers';

    protected $primaryKey = 'TeacherID';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $allowedFields = [

        'EmployeeNo',
        'TeacherName',
        'FatherName',
        'Email',
        'Phone',
        'Gender',
        'DOB',
        'Qualification',
        'Experience',
        'JoiningDate',
        'Address',
        'Photo',
        'CNIC',
        'Status'

    ];

    protected $useTimestamps = false;
}