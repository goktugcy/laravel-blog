@extends('back.layouts.master')
@section('title','Gelen Kutusu')
@section('content')

   <!-- Begin Page Content -->
                <div class="container-fluid">

                
       <!-- DataTales Example -->
                    <div class="card shadow mb-5">
                        <div class="card-header py-3 ">
                            <h6 class=" m-0 font-weight-bold text-primary">
                                <span class="float-right">{{$contacts->count()}} mesaj bulundu.
                            </h6>
                             </span>
                            </div>
                            
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Konu Başlığı</th>
                                            <th>Eposta </th>
                                            <th>Ad Soyad</th>
                                            <th>İçerik</th>
                                            <th>İşlemler</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{$contact->topic}}</td>
                                            <td>{{$contact->email}}</td>
                                            <td>{{$contact->name}}</td>
                                            <td>{{ str_limit($contact->message,30)}}</td>
                                            <td> 
                                                <button title="Görüntüle" data-toggle="modal" data-target="#showModal" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></button>
                                                <a class="btn btn-sm btn-primary" href="mailto:{{$contact->email}}"><i class="fa fa-paper-plane"></i></a>
                                                <a href="{{route('admin.contact.delete',$contact->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                          
                                        </tr>
                                
                                        @endforeach
                                   
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


@foreach($contacts as $contact)
           <!-- Modal -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{$contact->topic}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{!!$contact->message!!}</p>
      </div>
      <div class="modal-footer">
           <div class="small text-gray-700 text-left ">{{$contact->name}} · {{$contact->email}} · {{$contact->created_at->diffForHumans()}}</div>
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach


@endsection


