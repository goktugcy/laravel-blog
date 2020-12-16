@extends('front.layouts.master')
@section('title',$category->name. ' Kategorisi')
@section('content')
  <div class=" col-lg-8 col-md-9 mx-auto">
   @include('front.widgets.articleList')
      </div>
     @include('front.widgets.menu')
@endsection
  