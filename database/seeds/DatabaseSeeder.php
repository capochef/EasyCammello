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
        DB::table('users')->insert([
            'name' => 'antonio',
            'email' => 'antoniomuzzolini@yahoo.it',
            'password' => Hash::make('a2IMc5gS!'),
            'admin' => 1,
        ]);
        DB::table('clients')->insert([
            'name' => 'UniDemo'
        ]);
        DB::table('competitors')->insert([
            'name' => 'Gianni',
            'category' => 'nessuna',
            'client_id' => 1
        ]);
        DB::table('events')->insert([
            'description' => 'evento1',
            'points' => 10,
            'competitor_id' => 1,
            'modified_by' => 1,
        ]);
    }
}
