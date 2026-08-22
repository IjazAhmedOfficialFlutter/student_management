<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\TeacherModel;
use App\Services\ApiService;

class Dashboard extends BaseController
{

public function index()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    $teacherModel = new TeacherModel();
    $classModel   = new ClassModel();
    $subjectModel = new SubjectModel();
    $userModel    = new UserModel();
    $apiService   = new ApiService();

    $totalStudents = 0;
    $recentStudents = [];

    try {

        $response = $apiService->get(
            'api/students?status=Active',
            true
        );

        if (
            $response['statusCode'] === 200 &&
            is_array($response['data'])
        ) {
            $totalStudents = count($response['data']);
        }

    } catch (\Throwable $e) {

        log_message(
            'error',
            'Dashboard students API error: ' . $e->getMessage()
        );
    }

    try {

        $response = $apiService->get(
            'api/students/recent',
            true
        );

        if (
            $response['statusCode'] === 200 &&
            is_array($response['data'])
        ) {

            foreach ($response['data'] as $student) {

                $recentStudents[] = [
                    'StudentID'   => $student['studentID'] ?? null,
                    'RollNo'      => $student['rollNo'] ?? null,
                    'StudentName' => $student['studentName'] ?? null,
                    'Photo'       => $student['photo'] ?? null,
                    'ClassName'   => $student['className'] ?? null,
                    'CreatedAt'   => $student['createdAt'] ?? null,
                ];
            }
        }

    } catch (\Throwable $e) {

        log_message(
            'error',
            'Dashboard recent students API error: ' . $e->getMessage()
        );
    }

    $data = [

        'title' => 'Dashboard',

        'totalStudents' => $totalStudents,

        'totalTeachers' => $teacherModel
            ->where('Status', 'Active')
            ->countAllResults(),

        'activeTeachers' => $teacherModel
            ->where('Status', 'Active')
            ->countAllResults(),

        'archivedTeachers' => $teacherModel
            ->where('Status', 'Archived')
            ->countAllResults(),

        'totalClasses' => $classModel->countAll(),

        'totalSubjects' => $subjectModel->countAll(),

        'totalUsers' => $userModel->countAll(),

        'recentStudents' => $recentStudents,
    ];

    return view('dashboard/index', $data);
}

}

