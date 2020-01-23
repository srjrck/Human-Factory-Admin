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
            <li class="breadcrumb-item"><a href="{{route('Practitioner')}}">Practitioner</a></li>
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
              <span id="Return_msg"></span>
              <form action="javascript:void(0)" method="post" id="Add" name="Add" novalidate="novalidate">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Identifier</label>
                      <input type="text" class="form-control" id="identifier" name="identifier" placeholder="Identifier">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Given</label>
                      <input type="text" class="form-control" id="given" name="given" placeholder="Given">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Family</label>
                      <input type="text" class="form-control" id="family" name="family" placeholder="Family">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Tax Code</label>
                      <input type="text" class="form-control" id="tax_code" name="tax_code" placeholder="Tax Code">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Phone</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Email</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="Email">
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
  @include('Admin/Layouts/Footer')
  <script src="{{ asset('public/Admin')}}/assets/validation/Practitioner.js"></script> 
</body>
</html>