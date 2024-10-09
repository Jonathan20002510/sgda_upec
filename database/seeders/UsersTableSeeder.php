<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Super Administradores
        User::create([
            'identification'=> '0402075879',
            'lastname'=> '',
            'name'=> 'SUPER ADMINISTRADOR',
            'email'=> 'super_admin@gmail.com',
            'password'=> bcrypt('superadmin'),
            'rol'=> -1,
            'departament_id' => 1,
            'treatment_id'=>1,
            'position_id'=>1

        ]);
        //Usuario Administrador 
        User::create([
            'identification'=> '01254125896',
            'lastname'=> 'Orbe Lucero',
            'name'=> 'Jonathan Miguel ',
            'email'=> 'jonathan.orbe@upec.edu.ec',
            'password'=> bcrypt('admin'),
            'rol'=> 0,
            'departament_id' => 2,
            'treatment_id'=>1,
            'position_id'=>1

        ]);
        //Administrador
        User::create([
            'identification'=> '04125412563',
            'lastname'=> 'Calpa Cuaical',
            'name'=> 'Hector Andres',
            'email'=> 'hector.calpa@gmail.com',
            'password'=> bcrypt('admin'),
            'rol'=> 0,
            'departament_id' => 2,
            'treatment_id'=>1,
            'position_id'=>1

        ]);
        //Funcionario
        User::create([
            'identification'=> '0425968754',
            'lastname'=> 'Lopez Perez',
            'name'=> 'Juan Mario',
            'email'=> 'juan.mario@gmail.com',
            'password'=> bcrypt('admin'),
            'rol'=> 2,
            'departament_id' => 2,
            'treatment_id'=>1,
            'position_id'=>1

        ]);

        User::create([
            'identification'=> '09584585847',
            'lastname'=> 'Lopez Perez',
            'name'=> 'Paola Camila',
            'email'=> 'paola.camila@gmail.com',
            'password'=> bcrypt('admin'),
            'rol'=> 2,
            'departament_id' => 3,
            'treatment_id'=>1,
            'position_id'=>1

        ]);
    }
}
