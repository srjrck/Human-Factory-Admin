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
    <div class="container-fluid">
      <div class="row pt-2 pb-2">
        <div class="col-sm-9">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('Patient')}}">Patient</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update</li>
          </ol>
        </div>
      </div>   
      <?php $result = json_decode($Result->json);?>
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Update Patient</div>
              <hr>
              <span id="Return_msg">
                @if(Session::has('message'))           
                  <?=Session::get('message')?>
                @endif
              </span>
              <form action="{{route('SavePatient')}}" enctype="multipart/form-data" method="post" id="EditForm" name="EditForm" novalidate="novalidate">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                <legend>Patient Demographics</legend>
                    <div class="form-group row">
                      <label for="input-1"  class='col-sm-3 col-form-label'>Select Practitioner</label>
                      <div class="col-sm-9">
                      <select class="form-control" id="practitioner_id" name="practitioner_id">
                        <option value="">Select Practitioner</option>
                        <?php
                        $ResourceList = DB::table('resource')->where('is_removed','false')->where('type','Practitioner')->get();
                        foreach ($ResourceList as $Resource) {
                            $name = DB::table('name')->where('resource_id',$Resource->id)->first();
                            ?>
                            <option <?php if($result->contained[0]->id==$Resource->id){echo "Selected";} ?> value=<?php echo $Resource->id;?>><?php echo $name->family.' '.$name->given;?></option>
                        <?php }
                        ?> 
                      </select>
                      </div>
                    </div> 
                  
                    <input type="hidden" class="form-control" id="id" name="id" value="{{$Result->id}}">
                  
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Identifier PRN</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="identifier_prn" name="identifier_prn" placeholder="Identifier PRN" value="{{$result->identifier[0]->value}}">
                        </div>
                    </div> 
                  
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Identifier TAX</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="identifier_tax" name="identifier_tax" placeholder="Identifier TAX" value="{{$result->identifier[1]->value}}">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Given</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="given" name="given" placeholder="Given" value="{{$result->contained[0]->name[0]->given}}">
                        </div>
                    </div> 
                  
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Family</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="family" name="family" placeholder="Family" value="{{$result->contained[0]->name[0]->family}}">
                        </div>
                    </div> 
                  
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Phone</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{$result->contained[0]->telecom[0]->value}}">
                        </div>
                    </div> 
                  
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Email</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$result->contained[0]->telecom[0]->value}}">
                        </div>
                    </div> 
                  
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>DOB</label>
                        <div class="col-sm-9">
                        <input type="date" class="form-control" id="dob" name="dob" placeholder="DOB" value="{{$result->birthDate}}">
                        </div>
                    </div> 
                  
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Address Line</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="line" name="line" placeholder="Line" value="{{$result->address[0]->line}}">
                        </div>
                    </div> 
                  
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>City</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{$result->address[0]->city}}">
                        </div>
                    </div> 
                  
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>District</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="district" name="district" placeholder="District" value="{{$result->address[0]->district}}">
                        </div>
                    </div> 
                  
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Postal Code</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="postalcode" name="postalcode" placeholder="Postal Code" value="{{$result->address[0]->postalCode}}">
                        </div>
                    </div> 
                  
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Country</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="{{$result->address[0]->country}}">
                        </div>
                    </div> 
                  </fieldset>
                  <fieldset>
                    <legend>Relatives</legend>
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Relationship Mobile</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="r_mobile" name="r_mobile" placeholder="Mobile" value="{{$result->contact[0]->telecom[0]->given}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Relationship Email</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="r_email" name="r_email" placeholder="Email" value="{{$result->contact[0]->telecom[1]->given}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Name Family</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="r_family" name="r_family" placeholder="Family" value="{{$result->contact[0]->name[0]->family}}">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="input-1" class='col-sm-3 col-form-label'>Name Given</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="r_given" name="r_given" placeholder="Given" value="{{$result->contact[0]->name[0]->given}}">
                        </div>
                    </div>
                    <div class="form-group" style='float: left;'>
                        <button type="submit" class="btn btn-primary  pull-right" id="SaveBtn">Update</button>
                    </div>
                    </fieldset>
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
          identifier_prn: {required: true},
          identifier_tax: {required: true},
          given: {required: true},
          family: {required: true},
          phone: {required: true},
          email:{          
            required: true,             
            email: true         
          },
          dob: {required: true},
          line: {required: true},
          city: {required: true},
          district: {required: true},
          postalcode: {required: true},
          country: {required: true},
          //relationship: {required: true},
          r_mobile: {required: true},
          r_email: {required: true},
          r_family: {required: true},
          r_given: {required: true}
          /*reference: {required: true},
          type: {required: true}*/
        },    
        messages: {
          identifier_prn:{required:"Please enter identifier prn."},
          identifier_tax:{required:"Please enter identifier tax."},
          given:{required:"Please enter given."},
          family:{required:"Please enter family."},
          phone:{required:"Please enter phone."},
          email:{               
            required: "Please enter email.",               
            email: "Please enter valid email."            
          },
          dob:{required:"Please enter dob."},
          line:{required:"Please enter line."},
          city:{required:"Please enter city."},
          district:{required:"Please enter district."},
          postalcode:{required:"Please enter postalcode."},
          country:{required:"Please enter country."},
          //relationship:{required:"Please enter relationship."},
          r_mobile:{required:"Please enter mobile."},
          r_email:{required:"Please enter email."},
          r_family:{required:"Please enter family."},
          r_given:{required:"Please enter given."}
         /* reference:{required:"Please enter reference."},
          type:{required:"Please enter type."}*/
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
