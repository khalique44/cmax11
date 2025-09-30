<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Helpers\GeneralHelper;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::query()->where('status','yes')->orderBy('position','asc');

        $latestPosts = Post::where('status', 'yes')
        ->latest()  // created_at DESC
        ->take(10)
        ->get();
         
        $data = [
                          'title' => GeneralHelper::getOption('blog_title'), 
                          'description' => GeneralHelper::getOption('blog_description'), 
                          'meta_title' => GeneralHelper::getOption('blog_meta_title'), 
                          'meta_description' => GeneralHelper::getOption('blog_meta_description'), 
                          'meta_keywords' => GeneralHelper::getOption('blog_meta_keywords'), 
                       ];
        
        $header_image = GeneralHelper::getOption('blog_header_image');
        $data = (object) $data;
       

        if(!empty($header_image)){
            
          if(file_exists( public_path().'/'.$header_image )){
            $header_image = url('public') .'/'.$header_image;
          } else {
            $header_image = url('public/assets/images').'/header-bg.jpg';
          }
        }
       $records = $posts->paginate(2);

        if ($request->ajax()) {
            return view('layouts.partials.blog_posts_list', compact('data','header_image','records'))->render();
        }
        
        return view('blog',compact('data','header_image','records','latestPosts'));
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
        $post = Post::find($id);
        $latestPosts = Post::where('status', 'yes')
        ->latest()  // created_at DESC
        ->take(10)
        ->get();

        if(!$post){
            return abort(404);
        }

        $header_image = url('public/assets/images').'/header-bg.jpg';

        if(!empty($post->header_image)){
            
          if(file_exists( public_path().'/'.$post->header_image )){
            $header_image = url('public') .'/'.$post->header_image;
          } 
        }


        return view('blogdetails',compact('header_image','post','latestPosts'));
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
