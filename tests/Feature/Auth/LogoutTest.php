<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

it('logouts the user', function () {
    $user = User::factory()->create([
        'name' => 'Justin',
        'email' => 'justin@gmail.com',
        'password' => Hash::make('justinjustin'),
    ]);

    actingAs($user);

    post('/logout')
        ->assertRedirect('/');
});
