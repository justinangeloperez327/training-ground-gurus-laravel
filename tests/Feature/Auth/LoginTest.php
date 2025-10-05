<?php

use App\Models\User;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use Illuminate\Support\Facades\Hash;

it('displays login page', function (){
    get('/login')
    ->assertOk()
    ->assertSeeText("Welcome Back");
});

it('logins the user', function () {
    User::factory()->create([
        'name' => 'Justin',
        'email' => 'justin@gmail.com',
        'password' => Hash::make('justinjustin')
    ]);

    post('login', [
        'email' => 'justin@gmail.com',
        'password' => "justinjustin"
    ])
    ->assertRedirect('/dashboard')
    ->assertSessionHas('success');
});

it('does not logins the user', function () {
    User::factory()->create([
        'name' => 'Justin',
        'email' => 'justin@gmail.com',
        'password' => Hash::make('justinjustin')
    ]);

    post('login', [
        'email' => 'justin@gmail.com',
        'password' => "justin"
    ])
    ->assertRedirectBackWithErrors('email');
});
