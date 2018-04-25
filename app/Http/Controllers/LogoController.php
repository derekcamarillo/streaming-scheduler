<?php

namespace App\Http\Controllers;

use App\Logo;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Config;
use Storage;

class LogoController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $logos = $user->logos;

        return view('pages.logo.index', compact('logos'));
    }

    public function create(Request $request) {
        $user = Auth::user();
        $projects = $user->projects;

        return view('pages.logo.create', compact('projects'));
    }

    public function edit($id) {
        $logo = Logo::find($id);

        return view('pages.logo.edit', compact('logo'));
    }

    public function update($id, Request $request) {
        $logo = Logo::findOrFail($id);
        $logo->update($request->all());

        try{
            if($logo->save()) {
                return response()->json([
                    "result" => "success",
                    "id" => $logo->id
                ]);
            } else {
                return response()->json([
                    "result" => "error"
                ]);
            }
        }catch(Exception $e){
            return $this->response->error('could_not_update_message', 500);
        }
    }

    public function store(Request $request) {
        $logo = new Logo();

        try {
            $this->validate($request, [
                'url'  => 'required',
                'position' => 'required',
                'xpos' => 'required|integer|between:0,500',
                'ypos' => 'required|integer|between:0,500'
            ]);
        }catch (ValidationException $e) {
            $data = $e->getResponse()->getOriginalContent();
            return response()->json([
                "result" => Config::get('constants.status.validation'),
                "data" => $data
            ]);
        }

        try {
            $logo->fill($request->all());
            $logo->user_id = Auth::user()->id;

            if($logo->save()) {
                $project_id = $request->input('project_id');
                if (isset($videoclip_id)) {
                    $project = Project::find($project_id);
                    $project->logo_id = $logo->id;
                    $project->save();
                }

                return response()->json([
                    "result" => Config::get('constants.status.success'),
                    "id" => $logo->id
                ]);
            } else {
                return response()->json([
                    "result" => Config::get('constants.status.error'),
                ]);
            }
        }
        catch(Exception $e){
            return response()->json([
                "result" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function destroy($id) {
        try{
            if(Logo::destroy($id)) {
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
            return $this->response->error('could_not_delete_logo', 500);
        }
    }

    public function upload(Request $request) {
        $path = Storage::disk('public_uploads')->put('logos', $request->file('logo'));

        return response()->json([
            "result" => Config::get('constants.status.success'),
            "path" => Storage::disk('public_uploads')->url($path)
        ]);
    }
}
