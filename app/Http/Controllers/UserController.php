<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {

        if (Auth::user()->admin) {
            $users = User::all();
            return view('admin-panel.index', compact('users'));
        } else {
            return redirect()->route('projects.index')->withErrors('Solo docentes pueden acceder al panel!');
        }

    }


    public function setAdmin(Request $request){
        return "set Admin";
    }


    public function edit(User $user)
	{
        //dd($user);
		$user = DB::table('users')
            ->where('users.id', $user->id)
            ->get();

		// dd($projects);
		return view('admin-panel.edit', compact('user'));
	}

}
