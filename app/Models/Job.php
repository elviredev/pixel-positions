<?php

namespace App\Models;

use Database\Factories\JobFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    /** @use HasFactory<JobFactory> */
    use HasFactory;

   public function employer(): BelongsTo
   {
      return $this->belongsTo(Employer::class);
   }
}
