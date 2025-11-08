<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnrollmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' =>
            [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'student_id' =>
            [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'course_id' =>
            [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'payment_id' =>
            [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'amount' =>
            [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00
            ],
            'status' =>
            [
                'type' => 'ENUM',
                'constraint' => ['pending', 'paid', 'completed'],
                'default' => 'pending'
            ],
            'created_at' =>
            [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('student_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('course_id', 'courses', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('enrollments');
    }

    public function down()
    {
        //
    }
}
