@extends('layouts.sidebar-fixed')

@section('title', 'Available Courses')

@push('css')

@endpush

@section('content')

    <section class="mb-4" id="orientation_courses">
        <div class="card" >
            <img class="card-img-top" src="{{ asset('/assets/img/orientation_header.jpg') }}" style="height: 250px" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">Orientation Classes</h2>
                <hr>
                @foreach($courses->where('category', 1) as $course)
                    <div class="card flex-row flex-wrap">
                        <div class="card-header border-0">
                            <img src="{{asset('/assets/img/sol.jpg')}}" style="height: 200 px; width: 200px;" alt="">
                        </div>
                        <div class="card-block px-2">
                            <h4 class="card-title">{{$course->lable}}</h4>
                            <p class="card-text">{{$course->description}}</p>

                        </div>
                        <div class="w-100"></div>
                        <div class="card-footer w-100 text-muted">
                            <span class="pull-right"><a href="/classroom/dashboard/{{$course->id}}" class="btn btn-primary">View Course</a></span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="mb-4" id="orientation_courses">
        <div class="card" >
            <img class="card-img-top" src="{{ asset('/assets/img/ceu.jpg') }}" style="height: 250px" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">Continuing Education Courses</h2>
                <hr>
                @foreach($courses->where('category', 3) as $course)
                    <div class="card flex-row flex-wrap">
                        <div class="card-header border-0">
                            <img src="{{asset('/assets/img/sol.jpg')}}" style="height: 200 px; width: 200px;" alt="">
                        </div>
                        <div class="card-block px-2">
                            <h4 class="card-title">{{$course->lable}}</h4>
                            <p class="card-text">{{$course->description}}</p>

                        </div>
                        <div class="w-100"></div>
                        <div class="card-footer w-100 text-muted">
                            <span class="pull-right"><a href="/classroom/dashboard/{{$course->id}}" class="btn btn-primary">View Course</a></span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="mb-4" id="orientation_courses">
        <div class="card" >
            <img class="card-img-top" src="{{ asset('/assets/img/class.jpg') }}" style="height: 250px" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">Initial Education / Scholarship Courses</h2>
                <hr>
                @foreach($courses->where('category', 2) as $course)
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-auto">
                                <img src="{{asset('/assets/img/sol.jpg')}}" style="height: 200 px; width: 200px;" alt="">
                            </div>
                            <div class="col">
                                <div class="card-block px-2">
                                    <h4 class="card-title">{{$course->lable}}</h4>
                                    <p class="card-text">{!! $course->description !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer w-100 text-muted">
                            <span class="pull-right"><a href="/classroom/dashboard/{{$course->id}}" class="btn btn-primary">View Course</a></span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection

@push('scripts')



@endpush
