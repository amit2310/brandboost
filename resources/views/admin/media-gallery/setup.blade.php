@extends('layouts.main_template')

@section('title')
    {{ $title }}
@endsection

@section('contents')
    <link href="{{ base_url() }}assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet"/>
    <script src="{{ base_url() }}assets/dropzone-master/dist/dropzone.js"></script>
    <script type="text/javascript" src="{{ base_url() }}assets/js/plugins/pickers/color/spectrum.js"></script>
    <script type="text/javascript" src="{{ base_url() }}assets/js/pages/picker_color.js"></script>
    <script type="text/javascript" src="{{ base_url() }}assets/js/plugins/forms/inputs/touchspin.min.js"></script>
    <script type="text/javascript" src="{{ base_url() }}admin_new/assets/js/plugins/media/cropper.min.js"></script>


    <style>
        .panel-heading .nav-tabs > li.active > a, .panel-heading .nav-tabs > li.active > a:hover, .panel-heading .nav-tabs > li.active > a:focus {
            color: #962e6c !important;
        }

        .media_sec p {
            font-size: 14px;
        }

        .gallery_slider_widget {
            width: 950px;
            margin: 0px auto;
            font-family: 'Inter UI';
            font-style: normal;
            font-weight: 400;
            position: absolute;
            bottom: 35px;
            box-sizing: border-box;
            left: 50%;
            transform: translate(-50%, 0)
        }

        .gallery_slider_widget h2 {
            font-family: InterUI;
            font-size: 15px;
            font-weight: 500;
            line-height: 0.67;
            font-family: 'Inter UI';
            margin-bottom: 20px;
            margin-left: 6px;
        }

        .gallery_slider_widget h2 span {
            margin-left: 15px;
            color: #5e5e7c;
            font-weight: normal;
        }

        .gallery_slider_widget .top_header {
            width: 100%;
        }

        .gallery_slider_widget .arrow {
            position: relative;
            top: 102px;
            right: 0;
            left: 0;
            width: 100%;
            z-index: 9;
        }

        .gallery_slider_widget .middle .box_1 {
            max-width: 235px;
            width: 100%;
            float: left;
            padding: 5px;
            box-sizing: border-box;
            border-radius: 0px;
            background: #ffffff;
            margin: 0 1px;
            max-height: 235px;
            position: relative;
        }

        .img_overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            text-align: center;
            line-height: 100%;
            top: 0px;
            left: 0px;
            background: rgba(0, 0, 0, 0.5);
            color: #FFF;
            font-size: 15px;
            padding-top: 48%;
            box-sizing: border-box;
            display: none;
            cursor: pointer;
            font-weight: 500;
        }

        .gallery_slider_widget .middle .box_1:hover .img_overlay {
            display: block;
        }

        .gallery_slider_widget .middle .box_1 img {
            width: 100%;
        }

        .gallery_slider_widget .arrow .left_arrow {
            background: #fff;
            width: 42px;
            height: 42px;
            border-radius: 100%;
            display: inline-block;
            box-shadow: 0 2px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);
            line-height: 42px;
            position: absolute;
            left: -15px;
            text-align: center;
        }

        .gallery_slider_widget .arrow .right_arrow {
            background: #fff;
            width: 42px;
            height: 42px;
            border-radius: 100%;
            display: inline-block;
            box-shadow: 0 2px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);
            line-height: 42px;
            position: absolute;
            right: -15px;
            text-align: center;
        }

        .gallery_slider_widget .footer_div {
            margin-top: 20px;
            display: inline-block;
            width: 100%;
            box-sizing: border-box;
        }

        .gallery_slider_widget .footer_div .left {
            float: left;
        }

        .gallery_slider_widget .footer_div .left img {
            float: left;
            margin: 4px 4px 0;
        }

        .gallery_slider_widget .footer_div .left p {
            float: left;
            font-size: 14px;
            font-weight: bold;
            color: #1e1e40;
            margin: 0 10px 0 10px;
            padding: 0;
        }

        .gallery_slider_widget .footer_div .left span {
            float: left;
            font-weight: normal;
            color: #525378;
        }

        .gallery_slider_widget .footer_div .right {
            float: right;
            margin-right: 6px;
            color: #8787a5;
        }

        .gallery_slider_widget .footer_div .right img {
            float: left;
            margin-right: 5px;
            margin-top: 3px;
        }

        @media only screen and (max-width: 1550px) {
            .gallery_slider_widget {
                max-width: 695px;
                left: 50%;
                margin-left: -350px
            }

            .box_1.hide_under_1500 {
                display: none;
            }
        }

        .imgpopup.modal .close:hover, .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .imgpopup.modal .box_inner {
            display: inline-block;
            width: 100%;
        }

        .imgpopup.modal .left_box {
            width: 50%;
            box-sizing: border-box;
            float: left;
            padding-right: 40px;
        }

        .imgpopup.modal .left_box img {
            width: 100%;
            border-radius: 5px;
        }

        .imgpopup.modal .right_box {
            width: 50%;
            box-sizing: border-box;
            float: right;
            padding-right: 0px;
        }

        .imgpopup.modal .box_2 {
            width: 100%;
            float: left;
            padding: 5px 0px 18px 0px; /*border-bottom: 1px solid #e7edf8;*/
            box-sizing: border-box;
        }

        .imgpopup.modal .box_2 .top_div {
            padding: 17px 0;
            border-bottom: 1px solid #e7edf8;
            border-top: 1px solid #e7edf8;
        }

        .imgpopup.modal .box_2 .top_div .left {
            position: relative;
            width: 45px;
            display: inline-block;
            margin-right: 12px;
            float: left;
            margin-top: 5px;
        }

        .imgpopup.modal .box_2 .top_div .left a.icons {
            width: 40px !important;
            height: 40px !important;
        }

        .imgpopup.modal .box_2 .top_div .left .img-xs {
            width: 40px !important;
            height: 40px !important;
        }

        .imgpopup.modal .box_2 .top_div .left .circle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #69d641;
            border-radius: 100%;
            right: 0;
            border: 2px solid #fff;
            top: 4px;
            right: 2px;
        }

        .imgpopup.modal .box_2 .top_div .right {
            display: inline-block;
            padding-right: 35px;
        }

        .imgpopup.modal .box_2 .bottom_div {
            padding: 0;
            margin: 15px 0
        }

        .imgpopup.modal .heading_pop {
            font-size: 18px;
            font-weight: 500;
            color: #0c0c2c;
            margin-top: 0px;
        }

        .imgpopup.modal .heading_pop2 {
            font-size: 12px;
            color: #525378;
            line-height: 1.67;
            font-weight: normal;
        }

        .imgpopup.modal .box_2 .top_div .right .client_review span {
            color: #526b9b;
            font-size: 12px;
            margin-left: 10px;
        }

        .imgpopup.modal .box_2 .top_div .right p {
            color: #364d79;
            font-size: 14px;
            font-weight: 500;
            margin: 0 0 2px 0;
            padding: 0;
        }

        .imgpopup.modal .box_2 .top_div .right .client_review span {
            color: #526b9b;
            font-size: 12px;
            margin-left: 10px;
        }

        .imgpopup.modal .footer_div2 .comment_div p {
            color: #768fbf;
            font-size: 12px !important;
            font-weight: 500;
        }

        .imgpopup.modal .footer_div2 {
            padding: 0px;
            box-sizing: border-box;
        }

        .imgpopup.modal .footer_div2 .comment_div {
            display: inline-block;
        }

        .imgpopup.modal .footer_div2 .liked_icon {
            display: inline-block;
            position: relative;
            top: 3px;
        }

        .imgpopup.modal .footer_div2 .comment_div p img {
            margin-right: 10px;
            float: left;
            margin-top: 2px;
        }

        .imgpopup.modal .footer_div2 .comment_div p span {
            margin-left: 14px;
            padding-left: 14px;
            border-left: 1px solid;
            margin-right: 14px;
        }

        .imgpopup.modal .footer_div2 .liked_icon img {
            background: #fff;
            padding: 4px;
            box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);
            border-radius: 5px;
        }

        .imgpopup.modal .box_2 .bottom_div p {
            color: #22375e;
            font-size: 14px;
            font-weight: 500;
            line-height: 1.69;
            margin-bottom: 10px;
        }

        .imgpopup.modal .arrow {
            top: 170px;
        }

        .imgpopup.modal .arrow .left_arrow {
            left: -30px;
        }

        .imgpopup.modal .arrow .right_arrow {
            right: -32px;
        }

        .dropzone .dz-default.dz-message:before {
            content: '' !important;
        }

        .dropzone {
            min-height: 83px !important;
            height: 83px !important;
            opacity: 0 !important;
        }

        .dropzone .dz-default.dz-message {
            top: 0% !important;
            height: 40px;
            margin-top: 0px;
        }

        .dropzone .dz-default.dz-message span {
            font-size: 13px;
            margin-top: -10px;
        }


        .review_section_user .top_div {
            padding: 7px 0 7px 55px;
            border-bottom: 1px solid #e7edf8;
            border-top: 1px solid #e7edf8;
        }

        .review_section_user .top_div .left {
            position: relative;
            width: 35px;
            display: inline-block;
            margin-right: 4px;
            float: left;
            margin-top: 3px;
        }

        .review_section_user .top_div .left a.icons {
            width: 30px !important;
            height: 30px !important;
        }

        .review_section_user .top_div .left .img-xs {
            width: 30px !important;
            height: 30px !important;
        }

        .review_section_user .top_div .left a.icons span.icons.fl_letters {
            width: 30px !important;
            height: 30px !important;
            line-height: 30px;
            font-size: 10px !important;
        }

        .review_section_user .top_div .left .circle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #69d641;
            border-radius: 100%;
            right: 0;
            border: 2px solid #fff;
            top: 4px;
            right: 2px;
        }

        img.review_productimg {
            width: 40px;
            height: 40px;
            border-radius: 5px;
        }

        @media (max-width: 1367px) {
            .review_section_user .top_div .left {
                display: none;
            }

            .media-left.pr-15 {
                padding-right: 5px !important
            }

            .review_section_user .top_div {
                padding: 7px 0 7px 35px;
            }

            .showReviewPopup {
                width: calc(100% - 35px) !important;
            }

            img.review_productimg {
                width: 30px;
                height: 30px;
                border-radius: 5px;
            }

        }

        .review_section_user .top_div .right {
            display: inline-block;
            padding-right: 0px;
            line-height: 15px;
        }

        .review_section_user .top_div .right p {
            color: #364d79;
            font-size: 12px;
            font-weight: 500;
            margin: 0 0 2px 0;
            padding: 0;
        }

        .review_section_user .top_div .right .client_review span {
            color: #526b9b;
            font-size: 10px;
            margin-left: 2px;
        }

        .review_section_user .top_div .right .client_review img {
            width: 9px;
            height: 9px;
        }


    </style>

    @php
        $allowTitle = $galleryData->allow_title;
        $allowArrows = $galleryData->allow_arrow;
        $allowRating = $galleryData->allow_ratings;
        $name = $galleryData->name;
        $description = $galleryData->description;
        $galleryType = $galleryData->gallery_type;
        $imageSize = $galleryData->image_size;
        $gradientColor = $galleryData->gradient_color;
        $borderThickness = $galleryData->border_thickness;
        $galleryDesign = $galleryData->gallery_design_type;
        $galleryId = $galleryData->id;
        $colorOrientation = $galleryData->gradient_orientation == '' ? 'to right top' : $galleryData->gradient_orientation;
    @endphp

    <style type="text/css">
        /*.previewWidgetBox .bbw_white_color{background-image: linear-gradient(
        {{ $colorOrientation }}
        , #ffffff, #ffffff 98%)!important;}
            .previewWidgetBox .bbw_red_color{background-image: linear-gradient(
        {{ $colorOrientation }}
        , #e93474, #541069 98%)!important;}
            .previewWidgetBox .bbw_yellow_color{background-image: linear-gradient(
        {{ $colorOrientation }}
        , #f9d84a, #f9814a)!important;}
            .previewWidgetBox .bbw_orange_color{background-image: linear-gradient(
        {{ $colorOrientation }}
        , #ef9d39, #d92a3f)!important;}
            .previewWidgetBox .bbw_green_color{background-image: linear-gradient(
        {{ $colorOrientation }}
        , #93cf48, #076768)!important;}
            .previewWidgetBox .bbw_blue_color{background-image: linear-gradient(
        {{ $colorOrientation }}
        , #4194f7 3%, #1b1f97 99%)!important;}
            .previewWidgetBox .bbw_purple_color{background-image: linear-gradient(
        {{ $colorOrientation }} , #4d4d7c 1%, #1e1e40)!important;}*/

        .toRightTop .previewWidgetBox .bbw_white_color {
            background-image: linear-gradient(to right top, #ffffff, #ffffff 98%) !important;
        }

        .toRightTop .previewWidgetBox .bbw_red_color {
            background-image: linear-gradient(to right top, #e93474, #541069 98%) !important;
        }

        .toRightTop .previewWidgetBox .bbw_yellow_color {
            background-image: linear-gradient(to right top, #f9d84a, #f9814a) !important;
        }

        .toRightTop .previewWidgetBox .bbw_orange_color {
            background-image: linear-gradient(to right top, #ef9d39, #d92a3f) !important;
        }

        .toRightTop .previewWidgetBox .bbw_green_color {
            background-image: linear-gradient(to right top, #93cf48, #076768) !important;
        }

        .toRightTop .previewWidgetBox .bbw_blue_color {
            background-image: linear-gradient(to right top, #4194f7 3%, #1b1f97 99%) !important;
        }

        .toRightTop .previewWidgetBox .bbw_purple_color {
            background-image: linear-gradient(to right top, #4d4d7c 1%, #1e1e40) !important;
        }

        .toRight .previewWidgetBox .bbw_white_color {
            background-image: linear-gradient(to right, #ffffff, #ffffff 98%) !important;
        }

        .toRight .previewWidgetBox .bbw_red_color {
            background-image: linear-gradient(to right, #e93474, #541069 98%) !important;
        }

        .toRight .previewWidgetBox .bbw_yellow_color {
            background-image: linear-gradient(to right, #f9d84a, #f9814a) !important;
        }

        .toRight .previewWidgetBox .bbw_orange_color {
            background-image: linear-gradient(to right, #ef9d39, #d92a3f) !important;
        }

        .toRight .previewWidgetBox .bbw_green_color {
            background-image: linear-gradient(to right, #93cf48, #076768) !important;
        }

        .toRight .previewWidgetBox .bbw_blue_color {
            background-image: linear-gradient(to right, #4194f7 3%, #1b1f97 99%) !important;
        }

        .toRight .previewWidgetBox .bbw_purple_color {
            background-image: linear-gradient(to right, #4d4d7c 1%, #1e1e40) !important;
        }

        .toRightBottom .previewWidgetBox .bbw_white_color {
            background-image: linear-gradient(to right bottom, #ffffff, #ffffff 98%) !important;
        }

        .toRightBottom .previewWidgetBox .bbw_red_color {
            background-image: linear-gradient(to right bottom, #e93474, #541069 98%) !important;
        }

        .toRightBottom .previewWidgetBox .bbw_yellow_color {
            background-image: linear-gradient(to right bottom, #f9d84a, #f9814a) !important;
        }

        .toRightBottom .previewWidgetBox .bbw_orange_color {
            background-image: linear-gradient(to right bottom, #ef9d39, #d92a3f) !important;
        }

        .toRightBottom .previewWidgetBox .bbw_green_color {
            background-image: linear-gradient(to right bottom, #93cf48, #076768) !important;
        }

        .toRightBottom .previewWidgetBox .bbw_blue_color {
            background-image: linear-gradient(to right bottom, #4194f7 3%, #1b1f97 99%) !important;
        }

        .toRightBottom .previewWidgetBox .bbw_purple_color {
            background-image: linear-gradient(to right bottom, #4d4d7c 1%, #1e1e40) !important;
        }

        .toBottom .previewWidgetBox .bbw_white_color {
            background-image: linear-gradient(to bottom, #ffffff, #ffffff 98%) !important;
        }

        .toBottom .previewWidgetBox .bbw_red_color {
            background-image: linear-gradient(to bottom, #e93474, #541069 98%) !important;
        }

        .toBottom .previewWidgetBox .bbw_yellow_color {
            background-image: linear-gradient(to bottom, #f9d84a, #f9814a) !important;
        }

        .toBottom .previewWidgetBox .bbw_orange_color {
            background-image: linear-gradient(to bottom, #ef9d39, #d92a3f) !important;
        }

        .toBottom .previewWidgetBox .bbw_green_color {
            background-image: linear-gradient(to bottom, #93cf48, #076768) !important;
        }

        .toBottom .previewWidgetBox .bbw_blue_color {
            background-image: linear-gradient(to bottom, #4194f7 3%, #1b1f97 99%) !important;
        }

        .toBottom .previewWidgetBox .bbw_purple_color {
            background-image: linear-gradient(to bottom, #4d4d7c 1%, #1e1e40) !important;
        }

        .toLeftBottom .previewWidgetBox .bbw_white_color {
            background-image: linear-gradient(to left bottom, #ffffff, #ffffff 98%) !important;
        }

        .toLeftBottom .previewWidgetBox .bbw_red_color {
            background-image: linear-gradient(to left bottom, #e93474, #541069 98%) !important;
        }

        .toLeftBottom .previewWidgetBox .bbw_yellow_color {
            background-image: linear-gradient(to left bottom, #f9d84a, #f9814a) !important;
        }

        .toLeftBottom .previewWidgetBox .bbw_orange_color {
            background-image: linear-gradient(to left bottom, #ef9d39, #d92a3f) !important;
        }

        .toLeftBottom .previewWidgetBox .bbw_green_color {
            background-image: linear-gradient(to left bottom, #93cf48, #076768) !important;
        }

        .toLeftBottom .previewWidgetBox .bbw_blue_color {
            background-image: linear-gradient(to left bottom, #4194f7 3%, #1b1f97 99%) !important;
        }

        .toLeftBottom .previewWidgetBox .bbw_purple_color {
            background-image: linear-gradient(to left bottom, #4d4d7c 1%, #1e1e40) !important;
        }

        .toLeft .previewWidgetBox .bbw_white_color {
            background-image: linear-gradient(to left, #ffffff, #ffffff 98%) !important;
        }

        .toLeft .previewWidgetBox .bbw_red_color {
            background-image: linear-gradient(to left, #e93474, #541069 98%) !important;
        }

        .toLeft .previewWidgetBox .bbw_yellow_color {
            background-image: linear-gradient(to left, #f9d84a, #f9814a) !important;
        }

        .toLeft .previewWidgetBox .bbw_orange_color {
            background-image: linear-gradient(to left, #ef9d39, #d92a3f) !important;
        }

        .toLeft .previewWidgetBox .bbw_green_color {
            background-image: linear-gradient(to left, #93cf48, #076768) !important;
        }

        .toLeft .previewWidgetBox .bbw_blue_color {
            background-image: linear-gradient(to left, #4194f7 3%, #1b1f97 99%) !important;
        }

        .toLeft .previewWidgetBox .bbw_purple_color {
            background-image: linear-gradient(to left, #4d4d7c 1%, #1e1e40) !important;
        }

        .toLeftTop .previewWidgetBox .bbw_white_color {
            background-image: linear-gradient(to left top, #ffffff, #ffffff 98%) !important;
        }

        .toLeftTop .previewWidgetBox .bbw_red_color {
            background-image: linear-gradient(to left top, #e93474, #541069 98%) !important;
        }

        .toLeftTop .previewWidgetBox .bbw_yellow_color {
            background-image: linear-gradient(to left top, #f9d84a, #f9814a) !important;
        }

        .toLeftTop .previewWidgetBox .bbw_orange_color {
            background-image: linear-gradient(to left top, #ef9d39, #d92a3f) !important;
        }

        .toLeftTop .previewWidgetBox .bbw_green_color {
            background-image: linear-gradient(to left top, #93cf48, #076768) !important;
        }

        .toLeftTop .previewWidgetBox .bbw_blue_color {
            background-image: linear-gradient(to left top, #4194f7 3%, #1b1f97 99%) !important;
        }

        .toLeftTop .previewWidgetBox .bbw_purple_color {
            background-image: linear-gradient(to left top, #4d4d7c 1%, #1e1e40) !important;
        }

        .toTop .previewWidgetBox .bbw_white_color {
            background-image: linear-gradient(to top, #ffffff, #ffffff 98%) !important;
        }

        .toTop .previewWidgetBox .bbw_red_color {
            background-image: linear-gradient(to top, #e93474, #541069 98%) !important;
        }

        .toTop .previewWidgetBox .bbw_yellow_color {
            background-image: linear-gradient(to top, #f9d84a, #f9814a) !important;
        }

        .toTop .previewWidgetBox .bbw_orange_color {
            background-image: linear-gradient(to top, #ef9d39, #d92a3f) !important;
        }

        .toTop .previewWidgetBox .bbw_green_color {
            background-image: linear-gradient(to top, #93cf48, #076768) !important;
        }

        .toTop .previewWidgetBox .bbw_blue_color {
            background-image: linear-gradient(to top, #4194f7 3%, #1b1f97 99%) !important;
        }

        .toTop .previewWidgetBox .bbw_purple_color {
            background-image: linear-gradient(to top, #4d4d7c 1%, #1e1e40) !important;
        }

        .orientationCircle .previewWidgetBox .bbw_white_color {
            background-image: radial-gradient(circle, #ffffff, #ffffff 98%) !important;
        }

        .orientationCircle .previewWidgetBox .bbw_red_color {
            background-image: radial-gradient(circle, #e93474, #541069 98%) !important;
        }

        .orientationCircle .previewWidgetBox .bbw_yellow_color {
            background-image: radial-gradient(circle, #f9d84a, #f9814a) !important;
        }

        .orientationCircle .previewWidgetBox .bbw_orange_color {
            background-image: radial-gradient(circle, #ef9d39, #d92a3f) !important;
        }

        .orientationCircle .previewWidgetBox .bbw_green_color {
            background-image: radial-gradient(circle, #93cf48, #076768) !important;
        }

        .orientationCircle .previewWidgetBox .bbw_blue_color {
            background-image: radial-gradient(circle, #4194f7 3%, #1b1f97 99%) !important;
        }

        .orientationCircle .previewWidgetBox .bbw_purple_color {
            background-image: radial-gradient(circle, #4d4d7c 1%, #1e1e40) !important;
        }


        .gallery_slider_widget.galleryType2 {
            width: 476px !important;
        }

        .gallery_slider_widget.galleryType3 {
            width: 714px !important;
        }

        .gallery_slider_widget.slides3 {
            width: 708px;
        }

        .gallery_slider_widget.slides4 {
            width: 947px;
        }

        .gallery_slider_widget.slides5 {
            width: 1184px;
        }

        .gallery_slider_widget.slides6 {
            width: 1421px;
        }

        .gallery_slider_widget.slides7 {
            width: 1660px;
        }

        .gallery_slider_widget.galleryType2.imgSizeSmall {
            width: 356px !important;
        }

        .gallery_slider_widget.galleryType3.imgSizeSmall {
            width: 534px !important;
        }

        .gallery_slider_widget.slides3.imgSizeSmall {
            width: 529px;
        }

        .gallery_slider_widget.slides3.imgSizeSmall .middle .box_1 {
            max-width: 175px;
            max-height: 175px;
        }

        .gallery_slider_widget.slides4.imgSizeSmall {
            width: 708px;
        }

        .gallery_slider_widget.slides4.imgSizeSmall .middle .box_1 {
            max-width: 175px;
            max-height: 175px;
        }

        .gallery_slider_widget.slides5.imgSizeSmall {
            width: 884px;
        }

        .gallery_slider_widget.slides5.imgSizeSmall .middle .box_1 {
            max-width: 175px;
            max-height: 175px;
        }

        .gallery_slider_widget.slides6.imgSizeSmall {
            width: 1060px;
        }

        .gallery_slider_widget.slides6.imgSizeSmall .middle .box_1 {
            max-width: 175px;
            max-height: 175px;
        }

        .gallery_slider_widget.slides7.imgSizeSmall {
            width: 1238px;
        }

        .gallery_slider_widget.slides7.imgSizeSmall .middle .box_1 {
            max-width: 175px;
            max-height: 175px;
        }


        .gallery_slider_widget.galleryType2.imgSizeLarge {
            width: 586px !important;
        }

        .gallery_slider_widget.galleryType3.imgSizeLarge {
            width: 887px !important;
        }

        .gallery_slider_widget.slides3.imgSizeLarge {
            width: 874px;
        }

        .gallery_slider_widget.slides3.imgSizeLarge .middle .box_1 {
            max-width: 290px;
            max-height: 290px;
        }

        .gallery_slider_widget.slides4.imgSizeLarge {
            width: 1166px;
        }

        .gallery_slider_widget.slides4.imgSizeLarge .middle .box_1 {
            max-width: 290px;
            max-height: 290px;
        }

        .gallery_slider_widget.slides5.imgSizeLarge {
            width: 1458px;
        }

        .gallery_slider_widget.slides5.imgSizeLarge .middle .box_1 {
            max-width: 290px;
            max-height: 290px;
        }

        .gallery_slider_widget.slides6.imgSizeLarge {
            width: 1750px;
        }

        .gallery_slider_widget.slides6.imgSizeLarge .middle .box_1 {
            max-width: 290px;
            max-height: 290px;
        }

        .gallery_slider_widget.slides7.imgSizeLarge {
            width: 2045px;
        }

        .gallery_slider_widget.slides7.imgSizeLarge .middle .box_1 {
            max-width: 290px;
            max-height: 290px;
        }

        .gallery_slider_widget.imgSizeSmall .arrow {
            top: 68px;
        }

        .gallery_slider_widget.imgSizeLarge .arrow {
            top: 128px;
        }

        .gallery_slider_widget.imgSizeSmall .middle .box_1 img {
            height: 175px;
        }

        .gallery_slider_widget.imgSizeMedium .middle .box_1 img {
            height: 235px;
        }

        .gallery_slider_widget.imgSizeLarge .middle .box_1 img {
            height: 290px;
        }

        .borderBoxShadow {
            box-shadow: 2px 1px 6px 1px #666666 !important;
        }

        span.icons.fl_letters {
            width: 40px;
            height: 40px;
            line-height: 40px;
        }

        .previewWidgetBox .clearfix {
            height: 1px;
        }

        .cropper-container.cropper-bg {
            width: 105% !important;
        }

    </style>
    <div class="content">

        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            @include('admin.components.smart-popup.smart-gallery-widget-type', array('galleryData' => $galleryData))
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-7">
                    <h3><img src="{{ base_url() }}assets/images/gallery_icon.png" style="width: 16px;"> Gallery</h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Configuration</a></li>
                        <li><a href="#right-icon-tab1" data-toggle="tab">Integration</a></li>

                    </ul>
                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-5 text-right btn_area">
                    <button type="button" class="btn dark_btn ml10"><span> &nbsp;  Publish Widget</span></button>
                </div>
            </div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <div class="tab-content">
            <!--===========TAB 1=====Configuration======-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-md-3">
                        <!--=======Design & configuration=====-->
                        <div class="panel panel-flat bkg_white">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs nav-tabs-bottom">
                                    <li class="active"><a href="#Configurations" data-toggle="tab"
                                                          aria-expanded="false">Configurations</a></li>
                                    <li class=""><a href="#Design" data-toggle="tab" aria-expanded="false">Design</a>
                                    </li>
                                    <li class=""><a href="#Reviews" data-toggle="tab" aria-expanded="false">Reviews</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body p0 bkg_white">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="Configurations">
                                        <form method="post" name="frmWidgetConfSubmit" id="frmWidgetConfSubmit"
                                              action="javascript:void(0);" enctype="multipart/form-data">
                                            @csrf
                                            <div class="profile_headings">DESIGN <a class="pull-right plus_icon"
                                                                                    href="#"><i
                                                        class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                            <div class="configurations p20">
                                                <div class="form-group">
                                                    <div class="">
                                                        <label class="control-label">Template</label>
                                                        <button id="galleryDesignType" type="button"
                                                                class="btn h52 form-control w100"
                                                                style="text-align: left; padding: 7px 23px!important;">
                                                            <span>Galley Type</span> <i class="pull-right txt_grey"><img
                                                                    src="{{ base_url() }}assets/images/icon_grid.png"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p20">
                                                <p>Widget type</p>
                                                <select class="form-control h52 autoSaveConfig" name="galleryType"
                                                        id="galleryType">
                                                    <option value="3" {!! $galleryType == 3 ? 'selected' : '' !!}>3
                                                        Images
                                                    </option>
                                                    <option value="4" {!! $galleryType == 4 ? 'selected' : '' !!}>4
                                                        Images
                                                    </option>
                                                    <option value="5" {!! $galleryType == 5 ? 'selected' : '' !!}>5
                                                        Images
                                                    </option>
                                                    <option value="6" {!! $galleryType == 6 ? 'selected' : '' !!}>6
                                                        Images
                                                    </option>
                                                    <option value="7" {!! $galleryType == 7 ? 'selected' : '' !!}>7
                                                        Images
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="p20">
                                                <p>Image Size</p>
                                                <select class="form-control h52 autoSaveConfig" name="imageSize"
                                                        id="imageSize">
                                                    <option
                                                        value="small" {!! $imageSize == 'small' ? 'selected' : '' !!}>
                                                        Small
                                                    </option>
                                                    <option
                                                        value="medium" {!! $imageSize == 'medium' ? 'selected' : '' !!}>
                                                        Medium
                                                    </option>
                                                    <option
                                                        value="large" {!! $imageSize == 'large' ? 'selected' : '' !!}>
                                                        Large
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="profile_headings">COMPONENTS <a class="pull-right plus_icon"
                                                                                        href="#"><i
                                                        class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                            <div class="p20">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mb10">

                                                            <p class="pull-left mb0">Title</p>
                                                            <label class="custom-form-switch pull-right">
                                                                <input class="field checkedBoxValue autoSaveConfig"
                                                                       type="checkbox"
                                                                       value="{{ $allowTitle != '0' ? $allowTitle : '0' }}"
                                                                       {!! $allowTitle != '0' ? 'checked' : '' !!} name="allowTitle"
                                                                       id="allowTitle">
                                                                <span class="toggle dred"></span> </label>
                                                            <div class="clearfix"></div>
                                                        </div>

                                                        <div class="form-group mb10">
                                                            <p class="pull-left mb0">Arrows</p>
                                                            <label class="custom-form-switch pull-right">
                                                                <input class="field checkedBoxValue autoSaveConfig"
                                                                       type="checkbox"
                                                                       value="{{ $allowArrows != '0' ? $allowArrows : '0' }}"
                                                                       {!! $allowArrows != '0' ? 'checked' : '' !!} name="allowArrows"
                                                                       id="allowArrows">
                                                                <span class="toggle dred"></span> </label>
                                                            <div class="clearfix"></div>
                                                        </div>

                                                        <div class="form-group mb10">
                                                            <p class="pull-left mb0">Rating &amp; reviews</p>
                                                            <label class="custom-form-switch pull-right">
                                                                <input class="field checkedBoxValue autoSaveConfig"
                                                                       type="checkbox"
                                                                       value="{{ $allowRating != '0' ? $allowRating : '0' }}"
                                                                       {!! $allowRating != '0' ? 'checked' : '' !!} name="allowRating"
                                                                       id="allowRating">
                                                                <span class="toggle dred"></span> </label>
                                                            <div class="clearfix"></div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="profile_headings">Details <a class="pull-right plus_icon"
                                                                                     href="#"><i
                                                        class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                            <div class="p20">
                                                <div class="form-group">
                                                    <p>Gallery Name</p>
                                                    <input class="form-control h52 autoSaveConfig" type="text"
                                                           value="{{ $name }}" name="galleryName" id="galleryName"
                                                           placeholder="Gallery Name" required/>
                                                </div>
                                                <div class="form-group">
                                                    <p>Gallery Description</p>
                                                    <textarea class="form-control" style="height:150px;"
                                                              name="galleryDescription" id="galleryDescription"
                                                              placeholder="Gallery Description">{{ $description }}</textarea>
                                                </div>
                                            </div>


                                            <div class="p20 btop">
                                                <input type="hidden" value="{{ $galleryId }}" name="editGalleryId"
                                                       id="editGalleryId"/>
                                                <button type="submit"
                                                        class="btn dark_btn bkg_dred w100 h52 saveWidgetConfig">Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="Design">

                                        <form method="post" name="frmWidgetDesignSubmit" id="frmWidgetDesignSubmit"
                                              action="javascript:void(0);" enctype="multipart/form-data">
                                            <div class="p20" style="display:none;">
                                                <div class="barand_avatar mb20">
                                                    <img width="64" class="rounded galleryImage"
                                                         src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $galleryData->gallery_logo }}"
                                                         onerror="this.src='{{ base_url('assets/images/wakerslogo.png') }}'"/>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label txt_upper fsize11 fw500 text-muted">Company
                                                        Avatar</label>
                                                    <label class="display-block">
                                                        <input type="hidden" name="logo_img" id="logo_img"
                                                               class="autoSaveDesign" value="">
                                                        <div class="img_vid_upload_small">
                                                            <div class="dropzone" id="myDropzone_logo_img"></div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="profile_headings">Branding <a class="pull-right plus_icon"
                                                                                      href="#"><i
                                                        class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                            <div class="p20">
                                                <div class="form-group" style="margin:0px 0 20px;">
                                                    <label class="control-label txt_upper fsize11 fw500 text-muted">Border
                                                        Drop-shadow</label>
                                                    <div class="form-group pull-right mb0">
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field autoSaveDesign" type="checkbox"
                                                                   {!! $galleryData->allow_border_shadow == '1' ? 'checked' : '' !!} name="allow_border_shadow"
                                                                   id="allow_border_shadow">
                                                            <span class="toggle dred"></span> </label>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     style="border-bottom: 1px solid #f4f6fa; margin-bottom:0px; padding-bottom:10px;">
                                                    <label class="control-label txt_upper fsize11 fw500 text-muted">Border
                                                        Color</label>
                                                    <div class="form-group pull-right mb0">
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field" type="checkbox"
                                                                   {!! $galleryData->allow_widget_bgcolor == '1' ? 'checked' : '' !!} name="widget_color_allow"
                                                                   id="widget_color_allow">
                                                            <span class="toggle dred"></span> </label>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="p20 allowWidgetBackground" {!! $galleryData->allow_widget_bgcolor == '1' ? '' : 'style="display:none;"' !!}>

                                                <div class="form-group" style="margin:-15px 0 30px;">
                                                    <p>Border Thickness</p>
                                                    <select class="form-control h52 autoSaveDesign"
                                                            name="borderThickness" id="borderThickness">
                                                        <option
                                                            value="1" {!! $borderThickness == 1 ? 'selected' : '' !!}>
                                                            1px
                                                        </option>
                                                        <option
                                                            value="2" {!! $borderThickness == 2 ? 'selected' : '' !!}>
                                                            2px
                                                        </option>
                                                        <option
                                                            value="3" {!! $borderThickness == 3 ? 'selected' : '' !!}>
                                                            3px
                                                        </option>
                                                        <option
                                                            value="4" {!! $borderThickness == 4 ? 'selected' : '' !!}>
                                                            4px
                                                        </option>
                                                        <option
                                                            value="5" {!! $borderThickness == 5 ? 'selected' : '' !!}>
                                                            5px
                                                        </option>
                                                        <option
                                                            value="6" {!! $borderThickness == 6 ? 'selected' : '' !!}>
                                                            6px
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label txt_upper fsize11 fw500 text-muted">Widget
                                                        color</label>
                                                    <div class="form-group pull-right mb0">
                                                        <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">
                                                            Gradient</p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field autoSaveDesign" type="checkbox"
                                                                   {!! $galleryData->bg_color_type == 'on' ? 'checked' : '' !!} name="main_color_switch"
                                                                   id="main_color_switch">
                                                            <span class="toggle dred"></span> </label>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="widgetMultiColorBox" {!! $galleryData->bg_color_type == 'on' ? '' : 'style="display:none;"' !!}>
                                                    <div class="form-group">
                                                        <div class="color_box">
                                                            <input type="hidden" name="main_colors" id="main_colors"
                                                                   value="{{ $galleryData->gradient_color == '' ? 'white' : $galleryData->gradient_color }}">
                                                            <div
                                                                class="color_cube white selectMainColor {{ $galleryData->gradient_color == 'white' ? 'active' : '' }}"
                                                                color-data='white' color-class="bbw_white_color"></div>
                                                            <div
                                                                class="color_cube dred selectMainColor {{ $galleryData->gradient_color == 'red' ? 'active' : '' }}"
                                                                color-data='red' color-class="bbw_red_color"></div>
                                                            <div
                                                                class="color_cube yellow selectMainColor {{ $galleryData->gradient_color == 'yellow' ? 'active' : '' }}"
                                                                color-data='yellow'
                                                                color-class="bbw_yellow_color"></div>
                                                            <div
                                                                class="color_cube red selectMainColor {{ $galleryData->gradient_color == 'orange' ? 'active' : '' }}"
                                                                color-data='orange'
                                                                color-class="bbw_orange_color"></div>
                                                            <div
                                                                class="color_cube green selectMainColor {{ ($galleryData->gradient_color == '' || $galleryData->gradient_color == 'green') ? 'active' : '' }}"
                                                                color-data='green' color-class="bbw_green_color"></div>
                                                            <div
                                                                class="color_cube blue selectMainColor {{ $galleryData->gradient_color == 'blue' ? 'active' : '' }}"
                                                                color-data='blue' color-class="bbw_blue_color"></div>
                                                            <div
                                                                class="color_cube black selectMainColor {{ $galleryData->gradient_color == 'purple' ? 'active' : '' }}"
                                                                color-data='purple'
                                                                color-class="bbw_purple_color"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row orientation_top" style="display:block">
                                                        <div class="col-md-12">
                                                            <div style="margin: 25px 0 15px!important;"
                                                                 class="profile_headings txt_upper fsize11 fw600">Choose
                                                                orientation
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <input type="hidden" value="{{ $colorOrientation }}"
                                                                   id="color_orientation" name="color_orientation">
                                                            <ul class="choose_orientation">
                                                                <li>
                                                                    <a class="gradientOrientation {{ $colorOrientation == 'to right top' ? 'active' : '' }}"
                                                                       color-orientation="to right top"
                                                                       main-orientation-class="toRightTop"
                                                                       href="javascript:void(0);"><i
                                                                            class="fa fa-arrow-right degtop"
                                                                            aria-hidden="true"></i></a></li>
                                                                <li>
                                                                    <a class="gradientOrientation {{ $colorOrientation == 'to right' ? 'active' : '' }}"
                                                                       color-orientation="to right"
                                                                       main-orientation-class="toRight"
                                                                       href="javascript:void(0);"><i
                                                                            class="fa fa-arrow-right"
                                                                            aria-hidden="true"></i></a></li>
                                                                <li>
                                                                    <a class="gradientOrientation {{ $colorOrientation == 'to right bottom' ? 'active' : '' }}"
                                                                       color-orientation="to right bottom"
                                                                       main-orientation-class="toRightBottom"
                                                                       href="javascript:void(0);"><i
                                                                            class="fa fa-arrow-right degbot"
                                                                            aria-hidden="true"></i></a></li>
                                                                <li>
                                                                    <a class="gradientOrientation {{ $colorOrientation == 'to bottom' ? 'active' : '' }}"
                                                                       color-orientation="to bottom"
                                                                       main-orientation-class="toBottom"
                                                                       href="javascript:void(0);"><i
                                                                            class="fa fa-arrow-down"
                                                                            aria-hidden="true"></i></a></li>
                                                                <li>
                                                                    <a class="gradientOrientation {{ $colorOrientation == 'to left bottom' ? 'active' : '' }}"
                                                                       color-orientation="to left bottom"
                                                                       main-orientation-class="toLeftBottom"
                                                                       href="javascript:void(0);"><i
                                                                            class="fa fa-arrow-left degtop"
                                                                            aria-hidden="true"></i></a></li>
                                                                <li>
                                                                    <a class="gradientOrientation {{ $colorOrientation == 'to left' ? 'active' : '' }}"
                                                                       color-orientation="to left"
                                                                       main-orientation-class="toLeft"
                                                                       href="javascript:void(0);"><i
                                                                            class="fa fa-arrow-left"
                                                                            aria-hidden="true"></i></a></li>
                                                                <li>
                                                                    <a class="gradientOrientation {{ $colorOrientation == 'to left top' ? 'active' : '' }}"
                                                                       color-orientation="to left top"
                                                                       main-orientation-class="toLeftTop"
                                                                       href="javascript:void(0);"><i
                                                                            class="fa fa-arrow-left degbot"
                                                                            aria-hidden="true"></i></a></li>
                                                                <li>
                                                                    <a class="gradientOrientation {{ $colorOrientation == 'to top' ? 'active' : '' }}"
                                                                       color-orientation="to top"
                                                                       main-orientation-class="toTop"
                                                                       href="javascript:void(0);"><i
                                                                            class="fa fa-arrow-up"
                                                                            aria-hidden="true"></i></a></li>
                                                                <li>
                                                                    <a class="gradientOrientation {{ $colorOrientation == 'circle' ? 'active' : '' }}"
                                                                       color-orientation="circle"
                                                                       main-orientation-class="orientationCircle"
                                                                       href="javascript:void(0);"><i class="fa fa-undo"
                                                                                                     aria-hidden="true"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div>


                                                <div
                                                    class="mb20 widgetSingleColorBox" {!! $galleryData->bg_color_type == 'on' ? 'style="display:none;"' : '' !!}>

                                                    <div class="row">
                                                        <div class="position-relative mt-5 col-md-12">
                                                            <input name="solid_color"
                                                                   class="form-control h52 autoSaveDesign"
                                                                   id="solid_color" placeholder="#FF0000" type="text"
                                                                   value="{{ $galleryData->solid_color == '' ? '#FF0000' : $galleryData->solid_color }}" {!! $galleryData->bg_color_type != 'on' ? 'readonly' : '' !!}>
                                                            <a style="position: absolute; top: 17px; right: 25px;"
                                                               class="solidcolorpicker colorpicker-show-input"
                                                               href="javascript:void(0);"><i
                                                                    class="fa fa-square fsize18" {!! $galleryData->solid_color == '' ? 'style="color:#FF0000"' : 'style="color:' . $galleryData->solid_color . '"' !!}></i></a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p20 btop">
                                                @csrf
                                                <input name="editGalleryId" type="hidden"
                                                       value="{{ $galleryData->id }}">
                                                <button type="submit"
                                                        class="btn dark_btn bkg_dred w100 h52 saveWidgetDesign">Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>


                                    <div class="tab-pane" id="Reviews">
                                        <div class="profile_headings txt_upper p20 fsize11 fw600">Select Reviews <a
                                                class="pull-right plus_icon" href="javascript:void(0);"><i
                                                    class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                        <form method="post" name="frmWidgetReviewsSelect" id="frmWidgetReviewsSelect"
                                              action="javascript:void(0);">
                                            @csrf
                                            <div class="p20" style="height:790px; overflow-x:hidden;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                            if(!empty($reviewsData)) {
                                                                foreach ($reviewsData as $review) {
                                                                    $mediaUrl = unserialize($review->media_url);
                                                                    $mediaImageUrl = '';
                                                                    if(!empty($mediaUrl)) {
                                                                        foreach ($mediaUrl as $value) {
                                                                            if($value['media_type'] == 'image')
                                                                            {
                                                                                $mediaImageUrl = $value['media_url'];
                                                                                break;
                                                                            }
                                                                        }
                                                                    }

                                                                    if($mediaImageUrl != ''){

                                                                        $checked = false;
                                                                        /*$reviewsIdArray = unserialize($galleryData->reviews_id);
                                                                        if (in_array($review->id, $reviewsIdArray))
                                                                        {
                                                                            $checked = true;
                                                                        }*/

                                                                        $reviewData = \App\Models\ReviewsModel::getReviewDetailsByReviewID($review->id);
                                                                        $ratingsVal = '';
                                                                        /*for ($i = 1; $i <= 5; $i++) {
                                                                            if ($i <= $reviewData[0]->ratings) {
                                                                                $ratingsVal .= '<img src="'.base_url().'assets/images/widget/yellow_icon.png"> ';
                                                                            } else {
                                                                                $ratingsVal .= '<img src="'.base_url().'assets/images/widget/grey_icon.png"> ';
                                                                            }
                                                                        }

                                                                        $reviewImageArray = unserialize($reviewData[0]->media_url);
                                                                        $reviewRatings = $reviewData[0]->ratings + $reviewRatings;
                                                                        $imageUrl = $reviewImageArray[0]['media_url'];*/
                                                                        $imageUrl = '';
                                                        @endphp
                                                        <div class="form-group mb10"
                                                             style="padding-bottom:8px; margin-bottom:8px; border-bottom:1px solid #f4f6fa;">
                                                            <div class="pull-left mb0 showReviewPopup"
                                                                 review-id="{{ $review->id }}">

                                                                <div>
                                                                    <div class="media-left pr-15">
                                                                        <img class="review_productimg"
                                                                             src="https://s3-us-west-2.amazonaws.com/brandboost.io/{{ $mediaImageUrl }}">
                                                                    </div>
                                                                    <div class="media-left pr0">
                                                                        <div>{{ setStringLimit($review->brand_title) }}</div>
                                                                        <div class="text-size-small text-muted"
                                                                             style="font-size:11px;">{{ setStringLimit($review->review_title, 30). ' ('.number_format($review->ratings, 1).')' }}</div>
                                                                    </div>


                                                                    <div class="review_section_user">
                                                                        <div class="top_div" style="border: none;">
                                                                            <div class="left"><i class="circle"></i><a
                                                                                    class="icons"
                                                                                    href="javascript:void(0);">@php //echo showUserAvtar($reviewData[0]->avatar, $reviewData[0]->firstname, $reviewData[0]->lastname); @endphp</a>
                                                                            </div>
                                                                            <div class="right">
                                                                                <div class="client_n">
                                                                                    <p>@php //echo $reviewData[0]->firstname . ' ' . $reviewData[0]->lastname; @endphp</p>
                                                                                </div>
                                                                                <div class="client_review">
                                                                                    {{ $ratingsVal }}
                                                                                    <span>@php //echo dataFormat($reviewData[0]->created); @endphp</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                            <label class="custom-form-switch pull-right">
                                                                <input class="field autoSaveReview" type="checkbox"
                                                                       id="widget_review_{{ $review->id }}"
                                                                       name="reviewsId[]" value="{{ $review->id }}"
                                                                    {!! $checked == true ? 'checked' : '' !!}>
                                                                <span class="toggle dred"></span>
                                                            </label>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        @php } } } @endphp
                                                    </div>
                                                    <input type="hidden" name="galleryId" id="review_widget_id"
                                                           value="{{ $galleryData->id }}">
                                                    <button class="hidden saveReviews btn dark_btn h52 w100 bkg_purple"
                                                            type="submit"> Save Campaign
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-9">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs nav-tabs-bottom">
                                    <li><a href="#Preview">Preview</a></li>
                                </ul>
                            </div>
                            <div class="panel-body p20">
                                <img class="img-responsive w100"
                                     src="{{ base_url() }}assets/images/config_bkg_bk2.png"/>
                                <div id="mediaGalleryPreview">
                                    @include('admin.media-gallery.preview', array('galleryData' => $galleryData))
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!--===========TAB 2======Reviews=====-->
            <div class="tab-pane" id="right-icon-tab1">
                <div class="row">
                    <div class="col-md-3">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">How to add widget</h6>
                            </div>
                            <div class="panel-body p0">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item br0"
                                            src="https://www.youtube.com/embed/2H_Jsgh2Z3Y?rel=0&amp;showinfo=0"
                                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">You’re All Set!</h6>
                            </div>
                            <div class="panel-body min_h270 p20">
                                <p><span class="txt_dark">Descriptions List</span><br><small
                                        class="text-muted text-size-small">So strongly and metaphysically did I conceive
                                        of my situati.</small></p>
                                <p><span class="txt_dark">Euismod</span><br><small class="text-muted text-size-small">In
                                        the tumultuous business of cutting-in and attending to a whale, there.</small>
                                </p>
                                <p><span class="txt_dark">Descriptions List</span><br><small
                                        class="text-muted text-size-small">So strongly and metaphysically did I conceive
                                        of my situati.</small></p>
                                <p><span class="txt_dark">Euismod</span><br><small class="text-muted text-size-small">In
                                        the tumultuous business of cutting-in and attending to a whale, there.</small>
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">How to add widget</h6>
                            </div>
                            <div class="panel-body min_h270 p0">
                                <div class="p20 bbot">
<pre class="prettyprint" id="prettyprint">
&lt;script
	type="text/javascript"
	id="bbscriptgalleryloader"
	data-key="{{ $galleryData->hashcode }}"
	data-widgets="mediagallery"
	src="{{ base_url('assets/js/media_gallery_widget.js') }}"&gt;
&lt;/script&gt;
</pre>
                                    <div style="display: none;" class="prettyprintDiv">&lt;script type="text/javascript"
                                        id="bbscriptgalleryloader" data-key="{{ $galleryData->hashcode }}"
                                        data-widgets="mediagallery"
                                        src="{{ base_url('assets/js/media_gallery_widget.js') }}"&gt; &lt;/script&gt;
                                    </div>
                                </div>
                                <div class="p20 text-right">
                                    <button class="btn btn-xs btn_white_table pl10 pr10"
                                            onclick="copyToClipboard('.prettyprintDiv')">Copy Code
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
        <!--================================= CONTENT AFTER TAB===============================-->


    </div>


    <div id="reviewPopupModal" class="imgpopup modal fade">
        <div class="modal-dialog">
            <div class="modal-content modal-lg" id="reviewPopupData">

            </div>
        </div>
    </div>

    <div id="cropImageModal" class="imgpopup modal fade">
        <div class="modal-dialog">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title">Crop Image</h5>
                </div>
                <div class="modal-body">
                    <div class="box_inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="image-cropper-container content-group" style="height: 400px; width:100%;">
                                    <img src="{{ base_url() }}assets/images/placeholder.jpg" alt="" class="cropper"
                                         id="demo-cropper-image">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group demo-cropper-toolbar">
                                            <div class="btn-group btn-group-justified">
                                                <div class="btn-group">
                                                    <button type="button" class="btn bg-blue btn-icon"
                                                            data-method="zoom" data-option="0.1" title="Zoom In">
                                                        <span class="icon-zoomin3"></span>
                                                    </button>
                                                </div>

                                                <div class="btn-group">
                                                    <button type="button" class="btn bg-blue btn-icon"
                                                            data-method="zoom" data-option="-0.1" title="Zoom Out">
                                                        <span class="icon-zoomout3"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="btn-group btn-group-justified demo-cropper-ratio"
                                                 data-toggle="buttons">

                                                <label class="btn btn-default">
                                                    <input type="radio" class="sr-only" id="aspectRatio1"
                                                           name="aspectRatio" value="1.3333333333333333">
                                                    Rectangle
                                                </label>
                                                <label class="btn btn-default">
                                                    <input type="radio" class="sr-only" id="aspectRatio2"
                                                           name="aspectRatio" value="1">
                                                    Squire
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="btn-group btn-group-justified demo-cropper-toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default"
                                                    data-method="getCroppedCanvas">
                                                Save Cropped Image
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal with cropped image -->
    <div class="modal fade docs-cropped" id="getCroppedCanvasModal">
        <div class="modal-dialog">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title" id="getCroppedCanvasTitle">Cropped</h6>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-primary" id="download" download="cropped.jpg">Download</a>
                </div>
            </div>
        </div>
    </div>

    <script>

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            var widgetScript = String($(element).text());
            $temp.val(widgetScript).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>

    <script>
        var sliderBoxCount = {{ $galleryType == '' ? 6 : $galleryType }};
        var slideIndex = 0;

        function showSlides(n = 1) {
            var i;
            var slides = document.getElementsByClassName("sliderImage");
            if (n > 0) {
                if (slides.length > sliderBoxCount + slideIndex) {
                    slides[slideIndex].style.display = "none";
                    slides[sliderBoxCount + slideIndex].style.display = "block";
                    slideIndex++;
                    document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#fff';
                    document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#fff';
                    if (slides.length == sliderBoxCount + slideIndex) {
                        document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#eee';
                    }
                } else {
                    document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#eee';
                }
            } else {
                if ((slides.length >= sliderBoxCount + slideIndex) && (slideIndex > 0)) {
                    --slideIndex;
                    slides[slideIndex].style.display = "block";
                    slides[sliderBoxCount + slideIndex].style.display = "none";
                    document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#fff';
                    document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#fff';

                    if (sliderBoxCount == sliderBoxCount + slideIndex) {
                        document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#eee';
                    }
                } else {
                    document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#eee';
                }
            }
        }

        $(document).ready(function () {
            var $image = '';
            var options = '';
            var $download = '';
            var mainImageName = '';
            var reviewId = '';

            $(document).on('click', '#reviewPopupData .showCropImagePopup', function () {
                $('.overlaynew').show();
                var imagePath = $(this).attr('data-img');
                mainImageName = $(this).attr('data-img-name');
                reviewId = $(this).attr('data-review-id');
                $('#demo-cropper-image').attr('src', imagePath);
                setTimeout(function () {
                    // Define variables
                    $image = $('#demo-cropper-image');
                    var $cropper = $(".cropper"),
                        $download = $('#download');

                    options = {
                        aspectRatio: 1,
                        crop: function (e) {

                        }
                    };

                    // Initialize cropper with options
                    $cropper.cropper(options);

                    $('#cropImageModal').modal();

                    setTimeout(function () {
                        $('.demo-cropper-ratio input[type=radio]').click();
                        //$('.overlaynew').hide();
                    }, 1000);

                }, 3000);
            });

            $('.demo-cropper-toolbar').on('click', '[data-method]', function () {
                //$('.overlaynew').show();
                var $this = $(this),
                    data = $this.data(),
                    $target,
                    result;

                if ($image.data('cropper') && data.method) {
                    data = $.extend({}, data);

                    if (typeof data.target !== 'undefined') {
                        $target = $(data.target);

                        if (typeof data.option === 'undefined') {
                            data.option = JSON.parse($target.val());
                        }
                    }

                    result = $image.cropper(data.method, data.option, data.secondOption);

                    switch (data.method) {
                        case 'getCroppedCanvas':
                            if (result) {

                                // Init modal
                                console.log(result);

                                var ImageURL = result.toDataURL('image/jpeg');
                                $.ajax({
                                    url: '{{ base_url() }}/admin/mediagallery/updateMediaImage',
                                    type: "POST",
                                    data: {
                                        imageName: ImageURL,
                                        mainImageName: mainImageName,
                                        reviewId: reviewId,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status = 'status') {
                                            $('#cropImageModal').modal('hide');
                                            window.location.href = window.location.href;
                                        } else {
                                        }
                                    }
                                });
                            }
                            break;
                    }
                }
            });


            $('.demo-cropper-ratio').on('change', 'input[type=radio]', function () {
                $('.overlaynew').show();
                options[$(this).attr('name')] = $(this).val();
                $image.cropper('destroy').cropper(options);
                setTimeout(function () {
                    $('.overlaynew').hide();
                }, 3500);
            });

            //click to show image review tab list
            $(document).on('click', '.showNotFoundPopup', function () {
                $('a[href="#Reviews"]').click();
            });

            $("#galleryDesignType").click(function () {
                $(".box").animate({
                    width: "toggle"
                });
            });

            $('.review_source_new').click(function () {
                var currentClass = $(this).attr('current-class');
                $('.review_source_new .inner').removeClass('active');
                $('.' + currentClass + 'CWBox .inner').addClass('active');

                $.ajax({
                    url: "{{ base_url() }}/admin/mediagallery/updateWidgetType",
                    method: "POST",
                    data: {
                        'gallery_id': {{ $galleryData->id }},
                        'gallery_type': currentClass,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == "success") {
                            $('#mediaGalleryPreview').html(data.sliderView);
                            slideIndex = 0;
                        } else {
                            displayMessagePopup('error');
                        }
                    }
                });
            });

            $('.autoSaveReview').change(function () {
                setTimeout(function () {
                    $('.saveReviews').trigger('click');
                }, 200);
            });

            $('#frmWidgetReviewsSelect').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ base_url() }}/admin/mediagallery/saveReviewsList",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == "success") {
                            $('#mediaGalleryPreview').html(data.sliderView);
                            slideIndex = 0;
                            displayMessagePopup();
                        } else {
                            displayMessagePopup('error');
                        }
                    }
                });
            });

            $(document).on('click', '.reviewArrowBH a', function (e) {
                var bd = $(this).attr("bb_direction");
                if (bd == 'right') {
                    showSlides(1)
                } else if (bd == 'left') {
                    showSlides(-1)
                }
            });

            var myDropzoneLogoImg = new Dropzone(
                '#myDropzone_logo_img', //id of drop zone element 1
                {
                    url: '{{ base_url("/dropzone/upload_image") }}',
                    uploadMultiple: false,
                    maxFiles: 1,
                    maxFilesize: 600,
                    acceptedFiles: 'image/*',
                    addRemoveLinks: false,
                    success: function (response) {
                        //$('.dz-preview').remove();
                        $('#logo_img').val(response.xhr.responseText);
                        $('.galleryImage').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' + response.xhr.responseText);
                    }
                });

            Dropzone.autoDiscover = false;


            $('#frmWidgetConfSubmit').on('submit', function (e) {
                $('.overlaynew').show();
                e.preventDefault();
                $.ajax({
                    url: "{{ base_url() }}/admin/mediagallery/updateMediaData",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        $('.overlaynew').hide();
                        if (data.status == "success") {
                            $('#mediaGalleryPreview').html(data.sliderView);
                            slideIndex = 0;
                            displayMessagePopup();
                        } else {
                            displayMessagePopup('error');
                        }
                    }
                });
            });

            $(document).on('click', '.checkedBoxValue', function () {
                if ($(this).prop('checked')) {
                    $(this).val('1');
                } else {
                    $(this).val('0');
                }
            });

            $(document).on('click', '.showReviewPopup', function (e) {
                e.preventDefault();
                $('.overlaynew').show();
                var reviewId = $(this).attr('review-id');
                $.ajax({
                    url: "{{ base_url() }}/admin/mediagallery/getReviewData",
                    method: "POST",
                    data: {'review_id': reviewId, _token: '{{ csrf_token() }}'},
                    dataType: "json",
                    success: function (data) {
                        $('.overlaynew').hide();
                        if (data.status == "success") {
                            $('#reviewPopupData').html(data.popupData);
                            $('#reviewPopupModal').modal();
                        } else {
                            displayMessagePopup('error');
                        }
                    }
                });
            });

            $(document).on('change', '.autoSaveConfig', function () {
                setTimeout(function () {
                    $('.saveWidgetConfig').trigger('click');
                }, 100);
            });

            $(document).on('change', '.autoSaveDesign', function () {
                setTimeout(function () {
                    $('.saveWidgetDesign').trigger('click');
                }, 100);
            });

            $('#allowTitle').change(function () {
                if ($(this).prop("checked") == false) {
                    $('.reviewTitleBH').addClass('hidden');
                } else {
                    $('.reviewTitleBH').removeClass('hidden');
                }
            });

            $(document).on('keyup', '#galleryName', function () {
                $('.reviewTitle').html($(this).val());
            });

            $('#frmWidgetDesignSubmit').on('submit', function (e) {
                e.preventDefault();
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url() }}/admin/mediagallery/updateMediaDesignData",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        $('.overlaynew').hide();
                        if (data.status == "success") {
                            $('#mediaGalleryPreview').html(data.sliderView);
                            displayMessagePopup();
                        } else {
                            displayMessagePopup('error');
                        }
                    }
                });
            });


            ////////////////////// gallery background color settings ///////////////////////

            $('#widget_color_allow').change(function () {
                if ($(this).prop("checked") == false) {
                    $('.allowWidgetBackground').hide();
                } else {
                    $('.allowWidgetBackground').show();
                }
                $('.saveWidgetDesign').trigger('click');
            });

            $('#main_color_switch').change(function () {
                if ($(this).prop("checked") == false) {
                    $('.widgetSingleColorBox').show();
                    $('.widgetMultiColorBox').hide();
                } else {
                    $('.widgetSingleColorBox').hide();
                    $('.widgetMultiColorBox').show();
                    var gColor = $('.selectMainColor.active').attr('color-class');
                    var colorName = $('.selectMainColor.active').attr('color-data');
                }
            });

            $(document).on('click', '.gradientOrientation', function () {
                $('#bbColorOrientationSection').removeClass('toRightTop');
                $('#bbColorOrientationSection').removeClass('toRight');
                $('#bbColorOrientationSection').removeClass('toRightBottom');
                $('#bbColorOrientationSection').removeClass('toBottom');
                $('#bbColorOrientationSection').removeClass('toLeftBottom');
                $('#bbColorOrientationSection').removeClass('toLeft');
                $('#bbColorOrientationSection').removeClass('toLeftTop');
                $('#bbColorOrientationSection').removeClass('toTop');
                $('#bbColorOrientationSection').removeClass('orientationCircle');

                $('#bbColorOrientationSection').addClass($(this).attr('main-orientation-class'));

                $('.gradientOrientation').removeClass('active');
                var orientationVal = $(this).attr('color-orientation');
                $(this).addClass('active');
                $('#color_orientation').val(orientationVal);

                if ($('#alternative_design').prop("checked") == false) {
                    if ($('#widget_bgcolor_switch').val() == 2) {
                        if (orientationVal == 'circle') {
                            $('.previewWidgetBox .bb_widget_main_container, .bb_close, .bb_feed_widget_rb').css('background-image', 'radial-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                        } else {
                            $('.previewWidgetBox .bb_widget_main_container, .bb_close, .bb_feed_widget_rb').css('background-image', 'linear-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                        }
                        $('.previewWidgetBox .addCustomBGClass').css('background-image', '');
                    }
                } else {
                    if ($('#widget_bgcolor_switch').val() == 2) {
                        $('.previewWidgetBox .bb_widget_main_container, .bb_close, .bb_feed_widget_rb').css('background-image', '');
                        if (orientationVal == 'circle') {
                            $('.previewWidgetBox .addCustomBGClass, .bb_feed_widget_rb').css('background-image', 'radial-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                        } else {
                            $('.previewWidgetBox .addCustomBGClass, .bb_feed_widget_rb').css('background-image', 'linear-gradient(' + orientationVal + ', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                        }
                    }
                }
                $('.saveWidgetDesign').trigger('click');
            });

            $('.selectMainColor').click(function () {
                $('#main_colors').val($(this).attr('color-data'));
                $('.selectMainColor').removeClass('active');
                $(this).addClass('active');

                $('#main_color_switch').prop('checked', true);
                $('.widgetSingleColorBox').hide();
                $('.middle .box_1').removeClass('bbw_white_color');
                $('.middle .box_1').removeClass('bbw_red_color');
                $('.middle .box_1').removeClass('bbw_yellow_color');
                $('.middle .box_1').removeClass('bbw_green_color');
                $('.middle .box_1').removeClass('bbw_orange_color');
                $('.middle .box_1').removeClass('bbw_blue_color');
                $('.middle .box_1').removeClass('bbw_purple_color');
                $('.middle .box_1').addClass($(this).attr('color-class'));
                $('.saveWidgetDesign').trigger('click');
            });

            var greadentColor1 = $('#custom_colors1').val();
            $(".colorpicker1").spectrum({
                change: function (color) {
                    greadentColor1 = color.toHexString();
                    $('#custom_colors1').val(color.toHexString());
                    $('.colorpicker1 i').attr('style', 'color:' + color.toHexString() + '!important');
                    if ($('#custom_colors1').val() != '' && $('#custom_colors2').val() != '') {
                        setTimeout(function () {
                            $('.selectMainColor').removeClass('active');
                            $('.saveWidgetDesign').trigger('click');
                        }, 1000);
                    }
                },
                move: function (color) {
                    greadentColor1 = color.toHexString();
                    $('#custom_colors1').val(color.toHexString());
                    $('.colorpicker1 i').attr('style', 'color:' + color.toHexString() + '!important');
                }
            });

            $(".colorpicker2").spectrum({
                change: function (color) {
                    $('#custom_colors2').val(color.toHexString());
                    $('.colorpicker2 i').attr('style', 'color:' + color.toHexString() + '!important');
                    if ($('#custom_colors1').val() != '' && $('#custom_colors2').val() != '') {
                        setTimeout(function () {
                            $('.selectMainColor').removeClass('active');
                            $('.saveWidgetDesign').trigger('click');
                        }, 1000);
                    }
                },
                move: function (color) {
                    $('#custom_colors2').val(color.toHexString());
                    $('.colorpicker2 i').attr('style', 'color:' + color.toHexString() + '!important');
                }
            });

            $(".solidcolorpicker").spectrum({
                change: function (color) {
                    $('#solid_color').val(color.toHexString());
                    $('.middle .box_1').attr('style', 'background:' + color.toHexString() + '!important');
                    $('.solidcolorpicker i').attr('style', 'color:' + color.toHexString() + '!important');
                    if ($('#solid_color').val() != '') {
                        setTimeout(function () {
                            $('.saveWidgetDesign').trigger('click');
                        }, 1000);
                    }
                },
                move: function (color) {
                    $('#solid_color').val(color.toHexString());
                    $('.middle .box_1').attr('style', 'background:' + color.toHexString() + '!important');
                    $('.solidcolorpicker i').attr('style', 'color:' + color.toHexString() + '!important');
                }
            });

        });
    </script>
@endsection
