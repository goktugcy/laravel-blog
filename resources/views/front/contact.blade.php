@extends('front.layouts.master')
@section('title','İletişim Sayfası')
@section('bg','https://www.vanessaperde.com/images/iletisim.png')
@section('content')
<!-- Post Content -->

         <div class="container">
    <div class="row">
      <div class="col-md-8  text-white">
        @if (session('success'))
            <div class="alert alert-success">
              {{session('success')}}
            </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
          </ul>
        </div>
         
        @endif
        

        <p>Benimle iletişime geçebilirsin.</p>
        
        <form method="POST" action="{{route('contact.post')}}">
          @csrf
          <div class="control-group">
            <div class="form-group controls">
              <label>Ad Soyad</label>
            <input type="text" class="form-control bg-dark text-success" value="{{old('name')}}" placeholder="Ad Soyad" name="name" required >
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group controls">
              <label>E posta Addresi</label>
              <input type="email" class="form-control bg-dark text-success" value="{{old('email')}}" placeholder="Eposta Adresi" name="email" required >
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group controls">
              <label>Konu</label>
              <select class="form-control bg-dark text-success"  name="topic">
                <option @if(old('topic')=="Bilgi") selected @endif>Bilgi</option>
                <option @if(old('topic')=="Destek") selected @endif>Destek</option>
                <option @if(old('topic')=="Genel") selected @endif>Genel</option>
              </select>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group controls">
              <label>Mesaj</label>
              <textarea rows="5" class="form-control bg-dark text-success"  placeholder="Mesajınız" name="message" required>{{old('message')}}</textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
        </form>
      </div>
      <div class="col-12 col-sm-4">
            <div class="card bg-dark mb-3">
                <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> Adres</div>
                <div class="card-body text-white">
                    <p>Pendik / İstanbul</p>
                    <p>34899 Kaynarca</p>
                    <p>Email : email@example.com</p>
                    <p>Tel. +33 12 56 11 51 84</p>

                </div>
            </div>
        </div>
    </div>
    
  </div>

       
  @endsection