@extends('frontend.layouts.main')

@section('content')
    <div class="container">
        <div class="alert alert-danger text-center">
            <h2>Payment Failed!</h2>
            <p>Oops! Looks like your payment didn't process, and your order hasn't been confirmed. We're
                here to help you complete it.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Go to Home</a>
        </div>
    </div>
@endsection
