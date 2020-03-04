@php
    $allowTitle = $galleryData->allow_title;
    $allowArrows = $galleryData->allow_arrow;
    $allowRating = $galleryData->allow_ratings;
    $name = $galleryData->name;
    $description = $galleryData->description;
    $galleryType = $galleryData->gallery_type;
    $imageSize = $galleryData->image_size;
    $gradientColor = $galleryData->gradient_color;
    $widgetBgcolor = $galleryData->allow_widget_bgcolor;
    $borderThickness = $galleryData->border_thickness;
    $galleryDesign = $galleryData->gallery_design_type;
    $galleryId = $galleryData->id;
    $colorOrientation = $galleryData->gradient_orientation == '' ? 'to right top' : $galleryData->gradient_orientation;
    $reviewIDArray = ($galleryData->reviews_id)?unserialize($galleryData->reviews_id):array();
    $mainWigetClassName ='';
    $styleSetting ='';
@endphp
<style type="text/css">
    .previewWidgetBox .bbw_white_color {
        background-image: linear-gradient({{ $colorOrientation }}, #ffffff, #ffffff 98%) !important;
    }

    .previewWidgetBox .bbw_red_color {
        background-image: linear-gradient({{ $colorOrientation }}, #e93474, #541069 98%) !important;
    }

    .previewWidgetBox .bbw_yellow_color {
        background-image: linear-gradient({{ $colorOrientation }}, #f9d84a, #f9814a) !important;
    }

    .previewWidgetBox .bbw_orange_color {
        background-image: linear-gradient({{ $colorOrientation }}, #ef9d39, #d92a3f) !important;
    }

    .previewWidgetBox .bbw_green_color {
        background-image: linear-gradient({{ $colorOrientation }}, #93cf48, #076768) !important;
    }

    .previewWidgetBox .bbw_blue_color {
        background-image: linear-gradient({{ $colorOrientation }}, #4194f7 3%, #1b1f97 99%) !important;
    }

    .previewWidgetBox .bbw_purple_color {
        background-image: linear-gradient({{ $colorOrientation }}, #4d4d7c 1%, #1e1e40) !important;
    }
    .hidden{display: none;}


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
<input type="hidden" id="gallery-type" value="{{$galleryType}}">
<div
    class="gallery_slider_widget {{ $mainWigetClassName }} slides{{ ($galleryType == '') ? '' : $galleryType }} imgSize{{ ($imageSize == '') ? 'Medium' : ucfirst($imageSize) }} galleryType
    @if($galleryDesign == 'onerow')
    {{ '' }}
    @else
    {{ $galleryDesign == 'horizontal' ? 3 : 2 }}
    @endif
        " id="bbColorOrientationSection">
    <h2 class="reviewTitleBH {{ $allowTitle != 0 ? '' : 'hidden' }}"><strong
            class="reviewTitle">{{ $name == '' ? 'Gallery' : $name }}</strong>
        @if($reviewIDArray && is_array($reviewIDArray))
         <span>{{ @count($reviewIDArray) }} photos</span></h2>
        @endif
    @if($galleryDesign == 'onerow')
        <div class="arrow reviewArrowBH {{ $allowArrows != '0' ? '' : 'hidden' }}">
            <a href="javascript:void(0);" class="left_arrow" bb_direction="left" v-on:click="imageSlider(-1)"><img
                    src="{{ base_url() }}assets/images/widget/arrow-left.png"></a>
            <a href="javascript:void(0);" class="right_arrow" bb_direction="right"><img
                    src="{{ base_url() }}assets/images/widget/arrow-right.png" v-on:click="imageSlider(1)"></a>
        </div>
        <div style="overflow:hidden; float:left; width:100%;"
             class="@if($galleryData->allow_border_shadow == 1) borderBoxShadow @endif">
            <div class="middle previewWidgetBox" style="width:5000px; float:left;">
                @php
                $styleSetting ='';
                    if(is_array($reviewIDArray) && @count($reviewIDArray) > 0 && $reviewIDArray[0] > 0){
                        foreach($reviewIDArray as $reviewId){
                            $reviewData = \App\Models\ReviewsModel::getReviewDetailsByReviewID($reviewId);

                            $reviewImageArray = unserialize($reviewData[0]->media_url);
                            if(count($reviewImageArray)>0)
                            {
                            $imageUrl = $reviewImageArray[0]['media_url'];
                            $cropedImageUrl = $reviewData[0]->croped_image_url;
                            }
                            else
                            {
                                $imageUrl = "";
                                $cropedImageUrl = "";
                            }

                            if($cropedImageUrl == ''){
                                $imagePath = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$imageUrl;
                            }else{
                                $imagePath = "data:image/jpg;base64,".$cropedImageUrl;
                            }

                            if($widgetBgcolor == 1){
                                if($galleryData->bg_color_type == ''){
                                    $styleSetting = $galleryData->solid_color == '' ? 'background:#FF0000!important' : 'background:' . $galleryData->solid_color . '!important; padding:'.$borderThickness.'px!important;';
                                }else{
                                    $styleSetting = 'padding:'.$borderThickness.'px!important;';
                                }
                            }else{
                                $styleSetting = 'background:none!important; padding:0px!important;';
                            }
                @endphp
                <div class="box_1 sliderImage {{ 'bbw_'.$gradientColor.'_color' }}" style="{{ $styleSetting }}">
                    <div class="top_div">
                        <a href="javascript:void(0);" class="showReviewPopup" review-id="{{ $reviewId }}">
                            <img src="{{ $imagePath }}" class="" alt="">
                        </a>
                    </div>
                    <div class="img_overlay showReviewPopup" review-id="{{ $reviewId }}">SHOP THE LOOK</div>
                </div>
                @php
                    }
                }
                @endphp
                @if(is_array($reviewIDArray))
                    @for($i = count($reviewIDArray); $i < $galleryType; $i++)
                    <div class="box_1 sliderImage {{ 'bbw_'.$gradientColor.'_color' }}" style="{{ $styleSetting }}">
                        <div class="top_div">
                            <a href="javascript:void(0);" class="showNotFoundPopup">
                                <img src="{{ base_url() }}/assets/images/temp_prev9.png" class="" alt="">
                            </a>
                        </div>
                        <div class="img_overlay showNotFoundPopup">SELECT IMAGE</div>
                    </div>
                @endfor
                @endif;
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="footer_div">
            <div class="left"><img src="{{ base_url() }}assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
            <div class="right reviewRatingsBH {{ $allowRating != '0' ? '' : 'hidden' }}">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <span> &nbsp; {{ @count($reviewIDArray) }} Reviews</span></div>
        </div>

    @elseif($galleryDesign == 'square')
        <div class="@if($galleryData->allow_border_shadow == 1) borderBoxShadow @endif">
            <div class="middle previewWidgetBox">
                @php
                    if(is_array($reviewIDArray) && count($reviewIDArray) > 0 && $reviewIDArray[0] > 0){
                        foreach($reviewIDArray as $key=>$reviewId){
                            if($key <= 3){
                            $reviewData = \App\Models\ReviewsModel::getReviewDetailsByReviewID($reviewId);
                            $reviewImageArray = unserialize($reviewData[0]->media_url);
                            $imageUrl = $reviewImageArray[0]['media_url'];
                            $cropedImageUrl = $reviewData[0]->croped_image_url;

                            if($cropedImageUrl == ''){
                                $imagePath = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$imageUrl;
                            }else{
                                $imagePath = "data:image/jpg;base64,".$cropedImageUrl;
                            }

                            if($widgetBgcolor == 1){
                                if($galleryData->bg_color_type == ''){
                                    $styleSetting = $galleryData->solid_color == '' ? 'style="background:#FF0000!important"' : 'style="background:' . $galleryData->solid_color . '!important; padding:'.$borderThickness.'px!important;"';
                                }else{
                                    $styleSetting = 'style="padding:'.$borderThickness.'px!important;"';
                                }
                            }else{
                                $styleSetting = 'style="background:none!important; padding:0px!important;"';
                            }
                @endphp
                <div class="box_1 sliderImage {{ 'bbw_'.$gradientColor.'_color' }}" {{ $styleSetting }}>
                    <div class="top_div">
                        <a href="javascript:void(0);" class="showReviewPopup" review-id="{{ $reviewId }}">
                            <img src="{{ $imagePath }}" class="" alt="">
                        </a>
                    </div>
                    <div class="img_overlay showReviewPopup" review-id="{{ $reviewId }}">SHOP THE LOOK</div>
                </div>
                @if($key == 1)
                    <div class="clearfix"></div>
                @endif
                @php
                    }
                   }
                }
                @endphp
                @if(is_array($reviewIDArray))
                    @for($i = count($reviewIDArray); $i < 4; $i++)
                        <div class="box_1 sliderImage {{ 'bbw_'.$gradientColor.'_color' }}" {{ $styleSetting }}>
                            <div class="top_div">
                                <a href="javascript:void(0);" class="showNotFoundPopup">
                                    <img src="{{ base_url() }}/assets/images/temp_prev9.png" class="" alt="">
                                </a>
                            </div>
                            <div class="img_overlay showNotFoundPopup">SELECT IMAGE</div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="footer_div">
            <div class="left"><img src="{{ base_url() }}assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
            <div class="right reviewRatingsBH {{ $allowRating != '0' ? '' : 'hidden' }}">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <span> &nbsp; {{ count($reviewIDArray) }} Reviews</span></div>
        </div>


    @elseif($galleryDesign == 'horizontal')
        <div class="@if($galleryData->allow_border_shadow == 1) borderBoxShadow @endif">
            <div class="middle previewWidgetBox">
                @php
                    if(is_array($reviewIDArray) && count($reviewIDArray) > 0 && $reviewIDArray[0] > 0){
                        foreach($reviewIDArray as $key=>$reviewId){
                            if($key <= 5){
                            $reviewData = \App\Models\ReviewsModel::getReviewDetailsByReviewID($reviewId);
                            $reviewImageArray = unserialize($reviewData[0]->media_url);
                            $imageUrl = $reviewImageArray[0]['media_url'];
                            $cropedImageUrl = $reviewData[0]->croped_image_url;

                            if($cropedImageUrl == ''){
                                $imagePath = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$imageUrl;
                            }else{
                                $imagePath = "data:image/jpg;base64,".$cropedImageUrl;
                            }

                            if($widgetBgcolor == 1){
                                if($galleryData->bg_color_type == ''){
                                    $styleSetting = $galleryData->solid_color == '' ? 'style="background:#FF0000!important"' : 'style="background:' . $galleryData->solid_color . '!important; padding:'.$borderThickness.'px!important;"';
                                }else{
                                    $styleSetting = 'style="padding:'.$borderThickness.'px!important;"';
                                }
                            }else{
                                $styleSetting = 'style="background:none!important; padding:0px!important;"';
                            }
                @endphp
                <div class="box_1 sliderImage {{ 'bbw_'.$gradientColor.'_color' }}" {{ $styleSetting }}>
                    <div class="top_div">
                        <a href="javascript:void(0);" class="showReviewPopup" review-id="{{ $reviewId }}">
                            <img src="{{ $imagePath }}" class="" alt="">
                        </a>
                    </div>
                    <div class="img_overlay showReviewPopup" review-id="{{ $reviewId }}">SHOP THE LOOK</div>
                </div>
                @if($key == 2)
                    <div class="clearfix"></div>
                @endif
                @php
                    }
                }
            }
                @endphp
                @if(is_array($reviewIDArray))
                @for($i = count($reviewIDArray); $i < 6; $i++)
                    <div class="box_1 sliderImage {{ 'bbw_'.$gradientColor.'_color' }}" {{ $styleSetting }}>
                        <div class="top_div">
                            <a href="javascript:void(0);" class="showNotFoundPopup">
                                <img src="{{ base_url() }}/assets/images/temp_prev9.png" class="" alt="">
                            </a>
                        </div>
                        <div class="img_overlay showNotFoundPopup">SELECT IMAGE</div>
                    </div>
                @endfor
                @endif
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="footer_div">
            <div class="left"><img src="{{ base_url() }}assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
            <div class="right reviewRatingsBH {{ $allowRating != '0' ? '' : 'hidden' }}">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
                <span> &nbsp; {{ count($reviewIDArray) }} Reviews</span></div>
        </div>
    @elseif($galleryDesign == 'vertical')
    <div class="@if($galleryData->allow_border_shadow == 1) borderBoxShadow @endif">
        <div class="middle previewWidgetBox">
            @php
                if(is_array($reviewIDArray) && count($reviewIDArray) > 0 && $reviewIDArray[0] > 0){
                    foreach($reviewIDArray as $key=>$reviewId){
                        if($key <= 5){
                        $reviewData = \App\Models\ReviewsModel::getReviewDetailsByReviewID($reviewId);
                        $reviewImageArray = unserialize($reviewData[0]->media_url);
                        $imageUrl = $reviewImageArray[0]['media_url'];
                        $cropedImageUrl = $reviewData[0]->croped_image_url;

                        if($cropedImageUrl == ''){
                            $imagePath = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$imageUrl;
                        }else{
                            $imagePath = "data:image/jpg;base64,".$cropedImageUrl;
                        }

                        if($widgetBgcolor == 1){
                            if($galleryData->bg_color_type == ''){
                                $styleSetting = $galleryData->solid_color == '' ? 'style="background:#FF0000!important"' : 'style="background:' . $galleryData->solid_color . '!important; padding:'.$borderThickness.'px!important;"';
                            }else{
                                $styleSetting = 'style="padding:'.$borderThickness.'px!important;"';
                            }
                        }else{
                            $styleSetting = 'style="background:none!important; padding:0px!important;"';
                        }
            @endphp
            <div class="box_1 sliderImage {{ 'bbw_'.$gradientColor.'_color' }}" {{ $styleSetting }}>
                <div class="top_div">
                    <a href="javascript:void(0);" class="showReviewPopup" review-id="{{ $reviewId }}">
                        <img src="{{ $imagePath }}" class="" alt="">
                    </a>
                </div>
                <div class="img_overlay showReviewPopup" review-id="{{ $reviewId }}">SHOP THE LOOK</div>
            </div>
            @if($key == 1 || $key == 3)
                <div class="clearfix"></div>
            @endif

            @php
                }
            }
        }
            @endphp
            @if(is_array($reviewIDArray))
            @for($i = count($reviewIDArray); $i < 6; $i++)
                <div class="box_1 sliderImage {{ 'bbw_'.$gradientColor.'_color' }}" {{ $styleSetting }}>
                    <div class="top_div">
                        <a href="javascript:void(0);" class="showNotFoundPopup">
                            <img src="{{ base_url() }}/assets/images/temp_prev9.png" class="" alt="">
                        </a>
                    </div>
                    <div class="img_overlay showNotFoundPopup">SELECT IMAGE</div>
                </div>
            @endfor
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="footer_div">
        <div class="left"><img src="{{ base_url() }}assets/images/widget/ask-icon.png"> Powered by BrandBoost</div>
        <div class="right reviewRatingsBH {{ $allowRating != '0' ? '' : 'hidden' }}">
            <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
            <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
            <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
            <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
            <img src="{{ base_url() }}assets/images/widget/yellow_icon.png">
            <span> &nbsp; {{ @count($reviewIDArray) }} Reviews</span></div>
    </div>

@endif
