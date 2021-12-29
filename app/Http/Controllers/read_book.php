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
    public function check_audio($id)
    {
        $book_data=DB::table('audio_books')->select('cover_img','name','author','text','rating','id','narrator')->where('id','=',$id)->first();

//        dd($book_data);
        return view('pages.check_audio')->with('book_data',$book_data);
    }
    public function get_reviews($id,$type)
    {
        $reviews=DB::table('reviews','r')->join('users as u','r.user_id','=','u.id')->select(
        'type','content','r.updated_at','u.profile_img','u.name','u.google_id','r.rating')->where('book_id','=',$id)->where('type','=',$type)->paginate(10);
        return $reviews;
    }
    public function post_review(Request $request)
    {
        $id=$request->id;
        $type=$request->type;
        $comment=$request->comment;
        $user_id=$request->user;
        $rating=$request->rating;
        DB::table('reviews')->insert([
            'book_id'=>$id,
            'type'=>$type,
            'content'=>$comment,
            'user_id'=>$user_id,
            'rating'=>$rating,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
    public function load_book($id)
    {
        $row=DB::table('books')->where('id','=',$id)->first();
        $name=$row->name;
        $rate=$row->rating;
        $id=$row->id;
        $book_name="id_".$id."_".$row->name;
        return view('pages.read')->with(compact('book_name','rate','name','id'));
    }
    public function load_audio($id)
    {
        $name=DB::table('audio_books')->where('id','=',$id)->select('name')->first();
        $book_name="id_".$id."_".$name->name;
//        dd($book_name);
        return view('pages.listen')->with('book_name',$book_name);
    }
}
