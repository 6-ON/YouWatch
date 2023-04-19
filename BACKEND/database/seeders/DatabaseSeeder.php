<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'email' => 'amin@test.com',
            'username' => 'amine',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'name' => 'amine',
        ]);

        $videos = json_decode(Storage::disk('local')->get('/data/videos.json'), true);
        foreach ($videos as $video) {
            \App\Models\Video::factory(1)->create([
                'url' => $video['video'],
                'thumbnail_url' => $video['thumbnail']
            ]);
        }
    }
}
