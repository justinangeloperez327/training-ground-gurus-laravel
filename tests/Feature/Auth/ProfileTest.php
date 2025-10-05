<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

beforeEach(function (): void {
    $this->user = User::factory()->create([
        'name' => 'Justin',
        'email' => 'justin@gmail.com',
    ]);

    actingAs($this->user);

    Storage::fake('public');
});

it('displays profile page', function (): void {
    get('/profile')
        ->assertOk()
        ->assertSeeText('Profile');
});

it('updates user profile', function (): void {
    put('/profile', [
        'name' => 'Angelo',
        'email' => 'angelo@gmail.com',
    ])
        ->assertRedirect('/profile')
        ->assertSessionHas('success');

    assertDatabaseHas('users', [
        'id' => $this->user->id,
        'name' => 'Angelo',
        'email' => 'angelo@gmail.com',
    ]);
});

it('uploads user profile avatar', function (): void {
    $file = UploadedFile::fake()->image('profile.jpg', 100, 100);

    post('/avatar', [
        'avatar' => $file,
    ])
        ->assertRedirectBack()
        ->assertSessionHas('success', 'Avatar uploaded successfully');

    Storage::disk('public')->assertExists('uploads/avatars/'.$file->hashName());
});

it('updates user profile avatar', function (): void {
    $oldFile = UploadedFile::fake()->image('profile.jpg', 100, 100);
    $oldPath = $oldFile->store('uploads/avatars', 'public');

    $this->user->images()->create([
        'disk' => 'public',
        'path' => $oldPath,
        'original_name' => 'older_avatar.jpg',
        'mime' => 'image/jpeg',
        'size' => 10000,
        'alt' => 'Old Avatar',
        'is_primary' => true,
    ]);

    $newFile = UploadedFile::fake()->image('profile.jpg', 100, 100);

    put(route('avatar.update', $this->user->image->id), [
        'avatar' => $newFile,
    ])
        ->assertRedirectBack()
        ->assertSessionHas('success', 'Avatar updated successfully');

    Storage::disk('public')->assertMissing($oldPath);
    Storage::disk('public')->assertExists('uploads/avatars/'.$newFile->hashName());
});
