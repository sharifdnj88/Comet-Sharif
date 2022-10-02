<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\admin;
use Illuminate\Database\Seeder;
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
         admin::create([
            'name'          =>'Sharif',
            'email'          =>'sharif@gmail.com',
            'mobile'        =>'01889045088',
            'password'     =>Hash::make('said'),
        ]);
    }
}
