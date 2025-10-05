<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filename = Str::random(10).'.jpg';

        return [
            'disk' => 'public',
            'path' => "uploads/avatars/{$filename}",
            'original_name' => $filename,
            'mime' => 'image/jpeg',
            'size' => fake()->numberBetween(50_000, 2_000_000),
            'alt' => fake()->sentence(),
            'is_primary' => true
        ];
    }

    public function forImageable(Model $model): static
    {
        return $this->state(fn () => [
            'imageable_id' => $model->getKey(),
            'imageable_type' => $model->getMorphClass(),
        ]);
    }
}
