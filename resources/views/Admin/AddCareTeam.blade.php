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
            <li class="breadcrumb-item"><a href="{{route('CareTeam')}}">Care Team</a></li>
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
                      <label for="input-1">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Responsible Email</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="Responsible Email">
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
  <script type="text/javascript">
    $(function() { 
      $("#Add").validate({
        rules: {   
          identifier: {required: true},
          email:{          
            required: true,             
            email: true         
          },
          name: {required: true}
        },    
        messages: {
          identifier:{required:"Please enter identifier."},
          email:{               
            required: "Please enter email.",               
            email: "Please enter valid email."            
          },
          name:{required:"Please enter name."}
        },
        submitHandler: function(form) {
          var identifier  = $('#identifier').val();
          var name        = $('#name').val();
          var email       = $('#email').val();
          
          var siteurl   = $('#url').val();
          var _token    = $('#_token').val();

          $('#SaveBtn').prop("disabled",true);
          $('#SaveBtn').html('Loading..');
          $.post(siteurl+"/InsertCareTeam", {identifier:identifier,name:name,email:email,_token:_token}, function(data){
            $('#Return_msg').html(data);
            $('#Return_msg').show();
            $('#SaveBtn').prop("disabled",false);
            $('#SaveBtn').html('Save');
          });
        }  
      });
    });
  </script>
</body>
</html>