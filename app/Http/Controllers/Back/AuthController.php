<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Str; 
class AuthController extends Controller
{
    public function login()
    {
        return view('back.auth.login');
    }

    public function loginPost(Request $request)
    {
       if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
       {
           toastr()->success('Hoşgeldin!', Auth::user()->name);
           return redirect()->route('admin.dashboard');
            
       }
        return redirect()->route('admin.login')->withErrors('Email yada Parola hatalı!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function index()
    {
        $profile =Admin::orderBy('id','ASC')->get();
        return view('back.settings.profile',compact('profile'));
    }

    public function update(Request $request)
    {
          $profile = Admin::find(1);
        $profile->name=$request->name;
        $profile->email=$request->email;
        $profile->password = bcrypt($request->get('password'));

          if($request->hasFile('avatar'))
        {
            $avatar=Str::slug($request->title).'-avatar.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('uploads'),$avatar);
            $profile->avatar='/uploads/'.$avatar;
        }
            $profile->save();
             toastr()->success('Ayarlar başarıyla güncellendi!');
        return redirect()->route('admin.settings.profile');
    }
 
       
}
