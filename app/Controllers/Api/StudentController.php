<?php

namespace App\Controllers\Api;
use App\Models\StudentModel;


class StudentController extends BaseApiController{
    protected StudentModel $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

public function index()
{
    $students = $this->studentModel->findAll();

    return $this->successResponse(
        $students,
        'Students retrieved successfully.'
    );
}

public function show($id)
{
    $student = $this->studentModel->find($id);

    if (!$student) {
        return $this->notFound('Student not found.');
    }

    return $this->successResponse(
        $student,
        'Student retrieved successfully.'
    );
}


public function create()
{
    $rules = [
        'RollNo'      => 'required|alpha_numeric_punct|min_length[1]|max_length[20]|is_unique[Students.RollNo]',
        'StudentName' => 'required|min_length[3]|max_length[100]|multiLang',
        'FatherName'  => 'required|min_length[3]|max_length[100]|multiLang',
        'Email'       => 'required|valid_email|max_length[100]',
        'Phone'       => 'required|numeric|exact_length[11]',
        'Gender'      => 'required|in_list[Male,Female]',
        'DOB'         => 'required|valid_date',
        'ClassID'     => 'required|integer',
        'Section'     => 'required|in_list[Section A,Section B,Section C]',
        'Address'     => 'permit_empty|max_length[255]|multiLang',
        'CNIC'        => 'required|regex_match[/^[0-9]{5}-[0-9]{7}-[0-9]$/]',
    ];

    if (!$this->validate($rules)) {
        return $this->validationError($this->validator->getErrors());
    }

    $data = [
        'RollNo'      => $this->request->getPost('RollNo'),
        'StudentName' => $this->request->getPost('StudentName'),
        'FatherName'  => $this->request->getPost('FatherName'),
        'Email'       => $this->request->getPost('Email'),
        'Phone'       => $this->request->getPost('Phone'),
        'Gender'      => $this->request->getPost('Gender'),
        'DOB'         => $this->request->getPost('DOB'),
        'Address'     => $this->request->getPost('Address'),
        'ClassID'     => $this->request->getPost('ClassID'),
        'Section'     => trim($this->request->getPost('Section')),
        'CNIC'        => $this->request->getPost('CNIC'),
        'Status'      => 'Active',
        'Photo'       => null,
    ];

    $this->studentModel->insert($data);

    $student = $this->studentModel->find($this->studentModel->getInsertID());

    return $this->createdResponse(
        $student,
        'Student created successfully.'
    );
}
public function update($id)
{
    $apiService = new \App\Services\ApiService();

    /*
     * Get form data
     */
    $data = [
        'rollNo'      => $this->request->getPost('RollNo'),
        'studentName' => $this->request->getPost('StudentName'),
        'fatherName'  => $this->request->getPost('FatherName'),
        'email'       => $this->request->getPost('Email'),
        'phone'       => $this->request->getPost('Phone'),
        'gender'      => $this->request->getPost('Gender'),
        'dob'         => $this->request->getPost('DOB'),
        'address'     => $this->request->getPost('Address') ?? '',
        'classID'     => (int) $this->request->getPost('ClassID'),
        'section'     => trim(
            $this->request->getPost('Section')
        ),
        'cnic'        => $this->request->getPost('CNIC'),
    ];

   
    $response = $apiService->put(
        'api/students/' . $id,
        $data,
        true
    );

  
    if (
        $response['statusCode'] !== 200 &&
        $response['statusCode'] !== 204
    ) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Unable to update student.'
            );
    }

    /*
     * Update successful
     */
    return redirect()
        ->to('/students')
        ->with(
            'success',
            'Student updated successfully.'
        );
}

public function delete($id)
{
    // Check student exists
    $student = $this->studentModel->find($id);

    if (!$student) {
        return $this->notFound('Student not found.');
    }

    // Delete student
    $this->studentModel->delete($id);

    return $this->successResponse(
        [],
        'Student deleted successfully.'
    );
}
}