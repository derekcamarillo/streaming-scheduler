<?php

namespace App\Http\Controllers;

use App\Playlist;
use App\Project;
use Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        $user = Auth::user();

        $project = Project::find($id);
        $playlists = $user->playlists;

        return view('pages.project.edit', compact(['project', 'playlists']));
    }

    public function store(Request $request) {
        $project = new Project();

        try {
            $this->validate($request, [
                'title'  => 'required'
            ]);
        }catch (ValidationException $e) {
            $data = $e->getResponse()->getOriginalContent();
            return response()->json([
                "result" => Config::get('constants.status.validation'),
                "data" => $data
            ]);
        }

        $project->fill($request->all());
        $project->url = uniqid();
        $project->user_id = Auth::user()->id;

        try{
            if($project->save()) {
                $playlists = $request->input('playlists');
                if (isset($playlists)) {
                    foreach ($request->input('playlists') as $playlist_id) {
                        $playlist = Playlist::find($playlist_id);
                        $project->playlists()->save($playlist);
                    }
                }

                return response()->json([
                    "result" => Config::get('constants.status.success'),
                    "data" => $project->id
                ]);
            } else {
                return response()->json([
                    "result" => Config::get('constants.status.error')
                ]);
            }
        }
        catch(Exception $e){
            return response()->json([
                "result" => Config::get('constants.status.error')
            ]);
        }
    }

    public function update($id, Request $request) {
        $project = Project::find($id);

        try {
            $this->validate($request, [
                'title'  => 'required'
            ]);
        }catch (ValidationException $e) {
            $data = $e->getResponse()->getOriginalContent();
            return response()->json([
                "result" => Config::get('constants.status.validation'),
                "data" => $data
            ]);
        }

        $project->fill($request->all());
        $project->url = uniqid();
        $project->user_id = Auth::user()->id;

        try{
            if($project->save()) {
                $playlists = $request->input('playlists');
                if (isset($playlists)) {
                    $project->playlists()->detach();
                    foreach ($request->input('playlists') as $playlist_id) {
                        $playlist = Playlist::find($playlist_id);
                        $project->playlists()->attach($playlist);
                    }
                }

                return response()->json([
                    "result" => Config::get('constants.status.success'),
                    "data" => $project->id
                ]);
            } else {
                return response()->json([
                    "result" => Config::get('constants.status.error')
                ]);
            }
        }
        catch(Exception $e){
            return response()->json([
                "result" => Config::get('constants.status.error')
            ]);
        }
    }

    public function destroy($id) {
        try{
            if(Project::destroy($id)) {
                return response()->json([
                    "result" => "success",
                    "id" => $id
                ]);
            } else {
                return response()->json([
                    "result" => "error"
                ]);
            }
        }catch(Exception $e){
            return $this->response->error('could_not_delete_project', 500);
        }
    }
}
