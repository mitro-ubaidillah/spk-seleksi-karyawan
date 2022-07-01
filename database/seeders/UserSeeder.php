<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
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
        User::truncate();
        $user = [
            [
            'name'              =>  'Admin',
            'level'             =>  'admin',
            'username'          =>  'admin123',
            'password'          =>  bcrypt('admin123'),
            'remember_token'    =>  Str::random(60),
            ],
            [
            'name'              =>  'Pegawai',
            'level'             =>  'pegawai',
            'username'          =>  'pegawai',
            'password'          =>  bcrypt('12345'),
            'remember_token'    =>  Str::random(60),
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}