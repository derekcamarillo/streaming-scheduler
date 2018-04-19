<?php

namespace App\Http\Controllers;

use App\Videoclip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoclipController extends Controller
{
    //

    public function index() {
        $user = Auth::user();
        $videoclips = $user->videoclips;

        return view('pages.videoclip.index', compact('videoclips'));
    }

    public function create(Request $request) {
        return view('pages.videoclip.create');
    }

    public function edit($id) {
        $videoclip = Videoclip::find($id);

        return view('pages.videoclip.edit', compact('videoclip'));
    }

    public function update($id, Request $request) {

    }

    public function store(Request $request) {
        $videoclip = new Videoclip();

        $this->validate($request, [
            'title'  => 'required',
            'url' => 'required'
        ]);

        $videoclip->fill($request->all());
        $videoclip->user_id = Auth::user()->id;

        try{
            if($videoclip->save())
                return response()->json([
                    "result" => "success",
                    "id" => $videoclip->id
                ]);
            else
                return response()->json([
                    "result" => "error"
                ]);
        }
        catch(Exception $e){
            return $this->response->error('could_not_create_order', 500);
        }
    }
}
