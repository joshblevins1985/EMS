
<div class="col-md-12 col-xl-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Company Meetings</h4>

            <div class="add-items d-flex">

                @if(Auth()->user()->id == 450)
                    <div class="row">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#newMeetingModal"> Add New Meeting </button>
                    </div>
                @endif
            </div>
            <div class="list-wrapper">
                <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
                    @foreach($meetings as $meeting)
                        <a data-id="{{$meeting->id}}" data-toggle="modal" data-target="#meetingModal" >
                            <li>
                                <div>
                                    {{Carbon\Carbon::parse($meeting->date)->format('m-d-Y')}}
                                </div>
                                <div>
                                    {{$meeting->title}}
                                </div>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>