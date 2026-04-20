<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
        ];

        // First, delete existing admin record
        $this->db->table('admin')->truncate();

        // Then insert new one
        $this->db->table('admin')->insert($data);
    }
}
