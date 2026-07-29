<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'Attendance';

    protected $primaryKey = 'AttendanceID';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'StudentID',
        'ClassID',
        'AttendanceDate',
        'Status',
    ];

    protected $useTimestamps = false;
}