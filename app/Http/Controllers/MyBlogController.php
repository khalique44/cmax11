<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class MyBlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Post::where('status','yes')->orderBy('position','asc')->get();
         
        $data = [
                          'title' => RosenHelper::getOption('blog_title'), 
                          'description' => RosenHelper::getOption('blog_description'), 
                          'meta_title' => RosenHelper::getOption('blog_meta_title'), 
                          'meta_description' => RosenHelper::getOption('blog_meta_description'), 
                          'meta_keywords' => RosenHelper::getOption('blog_meta_keywords'), 
                       ];
        
        $header_image = RosenHelper::getOption('blog_header_image');
        $data = (object) $data;
       

        if(!empty($header_image)){
            
          if(file_exists( public_path().'/'.$header_image )){
            $header_image = url('public') .'/'.$header_image;
          } else {
            $header_image = url('public/assets/images').'/header-bg.jpg';
          }
        }
        
        return view('blog',compact('data','header_image','records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
