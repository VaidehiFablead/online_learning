<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentsTable extends Migration
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
            'enrollment_id' =>
            [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'stripe_id' =>
            [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'amount' =>
            [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'currency' =>
            [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'default' => 'usd'
            ],
            'status' =>
            [
                'type' => 'ENUM',
                'constraint' => ['success', 'failed', 'pending'],
                'default' => 'pending'
            ],
            'created_at' =>
            [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('enrollment_id', 'enrollments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payments');
    }

    public function down()
    {
        //
    }
}
