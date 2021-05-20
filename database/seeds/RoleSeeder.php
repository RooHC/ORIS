<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'profesor',
            'display_name' => 'Profesor',
        ]);

        DB::table('roles')->insert([
            'name' => 'alumno',
            'display_name' => 'Alumno',
        ]);
    }
}
