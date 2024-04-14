<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('menu')->insert([
            [
                'naam'=> 'Klassieke Hamburger',
                'beschrijving'=> 'Een hamburger met kaas, sla, tomaat en onze speciale saus.',
                'prijs'=> 8.99,
            ],
            [
                'naam'=> 'Veggie Burger',
                'beschrijving'=> 'Een hamburger met kaas, sla, tomaat en onze speciale saus.',
                'prijs'=> 9.99,
            ],
        ]);
    }
}
