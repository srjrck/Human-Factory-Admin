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
            <li class="breadcrumb-item active" aria-current="page">Name List</li>
          </ol>
        </div>
      </div>     
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div id="Return_msg" class="col-sm-12">
                  <?php
                  if(Session::has('message')){
                    echo Session::get('message');
                  }
                  ?>
                </div>
                <div class="col-sm-6">
                  <h5 class="card-title">Name List</h5>
                </div>
                <div class="col-sm-6">
                  <a href="{{route('AddName')}}">
                    <button type="button" class="btn btn-secondary m-1 pull-right">Add</button>
                  </a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="default-datatable">
                  <thead class="thead-dark">
                    <tr>
                      <th>ID</th>
                      <th>Resource</th>
                      <th>Family</th>
                      <th>Given</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                    foreach($Result as $row){
                      $Resource = DB::table('resource')->select('type')->where('id',$row->resource_id)->first();
                    ?>  
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$Resource->type}}</td>
                        <td>{{$row->family}}</td>
                        <td>{{$row->given}}</td>
                        <td>{{$row->created_at}}</td>
                        <td>
                          <a href="<?=route('EditName',array('ID'=>base64_encode($row->id)))?>">
                            <button class="btn btn-success"> <i class="fa fa-edit"></i> </button>
                          </a>
                          <a href="<?=route('DeleteName',array('ID'=>base64_encode($row->id)))?>" onclick = "if (! confirm('Are you sure?')) { return false; }">
                            <button class="btn btn-danger"> <i class="fa fa-trash"></i> </button>
                          </a>
                        </td>
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
  </script>
</body>
</html>