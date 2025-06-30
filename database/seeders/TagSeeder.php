<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared('SET FOREIGN_KEY_CHECKS=0'); // Disable foreign key checks
        DB::table('tags')->truncate(); // Clear existing tags
        DB::unprepared('SET FOREIGN_KEY_CHECKS=1'); // Enable foreign key checks

        $tags =[
            'Laravel',
            'PHP',
            'JavaScript',
            'Vue.js',
            'React',
            'Node.js',
            'HTML',
            'CSS',
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'API',
            'RESTful',
            'GraphQL',
            'Web Development',
            'Frontend',
            'Backend',
            'Full Stack',
            'Software Engineering',
            'DevOps',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag
            ]);

        }
    }
}
