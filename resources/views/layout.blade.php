<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="INSPIRO"/>
    <meta name="description" content="Themeforest Template Polo, html template">
    <link rel="icon" type="image/png" href="{{ 'img/favicon.png' }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cinema</title>
    <link href="{{ asset('/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="body-inner">
    <header id="header">
        <div class="header-inner">
            <div class="container">
                <div id="logo">
                    <a href="{{ route('main') }}">
                        <span class="logo-default">Movies</span>
                        <span class="logo-dark">Movies</span>
                    </a>
                </div>
                <div id="mainMenu">
                    <div class="container">
                        <nav>
                            <ul>
                                <li><a href="{{ route('main') }}">Home</a></li>
                                <li><a href="{{ route('movies.afisha') }}">Movies</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                @auth
                                    <li class="dropdown"><a href="#">Account</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('account.show') }}">My Account</a></li>
                                            <li><a href="{{ route('tickets.all') }}">My Tickets</a></li>
                                        </ul>
                                    </li>
                                    @if(Auth::user()->is_admin)
                                        <li class="dropdown"><a href="#">Admin</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('admin.halls.index') }}">Halls</a></li>
                                                <li><a href="{{ route('admin.movies.index') }}">Movies</a></li>
                                                <li><a href="{{ route('admin.seances.index') }}">Sessions</a></li>
                                                <li><a href="{{ route('admin.types.index') }}">Seat Types</a></li>
                                            </ul>
                                        </li>
                                    @endif
                                    <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                                @endauth
                                @guest
                                    <li><a href="{{ route('auth.login') }}">Login</a></li>
                                    <li><a href="{{ route('auth.register') }}">Register</a></li>
                                @endguest
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <!-- Footer -->
    <footer id="footer">
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-box effect small clean">
                            <div class="icon">
                                <a href="#"><i class="icon-clock"></i></a>
                            </div>
                            <h3>Working Days</h3>
                            <p><strong>Monday - Friday</strong>
                                <br>10:00 AM - 11:00 PM</p>
                            <p><strong>Saturday - Sunday</strong>
                                <br>10:00 AM - 04:00 PM</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="icon-box effect small clean">
                            <div class="icon">
                                <a href="#"><i class="fas fa-map-marker-alt"></i></a>
                            </div>
                            <h3>Caffe Location</h3>
                            <p><strong>Caffe Address:</strong>
                                <br> 795 Folsom Ave, Suite 600
                                <br> San Francisco, CA 94107
                                <br>
                                <br>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="icon-box effect small clean">
                            <div class="icon">
                                <a href="#"><i class="icon-phone"></i></a>
                            </div>
                            <h3>Caffe Contact</h3>
                            <p><strong>Phone:</strong>
                                <br> (123) 456-7890
                                <br> (987) 654-3210
                                <br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Social icons -->
                        <div class="social-icons social-icons-colored float-left">
                            <ul>
                                <li class="social-rss"><a href="#"><i class="fa fa-rss"></i></a></li>
                                <li class="social-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="social-twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="social-vimeo"><a href="#"><i class="fab fa-vimeo"></i></a></li>
                                <li class="social-youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                <li class="social-pinterest"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                <li class="social-gplus"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>
                        <!-- end: Social icons -->
                    </div>
                    <div class="col-lg-6">
                        <div class="copyright-text text-center">&copy; 2019 POLO - Responsive Multi-Purpose HTML5
                            Template. All Rights Reserved.<a href="//www.inspiro-media.com" target="_blank"
                                                             rel="noopener">INSPIRO</a></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>

@if (session('success'))
    <div id="notification-modal" data-notify="container" data-animate="zoomIn"
         class="bootstrap-notify col-xs-11 col-sm-3 alert alert-success" role="alert" data-notify-position="top-right"
         style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 10000; top: 30px; right: 30px;">
        <span data-notify="title">{{ session('success') }}</span>
    </div>
@elseif(session('error'))
    <div id="notification-modal" data-notify="container" data-animate="zoomIn"
         class="bootstrap-notify col-xs-11 col-sm-3 alert alert-danger" role="alert" data-notify-position="top-right"
         style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 10000; top: 30px; right: 30px;">
        <span data-notify="icon"></span> <span data-notify="title">{{ session('error') }}</span>
    </div>
@endif
<script src="{{ asset('/js/jquery.js') }}"></script>
<script src="{{ asset('/js/plugins.js') }}"></script>
<script src="{{ asset('/js/functions.js') }}"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    setTimeout(function () {
        $('#notification-modal').hide('slow');
    }, 3000);

</script>
</body>
</html>
