<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClassModel;

class Test extends BaseController
 {
    public function users()
 {
        $model = new UserModel();

        $data[ 'users' ] = $model->findAll();

        echo '<h2>Users Table Data</h2>';

        echo '<pre>';
        print_r( $data[ 'users' ] );
        echo '</pre>';
    }

    public function classes()
 {
        $model = new ClassModel();

        $data = $model->findAll();

        echo '<h2>Classes Table Data</h2>';

        echo '<pre>';
        print_r( $data );
        echo '</pre>';
    }

public function verifyHash()
{

       echo password_hash('123456', PASSWORD_DEFAULT);

}

    public function students()
 {
        $model = new \App\Models\StudentModel();

        $students = $model->findAll();

        echo '<h2>Students Table Data</h2>';

        echo '<pre>';
        print_r( $students );
        echo '</pre>';
    }

    public function subjects()
 {
        $model = new \App\Models\SubjectModel();

        $subjects = $model->findAll();

        echo '<h2>Subjects Table Data</h2>';

        echo '<pre>';
        print_r( $subjects );
        echo '</pre>';
    }
}