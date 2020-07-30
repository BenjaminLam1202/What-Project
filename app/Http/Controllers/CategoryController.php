<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;
use auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::with('posts')->paginate(10);

        $notifications = DB::table('notifications')->get();

        return view('admin.category')->with('categories',$categories)
                                 ->with('notifications',$notifications);
    }

    


}
