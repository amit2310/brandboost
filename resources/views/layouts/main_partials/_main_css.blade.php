<!-- Global stylesheets -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="https://cloud.typography.com/6448636/7432192/css/fonts.css"/>
<link href="{{ URL::asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/bootstrap.css') }}"  rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/theme1.css') }}" rel="stylesheet" type="text/css">
<style type="text/css">
    .dataTables_filter {display: none;}
    .starGray{color:#dbdcdd!important;}
    .starGray:hover{color:#4285f4!important;}
    @keyframes ball-scale-multiple {
        0% {
            -webkit-transform: scale(0);
            transform: scale(0);
            opacity: 0;
        }
        5% {
            opacity: 1;
        }
        100% {
            -webkit-transform: scale(1);
            transform: scale(1);
            opacity: 0;
        }
    }
    .ball-scale-multiple{
        margin-left: 00px;
        top: 10px;
        position: relative;
        -webkit-transform: translateY(-30px);
        transform: translateY(-30px);
    }
    .ball-scale-multiple > div:nth-child(2) {
        -webkit-animation-delay: -0.4s;
        animation-delay: -0.4s;
    }
    .ball-scale-multiple > div:nth-child(3) {
        -webkit-animation-delay: -0.2s;
        animation-delay: -0.2s;
    }
    .ball-scale-multiple > div {
        background-color: #fff;
        width: 15px;
        height: 15px;
        border-radius: 100%;
        margin: 2px;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        position: absolute;
        left: 50%;
        top: 0px;
        opacity: 0;
        margin: 0 0 0 -21px;
        width: 40px;
        height: 40px;
        -webkit-animation: ball-scale-multiple 1s 0s linear infinite;
        animation: ball-scale-multiple 1s 0s linear infinite;
    }
    .bg-teal-400 {border-color:transparent; color: #fff; font-weight: 700; background: none; padding:0;  font-size: 16px; background-color: transparent;}
    .btn:hover, .btn:focus, .btn.focus { -webkit-box-shadow: none; box-shadow: none;} 


    .logout_notifications{ width: 337px;
                           height: 158px;
                           border-radius: 4px;
                           box-shadow: 0 10px 20px 0 rgba(1, 21, 64, 0.04);
                           background-color: #fff; position: relative; display: inline-block;
                           margin: 0 20px 0 0;}
    .logout_notifications p{margin-bottom: 7px;}
    .gery_btn{
        height: 32px;
        border-radius: 4px;
        /*box-shadow: inset 0 1px 0 0 rgba(0, 0, 0, 0.04);*/
        background-color: #f2f5f9; padding: 0 20px; color: #09204f; border: none; margin-right: 10px; margin-top: 5px; font-size: 13px; }
    .close_no{position: absolute; width: 10px; height: 10px; top:20px; right:20px;}

</style>