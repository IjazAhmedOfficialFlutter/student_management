<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StudentModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;

class Dashboard extends BaseController
{
    public function index()
    {
         if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }
        $data = [

            'title' => 'Dashboard',

            'totalStudents' => (new StudentModel())->countAll(),

            'totalClasses' => (new ClassModel())->countAll(),

            'totalSubjects' => (new SubjectModel())->countAll(),

            'totalUsers' => (new UserModel())->countAll(),

        ];

        return view('dashboard/index', $data);
    }
}