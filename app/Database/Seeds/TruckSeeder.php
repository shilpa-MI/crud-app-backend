<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class TruckSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) { //to add 10 clients. Change limit as desired
            $this->db->table('truck')->insert($this->generateTruck());
        }
    }

    private function generateTruck(): array
    {
        $faker = Factory::create();
        return [
            'name' => $faker->name(),
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'status_id' => 1,
        ];
    }
}
