@php
$isLoginPage = 1;
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login - Brand Boost</title>
        @include('layouts.main_partials._main_favicon')
        @include('layouts.main_partials._main_meta')
        <!--******************
        CSS
        **********************-->
        @include('layouts.main_partials._main_css')

    </head>

    <body id="login_page">
    <div id="login_error">
        <div class="container" style="max-width: 970px">
            <div class="row">
                <div class="col-md-10"><i><img src="{{ URL::asset('assets/images/error-warning-line.svg') }}"/></i> &nbsp; There isn't an BrandBoost account associated with iver.mdx@gmail.com.
                    <a href="#" class="signinsec ml20 blef pl20"><img src="{{ URL::asset('assets/images/account-circle-fill-16.svg') }}"> &nbsp; Sign up in seconds</a>
                </div>
                <div class="col-md-2 text-right">
                    <a href="#" id="loginerrorclose"><img src="{{ URL::asset('assets/images/loginerror_close.svg') }}"/></a>
                </div>
            </div>
        </div>
    </div>

    <div class="login_text_area">
        <div class="inner_txt">
            <img src="{{ URL::asset('assets/images/login_logo.svg') }}"/>
            <h3 class="htxt_medium_20 mb20 mt25">All-in-one business toolkit</h3>
            <p class="htxt_regular_14 lh_20 m-0">Run your successful business online with all apps you need to make your life easier, grow faster and make your clients happy.</p>
        </div>
    </div>

    <div class="login_area">
        <div class="login_section m-auto">

            <form action="{{ url('/admin/login') }}" method="post">
                @csrf
                <div class="toparea bbot">

                <div class="row">
                    <div class="col">
                        <h3 class="htxt_medium_20 dark_900 mb20">Log in</h3>
                        {{--<button class="loginwith google mb10">Log in with Google</button>
                        <button class="loginwith facebook">Log in with Facebook</button>
                        <img class="mt25 mb25" src="{{ URL::asset('assets/images/login_or.svg') }}"/>--}}
                    </div>
                </div>

                @if (Session::has('success_message'))
                    <div class="alert-success text-center" style="margin-bottom:10px;">
                        {{ Session::get('success_message') }}
                    </div>
                @endif

                @if (Session::has('error_message'))
                    <div class="alert-danger text-center" style="margin-bottom:10px;">
                        {{ Session::get('error_message') }}

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

                <div class="row">
                    <div class="col">
                        <div class="form-group mb25">
                            <label for="password">PASSWORD</label>
                            <input type="password" class="form-control h56 password" id="password" placeholder="Enter your password here" name="password" required="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button class="login_btn">Log in</button>
                    </div>
                    <div class="col">
                        <a class="fgpswd" href="{{ url('/admin/forgot_password') }}">Forgot passoword?</a>
                    </div>
                </div>
            </div>
            </form>

            <div class="p30 pl50 pr50">
                <div class="row">
                    <div class="col brig">
                        <a class="dontac" href="#">Don’t have an account?</a>
                    </div>
                    <div class="col">
                        <a href="#c" class="signinsec ml10"><img src="{{ URL::asset('assets/images/account-circle-fill-16.svg') }}"/> &nbsp; Sign up in seconds</a>
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
