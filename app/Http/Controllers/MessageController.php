<?php

namespace App\Http\Controllers;

use App\Message;
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

        try{
            $message->fill($request->all());
            $message->user_id = Auth::user()->id;

            if($message->save())

                return response()->json([
                    "result" => "success",
                    "id" => $message->id
                ]);
            else
                return response()->json([
                    "result" => "error"
                ]);
        }
        catch(Exception $e){
            return $this->response->error('could_not_create_message', 500);
        }
    }
}
