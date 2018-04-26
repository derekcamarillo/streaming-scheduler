<?php

namespace App\Http\Controllers;

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
}
