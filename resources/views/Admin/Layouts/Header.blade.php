<header class="topbar-nav">
  <nav class="navbar navbar-expand fixed-top gradient-ibiza">
    <ul class="navbar-nav mr-auto align-items-center">
      <li class="nav-item">
        <a class="nav-link toggle-menu" href="javascript:void();">
          <i class="icon-menu menu-icon"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav align-items-center right-nav-link">
      <!-- <li class="nav-item dropdown-lg">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
          <i class="icon-envelope-open"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right animated fadeIn">
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              You have 4 new messages
              <span class="badge badge-danger">4</span>
            </li>
            <li class="list-group-item">
              <a href="javaScript:void();">
                <div class="media">
                  <div class="avatar">
                    <img class="align-self-start mr-3" src="{{ asset('public/Admin')}}/assets/images/avatars/avatar-1.png" alt="user avatar">
                  </div>
                  <div class="media-body">
                    <h6 class="mt-0 msg-title">Jhon Deo</h6>
                    <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                    <small>Today, 4:10 PM</small>
                  </div>
                </div>
              </a>
            </li>
            <li class="list-group-item"><a href="javaScript:void();">See All Messages</a></li>
          </ul>
        </div>
      </li>
      
      <li class="nav-item dropdown-lg">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
          <i class="icon-bell"></i><span class="badge badge-primary badge-up">10</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right animated fadeIn">
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              You have 10 Notifications
              <span class="badge badge-primary">10</span>
            </li>
            <li class="list-group-item">
              <a href="javaScript:void();">
                <div class="media">
                  <i class="icon-people fa-2x mr-3 text-info"></i>
                  <div class="media-body">
                    <h6 class="mt-0 msg-title">New Registered Users</h6>
                    <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                  </div>
                </div>
              </a>
            </li>
            <li class="list-group-item"><a href="javaScript:void();">See All Notifications</a></li>
          </ul>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
          <span class="user-profile">
            <img src="{{Session::get('admin_image')}}" class="img-circle" alt="user avatar">
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right animated fadeIn">
          <li class="dropdown-item user-details">
            <a href="javaScript:void();">
              <div class="media">
                <div class="avatar">
                  <img class="align-self-start mr-3" src="{{Session::get('admin_image')}}" alt="user avatar">
                </div>
                <div class="media-body">
                  <h6 class="mt-2 user-title">{{Session::get('admin_name')}}</h6>
                  <p class="user-subtitle">{{Session::get('admin_email')}}</p>
                </div>
              </div>
            </a>
          </li>
          <li class="dropdown-divider"></li>
          <li class="dropdown-item"><a href="{{route('Setting')}}"><i class="icon-wallet mr-2"></i> Setting</a></li>
          <li class="dropdown-divider"></li>
          <li class="dropdown-item"><a href="{{route('Logout')}}"><i class="icon-power mr-2"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</header>