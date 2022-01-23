<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;

class ProfileController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        return view('User.profile', compact('user'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'position' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        }

        $user = User::query()
            ->find($id);
        $user->name = $request->input('name');
        $user->position = $request->input('position');


        $user->save();

        return  redirect()->route('profile.index');

    }

    public function resetPassword(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',]);

        //check if payload is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        }

        $password = $request->password;// Validate the token


        $user = User::query()
            ->find(Auth::id());

        $user->password = Hash::make($password);
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);

        return redirect()->route('profile.index');


    }
}
