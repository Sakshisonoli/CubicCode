@extends('frontend.layouts.main')

@section('content')
    <div class="container">
        <div class="alert alert-success text-center">
            <h2>Payment Successful!</h2>
            <p>Thank you for your purchase. Your order has been confirmed.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Go to Home</a>
        </div>
    </div>
@endsection
