<?php

namespace App\Http\Controllers;

use App\Message;
use App\Videoclip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Config;

class MessageController extends Controller
{
    public function index() {
        $user = Auth::user();
        $messages = $user->messages;

        return view('pages.message.index', compact('messages'));
    }

    public function create(Request $request) {
        $videoclip = "https://www.youtube.com/watch?v=mcYIu_NUbiE";
        if (sizeof(Auth::user()->videoclips) > 0)
            $videoclip = Auth::user()->videoclips[0]->url;

        return view('pages.message.create', compact('videoclip'));
    }

    public function edit($id) {
        $message = Message::find($id);

        $videoclip = "https://www.youtube.com/watch?v=mcYIu_NUbiE";
        if (sizeof(Auth::user()->videoclips) > 0)
            $videoclip = Auth::user()->videoclips[0]->url;

        return view('pages.message.edit', compact(['message', 'videoclip']));
    }

    public function store(Request $request) {
        $message = new Message();

        try {
            $this->validate($request, [
                'text'  => 'required',
                'effect' => 'required',
                'xpos' => 'required|integer|between:0,500',
                'ypos' => 'required|integer|between:0,500',
                'fontsize' => 'required|integer|between:8,72'
            ]);
        }catch (ValidationException $e) {
            $data = $e->getResponse()->getOriginalContent();
            return response()->json([
                "result" => Config::get('constants.status.validation'),
                "data" => $data
            ]);
        }

        try {
            $message->fill($request->all());
            $message->user_id = Auth::user()->id;

            if($message->save()) {
                $videoclip_id = $request->input('videoclip_id');
                if (isset($videoclip_id)) {
                    $videoclip = Videoclip::find($videoclip_id);
                    $videoclip->message_id = $message->id;
                    $videoclip->save();
                }

                return response()->json([
                    "result" => Config::get('constants.status.success'),
                    "id" => $message->id
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
        $message = Message::findOrFail($id);

        try {
            $this->validate($request, [
                'text'  => 'required',
                'effect' => 'required',
                'xpos' => 'required|integer|between:0,500',
                'ypos' => 'required|integer|between:0,500',
                'fontsize' => 'required|integer|between:8,72'
            ]);
        }catch (ValidationException $e) {
            $data = $e->getResponse()->getOriginalContent();
            return response()->json([
                "result" => Config::get('constants.status.validation'),
                "data" => $data
            ]);
        }

        try{
            $message->update($request->all());
            if($message->save()) {
                return response()->json([
                    "result" => "success",
                    "id" => $message->id
                ]);
            } else {
                return response()->json([
                    "result" => "error"
                ]);
            }
        }catch(Exception $e){
            return $this->response->error('could_not_update_message', 500);
        }
    }

    public function destroy($id) {
        try{
            if(Message::destroy($id)) {
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
            return $this->response->error('could_not_delete_message', 500);
        }
    }
}
