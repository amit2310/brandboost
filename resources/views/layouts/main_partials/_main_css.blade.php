<link href="{{ URL::asset('html_2.0/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.3.0/fonts/remixicon.css" rel="stylesheet">
<link href="{{ URL::asset('html_2.0/assets/css/style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('html_2.0/assets/css/styleguide.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('html_2.0/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/dropzone-master/dist/dropzone.css') }}" rel="stylesheet" type="text/css">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="https://seiyria.com/bootstrap-slider/css/bootstrap-slider.css" rel="stylesheet" type="text/css">

<!-- Sub User Css -->
@if(!$isLoginPage)
@if($userRole == '2')
    <link href="{{ URL::asset('assets/css/theme1.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/profile_css/profile.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">

@endif
@endif

