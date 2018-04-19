<?php

namespace App\Http\Controllers;

use App\Logo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $logos = $user->logos;

        return view('pages.logo.index', compact('logos'));
    }

    public function create(Request $request) {
        return view('pages.logo.create');
    }

    public function edit($id) {
        $logo = Logo::find($id);

        return view('pages.logo.edit', compact('logo'));
    }
}
