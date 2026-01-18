<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getSettings()
{
    $is0auth=User::isOAuthUser();
    return view('User.settings')->with(compact('is0auth'));
}

    public function changeProfileImg(Request $request)
    {
        $imageName = time() . '.' . 'png';
        $request->file('profimg')->move(public_path('images/users_profile_img'), $imageName);

        User::updateProfileImg($imageName);

        return back();
    }
    public function changeRenewSetting(Request $request)
    {
        User::updateRenewSetting($request->isRenew);
        return response()->json(['status' => 'success']);
    }
}
