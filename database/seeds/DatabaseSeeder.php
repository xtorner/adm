<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserRoleSeeder::class,
            LanguageSeeder::class,
            AdmissionSeeder::class,
            // Demo
            UserSeeder::class,
        ]);
    }
}
