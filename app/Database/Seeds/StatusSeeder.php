<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusSeeder extends Seeder
{
	public function run()
	{
        $statuses = [
            [
                'id' => 1,
                'name' => 'Active',
                'description' => '',
            ],
            [
                'id' => 2,
                'name' => 'Inactive',
                'description' => ''
            ],
            [
                'id' => 3,
                'name' => 'Deleted',
                'description' => ''
            ],
        ];

        foreach ($statuses as $status){
            $this->db->table(' status')->insert($status);
        }

    }
}
