<?php

namespace App\Controllers;

use App\Models\TeacherAssignmentModel;
use App\Models\TeacherModel;
use App\Models\SubjectModel;
use App\Models\ClassModel;

class TeacherAssignments extends BaseController
{
    protected $assignmentModel;

    public function __construct()
    {
        $this->assignmentModel = new TeacherAssignmentModel();
    }

    public function create()
{
    $teacherModel = new TeacherModel();
    $subjectModel = new SubjectModel();
    $classModel   = new ClassModel();

    $data = [

       'title' => lang('App.addTeacherAssignment'),

        'teachers' => $teacherModel
                        ->where('Status', 'Active')
                        ->findAll(),

        'subjects' => $subjectModel
                        ->findAll(),

        'classes' => $classModel
                        ->findAll(),

        'validation' => \Config\Services::validation()

    ];

    return view('teacher_assignments/create', $data);
}
public function store()
{
    $rules = [

        'TeacherID' => 'required|integer',

        'SubjectID' => 'required|integer',

        'ClassID' => 'required|integer',

    ];

    if (!$this->validate($rules)) {

        return redirect()
            ->back()
            ->withInput();

    }

    $this->assignmentModel->save([

        'TeacherID' => $this->request->getPost('TeacherID'),

        'SubjectID' => $this->request->getPost('SubjectID'),

        'ClassID' => $this->request->getPost('ClassID'),

        'Status' => 'Active',

    ]);

    return redirect()
        ->to('/teacher-assignments')
        ->with('success', lang('App.assignmentAddedSuccessfully'));
}


public function index()
{
    $assignments = $this->assignmentModel
        ->select('
            TeacherAssignments.*,
            Teachers.TeacherName,
            Subjects.SubjectName,
            Classes.ClassName
        ')
        ->join('Teachers', 'Teachers.TeacherID = TeacherAssignments.TeacherID')
        ->join('Subjects', 'Subjects.SubjectID = TeacherAssignments.SubjectID')
        ->join('Classes', 'Classes.ClassID = TeacherAssignments.ClassID')
        ->where('TeacherAssignments.Status', 'Active')
        ->findAll();

    $data = [

       'title' => lang('App.teacherAssignments'),

        'assignments' => $assignments

    ];

    return view('teacher_assignments/index', $data);
}
}