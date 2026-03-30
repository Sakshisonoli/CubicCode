<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> Register | Queues </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    {{-- <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

</head>

<body>

    <main>
        <div class="container">
            @if (session('error'))
                <script>
                    Swal.fire("{{ session('error') }}");
                </script>
            @endif

            @if (session('success'))
                <script>
                    Swal.fire(
                        "Done!",
                        "{{ session('success') }}",
                        "success"
                    );
                </script>
            @endif
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <div class="d-flex justify-content-center py-4">
                                    <a href="/">
                                        <img width="150px" src="{{ asset('/queues-logo.png') }}" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    <form action="{{ route('submit_admin') }}" method="POST" class="row g-3">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Your Name</label>
                                            <input type="text" name="name" class="form-control" id="yourName"
                                                required>
                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Your Email</label>
                                            <input type="email" name="email" class="form-control" id="yourEmail"
                                                required>
                                            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPhone" class="form-label">Phone Number</label>
                                            <input type="text" name="phone" class="form-control" id="yourPhone"
                                                required>
                                            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                            <div id="passwordHelp" class="form-text text-danger mt-2"></div>
                                        </div>

                                        <div class="col-12">
                                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                id="confirmPassword" required>
                                            <div class="invalid-feedback">Please confirm your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a
                                                    href="{{ route('login') }}">Log in</a></p>
                                        </div>
                                    </form>

                                    {{-- <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            const form = document.querySelector("form");
                                            form.addEventListener("submit", function(event) {
                                                const password = document.getElementById("yourPassword").value;
                                                const confirmPassword = document.getElementById("confirmPassword").value;

                                                if (password !== confirmPassword) {
                                                    event.preventDefault();
                                                    alert("Passwords do not match!");
                                                }
                                            });
                                        });
                                    </script> --}}

                                </div>
                            </div>

                            <div class="credits">
                                © 2025 QUEUES | All Rights Reserved.
                            </div>

                        </div>
                    </div>
                </div>

            </section>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const form = document.querySelector("form");
                    const passwordInput = document.getElementById("yourPassword");
                    const confirmPasswordInput = document.getElementById("confirmPassword");
                    const passwordHelp = document.getElementById("passwordHelp");

                    const strongPasswordRules = [{
                            regex: /.{6,}/,
                            message: "At least 6 characters"
                        },
                        {
                            regex: /[A-Z]/,
                            message: "At least one uppercase letter"
                        },
                        {
                            regex: /[a-z]/,
                            message: "At least one lowercase letter"
                        },
                        {
                            regex: /\d/,
                            message: "At least one number"
                        },
                        {
                            regex: /[!@#$%^&*()_\-+=<>?{}[\]~]/,
                            message: "At least one special character"
                        },
                    ];

                    passwordInput.addEventListener("input", () => {
                        const password = passwordInput.value;
                        let messages = [];

                        strongPasswordRules.forEach(rule => {
                            if (!rule.regex.test(password)) {
                                messages.push(`❌ ${rule.message}`);
                            } else {
                                messages.push(`✅ ${rule.message}`);
                            }
                        });

                        passwordHelp.innerHTML = messages.join("<br>");
                    });

                    form.addEventListener("submit", function(event) {
                        const password = passwordInput.value;
                        const confirmPassword = confirmPasswordInput.value;

                        const isStrong = strongPasswordRules.every(rule => rule.regex.test(password));

                        if (password !== confirmPassword) {
                            event.preventDefault();
                            alert("Passwords do not match!");
                            return;
                        }

                        if (!isStrong) {
                            event.preventDefault();
                            alert("Please use a strong password as per the rules shown.");
                            return;
                        }
                    });
                });
            </script>


        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
