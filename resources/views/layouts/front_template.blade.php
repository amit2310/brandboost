<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>Brand Boost</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/css/feedback.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/css/intlTelInput.css">
        <script src="{{ base_url() }}assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="{{ base_url() }}assets/js/core/libraries/bootstrap.min.js"></script>


        <style>
            .step_star ul {
                list-style-type:none;
                padding:0;
                display: inline-block;
                -moz-user-select:none;
                -webkit-user-select:none;
            }

            .step_star ul > li.star {
                display:inline-block;
            }

            .step_star ul > li.star > i.fa {
                font-size:50px;
                color:#ccc;
            }

            .step_star ul > li.star.hover > i.fa {
                color:#FFCC36;
            }

            .step_star ul > li.star.selected > i.fa {
                color:#FF912C;
            }
        </style>

    </head>

    <body>

        <!--=====================header=========================-->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="logo">
                            <a href="{{ base_url() }}">
                                <img src="{{ base_url() }}assets/images/logo_icon.png"/>
                                <span>BrandBoost.io</span>
                                <span class="slogan">By Interesting Aps</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <nav class="navbar navbar-inverse">
                            <div class="container-fluid p0">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="collapse navbar-collapse p0" id="myNavbar">
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">HOW IT WORKS</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">FEATURES</a></li>
                                                <li><a href="#">INTEGRATIONS</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ base_url('price') }}">PRICING</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>

                    <div class="col-md-2 text-right">
                        <a style="padding-left: 0;" href="{{ base_url() }}/" class="btn btn-orange pull-right title_btn" id="newProducts"><span> &nbsp; &nbsp; Get Started Free</span></a>
                    </div>
                </div>
            </div>
        </header>

        <!--=====================body=========================-->
        @yield('contents')
        <!--=====================footer=========================-->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="logo">
                            <a href="{{ base_url() }}">
                                <img src="{{ base_url() }}assets/images/logo_icon.png"/>
                                <span>BrandBoost.io</span>
                                <span class="slogan">By Interesting Aps</span>
                            </a>
                        </div>
                    </div>

                    <div style="padding-left: 70px;" class="col-md-2">
                        <div class="footer-text-block">
                            <h5 class="footer-heading">Company</h5>
                            <h6>
                                <a href="/why" class="footer-links">Why</a>
                                <a href="/blog" class="footer-links">Articles</a>
                                <a href="/privacy" class="footer-links">Privacy</a>
                                <a href="/terms" class="footer-links">Terms</a>
                            </h6>
                        </div>
                    </div>

                    <div style="padding-left: 40px;" class="col-md-2">
                        <div class="footer-text-block">
                            <h5 class="footer-heading">Product</h5>
                            <h6>
                                <a href="#" class="footer-links">List Verification</a>
                                <a href="#" class="footer-links">Real-Time APIs</a>
                                <a href="#" class="footer-links">Integrations</a>
                                <a href="#" class="footer-links">Pricing</a>
                                <a href="#" class="footer-links">Sign In</a>
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="footer-text-block">
                            <h5 class="footer-heading">Support</h5>
                            <h6>
                                <a href="#" class="footer-links">Learning Center</a>
                                <a href="#" class="footer-links">Contact Support</a>
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="footer-text-block">
                            <div class="divider">&nbsp;</div>
                            <h5 class="footer-heading"><strong>Brand Boost USA</strong></h5>
                            <p class="footer-links">
                                4725 Piedmont Row Drive<br>STE 420<br>Charlotte, NC 28210<br>+1.855.862.7483
                            </p>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="footer-text-block">
                            <h5 class="footer-heading"><strong>Brand Boost UK</strong></h5>
                            <p class="footer-links">
                                22 Upper Ground<br>London SE1 9PD<br>+44 (0) 2080 047138
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
