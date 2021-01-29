<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/assets/corona/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/corona/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/assets/corona/css/classic-horizontal/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/assets/corona/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-transparent text-left p-5 text-center">
                        <img src="/assets/corona/images/faces/face13.jpg" class="lock-profile-img" alt="img">
                        <form class="pt-5" action="{{ route('login.unlock') }}" aria-label="{{ __('Locked') }}">
                        @csrf
                            <div class="form-group">
                                <label for="examplePassword1">Password to unlock</label>
                                <input type="password" class="form-control text-center" id="examplePassword1"  name="password"  placeholder="Password" required>
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-block btn-success btn-lg font-weight-medium" > Unlock </button>
                            </div>
                            <div class="mt-3 text-center">
                                <a href="/logout" class="auth-link text-white">Sign in using a different account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="/assets/corona/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="/assets/corona/js/off-canvas.js"></script>
<script src="/assets/corona/js/hoverable-collapse.js"></script>
<script src="/assets/corona/js/misc.js"></script>
<script src="/assets/corona/js/settings.js"></script>
<script src="/assets/corona/js/todolist.js"></script>
<!-- endinject -->
</body>
</html>