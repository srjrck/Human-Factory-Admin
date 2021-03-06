<input type="hidden" name="url" id="url" value='{{url("Admin/")}}'>
<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
<div id="wrapper">
  <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
      <a href="{{route('Dashboard')}}">
        <img src="{{ asset('public/logo.png')}}" style="width: 54%; margin-left: 40px;" alt="Logo">
      </a>
    </div>
    <div class="user-details">
      <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
        <div class="avatar">
          <img class="mr-3 side-user-img" src="{{Session::get('admin_image')}}" alt="user avatar">
        </div>
        <div class="media-body">
          <h6 class="side-user-name">{{Session::get('admin_name')}}</h6>
        </div>
      </div>
      <div id="user-dropdown" class="collapse">
        <ul class="user-setting-menu">
          <li><a href="{{route('Setting')}}"><i class="icon-settings"></i> Setting</a></li>
          <li><a href="{{route('Logout')}}"><i class="icon-power"></i> Logout</a></li>
        </ul>
     </div>
    </div>
    <ul class="sidebar-menu do-nicescrol">
      <li @if($Menu=='Dashboard') class="active" @endif>
        <a href="{{route('Dashboard')}}" class="waves-effect">
          <i class="icon-home"></i><span>Dashboard</span>
        </a>
      </li>
      <li @if($Menu=='Practitioner') class="active" @endif>
        <a href="{{route('Practitioner')}}" class="waves-effect">
          <i class="fa fa-briefcase"></i><span>Practitioner</span>
        </a>
      </li>
      <li @if($Menu=='CareTeam') class="active" @endif>
        <a href="{{route('CareTeam')}}" class="waves-effect">
          <i class="fa fa-briefcase"></i><span>Care Team</span>
        </a>
      </li>
      <li @if($Menu=='Patient') class="active" @endif>
        <a href="{{route('Patient')}}" class="waves-effect">
          <i class="fa fa-briefcase"></i><span>Patient</span>
        </a>
      </li>
      <li @if($Menu=='Encounter') class="active" @endif>
        <a href="{{route('Encounter')}}" class="waves-effect">
          <i class="fa fa-briefcase"></i><span>Encounter</span>
        </a>
      </li>
      <li @if($Menu=='Role') class="active" @endif>
        <a href="{{route('Role')}}" class="waves-effect">
          <i class="fa fa-briefcase"></i><span>Role</span>
        </a>
      </li>
      <!-- <li @if($Menu=='Identifier') class="active" @endif>
        <a href="{{route('Identifier')}}" class="waves-effect">
          <i class="fa fa-briefcase"></i><span>Identifier</span>
        </a>
      </li>
      <li @if($Menu=='Name') class="active" @endif>
        <a href="{{route('Name')}}" class="waves-effect">
          <i class="fa fa-briefcase"></i><span>Name</span>
        </a>
      </li>
      <li @if($Menu=='Telecom') class="active" @endif>
        <a href="{{route('Telecom')}}" class="waves-effect">
          <i class="fa fa-briefcase"></i><span>Telecom</span>
        </a>
      </li> -->
    </ul>
  </div>