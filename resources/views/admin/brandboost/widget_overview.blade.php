@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')

<link href="{{ base_url() }}assets/css/percircle.css" rel="stylesheet" type="text/css">
<script src = "{{ base_url() }}assets/js/percircle.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<!-- /theme JS files -->
<style>
    .outer_circle{padding: 14px; background: #fff; border: 1.5px solid #eee; margin: 0 auto!important; border-radius: 100%; width: 200px; height: 200px;}
    #bluecircle{margin: 0 auto!important; float: none!important; cursor: pointer; }
    /*text[text-anchor="end"]{    opacity: 0;}*/
    path[stroke-width="0.5"]{   stroke: #eeeeee!important;  opacity: 0; }
    #myfirstchart{background: url({{ base_url('assets/') }}images/graphbkg.png) left top repeat!important;}
    .min_h310{min-height: 300px;}
</style>

@php
if (empty($oCurrentLiveData)) {
    $oCurrentLiveData = '[No data]';
}

$currMonDate = array();
$newLIveCountryU = array();
foreach ($oLiveData as $key => $value) {
    $getMon = date('m', strtotime($value->created));
    $getDate = date('j M Y', strtotime($value->created));
    $currMonDate[] = strtotime($getDate);
}

krsort($currMonDate);
$newLIveU = array();
foreach ($currMonDate as $value) {
    $value = date('j M', $value);
    if (array_key_exists($value, $newLIveU)) {
        $newLIveU[$value] = $newLIveU[$value] + 1;
    } else {
        $newLIveU[$value] = 1;
    }
}
@endphp

<script>
    var arr = {{ json_encode($newLIveU) }};
    var widgetOverview = Object.keys(arr).map(function (key) {
        return {'y': key, 'a': arr[key]}
    });
</script>


<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-5">
                <h3 class="mt20"><img width="20" src="{{ base_url() }}assets/images/menu_icons/Website_Light.svg"/> Widgets Overview</h3>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-7 text-right btn_area">
                <button type="button" class="btn light_btn ml10"><i class="icon-download4"></i><span> &nbsp;  Import / Export</span> </button>
                <button type="button" class="btn dark_btn ml10" style="min-width: 140px;"><span>Add Widget</span> </button>
                <button type="button" class="btn dark_btn ml10"><i class="icon-plus3"></i></button>
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->



    <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->	
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">All Widgets Views</h6>
                </div>
                <div class="panel-body p0 bkg_white min_h310">
                    <div class="p20 bbot">
                        <p class="txt_grey fw300 m0"><i class="fa fa-square txt_orange"></i>  &nbsp; Widgets views &nbsp; &nbsp; <strong class="txt_dark"></strong></p>
                    </div>
                    <div class="p20" style="background: #fcfdfe!important; border-radius: 0 0 6px 6px">
                        <div id="myfirstchart" style="height: 200px;"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Widgets Today</h6>
                </div>
                <div class="panel-body p20 pt50 pb40 bkg_white text-center min_h310">
                      <!--<img src="assets/images/widget_today.png"/>-->
                    <div class="outer_circle">
                        <div id="bluecircle" class="c100 p58 medium">
                            <span><strong>{{ $oCurrentLiveData }}</strong> <br>ACTION <br> TODAY</span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>



    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Chat</h6>
                    <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                </div>
                <div class="panel-body p30 db_stats bkg_white">
                    <div class="row">
                        <div class="col-xs-2"><img class="pull-left" src="{{ base_url() }}assets/images/icon_chat_44.png"></div>
                        <div class="col-xs-10"><h1>{{ number_format($chatWidget) }}</h1><p><strong class="txt_green"><i class=""><img src="{{ base_url() }}assets/images/green_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"><img class="img-responsive mt30" src="{{ base_url() }}assets/images/chat_graph.png"/></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">On Site Boost</h6>
                    <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                </div>
                <div class="panel-body p30 db_stats bkg_white">
                    <div class="row">
                        <div class="col-xs-2"><img class="pull-left" src="{{ base_url() }}assets/images/icon_star_44.png"></div>
                        <div class="col-xs-10"><h1>{{ number_format($bOnsiteWidget) }}</h1><p><strong class="txt_orange"><i class=""><img src="{{ base_url() }}assets/images/red_down_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"><img class="img-responsive mt30" src="{{ base_url() }}assets/images/siteboost_chart.png"/></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Review Request</h6>
                    <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                </div>
                <div class="panel-body p30 db_stats bkg_white">
                    <div class="row">
                        <div class="col-xs-2"><img class="pull-left" src="{{ base_url() }}assets/images/icon_star_44.png"></div>
                        <div class="col-xs-10"><h1>1,468</h1><p><strong class="txt_orange"><i class=""><img src="{{ base_url() }}assets/images/red_down_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"><img class="img-responsive mt30" src="{{ base_url() }}assets/images/siteboost_chart2.png"/></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Off Site Boost</h6>
                    <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                </div>
                <div class="panel-body p30 db_stats bkg_white">
                    <div class="row">
                        <div class="col-xs-2"><img class="pull-left" src="{{ base_url() }}assets/images/icon_siteboost_44.png"></div>
                        <div class="col-xs-10"><h1>{{ number_format($bOffsiteWidget) }}</h1><p><strong class="txt_green"><i class=""><img src="{{ base_url() }}assets/images/green_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"><img class="img-responsive mt30" src="{{ base_url() }}assets/images/siteboost_chart3.png"/></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Email</h6>
                    <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                </div>
                <div class="panel-body p30 db_stats bkg_white">
                    <div class="row">
                        <div class="col-xs-2"><img class="pull-left" src="{{ base_url() }}assets/images/icon_email_44.png"></div>
                        <div class="col-xs-10"><h1>1,468</h1><p><strong class="txt_orange"><i class=""><img src="{{ base_url() }}assets/images/red_down_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">SMS</h6>
                    <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                </div>
                <div class="panel-body p30 db_stats bkg_white">
                    <div class="row">
                        <div class="col-xs-2"><img class="pull-left" src="{{ base_url() }}assets/images/icon_sms_44.png"></div>
                        <div class="col-xs-10"><h1>1,468</h1><p><strong class="txt_green"><i class=""><img src="{{ base_url() }}assets/images/green_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Notifications</h6>
                    <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                </div>
                <div class="panel-body p30 db_stats bkg_white">
                    <div class="row">
                        <div class="col-xs-2"><img class="pull-left" src="{{ base_url() }}assets/images/icon_notifications_44.png"></div>
                        <div class="col-xs-10"><h1>1,468</h1><p><strong class="txt_orange"><i class=""><img src="{{ base_url() }}assets/images/red_down_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Media</h6>
                    <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                </div>
                <div class="panel-body p30 db_stats bkg_white">
                    <div class="row">
                        <div class="col-xs-2"><img class="pull-left" src="{{ base_url() }}assets/images/icon_img_44.png"></div>
                        <div class="col-xs-10"><h1>1,468</h1><p><strong class="txt_green"><i class=""><img src="{{ base_url() }}assets/images/green_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">NPS</h6>
                    <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                </div>
                <div class="panel-body p30 db_stats bkg_white">
                    <div class="row">
                        <div class="col-xs-2"><img class="pull-left" src="{{ base_url() }}assets/images/icon_nps_44.png"></div>

                        <div class="col-xs-10"><h1>1,468</h1><p><strong class="txt_green"><i class=""><img src="{{ base_url() }}assets/images/green_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Referral</h6>
                    <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                </div>
                <div class="panel-body p30 db_stats bkg_white">
                    <div class="row">
                        <div class="col-xs-2"><img class="pull-left" src="{{ base_url() }}assets/images/icon_refferal_44.png"></div>
                        <div class="col-xs-10"><h1>1,468</h1><p><strong class="txt_orange"><i class=""><img src="{{ base_url() }}assets/images/red_down_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Callabck</h6>
                    <div class="heading-elements"><i class="icon-arrow-down12 txt_grey"></i></div>
                </div>
                <div class="panel-body p30 db_stats bkg_white">
                    <div class="row">
                        <div class="col-xs-2"><img class="pull-left" src="{{ base_url() }}assets/images/icon_callback_44.png"></div>
                        <div class="col-xs-10"><h1>1,468</h1><p><strong class="txt_orange"><i class=""><img src="{{ base_url() }}assets/images/red_down_arrow.png"/></i>&nbsp; 33,87%</strong> &nbsp; <span class="txt_dgrey">last week</span></p></div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->





</div>





<script>
// top navigation fixed on scroll and side bar collasped
    $(window).scroll(function () {
        var sc = $(window).scrollTop();
        if (sc > 100) {
            $("#header-sroll").addClass("small-header");
        } else {
            $("#header-sroll").removeClass("small-header");
        }
    });

    function smallMenu() {
        if ($(window).width() < 1600) {
            $('body').addClass('sidebar-xs');
        } else {
            $('body').removeClass('sidebar-xs');
        }
    }

    $(document).ready(function () {
        smallMenu();

        window.onresize = function () {
            smallMenu();
        };
    });


</script>
<script>



    Morris.Area({
        element: 'myfirstchart',
        parseTime: false,

        data: widgetOverview,

        xkey: 'y',
        ykeys: ['a'],
        labels: ['Total'],
        pointSize: 0,
        lineWidth: 2,
        padding: 0,
        fillOpacity: 0.3,
        hideHover: 'auto',
        behaveLikeLine: true,
        resize: true,
        pointFillColors: ['#ffffff'],
        pointStrokeColors: ['black'],
        lineColors: ['#ea8c7c', '#0c265a'],

    });

</script>
@endsection