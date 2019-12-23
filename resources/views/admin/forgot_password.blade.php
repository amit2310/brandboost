<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Recover Your Password - Brand Boost</title>
        @include('layouts.main_partials._main_favicon')
        @include('layouts.main_partials._main_meta')
        <!--******************
        CSS
        **********************-->
        @include('layouts.main_partials._main_css')

    </head>

    <body id="login_page">

    <div class="login_text_area">
        <div class="inner_txt">
            <img src="{{ URL::asset('assets/images/login_logo.svg') }}"/>
            <h3 class="htxt_medium_20 mb20 mt25">All-in-one business toolkit</h3>
            <p class="htxt_regular_14 lh_20 m-0">Run your successful business online with all apps you need to make your life easier, grow faster and make your clients happy.</p>
        </div>
    </div>

    <div class="login_area">
        <div class="login_section m-auto">

            @if (Session::has('forgot_success_message'))
                {{--<div class="alert-success text-center" style="margin-bottom:10px;">
                    {{ session('forgot_success_message') }}
                </div>--}}
                <div class="row">
                    <div class="col text-center">
                        <img class="mt20" src="{{ URL::asset('assets/images/email_sent.svg') }}"/>
                        <h3 class="htxt_medium_20 dark_900 mb15 mt40">Email sent!</h3>
                        <p class="dark_200 fsize15 mb-5 lh_22">You’ve been emailed a password reset link.</p>
                    </div>
                </div>
            @else

            <form action="{{ url('/admin/forgot_password') }}" method="post">
                @csrf
                <div class="toparea bbot">

                    <div class="row">
                        <div class="col">
                            <h3 class="htxt_medium_20 dark_900 mb20">Forgot your password</h3>
                            <p class="dark_200 fsize15 mb-5 lh_22">We will send a recovery link to your inbox<br>
                                so that you can reset your password <br>

                                and access your account.</p>
                        </div>
                    </div>

                    @if (Session::has('forgot_error_message'))
                        <div class="alert-danger text-center" style="margin-bottom:10px;">
                            {{ Session::get('forgot_error_message') }}

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            {{ session('authenticate') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">EMAIL</label>
                                <input type="text" class="form-control h56 email" id="email" placeholder="Enter your email here" name="email"required="">
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-8">
                            <button class="login_btn">Reset my password</button>
                        </div>
                    </div>

                </div>
            </form>
            @endif

            <div class="p30 pl50 pr50">
                <div class="row">
                    <div class="col-md-6 brig">
                        <a class="dontac" href="{{ url('/admin/login') }}"><img src="{{ URL::asset('assets/images/arrow-left-line.svg') }}"/> &nbsp; Return to login</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('/admin/login') }}" class="signinsec ml10"><img src="{{ URL::asset('assets/images/customer-service-2-fill.svg') }}"/> &nbsp; Contact Support </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--******************
      jQuery
     **********************-->
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/pages/login.js') }}"></script>
    <!-- /theme JS files -->
    <script>
        document.getElementById("loginerrorclose").addEventListener("click", function(e){
            e.preventDefault();
            document.getElementById("login_error").style.display = "none";
        });
    </script>
</body>
</html>
