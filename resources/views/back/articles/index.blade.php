@extends('back.layouts.master')
@section('title','Makaleler')
@section('content')

   <!-- Begin Page Content -->
                <div class="container-fluid">

                
       <!-- DataTales Example -->
                    <div class="card shadow mb-5">
                        <div class="card-header py-3 ">
                            <h6 class=" m-0 font-weight-bold text-primary">
                                <span class="float-right">{{$articles->count()}} makale bulundu.
                            <a href="{{route('admin.trashed.article')}}" class="btn btn-sm btn-warning" ><i class="fa fa-trash"></i>Silinen Makaleler</a>
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
                                            <th>Durum</th>
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
                                            <td>
                                                <input  class="switch" type="checkbox" id="{{$article->id}}" data-toggle="toggle" data-on="Aktif" data-off="Pasif" @if($article->status==1) checked @endif data-onstyle="success" data-offstyle="danger" data-width="100" >
                                        
                                            </td>
                                            <td> 
                                                <a target="_blank" href="{{route('single',[$article->getCategory->slug,$article->slug])}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('admin.makaleler.edit',$article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('admin.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootoast@1.0.1/src/bootoast.css">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootoast@1.0.1/src/bootoast.js"></script>
<script>
  $('.switch').on('change', function(){
      const id = this.id;
                let statu = $(this).prop('checked');
                $.get("{{url('admin/articleswitch')}}/"+id, {statu:statu}, function (data,status){
                        bootoast.toast({
                    message: 'Aktiflik durumu başarıyla güncellendi.',
                    type: 'success'
                    });
                })
         
  })
</script>
@endsection
