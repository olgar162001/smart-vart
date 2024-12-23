<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Regions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Regions = [
            ['name' => 'Dar es salaam',],
            ['name' => 'Mwanza',],
            ['name' => 'Tabora',],
            ['name' => 'Morogoro',],
            ['name' => 'Dodoma',],
            ['name' => 'Kagera',],
            ['name' => 'Geita',],
            ['name' => 'Tanga',],
            ['name' => 'Kigoma',],
            ['name' => 'Mara',],
            ['name' => 'Arusha',],
            ['name' => 'Mbeya',],
            ['name' => 'Shinyanga',],
            ['name' => 'Simiyu',],
            ['name' => 'Pwani',],
            ['name' => 'Singida',],
            ['name' => 'Manyara',],
            ['name' => 'Kilimanjaro',],
            ['name' => 'Ruvuma',],
            ['name' => 'Mtwara',],
            ['name' => 'Rukwa',],
            ['name' => 'Songwe',],
            ['name' => 'Lindi',],
            ['name' => 'Iringa',],
            ['name' => 'Katavi',],
            ['name' => 'Zanzibar',],
            ['name' => 'Njombe',],
            ['name' => 'Pemba Kaskazini',],
            ['name' => 'Pemba Kusini',],
            ['name' => 'Unguja Kaskazini',],
            ['name' => 'Unguja Kusini',]
        ];

        foreach($Regions as $Region){
            Region::create($Region);
        }
    }
}
