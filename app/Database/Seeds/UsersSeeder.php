<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Hash password 'user'
        $password = password_hash('user', PASSWORD_DEFAULT);

        // Data pengguna
        $data = [
            'username' => 'user@helpdesk.com',
            'password' => $password,
            'role' => 'user'  // Role pengguna (bisa 'user', 'admin', dsb)
        ];

        // Menyimpan data pengguna ke tabel 'users'
        $this->db->table('users')->insert($data);
    }
}
