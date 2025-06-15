<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddResetTokenToUsers extends Migration
{
    public function up()
    {
        if (! $this->db->fieldExists('reset_token', 'users')) {
            $this->forge->addColumn('users', [
                'reset_token' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ],
                'reset_expires' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('reset_token', 'users')) {
            $this->forge->dropColumn('users', ['reset_token', 'reset_expires']);
        }
    }
}
