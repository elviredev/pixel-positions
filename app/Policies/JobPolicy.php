<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;

class JobPolicy
{
   /**
    * Determine if the given job can be updated by the user.
    * @param  User  $user
    * @param  Job  $job
    * @return bool
    */
   public function edit(User $user, Job $job): bool
   {
      return $job->employer->user->is($user);
   }
}
