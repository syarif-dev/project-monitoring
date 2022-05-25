<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Project;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::with(['team', 'task'])->get();

        $data = [
            'project' => $project,
            // 'team' => Team::all(),
        ];

        return view('project.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'team' => Team::all(),
        ];
        return view('project.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'client'    =>  'required',
            'team'    =>  'required',
            'start'     => 'required|date|before:end',
            'end'       => 'required|date|after:start',
        ]);

        $data = [
            'name' => $request['name'],
            'client' => $request['client'],
            'leader_id' => $request['team'],
            'start_date' => $request['start'],
            'end_date' => $request['end'],
        ];

        Project::create($data);
        Alert::success('success', 'add project successful');
        return redirect('project');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::with(['task'])->findOrFail($id);
        $data = [
            'project' => $project,
        ];
        return view('task.index',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $data = [
            'project' => $project->load(['team']),
            'team' => Team::all(),
        ];

        return view('project.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name'      => 'required',
            'client'    =>  'required',
            'team'    =>  'required',
            'start'     => 'required|date|before:end',
            'end'       => 'required|date|after:start',
        ]);

        $data = [
            'name' => $request['name'],
            'client' => $request['client'],
            'leader_id' => $request['team'],
            'start_date' => $request['start'],
            'end_date' => $request['end'],
        ];

        $project->update($data);

        Alert::success('success', 'change project successful');
        return redirect('project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        Alert::success('success', 'delete successful');
        return back();
    }
}
