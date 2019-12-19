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
            <li class="breadcrumb-item"><a href="{{route('Encounter')}}">Encounter</a></li>
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
                @if(Session::has('message'))           
                  <?=Session::get('message')?>
                @endif
              </span>
              <form action="{{route('InsertEncount')}}" method="post" id="Add" name="Add" novalidate="novalidate">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Definition</label>
                      <input type="text" class="form-control" id="definition" name="definition" placeholder="Definition">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Text</label>
                      <input type="text" class="form-control" id="text" name="text" placeholder="Text">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Answer</label>
                      <input type="text" class="form-control" id="answer" name="answer" placeholder="Answer">
                    </div> 
                  </div>
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
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">value String</label>
                      <input type="text" class="form-control" id="valueString" name="valueString" placeholder="value String">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Note</label>
                      <input type="text" class="form-control" id="note" name="note" placeholder="Note">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Method</label>
                      <input type="text" class="form-control" id="method" name="method" placeholder="Method">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Identifier Value</label>
                      <input type="text" class="form-control" id="identifiervalue" name="identifiervalue" placeholder="Identifier Value">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Select Patient</label>
                      <select class="form-control" name="patient_id" id="patient_id">
                        <option value="">Select Patient</option>
                        <?php
                        $ResourceList = DB::table('resource')->where('is_removed','false')->where('type','Patient')->get();
                        foreach ($ResourceList as $Resource) {
                          $name = DB::table('name')->where('resource_id',$Resource->id)->first();
                          echo '<option value="'.$Resource->id.'">'.$name->family.' '.$name->given.'</option>';
                        }
                        ?>
                      </select>
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Status</label>
                      <input type="text" class="form-control" id="status" name="status" placeholder="Status">
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
          definition: {required: true},
          text: {required: true},
          answer: {required: true},
          system: {required: true},
          code: {required: true},
          display: {required: true},
          valueString: {required: true},
          note: {required: true},
          method: {required: true},
          status: {required: true},
          identifiervalue: {required: true},
          patient_id: {required: true}
        },    
        messages: {
          definition:{required:"Please enter definition."},
          text:{required:"Please enter text."},
          answer:{required:"Please enter answer."},
          system:{required:"Please enter system."},
          code:{required:"Please enter phone."},
          display:{required:"Please enter display."},
          valueString:{required:"Please enter value string."},
          note:{required:"Please enter note."},
          method:{required:"Please enter method."},
          status:{required:"Please enter status."},
          identifiervalue:{required:"Please enter identifier value."},
          patient_id:{required:"Please select patient."}
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