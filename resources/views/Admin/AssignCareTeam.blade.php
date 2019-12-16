<!DOCTYPE html>
<html lang="en">
@include('Admin/Layouts/Head')
<link href="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
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
            <li class="breadcrumb-item"><a href="{{route('CareTeam')}}">CareTeam</a></li>
            <li class="breadcrumb-item active" aria-current="page">CareTeam Assign</li>
          </ol>
        </div>
      </div>     
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Add</div>
              <hr>
              <span id="Return_msg">
                <?php
                if(Session::has('message')){
                  echo Session::get('message');
                }
                $assign_arr = DB::table('assign')->select('participant_id')->where('careteam_id',$careteam_id)->get();
                $AssignID = [];
                foreach ($assign_arr as $row) {
                  $AssignID[] = $row->participant_id;
                }
                //print_r($AssignID);
                ?>
              </span>
              <form action="{{route('InsertAssign')}}" method="post" id="Add" name="Add" novalidate="novalidate">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="careteam_id" value="{{$careteam_id}}">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="input-1">Select Practitioner</label>
                      <select id="practitioner_id" class="form-control" name="practitioner_id">
                        <option value="">Select Practitioner</option>
                        <?php
                        $ResourceList = DB::table('resource')->where('assign_id','0')->where('is_removed','false')->where('type','Practitioner')->get();
                        foreach ($ResourceList as $Resource) {
                          if(!in_array($Resource->id, $AssignID)){
                            $name = DB::table('name')->where('resource_id',$Resource->id)->first();
                            echo '<option value="'.$Resource->id.'">'.$name->family.' '.$name->given.'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div> 
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="input-1">Role</label>
                      <div>
                        <?php
                        $roleList = DB::table('role')->get();
                        foreach ($roleList as $role) {
                        ?>
                          <input type="checkbox" class="filled-in chk-col-primary" name="role_id[]" value="<?=$role->id?>" style="position: inherit; opacity:1;"> <?=$role->code?><br/>
                        <?php
                        }
                        ?>
                      </div>
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
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="default-datatable">
                  <thead class="thead-dark">
                    <tr>
                      <th>ID</th>
                      <th>Family</th>
                      <th>Given</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                    foreach($Result as $row){
                      $name = DB::table('name')->where('resource_id',$row->participant_id)->first();
                    ?>  
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$name->family}}</td>
                        <td>{{$name->given}}</td>
                        <td>{{$row->add_date}}</td>
                      </tr>
                    <?php
                      $i++;
                    }
                    ?>
                  </tbody>
                </table>
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('Admin/Layouts/Footer')  

  <!--Data Tables js-->
  <script src="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
  <script>
    $(document).ready(function() {
      //Default data table
      $('#default-datatable').DataTable();
      var table = $('#example').DataTable( {
      lengthChange: false,
      buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
    });
    table.buttons().container()
      .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );

    $(function() { 
      $("#Add").validate({
        rules: {   
          practitioner_id: {required: true},
          role_id: {required: true}
        },    
        messages: {
          practitioner_id:{required:"Please select practitioner."},
          role_id:{required:"Please select role."}
        },
        submitHandler: function(form) {
          $('#SaveBtn').prop("disabled",true);
          $('#SaveBtn').html('Loading..');
          form.submit();
        }  
      });
    });
  </script>
</body>
</html>