<?php

namespace App\Http\Controllers;

use App\Playlist;
use App\Videoclip;
use App\Schedule;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PlaylistController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $playlists = $user->playlists;

        return view('pages.playlist.index', compact('playlists'));
    }

    public function create() {
        $user = Auth::user();
        $messages = $user->messages;
        $videoclips = $user->videoclips;

        return view('pages.playlist.create', compact(['messages', 'videoclips']));
    }

    public function edit($id) {
        $user = Auth::user();

        $playlist = Playlist::find($id);
        $messages = $user->messages;
        $videoclips = $user->videoclips;

        return view('pages.playlist.edit', compact(['playlist', 'messages', 'videoclips']));
    }

    public function store(Request $request) {
        $playlist = new Playlist();

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

        try {
            $playlist->fill($request->all());
            $playlist->user_id = Auth::user()->id;

            if($playlist->save()) {
                foreach ($request->input('videoclips') as $videoclip_id) {
                    $videoclip = Videoclip::find($videoclip_id);
                    $playlist->videoclips()->save($videoclip);
                }

                $schedule = new Schedule();
                $schedule->fill($request->all());
                $schedule->playlist_id = $playlist->id;
                $schedule->save();

                return response()->json([
                    "result" => Config::get('constants.status.success'),
                    "id" => $playlist->id
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

    public function update($id, Request $request) {
        $playlist = Playlist::findOrFail($id);

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

        try {
            $playlist->fill($request->all());

            if($playlist->save()) {
                Videoclip::deleteAll();
                foreach ($request->input('videoclips') as $videoclip_id) {
                    $videoclip = Videoclip::find($videoclip_id);
                    $playlist->videoclips()->save($videoclip);
                }

                $schedule = new Schedule();
                $schedule->fill($request->all());
                $schedule->playlist_id = $playlist->id;
                $schedule->save();

                return response()->json([
                    "result" => Config::get('constants.status.success'),
                    "id" => $playlist->id
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
}
