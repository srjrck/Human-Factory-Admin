<!DOCTYPE html>
<html lang="en">
@include('Admin/Layouts/Head')
<body>
  @include('Admin/Layouts/Menu')
  @include('Admin/Layouts/Header')
  <style>
    fieldset{
        width: 100%;
        border: 1px solid #c0c0c0;
        margin: 0 13px;
        padding: 0.35em 0.625em 0.75em;
    }
    </style>
  <div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid box box-block bg-white">
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('Encounter')}}">Encounter</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
            </ol>
        </div>
      </div>   
      <form action="{{route('InsertEncount')}}" method="post" id="Add" name="Add" novalidate="novalidate">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div id="Return_msg" class="col-lg-12">
            @if(Session::has('message'))           
              <?=Session::get('message')?>
            @endif
          </div>
            <fieldset>
                <legend>Questionnaire</legend>
                    <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Select Patient</label>
                        <div class="col-sm-10">
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
                
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Reason for visit</label>
                    <div class="col-sm-10">
                        <textarea  class="form-control" name="reason_for_visit" placeholder="Reason for visit"></textarea>
                    </div>
                  </div> 
                
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Past Illness</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="past_illness" placeholder="Past Illness"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Family History</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="family_history" placeholder="Family History"></textarea>
                    </div>
                  </div>
            </fieldset>
            <fieldset>
                <legend>Observation</legend>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Mental Status</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="mental_status" placeholder="Mental Status"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Mental Status Code</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="mental_status_code">
                          <option value="">Select Mental Code</option>
                          <option value="Select Mental Code">Mental Code</option>
                        </select>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Test 1</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="test1">
                          <option value="">Select Test</option>
                          <option value="Select Mental Code">Test</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Test X</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="testx">
                          <option value="">Select Test</option>
                          <option value="Select Mental Code">Test</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Clincial notes</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="clincial_notes" placeholder="Clincial notes"></textarea>
                    </div>
                  </div> 
            </fieldset>
            <fieldset>
                <legend>Care Plan</legend>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Goal</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="goal" placeholder="Goal"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Medication</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="medication" placeholder="Medication"></textarea>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Next Appointment Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="next_date" placeholder="Next Date">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-2 col-form-label'>Next Appointment Time</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" name="next_time" placeholder="Next Time">
                    </div>
                  </div> 
                <div class="form-group" style='float: left;margin-left: 16px;'>
                  <button type="submit" class="btn btn-primary  pull-right" id="SaveBtn">Save</button>
                </div>
            </fieldset>
          </div>
          <!--<div class="col-lg-12 mx-auto">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary  pull-right" id="SaveBtn">Save</button>
                </div>
              </div>
            </div>
          </div>-->
        </form>
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
