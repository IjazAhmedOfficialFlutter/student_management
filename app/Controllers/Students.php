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

public function edit($id)
{
    try {

        $response = $this->apiService->get(
            'api/students/' . $id,
            true
        );

        if ($response['statusCode'] !== 200) {

            return redirect()
                ->to('/students')
                ->with(
                    'error',
                    $response['data']['message']
                        ?? 'Student not found.'
                );
        }

        $classModel = new ClassModel();

        return view('students/edit', [
            'title'      => 'Edit Student',
            'student'    => $response['data'],
            'classes'    => $classModel->findAll(),
            'validation' => \Config\Services::validation()
        ]);

    } catch (\Throwable $e) {

        return redirect()
            ->to('/students')
            ->with(
                'error',
                $e->getMessage()
            );
    }
}


public function update($id)
{
    try {

        if (!$this->validate($this->studentRules($id))) {

            return redirect()
                ->back()
                ->withInput();
        }

        $photo = $this->request->getFile('Photo');

        $photoName = $this->request->getPost('ExistingPhoto');

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {

            $photoName = $photo->getRandomName();

            $photo->move(
                FCPATH . 'uploads/students',
                $photoName
            );
        }

        $data = [

            'studentID' => (int) $id,

            'rollNo' =>
                $this->request->getPost('RollNo'),

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
                $photoName
        ];

        $response = $this->apiService->put(
            'api/students/' . $id,
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
                        ?? 'Unable to update student.'
                );
        }

        return redirect()
            ->to('/students')
            ->with(
                'success',
                lang('App.studentUpdatedSuccessfully')
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

public function restore($id)
{
    try {

        $response = $this->apiService->patch(
            'api/students/' . $id . '/unarchive',
            [],
            true
        );

        if (
            $response['statusCode'] < 200 ||
            $response['statusCode'] >= 300
        ) {

            return redirect()
                ->to('/students/archive')
                ->with(
                    'error',
                    $response['data']['message']
                        ?? 'Unable to restore student.'
                );
        }

        return redirect()
            ->to('/students/archive')
            ->with(
                'success',
                lang('App.studentRestoredSuccessfully')
            );

    } catch (\Throwable $e) {

        return redirect()
            ->to('/students/archive')
            ->with(
                'error',
                $e->getMessage()
            );
    }
}


public function archive()
{
    try {

        $response = $this->apiService->get(
            'api/students?status=Inactive',
            true
        );

        if ($response['statusCode'] !== 200) {

            return view('students/archive', [
                'title' => 'Archived Students',
                'students' => [],
                'error' => $response['data']['message']
                    ?? 'Unable to load archived students.'
            ]);
        }

        $students = [];

        foreach ($response['data'] ?? [] as $student) {

            $students[] = [
                'StudentID'   => $student['studentID'] ?? null,
                'RollNo'      => $student['rollNo'] ?? null,
                'StudentName' => $student['studentName'] ?? null,
                'FatherName'  => $student['fatherName'] ?? null,
                'ClassName'   => $student['className'] ?? null,
                'Phone'       => $student['phone'] ?? null,
                'CNIC'        => $student['cnic'] ?? null,
                'Photo'       => $student['photo'] ?? null,
            ];
        }

        return view('students/archive', [
            'title' => 'Archived Students',
            'students' => $students
        ]);

    } catch (\Throwable $e) {

        log_message(
            'error',
            'Archived students API error: ' . $e->getMessage()
        );

        return view('students/archive', [
            'title' => 'Archived Students',
            'students' => [],
            'error' => $e->getMessage()
        ]);
    }
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


 
public function delete($id)
{
    try {

        $response = $this->apiService->delete(
            'api/students/' . $id,
            true
        );

        if (
            $response['statusCode'] < 200 ||
            $response['statusCode'] >= 300
        ) {

            return redirect()
                ->to('/students')
                ->with(
                    'error',
                    $response['data']['message']
                        ?? 'Unable to delete student.'
                );
        }

        return redirect()
            ->to('/students')
            ->with(
                'success',
                'Student deleted successfully.'
            );

    } catch (\Throwable $e) {

        return redirect()
            ->to('/students')
            ->with(
                'error',
                $e->getMessage()
            );
    }
}
}