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
            <li class="breadcrumb-item"><a href="{{route('Role')}}">Role</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add</li>
          </ol>
        </div>
      </div>   
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Add</div>
              <hr>
              <span id="Return_msg">
                <?php
                if(Session::has('message')){
                  echo Session::get('message');
                }
                ?>
              </span>
              <form action="{{route('InsertRole')}}" method="post" id="Add" name="Add" novalidate="novalidate">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">System</label>
                      <input type="text" class="form-control" id="system" name="system" placeholder="System">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Code</label>
                      <input type="text" class="form-control" id="code" name="code" placeholder="Code">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Display</label>
                      <input type="text" class="form-control" id="display" name="display" placeholder="Display">
                    </div> 
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary  pull-right" id="SaveBtn">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
  <style type="text/css">
    label#cat_id-error {
      position: absolute;
      margin-top: 68px;
      margin-left: -127px;
    }
  </style>
  @include('Admin/Layouts/Footer')
  <script src="{{ asset('public/Admin')}}/assets/validation/Role.js"></script> 
</body>
</html>
