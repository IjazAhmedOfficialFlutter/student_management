<?php

namespace App\Controllers;

use App\Models\SubjectModel;
use App\Models\ClassModel;
use App\Models\TeacherAssignmentModel;

class Subjects extends BaseController
{


public function index()
{
    $assignmentModel = new TeacherAssignmentModel();
    $classModel      = new ClassModel();
$subjectModel = new SubjectModel();
    $data = [

        'title'    => 'Subjects',
    'subjects' => $subjectModel->getAllSubjects(),


        'classes'  => $classModel->findAll(),

    ];

    return view('subjects/index', $data);
}



    public function create()
    {
        $classModel = new ClassModel();

        $data = [
            'title'   => 'Add Subject',
            'classes' => $classModel->findAll(),
        ];

        return view('subjects/create', $data);
    }

    public function store()
    {
        $subjectModel = new SubjectModel();

        if (!$this->validate($this->subjectRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $subjectModel->save([
            'SubjectName' => $this->request->getPost('SubjectName'),
            'ClassID'     => $this->request->getPost('ClassID'),
        ]);

        return redirect()->to('subjects')->with('success', 'Subject added successfully.');
    }

    public function edit($id)
    {
        $subjectModel = new SubjectModel();
        $classModel = new ClassModel();

        $subject = $subjectModel->find($id);

        if (!$subject) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'   => 'Edit Subject',
            'subject' => $subject,
            'classes' => $classModel->findAll(),
        ];

        return view('subjects/edit', $data);
    }

    public function update($id)
    {
        $subjectModel = new SubjectModel();

        $subject = $subjectModel->find($id);

        if (!$subject) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (!$this->validate($this->subjectRules($id))) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $subjectModel->update($id, [
            'SubjectName' => $this->request->getPost('SubjectName'),
            'ClassID'     => $this->request->getPost('ClassID'),
        ]);

        return redirect()->to('subjects')->with('success', 'Subject updated successfully.');
    }

    public function delete($id)
    {
        $subjectModel = new SubjectModel();

        $subject = $subjectModel->find($id);

        if (!$subject) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $subjectModel->delete($id);

        return redirect()->to('subjects')->with('success', 'Subject deleted successfully.');
    }

private function subjectRules($id = null)
{
    // Widened for subject names: allows + # & ( ) on top of Urdu/English/digits/punctuation
    $urduRegex = '/^[\x{0600}-\x{06FF}\x{0750}-\x{077F}\x{FB50}-\x{FDFF}\x{FE70}-\x{FEFF}\x{200B}-\x{200F}0-9a-zA-Z\s,،\.\-\/\+#&\(\)]+$/u';

    $subjectNameRule = "required|min_length[2]|max_length[100]|regex_match[{$urduRegex}]";

    if ($id === null) {
        $subjectNameRule .= '|is_unique[Subjects.SubjectName]';
    } else {
        $subjectNameRule .= "|is_unique[Subjects.SubjectName,SubjectID,{$id}]";
    }

    return [
        'SubjectName' => [
            'label' => 'Subject Name',
            'rules' => $subjectNameRule,
        ],
        'ClassID' => [
            'label' => 'Class',
            'rules' => 'required|integer',
        ],
    ];
}
public function show($id)
{
    $subjectModel = new SubjectModel();

    $subject = $subjectModel
        ->select('
            Subjects.*,
            Classes.ClassName,
            Teachers.TeacherName,
            Teachers.EmployeeNo,
            Teachers.Status AS TeacherStatus,
            TeacherAssignments.Status AS AssignmentStatus
        ')
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
        ->where('Subjects.SubjectID', $id)
        ->first();

    if (!$subject) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('subjects/show', [
        'title'   => 'Subject Details',
        'subject' => $subject
    ]);
}


}