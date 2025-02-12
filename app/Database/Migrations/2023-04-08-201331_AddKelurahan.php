<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKelurahan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kel_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kec_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'kel_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
        ]);
        $this->forge->addForeignKey('kec_id', 'kecamatan', 'kec_id');
        $this->forge->addKey('kel_id', true);
        $this->forge->createTable('kelurahan');
    }

    public function down()
    {
        $this->forge->dropTable('kelurahan');
    }
}
