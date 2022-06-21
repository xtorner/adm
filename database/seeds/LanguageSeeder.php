<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // English
        DB::table('languages')->insert([
            'name' => 'Anglès',
            'locale' => 'en',
        ]);

        // Catalan
        DB::table('languages')->insert([
            'name' => 'Català',
            'locale' => 'ca',
        ]);

        // Spanish
        DB::table('languages')->insert([
            'name' => 'Castellà',
            'locale' => 'es',
        ]);

    }
}
