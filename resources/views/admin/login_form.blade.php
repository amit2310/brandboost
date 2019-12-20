<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login at Brandboost</title>

        <!-- Global stylesheets -->

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ URL::asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/theme1.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/login.css') }}" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/core/libraries/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

        <script type="text/javascript" src="{{ URL::asset('assets/js/core/app.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/pages/login.js') }}"></script>
        <!-- /theme JS files -->

        <style type="text/css">
            .form_center{
                margin-top: -225px;
            }
        </style>

    </head>

    <body class="login-container">

        <!-- Page container -->
        <div class="page-container p0">

            <!-- Page content -->
            <div class="page-content p0">

                <!-- Main content -->
                <div class="content-wrapper login_sec2 sign_in login_new login_new3">

                    <!-- Content area -->
                    <div class="content p0" style="padding-top: 0!important">
                        <div class="login_main2">
                            <!-- Advanced login -->

                            <div class="panel login-form2">
                                <div class="form_center">
                                    <form action="{{ url('/admin/login') }}" method="post">
                                        @csrf
                                        <div class="pt30 pb20 bbot">
                                            <div class="text-center">
                                                <img width="72" src="{{ URL::asset('assets/images/bb_icon.png') }}" class="br100 br_s mb-5">
                                                <h5 class="content-group-lg fsize20 fw500">Sign in to your account <small class="display-block fsize14">Welcome, back!</small></h5>
                                            </div>

                                            <!-- <div class="sign_go bkg_white p-5 text-center br5 w100 mt-5">
                    <a href="" class="txt_dgrey fsize14 fw500"><img src="{{ URL::asset('assets/images/google_login.png') }}">Sign in with Google</a>
                       </div>
                                      <div class="sign_go bkg_white p-5 text-center br5 w100 mt10">
            <a href="" class="txt_dgrey fsize14 fw500"><img src="{{ URL::asset('assets/images/fb_icon_login.png') }}">Sign in with Facebook</a>
               </div>
    <div class="line_or"><p>or</p></div> -->

                                            <div class="alert-success text-center" style="margin-bottom:10px;">
                                                {{ session('success_message') }}
                                            </div>
                                            @if ($errors->any())
                                            <div class="alert-danger text-center" style="margin-bottom:10px;">
                                                {{ session('error_message') }}

                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                {{ session('authenticate') }}
                                            </div>
                                            @endif

                                            <div class="form_m">
                                                <div class="form-group has-feedback has-feedback-left mb0">
                                                    <input type="text" class="form-control input-lg h52" placeholder="login@example.com" name="email" id="email" required="">
                                                    <div class="form-control-feedback h52">
                                                        <i class="fa fa-envelope-o text-muted"></i>Email
                                                    </div>
                                                </div>
                                                <div class="form-group has-feedback has-feedback-left ">
                                                    <input type="password" class="form-control input-lg h52" placeholder="password" name="password" id="password" required="">
                                                    <div class="form-control-feedback h52">
                                                        <i class="icon-lock2 text-muted">                                                                            </i>Password
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-group mb30">
                                                <button type="submit" class="btn dark_btn btn_skyblue btn-block h52 fsize14 fw500 btn_pruple2">Signin</button>
                                            </div>

                                            <div class="form-group login-options mb30">
                                                <div class="row">
                                                    <!--<div class="col-sm-6">

                                                     <ul class="list-inline form-group list-inline-condensed">
                                                     <li><a href="#"><img src="assets/images/google_icon.png"></a></li>
         <li><a href="#"><img src="assets/images/fb_icon.png"></a></li>
         <li><a href="#"><img src="assets/images/twitter_icon.png"></a></li>

         </ul>
                                                                                             </div>-->

                                                    <div class="col-sm-12 text-center forget_pass">
                                                        <a class="text-size-small btn-link fsize13 fw500" href="{{ url('/admin/forgot_password') }}">Forgot password?</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="login_footer text-center text-muted text-size-small pt30 fsize13 fw500 ">Don’t have an account? <a class="btn-link fw600" href="#">Sign Up!</a></div>
                                    </form>
                                </div>
                            </div>
                            <div class="login_slider2">
                                <div class="row">
                                    <div class="col-md-12 carousel_main">
                                        <div id="DemoCarousel" class="carousel slide width_500 text-center slider_c" data-interval="10000" data-ride="carousel">

                                            <ol class="carousel-indicators">
                                                <li data-target="#DemoCarousel" data-slide-to="0" class="active"></li>
                                                <li data-target="#DemoCarousel" data-slide-to="1"></li>
                                                <li data-target="#DemoCarousel" data-slide-to="2"></li>
                                                <li data-target="#DemoCarousel" data-slide-to="3"></li>
                                                <li data-target="#DemoCarousel" data-slide-to="4"></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="item tutorials loginslide active">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <img src="{{ URL::asset('assets/images/icon-125.png') }}" class="mt-10">
                                                            <p><strong class="fsize22 fw500 mb30">Email marketing toolkit  </strong></p>
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <div class="box_main pt40">
                                                                <div class="box_1 txt_grey pt20 pb20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Create unique campaigns</p></div>
                                                                <div class="box_1 txt_grey pt20 pb20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Connect your favorite tools</p></div>
                                                                <div class="box_1 b_r txt_grey pb20 pt20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Automate your busy work</p></div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="item tutorials loginslide">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <img src="{{ URL::asset('assets/images/icon-125.png') }}" class="mt-10">
                                                            <p><strong class="fsize22 fw500 mb30">Build  email marketing </strong></p>
                                                            <p class="mt-5 fsize14">Create branded and personalized emails with pixel perfect accuracy. Start from a gorgeous template or design your own. Unleash your creativity. </p>
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <div class="box_main pt40">
                                                                <div class="box_1 txt_grey pt20 pb20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Create unique campaigns</p></div>
                                                                <div class="box_1 txt_grey pt20 pb20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Connect your favorite tools</p></div>
                                                                <div class="box_1 b_r txt_grey pb20 pt20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Automate your busy work</p></div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="item tutorials loginslide">
                                                    <div c                lass="row">
                                                        <div class="col-xs-12">
                                                            <img src="{{ URL::asset('assets/images/icon-125.png') }}" class="mt-10">
                                                            <p><strong class="fsize22 fw500 mb30">Build  email marketing </strong></p>
                                                            <p class="mt-5 fsize14">Create branded and personalized emails with pixel perfect accuracy. Start from a gorgeous template or design your own. Unleash your creativity.</p>
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <div class="box_main pt40">
                                                                <div class="box_1 txt_grey pt20 pb20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Create unique campaigns</p></div>
                                                                <div class="box_1 txt_grey pt20 pb20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Connect your favorite tools</p></div>
                                                                <div class="box_1 b_r txt_grey pb20 pt20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Automate your busy work</p></div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="item tutorials loginslide">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <img src="{{ URL::asset('assets/images/icon-125.png') }}" class="mt-10">
                                                            <p><strong class="fsize22 fw500 mb30">Build  email marketing </strong></p>
                                                            <p class="mt-5 fsize14">Create branded and personalized emails with pixel perfect accuracy. Start from a gorgeous template or design your own. Unleash your creativity. </p>
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <div class="box_main pt40">
                                                                <div class="box_1 txt_grey pt20 pb20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Create unique campaigns</p></div>
                                                                <div class="box_1 txt_grey pt20 pb20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Connect your favorite tools</p></div>
                                                                <div class="box_1 b_r txt_grey pb20 pt20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Automate your busy work</p></div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="item tutorials loginslide">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <img src="{{ URL::asset('assets/images/icon-125.png') }}" class="mt-10">
                                                            <p><strong class="fsize22 fw500 mb30">Build  email marketing </strong></p>
                                                            <p class="mt-5 fsize14">Create branded and personalized emails with pixel perfect accuracy. Start from a gorgeous template or design your own. Unleash your creativity. </p>
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <div class="box_main pt40">
                                                                <div class="box_1 txt_grey pt20 pb20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Create unique campaigns</p></div>
                                                                <div class="box_1 txt_grey pt20 pb20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Connect your favorite tools</p></div>
                                                                <div class="box_1 b_r txt_grey pb20 pt20 pl30 pr30"><i><img src="{{ URL::asset('assets/images/icon_blue.png') }}" class="mb10"></i><p>Automate your busy work</p></div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!--<a class="btn dark_btn caro_next_btn" href="#DemoCarousel" data-slide="next">Next</a>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /advanced login -->
                        </div>


                    </div>
                    <!-- /content area -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->

    </body>
</html>
