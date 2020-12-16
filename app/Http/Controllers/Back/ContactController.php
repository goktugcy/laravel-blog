<?php

namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;

class ContactController extends Controller
{
     public function index()
    {
        $contacts=Contact::all();
    return view('back.contact.index',compact('contacts'));
    }

    public function delete($id)
    {
      $contacts =  Contact::find($id)->delete();
        toastr()->warning('Mesaj tamamen silindi.');
        return redirect()->back();
    }
   
   
  }
