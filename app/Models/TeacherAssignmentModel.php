<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherAssignmentModel extends Model
{
    protected $table = 'TeacherAssignments';

    protected $primaryKey = 'AssignmentID';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $allowedFields = [

        'TeacherID',
        'SubjectID',
        'ClassID',
        'Status',
        'CreatedAt',
        'UpdatedAt'

    ];

    protected $useTimestamps = false;

public function getAssignedSubjects()
{
    return $this->select('
            TeacherAssignments.AssignmentID,
            TeacherAssignments.Status AS AssignmentStatus,
            Subjects.SubjectID,
            Subjects.SubjectName,
            Classes.ClassName,
            Teachers.TeacherName,
            Teachers.Status AS TeacherStatus
        ')
        ->join('Subjects', 'Subjects.SubjectID = TeacherAssignments.SubjectID')
        ->join('Classes', 'Classes.ClassID = TeacherAssignments.ClassID')
        ->join('Teachers', 'Teachers.TeacherID = TeacherAssignments.TeacherID')
        ->findAll();
}

}