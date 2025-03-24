<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;


class TagController extends Controller
{
   /**
    * @desc Search jobs for this tag
    * @route GET /tags/{tag:name}
    * @param  Tag  $tag
    * @return Factory|View|Application|\Illuminate\View\View|object
    */
   public function __invoke(Tag $tag)
   {
      return view('results', ['jobs' => $tag->jobs]);
   }
}
