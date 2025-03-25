<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
 /**
  * @desc Display a listing of the resource.
  * @route GET /
  */
 public function index()
 {
    $jobs = Job::latest()->with(['employer', 'tags'])
       ->get()->groupBy('featured');

    return view('jobs.index', [
      'jobs' => $jobs[0],
      'featuredJobs' => $jobs[1],
      'tags' => Tag::all(),
     ]);
 }

 /**
  * @desc Show the form for creating a new resource.
  * @route GET /jobs/create
  */
 public function create()
 {
     return view('jobs.create');
 }

 /**
  * @desc Store a newly created resource in storage.
  * @route POST /jobs
  */
 public function store(Request $request)
 {
    // valider les données
    $attributes = $request->validate([
       'title' => ['required', 'min:3'],
       'salary' => ['required'],
       'location' => ['required'],
       'schedule' => ['required', Rule::in( ['Part Time', 'Full Time'])],
       'url' => ['required', 'url'],
       'tags' => ['nullable']
    ]);
    // dépend de la valeur courante dans la checkbox si cochée.
    $attributes['featured'] = $request->has('featured');

    // Créer un nouveau job en bdd pour le user authentifié
    // l'id de cet employer sera automatiquement défini
    // Besoin de tous les attributs sauf les tags
    $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

    // Si pas de tags
    if ($attributes['tags'] ?? false) {
       // laravel,backend,frontend => ['laravel', 'backend', 'frontend']
       foreach (explode(',', $attributes['tags']) as $tag) {
          // Créer un nouveau tag
          $job->tag($tag);
       }
    }

    return redirect('/');
 }

 /**
  * @desc Display the specified resource.
  * @route GET /job/{job}
  */
 public function show(Job $job)
 {
     return view('jobs.show', compact('job'));
 }

 /**
  * @desc Show the form for editing the specified resource.
  * @route GET /jobs/{job}/edit
  */
 public function edit(Job $job)
 {
    return view('jobs.edit', ['job' => $job]);
 }

 /**
  * @desc Update the specified resource in storage.
  * @route PATCH /jobs/{job}
  */
 public function update(Request $request, Job $job)
 {
    $attributes = $request->validate([
     'title' => ['required', 'min:3'],
     'salary' => ['required'],
     'location' => ['required'],
     'schedule' => ['required', Rule::in( ['Part Time', 'Full Time'])],
     'url' => ['required', 'url'],
     'tags' => ['nullable']
    ]);

    $attributes['featured'] = $request->has('featured');

    // Mise à jour du job (sauf les tags)
    $job->update(Arr::except($attributes, 'tags'));

    // Mise à jour des tags
    if (!empty($attributes['tags'])) {
       // Convertir la chaîne en tableau et on supprime les espaces superflus
       $tags = array_map('trim', explode(',', $attributes['tags']));

       // Trouver ou créer des tags
       $tagIds = [];
       foreach ($tags as $tagName) {
          // Chercher chaque tag en BDD et récupérer leur ID
          $tag = Tag::firstOrCreate(['name' => $tagName]);
          $tagIds[] = $tag->id;
       }

       // Synchroniser les tags du job (supprime les anciens et ajoute les nouveaux)
       $job->tags()->sync($tagIds);
    } else {
       // Si aucun tag n'est envoyé, on supprime tous les tags existants
       $job->tags()->detach();
    }

    // Supprimer les tags qui ne sont plus associés à aucun job
    Tag::doesntHave('jobs')->delete();

    return redirect('/jobs/' . $job->id)->with('success', 'Job updated successfully!');
 }

 /**
  * @desc Remove the specified resource from storage.
  * @route DELETE /jobs/{$job}
  */
 public function destroy(Job $job)
 {
    // Détacher les relations (tags)
    $job->tags()->detach();

    // Supprimer le job
    $job->delete();

    // Supprimer les tags orphelins
    Tag::doesntHave('jobs')->delete();

     return redirect('/')
        ->with('success', 'Job deleted successfully!');
 }
}
