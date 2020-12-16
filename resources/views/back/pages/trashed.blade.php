@extends('back.layouts.master')
@section('title','Silinmiş Sayfalar')
@section('content')

   <!-- Begin Page Content -->
                <div class="container-fluid">

                
       <!-- DataTales Example -->
                    <div class="card shadow mb-5">
                        <div class="card-header py-3 ">
                            <h6 class=" m-0 font-weight-bold text-primary">
                                <span class="float-right">{{$pages->count()}} sayfa bulundu.
                                     <a href="{{route('admin.page.index')}}" class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i>Tüm Sayfalar</a>
                            
                           </h6>
                             </span>
                            </div>
                            
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Resim</th>
                                            <th>Sayfa Başlığı</th>
                                            <th>Silinme Tarihi</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                    @foreach ($pages as $page)
                                        <tr>
                                            <td><img src="{{$page->image}}" width="100" /></td>
                                            <td>{{$page->title}}</td>
                                            <td>{{$page->deleted_at->diffForHumans()}}</td>
                                            <td> 
                                                <a href="{{route('admin.page.recover',$page->id)}}" title="Yazıyı Kurtar" class="btn btn-sm btn-info"><i class="fa fa-trash-restore-alt"></i></a>
                                                <a href="{{route('admin.page.destroy',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
