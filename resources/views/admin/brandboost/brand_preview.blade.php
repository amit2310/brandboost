@php
if ($brandData->header_color_fix == "0" && $brandData->header_color_custom == "0" && $brandData->header_color_solid == "0") {
    $brandData->area_type = '1';
    $brandData->header_color_custom = '1';
    $brandData->header_color = 'blue';
    $brandData->header_custom_color1 = '#7ec662';
    $brandData->header_custom_color2 = '#007274';
    $brandData->header_solid_color = '#904242';
    $brandData->header_solid_color = '#904242';
    $brandData->header_color = 'green';
}
if ($brandData->area_type == '1') {
    if ($brandData->color_orientation_top == 'circle') {
        $Btype_area1 = 'radial-gradient';
    } else {
        $Btype_area1 = 'linear-gradient';
    }
}
if ($brandData->area_type == '2') {
    if ($brandData->color_orientation_full == 'circle') {
        $Btype_area2 = 'radial-gradient';
    } else {
        $Btype_area2 = 'linear-gradient';
    }
}


if ($brandData->header_color == 'blue') {
    $headercolor1 = '#4d4d7c';
    $headercolor2 = '#1e1e40';
} else if ($brandData->header_color == 'red') {
    $headercolor1 = '#e93474';
    $headercolor2 = '#541069';
} else if ($brandData->header_color == 'yellow') {
    $headercolor1 = '#f9d84a';
    $headercolor2 = '#f9814a';
} else if ($brandData->header_color == 'orange') {
    $headercolor1 = '#ef9d39';
    $headercolor2 = '#d92a3f';
} else if ($brandData->header_color == 'green') {
    $headercolor1 = '#93cf48';
    $headercolor2 = '#076768';
} else if ($brandData->header_color == 'purple') {
    $headercolor1 = '#4d4d7c';
    $headercolor2 = '#1e1e40';
}
@endphp

<style>
<?php if ($brandData->header_color_fix == '1' && getColorName($brandData->header_color) == 'white') { ?>
        .white_preview_1 .white_box a{color: #09204f!important}
        .white_preview_1 .customColor {color: #ccc!important}
        .white_preview_1 .customColorBar{background-color: #ccc!important}
<?php } else { ?>
        .customColor, .customColor i{color:<?php
    if ($brandData->header_color_fix == '1') {
        echo getColorName($brandData->header_color);
    }
    ?><?php
    if ($brandData->header_color_custom == '1') {
        echo $brandData->header_custom_color1;
    }
    ?><?php
    if ($brandData->header_color_solid == '1') {
        echo $brandData->header_solid_color;
    }
    ?>!important}
        .customColorBar{background-color:<?php
    if ($brandData->header_color_fix == '1') {
        echo getColorName($brandData->header_color);
    }
    ?><?php
    if ($brandData->header_color_custom == '1') {
        echo $brandData->header_custom_color1;
    }
    ?><?php
         if ($brandData->header_color_solid == '1') {
             echo $brandData->header_solid_color;
         }
         ?>}
     <?php }
     ?>

</style>
<div class="brand_page_pr Parent <?php if ($brandData->area_type == '2' && $brandData->color_orientation_full == "") {
         echo $brandData->header_color_fix == '1' ? $brandData->header_color . '_preview_1' : '';
         ?>" style="<?php echo $brandData->header_color_solid == '1' ? 'background:' . $brandData->header_solid_color : ''; ?> <?php
        echo $brandData->header_color_custom == '1' ? 'background-image:linear-gradient(45deg, ' . $brandData->header_custom_color1 . ' 1%, ' . $brandData->header_custom_color2 . ')' : '';
    } else if ($brandData->area_type == '2' && $brandData->color_orientation_full != "") {
        ?>"
         style="<?php echo $brandData->header_color_solid == '1' ? 'background:' . $brandData->header_solid_color : ''; ?>
             <?php
             echo $brandData->header_color_custom == '1' ? 'background-image:' . $Btype_area2 . '(' . $brandData->color_orientation_full . ', ' . $brandData->header_custom_color1 . ' 1%, ' . $brandData->header_custom_color2 . ')' : '';
             echo $brandData->header_color_fix == '1' ? 'background-image:' . $Btype_area2 . '(' . $brandData->color_orientation_full . ', ' . $headercolor1 . ' 1%, ' . $headercolor2 . ')' : '';
         }
         ?>">


    <div class="brand_page_gr headerbg <?php
         if ($brandData->area_type == '1' && $brandData->color_orientation_top == "") {
             echo $brandData->header_color_fix == '1' ? $brandData->header_color . '_preview_1' : '';
             ?>"
             style="<?php echo $brandData->header_color_solid == '1' ? 'background:' . $brandData->header_solid_color : ''; ?>
                    <?php
                    echo $brandData->header_color_custom == '1' ? 'background-image:linear-gradient(45deg, ' . $brandData->header_custom_color1 . ' 1%, ' . $brandData->header_custom_color2 . ')' : '';
                } else if ($brandData->area_type == '1' && $brandData->color_orientation_top != "") {
                    ?>"
             style="<?php echo $brandData->header_color_solid == '1' ? 'background:' . $brandData->header_solid_color : ''; ?>
                    <?php
                    echo $brandData->header_color_custom == '1' ? 'background-image:' . $Btype_area1 . '(' . $brandData->color_orientation_top . ', ' . $brandData->header_custom_color1 . ' 1%, ' . $brandData->header_custom_color2 . ')' : '';
                    echo $brandData->header_color_fix == '1' ? 'background-image:' . $Btype_area1 . '(' . $brandData->color_orientation_top . ', ' . $headercolor1 . ' 1%, ' . $headercolor2 . ')' : '';
                }
                ?>">



        <div class="page_header">
            <div class="col-md-6">
                        @if ($brandData->company_logo == "")
                    <img class="company_avatar top_1 br5" src="{{ base_url('assets/images/avatar_defaut_logo.png') }}"
                         alt="" width="100" style="max-height:50px">
                        @else
                    <img class="company_avatar top_1 br5" src="https://s3-us-west-2.amazonaws.com/brandboost.io/{{ $brandData->company_logo }}"
                         alt="" width="100" style="max-height:50px">
                        @endif
            </div>
            <div class="col-md-6 text-right"><a href="" class="txt_white">FAQ</a></div>
        </div>
    </div>

    <div class="container subarea " style="background:none;">
        <div class="row">
            <div class="col-md-12">
                <div class="white_box inline_block top_sec">
                    <div class="col-md-1 pr avatarSection" style="display: {{ ($brandData->avatar == '1' || $brandData->avatar == '') ? 'block' : 'none' }}">
                        @if ($brandData->company_header_logo == "")
                            <img  src="{{ base_url('assets/images/default-logo.png') }}"
                                  alt=""  width="95" height="95" class="rounded company_header_avatar bot1">
                        @else
                            <img  src="https://s3-us-west-2.amazonaws.com/brandboost.io/{{ $brandData->company_header_logo }}"
                                  alt="" width="95" height="95" class="rounded company_header_avatar bot1" >
                        @endif
                    </div>
                    <div class="col-md-11 pl30">
                        @php
                        //pre($brandData);
                        if ($brandData->about_company_position == 'left') {
                            $acpfloat = 'left';
                        } else {
                            $acpfloat = 'right';
                        }

                        if ($brandData->review_list_position == 'left') {
                            $rlpFloat = 'right';
                        } else {
                            $rlpFloat = 'left';
                        }

                        if ($brandData->rating == 'off') {
                            $starRating = 'none';
                        } else {
                            $starRating = 'block';
                        }
                        @endphp
                        {{--About Company Block--}}
                        <div class="col-md-6 aboutCompanySection" style="float: {{ $acpfloat }}">
                            <div class="col-md-9">
                                <input type="hidden" id="default_brand_title" value="{{-- $brandboostData->brand_title --}}">
                                <textarea id="default_brand_desc" style="display:none;">{{-- $brandboostData->brand_desc --}}</textarea>
                                <h4 class="fw500 txt_dgrey mb0 company_name">{{ ($brandData->company_info > 0 || empty($brandData)) ? '' : $brandData->company_info_name }}</h4>
                                <p class="mb30 fsize13"><span class="ratingSection" style="display: {{ $starRating }}"><span><i class="icon-star-full2 fsize11 txt_yellow"></i> <i class="icon-star-full2 fsize11 txt_yellow"></i> <i class="icon-star-full2 fsize11 txt_yellow"></i> <i class="icon-star-full2 fsize12 txt_yellow"></i> <i class="icon-star-full2 fsize11 txt_grey"></i> </span>  <span class="ml10 fsize14 fw700">4.2</span></span> <span class="ml10">139 customer reviews &nbsp;</span> <span class="inline_block">742 questions &amp; answers</span></p>
                                <p class="fsize12 mb20 txt_dgrey lh20 companySection company_description" {{ ($brandData->company_description == '1' || $brandData->company_description == '') ? '' : 'style="display:none;"' }}>
                                    {{ ($brandData->company_info > 0 || empty($brandData)) ? '' : nl2br($brandData->company_info_description) }}
                                </p>
                                <div class="walker_p servicesSection" {{ ($brandData->services == '1' || $brandData->services == '') ? '' : 'style="display:none;"' }}>
                                    <a href="#" class="customColor">Design Agency</a>
                                    <a href="#" class="customColor">Design &amp; Development</a>
                                    <a href="#" class="customColor">User Expirience Design</a>
                                    <a href="#" class="customColor">Logo</a>
                                </div>
                                <div class="contactUsBtnSection" {{ ($brandData->contact_button == '1' || $brandData->contact_button == '') ? '' : 'style="display:none;"' }}><button type="button" class="btn dark_btn">Contact Us</button></div>
                            </div>
                        </div>

                        {{--Social Media Block--}}
                        <div class="col-md-6 socialMediaSection">
                            <div class="interactions p15 contactInfoSection" {{ ($brandData->contact_info == '1' || $brandData->contact_info == '') ? '' : 'style="display:none;"' }}>
                                <ul>
                                    <li><small><i class="icon-location3 mr10"></i>Country</small> <strong><img src="{{ base_url() }}assets/images/un_flag.png" alt=""> United States</strong></li>
                                    <li><small><i class="icon-city mr10"></i>City</small> <strong><span class="brig pr10 mr10">San-Francisco</span>  Worlwide</strong></li>
                                    <li><small><i class="icon-phone2 mr10"></i>Phone number</small> <strong>+3 8063 612 53 69</strong></li>
                                    <li><small><i class="fa fa-globe mr10"></i>Website</small> <strong>www.wakers.co</strong></li>
                                    <li><small><i class="icon-mail5 mr10"></i>Email</small> <strong>info@wakers.co</strong></li>
                                </ul>
                            </div>

                            <div class="brand_social pl10 socialSection" {{ ($brandData->socials == '1' || $brandData->socials == '') ? '' : 'style="display:none;"' }}>
                                <a href="#" class="customColor"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="customColor"><i class="icon-bubble"></i></a>
                                <a href="#" class="customColor"><i class="icon-paperplane"></i></a>
                                <a href="#" class="customColor"><i class="icon-youtube"></i></a>
                                <a href="#" class="customColor"><i class="icon-twitter"></i></a>
                                <a href="#" class="customColor"><i class="icon-instagram"></i></a>
                                <a href="#" class="customColor"><i class="fa fa-google"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div><!--row-->



        <!-- layer box 1-->
        <div class="row template_layers layer_1" @if ($brandData->template_style == 1 || $brandData->template_style == "0") style="display: block;" @else style="display: none;" @endif>
            <div class="brand_side mt-10">

                <div class="col-md-4 mediaSection">

                    <!-- Customer Experiance box-->
                    @include("admin.brandboost.brand_config_layers.customer_experiance_box")
                    <!-- Customer Experiance box-->

                    @include("admin.brandboost.brand_config_layers.review_box_1")
                </div>
                <!-- Review box-->
                <div class="col-md-8 reviewSection">

                    <!-- company info box-->
                    @include("admin.brandboost.brand_config_layers.company_info_box")
                    <!-- company info box-->

                    <!-- Media box-->
                    @include("admin.brandboost.brand_config_layers.media_box")
                    <!-- Media box-->

                </div>
                <!-- Review box-->

            </div>
        </div>
        <!-- layer box 1-->



        <!-- layer box 2-->
        <div class="row template_layers layer_2"  @if($brandData->template_style==2)  style="display: block;" @else style="display: none;" @endif>
             <div class="brand_side mt-10">

                <div class="col-md-4 reviewSection">
                    @include("admin.brandboost.brand_config_layers.review_box_1")

                </div>
                <!-- Review box-->
                <div class="col-md-8 mediaSection">

                    <!-- Media box-->
                    @include("admin.brandboost.brand_config_layers.media_box")
                    <!-- Media box-->


                </div>
                <!-- Review box-->

            </div>
        </div>
        <!-- layer box 2-->

        <!-- layer box 3-->
        <div class="row template_layers layer_3"  @if($brandData->template_style==3){ ?> style="display: block;" @else style="display: none;" @endif>

             <div class="brand_side mt-10">

                <div class="col-md-4 mediaSection">

                    <!-- company info box-->
                    @include("admin/brandboost/brand_config_layers/company_info_box")
                    <!-- company info box-->


                    <!-- Media box-->
                    @include("admin.brandboost.brand_config_layers.media_box")
                    <!-- Media box-->
                </div>
                <div class="col-md-8 reviewSection">
                    <!-- Review box-->
                    @include("admin.brandboost.brand_config_layers.review_box")
                    <!-- Review box-->



                </div>
            </div>

        </div>
        <!-- layer box 3-->



    </div>
</div>
