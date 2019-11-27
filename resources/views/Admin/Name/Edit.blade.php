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
            <li class="breadcrumb-item"><a href="{{route('Name')}}">Name</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </div>
      </div>   
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Edit</div>
              <hr>
              <span id="Return_msg">
                <?php
                if(Session::has('message')){
                  echo Session::get('message');
                }
                ?>
              </span>
              <form action="{{route('SaveName')}}" enctype="multipart/form-data" method="post" id="EditForm" name="EditForm" novalidate="novalidate">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="edit_id" value="{{ $row->id }}">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Select Resource</label>
                      <select id="resource_id" class="form-control" name="resource_id">
                        <option value="">Select Resource</option>
                        @foreach($ResourceList as $Resource)
                          <option value="{{$Resource->id}}" <?php if($row->resource_id==$Resource->id){echo 'selected';} ?>>{{$Resource->type}}</option>
                        @endforeach
                      </select>
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Family</label>
                      <input type="text" value="{{$row->family}}" class="form-control" id="family" name="family" placeholder="Family">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Given</label>
                      <input type="text" class="form-control" value="{{$row->given}}" id="given" name="given" placeholder="Given">
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
  <script src="{{ asset('public/Admin')}}/assets/validation/Name.js"></script> 
</body>
</html>