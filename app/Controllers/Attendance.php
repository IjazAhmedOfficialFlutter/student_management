<?php

namespace App\Controllers;

use App\Models\AttendanceModel;
use App\Models\ClassModel;
use App\Models\StudentModel;

class Attendance extends BaseController
{

    public function index()
    {
        $classModel = new ClassModel();

        $data = [
            'title'   => 'Attendance',
            'classes' => $classModel->findAll(),
        ];

        return view('attendance/index', $data);
    }

   public function mark()
{
    $classID = $this->request->getGet('ClassID');
    $date    = $this->request->getGet('AttendanceDate') ?? date('Y-m-d');

    if (!$classID) {
        return redirect()->to('attendance')
            ->with('error', 'Please select a class.');
    }

    $classModel      = new ClassModel();
    $studentModel    = new StudentModel();
    $attendanceModel = new AttendanceModel();

    $class = $classModel->find($classID);

    if (!$class) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $students = $studentModel
        ->where('ClassID', $classID)
        ->findAll();

    $existing = $attendanceModel
        ->where('ClassID', $classID)
        ->where('AttendanceDate', $date)
        ->findAll();

    // Map attendance by StudentID
    $existingMap = [];

    foreach ($existing as $row) {
        $existingMap[$row['StudentID']] = $row['Status'];
    }

    // Attendance Summary
    $presentCount = 0;
    $absentCount  = 0;
    $lateCount    = 0;

    foreach ($existing as $row) {

        switch ($row['Status']) {

            case 'Present':
                $presentCount++;
                break;

            case 'Absent':
                $absentCount++;
                break;

            case 'Late':
                $lateCount++;
                break;
        }
    }

    $data = [
        'title'         => 'Mark Attendance - ' . $class['ClassName'],
        'class'         => $class,
        'students'      => $students,
        'date'          => $date,
        'existingMap'   => $existingMap,

        // Summary Cards
        'presentCount'  => $presentCount,
        'absentCount'   => $absentCount,
        'lateCount'     => $lateCount,
    ];

    return view('attendance/mark', $data);
}
    public function store()
    {
        $attendanceModel = new AttendanceModel();

        $classID = $this->request->getPost('ClassID');
        $date    = $this->request->getPost('AttendanceDate');
        $status  = $this->request->getPost('Status'); // array: [StudentID => 'Present'/'Absent']

        if (!$classID || !$date || empty($status)) {
            return redirect()->back()->with('error', 'Missing attendance data.');
        }

        foreach ($status as $studentID => $value) {

            $existing = $attendanceModel
                ->where('StudentID', $studentID)
                ->where('AttendanceDate', $date)
                ->first();

            if ($existing) {
                $attendanceModel->update($existing['AttendanceID'], [
                    'Status' => $value,
                ]);
            } else {
                $attendanceModel->save([
                    'StudentID'      => $studentID,
                    'ClassID'        => $classID,
                    'AttendanceDate' => $date,
                    'Status'         => $value,
                ]);
            }
        }

        return redirect()->to('attendance/mark?ClassID='.$classID.'&AttendanceDate='.$date)
            ->with('success', 'Attendance saved successfully.');
    }

    public function history()
    {
        $classID = $this->request->getGet('ClassID');
        $date    = $this->request->getGet('AttendanceDate');

        $data = [
            'title'   => 'Attendance History',
            'records' => [],
            'classID' => $classID,
            'date'    => $date,
        ];

        if ($classID && $date) {
            $attendanceModel = new AttendanceModel();

            $data['records'] = $attendanceModel
                ->select('Attendance.*, Students.StudentName, Students.RollNo')
                ->join('Students', 'Students.StudentID = Attendance.StudentID')
                ->where('Attendance.ClassID', $classID)
                ->where('Attendance.AttendanceDate', $date)
                ->findAll();
        }

        $classModel = new ClassModel();
        $data['classes'] = $classModel->findAll();

        return view('attendance/history', $data);
    }
}