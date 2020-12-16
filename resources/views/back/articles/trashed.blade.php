@extends('back.layouts.master')
@section('title','Silinmiş Makaleler')
@section('content')

   <!-- Begin Page Content -->
                <div class="container-fluid">

                
       <!-- DataTales Example -->
                    <div class="card shadow mb-5">
                        <div class="card-header py-3 ">
                            <h6 class=" m-0 font-weight-bold text-primary">
                                <span class="float-right">{{$articles->count()}} makale bulundu.
                                     <a href="{{route('admin.makaleler.index')}}" class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i>Tüm Makaleler</a>
                            
                           </h6>
                             </span>
                            </div>
                            
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Resim</th>
                                            <th>Makale Başlığı</th>
                                            <th>Kategori</th>
                                            <th>Makale Tarihi</th>
                                            <th>Güncelleme</th>
                                          
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                    @foreach ($articles as $article)
                                        <tr>
                                            <td><img src="{{$article->image}}" width="100" /></td>
                                            <td>{{$article->title}}</td>
                                            <td>{{$article->getCategory->name}}</td>
                                            <td>{{$article->created_at->diffForHumans()}}</td>
                                            <td>{{$article->updated_at->diffForHumans()}}</td>
                                            <td> 
                                                <a href="{{route('admin.recover.article',$article->id)}}" title="Yazıyı Kurtar" class="btn btn-sm btn-info"><i class="fa fa-trash-restore-alt"></i></a>
                                                <a href="{{route('admin.destroy.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                
                                        @endforeach
                                   
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
@endsection

@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

@endsection
