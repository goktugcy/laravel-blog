@extends('front.layouts.master')
@section('title',$article->title)
@section('bg',$article->image)
@section('content')
<!-- Post Content -->

        <div class="col-md-9 mx-auto text-white">
        
      {!!$article->content!!}
        </div>

          @include('front.widgets.menu')
     
  @endsection