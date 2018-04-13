<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $playlists = $user->playlists;

        return view('pages.playlist.index', compact('playlists'));
    }
}
