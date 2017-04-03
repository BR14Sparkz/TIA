<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;

class ProfileController extends Controller
{
    public function profile($username)
    {
    	//select (first()) username from users where username = $username 
    	$user = User::whereUsername($username)->first();
    	//alt method - $user = User::where('username', '$username')
    	//alt method - $user = User::where('username', '=', '$username')

    	//dd($user); - advanced vardump

    	// return the view for the user profile
    	return view('user.profile', compact('user'));

    	// if you wanted to just return a single item you can do things like $return user->dob; (returning date of birth only) 

    }
}
