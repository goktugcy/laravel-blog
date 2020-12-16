<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
    return view('back.categories.index',compact('categories'));
    }



    public function switch(Request $request)
    {
        $category=Category::findOrFail($request->id);
        $category->status=$request->statu=='true' ? 1 : 0;
        $category->save();
        
    }



    public function create(Request $request)
    {
        $isExist=Category::whereSlug(Str::slug($request->category))->first(); //Aynı işimde kategori varsa izin verme!
        if($isExist)
        {
            toastr()->error($request->category. ' adında bir kategori mevcut!');
            return redirect()->route('admin.category.index');
        }
        $category = new Category;
        $category->name=$request->category;
        $category->slug=str::slug($request->category);
        $category->save();
        toastr()->success('Kategori başarıyla oluşturuldu!');
        return redirect()->route('admin.category.index');
    }



     public function update(Request $request)
    {
        $isSlug=Category::whereSlug(Str::slug($request->slug))->WhereNotIn('id',[$request->id])->first(); //Aynı slug değerinde kategori varsa izin verme!
        $isName=Category::whereName($request->category)->WhereNotIn('id',[$request->id])->first(); //Aynı işimde kategori varsa izin verme!
        
            if($isSlug or $isName){
            toastr()->error($request->category. ' adında bir kategori mevcut!');
            return redirect()->route('admin.category.index');
            }
        
        $category = Category::find($request->id);
        $category->name=$request->category;
        $category->slug=str::slug($request->slug);
        $category->save();
        toastr()->success('Kategori başarıyla güncellendi!');
        return redirect()->route('admin.category.index');
    }





    public function hardDelete($id)
    {
        Category::findOrFail($id)->ForceDelete();
        toastr()->error('Kategori tamamen silindi.');
        return redirect()->route('admin.category.index');
    }


    public function edit(Request $request)
    {
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }
}
