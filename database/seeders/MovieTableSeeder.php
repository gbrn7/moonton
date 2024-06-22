<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movie =  [
            [
                'name' => 'The Shawshank Redemption',
                'slug' => 'the-shawshank-redemption',
                'category_id' => 1,
                'sub_category_id' => 1,
                'description' => 'lorem',
                'video_url' => "https://www.youtube.com/watch?v=qL2zdp765cw",
                'thumbnail' => "https://cdn.pixabay.com/photo/2024/05/15/12/31/lake-8763490_1280.jpg",
                'rating' => '4.4',
                'is_featured' => true
            ],
            [
                'name' => 'The Godfather',
                'slug' => 'the-godfather',
                'category_id' => 1,
                'sub_category_id' => 1,
                'description' => 'lorem',
                'video_url' => "https://www.youtube.com/watch?v=qL2zdp765cw",
                'thumbnail' => "https://cdn.pixabay.com/photo/2024/05/15/12/31/lake-8763490_1280.jpg",
                'rating' => '4.1',
                'is_featured' => false
            ],
            [
                'name' => 'The Godfather Part II',
                'slug' => 'the-godfather-part-ii',
                'category_id' => 1,
                'sub_category_id' => 1,
                'description' => 'lorem',
                'video_url' => "https://www.youtube.com/watch?v=qL2zdp765cw",
                'thumbnail' => "https://cdn.pixabay.com/photo/2024/05/15/12/31/lake-8763490_1280.jpg",
                'rating' => '4.1',
                'is_featured' => false

            ],
        ];

        Movie::insert($movie);
    }
}
