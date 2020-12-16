@extends('front.layouts.master')
@section('title',$page->title)
@section('bg',$page->image)
@section('content')
<!-- Post Content -->

       <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto text-white">
        <p>{!!$page->content!!}</p>
        
      </div>
    </div>
  </div>

  <hr>

        
  @endsection