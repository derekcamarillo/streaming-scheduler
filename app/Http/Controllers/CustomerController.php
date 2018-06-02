<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index() {
        $users = User::all();

        return view('pages.customer.index', compact('users'));
    }

    public function login(Request $request) {
        $id = $request->input('id');

        $user = User::findOrFail($id);

        Auth::login($user);

        return redirect('home');
    }

    public function destroy($id) {
        try{
            if(User::destroy($id)) {
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
            return $this->response->error('could_not_delete_customer', 500);
        }
    }
}
