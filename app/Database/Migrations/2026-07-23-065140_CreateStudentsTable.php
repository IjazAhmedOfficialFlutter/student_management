<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'StudentID' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'RollNo' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],

            'StudentName' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'FatherName' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'Email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'Phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],

            'Gender' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],

            'DOB' => [
                'type' => 'DATE',
            ],

            'Address' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'Photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'ClassID' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'CreatedAt' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'UpdatedAt' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        // Primary Key
        $this->forge->addKey('StudentID', true);

        // Unique Roll Number
        $this->forge->addUniqueKey('RollNo');

        // Foreign Key
        $this->forge->addForeignKey(
            'ClassID',
            'Classes',
            'ClassID',
            'CASCADE',
            'CASCADE'
        );

        // Create Table
        $this->forge->createTable('Students');
    }

    public function down()
    {
        $this->forge->dropTable('Students');
    }
}