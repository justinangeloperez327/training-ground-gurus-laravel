<?php

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('displays register page', function () {
    get('/register')
        ->assertOk()
        ->assertSeeText('Create Account');
});

it('register the user', function () {
    post('register', [
        'name' => 'Justin',
        'email' => 'justin@gmail.com',
        'password' => 'justinjustin',
        'password_confirmation' => 'justinjustin',
    ])
        ->assertRedirect('/dashboard')
        ->assertSessionHas('success');
});
