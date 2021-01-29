@extends('layouts.sidebar-fixed')

@section('title', 'Classroom Assessment')

@push('css')



@endpush

@section('content')



<div class="d-flex justify-content-center align-items-center" >
    <div class="row">
        <div class="col-xl-12" >

            <div id="video" style="width: 1000px"></div>

        </div>
        
        <div class="col-xl-12" id="backButton">
            
        </div>
</div>
</div>





@endsection


@push('scripts')
<script src="https://player.vimeo.com/api/player.js"></script>

<script>
    var iframe = document.querySelector('iframe');
    var startTime = <?php  if($userTopic) { echo $userTopic->video_time; } else {echo '0.00';} ?>;
    var options = {
        url: 	'https://player.vimeo.com/video/290158054',
        responsive: true,
        playsinline: true,
    };
    console.log('The time is '+ startTime);
    var player = new Vimeo.Player('video', options);

    player.setVolume(1);

    player.setCurrentTime(startTime).then(function(seconds) {
        // seconds = the actual time that the player seeked to
    }).catch(function(error) {
        switch (error.name) {
            case 'RangeError':
                // the time was less than 0 or greater than the video’s duration
                break;

            default:
                // some other error occurred
                break;
        }
    });

    player.on('play', function() {
        console.log('Played the video');
        });

    player.on('pause', function(){
        console.log('Paused the video');
        player.getCurrentTime().then(function(seconds){
            console.log(seconds);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            $.ajax({
                url: '/classroom/vimeo/paused/{{ $topic->id }}/'+ seconds,
                method: 'GET',

                success: function(res){
                    console.log('Completed Pause ');
                }
            });
        });

    });

    player.on('ended', function() {
      console.log('Video ended');
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
    $.ajax({
                url: '/classroom/vimeo/complete/{{ $topic->id }}',
                method: 'GET',

            success: function(res){
                console.log('Completed');
                $('#backButton').append('<a href="/classroom/dashboard/{{$topic->classroom_id}}"><button class="btn btn-primary btn-block">Back to Class Room</button></a>')
            }
        });
    });

    player.getVideoTitle().then(function(title) {
      console.log('title:', title);
    });
</script>
@endpush