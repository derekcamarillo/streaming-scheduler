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
use League\Flysystem\Exception;
use Config;

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

        return view('pages.home', compact(['projects', 'playlists']));
    }

    public function client($url)
    {
        $project = Project::where('url', $url)->first();

        return view('pages.client', compact(['project', 'url']));
    }

    public function test($customer, $project, $url) {
        $project = Project::where('url', $url)->first();

        return view('pages.client', compact(['project', 'url']));
    }

    public function getProjectPlaylist($id)
    {
        $project = Project::find($id);
        $playlists = $project->playlists;

        foreach ($playlists as $playlist) {
            $playlist->videoclips;
        }

        if (isset($project)) {
            return response()->json([
                "result" => Config::get('constants.status.success'),
                "data" => $playlists
            ]);
        } else {
            return response()->json([
                "result" => Config::get('constants.status.error')
            ]);
        }
    }

    public function getPlaylistVideoclip($id)
    {
        $playlist = Playlist::find($id);
        $playlist->videoclips;
        $playlist->message;

        if (isset($playlist)) {
            return response()->json([
                "result" => Config::get('constants.status.success'),
                "data" => $playlist
            ]);
        } else {
            return response()->json([
                "result" => Config::get('constants.status.error')
            ]);
        }
    }
}
