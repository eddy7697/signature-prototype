<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate();
        User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'ADMIN',
            'name' => 'Administrator'
        ]);
    }
}
