<?php

namespace App\Http\Controllers;

use App\Message;
use App\Videoclip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index() {
        $user = Auth::user();
        $messages = $user->messages;

        return view('pages.message.index', compact('messages'));
    }

    public function create(Request $request) {
        return view('pages.message.create');
    }

    public function edit($id) {
        $message = Message::find($id);

        return view('pages.message.edit', compact('message'));
    }

    public function store(Request $request) {
        $message = new Message();

        $this->validate($request, [
            'text'  => 'required',
            'effect' => 'required'
        ]);

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
                    "result" => "success",
                    "id" => $message->id
                ]);
            } else {
                return response()->json([
                    "result" => "error"
                ]);
            }
        }
        catch(Exception $e){
            return $this->response->error('could_not_create_message', 500);
        }
    }

    public function update($id, Request $request) {
        $message = Message::findOrFail($id);
        $message->update($request->all());

        try{
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
