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
}
