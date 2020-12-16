 </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              @php $socials=['facebook','twitter','instagram','youtube','github','linkedin'];
                 @endphp
                 @foreach($socials as $social)
                 @if($settings->$social!=null)
              
            <li class="list-inline-item">
              <a target="_blank" href="{{$settings->$social}}">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-{{$social}} fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            @endif
            @endforeach
          </ul>
          <p class="copyright text-muted">Copyright &copy; {{$settings->title}} 2020</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('front/')}}/vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('front/')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="{{asset('front/')}}/js/clean-blog.min.js"></script>
  
   @toastr_js
    {!! Toastr::render() !!}
</body>

</html>
