<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('videos')->truncate();
        // Create 50 video records using the VideoModel factory
        Video::factory()
            ->count(50)
            ->create();
    }
}
