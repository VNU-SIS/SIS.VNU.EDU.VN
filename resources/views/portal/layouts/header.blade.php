<div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  <span class="sr-only">Toggle navigation</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  </button>
  <a class="navbar-brand" href="{{ route('dashboard') }}">Quản lí</a>
</div>
<ul class="nav navbar-top-links navbar-right">
  <li class="dropdown">
     <a class="dropdown-toggle" data-toggle="dropdown" href="#">
     <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
     </a>
     <ul class="dropdown-menu dropdown-user">
        <li>
            <a href="{{ route('user.profile') }}">
               <i class="fa fa-user fa-fw"></i> User Profile
            </a>
        </li>
        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
        </li>
        <li class="divider"></li>
        <li id="logout">
            <a>
               <i class="fa fa-sign-out fa-fw"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('auth.post.logout') }}" method="POST" style="display: none;">
               @csrf
            </form>
        </li>
     </ul>
  </li>
</ul>