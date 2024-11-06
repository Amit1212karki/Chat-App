<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'f_name' => 'user',
            'l_name' => 'test',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'f_name' => 'test',
            'l_name' => 'user',
            'email' => 'test@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('password'),
        ]);
    }
}
