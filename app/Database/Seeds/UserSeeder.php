<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data1 = [
            'user_name'     => 'administrator',
            'user_email'    => 'admin@sekolah.com',
            'user_password' => password_hash('admin123', PASSWORD_BCRYPT),
            'user_akses'    => 'admin',
        ];

        $data2 = [
            'user_name'     => 'dinas',
            'user_email'    => 'dinas@sekolah.com',
            'user_password'=> password_hash('dinas123', PASSWORD_BCRYPT),
            'user_akses'    => 'dinas',
        ];

        $data3 = [
            'user_name'     => 'sekolah',
            'user_email'    => 'sekolah@sekolah.com',
            'user_password'=> password_hash('sekolah123', PASSWORD_BCRYPT),
            'user_akses'    => 'sekolah',
        ];
            
        $this->db->table('user')->insert($data1);
        $this->db->table('user')->insert($data2);
        $this->db->table('user')->insert($data3);
    }
}
