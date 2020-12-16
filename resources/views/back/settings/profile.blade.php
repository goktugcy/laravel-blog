@extends('back.layouts.master')
@section('title','Site Ayarları')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-5">
        <div class="card-header py-3 ">
            Profil Ayarları
        </div>
        <div class="card-body">
            @foreach($profile as $profiles)
                <form method="POST" action="{{route('admin.profile.update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Profil Fotoğrafı</label>
                            <br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="avatar">
                                <label class="custom-file-label" for="inputGroupFile01">Göz At</label>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kullanıcı Adı</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control" value="{{ $profiles->name }}"
                                        required>
                                </div>
                            </div>
                         </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Şifre</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fa fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control"
                                        value="{{ $profiles->password }}" required>
                                </div>
                            </div>
                            </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E posta </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fa fa-at"></i></span>
                                            </div>
                                            <input type="text" name="email" class="form-control"
                                                value="{{ $profiles->email }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div style="float: none position: relative; margin:auto;">
                                     <img style="width:10rem;" src="{{ $profiles->avatar }}" class="img-thumbnail">
                                </div>
                            
                        </div>
                    

                    </div>
               
        <button type="submit" class="btn btn-block btn-md btn-success">Güncelle</button>
    </div>

</div>

@endforeach
@endsection
