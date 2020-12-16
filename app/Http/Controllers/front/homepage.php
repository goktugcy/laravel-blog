<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Settings;

class homepage extends Controller
{
    public function __construct(){
    if(Settings::find(1)->active==0){
        return redirect()->to('aktif-degil')->send();
        
    }
    
        view()->share('pages',$data['pages']=Page::where('status',1)->orderBy('order','ASC')->get());
        view()->share('categories',Category::where('status',1)->inRandomOrder()->get());
    }
    public function index()
    {
        $data['articles']=Article::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
            $query->where('status',1); })->orderBy('created_at','DESC')->paginate(10);
        $data['articles']->withPath(url('sayfa'));
        return view('front.homepage',$data);
    }

    public function single($category,$slug)
    {
        $category=Category::whereSlug($category)->first() ?? abort(403,'Böyle bir kategori bulunamadı.');
        $data['article']=Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Böyle bir yazı bulunamadı.');
      return view('front.single',$data);
    }
    public function category($slug)
    {
        $category=Category::whereSlug($slug)->first() ?? abort(403,'Böyle bir kategori bulunamadı.');
        $data['category']=$category;
        $data['articles']=Article::where('category_id',$category->id)->where('status',1)->orderBy('created_at','DESC')->paginate(10);
        return view('front.category',$data);
    }

    public function page($slug)
    {
        $page=Page::whereSlug($slug)->first() ?? abort(403,'Yanlış yerdesin.');
        $data['page']=$page;
        return view('front.page',$data);
    }

    public function contact()
    {
        return view('front.contact');
    }
    public function contactpost(Request $request)
    {
        $rules=
        [
            'name'=>'required|min:5',
            'email'=>'required|email',
            'topic'=>'required',
            'message'=>'required|min:10'
        ];
        $validate=Validator::make($request->post(),$rules);

        if($validate->fails())
        {
            toastr()->error('Hata!', 'Mesaj Gönderilemedi.');
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $contact = new Contact();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->topic=$request->topic;
        $contact->message=$request->message;
        $contact->save();
         toastr()->success('Başarılı!', 'Mesajınız başarıyla gönderildi.');
          return redirect()->back();

    }
}
