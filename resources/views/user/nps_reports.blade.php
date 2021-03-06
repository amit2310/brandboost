@extends('layouts.user_template')

@section('title')

@endsection

@section('contents')
    <style>
        .fsize28 {
            font-size: 22px !important;
        }
    </style>
    <div class="content_area">
        <div class="row">
            <div class="col-md-12">
                <div class="white_box profile_sec mb20">
                    <div class="backbtn">
                        <a href="#"><img src="{{ base_url() }}assets/profile_images/back_40.png"></a>
                    </div>

                    <div class="p25 bbot text-center">
                        <h3>NPS Reports</h3>
                        <p>Basic information that you use in BrandBoost services.</p>
                    </div>

                    <div class="p20">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="tdropdown ml0"><a style="margin:0!important;"
                                                              class="dropdown-toggle fsize12 txt_grey"
                                                              data-toggle="dropdown" aria-expanded="false"> Sort by date
                                        <i class="icon-arrow-down22"></i></a>
                                    <ul style="left: 0px!important; margin-top: 15px; left: auto;"
                                        class="dropdown-menu dropdown-menu-left chat_dropdown">
                                        <li><strong><a class="active" href="#"><img class="small"
                                                                                    src="{{ base_url() }}assets/images/cd_icon1.png">
                                                    All (1) </a></strong></li>
                                        <li><strong><a href="#"><img class="small"
                                                                     src="{{ base_url() }}assets/images/cd_icon3.png">Active
                                                    (1) </a></strong></li>
                                        <li><strong><a href="#"><img class="small"
                                                                     src="{{ base_url() }}assets/images/cd_icon2.png">Inactive
                                                    (0) </a></strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--====Top Section Graph====-->
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-flat">
                    <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                        <div class="p20">
                            <img width="44" class="br100 mb10" src="{{ base_url() }}assets/images/ro_icon3.png"/>
                            <h1 class="txt_dark fsize28 fw700">{{ $totalEmailSent == '' ? 1 : $totalEmailSent }}</h1>
                            <p class="fsize14 txt_dgrey mb0">Total Feedbacks</p>
                        </div>
                        <div class="btop p20">
                            <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-flat">
                    <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                        <div class="p20">
                            <img width="44" class="br100 mb10" src="{{ base_url() }}assets/images/ro_icon3.png"/>
                            <h1 class="txt_dark fsize28 fw700">{{ $totalSmsSent == '' ? 9 : $totalSmsSent }}</h1>
                            <p class="fsize14 txt_dgrey mb0">Scores</p>
                        </div>
                        <div class="btop p20">
                            <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-flat">
                    <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                        <div class="p20">
                            <img width="44" class="br100 mb10" src="{{ base_url() }}assets/images/ro_icon1.png"/>
                            @if(!empty($oUntrackedPurchased))
                                @php
                                    $oUntrackedPurchased = (count($oUntrackedPurchased)) ? count($oUntrackedPurchased) : 1;
                                @endphp
                            @else
                                @php
                                    $oUntrackedPurchased = '';
                                @endphp
                            @endif
                            <h1 class="txt_dark fsize28 fw700">{{ $oUntrackedPurchased }}</h1>
                            <p class="fsize14 txt_dgrey mb0">Total Email</p>
                        </div>
                        <div class="btop p20">
                            <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-flat">
                    <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                        <div class="p20">
                            <img width="44" class="br100 mb10" src="{{ base_url() }}assets/images/ro_icon1.png"/>
                            @if(!empty($untrackedAmount))
                                @php
                                    $untrackedAmount = ($untrackedAmount) ? $untrackedAmount : 1;
                                @endphp
                            @else
                                @php
                                    $untrackedAmount = '';
                                @endphp
                            @endif
                            <h1 class="txt_dark fsize28 fw700">{{ $untrackedAmount }}</h1>
                            <p class="fsize14 txt_dgrey mb0">Total SMS</p>
                        </div>
                        <div class="btop p20">
                            <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====Stats====-->

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-flat">
                    <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                        <div class="p20">
                            <img width="44" class="br100 mb10" src="{{ base_url() }}assets/images/ro_icon2.png"/>
                            @if(!empty($totalOpened))
                                @php
                                    $totalOpened = $totalOpened == '' ? 1 : $totalOpened;
                                @endphp
                            @else
                                @php
                                    $totalOpened = '';
                                @endphp
                            @endif
                            <h1 class="txt_dark fsize28 fw700">{{ $totalOpened }}</h1>
                            <p class="fsize14 txt_dgrey mb0">Opens</p>
                        </div>
                        <div class="btop p20">
                            <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-flat">
                    <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                        <div class="p20">
                            <img width="44" class="br100 mb10" src="{{ base_url() }}assets/images/ro_icon2.png"/>
                            @if(!empty($totalClicked))
                                @php
                                    $totalClicked = $totalClicked == '' ? 1 : $totalClicked;
                                @endphp
                            @else
                                @php
                                    $totalClicked = '';
                                @endphp
                            @endif
                            <h1 class="txt_dark fsize28 fw700">{{ $totalClicked }}</h1>
                            <p class="fsize14 txt_dgrey mb0">Clicks</p>
                        </div>
                        <div class="btop p20">
                            <p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--====Table====-->
    </div>
@endsection
