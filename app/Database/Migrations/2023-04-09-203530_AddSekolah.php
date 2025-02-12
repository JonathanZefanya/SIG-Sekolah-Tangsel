<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSekolah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'sek_npsn' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'unique'         => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
            'sek_nama' => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'sek_status' => [
                'type'           => 'ENUM',
                'constraint'     => ['negeri', 'swasta'],
            ],
            'sek_jenjang' => [
                'type'           => 'ENUM',
                'constraint'     => ['sd', 'smp', 'sma'],
            ],
            'sek_alamat' => [
                'type'           => 'TEXT',
            ],
            'kel_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'kec_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'sek_lokasi' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
        ]);
        $this->forge->addKey('sek_npsn', true);
        $this->forge->addForeignKey('user_id', 'user', 'user_id');
        $this->forge->addForeignKey('kel_id', 'kelurahan', 'kel_id');
        $this->forge->addForeignKey('kec_id', 'kecamatan', 'kec_id');
        $this->forge->createTable('sekolah');
    }

    public function down()
    {
        $this->forge->dropTable('sekolah');
    }
}
