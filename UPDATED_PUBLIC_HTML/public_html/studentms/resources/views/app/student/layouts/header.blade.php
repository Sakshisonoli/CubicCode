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
                                            <h6>{{ auth()->guard('student')->user()->name }}</h6>
                                            <p>{{ auth()->guard('student')->user()->email }}</p>
                                        </div>

                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <div class="card border-0 mb-0">
                                        <div class="card-header py-2">
                                            <div class="products">

                                                <div>
                                                    <h6>{{ auth()->guard('student')->user()->name }}</h6>
                                                    <p>{{ auth()->guard('student')->user()->email }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer px-0 py-2">
                                            <a href="{{route('student_settings')}}" class="dropdown-item ai-icon ">
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
                <li><a href="{{ route('student_dashborad') }}" class="" aria-expanded="false">
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
                <li>
                    <a href="{{ route('student_profile') }}" class="" aria-expanded="false">
                        <div class="menu-icon">
                            <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9846 21.606C11.9846 21.606 19.6566 19.283 19.6566 12.879C19.6566 6.474 19.9346 5.974 19.3196 5.358C18.7036 4.742 12.9906 2.75 11.9846 2.75C10.9786 2.75 5.26557 4.742 4.65057 5.358C4.03457 5.974 4.31257 6.474 4.31257 12.879C4.31257 19.283 11.9846 21.606 11.9846 21.606Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    <span class="nav-text">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('student_assignments') }}" class="" aria-expanded="false">
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
                </li>


                <li>
                    <a href="{{ route('student_notifications') }}" class="" aria-expanded="false">
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
                </li>

                <li>
                    <a href="{{ route('student_payment_details') }}" class="" aria-expanded="false">
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
                    <span class="nav-text">Fees</span>
                    </a>
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
