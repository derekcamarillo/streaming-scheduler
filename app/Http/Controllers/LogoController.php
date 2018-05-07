<?php

namespace App\Http\Controllers;

use App\Logo;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $messages = $user->messages;

        return view('pages.logo.create', compact('projects', 'messages'));
    }

    public function edit($id) {
        $logo = Logo::find($id);

        $user = Auth::user();
        $projects = $user->projects;
        $messages = $user->messages;

        return view('pages.logo.edit', compact('logo', 'projects', 'messages'));
    }

    public function update($id, Request $request) {
        $logo = Logo::findOrFail($id);

        $this->validate($request, [
            'url'  => 'required',
            'position' => 'required',
            'xpos' => 'required|integer|between:0,500',
            'ypos' => 'required|integer|between:0,500'
        ]);

        $logo->update($request->all());

        try{
            if($logo->save()) {
                $project_id = $request->input('project_id');
                if (isset($project_id)) {
                    $project = Project::find($project_id);
                    $project->logo_id = $logo->id;
                    $project->save();
                }

                $request->session()->flash('logo_create', 'Logo successfully created.');
                return redirect('logo/edit/'.$logo->id);
            } else {
                return $this->response->error('logo', 500);
            }
        }catch(Exception $e){
            return response()->json([
                "result" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request) {
        $logo = new Logo();

        $this->validate($request, [
            'url'  => 'required',
            'position' => 'required',
            'xpos' => 'required|integer|between:0,500',
            'ypos' => 'required|integer|between:0,500'
        ]);

        try {
            $logo->fill($request->all());
            $logo->user_id = Auth::user()->id;

            if($logo->save()) {
                $project_id = $request->input('project_id');
                if (isset($project_id)) {
                    $project = Project::find($project_id);
                    $project->logo_id = $logo->id;
                    $project->save();
                }

                $request->session()->flash('logo_create', 'Logo successfully created.');
                return redirect('logo/create');
                //return $this->response->success('logo', 200);
            } else {
                return $this->response->error('logo', 500);
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
        $this->validate($request, [
            'logo' => 'required|image|mimes:jpeg,png,jpg,bmp|max:2048',
        ]);

        $path = Storage::disk('public_uploads')->put('logos', $request->file('logo'));

        $request->session()->flash('logo_path', Storage::disk('public_uploads')->url($path));

        return redirect('logo/create');
    }
}
