<?php

namespace App\Http\Controllers;

use App\History;
use App\Playlist;
use App\Project;
use App\Videoclip;
use App\Schedule;
use Pusher;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use stdClass;

class PlaylistController extends Controller
{
    protected $pusher;

    public function __construct() {
        $options = array(
            'cluster' => 'eu',
            'encrypted' => true
        );
        $this->pusher = new Pusher\Pusher(
            'b49a9350eaaad837235a',
            '47cf03fbc5a44f29f036',
            '528560',
            $options
        );
    }

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
                $videoclips = $request->input('videoclips');
                if (isset($videoclips)) {
                    for ($i = 0; $i < sizeof($videoclips); $i++) {
                        $videoclip = Videoclip::find($videoclips[$i]);
                        $playlist->videoclips()->save($videoclip, ['order' => $i]);
                    }
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
                $videoclipIds = $request->input('videoclips');
                if(isset($videoclipIds)) {
                    $playlist->videoclips()->detach();
                    for ($i = 0; $i < sizeof($videoclipIds); $i++) {
                        $videoclip = Videoclip::find($videoclipIds[$i]);
                        $playlist->videoclips()->attach($videoclip, ['order' => $i]);
                    }
                    /*
                    foreach ($videoclipIds as $videoclipId) {
                        $videoclip = Videoclip::find($videoclipId);
                        $playlist->videoclips()->attach($videoclip);
                    }
                    */
                }

                $schedule = $playlist->schedule;
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

    public function destroy($id) {
        try{
            if(Playlist::destroy($id)) {
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
            return $this->response->error('could_not_delete_playlist', 500);
        }
    }

    public function activatePlaylist(Request $request) {

        try {
            $this->validate($request, [
                'project_id'  => 'required',
                'playlist_id'  => 'required'
            ]);
        } catch (ValidationException $e) {
            $data = $e->getResponse()->getOriginalContent();
            return response()->json([
                "result" => Config::get('constants.status.validation'),
                "data" => $data
            ]);
        }

        $project = Project::find($request->input('project_id'));

        if (!isset($project)) {
            return response()->json([
                "result" => "error",
                "data" => "Couldn't find project"
            ]);
        }

        $playlists = $project->playlists;
        foreach ($playlists as $playlist) {
            if ($playlist->id == $request->input('playlist_id'))
                $project->playlists()->updateExistingPivot($playlist->id, ['activated' => 1]);
            else
                $project->playlists()->updateExistingPivot($playlist->id, ['activated' => 0]);

            $histories = History::where([
                ['project_id', $project->id],
                ['playlist_id', $playlist->id]],
                ['isPlaying', 1])
                ->get();
            foreach ($histories as $history) {
                $history->isPlaying = 0;
                $history->update();
            }
        }

        $data = array();

        if(isset($project) and isset($project->logo)) {
            $logo['id'] = $project->logo->id;
            $logo['url'] = $project->logo->url;
            $logo['position'] = $project->logo->position;
            $logo['xpos'] = $project->logo->xpos;
            $logo['ypos'] = $project->logo->ypos;

            $data['logo'] = $logo;
        }

        if(isset($project->activatedPlaylist) and (count($project->activatedPlaylist) > 0)) {
            $playlist = $project->activatedPlaylist()->first();

            $plist['id'] = $playlist->id;
            $plist['title'] = $playlist->title;


            $videoclips = array();
            foreach($playlist->videoclips as $videoclip) {
                if(isset($videoclip->message)) {
                    $message['id'] = $videoclip->message->id;
                    $message['text'] = $videoclip->message->text;
                    $message['effect'] = $videoclip->message->effect;
                    $message['speed'] = $videoclip->message->id;
                    $message['duration'] = $videoclip->message->duration;
                    $message['xpos'] = $videoclip->message->xpos;
                    $message['ypos'] = $videoclip->message->ypos;
                    $message['fonttype'] = $videoclip->message->fonttype;
                    $message['fontsize'] = $videoclip->message->fontsize;
                    $message['fontcolor'] = $videoclip->message->fontcolor;

                    $videoclip['id'] = $videoclip->id;
                    $videoclip['title'] = $videoclip->title;
                    $videoclip['url'] = $videoclip->url;
                    $videoclip['message'] = $message;

                    array_push($videoclips, $videoclip);
                } else {
                    $videoclip['id'] = $videoclip->id;
                    $videoclip['title'] = $videoclip->title;
                    $videoclip['url'] = $videoclip->url;
                    $videoclip['message'] = null;

                    array_push($videoclips, $videoclip);
                }
            }
            $plist['videoclips'] = $videoclips;

            if(isset($playlist->message)) {
                $message['id'] = $playlist->message->id;
                $message['text'] = $playlist->message->text;
                $message['effect'] = $playlist->message->effect;
                $message['speed'] = $playlist->message->id;
                $message['duration'] = $playlist->message->duration;
                $message['xpos'] = $playlist->message->xpos;
                $message['ypos'] = $playlist->message->ypos;
                $message['fonttype'] = $playlist->message->fonttype;
                $message['fontsize'] = $playlist->message->fontsize;
                $message['fontcolor'] = $playlist->message->fontcolor;

                $plist['message'] = $message;
            }

            if(isset($playlist->schedule)) {
                $schedule['id'] = $playlist->schedule->id;
                $schedule['start_time'] = $playlist->schedule->start_time;
                $schedule['end_time'] = $playlist->schedule->end_time;
                $schedule['endless'] = $playlist->schedule->endless;
                $schedule['days'] = explode(',', $playlist->schedule->days);
                $schedule['months'] = explode(',', $playlist->schedule->months);

                $plist['schedule'] = $schedule;
            }

            $data['playlist'] = $plist;
        }
        $data['command'] = 'start';

        $this->pusher->trigger($project->url, 'onCommand', $data);

        $history = new History();
        $history->project_id = $request->input('project_id');
        $history->playlist_id = $request->input('playlist_id');
        $history->user_id = Auth::user()->id;

        $history->save();

        return response()->json([
            "result" => Config::get('constants.status.success'),
            "data" => $request->input('playlist_id')
        ]);
    }

    public function deactivatePlaylist(Request $request) {
        try {
            $this->validate($request, [
                'project_id'  => 'required',
                'playlist_id'  => 'required'
            ]);
        }catch (ValidationException $e) {
            $data = $e->getResponse()->getOriginalContent();
            return response()->json([
                "result" => Config::get('constants.status.validation'),
                "data" => $data
            ]);
        }

        $project = Project::find($request->input('project_id'));

        if (!isset($project)) {
            return response()->json([
                "result" => "error",
                "data" => "Couldn't find project"
            ]);
        }

        $data['command'] = 'stop';
        $this->pusher->trigger($project->url, 'onCommand', $data);

        $project->activatedPlaylist()->updateExistingPivot($request->input('playlist_id'), ['activated' => 0]);

        $history = History::where([
            ['project_id', $request->input('project_id')],
            ['playlist_id', $request->input('playlist_id')]])
            ->orderBy('created_at', 'desc')
            ->first();

        $history->isPlaying = 0;

        $history->update();

        return response()->json([
            "result" => Config::get('constants.status.success'),
            "data" => $request->input('playlist_id')
        ]);
    }
}
