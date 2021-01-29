<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    @include('partials._head')
  </head>

  <body class="sidebar-fixed">

    <div class="container-scroller">
      <!-- partial:../../partials/_sidebar.html -->
      @include('partials._sidebar')
      <!-- partial -->
      <div class="page-body-wrapper">
        <!-- partial:../../partials/_navbar.html -->
        @include('partials._navbar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">


            @yield('content')

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/../../partials/_footer.html -->
          @include('partials._footer')
          <!-- partial -->


        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @include('partials.todo_note')

    <!-- container-scroller -->
    <script>
      $('#newTodoNoteModal').on('show.bs.modal', function(e) {
        var tid = $(e.relatedTarget).data('tid');

        $("#tid").val(tid);
      });
    </script>
    @include('partials.partials._pagejs')
  </body>
</html>