<?php

namespace App\Http\Controllers\Admin\HomePage;

use App\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $records = Testimonial::orderBy('position','asc')->get();
        $this->reGeneratePositions();
        return view('admin.home_page.testimonials.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home_page.testimonials.create');
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
            'client_name' => 'required|max:255',            
            'file_url' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_method','_token']);
        
        if(!empty($request->file_url)){
            $folderName = 'testimonial_images';
            $fileName = pathinfo($request->file_url->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->file_url->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->file_url->move(public_path('assets/'.$folderName), $fullFileName);
            $data['file_url'] = 'assets/'.$folderName.'/'.$fullFileName;
        }       
        
        Testimonial::Create($data);            

        return redirect('/admin/home_page/testimonials');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Testimonial::find($id);
        if(!$record){
            return abort(404);
        }
        return view('admin.home_page.testimonials.edit',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_name' => 'required|max:255',            
            
        ]);

        $data = $request->except(['_method','_token']);

        if(!empty($request->file_url)){

            $request->validate([
                     
                'file_url' => 'mimes:jpeg,png,jpg,gif,svg,mpeg,ogg,mp4,webm,3gp,mov,flv,avi|max:100040',
            ]);

           
            $folderName = 'testimonial_images';
            
            $fileName = pathinfo($request->file_url->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->file_url->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->file_url->move(public_path('assets/'.$folderName), $fullFileName);
            $data['file_url'] = 'assets/'.$folderName.'/'.$fullFileName;
            

        }else{

             $data = $request->except(['_method','_token','file_url']);
        }

   
        
        Testimonial::Where('id',$id)
            ->update($data);         

        return redirect('/admin/home_page/testimonials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Testimonial::find($id);
        if(!$record){
            return abort(404);
        }
        Testimonial::Where('id',$id)->delete();
        $this->reGeneratePositions();
        return redirect('/admin/home_page/testimonials');
    }


    public function updatePosition(Request $request)
    { 
        
        $rows = ($request->all());        
        Testimonial::updatePosition($rows);
        $response = array( 'status' => 'success', 'message' => __('Position Updated Successfully!') );
            
        return response()->json($response);
    }

    public function reGeneratePositions(){
        $records = Testimonial::getRecordsWihPosition();
        foreach ($records as $key => $record) {
            $record->position = $key + 1;
            $record->save();
        }
    }
}
