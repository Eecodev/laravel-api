<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$currentUserId = Auth::user();
        // if($currentUserId == 1){
        //     $projects = Project::paginate(3);
        // } else

        $projects = Project::paginate(3);
        //$projects = Project::where('user_id', $currentUserId)->paginate();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $formData = $request->validated();
        $slug = Str::slug($formData['title'], '-');
        $formData['slug'] = $slug;
        // $userId = auth()->id();

        if($request->hasFile('image')){
            $img_path = Storage::put('images', $request->image);
            $formData['image'] = $img_path;
        }
        $project = Project::create($formData);
        if($request->has('technologies')){
            $project->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //$currentUserId = Auth::id();
        // if($currentUserId == $project->user_id || $currentUserId == 1){
        //    return view('admin.projects.show', compact('project'));

        // }
        // abort(403);

        return view('admin.projects.show', compact('project'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //$currentUserId = Auth::id();
        // if($currentUserId == $project->user_id || $currentUserId == 1){
        //    return view('admin.projects.show', compact('project'));

        // }
        // abort(403);

        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'categories', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        //$currentUserId = Auth::id();
        //if($currentUserId != $project->user_id && $currentUserId != 1){
        //   abort(403);
        // }
        //
        $formData = $request->validated();
        $formData['slug'] = $project->slug;

        if ($project->title !== $formData['title']){
            //create slug
            $slug = Str::slug($formData['title'], '-');
            //add slug to form data
            $formData['slug'] = $slug;
        }

        // $userId = auth()->id();
        if($request->hasFile('image')){
            if ($project->image) {
                Storage::delete($project->image);
            }

            $img_path = Storage::put('image', $formData['image']);
            $formData['image'] = $img_path;
        }
        $project->update($formData);
        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //$project->technologies()->detach();
        if ($project->image){
            Storage::delete($project->image);
        }

        $project->delete();
        return to_route('admin.projects.index')->with('message', "$project->title eliminato con successo");
    }
}
