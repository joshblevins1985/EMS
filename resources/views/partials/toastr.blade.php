
@if(isset ($errors) && count($errors) > 0)
    @foreach($errors->all() as $error)
    <script> toastr["error"]("<?php echo $error ?>") </script>
    @endforeach
@endif

@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
        <script> toastr["success"]("<?php echo $msg ?>") </script>
        @endforeach
    @else
    <script> toastr["success"]("<?php echo $data ?>") </script>
    @endif
@endif
