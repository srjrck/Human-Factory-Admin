<!DOCTYPE html>
<html lang="en">

@include('Admin/Layouts/Head')

<body>

  @include('Admin/Layouts/Menu')
  @include('Admin/Layouts/Header')

  <div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Setting</li>
          </ol>
        </div>
      </div>
     
      <div class="row">
        <div class="col-lg-4">
          <div class="profile-card-4">
            <div class="card">
              <div class="card-body text-center bg-primary rounded-top">
                <div class="user-box">
                  <?php
                  $Image = asset('public/Admin/assets/images/logo-icon.png');
                  if($Setting->image!=''){
                    $Image = asset('public/Admin/assets/images/'.$Setting->image);
                  }
                  ?>
                  <img src="{{$Image}}" id="ImagePreview" alt="{{$Setting->name}}">
                </div>
                <h5 class="mb-1 text-white">{{$Setting->name}}</h5>
                <h6 class="text-light">Administrator</h6>
              </div>
              <div class="card-body">
                <ul class="list-group shadow-none">
                  <li class="list-group-item">
                    <div class="list-icon">
                      <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="list-details">
                      <span>{{$Setting->address}}</span>
                      <small>Address</small>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="list-icon">
                      <i class="fa fa-plane"></i>
                    </div>
                    <div class="list-details">
                      <span>{{$Setting->city}}</span>
                      <small>City</small>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="list-icon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <div class="list-details">
                      <span>{{$Setting->phone}}</span>
                      <small>Phone</small>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="list-icon">
                      <i class="fa fa-envelope"></i>
                    </div>
                    <div class="list-details">
                      <span>{{$Setting->email}}</span>
                      <small>Email Address</small>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="card-footer text-center">
                @if($SocialMedia->facebook!='')
                  <a target="_blank" href="{{$SocialMedia->facebook}}" class="btn-social btn-facebook waves-effect waves-light m-1">
                    <i class="fa fa-facebook"></i>
                  </a>
                @endif
                @if($SocialMedia->twitter!='')
                  <a href="{{$SocialMedia->twitter}}" target="_blank" class="btn-social btn-twitter waves-effect waves-light m-1">
                    <i class="fa fa-twitter"></i>
                  </a>
                @endif
                @if($SocialMedia->instagram!='')
                  <a href="{{$SocialMedia->instagram}}" target="_blank" class="btn-social btn-facebook waves-effect waves-light">
                    <i class="fa fa-instagram"></i>
                  </a>
                @endif
                @if($SocialMedia->youtube!='')
                  <a href="{{$SocialMedia->youtube}}" target="_blank" class="btn-social btn-youtube waves-effect waves-light m-1">
                    <i class="fa fa-youtube"></i>
                  </a>
                @endif
                @if($SocialMedia->linkedin!='')
                  <a href="{{$SocialMedia->linkedin}}" target="_blank" class="btn-social btn-linkedin waves-effect waves-light m-1">
                    <i class="fa fa-linkedin"></i>
                  </a>
                @endif
                @if($SocialMedia->pinterest!='')
                  <a href="{{$SocialMedia->pinterest}}" target="_blank" class="btn-social btn-pinterest waves-effect waves-light m-1">
                    <i class="fa fa-pinterest"></i>
                  </a>
                @endif  
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <span id="Profile_msg">
                @if(Session::has('message'))           
                  <?=Session::get('message')?>
                @endif
              </span>
              <ul class="nav nav-pills nav-pills-primary nav-justified">
                <li class="nav-item">
                  <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active show"> Profile</a>
                </li>
                <li class="nav-item">
                  <a href="javascript:void();" data-target="#ChangePassword" data-toggle="pill" class="nav-link">Change Password</a>
                </li>
                <li class="nav-item">
                  <a href="javascript:void();" data-target="#SocialMedia" data-toggle="pill" class="nav-link">
                    Social Media
                  </a>
                </li>
                <li class="nav-item">
                  <a href="javascript:void();" data-target="#Setting" data-toggle="pill" class="nav-link">
                    Setting
                  </a>
                </li>
              </ul>
              <div class="tab-content p-3">
                <div class="tab-pane active show" id="profile">
                  <div class="row">
                    <div class="col-lg-12">
                      <form method="post" action="{{route('UpdateProfile')}}" id="ProfileForm" name="ProfileForm" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Name</label>
                          <div class="col-lg-8">
                            <input class="form-control" type="text" name="name" id="name" value="{{$Setting->name}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Email</label>
                          <div class="col-lg-8">
                            <input class="form-control" type="email" name="email" id="email" value="{{$Setting->email}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Phone</label>
                          <div class="col-lg-8">
                            <input class="form-control" type="text" name="phone" id="phone" value="{{$Setting->phone}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">City</label>
                          <div class="col-lg-8">
                            <input class="form-control" type="text" name="city" id="city" value="{{$Setting->city}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Address</label>
                          <div class="col-lg-8">
                            <input class="form-control" type="text" name="address" id="address" value="{{$Setting->address}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Profile Image</label>
                          <div class="col-lg-8">
                            <input class="form-control" id="profile_img" name="profile_img" accept="image/*" type="file">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-3 col-form-label form-control-label"></label>
                          <div class="col-lg-9">
                            <input type="submit" class="btn btn-primary" value="Save">
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="ChangePassword">
                  <div class="row">
                    <div class="col-lg-12">
                      <form method="post" action="" id="ChangePasswrodForm" name="ChangePasswrodForm" >
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Old Password</label>
                          <div class="col-lg-8">
                            <input class="form-control" type="text" name="old_password" id="old_password" value="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">New Password</label>
                          <div class="col-lg-8">
                            <input class="form-control" type="password" name="new_password" id="new_password" value="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Confirm Password</label>
                          <div class="col-lg-8">
                            <input class="form-control" type="password" id="confirm_password" name="confirm_password">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-3 col-form-label form-control-label"></label>
                          <div class="col-lg-9">
                            <input type="submit" class="btn btn-primary" id="ChangePasswordBtn" value="Save">
                          </div>
                        </div>
                      </form>  
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="SocialMedia">
                  <div class="row">
                    <div class="col-lg-12">
                      <form method="post" action="{{route('UpdateSocialMedia')}}" id="SocialMediaForm" name="SocialMediaForm" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Facebook</label>
                          <div class="col-lg-8">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-facebook-official"></i></span>
                              </div>
                              <input class="form-control" type="text" name="facebook" id="facebook" placeholder="https//www.facebook.com" value="{{$SocialMedia->facebook}}">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Twitter</label>
                          <div class="col-lg-8">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-twitter-square"></i></span>
                              </div>
                              <input class="form-control" type="text" name="twitter" id="twitter" placeholder="https//www.twitter.com" value="{{$SocialMedia->twitter}}">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Instagram</label>
                          <div class="col-lg-8">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                              </div>
                              <input class="form-control" type="text" name="instagram" id="instagram" placeholder="https//www.instagram.com" value="{{$SocialMedia->instagram}}">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">YouTube</label>
                          <div class="col-lg-8">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-youtube-square"></i></span>
                              </div>
                              <input class="form-control" type="text" name="youtube" id="youtube" placeholder="https//www.youtube.com" value="{{$SocialMedia->youtube}}">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">LinkedIn</label>
                          <div class="col-lg-8">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-linkedin-square"></i></span>
                              </div>
                              <input class="form-control" type="text" name="linkedin" id="linkedin" placeholder="https//www.linkedin.com" value="{{$SocialMedia->linkedin}}">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Pinterest</label>
                          <div class="col-lg-8">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-pinterest"></i></span>
                              </div>
                              <input class="form-control" type="text" name="pinterest" id="pinterest" placeholder="https//www.pinterest.com" value="{{$SocialMedia->pinterest}}">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-3 col-form-label form-control-label"></label>
                          <div class="col-lg-9">
                            <input type="submit" class="btn btn-primary" value="Save">
                          </div>
                        </div>
                      </form>  
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="Setting">
                  <div class="row">
                    <div class="col-lg-12">
                      <form method="post" action="{{route('UpdatePagination')}}" id="PaginationForm" name="PaginationForm" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Number of results per page</label>
                          <div class="col-lg-8">
                            <input class="form-control" type="text" name="no_of_page" id="no_of_page" value="{{$Setting->no_of_page}}" maxlength="3">
                          </div>
                        </div>
                        <div class="form-group row" style="display: none;">
                          <label class="col-lg-4 col-form-label form-control-label">Refer Amount</label>
                          <div class="col-lg-8">
                            <input class="form-control Number" type="text" name="refer_amt" id="refer_amt" value="{{$Setting->refer_amt}}" placeholder="Refer Amount" maxlength="5">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label form-control-label">Analytics Code</label>
                          <div class="col-lg-8">
                            <textarea class="form-control" id="analytics_code" name="analytics_code" style="height: 250px;">{{$Setting->analytics_code}}</textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-lg-3 col-form-label form-control-label"></label>
                          <div class="col-lg-9">
                            <input type="submit" class="btn btn-primary" value="Save">
                          </div>
                        </div>
                      </form>  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>     
    </div>
  </div>

  @include('Admin/Layouts/Footer')  
  <script src="{{ asset('public/Admin')}}/assets/validation/Setting.js"></script>
  
</body>
</html>  