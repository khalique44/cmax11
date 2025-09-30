<?php

namespace App\Http\Controllers\Admin\HomePage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\GeneralHelper;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = GeneralHelper::getOption('address');
        $email_address = GeneralHelper::getOption('email_address');
        $phone_number = GeneralHelper::getOption('phone_number');
        $google_map_link = GeneralHelper::getOption('google_map_link');
        return view('admin.home_page.contact_us.edit',compact('address','email_address','phone_number','google_map_link'));
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
            'address' => 'required|max:255',
            'email_address' => 'required|email',
            'phone_number' => 'required|max:15',
            'google_map_link' => 'required|url',
        ]);

        
        
        GeneralHelper::setOption('address',$request->address);
        GeneralHelper::setOption('email_address',$request->email_address);
        GeneralHelper::setOption('phone_number',$request->phone_number);
        GeneralHelper::setOption('google_map_link',$request->google_map_link);
        

        return redirect('/admin/home_page/contact_us');
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
