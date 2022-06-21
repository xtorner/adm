<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = DB::table('user_roles')->where('name', 'SuperAdmin')->first();
        $admin = DB::table('user_roles')->where('name', 'Administrador')->first();
        $summerMaker = DB::table('user_roles')->where('name', 'SummerMaker')->first();
        $user = DB::table('user_roles')->where('name', 'Usuari')->first();

        // Default Administrator
        DB::table('users')->insert([
            'fullname' => 'SuperAdmin',
            'username' => 'SuperAdmin',
            'password' => Hash::make('12345678'),
            'role_id' => $superAdmin->id,
        ]);

        // Default Administrator
        DB::table('users')->insert([
            'fullname' => 'Administrador',
            'username' => 'Administrador',
            'password' => Hash::make('12345678'),
            'role_id' => $admin->id,
        ]);

        // Default SummerMaker
        DB::table('users')->insert([
            'fullname' => 'SummerMaker',
            'username' => 'SummerMaker',
            'password' => Hash::make('12345678'),
            'role_id' => $summerMaker->id,
        ]);

        // Default SummerMaker
        DB::table('users')->insert([
            'fullname' => 'Usuari',
            'username' => 'Usuari',
            'password' => Hash::make('12345678'),
            'role_id' => $user->id,
        ]);

    }
}
