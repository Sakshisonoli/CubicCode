<div>
    <div class="text-center pt-3" style="margin-bottom: -22px">

        <div class="marquee-container">
            <p class="marquee-text">
                QUEUES IS A SECONDARY TICKET P2P MARKETPLACE. ALL TICKETS ARE GUARANTEED AND
                SECURE. TICKET PRICES MAYBE ABOVE/BELOW FACE VALUE.
            </p>
        </div>

    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img width="140px" src="{{ asset('/queues-logo.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('explore_events') }}">Explore</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        @auth

                            @if (auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('unverified_tickets') }}">New Tickets</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('bidings') }}">Bidings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('add_new_concert') }}">Add New Event</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Profile
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin_dashboard') }}">Dashboard</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Settings</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Sign Out</a></li>
                                    </ul>
                                </li>
                            @elseif (auth()->user()->role === 'customer')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sell_tickets') }}">Sell</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('explore_events') }}">Buy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('orders') }}">My Tickets</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Profile
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('customer_dashboard') }}">My
                                                Profile</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('settings') }}">Settings</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}">Sign Out</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sell_tickets') }}">Sell</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Profile
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Sign In</a></li>
                                        <li><a class="dropdown-item" href="#">Create new account</a></li>

                                    </ul>
                                </li>
                            @endif
                        @endauth

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('sell_tickets') }}">Sell</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Profile
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Sign In</a></li>
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Create account</a></li>

                                </ul>
                            </li>
                        @endguest


                    </ul>
                </div>
            </div>
        </div>
    </nav>

</div>
