<link href="{{ URL::asset('admin_2.0/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('admin_2.0/assets/css/style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('admin_2.0/assets/css/styleguide.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('admin_2.0/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/dropzone-master/dist/dropzone.css') }}" rel="stylesheet" type="text/css">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<!-- Sub User Css -->
@if(!$isLoginPage)
@if($userRole == '2' || true)
<link href="{{ URL::asset('assets/profile_css/profile.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
@endif
@endif

