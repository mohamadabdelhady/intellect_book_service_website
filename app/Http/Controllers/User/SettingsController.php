<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getSettings()
    {
        $is0auth = auth()->user()->isOAuthUser();

        return view('User.settings')->with(compact('is0auth'));
    }

    public function changeProfileImg(Request $request)
    {
        $image_path = $request->file('profimg')->store('users/profile_images', 'public');

        auth()->user()->updateProfileImg($image_path);

        return back();
    }

    public function changeRenewSetting(Request $request)
    {
        auth()->user()->updateRenewSetting($request->isRenew);

        return response()->json(['status' => 'success']);
    }
}
