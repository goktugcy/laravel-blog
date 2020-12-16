
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
               
                <div class="sidebar-brand-text mx-3">Admin Paneli </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item @if(Request::segment(2)=="panel")active @endif">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Ana Sayfa</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                içerik Yönetimi
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link @if(Request::segment(2)=="makaleler") active @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Makaleler</span>
                </a>
                <div id="collapseTwo" class="collapse @if(Request::segment(2)=="makaleler") show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Makale İşlemleri:</h6>
                        <a class="collapse-item @if(Request::segment(2)=="makaleler" and Request::segment(3)=="olustur") active @endif"  href="{{route('admin.makaleler.create')}}">Makale Ekle</a>
                        
                        <a class="collapse-item @if(Request::segment(2)=="makaleler"and !Request::segment(3)) active @endif" href="{{route('admin.makaleler.index')}}">Tüm Makaleler</a>
                    </div>
                </div>
            </li>

             <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" @if(Request::segment(2)=="kategoriler") style="color:white !important;" @endif href="{{route('admin.category.index')}}">
                    <i @if(Request::segment(2)=="kategoriler") style="color:white !important;" @endif class="fas fa-fw fa-list"></i>
                    <span>Kategoriler</span></a>
            </li>

              <!-- Sayfa İşlemleri -->
            <li class="nav-item">
                <a class="nav-link @if(Request::segment(2)=="sayfa") active @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapsePage"
                    aria-expanded="true" aria-controls="collapsePage">
                    <i class="fas fa-fw fa-paste"></i>
                    <span>Sayfalar</span>
                </a>
                <div id="collapsePage" class="collapse @if(Request::segment(2)=="sayfalar") show @endif" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sayfa İşlemleri:</h6>
                        <a class="collapse-item @if(Request::segment(2)=="sayfalar" and Request::segment(3)=="olustur") active @endif"  href="{{route('admin.page.create')}}">Sayfa Oluştur</a>
                        
                        <a class="collapse-item @if(Request::segment(2)=="sayfalar" and !Request::segment(3)) active @endif" href="{{route('admin.page.index')}}">Tüm Sayfalar</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Site Yönetimi 
            </div>

              <li class="nav-item">
                <a class="nav-link" @if(Request::segment(2)=="mesajlar") style="color:white !important;" @endif href="{{route('admin.contact.index')}}">
                    <i @if(Request::segment(2)=="mesajlar") style="color:white !important;" @endif class="fas fa-fw fa-inbox"></i>
                    <span>Gelen Mesajlar</span></a>
            </li>
           
            <!-- Nav Item - Tables -->
              <li class="nav-item">
                <a class="nav-link" @if(Request::segment(2)=="ayarlar") style="color:white !important;" @endif href="{{route('admin.settings.index')}}">
                    <i @if(Request::segment(2)=="ayarlar") style="color:white !important;" @endif class="fas fa-fw fa-cog"></i>
                    <span>Ayarlar</span></a>
            </li>

            
            <!-- Nav Item - Tables -->
              <li class="nav-item">
                <a class="nav-link" @if(Request::segment(2)=="profil") style="color:white !important;" @endif href="{{route('admin.settings.profile')}}">
                    <i @if(Request::segment(2)=="profil") style="color:white !important;" @endif class="fas fa-fw fa-user"></i>
                    <span>Profil</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

           

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                       @foreach($contacts as $contact)
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">{{$contact->count()}}</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Mesajlar
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.contact.index')}}">
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">{{ str_limit($contact->message,30)}}</div>
                                        <div class="small text-gray-500">{{$contact->name}} · {{$contact->created_at->diffForHumans()}}</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="{{route('admin.contact.index')}}">Gelen Kutusuna Git</a>
                            </div>
                        </li>
                        @endforeach
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                               <img class="img-profile rounded-circle" src="{{ $profiles->avatar }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('admin.settings.profile')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="{{route('admin.settings.index')}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ayarlar
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Çıkış Yap
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                        <a href="{{route('homepage')}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-home fa-sm text-white-50"></i> Siteyi Görüntüle</a>
                    </div>
