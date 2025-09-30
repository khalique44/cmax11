<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\RosenHelper;

class GlobalStylingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $primary_color = RosenHelper::getOption('primary_color','#0E0E0E');
        $secondary_color = RosenHelper::getOption('secondary_color','#FFCC03');
        $home_contact_us_bg = RosenHelper::getOption('home_contact_us_bg','#FFF5CD');
        $footer_background = RosenHelper::getOption('footer_background','#212124');
        
        
        return view('admin.global_styling.edit',compact('primary_color','secondary_color','home_contact_us_bg', 'footer_background'));
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
        RosenHelper::setOption('primary_color',$request->primary_color);
        RosenHelper::setOption('secondary_color',$request->secondary_color);
        RosenHelper::setOption('footer_background',$request->footer_background);
        RosenHelper::setOption('home_contact_us_bg',$request->home_contact_us_bg);

        return redirect('/admin/global-styling')->with('success',__("Records Updated Successfully."));
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


    public function resetColorsDefault(){
        
        RosenHelper::deleteOption('primary_color');
        RosenHelper::deleteOption('secondary_color');
        RosenHelper::deleteOption('footer_background');
        RosenHelper::deleteOption('home_contact_us_bg');

        return redirect('/admin/global-styling')->with('success',__("Styling Reset Successfully."));
    }
}
