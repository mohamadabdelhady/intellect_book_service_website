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
        $is_bookmark=DB::table('bookmarks')->where('book_id','=',$id)->where('type','=',0)->where('user_id','=',auth()->user()->id)->first();
        if($is_bookmark!=null)
        {
            $is_bookmark=true;
        }
        else
        {
            $is_bookmark=false;
        }
        return view('pages.check_book')->with(compact('book_data','is_bookmark'));
    }
    public function check_audio($id)
    {
        $book_data=DB::table('audio_books')->select('cover_img','name','author','text','rating','id','narrator')->where('id','=',$id)->first();

        $is_bookmark=DB::table('bookmarks')->where('book_id','=',$id)->where('type','=',1)->where('user_id','=',auth()->user()->id)->first();
        if($is_bookmark!=null)
        {
            $is_bookmark=true;
        }
        else
        {
            $is_bookmark=false;
        }
        return view('pages.check_audio')->with(compact('book_data','is_bookmark'));
    }
    public function get_reviews($id,$type)
    {
        $reviews=DB::table('reviews','r')->join('users as u','r.user_id','=','u.id')->select(
        'type','review','r.updated_at','u.profile_img','u.name','u.google_id','r.rating')->where('book_id','=',$id)->where('type','=',$type)->where('user_id','!=',auth()->user()->id)->paginate(10);

        return $reviews;
    }
    public function post_review(Request $request)
    {
        $id=$request->id;
        $type=$request->type;
        $review=$request->review;
        $user_id=$request->user;
        $rating=$request->rating;
        DB::table('reviews')->insert([
            'book_id'=>$id,
            'type'=>$type,
            'review'=>$review,
            'user_id'=>$user_id,
            'rating'=>$rating,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
    public  function update_review(Request $request)
    {
        DB::table('reviews')->where('user_id','=',$request->user)->update(['review'=>$request->review,'rating'=>$request->rating]);
    }
    public function delete_review($id,$type)
    {
        DB::table('reviews')->where('user_id','=',auth()->user()->id)->where('book_id','=',$id)->where('type','=',$type)->delete();

    }
    public function get_my_review($id,$type)
    {
        $review=DB::table('reviews')->where('book_id','=',$id)->where('type','=',$type)->where('user_id','=',auth()->user()->id)->first();
        return $review;
    }
    public function load_book($id)
    {
        $row=DB::table('books')->where('id','=',$id)->first();
        $name=$row->name;

        $id=$row->id;
        $book_name="id_".$id."_".$row->name;
        return view('pages.read')->with(compact('book_name','name','id'));
    }
    public function load_audio($id)
    {
        $name=DB::table('audio_books')->where('id','=',$id)->select('name')->first();
        $book_name="id_".$id."_".$name->name;
        $book_cover=DB::table('audio_books')->where('id','=',$id)->select('cover_img')->first();
        $book_id=$id;
        return view('pages.listen')->with(compact('book_name','book_id','book_cover'));
    }
}
