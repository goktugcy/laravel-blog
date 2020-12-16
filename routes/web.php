<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\homepage;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\ContactController;
use App\Http\Controllers\Back\SettingsController;

/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
|
*/
Route::get('aktif-degil', function () {
         return view('front.offline');
     });
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
    Route::get('giris',[AuthController::class,'login'])->name('login');
    Route::post('giris',[AuthController::class,'loginPost'])->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('panel',[Dashboard::class,'index'])->name('dashboard');
   

    //MAKALE ROUTE'S

    Route::get('/makaleler/silinenler/',[ArticleController::class,'trashed'])->name('trashed.article');
    Route::resource('makaleler', 'App\Http\Controllers\Back\ArticleController');
    Route::get('articleswitch/{id}/',[ArticleController::class,'articleswitch'])->name('switch.article');
    Route::get('/deletearticle/{id}/',[ArticleController::class,'delete'])->name('delete.article');
    Route::get('/destroyarticle/{id}/',[ArticleController::class,'destroy'])->name('destroy.article');
    Route::get('/recoverarticle/{id}/',[ArticleController::class,'recover'])->name('recover.article');
   
    //KATEGORİ ROUTE'S

    Route::get('kategoriler',[CategoryController::class,'index'])->name('category.index');
    Route::get('switch/{id}',[CategoryController::class,'switch'])->name('switch');
    Route::post('kategoriler/create',[CategoryController::class,'create'])->name('category.create');
    Route::get('/deletecategory/{id}/',[CategoryController::class,'hardDelete'])->name('delete.category');
    Route::get('kategori/edit',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('kategori/update',[CategoryController::class,'update'])->name('category.update');
    
    //PAGE ROUTE'S
    Route::get('sayfalar',[PageController::class,'index'])->name('page.index');
    Route::get('sayfalar/olustur',[PageController::class,'create'])->name('page.create');
    Route::post('sayfalar/olustur',[PageController::class,'post'])->name('page.post');
    Route::get('sayfalar/duzenle/{id}',[PageController::class,'edit'])->name('page.edit');
    Route::post('sayfalar/duzenle/{id}',[PageController::class,'editPost'])->name('page.edit.post');
    Route::get('sayfalar/silinen/{id}',[PageController::class,'delete'])->name('page.delete');
    Route::get('sayfalar/silinenler',[PageController::class,'trashed'])->name('page.trashed');
    Route::get('/recoverpage/{id}/',[PageController::class,'recover'])->name('page.recover');
    Route::get('/destroypage/{id}/',[PageController::class,'destroy'])->name('page.destroy');
    Route::get('pageswitch/{id}',[PageController::class,'pageswitch'])->name('switch');
    Route::get('sayfalar/siralama',[PageController::class,'orders'])->name('page.orders');
   

    //CONTACT PAGE'S
    Route::get('mesajlar', [ContactController::class,'index'])->name('contact.index');
    Route::get('mesajlar/sil/{id}',[ContactController::class,'delete'])->name('contact.delete');

    //SETTİNGS ROUTE'S
     Route::get('ayarlar',[SettingsController::class,'index'])->name('settings.index');
     Route::post('ayarlar/guncelle',[SettingsController::class,'update'])->name('settings.update');

     //PROFİLE ROUTE'S
     Route::get('profil',[AuthController::class,'index'])->name('settings.profile');
     Route::post('profil/guncelle', [AuthController::class,'update'])->name('profile.update');
     
     
    //
    Route::get('cikis',[AuthController::class,'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [homepage::class, 'index'])->name('homepage');
Route::get('sayfa',[homepage::class,'index']);
Route::get('iletisim',[homepage::class, 'contact'])->name('contact');
Route::post('iletisim',[homepage::class,'contactpost'])->name('contact.post');
Route::get('/kategori/{category}',[homepage::class, 'category'])->name('category');
Route::get('/{category}/{slug}',[homepage::class, 'single'])->name('single');
Route::get('/{sayfa}',[homepage::class, 'page'])->name('page');

