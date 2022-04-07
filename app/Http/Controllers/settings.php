<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class settings extends Controller
{
    public function change_prof(Request $request)
    {
        $imageName = time() . '.' . 'png';
        $request->file('profimg')->move(public_path('images/users_profile_img'), $imageName);
        DB::table('users')->where('id','=', Auth::id())
            ->update(['profile_img' => $imageName]);
        dd($request->file('profimg'));
        return back();
    }
    public function change_renew(Request $request)
    {
        $is_renew=$request->isRenew;
        DB::table('users')->update(['auto_renew_sub'=>$is_renew]);
        return response('The renew option have been changed successfully.',200);
    }
}
