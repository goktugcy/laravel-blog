@extends('back.layouts.master')
@section('title','Kategoriler')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 ">
                <h6 class=" m-0 font-weight-bold text-primary">Yeni Kategori Oluştur
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input type="text" class="form-control" name="category" />
                        <br>
                        <button type="submit" class="btn btn-sm btn-success float-right">Oluştur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 ">
                <h6 class=" m-0 font-weight-bold text-primary">@yield('title')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->articleCount() }}</td>
                                    <td>
                                        <input class="switch" type="checkbox" id="{{ $category->id }}"
                                            data-toggle="toggle" data-on="Aktif" data-off="Pasif"
                                            @if($category->status==1) checked @endif data-onstyle="success"
                                        data-offstyle="danger" data-width="100" >
                                    </td>
                                    <td>
                                        <a category-id="{{ $category->id }}" class="btn btn-sm btn-info edit-click"
                                            title="Kategori adını düzenle"><i class="fa fa-edit"></i></a>
                                           <a href="{{ route('admin.delete.category',$category->id) }}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                     
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('admin.category.update')}}" method="post">
                      @csrf
                      <div class="form-group">
                          <label>Kategori Adı</label>
                           <input type="text" class="form-control" name="category" id="category"/>
                           <input type="hidden" name="id" id="category_id"/>
                      </div>
                      
                        <div class="form-group">
                          <label>Kategori Slug</label>
                           <input type="text" class="form-control" name="slug" id="slug" />
                      </div>
                 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                     
                </div>
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
        $(function () {
            $('.edit-click').click(function () {
                id = $(this)[0].getAttribute('category-id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.category.edit') }}',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        console.log(data);
                        $('#category').val(data.name);
                        $('#category_id').val(data.id);
                        $('#slug').val(data.slug);
                        $('#editModal').modal();
                    }
                });
            });

            $('.switch').on('change', function () {
                const id = this.id;
                let statu = $(this).prop('checked');
                $.get("{{ url('/admin/switch') }}/" + id, {
                    statu: statu
                }, function (data, status) {
                        bootoast.toast({
                    message: 'Aktiflik durumu başarıyla güncellendi.',
                    type: 'success'
                    });
                })

            });
        });

    </script>
    @endsection
