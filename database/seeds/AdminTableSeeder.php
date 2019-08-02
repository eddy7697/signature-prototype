<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::query()->truncate();
        Admin::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'ADMIN',
            'name' => 'Administrator'
        ]);
    }
}
