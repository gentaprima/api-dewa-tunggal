<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_users')->insert(
            [
                [
                    'email' => "admin@gmail.com",
                    'nama_lengkap' => "Admin",
                    'password' => Hash::make('admin'),
                    'role' => 1,
                ]
            ]
               
        );
    }
}
