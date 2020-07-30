<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use DB;
use auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::with('category')->paginate(10);

        $notifications = DB::table('notifications')->get();

        return view('admin.post')->with('posts',$posts)
                                 ->with('notifications',$notifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.post.create');
    }
    public function store(Request $request) 
    {

      $data = $request->validate([
        'title' => 'required','string',
        'des' => 'required','string',
        'category_id' => 'required',
      ]);
      auth()->user()->posts()->create([
        'title' => $data['title'],
        'des' => $data['des'],
        'category_id' => $data['category_id'],
      ]);

      return redirect()->back();

    }
    public function show(\App\Post $post)
    {
      return view('admin.post.show',[
        'post' => $post,
      ]);
    }

    public function delete($post)
    {
      
      $post = Post::findOrFail($post);
      if(auth::user()->role != null){
      if (Auth()->user()->id == $post->user_id || auth::user()->role->name == "admin" || auth::user()->email == "benjaminlam1202@gmail.com") {
        $post->delete();
        return redirect()->back();
      } else{
        abort(403, 'Unauthorized action.');
        return redirect('/')->with('status', 'Not Authorized!');
      }
    }else if(auth::user()->username != "Lam Thai Gia Huy"){
        abort(403, 'Unauthorized action.');
        return redirect('/')->with('status', 'Not Authorized!');
    }else{
         $post->delete();
        return redirect()->back();
    }


    }

    public function edit(\App\Post $post)
    {
      
      if (Auth()->user()->id == $post->user_id || auth::user()->role->name == "admin") {
        return view('admin.post.edit', compact('post'));
      } else{
        abort(403, 'Unauthorized action.');
        return redirect('/')->with('status', 'Not Authorized!');
      }
    }

    public function update(\App\Post $post,Request $request)
    {

      if (Auth()->user()->id == $post->user_id || auth::user()->role->name == "admin") {

        $data = $request->validate([
          'title' => 'required','string',
          'des' => 'required','string',
        ]);
        $post->update([
            'title' => $data['title'],
            'des' => $data['des'],
        ]);


        return redirect('/admin/post');
      } else{
        abort(403, 'Unauthorized action.');
        return redirect('/')->with('status', 'Not Authorized!');
      }
    }
 
}
