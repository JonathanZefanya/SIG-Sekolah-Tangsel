<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'user_name'     => 'administrator',
            'user_email'    => 'admin@sekolah.com',
            'user_password' => password_hash('admin123', PASSWORD_BCRYPT),
            'user_akses'    => 'admin',
        ];
        $this->db->table('user')->insert($data);
    }
}
