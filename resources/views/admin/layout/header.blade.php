<div class="header navbar navbar-inverse navbar-fixed-top">
  <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="header-inner">
    <!-- BEGIN LOGO -->  
        <a class="navbar-brand" href="{{ url('admin') }}">
            &nbsp;&nbsp;Dashboard Admin
        </a>
    <!-- END LOGO -->
      
    <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <img src="{{ asset('assets/img/menu-toggler.png')}}" alt="" />
        </a> 
    <!-- END RESPONSIVE MENU TOGGLER -->
      
        <ul class="nav navbar-nav pull-right">
            <li><a href="{{ url('auth/adminlogout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>