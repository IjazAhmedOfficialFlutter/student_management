<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ClassModel;
use App\Services\ApiService;

class Students extends BaseController
{
    protected ApiService $apiService;

    public function __construct()
    {
        $this->apiService = new ApiService();
    }

public function index()
{
    try {

        $search = trim(
            $this->request->getGet('search') ?? ''
        );

        $status = trim(
            $this->request->getGet('status') ?? ''
        );

        /*
         * Build API query parameters
         */
        $query = [];

        if ($search !== '') {
            $query['search'] = $search;
        }

        if ($status !== '') {
            $query['status'] = $status;
        }

        /*
         * Build API endpoint
         */
        $endpoint = 'api/students';

        if (!empty($query)) {
            $endpoint .= '?' . http_build_query($query);
        }

        /*
         * Call ASP.NET API
         */
        $response = $this->apiService->get(
            $endpoint,
            true
        );

        /*
         * API error
         */
        if ($response['statusCode'] !== 200) {

            return view('students/index', [
                'students' => [],
                'search' => $search,
                'status' => $status,
                'error' => 'Unable to load students.'
            ]);
        }

        /*
         * API returned student array
         */
        $students = $response['data'] ?? [];

        return view('students/index', [
            'students' => $students,
            'search' => $search,
            'status' => $status
        ]);

    } catch (\Throwable $e) {

        return view('students/index', [
            'students' => [],
            'search' => $this->request->getGet('search') ?? '',
            'status' => $this->request->getGet('status') ?? '',
            'error' => $e->getMessage()
        ]);
    }
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
    try {

        /*
         * Validate form
         */
        if (!$this->validate($this->studentRules())) {

            return redirect()
                ->back()
                ->withInput();
        }

        /*
         * Handle photo
         */
        $photo = $this->request->getFile('Photo');

        $photoName = null;

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {

            $photoName = $photo->getRandomName();

            $photo->move(
                FCPATH . 'uploads/students',
                $photoName
            );
        }

        /*
         * Build API request data
         */
        $data = [

            'rollNo' => $this->request->getPost('RollNo'),

            'studentName' =>
                $this->request->getPost('StudentName'),

            'fatherName' =>
                $this->request->getPost('FatherName'),

            'email' =>
                $this->request->getPost('Email'),

            'phone' =>
                $this->request->getPost('Phone'),

            'gender' =>
                $this->request->getPost('Gender'),

            'dob' =>
                $this->request->getPost('DOB'),

            'address' =>
                $this->request->getPost('Address'),

            'classID' =>
                (int) $this->request->getPost('ClassID'),

            'section' =>
                trim(
                    $this->request->getPost('Section')
                ),

            'cnic' =>
                $this->request->getPost('CNIC'),

            'photo' =>
                $photoName,

    'status' => 'Active'
                
        ];



  $response = $this->apiService->post(
            'api/students',
            $data,
            true
        );

        if (
            $response['statusCode'] < 200 ||
            $response['statusCode'] >= 300
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    $response['data']['message']
                        ?? 'Unable to create student.'
                );
        }

        /*
         * Success
         */
        return redirect()
            ->to('/students')
            ->with(
                'success',
                lang('App.studentAddedSuccessfully')
            );

    } catch (\Throwable $e) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                $e->getMessage()
            );
    }
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
    try {

        log_message(
            'debug',
            '========== ARCHIVE STUDENT =========='
        );

        log_message(
            'debug',
            'Student ID received: ' . $id
        );

       
        $response = $this->apiService->patch(
            'api/students/' . $id . '/archive',
            [],
            true
        );

        log_message(
            'debug',
            'API Status Code: ' . $response['statusCode']
        );

        log_message(
            'debug',
            'API Response: ' .
            json_encode($response['data'])
        );

        /*
         * API failed
         */
        if (
            $response['statusCode'] < 200 ||
            $response['statusCode'] >= 300
        ) {

            return redirect()
                ->to('/students')
                ->with(
                    'error',
                    $response['data']['message']
                        ?? 'Unable to archive student.'
                );
        }

        /*
         * API success
         */
        return redirect()
            ->to('/students')
            ->with(
                'success',
                lang('App.studentArchivedSuccessfully')
            );

    } catch (\Throwable $e) {

        log_message(
            'error',
            'Archive API Error: ' . $e->getMessage()
        );

        return redirect()
            ->to('/students')
            ->with(
                'error',
                $e->getMessage()
            );
    }
}


 

}




