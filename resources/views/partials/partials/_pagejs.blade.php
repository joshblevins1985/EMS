
<script src="/assets/corona/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="/assets/corona/vendors/progressbar/progressbar.min.js"></script>
<script src="/assets/corona/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="/assets/corona/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src="/assets/js/popper.min.js"></script>
<script type="text/javascript" src="/assets/js/mdb.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="/assets/corona/js/off-canvas.js"></script>
<script src="/assets/corona/js/hoverable-collapse.js"></script>
<script src="/assets/corona/js/misc.js"></script>
<script src="/assets/corona/js/settings.js"></script>
<script src="/assets/corona/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/corona/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            theme: "dark-adminlte"
        });
    });

</script>


@stack('scripts')