<?php
namespace App\Controllers;

use App\Models\TeacherModel;

class Teachers extends BaseController
{
    protected $teacherModel;

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
    }

    public function create()
{
    $data = [

        'title' => lang('App.addTeacher'),

        'validation' => \Config\Services::validation()

    ];

    return view('teachers/create', $data);
}

public function index()
{
    $data = [

        'title' => 'Teachers',

        'teachers' => $this->teacherModel->findAll(),

        'totalTeachers' => $this->teacherModel->countAll(),

        'activeTeachers' => $this->teacherModel
                                ->where('Status', 'Active')
                                ->countAllResults(),

        'archivedTeachers' => $this->teacherModel
                                ->where('Status', 'Archived')
                                ->countAllResults(),
    ];

    return view('teachers/index', $data);
}


public function view($id)
{
    $teacherModel = new TeacherModel();

    $teacher = $teacherModel->find($id);

    if (!$teacher) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('teachers/view', [
        'title'   => 'Teacher Details',
        'teacher' => $teacher,
    ]);
}
public function edit($id)
{
    $teacherModel = new TeacherModel();

    $teacher = $teacherModel->find($id);

    if (!$teacher) {
        return redirect()->to('teachers')
            ->with('error', 'Teacher not found.');
    }

    $data = [
        'title'   => 'Edit Teacher',
        'teacher' => $teacher,
    ];

    return view('teachers/edit', $data);
}

public function update($id)
{
    $teacherModel = new TeacherModel();

    $teacher = $teacherModel->find($id);

    if (!$teacher) {
        return redirect()->to('teachers');
    }

    $rules = [

        'TeacherName'  => 'required|min_length[3]',
        'Email'        => 'permit_empty|valid_email',
        'Phone'        => 'permit_empty',
        'Qualification'=> 'permit_empty',
        'Experience'   => 'permit_empty|integer',
        'Status'       => 'required',

    ];

    if (!$this->validate($rules)) {

        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());

    }

    $photo = $teacher['Photo'];

    $image = $this->request->getFile('Photo');

    if ($image && $image->isValid() && !$image->hasMoved()) {

        $photo = $image->getRandomName();

        $image->move(FCPATH.'uploads/teachers', $photo);

    }

    $teacherModel->update($id,[

        'TeacherName'  => $this->request->getPost('TeacherName'),
        'FatherName'   => $this->request->getPost('FatherName'),
        'Email'        => $this->request->getPost('Email'),
        'Phone'        => $this->request->getPost('Phone'),
        'Gender'       => $this->request->getPost('Gender'),
        'DOB'          => $this->request->getPost('DOB'),
        'Qualification'=> $this->request->getPost('Qualification'),
        'Experience'   => $this->request->getPost('Experience'),
        'JoiningDate'  => $this->request->getPost('JoiningDate'),
        'Address'      => $this->request->getPost('Address'),
        'CNIC'         => $this->request->getPost('CNIC'),
        'Status'       => $this->request->getPost('Status'),
        'Photo'        => $photo,

    ]);

    return redirect()->to('teachers')
        ->with('success','Teacher updated successfully.');
}


public function store()
{


    if (!$this->validate($this->teacherRules())) {

        return redirect()
            ->back()
            ->withInput();

    }

    $photoName = null;

    $photo = $this->request->getFile('Photo');

    if ($photo && $photo->isValid() && !$photo->hasMoved()) {

        $photoName = $photo->getRandomName();

        $photo->move(FCPATH . 'uploads/teachers', $photoName);

    }

    $teacherModel = new TeacherModel();


    $teacherModel->save([

        'EmployeeNo'    => $this->request->getPost('EmployeeNo'),
        'TeacherName'   => trim($this->request->getPost('TeacherName')),
        'FatherName'    => trim($this->request->getPost('FatherName')),
        'Email'         => $this->request->getPost('Email'),
        'Phone'         => $this->request->getPost('Phone'),
        'Gender'        => $this->request->getPost('Gender'),
        'DOB'           => $this->request->getPost('DOB'),
        'Qualification' => trim($this->request->getPost('Qualification')),
        'Experience'    => $this->request->getPost('Experience'),
        'JoiningDate'   => $this->request->getPost('JoiningDate'),
        'Address'       => trim($this->request->getPost('Address')),
        'CNIC'          => $this->request->getPost('CNIC'),
        'Photo'         => $photoName,
        'Status' => 'Active'

    ]);

    return redirect()
        ->to('/teachers')
        ->with('success', lang('App.teacherAddedSuccessfully'));
}



public function archiveTeacher($id)
{
    $teacher = $this->teacherModel->find($id);

    if (!$teacher) {

        return redirect()->to('/teachers')
            ->with('error', lang('App.teacherNotFound'));

    }

    $this->teacherModel->update($id, [
        'Status' => 'Archived'
    ]);

    return redirect()->to('/teachers')
        ->with('success', lang('App.teacherArchivedSuccessfully'));
}
public function archived()
{
    $data = [
        'title'    => lang('App.archivedTeachers'),
        'teachers' => $this->teacherModel
                            ->where('Status', 'Archived')
                            ->findAll(),
    ];

    return view('teachers/archived', $data);
}

public function restore($id)
{
    $teacher = $this->teacherModel->find($id);

    if (!$teacher) {
        return redirect()->to('/teachers/archived')
            ->with('error', lang('App.teacherNotFound'));
    }

    $this->teacherModel->update($id, [
        'Status' => 'Active',
    ]);

    return redirect()->to('/teachers/archived')
        ->with('success', lang('App.teacherRestoredSuccessfully'));
}


private function teacherRules($id = null)
{
    $employeeRule = 'required|min_length[3]|max_length[20]';

    if ($id === null) {

        $employeeRule .= '|is_unique[Teachers.EmployeeNo]';

    } else {

        $employeeRule .= "|is_unique[Teachers.EmployeeNo,TeacherID,{$id}]";

    }

    return [

        'EmployeeNo' => [
            'label' => lang('App.employeeNo'),
            'rules' => $employeeRule,
        ],

        'TeacherName' => [
            'label' => lang('App.teacherName'),
            'rules' => 'required|min_length[3]|max_length[100]|multiLang',
        ],

        'FatherName' => [
            'label' => lang('App.fatherName'),
            'rules' => 'permit_empty|min_length[3]|max_length[100]|multiLang',
        ],

        'Email' => [
            'label' => lang('App.email'),
            'rules' => 'permit_empty|valid_email|max_length[100]',
        ],

        'Phone' => [
            'label' => lang('App.phone'),
            'rules' => 'permit_empty|numeric|exact_length[11]',
        ],

        'Gender' => [
            'label' => lang('App.gender'),
            'rules' => 'required|in_list[Male,Female]',
        ],

        'DOB' => [
            'label' => lang('App.dob'),
            'rules' => 'permit_empty|valid_date',
        ],

        'Qualification' => [
            'label' => lang('App.qualification'),
            'rules' => 'permit_empty|max_length[150]|multiLang',
        ],

        'Experience' => [
            'label' => lang('App.experience'),
            'rules' => 'permit_empty|integer',
        ],

        'JoiningDate' => [
            'label' => lang('App.joiningDate'),
            'rules' => 'permit_empty|valid_date',
        ],

        'Address' => [
            'label' => lang('App.address'),
            'rules' => 'permit_empty|max_length[255]|multiLang',
        ],

        'CNIC' => [
            'label' => lang('App.cnic'),
            'rules' => 'permit_empty|regex_match[/^[0-9]{5}-[0-9]{7}-[0-9]$/]',
        ],

   'Status' => [
    'label' => lang('App.status'),
    'rules' => 'permit_empty|in_list[Active,Archived]',
],

        'Photo' => [
            'label' => lang('App.photo'),
            'rules' => 'permit_empty|is_image[Photo]|max_size[Photo,2048]|mime_in[Photo,image/jpg,image/jpeg,image/png]',
        ],

    ];
}
}