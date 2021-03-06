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
                    <li class="breadcrumb-item active" aria-current="page">Encounter List</li>
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
                  <h5 class="card-title">Encounter List</h5>
                </div>
                <div class="col-sm-6">
                  <a href="{{route('AddEncounter')}}">
                    <button type="button" class="btn btn-secondary m-1 pull-right">Add Encounter</button>
                  </a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="default-datatable">
                  <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Identifier</th>
                        <!-- <th>Status</th> -->
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                    foreach($Result as $row){
                        $identifier = DB::table('identifier')->where('resource_id',$row->id)->first();
                        //$Response = json_decode($row->json);
                        //echo '<pre>';print_r($Response);
                        //ucfirst($Response->status);
                    ?>  
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$identifier->value}}</td>
                        <td>{{$row->created_at}}</td>
                        <td>
                            <a href="<?=route('ViewEncounter',array('ID'=>base64_encode($row->id)))?>">
                                <button class="btn btn-success"> <i class="fa fa-eye"></i> </button>
                            </a>
                            <!--<a href="<?=route('EditEncounter',array('ID'=>base64_encode($row->id)))?>">
                                <button class="btn btn-secondary"> <i class="fa fa-link"></i></button>
                            </a>-->
                            <!--<a href="<?=route('DeleteEncounter',array('ID'=>base64_encode($row->id)))?>" onclick="return confirm('Are you sure?')">
                                <button class="btn btn-danger"> <i class="fa fa-trash"></i> </button>
                            </a>-->
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
