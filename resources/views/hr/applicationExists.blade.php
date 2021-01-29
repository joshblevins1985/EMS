@extends('layouts.empty', ['paceTop' => true])

@section('title', '404 Error Page')

@section('content')
    <!-- begin error -->
    <div class="error">
        <div class="error-code">Sorry</div>
        <div class="error-content">
            <div class="error-message">User or Application already exists...</div>
            <div class="error-desc mb-3 mb-sm-4 mb-md-5">
                It appears you may have already applied or have been employeed in the past. <br />
                Please contact the human resources departement at hr@peasi.net or (740) 351-2617.
            </div>
            <div>
                <a href="/" class="btn btn-success p-l-20 p-r-20">Go Home</a>
            </div>
        </div>
    </div>
    <!-- end error -->
@endsection

