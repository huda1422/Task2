<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country; 

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create(['name' => 'KSA', 'image' => 'images/ksa.png']); 
        Country::create(['name' => 'United Kingdom', 'image' => 'images/uk.png']);
    }
}
