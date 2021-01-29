@extends('layouts.empty', ['paceTop' => true])

@section('title', '404 Error Page')

@section('content')
    <!-- begin error -->
    <div class="error">
        <div class="error-code">Thank you</div>
        <div class="error-content">
            <div class="error-message">Application submitted </div>
            <div class="error-desc mb-3 mb-sm-4 mb-md-5">
                Your application has been recieved, our HR department will process the application. A member from our team will reach out as soon as possible. <br />
                Please contact the human resources departement at hr@peasi.net or (740) 351-2617 if you should have any questions.
            </div>
            <div>
                <a href="/" class="btn btn-success p-l-20 p-r-20">Go Home</a>
            </div>
        </div>
    </div>
    <!-- end error -->
@endsection

