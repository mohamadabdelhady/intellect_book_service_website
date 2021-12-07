<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class SocialmediaAuth extends Controller
{
public function redirectToGoogle()
{
    return Socialite::driver('google')->stateless()->redirect();
}
public function handleGoogleCallback()
{
    try {

        $user = Socialite::driver('google')->stateless()->user();

        $finduser = User::where('google_id', $user->id)->first();

        if($finduser){

            Auth::login($finduser);

            return redirect()->intended('/');

        }else{
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id'=> $user->id,
                'password'=>'123',
                'profile_img'=>$user->avatar,
            ]);

            Auth::login($newUser);

            return redirect()->intended('/');
        }

    } catch (Exception $e) {
        dd($e->getMessage());
    }
}
}
