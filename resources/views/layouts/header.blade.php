<header class="main-header">

  <!-- Logo -->
  <a href="{{URL::to('/')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>T</b>MA</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">the<b>Mohammed</b>A</span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <span class="page-title">{{ $title }}</span>
    @if(isset($nav_links))
      <ul id="mnav" class="nav navbar-nav">
      @foreach($nav_links as $link)
        <li id="{{isset($link['id'])? $link['id']: '' }}"><a href="{{$link['link']}}"><i class="fa fa-{{$link['icon']}}"></i> {{$link['text']}}</span></a></li>
      @endforeach
      </ul>
    @endif

    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="{{URL::to('/logout')}}"><i class="fa fa-unlock"></i> Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</header>