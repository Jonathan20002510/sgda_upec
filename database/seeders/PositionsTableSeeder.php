<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create(['name'=> 'RESPONSABLE DE ARCHIVO CENTRAL','representative'=>1]);
        
        Position::create(['name'=> 'SECRETARIA GENERAL','representative'=>1]);

        Position::create(['name'=> 'RESPONSABLE DE ADMISIÓN Y REGISTRO','representative'=>1]);

        Position::create(['name'=> 'ANALISTA JURÍDICO','representative'=>1]);

        
    }
}
