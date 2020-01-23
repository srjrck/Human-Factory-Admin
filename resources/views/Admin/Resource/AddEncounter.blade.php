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
        ul{
          /*list-style: none;*/
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
                    <label for="input-1" class='col-sm-3 col-form-label'>Select Patient</label>
                        <div class="col-sm-9">
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
                    <label for="input-1" class='col-sm-3 col-form-label'>Reason for visit</label>
                    <div class="col-sm-9">
                        <textarea  class="form-control" name="reason_for_visit" placeholder="Reason for visit"></textarea>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Past Illness</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="past_illness" placeholder="Past Illness"></textarea>
                    </div>
                  </div>
                
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>History of family member diseases</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="member_diseases" placeholder="History of family member diseases"></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Medication use</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="medication_use" placeholder="Medication use"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Psychiatric Med mgmt note</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="note" placeholder="Psychiatric Med mgmt note"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Challenges to maintaining treatments or health behaviors</label>
                    <div class="col-sm-9">
                        <textarea  class="form-control" name="health_behaviors" placeholder="Challenges to maintaining treatments or health behaviors"></textarea>
                    </div>
                  </div> 
                
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Tobacco smoking status</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="smoking_status" placeholder="Tobacco smoking status"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Total physical activity score</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="physical_activity">
                            <option value="">Select</option>
                            <option value="Low">Low</option>
                            <option value="Moderate">Moderate</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Pain severity</label>
                    <div class="col-sm-9">
                        <!--<textarea class="form-control" name="past_illness" placeholder="Pain severity"></textarea>-->
                        <input type='number' class='form-control' name='pain_severity' placeholder='Pain severity' min="0" maxlength="10">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Body site</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="bodu_site" placeholder="Body site"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Social history</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="social_history" placeholder="Social history"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Challenges to maintaining treatments or health behaviours</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="health_behaviour" placeholder="Challenges to maintaining treatments or health behaviours"></textarea>
                    </div>
                  </div>
            </fieldset>
            <fieldset>
                <legend>Observation</legend>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Test Name</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="test_name" placeholder="Test Name"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Mental Status Code</label>
                    <div class="col-sm-9">
                        <input type='text' class='form-control' name='mental_status' placeholder='Mental Status Code' min="0" maxlength="10">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Test</label>
                    <div class="col-sm-9">
                        <!--<select class="form-control" name="test1">
                            <option value="">Select Test</option>
                            <option value="Select Mental Code">Test</option>
                        </select>-->
                            <div id='TextBoxesGroup'>
                            	<div id="TextBoxDiv1">
                            		<label for="input-1">Test 1 : </label><input type='textbox' name='test1' id='test1' class='form-control'>
                            	</div>
                            </div>
                            <input type='button' value='Add Test' id='addButton'>
                            <input type='button' value='Remove Test' id='removeButton'>
                    </div>
                  </div>
                 
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Clincial notes</label>
                    <div class="col-sm-9">
                    <textarea class="form-control" name="clincial_notes" placeholder="Clincial notes"></textarea>
                    </div>
                  </div> 
            </fieldset>
            <fieldset>
                <legend>Plan of Care</legend>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Goal</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="goal" placeholder="Goal"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Medication Request</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="medication" placeholder="MedicationRequest"></textarea>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-3 col-form-label'>Appointment</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" name="next_date" placeholder="Next Date">
                    </div>
                  </div> 
                <div class="form-group" style='float: left;margin-left: 16px;'>
                  <button type="submit" class="btn btn-primary  pull-right" id="SaveBtn">Save</button>
                </div>
            </fieldset>
          </div>
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
$(document).ready(function(){

    var counter = 2;
    $("#addButton").click(function () {
	if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
	}   
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
	newTextBoxDiv.after().html('<label>Test '+ counter + ' : </label>' +
	      '<input type="text" name="test' + counter + 
	      '" id="textbox' + counter + '" value="" class="form-control">');
	newTextBoxDiv.appendTo("#TextBoxesGroup");
	counter++;
     });

     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
    }  
	counter--;
    $("#TextBoxDiv" + counter).remove();
     });
		
     $("#getButtonValue").click(function () {
		
	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
  </script>
</body>
</html>
