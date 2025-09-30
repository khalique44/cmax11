<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    public function changePassword()
    {
        return view('admin.auth.reset-password');
    }

    public  function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = auth('admin')->user();

        if (Hash::check($request->old_password, $admin->password))
        {
            $admin->password = Hash::make($request->password);
            $admin->save();

            return redirect()->back()->with('success','Password updated successfully.');
        }
        else {
            return redirect()->back()->with('error','New password did not match with old password.');
        }

    }

}
