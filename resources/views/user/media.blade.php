@extends('layouts.user_template')

@section('title')

@endsection

@section('contents')

    <div class="content_area">
        <div class="row">
            <div class="col-md-12">
                <div class="white_box profile_sec mb20">
                    <div class="backbtn">
                        <a href="#"><img src="{{ base_url() }}assets/profile_images/back_40.png"></a>
                    </div>

                    <div class="p25 bbot text-center">
                        <h3>My Media</h3>
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
                                                                                    src="assets/images/cd_icon1.png">All
                                                    (39) </a></strong></li>
                                        <li><strong><a href="#"><img class="small" src="assets/images/cd_icon2.png">Open
                                                    (13) </a></strong></li>
                                        <li><strong><a href="#"><img class="small" src="assets/images/cd_icon3.png">Resolved
                                                    (172) </a></strong></li>
                                        <li><strong><a href="#"><img class="small" src="assets/images/cd_icon4.png">Favorite
                                                    (5) </a></strong></li>
                                        <li><strong><a href="#"><img class="small" src="assets/images/cd_icon5.png">Snoozed
                                                    (28)</a></strong></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <a class="pull-right txt_grey fsize12" href="#"><i><img
                                            style="vertical-align: top; margin-top: 4px"
                                            src="{{ base_url() }}assets/profile_images/edit_icon.png" width="12"></i>
                                    &nbsp; Edit</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="row profile_media_outer">
            @php
                if(!empty($myReview)) {
                  $inc = 1;
                foreach ($myReview as $key => $value) {
                   $media_url = $value->media_url;
                   if(!empty($media_url)) {
                     $media_url = unserialize($media_url);
                     if(!empty($media_url)) {

                          foreach($media_url as $media) {

            @endphp
            <div class="col-md-3">
                <div class="profile_media">
                    @php
                        if($media['media_type'] == 'image') {
                            $imageUrl = 'https://s3-us-west-2.amazonaws.com/brandboost.io/'.$media['media_url'];
                    @endphp
                    <img src="{{ $imageUrl }}"/>
                    @php
                        } else if($media['media_type'] == 'video') {
                            $imageUrl = 'https://s3-us-west-2.amazonaws.com/brandboost.io/'.$media['media_url'];
                    @endphp
                    <video width="100%">
                        <source src="{{ $imageUrl }}" type="video/mp4">
                    </video>
                    @php
                        }
                    @endphp
                </div>
            </div>
            @php
                if($inc%4 == 0) {
            @endphp
        </div>
        <div class="row profile_media_outer">
            @php
                }
                $inc++;
              }
           }
         }
      }
      }
      else {
            @endphp
            <div class="col-md-12">
                <ul class="nps_feedback">
                    <li>
                        <center>No Media Found</center>
                    </li>
                </ul>
            </div>
            @php
                }
            @endphp
        </div>

    </div>

@endsection
