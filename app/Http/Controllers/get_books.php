<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class get_books extends Controller
{
    public function set_bookmark($id,$type)
    {
        $is_query=DB::table('bookmarks')->where('book_id','=',$id)->where('type','=',$type)->first();
        if (!$is_query) {
            DB::table('bookmarks')->insert([
                'user_id' => auth()->user()->id,
                'book_id' => $id,
                'type' => $type,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            return back();
        }
    }
    public function remove_bookmark($id,$type)
    {
        DB::table('bookmarks')->where('book_id','=',$id)->where('type','=',$type)->delete();
        return back();
    }
}
