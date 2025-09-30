<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Post::orderBy('position','asc')->get();
        $this->reGeneratePositions();
        return view('admin.blog.content.index',compact('records'));
    }

    public function getPosts(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::getAllPosts();

            return DataTables::of($posts)
                ->addColumn('action', function ($post) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/blog/posts/$post->id/edit").'" >
                                            Edit
                                        </a>
                                        <a class="btn btn-sm btn-success" target="_blank" href="'.url("/blog/$post->id/").'" >
                                            View
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/blog/posts/'.$post->id.'" data-tableid="blogTable"   data-id="'.$post->id.'">
                                            Delete
                                        </a>';
                })
                ->editColumn('file_url', function($post) {
                    $img = '<a href="'.asset('public/'.$post->file_url).'" target="_blank" ><img src="'.asset('public/'.$post->file_url).'" width="150" ></a>';
                    return  $img;
                })
                ->rawColumns(['action','file_url'])
                ->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.content.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',            
            'file_url' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_method','_token']);
        
        if(!empty($request->file_url)){
            $folderName = 'blog_images';
            $fileName = pathinfo($request->file_url->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->file_url->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->file_url->move(public_path('assets/'.$folderName), $fullFileName);
            $data['file_url'] = 'assets/'.$folderName.'/'.$fullFileName;
        }   

        if(!empty($request->header_image)){
            $folderName = 'blog_header_images';
            $fileName = pathinfo($request->header_image->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->header_image->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->header_image->move(public_path('assets/'.$folderName), $fullFileName);
            $data['header_image'] = 'assets/'.$folderName.'/'.$fullFileName;
        }     
        
        Post::Create($data);            

        return redirect('/admin/blog/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Post::find($id);
        if(!$record){
            return abort(404);
        }
        return view('admin.blog.content.edit',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',            
            
        ]);

        $excludeParams = ['_method','_token'];
        $file_url = "";
        $header_image = "";

        if(!empty($request->file_url)){

            $request->validate([
                     
                'file_url' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

           
   
            $folderName = 'blog_images';
            $fileName = pathinfo($request->file_url->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->file_url->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->file_url->move(public_path('assets/'.$folderName), $fullFileName);
            $file_url  = 'assets/'.$folderName.'/'.$fullFileName;
            
            

        }else{

            array_push($excludeParams,'file_url');
        }

        if(!empty($request->header_image)){
            $folderName = 'blog_header_images';
            $fileName = pathinfo($request->header_image->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->header_image->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->header_image->move(public_path('assets/'.$folderName), $fullFileName);
            $header_image = 'assets/'.$folderName.'/'.$fullFileName;
           
        }else{

            array_push($excludeParams,'header_image');
        }
   

        $data = $request->except($excludeParams);
        if(!empty($file_url)){
            $data['file_url'] = $file_url;
        }
        if(!empty($header_image)){
            $data['header_image'] = $header_image;
        }

        $data['status'] = $request->has('status') ? 'yes' : 'no'; 
        

        
        Post::Where('id',$id)
            ->update($data);         

        return redirect('/admin/blog/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Post::find($id);
        if(!$record){
            return abort(404);
        }
        Post::Where('id',$id)->delete();
        //$this->reGeneratePositions();
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function updatePosition(Request $request)
    { 
        
        $rows = ($request->all());        
        Post::updatePosition($rows);
        $response = array( 'status' => 'success', 'message' => __('Position Updated Successfully!') );
            
        return response()->json($response);
    }

    public function reGeneratePositions(){
        $records = Post::getRecordsWihPosition();
        foreach ($records as $key => $record) {
            $record->position = $key + 1;
            $record->save();
        }
    }
}
