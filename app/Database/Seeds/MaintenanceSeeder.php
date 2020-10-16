<?php

namespace App\Database\Seeds;

class MaintenanceSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $data = [];
        for($i = 1; $i <= 20; $i ++) {
            $data[] = [
                'folio' => $faker->postcode,
                'client' => $faker->name,
                'model' => $faker->stateAbbr,
                'checkin' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'priority' => $faker->randomDigitNot(5)
            ];
        }

        $this->db->table('maintenances')->insertBatch($data);
    }
}