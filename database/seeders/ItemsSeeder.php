<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Item::factory()->count(5)->create();

        $user = User::first();

        if ($user) {
            Item::factory()->count(10)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
