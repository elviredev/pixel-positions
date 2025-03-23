<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Créer collection de 3 tag
       $tags = Tag::factory(3)->create();

       // Créer 20 jobs et leur attacher les 3 tags
       Job::factory(20)->hasAttached($tags)->create(new Sequence([
          'featured' => false,
          'schedule' => 'Full Time'
       ], [
          'featured' => true,
          'schedule' => 'Part Time'
          ]
       ));
    }
}
