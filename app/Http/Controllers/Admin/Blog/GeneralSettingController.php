<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\RosenHelper;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_title = RosenHelper::getOption('blog_title');
        $blog_description = RosenHelper::getOption('blog_description');
        $blog_header_image = RosenHelper::getOption('blog_header_image');
        $blog_meta_title = RosenHelper::getOption('blog_meta_title');
        $blog_meta_description = RosenHelper::getOption('blog_meta_description');
        $blog_meta_keywords = RosenHelper::getOption('blog_meta_keywords');
        return view('admin.blog.general_settings.edit',compact('blog_title','blog_description','blog_header_image','blog_meta_title','blog_meta_description','blog_meta_keywords'));
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
        $request->validate([
            'blog_title' => 'required|max:255',
            'file_url' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=1920,max_height=920',
        ]);

        
        
        RosenHelper::setOption('blog_title',$request->blog_title);
        RosenHelper::setOption('blog_description',$request->blog_description);
        RosenHelper::setOption('blog_meta_title',$request->blog_meta_title);
        RosenHelper::setOption('blog_meta_description',$request->blog_meta_description);
        RosenHelper::setOption('blog_meta_keywords',$request->blog_meta_keywords);

        if(!empty($request->file_url)){
            $folderName = 'blog_header_images';
            $fileName = pathinfo($request->file_url->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->file_url->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->file_url->move(public_path('assets/'.$folderName), $fullFileName);
            $blog_header_image = 'assets/'.$folderName.'/'.$fullFileName;
            RosenHelper::setOption('blog_header_image',$blog_header_image);
        }
        

        return redirect('/admin/blog/general_settings');
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
