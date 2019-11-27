<!DOCTYPE html>
<html lang="en">

@include('Admin/Layouts/Head')

<body>

  @include('Admin/Layouts/Menu')
  @include('Admin/Layouts/Header')

    <div class="clearfix"></div>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12 col-lg-6 col-xl-3">
            <div class="card gradient-purpink">
              <div class="card-body">
                <div class="media">
                  <div class="media-body text-left">
                    <h4 class="text-white">{{$TotalUser}}</h4>
                    <span class="text-white">Total User</span>
                  </div>
                  <div class="align-self-center"><span id="dash-chart-1"></span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  @include('Admin/Layouts/Footer')
    
  <!-- Sparkline JS -->
  <script src="{{ asset('public/Admin')}}/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
  <!-- Chart js -->
  <script src="{{ asset('public/Admin')}}/assets/plugins/Chart.js/Chart.min.js"></script>
  <!-- Index js -->
  <script src="{{ asset('public/Admin')}}/assets/js/index.js"></script>
  
</body>
</html>