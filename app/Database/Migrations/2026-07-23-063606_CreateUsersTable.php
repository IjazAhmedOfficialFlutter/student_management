<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'UserID' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'FullName' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'Email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'Password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'Role' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'Teacher',
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
        $this->forge->addKey('UserID', true);

        // Unique Email
        $this->forge->addUniqueKey('Email');

        // Create Table
        $this->forge->createTable('Users');
    }

    public function down()
    {
        $this->forge->dropTable('Users');
    }
}