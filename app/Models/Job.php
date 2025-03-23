<?php

namespace App\Models;

use Database\Factories\JobFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job extends Model
{
    /** @use HasFactory<JobFactory> */
    use HasFactory;

   public function tag(string $name): void
   {
      // Trouve le tag ou le crée s'il n'existe pas
      $tag = Tag::firstOrCreate(['name' => $name]);

      // Attache le tag au job
      $this->tags()->attach($tag);
   }

   public function tags(): BelongsToMany
   {
      return $this->belongsToMany(Tag::class);
   }

   public function employer(): BelongsTo
   {
      return $this->belongsTo(Employer::class);
   }
}
