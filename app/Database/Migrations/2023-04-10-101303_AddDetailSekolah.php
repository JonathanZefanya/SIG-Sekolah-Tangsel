<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetailSekolah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'det_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sek_npsn' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'det_guru' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'det_siswa_p' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'det_siswa_l' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'det_akreditasi' => [
                'type'           => 'ENUM',
                'constraint'     => ['a', 'b', 'c'],
            ],
            'det_akreditasi' => [
                'type'           => 'ENUM',
                'constraint'     => ['a', 'b', 'c'],
            ],
            'det_kurikulum' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ]);
        $this->forge->addKey('det_id', true);
        $this->forge->addForeignKey('sek_npsn', 'sekolah', 'sek_npsn', '', 'CASCADE');
        $this->forge->createTable('detail_sekolah');
    }

    public function down()
    {
        $this->forge->dropTable('detail_sekolah');
    }
}
