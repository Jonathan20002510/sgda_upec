<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Folder;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 
     * @return void
     */
    public function run()
    {
        Folder::create([
            'departament_id'=> 1,
            'name'=> 'Documentos de Secretaria General',
            'father_folder_id'=> 1
           

        ]);
       
        Folder::create([
            'departament_id'=> 2,
            'name'=> 'Admisión y registro',
            'father_folder_id'=> 1
           

        ]);

        Folder::create([
            'departament_id'=> 3,
            'name'=> 'Archivo Central',
            'father_folder_id'=> 1
           

        ]);
       
    }
}
