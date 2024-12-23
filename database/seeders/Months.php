<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Months extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Months = [
            ['name' => 'January',],
            ['name' => 'February',],
            ['name' => 'March',],
            ['name' => 'April',],
            ['name' => 'May',],
            ['name' => 'June',],
            ['name' => 'July',],
            ['name' => 'August',],
            ['name' => 'September',],
            ['name' => 'October',],
            ['name' => 'November',],
            ['name' => 'December',],
        ];

        foreach($Months as $Month){
            Month::create($Month);
        }
        
    }

}
