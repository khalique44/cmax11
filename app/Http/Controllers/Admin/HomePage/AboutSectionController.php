<?php

namespace App\Http\Controllers\Admin\HomePage;

use App\AboutSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = AboutSection::orderBy('position','asc')->get();
        $this->reGeneratePositions();
        return view('admin.home_page.about_section.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home_page.about_section.create');
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
            'file_url' => 'mimes:jpeg,png,jpg,gif,svg,mpeg,ogg,mp4,webm,3gp,mov,flv,avi|max:100040',
        ]);

        $data = $request->except(['_method','_token']);
        
        if(!empty($request->file_url)){
            $folderName = 'about_images';
            if($request->is_video == 'yes'){
                $folderName = 'about_videos';
            }
            $fileName = pathinfo($request->file_url->getClientOriginalName(), PATHINFO_FILENAME);
            //$extension = pathinfo($request->file_url->getClientOriginalName(), PATHINFO_EXTENSION);
            $fullFileName = $fileName."-".time().'.'.$request->file_url->getClientOriginalExtension();

            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->file_url->move(public_path('assets/'.$folderName), $fullFileName);
            $data['file_url'] = 'assets/'.$folderName.'/'.$fullFileName;
        }       
        
        AboutSection::Create($data);            

        return redirect('/admin/home_page/about_section');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AboutSection  $aboutSection
     * @return \Illuminate\Http\Response
     */
    public function show(AboutSection $aboutSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AboutSection  $aboutSection
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = AboutSection::find($id);
        if(!$record){
            return abort(404);
        }
        return view('admin.home_page.about_section.edit',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AboutSection  $aboutSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',            
            
        ]);

        $data = $request->except(['_method','_token']);

        if(!empty($request->file_url)){

            $request->validate([
                     
                'file_url' => 'mimes:jpeg,png,jpg,gif,svg,mpeg,ogg,mp4,webm,3gp,mov,flv,avi|max:100040',
            ]);

           
            $folderName = 'about_images';
            if($request->is_video == 'yes'){
                $folderName = 'about_videos';
            }
            $fileName = pathinfo($request->file_url->getClientOriginalName(), PATHINFO_FILENAME);
            //$extension = pathinfo($request->file_url->getClientOriginalName(), PATHINFO_EXTENSION);
            $fullFileName = $fileName."-".time().'.'.$request->file_url->getClientOriginalExtension();

            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->file_url->move(public_path('assets/'.$folderName), $fullFileName);
            $data['file_url'] = 'assets/'.$folderName.'/'.$fullFileName;
            

        }else{

             $data = $request->except(['_method','_token','file_url']);
        }

   
        
        AboutSection::Where('id',$id)
            ->update($data);         

        return redirect('/admin/home_page/about_section');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AboutSection  $aboutSection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = AboutSection::find($id);
        if(!$record){
            return abort(404);
        }
        AboutSection::Where('id',$id)->delete();
        $this->reGeneratePositions();
        return redirect('/admin/home_page/about_section');
    }


    public function updatePosition(Request $request)
    { 
        
        $rows = ($request->all());        
        AboutSection::updatePosition($rows);
        $response = array( 'status' => 'success', 'message' => __('Position Updated Successfully!') );
            
        return response()->json($response);
    }

    public function reGeneratePositions(){
        $records = AboutSection::getRecordsWihPosition();
        foreach ($records as $key => $record) {
            $record->position = $key + 1;
            $record->save();
        }
    }
}
