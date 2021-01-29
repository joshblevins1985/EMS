<div class="row">
    <div class="col-xl-12">
        <div class="accordion" id="accordionExample">
        @foreach($classroom->sections as $section)
            <div class="row mb-3" id="heading{{ $section->id }}">
                <div class="col-xl-8" class="card-header" >
                    <h1 class="text-primary"> <a data-toggle="collapse" data-target="#collapse{{ $section->id }}" aria-expanded="true" aria-controls="collapse{{ $section->id }}">{{ $section->label }}</a> </h1>
                </div>
                <div class="col-xl-3"> <h3>{{ count($section->topics->where('required', 1)) }} required</h3>  </div>
                @if($instructor)
                <div class="col-xl-1">
                    <div class="pull-right">
                        <!-- Example single danger button -->
                    <div class="btn-group">
                        <i class="fas fa-ellipsis-v fa-3x" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                      
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="/classroom/addQuiz/{{ $section->id }}">Add New Quiz</a>
                        <a class="dropdown-item" href="/classroom/addYoutube/{{ $section->id }}">Add New You Tube Video</a>
                        <a class="dropdown-item" href="/classroom/addPdf/{{ $section->id }}">Add New PDF Document</a>
                        <a class="dropdown-item" href="/classroom/addPpt/{{ $section->id }}">Add New PPT Document</a>
                        <a class="dropdown-item" href="/classroom/addVimeo/{{ $section->id }}">Add New Vimio Req Video</a>
                        <a class="dropdown-item" href="/classroom/addGrade/{{ $section->id }}">Add New Item to Grade Book</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">TBD</a>
                      </div>
                    </div>
                        
                    </div>
                </div>
                <div class="col-xl-12">
                    Click to see content.
                </div>
                @endif
                
                <div class="col-xl-12">
                    <hr>
                </div>

                <div class="col-xl-12">
                    <div  id="collapse{{ $section->id }}" class="collapse @if ($loop->first) show @endif" aria-labelledby="heading{{ $section->id }}" data-parent="#accordionExample">
                        <div class="col-xl-12">
                            <div class="list-wrapper">
                                <ul class="text-white">
                                    @foreach($section->topics as $topic)
                                        @include('classroom.partials.classWorkSectionTopics')
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
        @endforeach
    </div>


</div>
</div>

