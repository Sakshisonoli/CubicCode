<div class="container mt-5">
    <footer class="py-5">
        <div class="row">
            <div class="col-6 col-md-2 mb-3">
                <h5>Our Company</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('about') }}"
                            class="nav-link p-0 text-body-secondary">About Queues</a>
                    </li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQ's</a>
                    </li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-3">
                <h5>Useful Links</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('care_guarantee') }}"
                            class="nav-link p-0 text-body-secondary">QueuesCare
                            Guarantee</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('terms_and_conditions') }}"
                            class="nav-link p-0 text-body-secondary">Terms &
                            Conditions</a>
                    </li>
                    <li class="nav-item mb-2"><a href="{{ route('privacy_policy') }}"
                            class="nav-link p-0 text-body-secondary">Privacy
                            Policy</a>
                    </li>
                    <li class="nav-item mb-2"><a href="{{ route('refund_policy') }}"
                            class="nav-link p-0 text-body-secondary">Refund
                            Policy</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-3">
                <h5>Have Questions?</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('contact') }}"
                            class="nav-link p-0 text-body-secondary">Help Center /
                            Contact Us</a></li>
                </ul>
            </div>

            <div class="col-md-5 offset-md-1 mb-3">
                <h5>Disclaimer</h5>
                <p>Monthly digest of what's new and exciting from us.</p>
            </div>
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
            <p>© 2025 QUEUES | Registered under HNY TicketTrading LLP (India) | All Rights Reserved.</p>
            <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24"
                            height="24">
                            <use xlink:href="#twitter"></use>
                        </svg></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24"
                            height="24">
                            <use xlink:href="#instagram"></use>
                        </svg></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24"
                            height="24">
                            <use xlink:href="#facebook"></use>
                        </svg></a></li>
            </ul>
        </div>
    </footer>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#form1').on('input', function() {
            let query = $(this).val();

            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('search_events') }}",
                    method: 'GET',
                    data: {
                        query: query
                    },

                    success: function(data) {
                        let resultsContainer = $('#search-results');
                        resultsContainer.empty();

                        if (data.length > 0) {
                            data.forEach(function(event) {
                                let eventDate = new Date(event.event_date);
                                let formattedDate = eventDate.toLocaleDateString(
                                    'en-US', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric',
                                    });

                                resultsContainer.append(
                                    `<a href="/sellticket/event/${event.id}" class="d-block text-decoration-none py-2 px-3 d-flex align-items-center">
                                        <img src="${event.event_photo}" alt="${event.event_name}" class="rounded me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                        <span>${event.event_name} | ${event.event_location} | ${formattedDate}</span>
                                    </a>
                                `);
                            });
                            resultsContainer.removeClass('d-none'); // Show results
                        } else {
                            resultsContainer.append('<p class="px-2">No events found</p>');
                            resultsContainer.removeClass('d-none');
                        }
                    },
                    error: function() {
                        console.log('Error occurred during AJAX request.');
                    }
                });
            } else {
                $('#search-results').empty().addClass('d-none'); // Hide when empty
            }
        });

        // Hide results when clicking outside
        $(document).click(function(e) {
            if (!$(e.target).closest("#form1, #search-results").length) {
                $('#search-results').addClass('d-none');
            }
        });
    });
</script>


{{-- // success: function(data) {
    //     let resultsContainer = $('#search-results');
    //     resultsContainer.empty();

    //     if (data.length > 0) {
    //         data.forEach(function(event) {
    //             let eventDate = new Date(event.event_date);
    //             let formattedDate = eventDate.toLocaleDateString(
    //                 'en-US', {
    //                     year: 'numeric',
    //                     month: 'long',
    //                     day: 'numeric',
    //                 });

    //             resultsContainer.append(
    //                 `<a href="/sellticket/event/${event.id}" class="d-block text-decoration-none py-1 px-2">
    //                     <img src="${ asset('events/' . $event->event_photo) }"/>
    //             ${event.event_name} | ${event.event_location} | ${formattedDate}
    //         </a>`
    //             );
    //         });
    //         resultsContainer.removeClass('d-none'); // Show results
    //     } else {
    //         resultsContainer.append('<p class="px-2">No events found</p>');
    //         resultsContainer.removeClass('d-none');
    //     }
    // }, --}}


<script>
    // Bootstrap form validation script
    (function() {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
    })();
</script>
