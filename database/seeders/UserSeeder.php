<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

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
        $user = User::create([
            'name'=>'Admin',
            'email'=>'admin@test.com',
            'password'=>Hash::make('123456'),
        ]);
        $user->assignRole('Admin');
    }
}
