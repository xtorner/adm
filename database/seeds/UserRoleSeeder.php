<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Roles
        DB::table('user_roles')->insert(['name' => 'SuperAdmin']);
        DB::table('user_roles')->insert(['name' => 'Administrador']);
        DB::table('user_roles')->insert(['name' => 'SummerMaker']);
        DB::table('user_roles')->insert(['name' => 'Usuari']);
    }
}
