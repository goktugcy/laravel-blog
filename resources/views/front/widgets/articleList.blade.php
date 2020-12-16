  @if (count($articles)>0)
 @foreach ($articles as $article)

      
 
        <div class="post-preview">
          <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
            <h2 class="post-title">
              {{$article->title}}
            </h2>
            <img src="{{$article->image}}" height="400" width="800" />
            <h3 class="post-subtitle">
              {!! str_limit($article->content,120)!!}
            </h3>
          </a>
          <p class="post-meta">
            <a class="text-danger" href="#">{{$article->getCategory->name}}</a>
           <span class="float-right"> {{$article->created_at->diffForHumans()}}</span></p>
        </div>
        
        @if (!$loop->last)
                <hr> 
        @endif
               
       @endforeach
       <div class="d-flex justify-content-center">
     {{$articles->links(("pagination::bootstrap-4"))}}
       </div>
        @else 
   
      <div class="d-flex justify-content-center alert text-danger error " >
        <h1>Bu kategoride hiç yazı yok!</h1>
      </div>
      
       @endif
