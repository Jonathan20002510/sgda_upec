<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departament;
class DepartamentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departament::create([
            'name'=> 'Secretaría General',
            'father_departament_id'=> 1,
            'identifier'=>'Sec'
           

        ]);

        Departament::create([
            'name'=> 'Admisión y registro',
            'father_departament_id'=> 1,
            'identifier'=>'Adm. y Reg'
           

        ]);
        Departament::create([
            'name'=> 'Archivo Central',
            'father_departament_id'=> 1,
            'identifier'=>'Arch. Cent.'
        ]);
    }
}
