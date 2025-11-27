<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Review;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        User::create(['name' => 'Admin', 'email' => 'admin@admin.com', 'is_admin' => true, 'password' => 'admin']);

        $tags = [
            ['name' => "Coding Tool", 'color' => "#4F46E5"],
            ['name' => "Library", 'color' => "#0EA5E9"],
            ['name' => "Framework", 'color' => "#10B981"],
            ['name' => "Documentation", 'color' => "#F59E0B"],
            ['name' => "Editor", 'color' => "#EC4899"],
            ['name' => "Editor Extension", 'color' => "#8B5CF6"],
            ['name' => "Browser Extension", 'color' => "#3B82F6"],
            ['name' => "Productivity", 'color' => "#EF4444"],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }


        Review::factory(10)->create();
        $projects = Project::factory(20)->create();

        // Associate Projects with Tags
        $projects->each(function ($project) {
            $nr_tags = random_int(0, 7);
            $tag_list = [];

            for ($i = 0; $i < $nr_tags; $i++) {
                $tag_list[] = random_int(0, 7);
            }

            $project->tags()->attach($tag_list);
        });
    }
}
