<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StudentModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\TeacherModel;
class Dashboard extends BaseController
{

public function index()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    $studentModel = new StudentModel();
    $teacherModel = new TeacherModel();
    $classModel   = new ClassModel();
    $subjectModel = new SubjectModel();
    $userModel    = new UserModel();

    $data = [

        'title' => 'Dashboard',

        // Student Statistics
        'totalStudents' => $studentModel
                                ->where('Status', 'Active')
                                ->countAllResults(),

        // Teacher Statistics
        'totalTeachers' => $teacherModel
                                ->where('Status', 'Active')
                                ->countAllResults(),

        'activeTeachers' => $teacherModel
                                ->where('Status', 'Active')
                                ->countAllResults(),

        'archivedTeachers' => $teacherModel
                                ->where('Status', 'Archived')
                                ->countAllResults(),

        // Other Statistics
        'totalClasses'  => $classModel->countAll(),

        'totalSubjects' => $subjectModel->countAll(),

        'totalUsers'    => $userModel->countAll(),

        // Recent Students
        'recentStudents' => $studentModel
            ->select('Students.StudentID,
                      Students.StudentName,
                      Students.RollNo,
                      Students.Photo,
                      Students.CreatedAt,
                      Classes.ClassName')
            ->join('Classes', 'Classes.ClassID = Students.ClassID', 'left')
            ->where('Students.Status', 'Active')
            ->orderBy('Students.CreatedAt', 'DESC')
            ->findAll(5),
    ];

    return view('dashboard/index', $data);
}
  
}