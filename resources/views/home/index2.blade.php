<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>PEASI Online</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <!-- Bootstrap core CSS -->
  <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/bootstrap.min.css') }}">
  <!-- Material Design Bootstrap -->
  <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/mdb.min.css') }}">
  <!-- Your custom styles (optional) -->
  <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/style.min.css') }}">
</head>

<body>

<!--Main Navigation-->
<header>

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
        <img src="{{ url('public/assets/img/peasi.png') }}" width="100px" height="50px">
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link waves-effect" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          
          
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a href="https://www.facebook.com/Portsmouth-Emergency-Ambulance-Service-Inc-192264187488364/" class="nav-link waves-effect" target="_blank">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard" class="nav-link border border-light rounded waves-effect"
               target="_blank">
              <i class="fas fa-user-lock"></i>Employee Login
            </a>
          </li>
        </ul>

      </div>

    </div>
  </nav>
  <!-- Navbar -->

</header>
<!--Main Navigation-->

<!--Main layout-->
<main class="mt-5 pt-5">
  <div class="container-fluid">

    <!--Section: Jumbotron-->
    <section class="card blue-gradient wow fadeIn" id="intro">

      <!-- Content -->
      <!-- Jumbotron -->
      <!-- Jumbotron -->
      <div class="card card-image" style="background-image: url({{ url('public/assets/img/emsstrong_17_webheader_v3-1.jpg') }});">
        <div class="text-white text-center rgba-stylish-strong py-5 px-4">
          <div class="row">
            <div class="col-lg-6">

            </div>
            <div class="col-lg-6">
              <div class="py-5">

                <!-- Content -->
                <h5 class="h5 red-text"> Welcome to the Portsmouth Ambulance Website.</h5>
                
                <blockquote class="blockquote font-italic">"Our mission is to be the choice provider for local hospitals, nursing homes, medical facilities and
residents of the area that we provide service in. This is often accomplished by establishing
close working relationships with our customers to continually meet and exceed their needs in
the area of ground medical transportation. Our staff of trained professionals will be held to the
highest standards and be required to pay attention to detail in all aspects of their job functions.
With our high standards and trained professionals, family members will always be assured their
loved ones are in safe hands and receiving the best care and treatment possible during
transport."
 </blockquote>


              </div>
            </div>
          </div>


        </div>
      </div>
      <!-- Jumbotron -->
      <!-- Content -->
    </section>
    <!--Section: Jumbotron-->

    <section>
      <div class="card-group">
        <!-- Card -->
        <div class="card card-image" style="background-image: url({{ url('public/assets/img/ambulance.jpg') }});">

          <!-- Content -->
          <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
            <div>
              <h5 class="pink-text"><i class="fas fa-chart-pie"></i> MICU</h5>
              <h3 class="card-title pt-2"><strong>Mobile Intensive Care Transport</strong></h3>
              <p>Transport provided by Critical Care Transport Paramedic's and a Registered Nurse.
                PEASI equip's it's MICU with, a ventilator, critical care transport monitor. Personel are capable of providing advanced paramedic skills. Our transport team will provide safe, reliable care
                from bedside-to-bedside. <br></p>

            </div>
          </div>

        </div>
        <!-- Card -->

        <!-- Card -->
        <div class="card card-image" style="background-image: url({{ url('public/assets/img/ift.jpg') }});">

          <!-- Content -->
          <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
            <div>
              <h5 class="pink-text"><i class="fas fa-chart-pie"></i> IFT</h5>
              <h3 class="card-title pt-2"><strong>Interfacility Transport</strong></h3>
              <p>Basic Life Support and Advanced Life Support transport provided by Paramedics and EMT'S.
                <br><br><br><br><br>
              </p>

            </div>
          </div>

        </div>
        <!-- Card -->

        <!-- Card -->
        <div class="card card-image" style="background-image: url({{ url('public/assets/img/emergency.jpg') }});">

          <!-- Content -->
          <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
            <div>
              <h5 class="pink-text"><i class="fas fa-chart-pie"></i> Emergency</h5>
              <h3 class="card-title pt-2"><strong>911 Emergency Services</strong></h3>
              <p>PEASI provides primary 911 Advanced Life Support services to West Portsmouth, Ohio - Crawford County, Ohio - Lewis County. Kentucky - Greenup County, Kentucky.
                <br><br><br> <br>
              </p>

            </div>
          </div>

        </div>
        <!-- Card -->

        <!-- Card -->
        <div class="card card-image" style="background-image: url({{ url('public/assets/img/stretcher.jpg') }});">

          <!-- Content -->
          <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
            <div>
              <h5 class="pink-text"><i class="fas fa-chart-pie"></i> Non-Emergency </h5>
              <h3 class="card-title pt-2"><strong>Convalescent Transport</strong></h3>
              <p>Non-Emergency transport service, for dialysis, doctors appointments, medical services and more.
                We will provide your loved ones with a safe transport to their medical appointment. <br> <br> <br> </p>

            </div>
          </div>

        </div>
        <!-- Card -->



      </div>
    </section>




  </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small mdb-color darken-2 mt-4 wow fadeIn">

  <!--Call to action-->

  <!--/.Call to action-->

  <hr class="my-4">

  <!-- Social icons -->
  <div class="pb-4">
    <a href="https://www.facebook.com/Portsmouth-Emergency-Ambulance-Service-Inc-192264187488364/" class="nav-link waves-effect" target="_blank">
      <i class="fab fa-facebook-f"></i>
    </a>

    
  </div>
  <!-- Social icons -->

  <!--Copyright-->
  <div class="footer-copyright py-3">
    © 2019 Copyright:
    <a href="#" target="_blank"> Medidex Solutions </a>
  </div>
  <!--/.Copyright-->

</footer>
<!--/.Footer-->

<!-- SCRIPTS -->
<!-- JQuery -->
<script src="{{ url('public/assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ url('public/assets/js/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ url('public/assets/js/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ url('public/assets/js/mdb.min.js') }}"></script>
<!-- Initializations -->
<script type="text/javascript">
  // Animations initialization
  new WOW().init();

</script>
</body>

</html>
