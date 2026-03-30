@extends('frontend.layouts.main')

@section('content')
    <div class="container hpx_about_page">
        <div class="p-5 hpx_about">
            <h6>
                we are Queues
            </h6>
            <h1>
                Get to know us
            </h1>
            <p>
                Hey there! We’re Yash Chauhan and Hanshal Soneja two best friends who’ve been inseparable since school, now
                on a mission to make life a little easier (and a lot more fun). QUEUES came from the simple idea that no one
                should miss out on a great experience just because of the chaos around ticketing. Whether it’s scoring
                last-minute passes to your favorite concert or finally getting into that sold-out event, we’ve got your
                back.
                <br> <br>
                We’re young, ambitious, and learning as we go. Think of QUEUES as a reflection of who we are real, a little
                messy, but always aiming to create something that spreads good vibes and joy. If you’re here, you’re already
                part of the journey, and we can’t wait to make it better together!
            </p>
        </div>
    </div>

    <div class="hpx_about2 text-center py-5" style="background-color: #0047ab6c">
        <div class="container">
            <h6 class="text-uppercase text-white">
                meet our most valued
            </h6>
            <h1 class="text-uppercase text-white">
                expert team members
            </h1>
            <p class="text-white">
                Right now, it’s just the two of us Yash and Hanshal figuring things out one day at a time. We’re not perfect
                (far from it!), but we believe in being honest and open about that. Running QUEUES as a small team means we
                get to stay hands-on, but it also means we make mistakes. And that’s okay we’re learning, improving, and
                growing with your help. We love hearing your thoughts and suggestions because, honestly, they make us
                better. So, if you’ve got ideas, we’re all ears. Here’s to building something awesome, together!
            </p>
            <div class="row pt-3">
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                    <div class="card text-center shadow" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Yash Chauhan</h5>
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                    the card's content.</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card text-center shadow" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Hanshal Soneja</h5>
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                    the card's content.</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>


    <div class="hpx_about3 py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card text-center mb-3 p-5" style="background-color: #0047ab6c">
                        <div class="card-body">
                            <h3 class="card-title text-uppercase" style="color: #fff">Our Mission</h3>
                            <p class="card-text" style="color: #fff">
                                To break down the barriers of ticketing and create a platform that’s simple, fair, and
                                trustworthy. At QUEUES, it’s not just about selling tickets—it’s about making sure everyone
                                gets a chance to be part of something amazing.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card text-center mb-3 p-5" style="background-color: #0047ab6c">
                        <div class="card-body">
                            <h3 class="card-title text-uppercase" style="color: #fff">Our Vission</h3>
                            <p class="card-text" style="color: #fff">To break down the barriers of ticketing and create a
                                platform that’s
                                simple, fair, and trustworthy. At QUEUES, it’s not just about selling tickets—it’s about
                                making sure everyone gets a chance to be part of something amazing.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
