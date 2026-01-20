<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $imageName = time() . '.' . 'png';
        $request->file('profimg')->move(public_path('images/users_profile_img'), $imageName);

        auth()->user()->updateProfileImg($imageName);

        return back();
    }
    public function changeRenewSetting(Request $request)
    {
        auth()->user()->updateRenewSetting($request->isRenew);
        return response()->json(['status' => 'success']);
    }
}
