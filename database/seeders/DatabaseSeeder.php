<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@laravel.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@laravel.com',
            'password' => Hash::make('user'),
            'role' => 'customer',
        ]);

        $this->call([
            ItemsSeeder::class,
            WarehousesSeeder::class
        ]);
    }
}
