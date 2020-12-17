<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str; 
use File;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function articleswitch(Request $request)
    {
        $article=Article::findOrFail($request->id);
        $article->status=$request->statu=='true' ? 1 : 0;
        $article->save();
        
    }

    

    public function index()
    {
        $articles=Article::orderBy('created_at','ASC')->get();
        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $article=new Article;
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->content=$request->content;
        $article->slug=str::slug($request->title);
        
        if($request->hasFile('image'))
        {
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image='/uploads/'.$imageName;
        }
        $article->save();
        toastr()->success('Başarılı!', 'Makale başarıyla oluşturuldu.');
        return redirect()->route('admin.makaleler.index');
        
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
        $article=Article::findOrFail($id);
        $categories=Category::all();
        return view('back.articles.update',compact('categories','article'));
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
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $article= Article::findOrFail($id);
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->content=$request->content;
        $article->slug=str::slug($request->title);
        
        if($request->hasFile('image'))
        {
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image='/uploads/'.$imageName;
        }
        $article->save();
        toastr()->success('Başarılı!', 'Sayfa başarıyla güncellendi.');
        return redirect()->route('admin.page.index');
    }





    public function create()
    {
        $categories=Category::all();
        return view('back.articles.create',compact('categories'));
    }



    public function delete($id)
    {
        Article::find($id)->delete();
        toastr()->info('Makale geri dönüşüm kutusuna taşındı.');
        return redirect()->route('admin.makaleler.index');
    }


    public function recover($id)
    {
        Article::onlyTrashed()->find($id)->restore();
         toastr()->info('Makale başarıyla geri alındı.');
        return redirect()->route('admin.makaleler.index');
    }

    public function trashed()
    {
        $articles= Article::onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('back.articles.trashed',compact('articles'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article= Article::onlyTrashed()->find($id);
        if(File::exists(public_path($article->image))){

            File::delete(public_path($article->image));
        }
        $article->ForceDelete();
        toastr()->warning('Makale tamamen silindi.');
        return redirect()->route('admin.trashed.article');
    }
}
