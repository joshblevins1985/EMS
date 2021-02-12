@extends('layouts.clean')

@section('title', 'Classroom')

@push('css')

<style>
    /* Container holding the image and the text */
.headingContainer {
  position: relative;
  text-align: center;

}



/* Bottom right text */
.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 16px;
}

.document-group  {
  overflow-x: auto;
  white-space: nowrap;
  flex-wrap: nowrap;
}

</style>
<link href="/assets/plugins/select2/dist/css/select2.css" rel="stylesheet" />

@endpush

@section('content')
    <div class="row">
        <div class="col-xl-9">
            <div class="row">
                <div id="headerimg" class="col-xl-12">
                    <div class="headingContainer">
                        <img  src="/assets/img/1_ambulance-banner.jpg" height="200" width="100%" />
                        <div class="bottom-right"><h1>{{ $classroom->lable }}</h1></div>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-xl-12">
                    <ul class="nav md-pills nav-justified pills-blue " id="pills-tab" role="tablist">

                    <li class="nav-item ">
                        <a class="nav-link  active" id="pills-ClassRoom-tab" data-toggle="pill"
                           href="#pills-ClassRoom" role="tab" aria-controls="pills-ClassRoom" aria-selected="true">Class Room</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " id="pills-Stream-tab" data-toggle="pill"  href="#pills-Stream"
                           role="tab" aria-controls="pills-Stream" aria-selected="false">Stream</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " id="pills-People-tab" data-toggle="pill"  href="#pills-People"
                           role="tab" aria-controls="pills-People" aria-selected="false">People</a>
                    </li>

                    @if($instructor)
                    <li class="nav-item ">
                        <a class="nav-link" id="pills-Grades-tab" data-toggle="pill"  href="#pills-Documents"
                           role="tab" aria-controls="pills-Documents" aria-selected="false">Documents</a>
                    </li>
                    @endif

                    <li class="nav-item ">
                        <a class="nav-link " id="pills-Grades-tab" data-toggle="pill"  href="#pills-Grades"
                           role="tab" aria-controls="pills-Grades" aria-selected="false">Grades</a>
                    </li>


                </ul>

                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-ClassRoom" role="tabpanel"
                             aria-labelledby="pills-ClassRoom-tab">
                            <div class="card card-body">
                                @include('classroom.partials.classWorkSections')
                            </div>

                        </div>

                        <div class="tab-pane fade" id="pills-Stream" role="tabpanel" aria-labelledby="pills-Stream-tab">
                            Class Room Updates / Stream go here.
                        </div>

                        <div class="tab-pane fade" id="pills-People" role="tabpanel" aria-labelledby="pills-People-tab">
                            Class Room Students and Instructors go here
                        </div>

                        @if($instructor)
                            <div class="tab-pane fade" id="pills-Documents" role="tabpanel" aria-labelledby="pills-Documents-tab">
                                @include('classroom.partials.documents')
                            </div>
                        @endif


                        <div class="tab-pane fade" id="pills-Grades" role="tabpanel" aria-labelledby="pills-Grades-tab">
                            @include('classroom.partials.classroomgrades')
                        </div>

                    </div>


                </div>
            </div>
        </div>

        <div class="col-xl-3" style="background-color: gray">
            <div class="row">
                <div class="col-xl-12 mb-2">
                    @include('classroom.partials.instructors')
                </div>
                <div class="col-xl-12 mb-2">
                    @include('classroom.partials.history')
                </div>
                <div class="col-xl-12 mb-2">
                    @include('classroom.partials.recentGrades')
                </div>
                @if($classroom->hasSkills)
                <div class="col-xl-12 mb-2">
                    @include('classroom.partials.courseSkills')
                </div>
                @endif

                @if($classroom->hasClinicals)
                <div class="col-xl-12 mb-2">
                    @include('classroom.partials.courseClinicals')
                </div>
                @endif

                @if($instructor)
                <div class="col-xl-12 mb-2">
                    @include('classroom.partials.reports')
                </div>
                @endif

                @if($instructor)
                <div class="col-xl-12 mb-2">
                    @include('classroom.partials.students')
                </div>
                @endif


            </div>
        </div>
    </div>






@endsection



@include('classroom.partials.modalQuiz')
@include('classroom.partials.modalYouTube')
@include('classroom.partials.modalVimeo')
@include('classroom.partials.modalConnectEmployee')



@push('scripts')
<script src="https://player.vimeo.com/api/player.js"></script>
<script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="http://www.youtube.com/player_api"></script>

    <script>
        $('#modalYouTube').on('show.bs.modal', function (event) {

            console.log('Modal Opened')
            var id = $(event.relatedTarget).data('id');
            var display = data();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            function data(){
                $('#video').load('{{url('classroom/youTube')}}/'+ id);
            }

            document.getElementById("video").innerHTML = display;

        })
    </script>

    <script>
        $('#modalConnectEmployee').on('show.bs.modal', function (event) {

            console.log('Modal Opened')
            var id = $(event.relatedTarget).data('id');
            var display = data();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            function data(){
                $('#content').load('{{url('/classroom/connectEmployee')}}/'+ id);
            }

            document.getElementById("content").innerHTML = display;


        })
    </script>

{{--    <script>
        $('#modalVimeo').on('show.bs.modal', function (event) {

            console.log('Modal Opened')
            var id = $(event.relatedTarget).data('id');
            var display = data();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest',

                }
            });

            function data(){
                $('#video').load('{{url('classroom/vimeo')}}/'+ id);
             $(".modal-body").html($('<iframe id="display" style="width:100%; height:360px;overflow:auto;" frameborder="0" src="https://player.vimeo.com/video/290302682?api=1&player_id=display" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'));


        });
    </script>--}}





@endpush
