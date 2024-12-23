<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Roles = [
            ['name' => 'Super_admin',],
            ['name' => 'Yana_admin',],
            ['name' => 'Admin',],
            ['name' => 'Auditor',],
            ['name' => 'Seller',]
        ];

        foreach($Roles as $Role){
            Role::create($Role);
        }
    }
}
