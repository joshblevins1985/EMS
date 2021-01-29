
@if(count($jobs))
        @foreach ($jobs as $job )
        <li class="list-group-item mb-2 bg-primary">
            <div class="row">
                <div class="col-xl-6">
                    <h2> {{  $job->unit }} </h2>
                    <h2> {!! $job->comments !!} </h2>
                </div>
                <div class="col-xl-6">
                    @foreach($job->problems as $problem)
                    <small> {{ $problem->task_label->label }} </small><p>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="/garage/assignMe/{{ $job->id }}"<button type="button" class="btn btn-success btn-sm" data-unit_id=" {{ $job->id  }}" >Assign to Me</button> </a>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-info btn-sm" data-unit_id="{{ $job->id}}" >Assign to Other</button>
                </div>
                
            </div>
        </li>
    @endforeach
@else
<li class="list-group-item mb-2 bg-success">
    <div class="row">
        <div class="col-xl-12">
            <h2>  No Jobs Assigned </h2>
        </div>
    </div>
</li>
@endif
        

