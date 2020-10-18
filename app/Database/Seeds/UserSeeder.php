<?php

namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $data = [];
        $data[] = [
            'first_name' => 'Administrador',
            'last_name' => 'Principal',
            'username' => 'admin',
            'email' => 'admin@email.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT)
        ];
        $this->db->table('users')->insertBatch($data);
    }
}