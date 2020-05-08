<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BrandBoost::Admin</title>
    <link rel="icon" href="{{ base_url() }}assets/images/icon.ico" sizes="16x16" type="image/ico">


    <!--******************
    CSS
    **********************-->
    <link href="{{ base_url() }}html_2.0/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.3.0/fonts/remixicon.css" rel="stylesheet">
    <link href="{{ base_url() }}html_2.0/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="{{ base_url() }}html_2.0/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="{{ base_url() }}html_2.0/assets/css/styleguide.css" rel="stylesheet" type="text/css">

    <!-- Global stylesheets -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ base_url() }}assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="{{ base_url() }}assets/css/theme1.css" rel="stylesheet" type="text/css">
    <link href="{{ base_url() }}assets/css/review_request.css" rel="stylesheet" type="text/css">
    <link href="{{ base_url() }}assets/css/review_request_collect.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!--******************
     jQuery
    **********************-->
    <script src="{{ base_url() }}assets/js/jquery.min.js"></script>
    <script src="{{ base_url() }}assets/js/bootstrap.bundle.min.js"></script>
    <!-- Core JS files -->
    <script type="text/javascript" src="{{ base_url() }}assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="{{ base_url() }}assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="{{ base_url() }}assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ base_url() }}assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="{{ base_url() }}assets/dropzone-master/dist/dropzone.js"></script>
    <!-- /core JS files -->
    <style type="text/css">
        .selected{
            text-shadow: 0 1px 0 0 rgba(255, 160, 79, 0.15)!important;
            color: #ffcd5e!important;
            font-size: 18px;
            margin-right: 3px;
        }
        .fav_gry{
            margin-right: 3px;
        }
        .icon_image_check {
            display: none;
        }
        .icon_image_active {
            display: none;
        }
        .icon_image {
            display: none;
        }
        .dropzone {
            border-radius: 5px;
            box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);
            border: solid 1px #f3f4f7;
            background-color: #fff;
            text-align: center;
            padding-top: 30px;
        }

        .bg-teal-400 {
            background-color: #26A69A;
            border-color: #26A69A;
            color: #fff;
        }
        .btn i {
            font-size: 12px!important;
        }
        .fav_gry {
            color: #d9d9e9;
            font-size: 18px;
        }
        .fav_yello {
            text-shadow: 0 1px 0 0 rgba(255, 160, 79, 0.15);
            color: #ffcd5e;font-size: 18px; margin-right: 3px;
        }
    </style>
    <!-- /theme JS files -->

</head>
@php
    $userId = $brandboostData->user_id;
    $userData = getUserDetail($userId);
    $companyName = $userData->company_name;
    $companySlug = strtolower(str_replace(' ', '-', $companyName));
@endphp


<body>
<div class="review_collection">
    <div class="review_header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6"> <a href="#" class="fsize16 fw400 light_000">Company Logo</a> </div>
                <div class="col-6 text-right"> <a href="#" class="fsize16 fw400 light_000">FAQ</a> </div>
            </div>
        </div>
    </div>
    @php
        if(!empty($rRating)) {
            $reviewRating = $rRating;
        }
        else {
            $reviewRating = 3;
        }
    @endphp

    <div class="overlaynew" style="position: fixed;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.4); z-index: 99999;text-align: center; display:none; top: 0">
        <div style="top: 47%;position:relative;">
            <button type="button" class="btn bg-teal-400" id="spinner-dark-6"><i class="icon-spinner9 spinner position-left"></i> Processing</button>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center"> <img class="mb20" src="{{ base_url() }}assets/images/star_circle_64.svg"/>
                <h2 class="htxt_medium_24 ls4 light_000 mb20">Thanks for your purchase!</h2>
                <p style="opacity:0.9;" class="fsize16 fw400 light_000">{{ $uSubscribers->firstname.' '.$uSubscribers->lastname }}! Thanks for purchasing from Brandboost. Can you spare a<br>
                    minute of you time to tell us what you thought?</p>
            </div>
        </div>
        <form method="post" name="frmSiteReviewSubmit" id="frmSiteReviewSubmit" container_name="sitereview" action="#"  enctype="multipart/form-data">
            <div class="row">
            <div class="col-12">
                <div class="card br8 mt30 review_collection_sec p0">
                    <div class="bbot p30 pl50 pr50">
                        <h3 class="fsize16 fw500 dark_700">How do you like our product?</h3>
                        <p class="fsize14 dark_200 m-0">Review your experience with our product Brandboost</p>
                    </div>
                    <div class="bbot p30 pl50 pr50">
                        <div class="form-group">
                            <label class="dark_600 fsize11 fw500 ls4">RATE OUR SERVICE</label>
                            <div class="min_h_50 border br4">
                                <div class="row m-0">
                                    {{--<div class="min_h_50 brig col-10">
                                        <div class="p10 pt12 starRate">
                                            @for($inc = 1; $inc <= $reviewRating; $inc++)
                                            <img src="{{ base_url() }}assets/images/star-brand.svg"/>
                                            @endfor
                                            @for($inc = 1; $inc <= (5-$reviewRating); $inc++)
                                                <img src="{{ base_url() }}assets/images/star_fill_white_25.svg"/>
                                            @endfor
                                        </div>
                                    </div>--}}
                                    <div class="min_h_50 brig col-10">
                                        <div class="p10 pt12 starRate">
                                            @for($inc = 1; $inc <= 5; $inc++)
                                                <i data-value='{{ $inc }}' containerclass="siteRatingValue" class="fa fa-star fav_gry {!! $inc <= $reviewRating ? 'selected' : '' !!}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="min_h_50 col-2">
                                        <div class="fsize14 dark_200 m-0 text-center pt15 rat_num">{{ $reviewRating }}/5</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="dark_600 fsize11 fw500 ls4">REVIEW OF OUR SERVICE</label>
                            <textarea name="description" id="site-description" placeholder="Enter your review here..." required style="min-height:142px;" class="form-control p20 dark_300"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="dark_600 fsize11 fw500 ls4">UPLOAD PHOTO OR VIDEO</label>
                            <label class="dark_400 fsize11 fw500 ls4 float-right">5 MEDIA MAX</label>
                            <label class="m0 w-100" for="upload">
                                <div class="img_vid_upload_review border dropzone" id="myDropzone">
                                    <input class="d-none" type="file" name="" value="" id="upload">
                                </div>
                                <div id="uploadedSiteFiles" style="display: none;"></div>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="dark_600 fsize11 fw500 ls4">CONTACT INFO</label>
                            <div class="border br4">
                                <input name="fullname" class="form-control h50 border-0 subNameAdd" value="{{ $uSubscribers->firstname.' '.$uSubscribers->lastname }}" type="text" placeholder="Enter your full name">
                                <input name="emailid" type="text" class="form-control h50 border-0 btop subEmailAdd" style="border-radius:0 0 4px 4px!important" value="{{ $uSubscribers->email }}" placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="fsize14 dark_400 m-0">
                                <input class="mt-1 float-left" type="radio" name="display_name" id="" value="1" />
                                &nbsp; &nbsp; Don’t show my name in publich review</p>
                        </div>
                    </div>
                    <div class="p30 pl50 pr50">
                        <div class="row">
                            <div class="col-5">
                                @if($action !='preview')
                                    <button type="submit" class="btn btn-md bkg_blue_400 light_000 br35 fsize13 fw500 pl30 pr30 buttonSiteReview">Submit Review</button>
                                @endif
                            </div>
                            <div class="col-7">
                                <p class="dark_400 fsize13 m-0">By continuing you agree to <a class="fw500 dark_400" href="#">Terms of Service</a> and <a class="fw500 dark_400" href="#">Privacy Policy</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <input type="hidden" name="campaign_id" value="{{ $brandboostID }}" />
            <input type="hidden" name="subID" value="{{ $subscriberID }}" />
            <input type="hidden" name="inviterID" value="{{ $inviterID }}" />
            <input type="hidden" name="reviewUniqueID" value="{{ $uniqueID }}">
            <input type="hidden" value="{{ $reviewRating }}" class="siteRatingValue" id="siteRatingValue" name="ratingValue">
            <input type="hidden" value="site" id="reviewType" name="reviewType">
        </form>

        <form method="post" name="frmRecommendationUrlSubmit" id="frmRecommendationUrlSubmit" action="#" container_name="recommendationreviewurl"  enctype="multipart/form-data">
        <div class="row">
            <div class="col-12">
                <div class="card br8 mt0 review_collection_sec p0">
                    <div class="bbot p30 pl50 pr50">
                        <h3 class="fsize16 fw500 dark_700">Share product with frineds</h3>
                        <p class="fsize14 dark_200 m-0">Select a type of campaign you would like to create and .</p>
                    </div>
                    <div class="p30 pl50 pr50">
                        <div class="form-group mb20">
                            <label class="dark_600 fsize11 fw500 ls4">SHARE LINK</label>
                            <input name="recommendurl" id="recommendurl" class="form-control h50" value="{{ base_url() }}for/{{ $companySlug }}/{{ strtolower(str_replace('', '-', $brandboostData->brand_title)) }}-{{ $brandboostData->id }}" type="text" required="" placeholder="http://brandboost.com/product/fds423s">
                            <a style="cursor: pointer;" onclick="copyLink()" class="pull-right">Copy Link</a>
                        </div>
                        <div class="form-group mb20"> <a href="#" class="mr-2"><img src="{{ base_url() }}assets/images/facebook_40.svg"/></a> <a href="#" class="mr-2"><img src="{{ base_url() }}assets/images/twitter_40.svg"/></a> <a href="#" class="mr-2"><img src="{{ base_url() }}assets/images/email_40.svg"/></a> </div>
                        <div class="clearfix"></div>
                        <div class="bottom_btn_sec">
                            @if($action !='preview')
                                <button type="submit" class="btn btn-md bkg_blue_400 light_000 br35 fsize13 fw500 pl30 pr30 buttonShareReview" id="recommendurlbtn">Submit</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <input type="hidden" name="reviewUniqueID" value="{{ $uniqueID }}">
            <input type="hidden" class="subInviterID" name="subInviterID" value="{{ $inviterID }}">
            <input type="hidden" name="campaign_id" value="{{ $brandboostID }}" />
        </form>

    </div>
</div>

<div id="alertMessagePopup" style="z-index: 99999" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body"><div class="message"></div></div>
            <div class="modal-footer">
                {{--<button data-bb-handler="confirm" type="button" class="btn btn-primary confirmOk">OK</button>--}}
                <button data-bb-handler="confirm" type="button" class="btn btn-primary confirmOkclose" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('change', '.subNameAdd', function() {
            var name = $(this).val();
            $('.autoFillFN').each(function(){
                $(this).val(name);
            });
        });

        $(document).on('change', '.subEmailAdd', function() {
            var emailAddress = $(this).val();
            $('.autoFillEmail').each(function(){
                $(this).val(emailAddress);
            });
        });

        /*$(document).on('click', '.tacSiteReview', function() {
            if($(this).prop('checked') == true){
                $('.buttonSiteReview').show();
            }
            else {
                $('.buttonSiteReview').hide();
            }
        });*/

        $(document).on('click', '.tacCampaignReview', function() {
            if($(this).prop('checked') == true){
                $('.buttonCampaignReview').show();
            }
            else {
                $('.buttonCampaignReview').hide();
            }
        });

        $(document).on('click', '.tacReReview', function() {
            if($(this).prop('checked') == true){
                $('.buttonReReview').show();
            }
            else {
                $('.buttonReReview').hide();
            }
        });

        /*$(document).on('click', '.tacShareReview', function() {
            if($(this).prop('checked') == true){
                $('.buttonShareReview').show();
            }
            else {
                $('.buttonShareReview').hide();
            }
        });*/

        $(document).on("click", ".rec", function () {
            var recValue = $(this).attr("val");
            $("#recomendationValue").val(recValue);
            $('.rec').removeClass('bkg_purple txt_white');
            $(this).addClass('bkg_purple txt_white');
        });

        $('.nav a').click(function (e) {
            $(this).tab('show');

            var tabContent = '#tabContent' + this.id;

            $('#tabContent1').hide();
            $('#tabContent2').hide();
            $('#tabContent3').hide();
            $('#tabContent4').hide();
            $(tabContent).show();
        });


        //Display Ratings etc
        var ratingValue = 0;
        $('.starRate i').on('mouseover', function () {
            var onStar = parseInt($(this).data('value'), 10);


            $(this).parent().children('i').each(function (e) {
                if (e < onStar) {
                    $(this).removeClass('fav_gry');
                    $(this).addClass('fav_yello');
                } else {
                    $(this).addClass('fav_gry');
                    $(this).removeClass('fav_yello');
                }
            });

        }).on('mouseout', function () {
            $(this).parent().children('i').each(function (e) {
                $(this).removeClass('fav_yello');
                $(this).addClass('fav_gry');
            });
        });


        $('.starRate i').on('click', function () {
            var valContainer = $(this).attr('containerclass');
            var onStar = parseInt($(this).data('value'), 10);
            //$(this).parent().find('div.rat_num').html(onStar+'/5');
            $('.rat_num').html(onStar+'/5');
            var stars = $(this).parent().children('i');
            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            ratingValue = $(this).attr("data-value");
            $('#' + valContainer).val(ratingValue);
        });

        document.addEventListener("DOMContentLoaded", function() {
            Dropzone.options.myDropzone = {
                url: '{{ base_url("webchat/dropzone/upload_s3_attachment_review/".$_GET['clid']."/reviews") }}',
                uploadMultiple: false,
                maxFiles: 10,
                maxFilesize: 600,
                acceptedFiles: 'image/*,video/mp4',
                addRemoveLinks: true,
                removedfile: function (file) {
                    var _ref;
                    var xmlString = file.xhr.responseText;
                    var totalStr = $('#uploadedSiteFiles').html();
                    var res_str = totalStr.replace(xmlString, " ");
                    $('#uploadedSiteFiles').html(res_str);
                    var res = xmlString.split("||");
                    var dropImage = res[0];
                    $.ajax({
                        url: "{{ base_url('admin/brandboost/DeleteObjectFromS3') }}",
                        type: "POST",
                        data: {dropImage: dropImage},
                        dataType: "json",
                        success: function (data) {

                        }
                    });

                    setTimeout(function () {
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                    }, 1000);
                },
                success: function (response) {
                    $('#uploadedSiteFiles').append(response.xhr.responseText);
                }
            }
        });

        @foreach($productsData as $key=>$productData)
            Dropzone.options.myDropzone{{ $productData->id }} = {
            url: '{{ base_url("webchat/dropzone/upload_s3_attachment_product_review/".$_GET['clid']."/reviews") }}/{{ $productData->id }}',
            uploadMultiple: false,
            maxFiles: 5,
            maxFilesize: 600,
            acceptedFiles: 'image/*,video/mp4',
            addRemoveLinks: true,
            removedfile: function(file) {
                var _ref;
                var xmlString = file.xhr.responseText;
                var totalStr = $('#uploadedProductFiles_{{ $productData->id }}').html();
                var res_str = totalStr.replace(xmlString, " ");
                $('#uploadedProductFiles_{{ $productData->id }}').html(res_str);
                var res = xmlString.split("||");
                var dropImage = res[0];
                $.ajax({
                    url: "{{ base_url('admin/brandboost/DeleteObjectFromS3') }}",
                    type: "POST",
                    data: {dropImage: dropImage},
                    dataType: "json",
                    success: function (data) {

                    }
                });

                setTimeout(function() {
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                }, 1000);
            },
            success: function (response) {
                $('#uploadedProductFiles_{{ $productData->id }}').append(response.xhr.responseText);
            }
        }
        @endforeach

            @foreach($servicesData as $key=>$productData)
            Dropzone.options.myDropzone{{ $productData->id }} = {
            url: '{{ base_url("webchat/dropzone/upload_s3_attachment_product_review/".$_GET['clid']."/reviews") }}/{{ $productData->id }}',
            uploadMultiple: false,
            maxFiles: 5,
            maxFilesize: 600,
            acceptedFiles: 'image/*,video/mp4',
            addRemoveLinks: true,
            removedfile: function(file) {
                var _ref;
                var xmlString = file.xhr.responseText;
                var totalStr = $('#uploadedProductFiles_{{ $productData->id }}').html();
                var res_str = totalStr.replace(xmlString, " ");
                $('#uploadedProductFiles_{{ $productData->id }}').html(res_str);
                var res = xmlString.split("||");
                var dropImage = res[0];
                $.ajax({
                    url: "{{ base_url('admin/brandboost/DeleteObjectFromS3') }}",
                    type: "POST",
                    data: {dropImage: dropImage, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {

                    }
                });

                setTimeout(function() {
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                }, 1000);
            },
            success: function (response) {
                $('#uploadedProductFiles_{{ $productData->id }}').append(response.xhr.responseText);
            }
        }
        @endforeach

        setTimeout(function(){ $('.dz-default').hide(); }, 10);


        $("#frmSiteReviewSubmit, #frmProductReviewSubmit, #frmServiceReviewSubmit, #frmRecommendationSubmit").submit(function () {
            var formdata = new FormData(this);
            var containerName = $(this).attr("container_name");
            $('.overlaynew').show();
            $.ajax({
                url: "{{ base_url('/reviews/saveNewReview') }}",
                type: "POST",
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response.status == 'success') {
                        $('.overlaynew').hide();
                        alertMessage(response.msg);

                        if (containerName == 'sitereview') {
                            $('#collapseOne').removeClass("in");
                            $('#collapseTwo').addClass("in");
                            $('#collapseThree').removeClass("in");
                            $('#collapsefour').removeClass("in");
                        } else if (containerName == 'productreview') {
                            $('#collapseOne').removeClass("in");
                            $('#collapseTwo').removeClass("in");
                            $('#collapseFive').addClass("in");
                            $('#collapsefour').removeClass("in");
                        } else if (containerName == 'servicereview') {
                            $('#collapseOne').removeClass("in");
                            $('#collapseTwo').removeClass("in");
                            $('#collapseFive').removeClass("in");
                            $('#collapseThree').addClass("in");
                            $('#collapsefour').removeClass("in");
                        } else if (containerName == 'recommendationreview') {
                            $('#collapseOne').removeClass("in");
                            $('#collapseTwo').removeClass("in");
                            $('#collapseThree').removeClass("in");
                            $('#collapsefour').addClass("in");
                        }

                        $('.panel-default').each(function(i){
                            if($(this).find('.in').length > 0)
                            {
                                $(this).find('.icon_show').addClass('icon_image_check');
                                $(this).find('.star_cls_active').addClass('icon_image_active');
                                $(this).find('.star_cls').removeClass('icon_image');
                            }
                            else {
                                $(this).find('.icon_show').removeClass('icon_image_check');
                                $(this).find('.star_cls_active').removeClass('icon_image_active');
                                $(this).find('.star_cls').addClass('icon_image');
                            }
                        });
                    } else {
                        $('.overlaynew').hide();
                        alertMessage(response.msg);
                    }
                },
                error: function (response) {
                    $('.overlaynew').hide();
                    alertMessage(response.msg);
                }
            });
            return false;
        });


        $("#frmRecommendationUrlSubmit").submit(function () {
            var formdata = new FormData(this);
            $('.overlaynew').show();
            var recommendurl = $('#recommendurl').val();
            $.ajax({
                url: "{{ base_url('reviews/submitOnsiteReview') }}",
                type: "POST",
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = recommendurl;
                    } else {
                        $('.overlaynew').hide();
                        alertMessage(response.msg);
                    }
                },
                error: function (response) {
                    $('.overlaynew').hide();
                    alertMessage(response.msg);
                }
            });
            return false;
        });
    });

    $(document).on('click', '.skip1', function() {
        $('#collapseOne').removeClass("in");
        $('#collapseTwo').addClass("in");
        $('#collapseThree').removeClass("in");
        $('#collapsefour').removeClass("in");

        $(this).parent().parent().parent().prev().find('.icon_show').toggleClass('icon_image_check');
        $(this).parent().parent().parent().prev().find('.star_cls_active').toggleClass('icon_image_active');
        $(this).parent().parent().parent().prev().find('.star_cls').toggleClass('icon_image');

        $('.panel-default').each(function(i){
            if($(this).find('.in').length > 0)
            {
                $(this).find('.icon_show').addClass('icon_image_check');
                $(this).find('.star_cls_active').addClass('icon_image_active');
                $(this).find('.star_cls').removeClass('icon_image');
            }
            else {
                $(this).find('.icon_show').removeClass('icon_image_check');
                $(this).find('.star_cls_active').removeClass('icon_image_active');
                $(this).find('.star_cls').addClass('icon_image');
            }
        });
    });

    $(document).on('click', '.skip2', function() {
        $('#collapseOne').removeClass("in");
        $('#collapseTwo').removeClass("in");
        $('#collapseFive').addClass("in");
        $('#collapseThree').removeClass("in");
        $('#collapsefour').removeClass("in");

        $(this).parent().parent().parent().prev().find('.icon_show').toggleClass('icon_image_check');
        $(this).parent().parent().parent().prev().find('.star_cls_active').toggleClass('icon_image_active');
        $(this).parent().parent().parent().prev().find('.star_cls').toggleClass('icon_image');

        $('.panel-default').each(function(i){
            if($(this).find('.in').length > 0)
            {
                $(this).find('.icon_show').addClass('icon_image_check');
                $(this).find('.star_cls_active').addClass('icon_image_active');
                $(this).find('.star_cls').removeClass('icon_image');
            }
            else {
                $(this).find('.icon_show').removeClass('icon_image_check');
                $(this).find('.star_cls_active').removeClass('icon_image_active');
                $(this).find('.star_cls').addClass('icon_image');
            }
        });
    });

    $(document).on('click', '.skip3', function() {
        $('#collapseOne').removeClass("in");
        $('#collapseTwo').removeClass("in");
        $('#collapseThree').removeClass("in");
        $('#collapsefour').addClass("in");

        $(this).parent().parent().parent().prev().find('.icon_show').toggleClass('icon_image_check');
        $(this).parent().parent().parent().prev().find('.star_cls_active').toggleClass('icon_image_active');
        $(this).parent().parent().parent().prev().find('.star_cls').toggleClass('icon_image');

        $('.panel-default').each(function(i){
            if($(this).find('.in').length > 0)
            {
                $(this).find('.icon_show').addClass('icon_image_check');
                $(this).find('.star_cls_active').addClass('icon_image_active');
                $(this).find('.star_cls').removeClass('icon_image');
            }
            else {
                $(this).find('.icon_show').removeClass('icon_image_check');
                $(this).find('.star_cls_active').removeClass('icon_image_active');
                $(this).find('.star_cls').addClass('icon_image');
            }
        });
    });

    $(document).on('click', '.skip4', function() {
        $('#collapseOne').removeClass("in");
        $('#collapseTwo').removeClass("in");
        $('#collapseThree').addClass("in");
        $('#collapsefour').removeClass("in");
        $('#collapseFive').removeClass("in");

        $(this).parent().parent().parent().prev().find('.icon_show').toggleClass('icon_image_check');
        $(this).parent().parent().parent().prev().find('.star_cls_active').toggleClass('icon_image_active');
        $(this).parent().parent().parent().prev().find('.star_cls').toggleClass('icon_image');

        $('.panel-default').each(function(i){
            if($(this).find('.in').length > 0)
            {
                $(this).find('.icon_show').addClass('icon_image_check');
                $(this).find('.star_cls_active').addClass('icon_image_active');
                $(this).find('.star_cls').removeClass('icon_image');
            }
            else {
                $(this).find('.icon_show').removeClass('icon_image_check');
                $(this).find('.star_cls_active').removeClass('icon_image_active');
                $(this).find('.star_cls').addClass('icon_image');
            }
        });
    });

    function alertMessage(message) {
        $("#alertMessagePopup").modal();
        $('.message').html(message);
    }

    function copyLink() {
        var copyText = document.getElementById("recommendurl");
        copyText.select();
        document.execCommand("copy");
    }
</script>
</body>
</html>
