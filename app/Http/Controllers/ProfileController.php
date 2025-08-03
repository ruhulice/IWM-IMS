<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function profile()
    {
        $user = User::where('id',Auth::id())->first();

        return view('profile.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
       /* request()->validate([
          'user_name'   => 'required|string|max:250',
          'name' => 'required|string|max:250',
          'code' => 'required',
          'email'  => 'required|string|email|max:250'
        ]);*/

        if (!file_exists('assets/uploads/user_photos/')) {
            mkdir('assets/uploads/user_photos', 0777, true);
        }

        $user = User::findOrFail(Auth::id());

        $file_name = $user->user_photo;
        if(!empty($request->hasfile('user_picture')))
        {
            $photos = $request->file('user_picture');
            $name   = $photos->getClientOriginalName();
            $photos->move('assets/uploads/user_photos/', $name);
            $file_name = url('/').'/assets/uploads/user_photos/'.$name;
        }

        $user->update([
            'user_name' => $request->user_name,
            'name'      => $request->name,
            'email'     => $request->email,
            'code'      => $request->code,
            'user_photo' => $file_name,
            'is_active'    => $request->status,
            'updated_by' => Auth::id()
        ]);

        $notification = [
            'message' => 'Profile updated successfully!'
        ];

        if (request('publish')) {
            return back()->with($notification);
        } else {
            Auth::logout();
            return redirect()->route('login');
        }
    }

    public function changePassword(Request $request)
    {
        if (!Hash::check($request->currentpassword, Auth::user()->password)) {
            return back()->with([
                'message'    => 'Your current password does not matches with the password you provided! Please try again.',
                'alert-type' => 'error'
            ]);
        }

        if(strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0){
            return back()->with([
                'message'    => 'New Password cannot be same as your current password! Please choose a different password.',
                'alert-type' => 'error'
            ]);
        }

        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword'     => 'required|string|min:6|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());
        $user->password = Hash::make($request->newpassword);
        $user->save();

        return back()->with(['message' => 'Password changed successfully.']);
    }

}
