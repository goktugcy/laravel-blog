@isset($categories)
    

<div class="col-md-3  ">
 <div class="card bg-dark">
     <div class="card-header bg-dark text-danger ">
         Kategoriler
     </div>
<ul class="list-group bg-dark">
  @foreach ($categories as $category)
   
  <li class="list-group-item d-flex justify-content-between align-items-center bg-dark   @if(Request::segment(2)==$category->slug) active @endif class="text-danger"">
  
    <a class="text-danger" href="{{route('category',$category->slug)}}">{{$category->name}}</a>
    <span class="badge badge-primary badge-pill">{{$category->articleCount()}}</span>
  </li>
  @endforeach
</ul>
 </div>
</div>
@endif