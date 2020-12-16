<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\settings;
use Illuminate\Support\Str;
class SettingsController extends Controller
{
    public function index()
    {
        $settings = settings::find(1);
        return view('back.settings.index',compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image'=>'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $settings = Settings::find(1);
        $settings->title=$request->title;
        $settings->description=$request->description;
        $settings->author=$request->author;
        $settings->active=$request->active;
        $settings->facebook=$request->facebook;
        $settings->twitter=$request->twitter;
        $settings->instagram=$request->instagram;
        $settings->linkedin=$request->linkedin;
        $settings->github=$request->github;
        $settings->youtube=$request->youtube;

        if($request->hasFile('logo'))
        {
            $logo=Str::slug($request->title).'-logo.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'),$logo);
            $settings->logo='/uploads/'.$logo;
        }

        if($request->hasFile('favicon'))
        {
            $favicon=Str::slug($request->title).'-favicon.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'),$favicon);
            $settings->favicon='/uploads/'.$favicon;
        }
        $settings->save();
        toastr()->success('Site ayarları başarıyla güncellendi.');
        return redirect()->back();
    }
}
