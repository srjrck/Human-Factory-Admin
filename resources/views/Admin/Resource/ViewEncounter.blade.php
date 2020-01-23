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
            margin: 0 13px 12px;
            padding: 0.35em 0.625em 0.75em;
        }
        .col-form-label{
            font-size: 15px;
            font-weight:800;   
        }
    </style>
  <div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid  box box-block bg-white">
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('Encounter')}}">Encounter</a></li>
            <li class="breadcrumb-item active" aria-current="page">View</li>
          </ol>
        </div>
      </div>   
        <?php
        $Response = json_decode($Result->json);
        //echo "<pre>";print_r($Response);die;
        $patient_id = $Response->contained[0]->id;
        
        if(isset($Response->contained[0]->item[0]->definition))
        {
            $definition = $Response->contained[0]->item[0]->definition;
        }   else{
            $definition = "";
        }
        
        if(isset($Response->contained[0]->item[0]->text))
        {
            $text = $Response->contained[0]->item[0]->text;
        }   else{
            $text = "";
        }
        
        if(isset($Response->contained[0]->item[0]->answer))
        {
            $answer = $Response->contained[0]->item[0]->answer;
        }   else{
            $answer = "";
        }
        $Resour = DB::table('resource')->where('is_removed','false')->where('type','Encounter')->first();
        ?>
      <div class="row">
          <fieldset>
                <legend>Encounter</legend>
                    <div class="form-group row">
                    <label for="input-1" class='col-sm-4 col-form-label'>Practitioner participant:</label>
                        <div class="col-sm-6">
                            <?php
                            $participant = DB::table('participant')->where('is_removed','false')->where('id',$patient_id)->first();
                            $name = DB::table('name')->where('resource_id',$participant->id)->first();
                            echo $name->family.' '.$name->given;  
                        ?>
                        </div>
                    </div>
                
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-4 col-form-label'>Start date:</label>
                    <div class="col-sm-6">
                        <?php echo $Resour->created_at;?>
                    </div>
                  </div> 
                
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-4 col-form-label'>Encoutner identifier:</label>
                    <div class="col-sm-6">
                        <?php
                            $pat = DB::table('identifier')->where('is_removed','false')->where('resource_id',$Resour->id)->first();
                            echo $pat->type;
                        ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input-1" class='col-sm-4 col-form-label'>Patient:</label>
                    <div class="col-sm-6">
                        <?php
                            $Resource = DB::table('resource')->where('is_removed','false')->where('type','Patient')->where('id',$patient_id)->first();
                            $name = DB::table('name')->where('resource_id',$Resource->id)->first();
                            echo $name->family.' '.$name->given;  
                        ?>
                    </div>
                  </div>
            </fieldset>
        <!--<div class="col-lg-4">
          <div class="card">
            <div class="card-header text-uppercase">Questionnaire</div>
            <div class="card-body">
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Patient</h5>
                  <?php
                  $Resource = DB::table('resource')->where('is_removed','false')->where('type','Patient')->where('id',$patient_id)->first();
                  $name = DB::table('name')->where('resource_id',$Resource->id)->first();
                  echo $name->family.' '.$name->given;  
                  ?>
                </div> 
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Reason for visit</h5>
                  {{$definition}}
                </div> 
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Past Illness</h5>
                  {{$text}}
                </div> 
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Family History</h5>
                  {{$answer}}
                </div> 
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header text-uppercase">Observation</div>
            <div class="card-body">
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Mental Status</h5>
                  {{$Response->contained[0]->status}}
                </div> 
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Mental Status Code</h5>
                  {{$Response->contained[1]->code->code}}
                </div> 
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Test 1</h5>
                  {{$Response->contained[1]->code->system}}
                </div> 
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Test X</h5>
                  {{$Response->contained[1]->code->display}}
                </div> 
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Clincial notes</h5>
                  {{$Response->contained[1]->valueString}}
                </div> 
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header text-uppercase">Plan</div>
            <div class="card-body">
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Goal</h5>
                  {{$Response->reasonCode[0]->system}}
                </div> 
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Medication</h5>
                  {{$Response->reasonCode[0]->code}}
                </div> 
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Next Appointment Date</h5>
                  <?php echo date('Y-m-d', strtotime($Response->period->end)); ?>
                </div> 
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <h5 for="mt-0">Next Appointment Time</h5>
                  <?php echo date('H:i:s', strtotime($Response->period->end)); ?>
                </div> 
              </div>
            </div>
          </div>
        </div>-->
      </div>
    </div>
  </div>  
  @include('Admin/Layouts/Footer')
</body>
</html>
