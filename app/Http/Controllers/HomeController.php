<?php

namespace App\Http\Controllers;

use App\Project;
use App\Playlist;
use App\Videoclip;
use App\Message;
use App\Logo;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $projects = $user->projects;
        $playlists = $user->playlists;
        $videoclips = $user->videoclips;
        $messages = $user->messages;
        $logos = $user->logos;


        return view('pages.home');
    }
}
