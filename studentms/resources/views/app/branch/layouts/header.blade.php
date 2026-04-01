<div id="main-wrapper">
    <div class="nav-header" style="background-color: #fff;">
        <a href="javascript::void();" class="brand-logo">
            <img width="150" src="{{ asset('assets/images/logo.png') }}" alt="">
        </a>
        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">

                    </div>
                    <ul class="navbar-nav header-right">

                        <li class="nav-item dropdown notification_dropdown">
                            <a class="nav-link bell dz-fullscreen" href="javascript:void(0);">
                                <svg id="icon-full" viewBox="0 0 24 24" width="20" height="20"
                                    stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" class="css-i6dzq1">
                                    <path
                                        d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"
                                        style="stroke-dasharray: 37, 57; stroke-dashoffset: 0;"></path>
                                </svg>
                                <svg id="icon-minimize" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="A098AE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-minimize">
                                    <path
                                        d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3"
                                        style="stroke-dasharray: 37, 57; stroke-dashoffset: 0;"></path>
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item ps-3">
                            <div class="dropdown header-profile2">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="header-info2 d-flex align-items-center">

                                        <div class="header-info">
                                            <h6>{{ auth()->user()->branch_name }}</h6>
                                            <p>{{ auth()->user()->name }}</p>
                                        </div>

                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <div class="card border-0 mb-0">
                                        <div class="card-header py-2">
                                            <div class="products">

                                                <div>
                                                    <h6>{{ auth()->user()->name }}</h6>
                                                    <span>{{ auth()->user()->email }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer px-0 py-2">
                                            <a href="{{route('branch_settings')}}" class="dropdown-item ai-icon ">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M20.8066 7.62355L20.1842 6.54346C19.6576 5.62954 18.4907 5.31426 17.5755 5.83866V5.83866C17.1399 6.09528 16.6201 6.16809 16.1307 6.04103C15.6413 5.91396 15.2226 5.59746 14.9668 5.16131C14.8023 4.88409 14.7139 4.56833 14.7105 4.24598V4.24598C14.7254 3.72916 14.5304 3.22834 14.17 2.85761C13.8096 2.48688 13.3145 2.2778 12.7975 2.27802H11.5435C11.0369 2.27801 10.5513 2.47985 10.194 2.83888C9.83666 3.19791 9.63714 3.68453 9.63958 4.19106V4.19106C9.62457 5.23686 8.77245 6.07675 7.72654 6.07664C7.40418 6.07329 7.08843 5.98488 6.8112 5.82035V5.82035C5.89603 5.29595 4.72908 5.61123 4.20251 6.52516L3.53432 7.62355C3.00838 8.53633 3.31937 9.70255 4.22997 10.2322V10.2322C4.82187 10.574 5.1865 11.2055 5.1865 11.889C5.1865 12.5725 4.82187 13.204 4.22997 13.5457V13.5457C3.32053 14.0719 3.0092 15.2353 3.53432 16.1453V16.1453L4.16589 17.2345C4.41262 17.6797 4.82657 18.0082 5.31616 18.1474C5.80575 18.2865 6.33061 18.2248 6.77459 17.976V17.976C7.21105 17.7213 7.73116 17.6515 8.21931 17.7821C8.70746 17.9128 9.12321 18.233 9.37413 18.6716C9.53867 18.9488 9.62708 19.2646 9.63043 19.5869V19.5869C9.63043 20.6435 10.4869 21.5 11.5435 21.5H12.7975C13.8505 21.5 14.7055 20.6491 14.7105 19.5961V19.5961C14.7081 19.088 14.9088 18.6 15.2681 18.2407C15.6274 17.8814 16.1154 17.6806 16.6236 17.6831C16.9451 17.6917 17.2596 17.7797 17.5389 17.9393V17.9393C18.4517 18.4653 19.6179 18.1543 20.1476 17.2437V17.2437L20.8066 16.1453C21.0617 15.7074 21.1317 15.1859 21.0012 14.6963C20.8706 14.2067 20.5502 13.7893 20.111 13.5366V13.5366C19.6717 13.2839 19.3514 12.8665 19.2208 12.3769C19.0902 11.8872 19.1602 11.3658 19.4153 10.9279C19.5812 10.6383 19.8213 10.3981 20.111 10.2322V10.2322C21.0161 9.70283 21.3264 8.54343 20.8066 7.63271V7.63271V7.62355Z"
                                                        stroke="var(--primary)" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <circle cx="12.175" cy="11.889" r="2.63616"
                                                        stroke="var(--primary)" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>

                                                <span class="ms-2">Settings </span>
                                            </a>
                                            <a href="{{ route('logout') }}" class="dropdown-item ai-icon">
                                                <svg class="profle-logout" xmlns="http://www.w3.org/2000/svg"
                                                    width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                    stroke="#ff7979" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                    <polyline points="16 17 21 12 16 7"></polyline>
                                                    <line x1="21" y1="12" x2="9"
                                                        y2="12">
                                                    </line>
                                                </svg>
                                                <span class="ms-2 text-danger">Logout </span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="deznav">
        <div class="deznav-scroll">
            <ul class="metismenu" id="menu">
                <li><a href="{{ route('branch_dashboard') }}" class="" aria-expanded="false">
                        <div class="menu-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.15722 20.7714V17.7047C9.1572 16.9246 9.79312 16.2908 10.581 16.2856H13.4671C14.2587 16.2856 14.9005 16.9209 14.9005 17.7047V17.7047V20.7809C14.9003 21.4432 15.4343 21.9845 16.103 22H18.0271C19.9451 22 21.5 20.4607 21.5 18.5618V18.5618V9.83784C21.4898 9.09083 21.1355 8.38935 20.538 7.93303L13.9577 2.6853C12.8049 1.77157 11.1662 1.77157 10.0134 2.6853L3.46203 7.94256C2.86226 8.39702 2.50739 9.09967 2.5 9.84736V18.5618C2.5 20.4607 4.05488 22 5.97291 22H7.89696C8.58235 22 9.13797 21.4499 9.13797 20.7714V20.7714"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a href="{{ route('branch_faculties') }}" class="" aria-expanded="false">
                        <div class="menu-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.8877 10.8967C19.2827 10.7007 20.3567 9.50467 20.3597 8.05567C20.3597 6.62767 19.3187 5.44367 17.9537 5.21967"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M19.7285 14.2503C21.0795 14.4523 22.0225 14.9253 22.0225 15.9003C22.0225 16.5713 21.5785 17.0073 20.8605 17.2813"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.8867 14.6638C8.67273 14.6638 5.92773 15.1508 5.92773 17.0958C5.92773 19.0398 8.65573 19.5408 11.8867 19.5408C15.1007 19.5408 17.8447 19.0588 17.8447 17.1128C17.8447 15.1668 15.1177 14.6638 11.8867 14.6638Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.8869 11.8879C13.9959 11.8879 15.7059 10.1789 15.7059 8.06888C15.7059 5.95988 13.9959 4.24988 11.8869 4.24988C9.7779 4.24988 8.0679 5.95988 8.0679 8.06888C8.0599 10.1709 9.7569 11.8809 11.8589 11.8879H11.8869Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M5.88509 10.8967C4.48909 10.7007 3.41609 9.50467 3.41309 8.05567C3.41309 6.62767 4.45409 5.44367 5.81909 5.21967"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M4.044 14.2503C2.693 14.4523 1.75 14.9253 1.75 15.9003C1.75 16.5713 2.194 17.0073 2.912 17.2813"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="nav-text">Faculties</span>
                    </a>
                </li>

                <li><a href="{{ route('branch_inquiries') }}" class="" aria-expanded="false">
                        <div class="menu-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M17.2777 13.8891C17.9524 13.8891 18.5188 14.446 18.4156 15.1123C17.8103 19.0323 14.4545 21.9428 10.4072 21.9428C5.92928 21.9428 2.2998 18.3134 2.2998 13.8365C2.2998 10.1481 5.10191 6.7123 8.25665 5.93546C8.93454 5.76809 9.62928 6.24493 9.62928 6.94283C9.62928 11.6712 9.78823 12.8944 10.6861 13.5597C11.584 14.2249 12.6398 13.8891 17.2777 13.8891Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M21.6921 9.95157C21.7458 6.91368 18.0142 2.01684 13.4669 2.10105C13.1132 2.10736 12.83 2.4021 12.8142 2.75473C12.6995 5.25263 12.8542 8.48947 12.9406 9.95684C12.9669 10.4137 13.3258 10.7726 13.7816 10.7989C15.29 10.8853 18.6448 11.0032 21.1069 10.6305C21.4416 10.58 21.6869 10.2895 21.6921 9.95157Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="nav-text">Leads</span>
                    </a>
                </li>

                <li><a href="{{ route('branch_batches') }}" class="" aria-expanded="false">
                        <div class="menu-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3 6.5C3 3.87479 3.02811 3 6.5 3C9.97189 3 10 3.87479 10 6.5C10 9.12521 10.0111 10 6.5 10C2.98893 10 3 9.12521 3 6.5Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14 6.5C14 3.87479 14.0281 3 17.5 3C20.9719 3 21 3.87479 21 6.5C21 9.12521 21.0111 10 17.5 10C13.9889 10 14 9.12521 14 6.5Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3 17.5C3 14.8748 3.02811 14 6.5 14C9.97189 14 10 14.8748 10 17.5C10 20.1252 10.0111 21 6.5 21C2.98893 21 3 20.1252 3 17.5Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14 17.5C14 14.8748 14.0281 14 17.5 14C20.9719 14 21 14.8748 21 17.5C21 20.1252 21.0111 21 17.5 21C13.9889 21 14 20.1252 14 17.5Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="nav-text">Batches</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('cleancode_courses') }}" class="" aria-expanded="false">
                        <div class="menu-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0122 1.82893L11.6874 5.17545C11.8515 5.50399 12.1684 5.73179 12.5359 5.78451L16.2832 6.32391C17.2091 6.45758 17.5775 7.57968 16.9075 8.22262L14.1977 10.8264C13.9314 11.0825 13.8101 11.4505 13.8731 11.812L14.5126 15.488C14.6701 16.3974 13.7023 17.0911 12.8747 16.6609L9.52545 14.9241C9.1971 14.7537 8.80385 14.7537 8.47455 14.9241L5.12525 16.6609C4.29771 17.0911 3.32986 16.3974 3.48831 15.488L4.12686 11.812C4.18986 11.4505 4.06864 11.0825 3.80233 10.8264L1.09254 8.22262C0.422489 7.57968 0.790922 6.45758 1.71678 6.32391L5.4641 5.78451C5.83158 5.73179 6.14942 5.50399 6.31359 5.17545L7.98776 1.82893C8.40201 1.00148 9.59799 1.00148 10.0122 1.82893Z" stroke="#130F26" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <span class="nav-text">Courses</span>
                    </a>
                </li>

                <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <div class="menu-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M17.857 20.4171C19.73 20.4171 21.249 18.8991 21.25 17.0261V17.0241V14.3241C20.013 14.3241 19.011 13.3221 19.01 12.0851C19.01 10.8491 20.012 9.84612 21.249 9.84612H21.25V7.14612C21.252 5.27212 19.735 3.75212 17.862 3.75012H17.856H6.144C4.27 3.75012 2.751 5.26812 2.75 7.14212V7.14312V9.93312C3.944 9.89112 4.945 10.8251 4.987 12.0191C4.988 12.0411 4.989 12.0631 4.989 12.0851C4.99 13.3201 3.991 14.3221 2.756 14.3241H2.75V17.0241C2.749 18.8971 4.268 20.4171 6.141 20.4171H6.142H17.857Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.3711 9.06309L12.9871 10.3101C13.0471 10.4321 13.1631 10.5171 13.2981 10.5371L14.6751 10.7381C15.0161 10.7881 15.1511 11.2061 14.9051 11.4451L13.9091 12.4151C13.8111 12.5101 13.7671 12.6471 13.7891 12.7821L14.0241 14.1521C14.0821 14.4911 13.7271 14.7491 13.4231 14.5891L12.1921 13.9421C12.0711 13.8781 11.9271 13.8781 11.8061 13.9421L10.5761 14.5891C10.2711 14.7491 9.91609 14.4911 9.97409 14.1521L10.2091 12.7821C10.2321 12.6471 10.1871 12.5101 10.0891 12.4151L9.09409 11.4451C8.84809 11.2061 8.98309 10.7881 9.32309 10.7381L10.7001 10.5371C10.8351 10.5171 10.9521 10.4321 11.0121 10.3101L11.6271 9.06309C11.7791 8.75509 12.2191 8.75509 12.3711 9.06309Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="nav-text">Students</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('branch_students') }}">View Students</a></li>
                        <li><a href="{{ route('branch_attendance_batches') }}">Student Attendance</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <div class="menu-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.7161 16.2234H8.49609" stroke="#130F26" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.7161 12.0369H8.49609" stroke="#130F26" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.2511 7.86011H8.49609" stroke="#130F26" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.9085 2.74982C15.9085 2.74982 8.23149 2.75382 8.21949 2.75382C5.45949 2.77082 3.75049 4.58682 3.75049 7.35682V16.5528C3.75049 19.3368 5.47249 21.1598 8.25649 21.1598C8.25649 21.1598 15.9325 21.1568 15.9455 21.1568C18.7055 21.1398 20.4155 19.3228 20.4155 16.5528V7.35682C20.4155 4.57282 18.6925 2.74982 15.9085 2.74982Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="nav-text">Assignments</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('submitted_assignment')}}">Submitted Project</a></li>
                        <li><a href="{{route('branch_send_assignment')}}">Send Projects</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <div class="menu-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 17.8476C17.6392 17.8476 20.2481 17.1242 20.5 14.2205C20.5 11.3188 18.6812 11.5054 18.6812 7.94511C18.6812 5.16414 16.0452 2 12 2C7.95477 2 5.31885 5.16414 5.31885 7.94511C5.31885 11.5054 3.5 11.3188 3.5 14.2205C3.75295 17.1352 6.36177 17.8476 12 17.8476Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M14.3889 20.8572C13.0247 22.372 10.8967 22.3899 9.51953 20.8572"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="nav-text">Notifications</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('branch_student_notifications')}}">Students</a></li>
                        <li><a href="{{route('branch_head_office_notifications')}}">Head Office</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <div class="menu-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21.6389 14.3958H17.5906C16.1042 14.3949 14.8993 13.191 14.8984 11.7045C14.8984 10.2181 16.1042 9.01416 17.5906 9.01324H21.6389"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M18.0485 11.6429H17.7369" stroke="#130F26" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.74766 3H16.3911C19.2892 3 21.6388 5.34951 21.6388 8.24766V15.4247C21.6388 18.3229 19.2892 20.6724 16.3911 20.6724H7.74766C4.84951 20.6724 2.5 18.3229 2.5 15.4247V8.24766C2.5 5.34951 4.84951 3 7.74766 3Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M7.03564 7.53814H12.4346" stroke="#130F26" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="nav-text">Finance</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('branch_fees_paid') }}">Paid Fees</a></li>
                        {{-- <li><a href="{{ route('branch_fees_due') }}">Due Fees</a></li> --}}
                        <li><a href="{{ route('branch_monthly_statements') }}">Monthly Statements</a></li>
                    </ul>
                </li>


            </ul>
            <div class="help-desk">
                <a href="{{route('logout')}}" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>

    <style>
        .menu-toggle .brand-logo {
            display: none !important;
        }
    </style>
