@extends('frontend.layouts.main')

@section('content')
    <div class="">
        <div class="container">
            <div class="card py-4">
                <div class="card-body">
                    <h2 class="card-title">Privacy Policy</h2>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>

                            <li class="breadcrumb-item active">Privacy Policy</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="p-5">
            <h6>
                <b>Take look at</b>
            </h6>
            <h2>
                1. Introduction
            </h2>
            <p>Queues values your privacy. This policy outlines how we collect, use, and protect your personal information.
                By using our platform, you consent to the practices described herein.</p>

            <br>
            <hr>
            <br>

            <h2>2. Information We Collect</h2>
            <li> <b>Personal Information:</b> Name, email, phone number, payment details, and government-issued IDs for
                verification.</li>
            <li> <b>Usage Data:</b> Browser type, device information, and activity on our platform for analytics and
                security purposes.</li>

            <br>
            <hr><br>

            <h2>3. How We Use Your Information</h2>
            <p>Facilitate secure transactions. Provide customer support and resolve disputes. Improve platform functionality
                and user experience. Comply with legal and regulatory obligations.</p>

            <br>
            <hr><br>

            <h2>4. Data Sharing</h2>
            <li>We do not sell your data. Information may be shared only:</li>
            <li>To comply with legal obligations. With secure third-party payment processors to facilitate transactions. In
                case of investigations into fraudulent or unlawful activities.</li>

            <br>
            <hr><br>

            <h2>5. Data Security
            </h2>
            <p>All data is encrypted and stored on secure servers. Access to personal data is restricted to authorized
                personnel. Regular audits are conducted to identify and mitigate vulnerabilities.</p>

            <br>
            <hr><br>

            <h2>6. User Rights</h2>
            <li>Access, update, or delete your personal information by contacting our support team.</li>
            <li>Opt-out of marketing communications.</li>
            <li>Request data portability where applicable.</li>

            <br>
            <hr><br>

            <h2>7. Cookies and Tracking</h2>
            <li>Users are prohibited from attempting to hack, manipulate, or exploit the platform’s data or infrastructure.
            </li>
            <li>Any breach of privacy through malicious means will result in legal action.</li>

            <br>
            <hr><br>

            <h2>9. Enforcement and Amendments</h2>

            <li>Queues reserves the right to amend this policy at any time. Continued use constitutes acceptance of updated
                terms.</li>
            <li>Violations of this policy may result in account suspension, termination, or legal consequences.</li>

        </div>
    </div>
@endsection
