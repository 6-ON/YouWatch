<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'tags' => fake()->words(3, true),
            'duration' => fake()->time('i:s'),
            'url' => 'https://res.cloudinary.com/dgmmjsxbf/video/upload/v1673039464/samples/cld-sample-video.mp4',
            'thumbnail_url' => fake()->imageUrl(),
        ];
    }
}
