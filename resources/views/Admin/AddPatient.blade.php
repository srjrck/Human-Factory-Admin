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
            <li class="breadcrumb-item"><a href="{{route('Patient')}}">Patient</a></li>
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
              <form action="{{route('InsertPatient')}}" method="post" id="Add" name="Add" novalidate="novalidate">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Select Practitioner</label>
                      <select class="form-control" id="practitioner_id" name="practitioner_id">
                        <option value="">Select Practitioner</option>
                        <?php
                        $ResourceList = DB::table('resource')->where('is_removed','false')->where('type','Practitioner')->get();
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
                      <label for="input-1">Identifier PRN</label>
                      <input type="text" class="form-control" id="identifier_prn" name="identifier_prn" placeholder="Identifier PRN">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Identifier TAX</label>
                      <input type="text" class="form-control" id="identifier_tax" name="identifier_tax" placeholder="Identifier TAX">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Given</label>
                      <input type="text" class="form-control" id="given" name="given" placeholder="Given">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Family</label>
                      <input type="text" class="form-control" id="family" name="family" placeholder="Family">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Phone</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Email</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">DOB</label>
                      <input type="date" class="form-control" id="dob" name="dob" placeholder="DOB">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Line</label>
                      <input type="text" class="form-control" id="line" name="line" placeholder="Line">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">City</label>
                      <input type="text" class="form-control" id="city" name="city" placeholder="City">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">District</label>
                      <input type="text" class="form-control" id="district" name="district" placeholder="District">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Postal Code</label>
                      <input type="text" class="form-control" id="postalcode" name="postalcode" placeholder="Postal Code">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Country</label>
                      <input type="text" class="form-control" id="country" name="country" placeholder="Country">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Relationship</label>
                      <input type="text" class="form-control" id="relationship" name="relationship" placeholder="Relationship">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Relationship Mobile</label>
                      <input type="text" class="form-control" id="r_mobile" name="r_mobile" placeholder="Mobile">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Relationship Email</label>
                      <input type="text" class="form-control" id="r_email" name="r_email" placeholder="Email">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Name Family</label>
                      <input type="text" class="form-control" id="r_family" name="r_family" placeholder="Family">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Name Given</label>
                      <input type="text" class="form-control" id="r_given" name="r_given" placeholder="Given">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Reference</label>
                      <input type="text" class="form-control" id="reference" name="reference" placeholder="Reference">
                    </div> 
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="input-1">Type</label>
                      <input type="text" class="form-control" id="type" name="type" placeholder="Type">
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
          relationship: {required: true},
          r_mobile: {required: true},
          r_email: {required: true},
          r_family: {required: true},
          r_given: {required: true},
          reference: {required: true},
          type: {required: true}
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
          relationship:{required:"Please enter relationship."},
          r_mobile:{required:"Please enter mobile."},
          r_email:{required:"Please enter email."},
          r_family:{required:"Please enter family."},
          r_given:{required:"Please enter given."},
          reference:{required:"Please enter reference."},
          type:{required:"Please enter type."}
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