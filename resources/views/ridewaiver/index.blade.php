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
  
<link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/signature-pad.css') }}">
</head>

<body>

<!--Main Navigation-->
<header>

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light mdb-color darken-2  scrolling-navbar">
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
        <ul class="navbar-nav mr-auto ">
          <li class="nav-item active">
            <a class="nav-link waves-effect text-white" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link waves-effect text-white" href="rider">Ride Along Waiver
              <span class="sr-only">(current)</span>
            </a>
          </li>

        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a href="https://www.facebook.com/Portsmouth-Emergency-Ambulance-Service-Inc-192264187488364/" class="nav-link waves-effect" target="_blank">
              <i class="fab fa-facebook-f text-white"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard" class="nav-link border border-light rounded waves-effect text-white"
               target="_blank">
              <i class="fas fa-user-lock text-white"></i>Employee Login
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
  <div class="container">
    
    <div class="row mb-10">
        
        <p>I do hereby request permission of Portsmouth Emergency Ambulance inc. to observe the activites of PEASI paramedics and emergency medical technicians while on duty. In consideration for such permission, I agree to follow all instructions given
        by PEASI paramedics and personnel: I accept full responsibility for my own personal safety; I waive all rights and claims in the event of any accideent, incident or injury, and hereby release all persons associated with PEASI and all individual employes of PEASI 
        from any and all liability for any injuiry that I might sustain while observing EMS activities. I understand that EMS activities are sometimes dangerous, and I hereby assume the risk associated with observing them.</p>
        
        <p>Furthermore, I agree to submit to a blood or urine test in the vent there is cause or reason by PEASI to have this procedure performed.</p>
        
        <p>I understand I am an observer <strong>only</strong>, over the age of 18 years of age, and will not drive any company vehicles. I will not hold Portsmouth Emergecny Ambulance Service Inc (PEASI) liable for any injury, accidents, or loss of property 
        during my observation time. I will conduct myself in a professional manner, and will be responsible for my action during my observation time.
        </p>
        <p>I understand that I ama guest in the ambulance environment and may be asked to leave at anytime; upon the discretion of the management staff, ambulance staff as well as the receiving facilties that I will going to.</p>
        <p> I understand I am to neatly groomed, and required to wear blue pants, black shoes, and a blue shirt.</p>
        <p>I understand I am required to leave the property at 10:00 PM unless prior approval by management.</p>
        
        <p><strong>Obervation Confidentiality Agreement</strong></p>
        
        <p>I hereby acknowledge, by my signature below, that I understand that the private health information, other confidential records, and data to which I may have knowledge of during my course of observation with PEASI is to be kept confidential, and this 
        confidentiality is a condition of my observation. This information shall not be disclosed to anyone under any circumstances, except o the extent necessar to fulfill my observation requirements. I understand that myu duty to maintain confidentiality 
        continues even after I am no longer observing with PEASI.</p>
        
        <p>I also understand that the unauthorized deisclosure of patient private health information and other confidential or proprietary information of PEASI is grounds for immediate removal from company property as well as revoking prileges to continue to observe with PEASI.</p>
        
        <form class="needs-validation ansform"  method="post" enctype="multipart/form-data" action="rider/store" novalidate>
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-5">
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="first_name" name="first_name" class="form-control" required>
                      <label for="first_name">First Name</label>
                      <div class="invalid-feedback">
                        Please provide your first name.
                    </div>
                    </div>
                    
                </div>
                <div class="col-lg-2">
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="middle_name" name="middle_name" class="form-control" required>
                      <label for="middle_name">Middle Name</label>
                      <div class="invalid-feedback">
                        Please provide your middle name.
                    </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="last_name" class="form-control" required>
                      <label for="last_name">Last Name</label>
                    <div class="invalid-feedback">
                        Please provide your last name.
                    </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3">
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="house_number" name="house_number" class="form-control" required>
                      <label for="house_number">House Number</label>
                      <div class="invalid-feedback">
                        Please provide your house number.
                    </div>
                    </div>
                    
                </div>
                <div class="col-lg-9">
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="street" name="street" class="form-control" required>
                      <label for="street">Street Name</label>
                      <div class="invalid-feedback">
                        Please provide your street name.
                    </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4">
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="city" name class="form-control" required>
                      <label for="street">City</label>
                      <div class="invalid-feedback">
                        Please provide the city that you live in.
                    </div>
                    </div>
                    
                </div>
                <div class="col-lg-4">
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="state" name="state" class="form-control" required>
                      <label for="state">State</label>
                      <div class="invalid-feedback">
                        Please provide the state that you live in.
                    </div>
                    </div>
                    
                </div>
                <div class="col-lg-4">
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="zip" name="zip" class="form-control" required>
                      <label for="zip">Zip Code</label>
                      <div class="invalid-feedback">
                        Please provide the zip code for your address.
                    </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-2">
                    <div class="md-form">
                        <select class="mdb-select md-form" name="sex" required>
                      <option value="" disabled selected>Choose your gender.</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                    
                    <div class="invalid-feedback">
                        Please provide your gender.
                    </div>
                    </div>
                    
                </div>
                <div class="col-lg-2">
                    <div class="md-form">
                      <input placeholder="Selected date" type="text" id="dob" name="dob" class="form-control datepicker" required>
                      <label for="dob">Date of Birth</label>
                      <div class="invalid-feedback">
                        Please provide your date of birth.
                    </div>
                    </div>
                    
                </div>
                <div class="col-lg-3">
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="phone" name="phone_number" class="form-control" required>
                      <label for="phone">Phone Number</label>
                      <div class="invalid-feedback">
                        Please provide your phone number.
                    </div>
                    </div>
                    
                </div>
                <div class="col-lg-5">
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="email" id="email_address" name="email" class="form-control" required>
                      <label for="email_address">Email Address</label>
                      <div class="invalid-feedback">
                        Please provide your email address.
                    </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    In the event of an accident or injury, I hereby authorize PEASI to take me to:
                </div>
                <div class="col-lg-4">
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="emergency_department" name="emergency_department" class="form-control" required>
                      <label for="emergency_department">Emergency Department</label>
                      <div class="invalid-feedback">
                        Please provide your emergecny department preference.
                    </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                     In the event of an accident or injury, I hereby authorize PEASI to notify:
                </div>
                <div class="col-lg-4">
                    
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="emergency_contact_name" name="emergency_contact" class="form-control" required>
                      <label for="emergency_contact_name">Emergency Contact Name</label>
                      <div class="invalid-feedback">
                        Please provide your emergency contact.
                    </div>
                    </div>
                    
                </div>
            </div>
            
            <p> I understand that despite this authorization PEASI may choose to take me to the closest appropriate emergency room. I have read the above waiver policy and agree to follow the instructions I am given. I understand that, in the event that I am
            injured, I am forfeiting any right to sue the parties named or described above, enen if my injury occurs as a result of their negligence.</p>
            
            <div class="row">
                <div class="col-lg-12">
                    <p>By typing your full name below you are signing to agree to the information on this page.</p>
                        <div class="md-form">
                      <input type="text" id="emergency_department" name="signature" class="form-control" required>
                      <label for="emergency_department">Signature</label>
                      <div class="invalid-feedback">
                        Please type your name as your signature.
                    </div>
                    </div>
                    <div>
                </div>

            </div>
            
        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" id="save">Submit Information</button>

        </form>
    </div>
    
    <div class="row" >
        
    </div>

  </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer  text-center font-small mdb-color darken-2 mt-4 wow fadeIn ">

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



<script>
    (function() {
'use strict';
window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
form.addEventListener('submit', function(event) {
if (form.checkValidity() === false) {
event.preventDefault();
event.stopPropagation();
}
form.classList.add('was-validated');
}, false);
});
}, false);
})();

$(document).ready(function() {
$('.datepicker').pickadate();
$('.datepicker').removeAttr('readonly');

$(document).ready(function() {
$('.mdb-select').materialSelect();
$('.mdb-select.select-wrapper .select-dropdown').val("").removeAttr('readonly').attr("placeholder",
"Choose your gender ").prop('required', true).addClass('form-control').css('background-color', '#fff');
});
});
</script>


</body>

</html>
