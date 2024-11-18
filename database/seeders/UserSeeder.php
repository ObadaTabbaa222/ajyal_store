<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'uuid' => Str::uuid(),
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone' => '0974835874',
        ]);
        User::create([
            'name' => 'obada',
            'uuid' => Str::uuid(),
            'email' => 'obada@example.com',
            'password' => Hash::make('password'),
            'phone' => '0974835875',
        ]);
        User::create([
            'name' => 'khaled',
            'uuid' => Str::uuid(),
            'email' => 'khaled@example.com',
            'password' => Hash::make('password'),
            'phone' => '0974835876',
        ]);
    }
}
