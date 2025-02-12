<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKecamatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kec_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kec_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
        ]);
        $this->forge->addKey('kec_id', true);
        $this->forge->createTable('kecamatan');
    }

    public function down()
    {
        $this->forge->dropTable('kecamatan');
    }
}
