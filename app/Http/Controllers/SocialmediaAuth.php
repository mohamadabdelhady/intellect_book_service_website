<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialmediaAuth extends Controller
{
public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}
public function handleGoogleCallback()
{
    try {

        $user = Socialite::driver('google')->user();

        $finduser = User::where('google_id', $user->id)->first();

        if($finduser){

            Auth::login($finduser);

            return redirect()->intended('/');

        }else{
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id'=> $user->id,
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
