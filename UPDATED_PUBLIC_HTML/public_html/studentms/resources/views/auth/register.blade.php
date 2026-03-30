@extends('auth.auth_main')

@section('content')
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-lg-6 col-md-7 col-sm-12 mx-auto align-self-center">
                    <div class="login-form">
                        <div class="text-center">
                            <h3 class="title">Sign up your account</h3>
                            <p>Sign in to your account to start using W3CRM</p>
                        </div>
                        <form action="{{ route('store_data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="mb-1 text-dark">Name</label>
                                <input type="text" name="name" id="name" class="form-control form-control"
                                    placeholder="Enter your name">
                            </div>
                            <div class="mb-4">
                                <label class="mb-1 text-dark">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control"
                                    placeholder="Enter your email Id">
                            </div>
                            <div class="mb-4">
                                <label class="mb-1 text-dark">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control form-control"
                                    placeholder="Enter your phone number">
                            </div>
                            <div class="mb-4 position-relative">
                                <label class="mb-1 text-dark">Password</label>
                                <input type="password" name="password" id="dz-password" class="form-control"
                                    placeholder="Enter your password">
                                <span class="show-pass eye">

                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>

                                </span>
                            </div>
                            {{-- <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                <div class="mb-4">
                                    <div class="form-check custom-checkbox mb-3">
                                        <input type="checkbox" class="form-check-input" id="customCheckBox1" required="">
                                        <label class="form-check-label" for="customCheckBox1">Remember my
                                            preference</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <a href="page-forgot-password.html" class="btn-link text-primary">Sign in</a>
                                </div>
                            </div> --}}
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                            </div>
                            {{-- <h6 class="login-title"><span>Or continue with</span></h6> --}}

                            <p class="text-center">Not registered?
                                <a class="btn-link text-primary" href="#!">Register</a>
                            </p>
                        </form>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="pages-left h-100">
                        <div class="login-content">
                            <a href="index.html"><img src="images/logo-full.png" class="mb-3 logo-dark" alt=""></a>
                            <a href="index.html"><img src="images/logi-white.png" class="mb-3 logo-light"
                                    alt=""></a>
                            <p>CRM dashboard uses line charts to visualize customer-related metrics and trends over
                                time.</p>
                        </div>
                        <div class="login-media text-center">
                            <img src="{{ asset('assets/images/login.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
