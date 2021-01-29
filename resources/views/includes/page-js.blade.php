<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/js/app.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
</script>



<!-- ================== END BASE JS ================== -->

@stack('scripts')
