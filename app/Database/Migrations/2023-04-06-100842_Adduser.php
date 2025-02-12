<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Adduser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'user_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'user_password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'user_akses' => [
                'type'       => 'ENUM',
                'constraint' => ['sekolah', 'admin', 'dinas'],
            ],
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
