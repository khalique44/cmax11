<?php

namespace App\Http\Controllers\Admin\HomePage;

use App\TeamMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = TeamMember::orderBy('position','asc')->get();
        $this->reGeneratePositions();
        return view('admin.home_page.team_members.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home_page.team_members.create');
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
            'member_name' => 'required|max:255',            
            'file_url' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_method','_token']);
        
        if(!empty($request->file_url)){
            $folderName = 'team_member_images';
            $fileName = pathinfo($request->file_url->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->file_url->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->file_url->move(public_path('assets/'.$folderName), $fullFileName);
            $data['file_url'] = 'assets/'.$folderName.'/'.$fullFileName;
        }       
        
        TeamMember::Create($data);            

        return redirect('/admin/home_page/team_members');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(TeamMember $teamMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = TeamMember::find($id);
        if(!$record){
            return abort(404);
        }
        return view('admin.home_page.team_members.edit',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'member_name' => 'required|max:255',            
            
        ]);

        $data = $request->except(['_method','_token']);

        if(!empty($request->file_url)){

            $request->validate([
                     
                'file_url' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

           
            $folderName = 'team_member_images';
            
            $fileName = pathinfo($request->file_url->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->file_url->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->file_url->move(public_path('assets/'.$folderName), $fullFileName);
            $data['file_url'] = 'assets/'.$folderName.'/'.$fullFileName;
            

        }else{

             $data = $request->except(['_method','_token','file_url']);
        }

   
        
        TeamMember::Where('id',$id)
            ->update($data);         

        return redirect('/admin/home_page/team_members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = TeamMember::find($id);
        if(!$record){
            return abort(404);
        }
        TeamMember::Where('id',$id)->delete();
        $this->reGeneratePositions();
        return redirect('/admin/home_page/team_members');
    }

    public function updatePosition(Request $request)
    { 
        
        $rows = ($request->all());        
        TeamMember::updatePosition($rows);
        $response = array( 'status' => 'success', 'message' => __('Position Updated Successfully!') );
            
        return response()->json($response);
    }

    public function reGeneratePositions(){
        $records = TeamMember::getRecordsWihPosition();
        foreach ($records as $key => $record) {
            $record->position = $key + 1;
            $record->save();
        }
    }
}
