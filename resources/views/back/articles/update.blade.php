@extends('back.layouts.master')
@section('title',$article->title. ' Makalesini güncelle')
@section('content')

   <!-- Begin Page Content -->
                <div class="container-fluid">

                
       <!-- DataTales Example -->
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">@yield('title')
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                   <li>{{$error}}</li>
                                @endforeach
                                    </div>
                                
                                @endif
                        
                          
                            <form action="{{route('admin.makaleler.update',$article->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <div class="form-group">
                                <label>Makale Başlığı</label>
                                <input type="text" name="title" class="form-control" value="{{$article->title}}" required></input>
                            </div>
                             <div class="form-group">
                                <label>Makale Kategorisi</label>
                                <select name="category" class="form-control" required>
                                    <option >Seçim Yapınız</option>
                                    @foreach ($categories as $category)
                                        <option @if ($article->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                             <div class="form-group">
                                <label>Makale Fotoğrafı</label>
                                <br>
                                <img style="width:18rem;" src="{{$article->image}}"  class="img-thumbnail">
                                <input type="file" name="image" class="form-control"></input>
                            </div>

                             <div class="form-group">
                                <label>Makale İçeriği</label>
                               <textarea id="editor" name="content" class="form-control" rows="10">{!!$article->content!!}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" >Makaleyi Güncelle</button>
                            </div>
                        </form>
                    </div>
                </div>
                
@endsection


@section('js')
<script>
    $(document).ready(function() {
        $('#editor').summernote(
            {
                'height':300
            }
        );
    });
  </script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
