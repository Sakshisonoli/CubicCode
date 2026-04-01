<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Cleancode Login | Dashboard </title>

    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css"
    rel="stylesheet"
    />
</head>
<body>

    <section class="vh-100" style="background-color: #32C8F5;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="{{ asset('assets/images/loginpage.jpg') }}"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">

                        <form action="{{ route('authentication') }}" method="POST">
                            @csrf

                        <div class="d-flex align-items-center mb-3 pb-1">
                          <img width="200" src="{{ asset('assets/images/logo.png') }}" class="mb-3 logo-dark" alt="Cleancode">
                        </div>

                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                        <div data-mdb-input-init class="form-outline mb-4">
                          <input type="text" id="identity" class="form-control form-control-lg @error('identity') is-invalid @enderror" id="identity"
                          name="identity" placeholder="Enter your email ID / phone number" />
                          <label class="form-label" for="identity">Email Or Phone Number</label>

                          @error('identity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                          <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                          placeholder="Enter your password" />
                          <label class="form-label" for="password">Password</label>

                          @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="pt-1 mb-4">
                          <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                        </div>

                        {{-- <a class="small text-muted" href="#!">Forgot password?</a> --}}
                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a target="_blank" href="https://campus.cleancode.club/"
                            style="color: #393f81;">Contact your branch</a></p>
                        <a href="#!" class="small text-muted">Terms of use.</a>
                        <a href="https://cleancode.club/cleancode-terms-and-conditions" target="_blank" class="small text-muted">Privacy policy</a>
                        </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"
    ></script>
</body>
</html>
