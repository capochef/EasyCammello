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
            'email' => 'antonio@easystaff.it',
            'password' => Hash::make('Easy2020!'),
            'admin' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'michele',
            'email' => 'michele@easystaff.it',
            'password' => Hash::make('Easy2020!'),
            'admin' => 0,
        ]);
        DB::table('users')->insert([
            'name' => 'montse',
            'email' => 'montse@easystaff.it',
            'password' => Hash::make('Easy2020!'),
            'admin' => 0,
        ]);
        DB::table('users')->insert([
            'name' => 'sara',
            'email' => 'sara@easystaff.it',
            'password' => Hash::make('Easy2020!'),
            'admin' => 0,
        ]);
        DB::table('users')->insert([
            'name' => 'elena',
            'email' => 'elena@easystaff.it',
            'password' => Hash::make('Easy2020!'),
            'admin' => 0,
        ]);
        DB::table('users')->insert([
            'name' => 'elisabetta',
            'email' => 'elisabetta@easystaff.it',
            'password' => Hash::make('Easy2020!'),
            'admin' => 0,
        ]);
        DB::table('users')->insert([
            'name' => 'fabio',
            'email' => 'fabio@easystaff.it',
            'password' => Hash::make('Easy2020!'),
            'admin' => 0,
        ]);
        DB::table('users')->insert([
            'name' => 'giulia',
            'email' => 'giulia@easystaff.it',
            'password' => Hash::make('Easy2020!'),
            'admin' => 0,
        ]);
        DB::table('users')->insert([
            'name' => 'domenico',
            'email' => 'domenico@easystaff.it',
            'password' => Hash::make('Easy2020!'),
            'admin' => 0,
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
