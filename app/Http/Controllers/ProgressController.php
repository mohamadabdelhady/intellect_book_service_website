<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProgressController extends Controller
{
    public function set_book_progress(Request $request)
    {
        $is_query=DB::table('books_progresses')->where('user_id','=',auth()->user()->id)->where('book_id','=',$request->book_id)
            ->where('type','=',$request->type)->select('progress')->first();
        if (!$is_query) {
            DB::table('books_progresses')->insert([
                'user_id' => auth()->user()->id,
                'book_id' => $request->book_id,
                'progress' => $request->progress,
                'type' => $request->type,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
        else
        {
            DB::table('books_progresses')->where('user_id','=',auth()->user()->id)->where('book_id','=',$request->book_id)
                ->where('type','=',$request->type)->update(['progress'=>$request->progress]);
        }
    }
    public function get_book_progress($id,$type)
    {
       $prog=DB::table('books_progresses')->where('user_id','=',auth()->user()->id)->where('book_id','=',$id)
            ->where('type','=',$type)->select('progress')->first();
       if($prog!=null) {
           return $prog->progress;
       }
       else
       {
           return null;
       }
    }
}
