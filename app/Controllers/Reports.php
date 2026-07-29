<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ClassModel;
use App\Models\AttendanceModel;

class Reports extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Reports',
        ];

        return view('reports/index', $data);
    }

    // Class-wise student count report
    public function classWise()
    {
        $classModel = new ClassModel();
        $studentModel = new StudentModel();

        $classes = $classModel->findAll();

        foreach ($classes as &$class) {
            $class['StudentCount'] = $studentModel
                ->where('ClassID', $class['ClassID'])
                ->countAllResults();
        }

        $data = [
            'title'   => 'Class-wise Student Report',
            'classes' => $classes,
        ];

        return view('reports/class_wise', $data);
    }

    // Attendance summary report for a class within a date range
    public function attendanceSummary()
    {
        $classModel = new ClassModel();
        $attendanceModel = new AttendanceModel();

        $classID = $this->request->getGet('ClassID');
        $from    = $this->request->getGet('FromDate');
        $to      = $this->request->getGet('ToDate');

        $summary = [];

        if ($classID && $from && $to) {

            $studentModel = new \App\Models\StudentModel();
            $students = $studentModel->where('ClassID', $classID)->findAll();

            foreach ($students as $student) {

                $presentCount = $attendanceModel
                    ->where('StudentID', $student['StudentID'])
                    ->where('Status', 'Present')
                    ->where('AttendanceDate >=', $from)
                    ->where('AttendanceDate <=', $to)
                    ->countAllResults();

                $absentCount = $attendanceModel
                    ->where('StudentID', $student['StudentID'])
                    ->where('Status', 'Absent')
                    ->where('AttendanceDate >=', $from)
                    ->where('AttendanceDate <=', $to)
                    ->countAllResults();

                $summary[] = [
                    'StudentName' => $student['StudentName'],
                    'RollNo'      => $student['RollNo'],
                    'Present'     => $presentCount,
                    'Absent'      => $absentCount,
                ];
            }
        }

        $data = [
            'title'   => 'Attendance Summary Report',
            'classes' => $classModel->findAll(),
            'summary' => $summary,
            'classID' => $classID,
            'from'    => $from,
            'to'      => $to,
        ];

        return view('reports/attendance_summary', $data);
    }
}