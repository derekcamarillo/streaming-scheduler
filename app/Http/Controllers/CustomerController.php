<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index() {
        $users = User::all();

        return view('pages.customer.index', compact('users'));
    }
}
