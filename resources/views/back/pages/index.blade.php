@extends('back.layouts.master')
@section('title','Sayfalar')
@section('content')

   <!-- Begin Page Content -->
                <div class="container-fluid">

                
       <!-- DataTales Example -->
                    <div class="card shadow mb-5">
                        <div class="card-header py-3 ">
                            <h6 class=" m-0 font-weight-bold text-primary">
                                <span class="float-right">{{$pages->count()}} makale bulundu.
                                     <a href="{{route('admin.page.trashed')}}" class="btn btn-sm btn-warning" ><i class="fa fa-trash"></i>Silinen Sayfalar</a>
                            </h6>
                             </span>
                            </div>
                            
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sıralama</th>
                                            <th>Resim</th>
                                            <th>Sayfa Başlığı</th>
                                            <th>Durum</th>
                                            <th>İşlemler</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                     <tbody id="orders">
                                    @foreach ($pages as $page)
                                        <tr id="page_{{$page->id}}">
                                              <td style="width:5% !important; text-align:center;"><i style="cursor: move;" class="fa fa-arrows-alt-v fa-3x handle"></i></td>
                                            <td><img src="{{$page->image}}" width="100" /></td>
                                            <td>{{$page->title}}</td>
                                           
                                            <td>
                                                <input  class="switch" type="checkbox" id="{{$page->id}}" data-toggle="toggle" data-on="Aktif" data-off="Pasif" @if($page->status==1) checked @endif  data-onstyle="success" data-offstyle="danger" data-width="100" >
                                        
                                            </td>
                                            <td> 
                                                <a target="_blank" href="{{route('page',$page->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('admin.page.edit',$page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('admin.page.delete',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootoast@1.0.1/src/bootoast.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js" integrity="sha512-ELgdXEUQM5x+vB2mycmnSCsiDZWQYXKwlzh9+p+Hff4f5LA+uf0w2pOp3j7UAuSAajxfEzmYZNOOLQuiotrt9Q==" crossorigin="anonymous"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootoast@1.0.1/src/bootoast.js"></script>
<script>
    $('#orders').sortable({
        handle:'.handle',
        update:function () {
            var siralama = $('#orders').sortable('serialize');
            $.get("{{route('admin.page.orders')}}?"+siralama,function(data,status){
                bootoast.toast({
                message: 'Sıralama başarıyla güncellendi.',
                type: 'success'
                });
            });   
            }
    });
</script>
<script>
  $('.switch').on('change', function(){
      const id = this.id;
                let statu = $(this).prop('checked');
                $.get("{{url('admin/pageswitch')}}/"+id, {statu:statu}, function (data,status){
                    bootoast.toast({
                    message: 'Aktiflik durumu başarıyla güncellendi.',
                    type: 'success'
                    });
                })
         
  })
</script>
@endsection
