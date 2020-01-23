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
                <li class="breadcrumb-item active" aria-current="page">Patient Details</li>
                </ol>
            </div>
        </div>     
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Name</div>
              <hr>
              <div class="row">
                @foreach($NameList as $name)
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="input-1">{{$name->family}} </label>
                    {{$name->given}}
                  </div> 
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Identifier</div>
              <hr>
              <div class="row">
                @foreach($IdentifierList as $identifier)
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="input-1">{{$identifier->type}}:- </label>
                    {{$identifier->value}}
                  </div> 
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Telecom</div>
              <hr>
              <div class="row">
                @foreach($TelecomList as $telecom)
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="input-1">{{$telecom->system}}:- </label>
                    {{$telecom->value}}
                  </div> 
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('Admin/Layouts/Footer')  
</body>
</html>
