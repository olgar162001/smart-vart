<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Packages extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Packages = [
            [
                'name' => 'Basic',
                'price' => '25000',
                'duration' => '1',
                'users_no' => '2',
                'company_no' => '1',
                'color' => 'danger'
            ],
            [
                'name' => 'Standard',
                'price' => '70000',
                'duration' => '3',
                'users_no' => '4',
                'company_no' => '3',
                'color' => 'warning'
            ],
            [
                'name' => 'Pro',
                'price' => '100000',
                'duration' => '6',
                'users_no' => '8',
                'company_no' => '5',
                'color' => 'primary'
            ],
            [
                'name' => 'Premium',
                'price' => '120000',
                'duration' => '12',
                'users_no' => '12',
                'company_no' => '8',
                'color' => 'success'
            ],
        ];

        foreach($Packages as $Package){
            Package::create($Package);
        }
    }
}
