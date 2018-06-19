<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\admin_menu;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

     public function dash()
    {
         $categories = admin_menu::with('children')
         ->where('parent_id','=',0)
         ->get();
        //$menu=DB::table('admin_menu')->where('is_delete','0' AND 'status','1')->get();
        return view('dashboard',['categories'=>$categories]);
    }
}
