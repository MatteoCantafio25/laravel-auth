<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('updated_at')->orderByDesc('created_at')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();

        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|min:5|max:50|unique:projects',
            'content' => 'required|string|',
            'image' => 'nullable|url|',
        ], 
        [
            'title.required' => 'Title field is required',
            'content.required' => 'Content field is required',
            'title.min' => 'Title field must be at least :min characters',
            'title.max' => 'Title field must be max :max characters',
            'title.unique' => 'There cannot be two projects with the same title',
            'image.url' => 'The URL is not valid',
        ]);

        $data = $request->all();

        $project = new Project;

        $project->fill($data);

        $project->slug = Str::slug($project->title);

        $project->save();

        return to_route('admin.projects.show', $project->id)->with('message', 'Project successfully created')->with('type', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:50', Rule::unique('projects')->ignore($project->id)],
            'content' => 'required|string|',
            'image' => 'nullable|url|',
        ], 
        [
            'title.required' => 'Title field is required',
            'content.required' => 'Content field is required',
            'title.min' => 'Title field must be at least :min characters',
            'title.max' => 'Title field must be max :max characters',
            'title.unique' => 'There cannot be two projects with the same title',
            'image.url' => 'The URL is not valid',
        ]);

        $data = $request->all();

        $project->fill($data);

        $project->slug = Str::slug($project->title);

        $project->save();

        return to_route('admin.projects.show', $project->id)->with('message', 'Project successfully modified')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('type', 'danger')->with('message', 'Project successfully deleted');
    }
}
