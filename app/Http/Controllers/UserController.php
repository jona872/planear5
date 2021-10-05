<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        if (Auth::user()->admin) {
            $users = User::all();
            return view('panel.index', compact('users'));
        } else {
            return redirect()->route('projects.index')->withErrors('Solo docentes pueden acceder al panel!');
        }

    }
}
