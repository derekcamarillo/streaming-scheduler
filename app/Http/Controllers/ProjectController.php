<?php

namespace App\Http\Controllers;

use App\Project;
use Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $projects = $user->projects;

        return view('pages.project.index', compact('projects'));
    }

    public function create() {
        $user = Auth::user();
        $playlists = $user->playlists;

        return view('pages.project.create', compact('playlists'));
    }

    public function edit($id) {
        return view('pages.edit-project');
    }

    public function store(Request $request) {
        $project = new Project();

        $this->validate($request, [
            'title'  => 'required'
        ]);

        $project->fill($request->all());
        $project->url = uniqid();
        $project->user_id = Auth::user()->id;

        try{
            $project->save();

            return redirect('project/create')->with('id', $project->id);
        }
        catch(Exception $e){
            return response()->json([
                "result" => Config::get('constants.status.error')
            ]);
        }
    }
}
