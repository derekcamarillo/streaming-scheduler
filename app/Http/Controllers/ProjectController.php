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
        return view('pages.project.create');
    }

    public function edit($id) {
        return view('pages.edit-project');
    }
}
