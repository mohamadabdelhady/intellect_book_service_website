<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\comments;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class read_book extends Controller
{
    public function check_book($id)
    {
        $book_data=DB::table('books')->select('cover_img','name','author','text','rating','id')->where('id','=',$id)->first();

//        dd($book_data);
        return view('pages.check_book')->with('book_data',$book_data);
    }
    public function get_comments($id,$type)
    {
        $comments=DB::table('comments','c')->join('users as u','c.user_id','=','u.id')->select(
        'type','content','c.updated_at','u.profile_img','u.name','u.google_id')->where('book_id','=',$id)->where('type','=',$type)->paginate(10);
        return $comments;
    }
    public function post_comment(Request $request)
    {
        $id=$request->id;
        $type=$request->type;
        $comment=$request->comment;
        $user_id=$request->user;
        DB::table('comments')->insert([
            'book_id'=>$id,
            'type'=>$type,
            'content'=>$comment,
            'user_id'=>$user_id,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
