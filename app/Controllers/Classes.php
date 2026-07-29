<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Models\StudentModel;

class Classes extends BaseController
{
    public function index()
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
            'title'   => 'Classes',
            'classes' => $classes
        ];

        return view('classes/index', $data);
    }

    public function students($id)
    {
        $classModel = new ClassModel();
        $studentModel = new StudentModel();

        $class = $classModel->find($id);

        if (!$class) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $students = $studentModel
            ->where('ClassID', $id)
            ->findAll();

        $data = [
            'title'    => $class['ClassName'],
            'class'    => $class,
            'students' => $students
        ];

        return view('classes/students', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Class',
        ];

        return view('classes/create', $data);
    }

    public function store()
    {
        $classModel = new ClassModel();

        if (!$this->validate($this->classRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $classModel->save([
            'ClassName' => $this->request->getPost('ClassName'),
        ]);

        return redirect()->to('classes')->with('success', 'Class added successfully.');
    }

    public function edit($id)
    {
        $classModel = new ClassModel();

        $class = $classModel->find($id);

        if (!$class) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Class',
            'class' => $class,
        ];

        return view('classes/edit', $data);
    }

    public function update($id)
    {
        $classModel = new ClassModel();

        $class = $classModel->find($id);

        if (!$class) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (!$this->validate($this->classRules($id))) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $classModel->update($id, [
            'ClassName' => $this->request->getPost('ClassName'),
        ]);

        return redirect()->to('classes')->with('success', 'Class updated successfully.');
    }

    public function delete($id)
    {
        $classModel = new ClassModel();
        $studentModel = new StudentModel();

        $class = $classModel->find($id);

        if (!$class) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $studentCount = $studentModel->where('ClassID', $id)->countAllResults();

        if ($studentCount > 0) {
            return redirect()->to('classes')->with('error', 'Cannot delete a class that still has enrolled students.');
        }

        $classModel->delete($id);

        return redirect()->to('classes')->with('success', 'Class deleted successfully.');
    }

   private function classRules($id = null)
{
    // Same Urdu/English regex used in Students module
    $urduRegex = '/^[\x{0600}-\x{06FF}\x{0750}-\x{077F}\x{FB50}-\x{FDFF}\x{FE70}-\x{FEFF}\x{200B}-\x{200F}0-9a-zA-Z\s,،\.\-\/]+$/u';

    $classNameRule = "required|min_length[2]|max_length[50]|regex_match[{$urduRegex}]";

    if ($id === null) {
        $classNameRule .= '|is_unique[Classes.ClassName]';
    } else {
        $classNameRule .= "|is_unique[Classes.ClassName,ClassID,{$id}]";
    }

    return [
        'ClassName' => [
            'label' => 'Class Name',
            'rules' => $classNameRule,
        ],
    ];
}
}