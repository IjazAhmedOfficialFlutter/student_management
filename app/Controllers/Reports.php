<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ClassModel;
use App\Models\AttendanceModel;
use App\Models\SubjectModel;

class Reports extends BaseController
{
    /**
     * --------------------------------------------------------
     * Reports Dashboard
     * --------------------------------------------------------
     */
    public function index()
    {
        return view('reports/index', [
            'title' => 'Reports'
        ]);
    }

    /**
     * --------------------------------------------------------
     * Student Reports
     * --------------------------------------------------------
     */


   public function student($id)
{
    $studentModel = new StudentModel();

    $student = $studentModel
        ->select('Students.*, Classes.ClassName')
        ->join('Classes', 'Classes.ClassID = Students.ClassID', 'left')
        ->find($id);

    if (!$student) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Student not found.');
    }

    // Get return URL
    $return = $this->request->getGet('return');

    return view('reports/students/detail', [
        'title'   => 'Student Report',
        'student' => $student,
        'return'  => $return,
    ]);
}
    /**
     * --------------------------------------------------------
     * Class Reports
     * --------------------------------------------------------
     */

    // Existing Report
 public function classWise()
{
    $classModel   = new ClassModel();
    $studentModel = new StudentModel();

    $classes = $classModel->findAll();

    foreach ($classes as &$class) {

        $class['StudentCount'] = $studentModel
            ->where('ClassID', $class['ClassID'])
            ->countAllResults();

    }

    return view('reports/classes/index', [

        'title'   => 'Class Reports',
        'classes' => $classes,

    ]);
}

  public function classDetail($id)
{
    $classModel   = new ClassModel();
    $studentModel = new StudentModel();

    $class = $classModel->find($id);

    if (!$class) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Class not found.');
    }

    $students = $studentModel
        ->select('Students.*, Classes.ClassName')
        ->join('Classes', 'Classes.ClassID = Students.ClassID', 'left')
        ->where('Students.ClassID', $id)
        ->orderBy('Students.RollNo', 'ASC')
        ->findAll();

    return view('reports/classes/detail', [

        'title'    => 'Class Details',
        'class'    => $class,
        'students' => $students,
        'return'   => current_url(),

    ]);
}

    /**
     * --------------------------------------------------------
     * Attendance Reports
     * --------------------------------------------------------
     */

    public function attendanceSummary()
    {
        $classModel      = new ClassModel();
        $attendanceModel = new AttendanceModel();

        $classID = $this->request->getGet('ClassID');
        $from    = $this->request->getGet('FromDate');
        $to      = $this->request->getGet('ToDate');

        $summary = [];

        if ($classID && $from && $to) {

            $studentModel = new StudentModel();

            $students = $studentModel
                ->where('ClassID', $classID)
                ->findAll();

            foreach ($students as $student) {

                $present = $attendanceModel
                    ->where('StudentID', $student['StudentID'])
                    ->where('Status', 'Present')
                    ->where('AttendanceDate >=', $from)
                    ->where('AttendanceDate <=', $to)
                    ->countAllResults();

                $absent = $attendanceModel
                    ->where('StudentID', $student['StudentID'])
                    ->where('Status', 'Absent')
                    ->where('AttendanceDate >=', $from)
                    ->where('AttendanceDate <=', $to)
                    ->countAllResults();

                $summary[] = [
                    'StudentID'   => $student['StudentID'],
                    'RollNo'      => $student['RollNo'],
                    'StudentName' => $student['StudentName'],
                    'Present'     => $present,
                    'Absent'      => $absent,
                ];
            }
        }

        return view('reports/attendance_summary', [
            'title'   => 'Attendance Summary',
            'classes' => $classModel->findAll(),
            'summary' => $summary,
            'classID' => $classID,
            'from'    => $from,
            'to'      => $to,
        ]);
    }

    // Individual Attendance Report
    public function attendanceDetail($studentID)
    {
        $attendanceModel = new AttendanceModel();

        $records = $attendanceModel
            ->where('StudentID', $studentID)
            ->orderBy('AttendanceDate', 'DESC')
            ->findAll();

        return view('reports/attendance_detail', [
            'title'   => 'Attendance Details',
            'records' => $records,
        ]);
    }

    /**
     * --------------------------------------------------------
     * Subject Reports
     * --------------------------------------------------------
     */

    public function subject($id)
    {
        $subjectModel = new SubjectModel();

        $subject = $subjectModel->find($id);

        if (!$subject) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Subject not found.');
        }

        return view('reports/subjects/detail', [
            'title'   => 'Subject Report',
            'subject' => $subject,
        ]);
    }

public function allStudents()
{
    $studentModel = new StudentModel();

    $data = [

        'title' => 'All Students',

        'students' => $studentModel
            ->select('Students.*, Classes.ClassName')
            ->join('Classes', 'Classes.ClassID = Students.ClassID', 'left')
            ->orderBy('Students.StudentName', 'ASC')
            ->paginate(15, 'students'),

        'pager' => $studentModel->pager,
    ];

    return view('reports/students/all', $data);
}

public function activeStudents()
{
    $studentModel = new StudentModel();

    $data = [

        'title' => 'Active Students Report',

        'students' => $studentModel
            ->select('Students.*, Classes.ClassName')
            ->join('Classes', 'Classes.ClassID = Students.ClassID', 'left')
            ->where('Students.Status', 'Active')
            ->orderBy('Students.StudentName', 'ASC')
            ->paginate(15, 'students'),

        'pager' => $studentModel->pager,
    ];

    return view('reports/students/active', $data);
}


public function archivedStudents()
{
    $studentModel = new StudentModel();

    $data = [

        'title' => 'Archived Students Report',

        'students' => $studentModel
                        ->select('Students.*, Classes.ClassName')
                        ->join('Classes', 'Classes.ClassID = Students.ClassID', 'left')
                        ->where('Students.Status', 'Inactive')
                        ->orderBy('Students.StudentName', 'ASC')
                        ->paginate(15, 'students'),

        'pager' => $studentModel->pager,
    ];

    return view('reports/students/archived', $data);
}
}