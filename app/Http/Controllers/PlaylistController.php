<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $playlists = $user->playlists;

        foreach ($playlists as $playlist) {
            $weekdays = explode(',', $playlist->schedule->days);
            $months = explode(',', $playlist->schedule->months);

            foreach($weekdays as $weekday) {
                $week = Config::get('constants.weekdays')[$weekday];
            }
        }

        return view('pages.playlist.index', compact('playlists'));
    }
}
