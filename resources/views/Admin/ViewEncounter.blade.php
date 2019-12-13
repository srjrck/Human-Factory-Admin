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
            <li class="breadcrumb-item active" aria-current="page">Encounter Details</li>
          </ol>
        </div>
      </div>     
      <?php
      $Response = json_decode($Result->json);
      //echo '<pre>';print_r($Response->contained);die;
      //echo '<pre>';print_r($Response);die;
      ?>
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Questionnaire Response</div>
              <hr>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    @foreach($Response->contained[0]->item as $row)
                    <table class="table">
                      <tr><td>Definition:- {{$row->definition}}</td></tr>
                      <tr><td>Text:- {{$row->text}}</td></tr>
                      <tr><td>Answer:- {{$row->answer}}</td></tr>
                    </table>
                    @endforeach
                  </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  @include('Admin/Layouts/Footer')  
</body>
</html>