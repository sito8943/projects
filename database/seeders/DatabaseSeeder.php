<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Report;
use App\Models\Review;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Tag::create(['name' => "Coding Tool"]);
        Tag::create(['name' => "Library"]);
        Tag::create(['name' => "Framework"]);
        Tag::create(['name' => "Documentation"]);
        Tag::create(['name' => "Editor"]);
        Tag::create(['name' => "Editor Extension"]);
        Tag::create(['name' => "Browser Extension"]);
        Tag::create(['name' => "Productivity"]);


        Report::factory(10)->create();
        Review::factory(10)->create();
        $projects = Project::factory(10)->create();

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
