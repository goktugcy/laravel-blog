@extends('back.layouts.master')
@section('title','Admin Paneli')
@section('content')

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Toplam Makale Sayısı</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $article }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-edit fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Toplam Kategori Sayısı</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $category }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Toplam Sayfa Sayısı
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">{{ $page }}</div>
                            </div>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Site Durumu</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <select name="active" class="form-control" disabled>
                                <option @if ($settings->active==1) selected @endif value="1" disabled>Açık</option>
                                <option @if ($settings->active==0) selected @endif value="0" disabled>Kapalı</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-server fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-5">
    <div class="card-header py-3 ">
        İçerik Özetleri
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">

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
                <a href="{{route('admin.makaleler.create')}}"  class="btn btn-md btn-block btn-success float-right">Yeni Makale Yaz </a>
                <br>
                <br>
                <a href="{{route('admin.page.create')}}"  class="btn btn-md btn-block btn-primary float-right">Yeni Sayfa Oluştur </a>
             
            </div>
             

            <div class="col-md-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 ">
                        <h6 class=" m-0 font-weight-bold text-primary">Makaleler
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Makale Başlığı</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                    @foreach ($article1 as $article)
                                        <tr>
                                            <td>{{$article->title}}</td>
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
</div>


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
        });
</script>
@endsection
