<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use File;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages=Page::all();
    return view('back.pages.index',compact('pages'));
    }


    public function pageswitch(Request $request)
    {
        $page=Page::findOrFail($request->id);
        $page->status=$request->statu=='true' ? 1 : 0;
        $page->save();
    }


    public function create()
    {
        return view('back.pages.create');
    }


    public function post(Request $request)
    {
         $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048'
        ]);
            $last=Page::orderBy('order','DESC')->first();

        $page= new Page;
        $page->title=$request->title;
        $page->content=$request->content;
        $page->order=$last->order+1;
        $page->slug=str::slug($request->title);
        
        if($request->hasFile('image'))
        {
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='/uploads/'.$imageName;
        }
        $page->save();
        toastr()->success('Başarılı!', 'Sayfa başarıyla oluşturuldu!');
        return redirect()->route('admin.page.index');
    }
    

        public function edit($id)
        {
            $page=Page::findOrFail($id);
            return view('back.pages.edit',compact('page'));
        }
        

        public function editPost(Request $request, $id)
        {
              $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $page= Page::findOrFail($id);
        $page->title=$request->title;
        $page->content=$request->content;
        $page->slug=str::slug($request->title);
        
        if($request->hasFile('image'))
        {
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='/uploads/'.$imageName;
        }
        $page->save();
        toastr()->success('Başarılı!', 'Sayfa başarıyla güncellendi.');
        return redirect()->route('admin.page.index');
        }

        public function delete($id){
          Page::find($id)->delete();
        toastr()->info('Makale geri dönüşüm kutusuna taşındı.');
        return redirect()->route('admin.page.index');
        }

        public function trashed()
        {
             $pages= Page::onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('back.pages.trashed',compact('pages'));
        }

         public function recover($id)
    {
        Page::onlyTrashed()->find($id)->restore();
         toastr()->info('Makale başarıyla geri alındı.');
        return redirect()->route('admin.page.index');
    }

     public function destroy($id)
    {
        $page= Page::onlyTrashed()->find($id);
        if(File::exists(public_path($page->image))){

            File::delete(public_path($page->image));
        }
        $page->ForceDelete();
        toastr()->warning('Sayfa tamamen silindi.');
        return redirect()->route('admin.page.trashed');
    }

    public function orders(Request $request)
    {
        foreach ($request->get('page') as $key => $order ){
            Page::where('id',$order)->update(['order'=> $key]);
        }
    }
        
}
