@php $user = Auth::user(); @endphp
<div class="navbar-default sidebar" role="navigation">
   <div class="sidebar-nav navbar-collapse">
      <ul class="nav" id="side-menu">
         {{-- <li class="sidebar-search">
            <div class="input-group custom-search-form">
               <input type="text" class="form-control" placeholder="Search...">
               <span class="input-group-btn">
                  <button class="btn btn-default" type="button">
                     <i class="fa fa-search"></i>
                  </button>
               </span>
            </div>
         </li> --}}
         @if ($user->role==2)
          <li>
              <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
          </li>
         @endif
         @if ($user->role==2)
         <li>
            <a href="{{ route('categories.index') }}"><i class="fa fa-th-list fa-fw"></i> {{ trans('messages.category.name') }}<span
                  class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li>
                  <a href="{{ route('categories.create') }}">{{ trans('messages.category.label.create') }}</a>
               </li>
               <li>
                  <a href="{{ route('categories.index') }}">{{ trans('messages.category.label.list') }}</a>
               </li>
            </ul>
         </li>
         @endif
         @if ($user->role==2 || $user->role==3)
         <li>
            <a href="#"><i class="fa fa-book fa-fw"></i> {{ trans('messages.post.name') }}<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li>
                  <a href="{{ route('posts.create') }}">{{ trans('messages.post.label.create') }}</a>
               </li>
               <li>
                  <a href="{{ route('posts.index') }}">{{ trans('messages.post.label.list') }}</a>
               </li>
            </ul>
         </li>
         @endif
         @if ($user->role==2)
         <li>
            {{-- <a href="{{ route('user.list') }}"><i class="fa fa-user fa-fw"></i> {{ trans('messages.user.name') }}</a> --}}

            <a href="#"><i class="fa fa-user fa-fw"></i> {{ trans('messages.user.name') }}<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li>
                  <a href="{{ route('user.list') }}">{{ trans('messages.user.label.list_sidebar') }}</a>
               </li>
               <li>
                  <a href="{{ route('user.create') }}">{{ trans('messages.user.label.create_sidebar') }}</a>
               </li>
            </ul>
         </li>
         @endif
         @if ($user->role==2)
         <li>
            <a href="{{ route('structures.list') }}"><i class="fa fa-users fa-fw"></i> {{ trans('messages.structure_users.title') }}</a>
         </li>
         @endif
         {{-- <li>
            <a href="{{ route('department.list') }}"><i class="fa fa-group fa-fw"></i> {{ trans('messages.departments.name') }}</a>
         </li> --}}
         @if ($user->role==2)
         <li>
            <a href="#"><i class="fa fa-image fa-fw"></i> {{ trans('messages.gallery.name') }}<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li>
                  <a href="{{ route('galleries.create') }}">{{ trans('messages.gallery.label.create') }}</a>
               </li>
               <li>
                  <a href="{{ route('galleries.index') }}">{{ trans('messages.gallery.label.list') }}</a>
               </li>
               <li>
                  <a href="{{ route('youtube.edit') }}">{{ trans('messages.youtube.label.edit') }}</a>
               </li>
            </ul>
         </li>
         @endif
      </ul>
   </div>
</div>