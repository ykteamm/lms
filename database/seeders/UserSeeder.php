<?php

namespace Database\Seeders;

use app\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::truncate();
        User::create([
            'first_name'=>'Abrorbek',
            'last_name'=>'Toshpolatov',
            'birthday'=>'2003-07-13',
            'region_id'=>10,
            'district_id'=>143,
            'phone' => '+998948170713',
            'image'=>'users/admin.png',
            'passport_image'=>'passport/pass.pdf',
            'status'=>0,
            'rol_id' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);
    }
}
