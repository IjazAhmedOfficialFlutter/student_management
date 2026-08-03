<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ClassModel;

class Students extends BaseController
 {





 
    public function index()
 {

 $model = new StudentModel();

$search = trim($this->request->getGet('search'));

if (!empty($search)) {

    $model->groupStart()
          ->like('StudentName', $search)
          ->orLike('FatherName', $search)
          ->orLike('RollNo', $search)
           ->orLike('Email', $search)
          ->groupEnd();

}

$data = [

    'title' => 'Students',

    'students' => $model
        ->where('Status', 'Active')
        ->paginate(8, 'students'),

    'pager' => $model->pager,

    'search' => $search

];

return view('students/index', $data);
        
    }

    public function create()
 {
        $classModel = new ClassModel();

        $data = [
            'title'   => 'Add Student',
            'classes' => $classModel->findAll(),
            'validation' => \Config\Services::validation()

        ];

        return view( 'students/create', $data );
    }

    public function store()
 {
        $validation = \Config\Services::validation();

        $rules = $this->studentRules();

        if ( ! $this->validate( $this->studentRules() ) ) {

            return redirect()
            ->back()
            ->withInput();
        }
        $photo = $this->request->getFile( 'Photo' );

        $photoName = null;

        if ( $photo && $photo->isValid() && !$photo->hasMoved() ) {

            $photoName = $photo->getRandomName();

            $photo->move( FCPATH . 'uploads/students', $photoName );
        }

        $model = new StudentModel();

        $model->save( [

            'RollNo' => $this->request->getPost( 'RollNo' ),

            'StudentName' => $this->request->getPost( 'StudentName' ),

            'FatherName' => $this->request->getPost( 'FatherName' ),

            'Email' => $this->request->getPost( 'Email' ),

            'Phone' => $this->request->getPost( 'Phone' ),

            'Gender' => $this->request->getPost( 'Gender' ),

            'DOB' => $this->request->getPost( 'DOB' ),

            'Address' => $this->request->getPost( 'Address' ),

            'ClassID' => $this->request->getPost( 'ClassID' ),
            'Section' => trim( $this->request->getPost( 'Section' ) ),
            'CNIC' => $this->request->getPost( 'CNIC' ),
            'Photo' => $photoName

        ] );

return redirect()
    ->to('/students')
    ->with('success', lang('App.studentAddedSuccessfully'));
    
    }



    public function getRecentStudents($limit = 5)
{
    $model = new StudentModel();

    return $model
        ->select('Students.StudentID,
                  Students.RollNo,
                  Students.StudentName,
                  Students.Photo,
                  Students.CreatedAt,
                  Classes.ClassName')
        ->join('Classes', 'Classes.ClassID = Students.ClassID', 'left')
        ->where('Students.Status', 'Active')
        ->orderBy('Students.CreatedAt', 'DESC')
        ->findAll($limit);
}

    public function edit( $id )
 {
        $studentModel = new StudentModel();
        $classModel   = new ClassModel();

        $student = $studentModel->find( $id );

        if ( !$student ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound( lang('App.studentNotFound') );
        }

        $data = [
            'title'      => 'Edit Student',
            'student'    => $student,
            'classes'    => $classModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view( 'students/edit', $data );
    }

    public function update( $id )
 {
        $rules = $this->studentRules();

        if ( ! $this->validate( $this->studentRules( $id ) ) ) {

            return redirect()
            ->back()
            ->withInput();
        }

        $model = new StudentModel();

        $student = $model->find( $id );

        if ( !$student ) {

            return redirect()
            ->to( '/students' )
            ->with( 'error', lang('App.studentNotFound') );
        }

        $photo = $this->request->getFile( 'Photo' );

        $photoName = $student[ 'Photo' ];

        if ( $photo && $photo->isValid() && !$photo->hasMoved() ) {

            if ( !empty( $student[ 'Photo' ] ) && file_exists( FCPATH . 'uploads/students/' . $student[ 'Photo' ] ) ) {

                unlink( FCPATH . 'uploads/students/' . $student[ 'Photo' ] );
            }

            $photoName = $photo->getRandomName();

            $photo->move( FCPATH . 'uploads/students', $photoName );
        }

        $model->update( $id, [

            'RollNo'      => $this->request->getPost( 'RollNo' ),
            'StudentName' => $this->request->getPost( 'StudentName' ),
            'FatherName'  => $this->request->getPost( 'FatherName' ),
            'Email'       => $this->request->getPost( 'Email' ),
            'Phone'       => $this->request->getPost( 'Phone' ),
            'Gender'      => $this->request->getPost( 'Gender' ),
            'DOB'         => $this->request->getPost( 'DOB' ),
            'Address'     => $this->request->getPost( 'Address' ),
            'ClassID'     => $this->request->getPost( 'ClassID' ),
            'Section' => trim( $this->request->getPost( 'Section' ) ),
            'CNIC' => $this->request->getPost( 'CNIC' ),
            'Photo'       => $photoName

        ] );

        return redirect()
        ->to( '/students' )->with('success', lang('App.studentUpdatedSuccessfully'));
 }
  

public function restore($id)
{
    $model = new StudentModel();

    $student = $model->find($id);

    if (!$student) {
        return redirect()->to('/students/archive')
            ->with('error', lang('App.studentNotFound'));
    }

    $model->update($id, [
        'Status' => 'Active'
    ]);

    return redirect()->to('/students/archive')
->with('success', lang('App.studentRestoredSuccessfully'));

}

public function archive()
{
    $model = new StudentModel();

    $students = $model
        ->select('Students.*, Classes.ClassName')
        ->join('Classes', 'Classes.ClassID = Students.ClassID')
        ->where('Students.Status', 'Inactive')
        ->findAll();

    return view('students/archive', [
        'title' => 'Archived Students',
        'students' => $students
    ]);
}

private function studentRules($id = null)
{
    $rollNoRule = 'required|alpha_numeric_punct|min_length[1]|max_length[20]';

    if ($id === null) {
        $rollNoRule .= '|is_unique[Students.RollNo]';
    } else {
        $rollNoRule .= "|is_unique[Students.RollNo,StudentID,{$id}]";
    }

    return [

        'RollNo' => [
            'label' => 'Roll Number',
            'rules' => $rollNoRule,
        ],

        'StudentName' => [
            'label' => 'Student Name',
            'rules' => 'required|min_length[3]|max_length[100]|multiLang',
        ],

        'FatherName' => [
            'label' => 'Father Name',
            'rules' => 'required|min_length[3]|max_length[100]|multiLang',
        ],

        'Email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email|max_length[100]',
        ],

        'Phone' => [
            'label' => 'Phone Number',
            'rules' => 'required|numeric|exact_length[11]',
        ],

        'Gender' => [
            'label' => 'Gender',
            'rules' => 'required|in_list[Male,Female]',
        ],

        'DOB' => [
            'label' => 'Date of Birth',
            'rules' => 'required|valid_date',
        ],

        'ClassID' => [
            'label' => 'Class',
            'rules' => 'required|integer',
        ],

        'Section' => [
            'label' => 'Section',
            'rules' => 'required|in_list[Section A,Section B,Section C]',
        ],

        'Address' => [
            'label' => 'Address',
            'rules' => 'permit_empty|max_length[255]|multiLang',
        ],

        'Photo' => [
            'label' => 'Student Photo',
            'rules' => 'permit_empty|is_image[Photo]|max_size[Photo,2048]|mime_in[Photo,image/jpg,image/jpeg,image/png]',
        ],

        'CNIC' => [
            'label' => 'CNIC',
            'rules' => 'required|regex_match[/^[0-9]{5}-[0-9]{7}-[0-9]$/]',
        ],
    ];
}
public function archiveStudent($id)
{
    $model = new StudentModel();

    $student = $model->find($id);

    if (!$student) {
        return redirect()->to('/students')
->with('error', lang('App.studentNotFound')); 

    }

    $model->update($id, [
        'Status' => 'Inactive'
    ]);

 return redirect()->to('/students')
    ->with('success', lang('App.studentArchivedSuccessfully'));
}
 

}




