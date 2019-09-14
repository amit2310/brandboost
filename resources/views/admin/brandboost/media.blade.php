@extends('layouts.main_template')

@section('title')
{{ $title }}
@endsection

@section('contents')

<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/pages/gallery.js"></script>
<style type="text/css">
    .thumbnail .thumb img {border-radius: 5px 5px 0 0; height: 220px;}
    .caption-overflow.smallovfl{ color: #333;  width: 60px; line-height: 44px;  }
    .caption-overflow.smallovfl a {    display: block;    height: 44px;    text-align: center; color: #fff; }
    .caption-overflow.smallovfl a i{font-size: 18px;}
    .small_media_icon:hover .caption-overflow.smallovfl{ visibility: visible!important; opacity: 1!important; background: rgba(0,0,0,0.4); border-radius: 5px;}
</style>



<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img src="{{ base_url('assets/images/media.png') }}"/>On site Media</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">All</a></li>
                    <li><a href="#right-icon-tab1" data-toggle="tab">Images</a></li>
                    <li><a href="#right-icon-tab2" data-toggle="tab">Videos</a></li>
                    <!-- <li><a href="#right-icon-tab3" data-toggle="tab">Media New</a></li> -->
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Media &nbsp; &nbsp; <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                        <div class="dropdown-content-heading"> Filter
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-more"></i></a> </li>
                            </ul>
                        </div>
                        <div class="">
                            <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings active">
                                        <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Total Reviews
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                </div>

                                            </div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Positive
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                </div>

                                            </div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary">
                                                            Neutral
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Negative
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-content-footer">
                            <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                            &nbsp; &nbsp;
                            <a style="display: inline-block;" href="#">Clear All</a>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn dark_btn dropdown-toggle ml10" data-toggle="modal" data-target="#addContact"><i class="icon-plus3"></i><span> &nbsp;  Add Media</span> </button>
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->



    <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
    <div class="tab-content">
        <!--===========TAB 1===========-->
        <div class="tab-pane active" id="right-icon-tab0">
            <div class="row">
                <div class="col-md-12">
                    <div style="margin: 0;" class="panel panel-flat">
                        <div class="panel-heading">
                            <span class="pull-left">
                                <h6 class="panel-title">Images & Video</h6>
                            </span>


                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" tableid="brandboostOnsiteMedia" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                                </div>
                                &nbsp; &nbsp;

                                <div class="table_action_tool">
                                    <a href="javascript:void(0);"><i class="icon-calendar52"></i></a>
                                    <a href="javascript:void(0);" class="editDataList"><i class="icon-pencil"></i></a>
                                    <a href="javascript:void(0);" style="display: none;" id="deleteContactsBtn" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body p0">

                            <table class="table" id="brandboostOnsiteMedia">
                                <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                        <th><i class="icon-image2"></i>Media</th>
                                        <th><i class="icon-star-full2"></i>Campaign</th>
                                        <th><i class="icon-user"></i>Contact</th>
                                        <!-- <th><i class="icon-iphone"></i>Phone</th> -->
                                        <th><i class="icon-calendar"></i>Created</th>
                                        <th><i class="icon-file-empty2"></i>File</th>
                                        <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $allMediaImagesShow = array();
                                    //$aReviews = '';
                                    if (!empty($aReviews)) {
                                        $incDel = 1;
                                        foreach ($aReviews as $review) {
                                            $mediaUrl = @(unserialize($review->media_url));
                                            if (!empty($mediaUrl)) {
                                                foreach ($mediaUrl as $value) {
                                                    if (in_array($value['media_url'], $allMediaImagesShow)) {

                                                    } else {
                                                        $allMediaImagesShow[] = $value['media_url'];

                                                        $smilyImage = smilyRating($review->ratings);

                                                        $filePath = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $value['media_url'];

                                                        $fileExt = pathinfo($value['media_url'], PATHINFO_EXTENSION);

                                                        if ($fileExt == 'mp4') {
                                                            $extFileImage = base_url('assets/images/mp4.png');
                                                        } else if ($fileExt == 'png') {
                                                            $extFileImage = base_url('assets/images/png.png');
                                                        } else if ($fileExt == 'jpg' || $fileExt == 'jpeg') {
                                                            $extFileImage = base_url('assets/images/jpg.png');
                                                        } else {
                                                            $extFileImage = base_url('assets/images/file_blank.png');
                                                        }

                                                        //$getFileSize = getRemoteFileSize($filePath);
                                                        $getFileSize = '512KB';
                                                        @endphp
                                                        <tr id="append-{{ $review->id . $incDel }}" class="selectedClass">
                                                            <td style="display: none;">{{ date('m/d/Y', strtotime($review->created)) }}</td>
                                                            <td style="display: none;">{{ $review->id }}</td>
                                                            <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="{{ $review->id }}" id="chk{{ $review->id }}"  mediaName="{{ $value['media_url'] }}" delattr="{{ $incDel }}"><span class="custmo_checkmark"></span></label></td>
                                                            <td>
                                                                @php
                                                                $imageUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $value['media_url'];

                                                                if ($value['media_type'] == 'image') {
                                                                    @endphp

                                                                    <div class="small_media_icon" style="position: relative; width: 60px;">
                                                                        <img class="media br5" src="{{ $imageUrl }}" alt="">
                                                                        <div class="caption-overflow smallovfl">
                                                                            <a href="{{ $imageUrl }}" data-popup="lightbox"><i class="icon-eye"></i></a>
                                                                        </div>
                                                                    </div>

                                                                    @php
                                                                } else {
                                                                    @endphp

                                                                    <div class="small_media_icon" style="position: relative; width: 60px;">
                                                                        <video class="media br5" width="100%">
                                                                            <source src="{{ $filePath }}" type="video/{{ $fileExt }}">
                                                                        </video>

                                                                        <div class="caption-overflow smallovfl">
                                                                            <a class="videoReview" style="cursor: pointer;" filepath="{{ $imageUrl }}" fileext="{{ $fileExt }}"><i class="icon-eye"></i></a>
                                                                        </div>
                                                                    </div>

                                                                    @php
                                                                }
                                                                @endphp
                                                            </td>
                                                            <td>
                                                                <div class="media-left media-middle"> <a class="icons" href="{{ base_url('admin/brandboost/onsite_setup/' . $review->campaign_id . '?type=media') }}"><img src="{{ $smilyImage }}" class="img-circle img-xs" alt=""></a> </div>
                                                                <div class="media-left">
                                                                    <div class="pt-5"><a href="{{ base_url('admin/brandboost/onsite_setup/' . $review->campaign_id . '?type=media') }}" class="text-default text-semibold editBrandboost"><span>{{ $review->brand_title }}</span></a> </div>
                                                                    <div class="text-muted text-size-small"><a href="{{ base_url('admin/brandboost/onsite_setup/' . $review->campaign_id . '?type=media') }}" style="color:#7a8dae!important"  >{{ setStringLimit($review->brand_desc) }}</a></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="media-left media-middle"> <a style="cursor: text;">{!! showUserAvtar($review->avatar, $review->firstname, $review->lastname) !!}</a> </div>
                                                                <div class="media-left">
                                                                    <div class="pt-5"><a style="cursor: text;" class="text-default text-semibold bbot">{{ $review->firstname }} {{ $review->lastname }}</a>
                                                                        <img class="flags" src="{{ base_url() }}assets/images/flags/{{ strtolower($review->country) }}.png" onerror="this.src='{{ base_url('assets/images/flags/us.png') }}'"/></div>
                                                                    <div class="text-muted text-size-small">{{ $review->email }}</div>

                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="media-left">
                                                                    <div class="pt-5"><a href="#" class="text-default text-semibold">{{ dataFormat($review->created) }}</a></div>
                                                                    <div class="text-muted text-size-small">{{ date('h:i A', strtotime($review->created)) }}</div>
                                                                </div>
                                                            </td>
                                                            <td><div class="media-left media-middle"> <a class="icons" href="javascript:void(0);"><img src="{{ $extFileImage }}" class="img-xs file" alt=""></a> </div>
                                                                <div class="media-left">
                                                                    <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold">{{ $getFileSize }}</a> </div>
                                                                    <div class="text-muted text-size-small">{{ strtoupper($fileExt) }}</div>
                                                                </div>
                                                            </td>

                                                            <td class="text-center">
                                                                <div class="tdropdown">
                                                                    <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ base_url() }}assets/images/more.svg"></a>
                                                                    <ul class="dropdown-menu dropdown-menu-right more_act">
                                                                        <li><a href="{{ $filePath }}" data-popup="lightbox"><i class="icon-eye txt_purple"></i> View</a></li>
                                                                        <li><a href="{{ $filePath }}"><i class="icon-download4 txt_red"></i> Download</a></li>
                                                                        <!-- <li><a href="javascript:void(0);"><i class="icon-redo2 txt_blue"></i> Share</a></li> -->
                                                                        <li><a href="javascript:void(0);" class="deleteSingleVideo" reviewId="{{ $review->id }}"  mediaName="{{ $value['media_url'] }}"><i class="icon-bin txt_grey"></i> Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        @php
                                                    }
                                                    $incDel++;
                                                }
                                            }
                                        }
                                    }
                                    @endphp
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===========TAB 2===========-->
        <div class="tab-pane" id="right-icon-tab1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading"> <span class="pull-left">
                                <h6 class="panel-title">Images</h6>
                            </span>

                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                                </div>
                                <!-- &nbsp; &nbsp;
                                <button type="button" class="btn btn-xs btn-default"><i class="icon-pencil position-left"></i> Edit</button> -->
                            </div>
                        </div>

                        <div class="panel-body gallerytabtable p0">
                            <table class="table datatable-basic-new gallerytable" id="onsiteMediaGallery">
                                <thead >
                                    <tr style="display: none;">
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th><i class="icon-image2"></i>Media</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    $allMediaImagesShow = array();
                                    if (!empty($aReviews)) {
                                        $incDel = 1;
                                        $incMediaImg = 1;
                                        foreach ($aReviews as $review) {
                                            //pre($value->media_url);
                                            $mediaUrl = @(unserialize($review->media_url));
                                            if (!empty($mediaUrl)) {
                                                //pre($mediaUrl);
                                                foreach ($mediaUrl as $value) {


                                                    //pre($review);
                                                    $filePath = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $value['media_url'];

                                                    if ($value['media_type'] == 'image') {

                                                        $mediaImageUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $value['media_url'];
                                                    } else {
                                                        $mediaImageUrl = base_url('assets/images/media1.jpg');
                                                    }

                                                    if (in_array($value['media_url'], $allMediaImagesShow)) {

                                                    } else {
                                                        $allMediaImagesShow[] = $value['media_url'];

                                                        if ($value['media_type'] == 'image') {
                                                            @endphp
                                                            <tr style="width: 24.5%; display: inline-block;">
                                                                <td style="display: none;"></td>
                                                                <td style="display: none;"></td>
                                                                <td>
                                                                    <div class="imagetab">
                                                                        <div class="row">

                                                                            <div class="col-lg-12 col-sm-12">
                                                                                <div class="thumbnail">
                                                                                    <div class="thumb">
                                                                                        <img src="{{ $mediaImageUrl }}" alt="Images">

                                                                                        <div class="caption-overflow">
                                                                                            <span>
                                                                                                <a href="{{ $mediaImageUrl }}" data-popup="lightbox" class="btn white_btn"><i class="icon-eye txt_purple"></i></a>
                                                                                                <a href="{{ $filePath }}" class="btn white_btn ml-5"><i class="icon-download4 txt_red"></i></a>
                                                                                                <a href="javascript:void()" class="btn white_btn ml-5"><i class="icon-redo2 txt_blue"></i></a>
                                                                                                <a style='cursor: pointer;' class="btn white_btn ml-5 deleteSingleVideo"  reviewId="{{ $review->id }}"  mediaName="{{ $value['media_url'] }}"><i class="icon-bin txt_grey"></i></a>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="caption">
                                                                                        <p>{{ $review->brand_title }}</p>
                                                                                        <p style="word-break: break-all;"></p>
                                                                                        <p class="text-size-small text-muted">{{ date('g:iA d M Y', strtotime($review->created)) }}</p>
                                                                                    </div>
                                                                                    <div class="caption bot">
                                                                                        <div class="media_details">
                                                                                            <p><strong class="text-size-small">Review </strong> <span><i class="icon-primitive-dot txt_green"></i> {{ $review->ratings }}</span></p>
                                                                                            <p><strong class="text-size-small">Contact </strong> <span>{{ $review->firstname . ' ' . $review->lastname }}</span></p>
                                                                                            <p><strong class="text-size-small">Email </strong> <span>{{ $review->email }}</span></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                            </tr>@php
                                                            $incMediaImg++;
                                                        }
                                                    }
                                                    $incDel++;
                                                }
                                            }
                                        }
                                    }
                                    if ($incMediaImg > 1) {

                                    } else {
                                        @endphp
                                        <tr>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td>
                                                <div class="imagetab">
                                                    <div class="row">
                                                        <div class="text-center"> Image not found.</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>@php
                                    }
                                    @endphp

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--===========TAB 3===========-->
        <div class="tab-pane" id="right-icon-tab2">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading"> <span class="pull-left">
                                <h6 class="panel-title">Videos</h6>
                            </span>

                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                                </div>
                                <!-- &nbsp; &nbsp;
                                <button type="button" class="btn btn-xs btn-default"><i class="icon-pencil position-left"></i> Edit</button> -->
                            </div>
                        </div>

                        <div class="panel-body gallerytabtable p0">
                            <table class="table datatable-basic-new gallerytable" id="onsiteMediaVideoGallery">
                                <thead >
                                    <tr style="display: none;">
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th><i class="icon-image2"></i>Media</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    $allMediaImagesShow = array();
                                    if (!empty($aReviews)) {
                                        $incDel = 1;
                                        $incmediaVideo = 1;
                                        foreach ($aReviews as $review) {
                                            //pre($value->media_url);
                                            $mediaUrl = @(unserialize($review->media_url));
                                            if (!empty($mediaUrl)) {
                                                //pre($mediaUrl);
                                                foreach ($mediaUrl as $value) {
                                                    //pre($review);
                                                    $filePath = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $value['media_url'];

                                                    if ($value['media_type'] == 'image') {

                                                        //$mediaUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$value['media_url'];
                                                    } else {
                                                        $videoImgArr = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20);
                                                        $rand = rand(0, 19);
                                                        $mediaUrl = base_url('assets/images/flat/' . $videoImgArr[$rand] . '.png');
                                                    }

                                                    if (in_array($value['media_url'], $allMediaImagesShow)) {

                                                    } else {
                                                        $allMediaImagesShow[] = $value['media_url'];


                                                        if ($value['media_type'] != 'image') {
                                                            $fileExt = pathinfo($value['media_url'], PATHINFO_EXTENSION);
                                                            @endphp

                                                            <tr style="width: 24.5%; display: inline-block;">
                                                                <td style="display: none;"></td>
                                                                <td style="display: none;"></td>
                                                                <td>
                                                                    <div class="imagetab">
                                                                        <div class="row">

                                                                            <div class="col-lg-12 col-sm-12">
                                                                                <div class="thumbnail">
                                                                                    <div class="thumb">
                                                                                        <video height="220px" width="100%">
                                                                                            <source src="{{ $filePath }}" type="video/{{ $fileExt }}">
                                                                                        </video>

                                                                                        <span class="video_icon">
                                                                                            <a href="{{ $filePath }}" data-popup="lightbox" class="btn white_btn fancybox fancybox.iframe"><i class="icon-menu txt_purple"></i></a>
                                                                                        </span>
                                                                                        <span class="video_icon_bot">
                                                                                            <a href="{{ $filePath }}" data-popup="lightbox" class="btn player_btn fancybox fancybox.iframe"><i class="icon-play4 txt_white"></i></a>
                                                                                        </span>
                                                                                        <div class="caption-overflow">
                                                                                            <span>
                                                                                                <a class="videoReview btn white_btn" style="cursor: pointer;" filepath="{{ $filePath }}" fileext="{{ $fileExt }}"><i class="icon-eye txt_purple"></i></a>
                                                                                                <a href="{{ $filePath }}" class="btn white_btn ml-5"><i class="icon-download4 txt_red"></i></a>
                                                                                                <a href="#" class="btn white_btn ml-5"><i class="icon-redo2 txt_blue"></i></a>
                                                                                                <a style='cursor: pointer;' class="btn white_btn ml-5 deleteSingleVideo"  reviewId="{{ $review->id }}"  mediaName="{{ $value['media_url'] }}"><i class="icon-bin txt_grey"></i></a>
                                                                                            </span>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="caption">
                                                                                        <p>{{ $review->brand_title }}</p>
                                                                                        <p style="word-break: break-all;"></p>
                                                                                        <p class="text-size-small text-muted">{{ date('g:iA d M Y', strtotime($review->created)) }}</p>
                                                                                    </div>
                                                                                    <div class="caption bot">
                                                                                        <div class="media_details">
                                                                                            <p><strong class="text-size-small">Review </strong> <span><i class="icon-primitive-dot txt_green"></i> {{ $review->ratings }}</span></p>
                                                                                            <p><strong class="text-size-small">Contact </strong> <span>{{ $review->firstname . ' ' . $review->lastname }}</span></p>
                                                                                            <p><strong class="text-size-small">Email </strong> <span>{{ $review->email }}</span></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            @php
                                                            if ($incmediaVideo % 4 == 0) {

                                                            }
                                                            $incmediaVideo++;
                                                        }
                                                    }
                                                    $incDel++;
                                                }
                                            }
                                        }
                                    }

                                    if ($incmediaVideo > 1) {

                                    } else {
                                        @endphp<tr>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td>
                                                <div class="imagetab">
                                                    <div class="row">
                                                        <div class="text-center"> Video not found.</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>@php }
                                    @endphp


                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>
            </div>
        </div>
        <!--===========TAB 4===========-->
        <!-- <div class="tab-pane" id="right-icon-tab3">
              Media New Goes here...
        </div> -->



    </div>
    <!--================================= CONTENT AFTER TAB===============================-->



</div>


<div id="videoReviewShowModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Video review</h5>
            </div>
            <div class="modal-body" id="vReviewShow">
                <video width="100%" controls>
                    <source src="" type="">
                </video>
            </div>
        </div>
    </div>
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




    $('[data-popup="lightbox"]').fancybox({
        padding: 3
    });

    $(document).on('click', '.editDataList', function () {
        $('.editAction').toggle();
    });

    // new
    $(document).on('change', '#checkAll', function () {
        if (false == $(this).prop("checked")) {
            $(".checkRows").prop('checked', false);
            $(".selectedClass").removeClass('success');
            $('.custom_action_box').hide();
        } else {
            $(".checkRows").prop('checked', true);
            $(".selectedClass").addClass('success');
            $('.custom_action_box').show();
        }
    });

    // new
    $(document).on('click', '.checkRows', function () {
        var inc = 0;
        var rowId = $(this).val();
        var delattr = $(this).attr('delattr');

        if (false == $(this).prop("checked")) {
            //$('#append-' + rowId).removeClass('success');
            $('#append-' + rowId + delattr).removeClass('success');
        } else {
            //$('#append-' + rowId).addClass('success');
            $('#append-' + rowId + delattr).addClass('success');
        }

        $('.checkRows:checkbox:checked').each(function (i) {
            inc++;
        });

        if (inc == 0) {
            $('.custom_action_box').hide();
        } else {
            $('.custom_action_box').show();
        }

        var numberOfChecked = $('.checkRows:checkbox:checked').length;
        var totalCheckboxes = $('.checkRows:checkbox').length;
        if (totalCheckboxes > numberOfChecked) {
            $('#checkAll').prop('checked', false);
        }

        if (totalCheckboxes == numberOfChecked) {
            $('#checkAll').prop('checked', true);
        }
    });

    // New
    $(document).on('click', '#deleteContactsBtn', function () {

        var val = [];
        var mediaName = [];
        $('.checkRows:checkbox:checked').each(function (i) {
            val[i] = $(this).val();
            mediaName[i] = $(this).attr('mediaName');
        });
        //console.log(mediaName, val);
        if (val.length === 0) {
            alert('Please select a row.')
        } else {

            deleteConfirmationPopup(
                    "This media will deleted immediately.<br>You can't undo this action.",
                    function () {

                        $('.overlaynew').show();
                        $.ajax({
                            url: "/reviews/deleteReviewMultipal",
                            type: "POST",
                            data: {reviewid: val, mediaName: mediaName, _token: '{{csrf_token()}}'},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    location.reload();
                                } else {
                                    alert("Having some error.");
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    });

        }
    });



    $(document).on('click', '.deleteSingleVideo', function () {

        var val = [];
        var mediaName = [];

        val[0] = $(this).attr('reviewId');
        mediaName[0] = $(this).attr('mediaName');
        //console.log(mediaName, val);
        if (val.length === 0) {
            alert('Please select a row.')
        } else {

            deleteConfirmationPopup(
                    "This media will deleted immediately.<br>You can't undo this action.",
                    function () {

                        $('.overlaynew').show();
                        $.ajax({
                            url: "/reviews/deleteReviewMultipal",
                            type: "POST",
                            data: {reviewid: val, mediaName: mediaName, _token: '{{csrf_token()}}'},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    location.reload();
                                } else {
                                    alert("Having some error.");
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    });
        }
    });

    $(document).ready(function () {

        $(document).on('click', '.videoReview', function () {
            var filepath = $(this).attr('filepath');
            var fileext = $(this).attr('fileext');
            $('#vReviewShow video source').attr('src', filepath);
            $('#vReviewShow video source').attr('type', 'video/' + fileext);
            $("#vReviewShow video")[0].load();
            $('#videoReviewShowModal').modal();
        });
    });



    $(document).ready(function () {
        // Setup - add a text input to each footer cell


        // Basic datatable
        var tableBase = $('#onsiteMediaGallery')
                .on('order.dt', function () {
                    eventFired();
                })
                .on('search.dt', function () {
                    eventFired();
                })
                .on('page.dt', function () {
                    eventFired();
                })
                .DataTable({
                    'order': [1, "desc"],
                    'aoColumnDefs': [
                        {
                            'bSortable': false,
                            'aTargets': ['nosort']
                        }

                    ],
                    "dom": '<"top"f>rt<"datatable-footer"pil><"clear">',
                    "language": {
                        "info": '<span><span class="text-muted ml10">Showing results</span><span class="txt_black ml10"> _START_ - _END_ of _TOTAL_</span></span>',
                        "lengthMenu": 'View <a style="cursor: pointer;" id="_8" >8</a><a style="cursor: pointer;" id="_12" >12</a><a style="cursor: pointer;" id="_16" >16</a><a style="cursor: pointer;" id="_20" >20</a><a style="cursor: pointer;" id="all" >All</a>'
                    },
                    "orderCellsTop": true,
                    "fixedHeader": true

                });

        tableBase.page.len(8).draw();


        $('#_8').addClass('current');

        $(document).on('click', '#all', function () {

            $('#all').removeClass('current');
            $('#_8').removeClass('current');
            $('#_12').removeClass('current');
            $('#_16').removeClass('current');
            $('#_20').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(-1).draw();
        });

        $(document).on('click', '#_8', function () {

            $('#all').removeClass('current');
            $('#_8').removeClass('current');
            $('#_12').removeClass('current');
            $('#_16').removeClass('current');
            $('#_20').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(8).draw();
        });

        $(document).on('click', '#_12', function () {

            $('#all').removeClass('current');
            $('#_8').removeClass('current');
            $('#_12').removeClass('current');
            $('#_16').removeClass('current');
            $('#_20').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(12).draw();
        });

        $(document).on('click', '#_16', function () {

            $('#all').removeClass('current');
            $('#_8').removeClass('current');
            $('#_12').removeClass('current');
            $('#_16').removeClass('current');
            $('#_20').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(16).draw();
        });

        $(document).on('click', '#_20', function () {

            $('#all').removeClass('current');
            $('#_8').removeClass('current');
            $('#_12').removeClass('current');
            $('#_16').removeClass('current');
            $('#_20').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(20).draw();
        });


    });


    $(document).ready(function () {
        // Setup - add a text input to each footer cell


        // Basic datatable
        var tableBaseVideo = $('#onsiteMediaVideoGallery')
                .on('order.dt', function () {
                    eventFired();
                })
                .on('search.dt', function () {
                    eventFired();
                })
                .on('page.dt', function () {
                    eventFired();
                })
                .DataTable({
                    'order': [1, "desc"],
                    'aoColumnDefs': [
                        {
                            'bSortable': false,
                            'aTargets': ['nosort']
                        }

                    ],
                    "dom": '<"top"f>rt<"datatable-footer"pil><"clear">',
                    "language": {
                        "info": '<span><span class="text-muted ml10">Showing results</span><span class="txt_black ml10"> _START_ - _END_ of _TOTAL_</span></span>',
                        "lengthMenu": 'View <a style="cursor: pointer;" id="_8v" >8</a><a style="cursor: pointer;" id="_12v" >12</a><a style="cursor: pointer;" id="_16v" >16</a><a style="cursor: pointer;" id="_20v" >20</a><a style="cursor: pointer;" id="allv" >All</a>'
                    },
                    "orderCellsTop": true,
                    "fixedHeader": true

                });

        tableBaseVideo.page.len(8).draw();


        $('#_8v').addClass('current');

        $(document).on('click', '#allv', function () {

            $('#allv').removeClass('current');
            $('#_8v').removeClass('current');
            $('#_12v').removeClass('current');
            $('#_16v').removeClass('current');
            $('#_20v').removeClass('current');

            $(this).addClass('current');
            tableBaseVideo.page.len(-1).draw();
        });

        $(document).on('click', '#_8v', function () {

            $('#allv').removeClass('current');
            $('#_8v').removeClass('current');
            $('#_12v').removeClass('current');
            $('#_16v').removeClass('current');
            $('#_20v').removeClass('current');

            $(this).addClass('current');
            tableBaseVideo.page.len(8).draw();
        });

        $(document).on('click', '#_12v', function () {

            $('#allv').removeClass('current');
            $('#_8v').removeClass('current');
            $('#_12v').removeClass('current');
            $('#_16v').removeClass('current');
            $('#_20v').removeClass('current');

            $(this).addClass('current');
            tableBaseVideo.page.len(12).draw();
        });

        $(document).on('click', '#_16v', function () {

            $('#allv').removeClass('current');
            $('#_8v').removeClass('current');
            $('#_12v').removeClass('current');
            $('#_16v').removeClass('current');
            $('#_20v').removeClass('current');

            $(this).addClass('current');
            tableBaseVideo.page.len(16).draw();
        });

        $(document).on('click', '#_20v', function () {

            $('#allv').removeClass('current');
            $('#_8v').removeClass('current');
            $('#_12v').removeClass('current');
            $('#_16v').removeClass('current');
            $('#_20v').removeClass('current');

            $(this).addClass('current');
            tableBaseVideo.page.len(20).draw();
        });


    });


    var tableIdM = 'brandboostOnsiteMedia';
    var tableBaseM = custom_data_table(tableIdM);
</script>
@endsection

