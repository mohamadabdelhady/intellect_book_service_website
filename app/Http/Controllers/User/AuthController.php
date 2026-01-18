<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use phpseclib3\Crypt\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }
        return view('Auth.home');
    }
    public function login()
    {
        return view('Auth.login');
    }

    public function register()
    {
        return view('Auth.subscribe');
    }
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
            $randString = Str::random(10);
            $newUser = User::create([

                'name' => $user->name,
                'email' => $user->email,
                'google_id'=> $user->id,
                'password'=>Hash::make($randString),
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
