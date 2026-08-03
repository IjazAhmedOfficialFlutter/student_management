<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table = 'Subjects';
    protected $primaryKey = 'SubjectID';
    protected $returnType = 'array';

    protected $allowedFields = [
        'SubjectName',
        'ClassID',
    ];

    protected $useTimestamps = false;

    public function getAllSubjects()
    {
        return $this->select("
                Subjects.*,
                Classes.ClassName,
                Teachers.TeacherName,
                Teachers.Status AS TeacherStatus,
                TeacherAssignments.AssignmentID
            ")
            ->join(
                'TeacherAssignments',
                'TeacherAssignments.SubjectID = Subjects.SubjectID',
                'left'
            )
            ->join(
                'Teachers',
                'Teachers.TeacherID = TeacherAssignments.TeacherID',
                'left'
            )
            ->join(
                'Classes',
                'Classes.ClassID = Subjects.ClassID',
                'left'
            )
            ->findAll();
    }
}