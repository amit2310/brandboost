@extends('layouts.main_template') 

@section('title')
<?php //echo $title;
 ?>
@endsection

@section('contents')

<link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/pickers/color/spectrum.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/picker_color.js"></script>
<?php
 $tb1active = "";
 $tb2active = "";
 $tb3active="";
 $brandboostData="";
 $company_logo1 = "";
 $company_logo = "";
 $tb0active="";


 if(!empty($_GET['tab']) && $_GET['tab'] =='3')
 {
    $tb3active = "active";   
 }
 else
 {
     $tb0active = "active";   
 }

?>


<style type="text/css">
.info_media{box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);border-radius: 5px; width: 100%;}
        .brand_info_pop .modal-header{background: none !important;}
        .brand_info_pop .modal-dialog{max-width: 724px; width: 100%;}
        .brand_info_pop .review_source .inner {text-align: center;border-radius: 6px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;border-bottom-color: rgb(227, 233, 243);border-bottom-style: solid;border-bottom-width: 1px;position: relative;padding: 23px; min-height: 235px;}
        .brand_info_pop .review_source label{width: 100%;} 
        .brand_info_pop .review_source .inner:hover {border: 1px solid #da97af !important;}
        .brand_info_pop .review_source .inner figure{margin-bottom: 24px;}
        
        .brand_info_pop .review_source .inner a.bot_txt{display: block; padding: 15px 0 0 0; text-align: center; color: #09204f; font-size: 14px; font-weight: 500; border-top: 1px solid #f4f6fa}
        .brand_info_pop .review_source .inner a.bot_txt:hover, .brand_info_pop .review_source .inner a.bot_txt.active{color: #962e6c;}
        
        
        
 .brand_info_listing .custmo_checkbox {position: absolute;   height: 24px; width: 24px; padding-left: 24px; top: 0px; right: 0px;}
 .brand_info_listing .custmo_checkmark {border-radius:4px; border: none; height: 24px; width: 24px;}
 .brand_info_listing .custmo_checkmark::after {left: 14px;  top: 3px;   width: 4px; height: 7px; border-width: 0 1px 1px 0;}
 .brand_info_listing .custmo_checkbox input:checked ~ .custmo_checkmark.red_tr {    border:none!important;  background: url(/assets/images/checkmark_bkg_red.png) top right no-repeat!important;}
        
        
        .bkg_red3{background: #962e6c !important}
        .brand_info_pop .cancel_info{height: auto; border-bottom: 1px solid #3e9ef !important; border: 0; border-radius: 0; color: #962e6c;font-weight: 500;}
        .panel-heading .nav-tabs > li.active > a, .panel-heading .nav-tabs > li.active > a:hover, .panel-heading .nav-tabs > li.active > a:focus {  color: #962e6c!important;}

    .dropzone .dz-default.dz-message:before { content: ''!important; }
    .dropzone {min-height:40px;}
    .dropzone .dz-default.dz-message{ top: 0%!important; height:40px;  margin-top:0px;}
    .dropzone .dz-default.dz-message span {    font-size: 13px;    margin-top: -10px;}
    .dropzone .dz-preview.dz-image-preview { display:none !important;}
    a.txt_dark.bbot:hover { color: #962e6c!important; }
    .brand_page_pr .brand_product_review li a {
        margin: 0 10px 0 0!important;
	}
	.container.subarea{padding: 0 100px!important;}
	
	
	.tablet_box{width: 680px;    border-radius: 14.4px;  box-shadow: 0 2.2px 4.4px 0 rgba(1, 21, 64, 0.04);  border: solid 1.1px #ebeff6;  background-color: #fff; padding: 14px; position: relative; margin: 0 auto; /*transform: scale(0.9);*/} 	
	.tablet_box .tablet_box_bkg{  border-radius: 4.4px; height: 856px;   border: solid 1.1px #f4f6fa;   background-image: linear-gradient(150deg, #ffffff, #eff2f7);}
	.tablet_box .tablet_box_bkg .bb_rw01{ transform: scale(0.8); bottom: -25px;right: 0;}
			
	.mobile_box{width: 425px;    border-radius: 45px;  box-shadow: 0 2.2px 4.4px 0 rgba(1, 21, 64, 0.04);  border: solid 1.1px #ebeff6;  background-color: #fff; padding: 14px; position: relative; margin: 0 auto; transform: scale(0.9);} 	
	.mobile_box .mobile_box_bkg{  border-radius: 34px; height: 870px;   border: solid 1.1px #f4f6fa;   background-image: linear-gradient(150deg, #ffffff, #eff2f7);}
	
	
	#Desktopver{background: url(<?php echo base_url(); ?>assets/images/config_bkg_bk2_overlay.png) center top no-repeat; background-size:100% auto; padding-top: 86px;}
	#Desktopver img.w100.browserimg {position: absolute;top: 20px;	z-index: 0;width: 97%!important}
	/*#Desktopver{overflow: hidden; height: 900px;}
	#Desktopver:hover{overflow: auto; }*/
	#Desktopver .leftPosition {		position: relative;	z-index: 9;}
	#Desktopver .brand_page_pr .interactions ul li small{width: 125px;}
	#Desktopver .brand_page_pr .white_box{padding:45px 0}
	
	#Tabletver .container.subarea{padding: 0 10px!important;}
	#Tabletver .white_box.inline_block.top_sec{padding: 30px 0!important}
	#Tabletver .col-md-11.pl30{width: 100%; padding: 0!important}
	#Tabletver .tablet_box .tablet_box_bkg{overflow: hidden}
	#Tabletver .tablet_box .tablet_box_bkg:hover{overflow: auto}
	#Tabletver .col-md-4.mediaSection, #Tabletver .col-md-8.reviewSection{width: 100%}
	#Tabletver .aboutCompanySection{width: 100%;}
	#Tabletver .socialMediaSection{width: 100%;}
	#Tabletver .brand_media .col-md-6{width: 33%!important}
	#Tabletver .aboutCompanySection .col-md-9{width: 100%}
	#Tabletver .reviewSection, #Tabletver .mediaSection{width: 100%!important}
	
	
	
	#Phonever .container.subarea{padding: 0 10px!important;}
	#Phonever .white_box.inline_block.top_sec{padding: 30px 0!important}
	#Phonever .col-md-11.pl30{width: 100%; padding: 0!important}
	#Phonever .mobile_box .mobile_box_bkg{overflow: hidden}
	#Phonever .mobile_box .mobile_box_bkg:hover{overflow: auto}
	#Phonever .aboutCompanySection{width: 100%;}
	#Phonever .aboutCompanySection .col-md-9{width: 100%}
	#Phonever .socialMediaSection{width: 100%;}
	#Phonever .col-md-4.mediaSection, #Phonever .col-md-8.reviewSection{width: 100%}
	
	#Phonever .reviewSection, #Phonever .mediaSection{width: 100%!important}
	
</style>
<!-- Content area -->
<div class="content">
	
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img src="<?php echo base_url(); ?>/assets/images/brand_icon.png"/ style="width: 16px;"> Brand Page</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="<?php echo $tb0active; ?>"><a href="#right-icon-tab01" data-toggle="tab">Configuration</a></li>
                    <li class="<?php echo $tb1active; ?>"><a href="#right-icon-tab11" data-toggle="tab">Reviews</a></li>
                    <li class="<?php echo $tb2active; ?>"><a href="#right-icon-tab21" data-toggle="tab">Media</a></li>
                     <li class="<?php echo $tb3active; ?>"><a href="#right-icon-tab31" data-toggle="tab">FAQ</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">

                <!--<button type="button" class="btn dark_btn dropdown-toggle ml10" data-toggle="modal" data-target="#addContact"><i class="icon-plus3 txt_red"></i><span> &nbsp;  Add Media</span> </button>-->
                <button type="button" class="btn dark_btn dropdown-toggle ml10" data-toggle="modal" data-target="#addContact"><i class="icon-plus3 txt_red"></i><span> &nbsp;  Add Reviews</span> </button>
			   <button type="button" class="btn dark_btn dropdown-toggle ml10" data-toggle="modal" data-target="#addQuestion"><i class="icon-plus3 txt_red"></i><span> &nbsp; Add question</span> </button>
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

  @include ("admin.components.smart-popup.smart-widget-template-type")

    <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
    <div class="tab-content"> 
        <!--===========TAB 0=====Configuration======-->
        <div class="tab-pane <?php echo $tb0active; ?>" id="right-icon-tab01">
            <div class="row">
                <div class="col-md-3">
                    <!--=======Design & configuration=====-->
                    <div class="panel panel-flat">
                        <div class="panel-heading brand_config_tab">
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="active"><a href="#Configurations" data-toggle="tab" aria-expanded="false">Configurations</a></li>
                                <li class=""><a  href="#Design" data-toggle="tab" aria-expanded="false">Design</a></li>
                                <li class=""><a href="#Campaign" data-toggle="tab" aria-expanded="false">Campaigns</a></li>
                            </ul>
                        </div>
                        <div class="panel-body p0">
                            <div class="tab-content"> 
                                
                                <div class="tab-pane active" id="Configurations">
                                  <div class="profile_headings txt_upper p20 fsize11 fw600">Template<a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>

                                    <div class="form-group p20">
                                    <button id="newcampaign" class="btn h52 form-control w100" style="text-align: left; padding: 7px 23px!important;"><span>Horizontal Popup</span> <i class="pull-right txt_grey"><img src="<?php echo base_url(); ?>assets/images/icon_grid.png"></i></button>
                                    </div>


                                    <div class="profile_headings txt_upper p20 fsize11 fw600">Company info <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                    <form method="post" name="frmSubmit" id="frmSubmit" action="javascript:void(0);"  enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <div class="p20">
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    <div class="form-group mb10">

                                                        <p class="pull-left mb0">Avatar</p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field changeAction" action-type="avatar" type="checkbox" name="avatar_switch" id="avatar_switch" <?php echo ($brandData->avatar == '1' || $brandData->avatar == '') ? 'checked' : ''; ?> >
                                                            <span class="toggle dred"></span> 
                                                        </label>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group mb10">
                                                        <p class="pull-left mb0">Company description</p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field changeAction" action-type="company_description" type="checkbox" name="company_des_switch" id="company_des_switch" <?php echo ($brandData->company_description == '1' || $brandData->company_description == '') ? 'checked' : ''; ?>>
                                                            <span class="toggle dred"></span> </label>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group mb10">
                                                        <p class="pull-left mb0">Services</p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field changeAction" action-type="services" type="checkbox" name="services_switch" id="services_switch" <?php echo ($brandData->services == '1' || $brandData->services == '') ? 'checked' : ''; ?>>
                                                            <span class="toggle dred"></span> </label>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group mb10">
                                                        <p class="pull-left mb0">Contact Us Button</p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field changeAction" action-type="contact_btn" type="checkbox" name="contact_btn_switch" id="contact_btn_switch" <?php echo ($brandData->contact_button == '1' || $brandData->contact_button == '') ? 'checked' : ''; ?>>
                                                            <span class="toggle dred"></span> </label>
                                                        <div class="clearfix"></div>
                                                    </div>


                                                    <div class="form-group mb10">
                                                        <p class="pull-left mb0">Contact Info</p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field changeAction" action-type="contact_info" type="checkbox" name="contact_info_switch" id="contact_info_switch" <?php echo ($brandData->contact_info == '1' || $brandData->contact_info == '') ? 'checked' : ''; ?>>
                                                            <span class="toggle dred"></span> </label>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group mb10">
                                                        <p class="pull-left mb0">Socials</p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field changeAction" action-type="socials" type="checkbox" name="socials_switch" id="socials_switch" <?php echo ($brandData->socials == '1' || $brandData->socials == '') ? 'checked' : ''; ?>>
                                                            <span class="toggle dred"></span> </label>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group mb0">
                                                        <p class="pull-left mb0">Customer Experiance</p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field changeAction" action-type="customer_experiance" type="checkbox" name="customer_experiance_switch" id="customer_experiance_switch" <?php echo ($brandData->customer_experiance == '1' || $brandData->customer_experiance == '') ? 'checked' : ''; ?>>
                                                            <span class="toggle dred"></span> </label>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile_headings txt_upper p20 fsize11 fw600">Position on page <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>

                                        <div class="p20">
                                            <div class="card_sec p0">
                                                <div class="form-group select_box">
                                                    <label class="pull-left mb0">About company / Media </label>
                                                    <select name="about_company_position" id="about_company_position" class="selectbox_cls form-control changeAction" action-type="about_company">
                                                        <option value="left" <?php echo ($brandData->about_company_position == 'left' || $brandData->about_company_position == '') ? 'selected' : ''; ?>>Left</option>
                                                        <option value="right" <?php echo $brandData->about_company_position == 'right' ? 'selected' : ''; ?>>Right</option>
                                                    </select>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="form-group select_box">
                                                    <label class="pull-left mb0">Reviews list </label>
                                                    <select name="reviews_list_position" id="reviews_list_position" class="selectbox_cls form-control changeAction" action-type="review_list">
                                                        <option value="left" <?php echo $brandData->review_list_position == 'left' ? 'selected' : ''; ?>>Left</option>
                                                        <option value="right" <?php echo ($brandData->review_list_position == 'right' || $brandData->review_list_position == '') ? 'selected' : ''; ?>>Right</option>
                                                    </select>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="form-group select_box">
                                                    <label class="pull-left mb0">Rating (Reviews Summary) </label>
                                                    <select name="show_rating" id="show_rating" class="selectbox_cls form-control changeAction" action-type="rating">
                                                        <option value="">Show Rating</option>
                                                        <option value="on" <?php echo ($brandData->rating == 'on' || $brandData->rating == '') ? 'selected' : ''; ?>>On</option>
                                                        <option value="off" <?php echo $brandData->rating == 'off' ? 'selected' : ''; ?>>Off</option>
                                                    </select>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="clearfix"></div>
                                            </div>
                                        </div>


                                        <div class="profile_headings txt_upper p20 fsize11 fw600">Company info <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                        <div class="p20">
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    <div class="form-group mb10">

                                                        <p class="pull-left mb0">Show chat widget</p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field changeAction" action-type="chat_widget" type="checkbox" name="chat_widget_switch" id="chat_widget_switch" <?php echo ($brandData->chat_widget == '1') ? 'checked' : ''; ?>>
                                                            <span class="toggle dred"></span> </label>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group mb10">
                                                        <p class="pull-left mb0">Show email & referral widgets</p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field changeAction" action-type="referral_widget" type="checkbox" name="referral_widgets_switch" id="referral_widgets_switch" <?php echo ($brandData->referral_widget == '1') ? 'checked' : ''; ?>>
                                                            <span class="toggle dred"></span> </label>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="p20 btop">
                                            <input type="hidden" name="brandboost_id" id="brandboost_id" value="<?php echo Request::segment(4); ?>">
                                            <button type="submit" class="btn dark_btn bkg_dred w100" >Save</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="Design">
                                    <form method="post" name="frmDesignSubmit" id="frmDesignSubmit" action="javascript:void(0);"  enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="template_style" id="template_style" value="">
                                        <input type="hidden" name="area_type" id="area_type" value="<?php if($brandData->area_type == "") { echo '1';} else {  echo $brandData->area_type;  } ?>">
                                         <input type="hidden" value="<?php echo $brandData->color_orientation_full; ?>" id="color_orientation_full_value" name="color_orientation_full_value">
		                                  <input type="hidden" value="<?php echo $brandData->color_orientation_top; ?>" id="color_orientation_top_value" name="color_orientation_top_value">


                                        
                                        <div class="profile_headings txt_upper p20 fsize11 fw600">Page appearance <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>

                                        <div class="p20">
                                            <div class="barand_avatar mb20 hidden">
                                                <?php 
                                                //$brandboostData->logo_img1='';
                                                //$brandboostData->logo_img1='';
                                                ?>
                                                <img width="64" height="65" class="rounded" src="<?php //echo $brandboostData->logo_img1 == '' ? base_url('assets/images/default_table_img2.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brandboostData->logo_img; ?>"/>
                                                <img width="65" height="65" class="rounded" src="<?php echo $company_logo1 == '' ? base_url('assets/images/default_table_img2.png') : 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $company_logo; ?>"/>
                                            </div>
                                            <!--<p class="txt_upper fsize11 fw500 text-muted">Company Avatar</p>-->
                                            <div class="form-group">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">Company Avatar</label>
                                                <div class="input-group">
                                                    <input type="hidden" name="company_logo" id="company_logo" value="<?php echo $brandData->company_logo; ?>">

                                                    <span class="input-group-addon"><i class="icon-upload7"></i></span>
                                                    <div class="dropzone" id="myDropzone_logo_img"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">Header Avatar</label>
                                                <div class="input-group">
                                                    <input type="hidden" name="company_header_logo" id="company_header_logo" value="<?php echo $brandData->company_header_logo; ?>">

                                                    <span class="input-group-addon"><i class="icon-upload7"></i></span>
                                                    <div class="dropzone" id="myDropzone_company_header_logo"></div>
                                                </div>
                                            </div>

                                            <div class="mb0">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">Company info</label>
                                                <div class="form-group pull-right mb0">
                                                    <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">USE DEFAULT</p>
                                                    <label class="custom-form-switch pull-right">
                                                        <input class="field" type="checkbox" <?php echo ($brandData->company_info > 0 || empty($brandData)) ? 'checked' : ''; ?> name="company_info_switch" id="company_info_switch">
                                                        <span class="toggle dred"></span> </label>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="import_box p0">
                                                    <div id="default_company_info_box" <?php echo ($brandData->company_info > 0 || empty($brandData)) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                                                        <div class="p20 bbot">
                                                            <p class="mb0"><strong><?php //echo $brandboostData->brand_title; ?></strong></p>
                                                        </div>
                                                        <div class="p20">
                                                            <?php //echo $brandboostData->brand_desc; ?>
                                                        </div>
                                                    </div>
                                                    <div id="custom_company_info_box" <?php echo ($brandData->company_info > 0 || empty($brandData)) ? 'style="display:none;"' : 'style="display:block;"'; ?>>
                                                        <div class="p10 bbot">
                                                            <p class="mb0">
                                                                <strong>
                                                                    <input name="custom_company_name" id="custom_company_name" class="form-control" placeholder="Company Name" type="text" style="border:none; background:#FBFBFD; padding-left:10px;" value="<?php 
                                                                    echo $brandData->company_info_name == '' ? '' /*$brandboostData->brand_title*/ : $brandData->company_info_name; ?>">
                                                                </strong>
                                                            </p>
                                                        </div>
                                                        <div class="p10">
                                                            <textarea name="custom_company_description" style="border:none; background:#FBFBFD; padding-left:10px; padding-top:10px; height:190px;" id="custom_company_description" class="form-control"><?php echo $brandData->company_info_description == '' ? /*$brandboostData->brand_desc*/ '' : $brandData->company_info_description; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group p20">
                                           
                                        <select class="form-control h52" name="brand_themes" id="brand_themes">
                                        <option value="">Choose Brand Theme</option>
                                            <?php foreach($brandThemeData as $TConfigdata) { ?>
                                             <option <?php if($TConfigdata->id == '8') { ?> selected="selected" <?php } ?> value="<?php echo $TConfigdata->id; ?>"><?php echo $TConfigdata->brand_theme_title; ?></option>
                                            <?php } ?>
                                          </select>
                                        </div>
                                           <!--=======Top Area=====-->
                                        <div class="profile_headings txt_upper fsize11 fw600">Dual Pane Design <a class="pull-right plus_icon" href="javascript:void(0)"><label class="custom-form-switch pull-right">
                                                        <input class="field" <?php if($brandData->area_type == '1') { ?>checked<?php } ?> type="checkbox" name="topPlaneSecSwitch" id="topPlaneSecSwitch">
                                                        <span class="toggle green"></span> </label></a></div>
                                        <div class="p20" id="TopArea" <?php if($brandData->area_type == '1') { ?>style="display:block"<?php } else { ?>style="display:none"<?php } ?>>
                                     
                                            <div class="mb20">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">Single Color picker</label>
                                                <div class="form-group pull-right mb0">
                                                    <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Solid color</p>
                                                    <label class="custom-form-switch pull-right">
                                                        <input class="field" type="checkbox" <?php if($brandData->area_type == '1') { echo $brandData->header_color_solid < 1 ? '' : 'checked'; } ?> name="solid_color_switch" id="solid_color_switch">
                                                        <span class="toggle dred"></span> </label>
                                                    <div class="clearfix"></div>
                                                </div>
                                                        <div class="row solid_color_switch_div" style="<?php  
                                                        if($brandData->area_type == '1')
                                                        {
                                                            if($brandData->header_color_solid < 1 )
                                                            { echo "display:none";
                                                            } 
                                                            else
                                                            { 
                                                             echo "display:block"; 
                                                            }

                                                        }   else { echo "display:none";  } ?> ">
                                                    <div class="position-relative mt-5 col-md-12">
                                                        <input name="solid_color" class="form-control" id="solid_color" placeholder="#FF0000" type="text" value="<?php echo $brandData->header_solid_color == '' ? '#FF0000' : $brandData->header_solid_color; ?>">
                                                        <a style="position: absolute; top: 10px; right: 20px;" class="solidcolorpicker colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $brandData->header_solid_color == '' ? 'style="color:#FF0000"' : 'style="color:' . $brandData->header_solid_color . '"'; ?>></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">MAIN Gradient color</label>
                                                <div class="form-group pull-right mb0">
                                                    <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Gradient</p>
                                                    <label class="custom-form-switch pull-right">
                                                        <input class="field" type="checkbox" <?php if($brandData->area_type == '1') { echo ($brandData->header_color_fix > 0 || empty($brandData)) ? 'checked' : ''; } ?> name="main_color_switch" id="main_color_switch">
                                                        <span class="toggle dred"></span> </label>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="color_box main_color_switch_div" style="<?php  
                                                        if($brandData->area_type == '1')
                                                        {
                                                            if($brandData->header_color_fix < 1 )
                                                            { echo "display:none";
                                                            } 
                                                            else
                                                            { 
                                                            echo "display:block"; 
                                                            }

                                                        }  else { echo "display:none";  } ?> ">
                                                    <input type="hidden" name="main_colors" id="main_colors" value="<?php echo $brandData->header_color == '' ? 'green' : $brandData->header_color; ?>">
                                                    <div class="color_cube white selectMainColor <?php echo $brandData->header_color == 'white' ? 'active' : ''; ?>" color-data='white' color-class="white_preview_1"></div>
                                                    <div class="color_cube dred selectMainColor <?php echo $brandData->header_color == 'red' ? 'active' : ''; ?>" color-data='red' color-class="red_preview_1"></div>
                                                    <div class="color_cube yellow selectMainColor <?php echo $brandData->header_color == 'yellow' ? 'active' : ''; ?>" color-data='yellow' color-class="yellow_preview_1"></div>
                                                    <div class="color_cube red selectMainColor <?php echo $brandData->header_color == 'orange' ? 'active' : ''; ?>" color-data='orange' color-class="orange_preview_1"></div>
                                                    <div class="color_cube green selectMainColor <?php echo ($brandData->header_color == '' || $brandData->header_color == 'green') ? 'active' : ''; ?>" color-data='green' color-class="green_preview_1"></div>
                                                    <div class="color_cube blue selectMainColor <?php echo $brandData->header_color == 'blue' ? 'active' : ''; ?>" color-data='blue' color-class="blue_preview_1"></div>
                                                    <div class="color_cube black selectMainColor <?php echo $brandData->header_color == 'purple' ? 'active' : ''; ?>" color-data='purple' color-class="purple_preview_1"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                
                                                 <!--==========Choose orientation fix ==========-->
                                                <div class="row orientation_top_fix" style="<?php  
                                                        if($brandData->area_type == '1')
                                                        {
                                                            if($brandData->header_color_fix < 1 )
                                                            { echo "display:none";
                                                            } 
                                                            else
                                                            { 
                                                            echo "display:block"; 
                                                            }

                                                        }  else { echo "display:none";  } ?>">
                                                	<div class="col-md-12">
                                                		<div style="margin: 25px 0 15px!important;" class="profile_headings txt_upper fsize11 fw600">Choose orientation</div>
                                                	</div>
                                                	<div class="col-md-12">
                                                		<ul class="choose_orientation">
                                                			<li class="torighttop"><a class="<?php echo $brandData->color_orientation_top == 'to right top' ? 'active' : ''; ?>" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toright"><a class="<?php echo $brandData->color_orientation_top == 'to right' ? 'active' : ''; ?>" color-orientation="to right"  href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                                                			<li class="torightbottom"><a class="<?php echo $brandData->color_orientation_top == 'to right bottom' ? 'active' : ''; ?>" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                                                			<li class="tobottom"><a class="<?php echo $brandData->color_orientation_top == 'to bottom' ? 'active' : ''; ?>" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                                                			<li class="toleftbottom"><a class="<?php echo $brandData->color_orientation_top == 'to left bottom' ? 'active' : ''; ?>" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toleft"><a class="<?php echo $brandData->color_orientation_top == 'to left' ? 'active' : ''; ?>" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                                                			<li class="tolefttop"><a class="<?php echo $brandData->color_orientation_top == 'to left top' ? 'active' : ''; ?>" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                                                			<li class="totop"><a class="<?php echo $brandData->color_orientation_top == 'to top' ? 'active' : ''; ?>" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                                                			<li class="circle"><a class="<?php echo $brandData->color_orientation_top == 'circle' ? 'active' : ''; ?>" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                                                		</ul>
                                                	</div>
                                                </div>
                                                <!--==========Choose orientation fix  ==========-->
                                                
                                                
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">Gradient Color picker</label>
                                                <div class="form-group pull-right mb0">
                                                    <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Custom Gradient color</p>
                                                    <label class="custom-form-switch pull-right">
                                                        <input class="field" type="checkbox" <?php if($brandData->area_type == '1') { echo $brandData->header_color_custom < 1 ? '' : 'checked'; } ?> name="custom_color_switch" id="custom_color_switch">
                                                        <span class="toggle dred"></span> </label>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="row custom_color_switch_div" style="<?php  
                                                        if($brandData->area_type == '1')
                                                        {
                                                            if($brandData->header_color_custom < 1 )
                                                            { echo "display:none";
                                                            } 
                                                            else
                                                            { 
                                                            echo "display:block"; 
                                                            }

                                                        }  else { echo "display:none";  } ?> ">
                                                    <div class="position-relative mt-5 col-md-6">
                                                        <input name="custom_colors1" class="form-control" id="custom_colors1" placeholder="#000000" type="text" value="<?php echo $brandData->header_custom_color1 == '' ? '#000000' : $brandData->header_custom_color1; ?>">
                                                        <a style="position: absolute; top: 10px; right: 20px;" class="colorpicker1 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $brandData->header_custom_color1 == '' ? 'style="color:#000000"' : 'style="color:' . $brandData->header_custom_color1 . '"'; ?>></i></a>
                                                    </div>

                                                    <div class="position-relative mt-5 col-md-6">
                                                        <input name="custom_colors2" class="form-control" id="custom_colors2" placeholder="#FF0000" type="text" value="<?php echo $brandData->header_custom_color2 == '' ? '#FF0000' : $brandData->header_custom_color2; ?>">
                                                        <a style="position: absolute; top: 10px; right: 20px;" class="colorpicker2 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $brandData->header_custom_color2 == '' ? 'style="color:#FF0000"' : 'style="color:' . $brandData->header_custom_color2 . '"'; ?>></i></a>
                                                    </div>
                                                </div>
                                                
                                                  <!--==========Choose orientation custom==========-->
                                                <div class="row orientation_top" style="<?php  
                                                        if($brandData->area_type == '1')
                                                        {
                                                            if($brandData->header_color_custom < 1 )
                                                            { echo "display:none";
                                                            } 
                                                            else
                                                            { 
                                                            echo "display:block"; 
                                                            }

                                                        } else "display:none" ?> ">
                                                	<div class="col-md-12">
                                                		<div style="margin: 25px 0 15px!important;" class="profile_headings txt_upper fsize11 fw600">Choose orientation</div>
                                                	</div>
                                                	<div class="col-md-12">
                                                		<ul class="choose_orientation">
                                                			<li class="torighttop"><a class="<?php echo $brandData->color_orientation_top == 'to right top' ? 'active' : ''; ?>" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toright"><a class="<?php echo $brandData->color_orientation_top == 'to right' ? 'active' : ''; ?>" color-orientation="to right"  href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                                                			<li class="torightbottom"><a class="<?php echo $brandData->color_orientation_top == 'to right bottom' ? 'active' : ''; ?>" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                                                			<li class="tobottom"><a class="<?php echo $brandData->color_orientation_top == 'to bottom' ? 'active' : ''; ?>" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                                                			<li class="toleftbottom"><a class="<?php echo $brandData->color_orientation_top == 'to left bottom' ? 'active' : ''; ?>" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toleft"><a class="<?php echo $brandData->color_orientation_top == 'to left' ? 'active' : ''; ?>" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                                                			<li class="tolefttop"><a class="<?php echo $brandData->color_orientation_top == 'to left top' ? 'active' : ''; ?>" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                                                			<li class="totop"><a class="<?php echo $brandData->color_orientation_top == 'to top' ? 'active' : ''; ?>" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                                                			<li class="circle"><a class="<?php echo $brandData->color_orientation_top == 'circle' ? 'active' : ''; ?>" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                                                		</ul>
                                                	</div>
                                                </div>
                                                <!--==========Choose orientation custom ==========-->
                                                
                                                
                                            </div>
                                        </div>
                                         <!--=======Top Area=====-->
                                        
                                        
                                        
                                         
                                          <!--=======Bottom Area=====-->
                                          
                                          <div style="display:none" class="profile_headings txt_upper p20 fsize11 fw600">Bottom Body <a class="pull-right plus_icon" href="javascript:void(0)"></a></div>
                                        <div style="display:none" class="p20" id="BottomArea">
                                     
                                            <div class="mb20">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">Single Color picker</label>
                                                <div class="form-group pull-right mb0">
                                                    <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Solid color</p>
                                                    <label class="custom-form-switch pull-right">
                                                        <input class="field" type="checkbox" <?php echo $brandData->header_color_solid < 1 ? '' : 'checked'; ?> name="solid_color_switch_bottom" id="solid_color_switch_bottom">
                                                        <span class="toggle dred"></span> </label>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="position-relative mt-5 col-md-12">
                                                        <input name="solid_color_bottom" class="form-control" id="solid_color_bottom" placeholder="#FF0000" type="text" value="<?php echo $brandData->header_solid_color == '' ? '#FF0000' : $brandData->header_solid_color; ?>">
                                                        <a style="position: absolute; top: 10px; right: 20px;" class="solidcolorpicker colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $brandData->header_solid_color == '' ? 'style="color:#FF0000"' : 'style="color:' . $brandData->header_solid_color . '"'; ?>></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">MAIN Gradient color</label>
                                                <div class="form-group pull-right mb0">
                                                    <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Gradient</p>
                                                    <label class="custom-form-switch pull-right">
                                                        <input class="field" type="checkbox" <?php echo ($brandData->header_color_fix > 0 || empty($brandData)) ? 'checked' : ''; ?> name="main_color_switch_bottom" id="main_color_switch_bottom">
                                                        <span class="toggle dred"></span> </label>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="color_box">
                                                    <input type="hidden" name="main_colors_bottom" id="main_colors_bottom" value="<?php echo $brandData->header_color == '' ? 'green' : $brandData->header_color; ?>">
                                                    <div class="color_cube dred selectBottomMainColor <?php echo $brandData->header_color == 'red' ? 'active' : ''; ?>" color-data='red' color-class="red_preview_1"></div>
                                                    <div class="color_cube yellow selectBottomMainColor <?php echo $brandData->header_color == 'yellow' ? 'active' : ''; ?>" color-data='yellow' color-class="yellow_preview_1"></div>
                                                    <div class="color_cube red selectBottomMainColor <?php echo $brandData->header_color == 'orange' ? 'active' : ''; ?>" color-data='orange' color-class="orange_preview_1"></div>
                                                    <div class="color_cube green selectBottomMainColor <?php echo ($brandData->header_color == '' || $brandData->header_color == 'green') ? 'active' : ''; ?>" color-data='green' color-class="green_preview_1"></div>
                                                    <div class="color_cube blue selectBottomMainColor <?php echo $brandData->header_color == 'blue' ? 'active' : ''; ?>" color-data='blue' color-class="blue_preview_1"></div>
                                                    <div class="color_cube black selectBottomMainColor <?php echo $brandData->header_color == 'purple' ? 'active' : ''; ?>" color-data='purple' color-class="purple_preview_1"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">Gradient Color picker</label>
                                                <div class="form-group pull-right mb0">
                                                    <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Custom Gradient color</p>
                                                    <label class="custom-form-switch pull-right">
                                                        <input class="field" type="checkbox" <?php echo $brandData->header_color_custom < 1 ? '' : 'checked'; ?> name="custom_color_switch_bottom" id="custom_color_switch_bottom">
                                                        <span class="toggle dred"></span> </label>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="position-relative mt-5 col-md-6">
                                                        <input name="custom_colors1_bottom" class="form-control" id="custom_colors1_bottom" placeholder="#000000" type="text" value="<?php echo $brandData->header_custom_color1 == '' ? '#000000' : $brandData->header_custom_color1; ?>">
                                                        <a style="position: absolute; top: 10px; right: 20px;" class="colorpicker1 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $brandData->header_custom_color1 == '' ? 'style="color:#000000"' : 'style="color:' . $brandData->header_custom_color1 . '"'; ?>></i></a>
                                                    </div>

                                                    <div class="position-relative mt-5 col-md-6">
                                                        <input name="custom_colors2_bottom" class="form-control" id="custom_colors2_bottom" placeholder="#FF0000" type="text" value="<?php echo $brandData->header_custom_color2 == '' ? '#FF0000' : $brandData->header_custom_color2; ?>">
                                                        <a style="position: absolute; top: 10px; right: 20px;" class="colorpicker2 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $brandData->header_custom_color2 == '' ? 'style="color:#FF0000"' : 'style="color:' . $brandData->header_custom_color2 . '"'; ?>></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--=======Bottom Area=====-->
                                        
                                        
                                        
                                          <!--=======Full Area=====-->
                                          
                                          <div class="profile_headings txt_upper fsize11 fw600" style="margin-top:25px">Single Pane Design <a class="pull-right plus_icon" href="javascript:void(0)"><label class="custom-form-switch pull-right">
                                                        <input class="field" <?php if($brandData->area_type == '2') { ?>checked<?php } ?> type="checkbox" name="FullPlaneSecSwitch" id="FullPlaneSecSwitch">
                                                        <span class="toggle green"></span> </label></a></div>
                                        <div class="p20" id="FullArea" <?php if($brandData->area_type == '2') { ?>style="display:block"<?php } else { ?>style="display:none"<?php } ?>>
                                     
                                            <div class="mb20">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">Single Color picker</label>
                                                <div class="form-group pull-right mb0">
                                                    <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Solid color</p>
                                                    <label class="custom-form-switch pull-right">
                                                        <input class="field" type="checkbox" <?php if($brandData->area_type == '2') { echo $brandData->header_color_solid < 1 ? '' : 'checked'; } ?> name="solid_color_switch_full" id="solid_color_switch_full">
                                                        <span class="toggle dred"></span> </label>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="row solid_color_switch_full_div" style="<?php  
                                                        if($brandData->area_type == '2')
                                                        {
                                                            if($brandData->header_color_solid < 1 )
                                                            { echo "display:none";
                                                            } 
                                                            else
                                                            { 
                                                            echo "display:block"; 
                                                            }

                                                        }  else { echo "display:none";  } ?> ">
                                                    <div class="position-relative mt-5 col-md-12">
                                                        <input name="solid_color_full" class="form-control" id="solid_color_full" placeholder="#FF0000" type="text" value="<?php echo $brandData->header_solid_color == '' ? '#FF0000' : $brandData->header_solid_color; ?>">
                                                        <a style="position: absolute; top: 10px; right: 20px;" class="solidcolorpicker colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $brandData->header_solid_color == '' ? 'style="color:#FF0000"' : 'style="color:' . $brandData->header_solid_color . '"'; ?>></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">MAIN Gradient color</label>
                                                <div class="form-group pull-right mb0">
                                                    <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Gradient</p>
                                                    <label class="custom-form-switch pull-right">
                                                        <input class="field" type="checkbox" <?php if($brandData->area_type == '2') { echo ($brandData->header_color_fix > 0 || empty($brandData)) ? 'checked' : ''; } ?> name="main_color_switch_full" id="main_color_switch_full">
                                                        <span class="toggle dred"></span> </label>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="color_box main_color_switch_full_div" style="<?php  
                                                        if($brandData->area_type == '2')
                                                        {
                                                            if($brandData->header_color_fix < 1 )
                                                            { echo "display:none";
                                                            } 
                                                            else
                                                            { 
                                                            echo "display:block"; 
                                                            }

                                                        }   else { echo "display:none";  } ?> ">
                                                    <input type="hidden" name="main_colors_full" id="main_colors_full" value="<?php echo $brandData->header_color == '' ? 'green' : $brandData->header_color; ?>">
                                                    <div class="color_cube white selectFullMainColor <?php echo $brandData->header_color == 'white' ? 'active' : ''; ?>" color-data='white' color-class="white_preview_1"></div>
                                                    <div class="color_cube dred selectFullMainColor <?php echo $brandData->header_color == 'red' ? 'active' : ''; ?>" color-data='red' color-class="red_preview_1"></div>
                                                    <div class="color_cube yellow selectFullMainColor <?php echo $brandData->header_color == 'yellow' ? 'active' : ''; ?>" color-data='yellow' color-class="yellow_preview_1"></div>
                                                    <div class="color_cube red selectFullMainColor <?php echo $brandData->header_color == 'orange' ? 'active' : ''; ?>" color-data='orange' color-class="orange_preview_1"></div>
                                                    <div class="color_cube green selectFullMainColor <?php echo ($brandData->header_color == '' || $brandData->header_color == 'green') ? 'active' : ''; ?>" color-data='green' color-class="green_preview_1"></div>
                                                    <div class="color_cube blue selectFullMainColor <?php echo $brandData->header_color == 'blue' ? 'active' : ''; ?>" color-data='blue' color-class="blue_preview_1"></div>
                                                    <div class="color_cube black selectFullMainColor <?php echo $brandData->header_color == 'purple' ? 'active' : ''; ?>" color-data='purple' color-class="purple_preview_1"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                
                                                
                                                 <!--==========Choose orientation full fix ==========-->
                                                <div class="row orientation_fix" style="<?php  
                                                        if($brandData->area_type == '2')
                                                        {
                                                            if($brandData->header_color_fix < 1 )
                                                            { echo "display:none";
                                                            } 
                                                            else
                                                            { 
                                                            echo "display:block"; 
                                                            }

                                                        }   else { echo "display:none";  } ?> ">
                                                	<div class="col-md-12">
                                                		<div style="margin: 25px 0 15px!important;" class="profile_headings txt_upper fsize11 fw600">Choose orientation</div>
                                                	</div>
                                                	<div class="col-md-12">
                                                		<ul class="choose_orientation">
                                                			<li class="torighttop"><a class="<?php echo $brandData->color_orientation_full == 'to right top' ? 'active' : ''; ?>" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toright"><a class="<?php echo $brandData->color_orientation_full == 'to right' ? 'active' : ''; ?>" color-orientation="to right"  href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                                                			<li class="torightbottom"><a class="<?php echo $brandData->color_orientation_full == 'to right bottom' ? 'active' : ''; ?>" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                                                			<li class="tobottom"><a class="<?php echo $brandData->color_orientation_full == 'to bottom' ? 'active' : ''; ?>" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                                                			<li class="toleftbottom"><a class="<?php echo $brandData->color_orientation_full == 'to left bottom' ? 'active' : ''; ?>" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toleft"><a class="<?php echo $brandData->color_orientation_full == 'to left' ? 'active' : ''; ?>" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                                                			<li class="tolefttop"><a class="<?php echo $brandData->color_orientation_full == 'to left top' ? 'active' : ''; ?>" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                                                			<li class="totop"><a class="<?php echo $brandData->color_orientation_full == 'to top' ? 'active' : ''; ?>" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                                                			<li class="circle"><a class="<?php echo $brandData->color_orientation_full == 'circle' ? 'active' : ''; ?>" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                                                		</ul>
                                                	</div>
                                                </div>
                                                <!--==========Choose orientation full fix ==========-->
                                                
                                                
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label txt_upper fsize11 fw500 text-muted">Gradient Color picker</label>
                                                <div class="form-group pull-right mb0">
                                                    <p class="pull-left mb0 fsize11 fw500 text-muted mr-5">Custom Gradient color</p>
                                                    <label class="custom-form-switch pull-right">
                                                        <input class="field" type="checkbox" <?php if($brandData->area_type == '2') { echo $brandData->header_color_custom < 1 ? '' : 'checked'; } ?> name="custom_color_switch_full" id="custom_color_switch_full">
                                                        <span class="toggle dred"></span> </label>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="row custom_color_switch_full_div" style="<?php  
                                                        if($brandData->area_type == '2')
                                                        {
                                                            if($brandData->header_color_custom < 1 )
                                                            { echo "display:none";
                                                            } 
                                                            else
                                                            { 
                                                            echo "display:block"; 
                                                            }

                                                        } else { echo "display:none"; } ?> ">
                                                    <div class="position-relative mt-5 col-md-6">
                                                        <input name="custom_colors1_full" class="form-control" id="custom_colors1_full" placeholder="#000000" type="text" value="<?php echo $brandData->header_custom_color1 == '' ? '#000000' : $brandData->header_custom_color1; ?>">
                                                        <a style="position: absolute; top: 10px; right: 20px;" class="colorpicker1 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $brandData->header_custom_color1 == '' ? 'style="color:#000000"' : 'style="color:' . $brandData->header_custom_color1 . '"'; ?>></i></a>
                                                    </div>

                                                    <div class="position-relative mt-5 col-md-6">
                                                        <input name="custom_colors2_full" class="form-control" id="custom_colors2_full" placeholder="#FF0000" type="text" value="<?php echo $brandData->header_custom_color2 == '' ? '#FF0000' : $brandData->header_custom_color2; ?>">
                                                        <a style="position: absolute; top: 10px; right: 20px;" class="colorpicker2 colorpicker-show-input" href="javascript:void(0);"><i class="fa fa-circle fsize18" <?php echo $brandData->header_custom_color2 == '' ? 'style="color:#FF0000"' : 'style="color:' . $brandData->header_custom_color2 . '"'; ?>></i></a>
                                                    </div>
                                                </div>
                                                
                                                 <!--==========Choose orientation full custom ==========-->
                                                <div class="row orientation_full" style="<?php  
                                                        if($brandData->area_type == '2')
                                                        {
                                                            if($brandData->header_color_custom < 1 )
                                                            { echo "display:none";
                                                            } 
                                                            else
                                                            { 
                                                            echo "display:block"; 
                                                            }

                                                        } else { echo "display:none";  }?> ">
                                                	<div class="col-md-12">
                                                		<div style="margin: 25px 0 15px!important;" class="profile_headings txt_upper fsize11 fw600">Choose orientation</div>
                                                	</div>
                                                	<div class="col-md-12">
                                                		<ul class="choose_orientation">
                                                			<li class="torighttop"><a class="<?php echo $brandData->color_orientation_full == 'to right top' ? 'active' : ''; ?>" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toright"><a class="<?php echo $brandData->color_orientation_full == 'to right' ? 'active' : ''; ?>" color-orientation="to right"  href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                                                			<li class="torightbottom"><a class="<?php echo $brandData->color_orientation_full == 'to right bottom' ? 'active' : ''; ?>" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                                                			<li class="tobottom"><a class="<?php echo $brandData->color_orientation_full == 'to bottom' ? 'active' : ''; ?>" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                                                			<li class="toleftbottom"><a class="<?php echo $brandData->color_orientation_full == 'to left bottom' ? 'active' : ''; ?>" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                                                			<li class="toleft"><a class="<?php echo $brandData->color_orientation_full == 'to left' ? 'active' : ''; ?>" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                                                			<li class="tolefttop"><a class="<?php echo $brandData->color_orientation_full == 'to left top' ? 'active' : ''; ?>" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                                                			<li class="totop"><a class="<?php echo $brandData->color_orientation_full == 'to top' ? 'active' : ''; ?>" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                                                			<li class="circle"><a class="<?php echo $brandData->color_orientation_full == 'circle' ? 'active' : ''; ?>" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                                                		</ul>
                                                	</div>
                                                </div>
                                                <!--==========Choose orientation full custom ==========-->
                                                
                                                
                                            </div>
                                        </div>
                                        
                                        <!--=======Full Area=====-->
                                        
                                       
                                      
                                  
                                    
								<div class="profile_headings fsize12 fw500">Save Brand Theme Settings <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
								<div class="p25">
                                    <div class="form-group">
								 <input name="brand_theme_title" id="brand_theme_title" value="" placeholder="Create Brand Theme" class="form-control h52" required="" type="text">
                                    </div>
                                        <button class="btn dark_btn bkg_dred w100" type="submit"> Save Brand Theme </button>
								</div>
                                    <!--=======Save brand theme form area =====-->
                                      </form>
                                </div>
                                
                                <div class="tab-pane" id="Campaign">
                                    <div class="profile_headings txt_upper p20 fsize11 fw600">Select Campaign <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                                    <?php 
                                    if(!empty(unserialize($brandData->campaign_ids))) {
                                        $campaign_ids = unserialize($brandData->campaign_ids);
                                    } else {
                                        $campaign_ids = array();
                                    } 

                                    ?>
                                    <form method="post" name="frmSubmit" id="frmSubmitCampaign" action="javascript:void(0);"  enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <div class="p20">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="form-group mb10">
                                                        <p class="pull-left mb0">Select All</p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field campaignSelectAll" type="checkbox" checked="checked"> 
                                                            <span class="toggle dred"></span> 
                                                        </label>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <?php 
                                                    foreach ($aBrandbosts as $data) { 
                                                        //pre($data);
                                                        ?>
                                                    <div class="form-group mb10">
                                                        <p class="pull-left mb0"><a href="<?php echo base_url('admin/brandboost/onsite_setup/'.$data->id); ?>" class="txt_dark bbot"><?php echo $data->brand_title; ?></a></p>
                                                        <label class="custom-form-switch pull-right">
                                                            <input class="field changeAction" type="checkbox" name="campaign[]"  value="<?php echo $data->id; ?>" 
                                                            <?php 

                                                            if(!empty($campaign_ids)) {
                                                                if (in_array($data->id, $campaign_ids))
                                                                {
                                                                  echo "checked";
                                                                }
                                                                else
                                                                {
                                                                  echo "";
                                                                } 
                                                            }
                                                            else {
                                                                echo "checked";
                                                            }
                                                            
                                                            ?> >
                                                            <span class="toggle dred"></span> 
                                                        </label>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p20 btop">
                                            <button type="submit" class="btn dark_btn bkg_dred w100">Save</button>
                                        </div>
                                    </form>
                                    
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!--=======Info=====-->
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading">
                            <h6 class="panel-title">Help<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                            <div class="heading-elements"><a href="#"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a></div>
                        </div>
                        <div class="panel-body  p40 info_card text-center">
                            <div class="img_icon mb20"><img src="<?php echo base_url(); ?>assets/images/company_info.png" width="36"></div>
                            <p class="mb20"><strong>Company info</strong></p>
                            <p class="mb20"><span>Your can change your company<br> description, services and contact info<br> on Brand Settings page</span></p>
                            <a class="txt_dred" href="#">Change company info</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">

                    <div class="panel panel-flat">
                        <!-- <div class="panel-heading">
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="active"><a href="#Preview" data-toggle="tab" aria-expanded="false">Preview</a></li>
                            </ul>
                        </div> -->
						<div class="panel-heading">
							<h6 class="panel-title">Statistic &nbsp; &nbsp; <a style="color: #962e6c ; font-weight: 500!important" href="<?php echo base_url(); ?>for/<?php echo str_replace(' ', '-', strtolower($userData->company_name)); ?>" target="_blank">Live Preview</</a></h6>
							<div style="margin-top:-13px;" class="heading-elements">
							<ul class="nav nav-tabs nav-tabs-bottom">
								<li><a href="#Tabletver" data-toggle="tab"><i class="icon-tablet"></i> Tablet</a></li>
								<li><a href="#Phonever" data-toggle="tab"><i class="icon-mobile2"></i> Mobile</a></li>
								<li class="active"><a href="#Desktopver" data-toggle="tab"><i class="icon-display"></i> Desktop</a></li>
							  </ul>	
							</div>
						</div>
                        <div class="panel-body p20">
                            <div class="tab-content">
								<div class="tab-pane" id="Tabletver">
									<div class="tablet_box">
										<div class="tablet_box_bkg">
											<div class="leftPosition">@include ('admin.brandboost.brand_preview', array('brandData' => $brandData))</div>
										</div>
									</div>
								</div>
								
								<div class="tab-pane" id="Phonever">
									<div class="mobile_box">
										<div class="mobile_box_bkg">
											<div class="leftPosition"> @include('admin.brandboost.brand_preview', array('brandData' => $brandData))</div>
										</div>
									</div>
								</div>
								
								<div class="tab-pane active" id="Desktopver">
									<div class="leftPosition"> @include('admin/brandboost/brand_preview', array('brandData' => $brandData))</div>
									<!--<img class="w100 browserimg" src="<?php echo base_url(); ?>assets/images/config_bkg_bk2_overlay.png"/>-->
								</div>
							</div>
                        </div>
                    </div>
					<!-- <div class="rightPosition" <?php echo ($brandData->about_company_position == 'left' || $brandData->about_company_position == '') ? 'style="display:none;"' : '' ?>><?php //$this->load->view('admin/brandboost/brand_preview2');  ?></div> -->

                </div>
            </div>
        </div>
        <!--===========TAB 1======Reviews=====-->
        <div class="tab-pane <?php echo $tb1active; ?>" id="right-icon-tab11">
            @include("admin.brandboost.campaign-tabs.onsite.onsite-reviews", array('aReviews' => $aReviews, 'brandboostData' => ''));
        </div>
        <!--===========TAB 2=====Media======-->
        <div class="tab-pane <?php echo $tb2active; ?>" id="right-icon-tab21">
            @include("admin.brandboost.campaign-tabs.onsite.onsite-media", array('aReviews' => $aReviews))
        </div>
        <!--===========TAB 3=====FAQ======-->
        <div class="tab-pane <?php echo $tb3active; ?> FaQSection" id="right-icon-tab31">
          @include("admin.brandboost.campaign-tabs.onsite.onsite-faqs", array('faQData' => $faQData))
        </div>
        
        
        
    </div>
    
    <!--==========addQuestion popup============-->

<div id="addQuestion" class="modal fade brand_info_pop">
  <div class="modal-dialog" style="max-width: 542px;">
    <div class="modal-content">
      <form name="addQuestionFrm" id="addQuestionFrm" method="post" class="form-horizontal">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-header p20 pl30">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h5 class="modal-title txt_black">Add new question</h5>
        </div>
        <div class="modal-body p30">
        <div class="">
        <div class="form-group">
        <label class="control-label fw400 fsize14 txt_dark">Question</label>
        <textarea name="question" id="question" required class="form-control p20 fw500 txt_dark" style="min-height: 140px;"></textarea>
        </div>

        <div class="form-group mb0">
        <label class="control-label fw400 fsize14 txt_dark">Answer</label>
        <textarea name="answer" id="answer" required class="form-control p20 fw500 txt_dark" style="min-height: 260px"> </textarea>
        </div>
        </div>
        </div>
        <div class="modal-footer p30 text-left">  
          <button data-toggle="modal" id="" type="submit" class="btn dark_btn bkg_red3 h32 m0 mr20">Add new quesiton</button>
          <button data-toggle="modal" id="" type="button" class="btn white_btn cancel_info p0 txt_dred">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
    	<style>
		.info_media{box-shadow: 0 1px 1px 0 rgba(30, 30, 64, 0.05), 0 2px 3px 0 rgba(30, 30, 64, 0.03);border-radius: 5px; width: 100%;}
		.brand_info_pop .modal-header{background: none !important;}
		.brand_info_pop .modal-dialog{max-width: 724px; width: 100%;}
		.brand_info_pop .review_source .inner {text-align: center;border-radius: 5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;border-bottom-color: rgb(227, 233, 243);border-bottom-style: solid;border-bottom-width: 1px;height: 260px;position: relative;padding: 33px 0;}
		.brand_info_pop .col-md-2.review_source .inner.active {    border-bottom: 3px solid #9986e4 !important;}
		.brand_info_pop .review_source label{width: 100%;} 
		.brand_info_pop .review_source .inner:hover {border: 1px solid #da97af !important;}
		.brand_info_pop .review_source .custmo_checkbox.checkboxs {
    position: absolute;    right: 0px; top: 0px;}
		.custmo_checkbox input:checked ~ .custmo_checkmark.red{ background: #ad3068;}
		.brand_info_pop .custmo_checkbox input:checked ~ .custmo_checkmark{border: 1px solid #ad3068}
		.bkg_red3{background: #962e6c !important}
		.brand_info_pop .cancel_info{height: auto; border-bottom: 1px solid #3e9ef !important; border: 0; border-radius: 0; color: #962e6c;font-weight: 500;}
		.panel-heading .nav-tabs > li.active > a, .panel-heading .nav-tabs > li.active > a:hover, .panel-heading .nav-tabs > li.active > a:focus {	color: #962e6c!important;}
		.brand_page_pr .container {
    max-width: 100%;
    width: 100%;
}
		
	</style>
    
    
       <!--==========addQuestion popup============-->
    
    
    <!--================================= CONTENT AFTER TAB===============================-->
</div>	

 <!--=====================================Createnewlist Popup================================-->    
  <form name="template_type">
<input type="hidden" name="template_type" value="" id="template_type_value">
  </form>      



<script>
     function getColorName(colorName) {
        if (colorName == 'red') {
            colorName = '#AB256F';
        }
        if (colorName == 'yellow') {
            colorName = '#F9A34A';
        }
        if (colorName == 'orange') {
            colorName = '#E2583D';
        }
        if (colorName == 'green') {
            colorName = '#368A5D';
        }
        if (colorName == 'blue') {
            colorName = '#2A4CBC';
        }
        if (colorName == 'purple') {
            colorName = '#33335B';
        }

        return colorName;
    }

    $(document).ready(function () {


        $("#newcampaign").click(function(){
            $(".box").animate({
                width: "toggle"
            });
           
        });
        


        $('.template_select').click(function () {
             $('.overlaynew').show();
             var current_type = $(this).val();
             $('#template_style').val(current_type);
              $('.template_layers').hide();
              $('.layer_'+current_type).css("display","block");

               $.ajax({
                url: "<?php echo base_url(); ?>/admin/brandboost/switchTemplate",
                method: "POST",
                data: {'template_style': current_type},
                dataType: "json",
                success: function (data)
                {
                        $(".smart-widget-type-box").animate({
                        width: "toggle"
                        });
                        $('.overlaynew').hide();  
                }

             });

             });

       
    if($('#solid_color_switch').prop("checked")==false)
    {
    $('.solid_color_switch_div').attr('style', 'display:none!important');

    }
    if($('#main_color_switch').prop("checked")==false)
    {
    $('.main_color_switch_div').attr('style', 'display:none!important');
	 $('#TopArea .orientation_top_fix').attr('style', 'display:none!important');
	

    }

    if($('#custom_color_switch').prop("checked")==false)
    {
    $('.custom_color_switch_div').attr('style', 'display:none!important');
    $('.orientation_top').attr('style', 'display:none!important');

    }

     if($('#solid_color_switch_full').prop("checked")==false)
    {
    $('.solid_color_switch_full_div').attr('style', 'display:none!important');

    }
    if($('#main_color_switch_full').prop("checked")==false)
    {
    $('.main_color_switch_full_div').attr('style', 'display:none!important');
	$('#FullArea .orientation_fix').attr('style', 'display:none!important');

    }

    if($('#custom_color_switch_full').prop("checked")==false)
    {
    $('.custom_color_switch_full_div').attr('style', 'display:none!important');
    $('#FullArea .orientation_full').attr('style', 'display:none!important');

    }

    
    Dropzone.autoDiscover = false;
    var myDropzoneLogoImg = new Dropzone(
    '#myDropzone_logo_img', //id of drop zone element 1
    {
        url: '<?php echo base_url("webchat/dropzone/upload_s3_attachment"); ?>/<?php echo $userData->id; ?>/onsite',
        uploadMultiple: false,
        maxFiles: 1,
        maxFilesize: 600,
        acceptedFiles: 'image/*',
        addRemoveLinks: false,
        success: function (response) {
            
            if(response.xhr.responseText != "") {

                $('.company_avatar').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
                var dropImage = $('#company_logo').val();
                $.ajax({
                    url: '<?php echo base_url('admin/brandboost/deleteObjectFromS3'); ?>',
                    type: "POST",
                    data: {dropImage: dropImage, _token: '<?php echo csrf_token(); ?>'},
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                    }
                });
               
            
                $('#company_logo').val(response.xhr.responseText);
                $('#frmDesignSubmit').trigger('submit');
            }
            
        }
    });
    myDropzoneLogoImg.on("complete", function(file) {
      myDropzoneLogoImg.removeFile(file);
    });


    var myDropzoneHeaderLogo = new Dropzone(
    '#myDropzone_company_header_logo', //id of drop zone element 1
    {
        url: '<?php echo base_url("webchat/dropzone/upload_s3_attachment"); ?>/<?php echo $userData->id; ?>/onsite',
        uploadMultiple: false,
        maxFiles: 1,
        maxFilesize: 600,
        acceptedFiles: 'image/*',
        addRemoveLinks: false,
        success: function (response) {
            
            if(response.xhr.responseText != "") {

                $('.company_header_avatar').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
                var dropImage = $('#company_header_logo').val();
                $.ajax({
                    url: '<?php echo base_url('admin/brandboost/deleteObjectFromS3'); ?>',
                    type: "POST",
                    data: {dropImage: dropImage, _token: '<?php echo csrf_token(); ?>'},
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                    }
                });
               
            
                $('#company_header_logo').val(response.xhr.responseText);
                $('#frmDesignSubmit').trigger('submit');
            }
            
        }
    });
    myDropzoneHeaderLogo.on("complete", function(file) {
      myDropzoneHeaderLogo.removeFile(file);
    });
 

        // ******** main color switch for top area ******** // 
        $('#main_color_switch').change(function () {
            $("#area_type").val("1");
        $(".Parent").removeAttr("style");
        $('.headerbg, .subarea, .Parent').removeClass('red_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('yellow_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('orange_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('green_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('blue_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('purple_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('white_preview_1');
        $('.headerbg, .subarea, .Parent').css('background-image', '');
        // all buttons close on full action//
        $('#solid_color_switch_bottom').prop('checked', false);
        $('#main_color_switch_bottom').prop('checked', false);
        $('#custom_color_switch_bottom').prop('checked', false);
        $('#solid_color_switch_full').prop('checked', false);
        $('#main_color_switch_full').prop('checked', false);
        $('#custom_color_switch_full').prop('checked', false);
        // all buttons close on full action//
                if ($(this).prop("checked") == false) {
				
                $('#custom_color_switch').prop('checked', true);
				 $('.custom_color_switch_div').show();
                 $('.orientation_top').show();
				 $('.orientation_top_fix').hide();
				$('.main_color_switch_div').hide();
				
                $('.headerbg').removeClass('red_preview_1');
                $('.headerbg').removeClass('yellow_preview_1');
                $('.headerbg').removeClass('orange_preview_1');
                $('.headerbg').removeClass('green_preview_1');
                $('.headerbg').removeClass('blue_preview_1');
                $('.headerbg').removeClass('purple_preview_1');
                $('.headerbg').removeClass('white_preview_1');
                if($('#TopArea .choose_orientation .active').attr('color-orientation') == 'circle')
                {
                $('.headerbg').css('background-image', 'radial-gradient('+$('#TopArea .choose_orientation .active').attr('color-orientation')+', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                }
                else
                {
                $('.headerbg').css('background-image', 'linear-gradient('+$('#TopArea .choose_orientation .active').attr('color-orientation')+', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                }
                //$('.headerbg').css('background-image', 'linear-gradient(45deg, ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                    
                $('.customColor, .customColor i').attr('style', 'color:' + $('#custom_colors1').val() + '!important');
                $('.customColorBar').css('background-color', $('#custom_colors1').val());
            } else {
                $('#custom_color_switch').prop('checked', false);
                $('#solid_color_switch').prop('checked', false);
				
				$('.custom_color_switch_div').hide();
                 $('.orientation_top').hide();
				  $('.orientation_top_fix').show();
                $('.solid_color_switch_div').hide();
				$('.main_color_switch_div').show();
				
                var gColor = $('.selectMainColor.active').attr('color-class');
                var colorName = $('.selectMainColor.active').attr('color-data');
                $('.headerbg').addClass(gColor);
                $('.headerbg').css('background-image', '');
                $('.customColor, .customColor i').attr('style', 'color:' + getColorName(colorName) + '!important');
                $('.customColorBar').css('background-color', getColorName(colorName));
                   
            }
             if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        });
        // main color switch for top area // 
        
            
 
        
               // ******** main color switch for Full area *********** // 
                $('#main_color_switch_full').change(function () {
                $("#area_type").val("2");
                    // all buttons close on full action//
            $('#solid_color_switch').prop('checked', false);
            $('#solid_color_switch_bottom').prop('checked', false);
            $('#main_color_switch').prop('checked', false);
            $('#main_color_switch_bottom').prop('checked', false);
            $('#custom_color_switch').prop('checked', false); 
            $('#custom_color_switch_bottom').prop('checked', false);
             // all buttons close on full action//
              
               
            if ($(this).prop("checked") == false) {

                 $('.brand_page_gr').css('background', 'none');
				 $('.main_color_switch_full_div').hide();
                $('.subarea').css('background', 'none');
                $('#custom_color_switch_full').prop('checked', true);
				$('.custom_color_switch_full_div').show();
                 $('.orientation_full').show();
				  $('.orientation_fix').hide();
				 
				
                $('headerbg, .subarea').removeClass('red_preview_1');
                $('.headerbg, .subarea').removeClass('yellow_preview_1');
                $('.headerbg, .subarea').removeClass('orange_preview_1');
                $('.headerbg, .subarea').removeClass('green_preview_1');
                $('.headerbg, .subarea').removeClass('blue_preview_1');
                $('.headerbg, .subarea').removeClass('purple_preview_1');
                 $('.headerbg, .subarea').removeClass('white_preview_1');
                 if($('#FullArea .choose_orientation .active').attr('color-orientation') == 'circle')
                {
                $('.Parent').css('background-image', 'radial-gradient('+$('#FullArea .choose_orientation .active').attr('color-orientation')+', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                }
                else
                {
                $('.Parent').css('background-image', 'linear-gradient('+$('#FullArea .choose_orientation .active').attr('color-orientation')+', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                }
               // $('.Parent').css('background-image', 'linear-gradient(45deg, ' + $('#custom_colors1_full').val() + ' 1%, ' + $('#custom_colors2_full').val() + ')');
                $('.customColor, .customColor i').attr('style', 'color:' + $('#custom_colors1_full').val() + '!important');
                $('.customColorBar').css('background-color', $('#custom_colors1_full').val());
            } else {
               
                $('.brand_page_gr').attr("style", "background: none!important");
               $('.subarea').css('background', 'none');
                $('.headerbg').css('background', 'none');
				
                $('#custom_color_switch_full').prop('checked', false);
                $('#solid_color_switch_full').prop('checked', false);
				$('.custom_color_switch_full_div').hide();
                $('.orientation_full').hide();
				 $('.orientation_fix').show();
                $('.solid_color_switch_full_div').hide();
				$('.main_color_switch_full_div').show();
				
                var gColor = $('.selectFullMainColor.active').attr('color-class');
                var colorName = $('.selectFullMainColor.active').attr('color-data');
                $('.Parent').removeAttr("style");
                $('.Parent').addClass(gColor);
                
                $('.customColor, .customColor i').attr('style', 'color:' + getColorName(colorName) + '!important');
                $('.customColorBar').css('background-color', getColorName(colorName));
            }
                    
                    if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        });
        // main color switch for Full area //
        
        
        
        
              // ********* custom color switch for top area ************ // 
        $('#custom_color_switch').change(function () {
            $("#area_type").val("1");
        $(".Parent").removeAttr("style");
        $('.headerbg, .subarea, .Parent').removeClass('red_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('yellow_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('orange_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('green_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('blue_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('purple_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('white_preview_1');
        $('.headerbg, .subarea, .Parent').css('background-image', '');
        // all buttons close on full action//
        $('#solid_color_switch_bottom').prop('checked', false);
        $('#main_color_switch_bottom').prop('checked', false);
        $('#custom_color_switch_bottom').prop('checked', false);
        $('#solid_color_switch_full').prop('checked', false);
        $('#main_color_switch_full').prop('checked', false);
        $('#custom_color_switch_full').prop('checked', false);
        // all buttons close on full action//

            
            if ($(this).prop("checked") == false) {
                $('#main_color_switch').prop('checked', true);
				$('.main_color_switch_div').show();
				$('.custom_color_switch_div').hide();
                 $('.orientation_top').hide();
				 $('.orientation_top_fix').show();
                var gColor = $('.selectMainColor.active').attr('color-class');
                var colorName = $('.selectMainColor.active').attr('color-data');
                $('.headerbg').addClass(gColor);
                $('.headerbg').css('background-image', '');
                $('.customColor, .customColor i').attr('style', 'color:' + getColorName(colorName) + '!important');
                $('.customColorBar').css('background-color', getColorName(colorName));
            } else {
                $('#main_color_switch').prop('checked', false);
                $('#solid_color_switch').prop('checked', false);
				
				$('.main_color_switch_div').hide();
                $('.solid_color_switch_div').hide();
				$('.custom_color_switch_div').show();
                 $('.orientation_top').show();
				 $('.orientation_top_fix').hide();
				
                $('.headerbg').removeClass('red_preview_1');
                $('.headerbg').removeClass('yellow_preview_1');
                $('.headerbg').removeClass('orange_preview_1');
                $('.headerbg').removeClass('green_preview_1');
                $('.headerbg').removeClass('blue_preview_1');
                $('.headerbg').removeClass('purple_preview_1');
                $('.headerbg').removeClass('white_preview_1');
                if($('#TopArea .choose_orientation .active').attr('color-orientation') == 'circle')
                {
                $('.headerbg').css('background-image', 'radial-gradient('+$('#TopArea .choose_orientation .active').attr('color-orientation')+', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                }
                else
                {
                $('.headerbg').css('background-image', 'linear-gradient('+$('#TopArea .choose_orientation .active').attr('color-orientation')+', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                }
                //$('.headerbg').css('background-image', 'linear-gradient(45deg, ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                $('.customColor, .customColor i').attr('style', 'color:' + $('#custom_colors1').val() + '!important');
                $('.customColorBar').css('background-color', $('#custom_colors1').val());
            }
           if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        });   // custom color switch for top area // 
        
        

        
        
         // ********* custom color switch for Full area*********** // 
        $('#custom_color_switch_full').change(function () {
           $("#area_type").val("2");
            // all buttons close on full action//
            $('#solid_color_switch').prop('checked', false);
            $('#solid_color_switch_bottom').prop('checked', false);
            $('#main_color_switch').prop('checked', false);
            $('#main_color_switch_bottom').prop('checked', false);
            $('#custom_color_switch').prop('checked', false); 
            $('#custom_color_switch_bottom').prop('checked', false);
             // all buttons close on full action//
              


            if ($(this).prop("checked") == false) {
                $('#main_color_switch_full').prop('checked', true);
				 $('.main_color_switch_full_div').show();
				$('.custom_color_switch_full_div').hide();
                $('.orientation_full').hide();
				$('.orientation_fix').show();
				
                var gColor = $('.selectFullMainColor.active').attr('color-class');
                var colorName = $('.selectFullMainColor.active').attr('color-data');
                $('headerbg, .subarea').addClass(gColor);
                $('headerbg, .subarea').css('background-image', '');
                $('.customColor, .customColor i').attr('style', 'color:' + getColorName(colorName) + '!important');
                $('.customColorBar').css('background-color', getColorName(colorName));
            } else {

                $('#main_color_switch_full').prop('checked', false);
                $('#solid_color_switch_full').prop('checked', false);
				
				$('.main_color_switch_full_div').hide();
                $('.solid_color_switch_full_div').hide();
				$('.custom_color_switch_full_div').show();
                $('.orientation_full').show();
				$('.orientation_fix').hide();
				
				
                 $('.brand_page_gr').css('background', 'none');
                $('.subarea').css('background', 'none');
                $('.headerbg, .subarea').removeClass('red_preview_1');
                $('.headerbg, .subarea').removeClass('yellow_preview_1');
                $('.headerbg, .subarea').removeClass('orange_preview_1');
                $('.headerbg, .subarea').removeClass('green_preview_1');
                $('.headerbg, .subarea').removeClass('blue_preview_1');
                $('.headerbg, .subarea').removeClass('purple_preview_1');
                 $('.headerbg, .subarea').removeClass('white_preview_1');
                if($('#FullArea .choose_orientation .active').attr('color-orientation') == 'circle')
                {
                $('.Parent').css('background-image', 'radial-gradient('+$('#FullArea .choose_orientation .active').attr('color-orientation')+', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                }
                else
                {
                $('.Parent').css('background-image', 'linear-gradient('+$('#FullArea .choose_orientation .active').attr('color-orientation')+', ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                }
                //$('.Parent').css('background-image', 'linear-gradient(45deg, ' + $('#custom_colors1_full').val() + ' 1%, ' + $('#custom_colors2_full').val() + ')');
                $('.customColor, .customColor i').attr('style', 'color:' + $('#custom_colors1_full').val() + '!important');
                $('.customColorBar').css('background-color', $('#custom_colors1_full').val());
               
            }
            if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        }); // custom color switch for Full area // 
        
        
        
        
         // *********** solid color switch for top area *********** // 
         $('#solid_color_switch').change(function () {
             $("#area_type").val("1");
        $(".Parent").removeAttr("style");
        $('.headerbg, .subarea, .Parent').removeClass('red_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('yellow_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('orange_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('green_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('blue_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('purple_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('white_preview_1');
        $('.headerbg, .subarea, .Parent').css('background-image', '');
        // all buttons close on full action//
        $('#solid_color_switch_bottom').prop('checked', false);
        $('#main_color_switch_bottom').prop('checked', false);
        $('#custom_color_switch_bottom').prop('checked', false);
        $('#solid_color_switch_full').prop('checked', false);
        $('#main_color_switch_full').prop('checked', false);
        $('#custom_color_switch_full').prop('checked', false);
        // all buttons close on full action//
             
             
            if ($(this).prop("checked") == false) {
                $('#main_color_switch').prop('checked', true);
				$('#TopArea .color_box').show();
				$('#TopArea .solid_color_switch_div').hide();
				
				
                var gColor = $('.selectMainColor.active').attr('color-class');
                var colorName = $('.selectMainColor.active').attr('color-data');
                $('.headerbg').addClass(gColor);
                $('.headerbg').css('background-image', '');
                $('.headerbg').css('background', '');
                $('.customColor, .customColor i').attr('style', 'color:' + getColorName(colorName) + '!important');
                $('.customColorBar').css('background-color', getColorName(colorName));
            } else {
                $('#main_color_switch').prop('checked', false);
                $('#custom_color_switch').prop('checked', false);
				
				$('#TopArea .color_box').hide();
				$('#TopArea .custom_color_switch_div').hide();
                 $('.orientation_top').hide();
				$('#TopArea .solid_color_switch_div').show();
				
                $('.headerbg').removeClass('red_preview_1');
                $('.headerbg').removeClass('yellow_preview_1');
                $('.headerbg').removeClass('orange_preview_1');
                $('.headerbg').removeClass('green_preview_1');
                $('.headerbg').removeClass('blue_preview_1');
                $('.headerbg').removeClass('purple_preview_1');
                $('.headerbg').removeClass('white_preview_1');
                $('.headerbg').css('background-image', '');
                $('.headerbg').attr('style', 'background:' + $('#solid_color').val() + '!important');
                $('.customColorBar').css('background-color', $('#solid_color').val());
                $('.customColor, .customColor i').attr('style', 'color:' + $('#solid_color').val() + '!important');
            }
            if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        }); // solid color switch for top area // 
        

        
        
        
         // ********** solid color switch for Full area *********** // 
           $('#solid_color_switch_full').change(function () {
            $("#area_type").val("2");
            // all buttons close on full action//
            $('#solid_color_switch').prop('checked', false);
            $('#solid_color_switch_bottom').prop('checked', false);
            $('#main_color_switch').prop('checked', false);
            $('#main_color_switch_bottom').prop('checked', false);
            $('#custom_color_switch').prop('checked', false); 
            $('#custom_color_switch_bottom').prop('checked', false);
             // all buttons close on full action//
              
            
            if ($(this).prop("checked") == false) {
                $('#main_color_switch_full').prop('checked', true);
				$('.main_color_switch_full_div').show();
				$('.solid_color_switch_full_div').hide();
				
                var gColor = $('.selectFullMainColor.active').attr('color-class');
                var colorName = $('.selectFullMainColor.active').attr('color-data');
                $('.headerbg , .subarea').addClass(gColor);
                $('.headerbg , .subarea').css('background-image', '');
                $('.headerbg , .subarea').css('background', '');
                $('.customColor, .customColor i').attr('style', 'color:' + getColorName(colorName) + '!important');
                $('.customColorBar').css('background-color', getColorName(colorName));
            } else {
                $('#main_color_switch_full').prop('checked', false);
                $('#custom_color_switch_full').prop('checked', false);
				
				 $('.main_color_switch_full_div').hide();
                 $('.custom_color_switch_full_div').hide();
                $('.orientation_full').hide();
				 $('.solid_color_switch_full_div').show();
				
                $('.headerbg, .subarea').removeClass('red_preview_1');
                $('.headerbg, .subarea').removeClass('yellow_preview_1');
                $('.headerbg, .subarea').removeClass('orange_preview_1');
                $('.headerbg, .subarea').removeClass('green_preview_1');
                $('.headerbg, .subarea').removeClass('blue_preview_1');
                $('.headerbg, .subarea').removeClass('purple_preview_1');
                $('.headerbg, .subarea').removeClass('white_preview_1');
                $('.headerbg, .subarea').css('background-image', '');
                 $('.brand_page_gr').css('background', 'none');
                $('.Parent').attr('style', 'background:' + $('#solid_color_full').val() + '!important');
                $('.customColorBar').css('background-color', $('#solid_color_full').val());
                $('.customColor, .customColor i').attr('style', 'color:' + $('#solid_color_full').val() + '!important');
            }
               
                $('#color_orientation_full_value').val($("#FullArea .orientation_fix .choose_orientation .active").attr('color-orientation'));
               
              if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        }); // solid color switch for Full area // 
        
        

        $('#company_info_switch').change(function () {
            if ($(this).prop("checked") == false) {
                $('#custom_company_info_box').show();
                $('#default_company_info_box').hide();
                var contentVal = $('#custom_company_description').val();
                $('.company_name').html($('#custom_company_name').val());
                $('.company_description').html(contentVal.replace(/\n/g, "<br />"));
            } else {
                $('#custom_company_info_box').hide();
                $('#default_company_info_box').show();
                var contentVal = $('#default_brand_desc').val();
                $('.company_name').html($('#default_brand_title').val());
                $('.company_description').html(contentVal.replace(/\n/g, "<br />"));
            }
        });

        $('#custom_company_name').keyup(function () {
            $('.company_name').html($(this).val());
        });

        $('#custom_company_description').keyup(function () {
            var contentVal = $(this).val();
            $('.company_description').html(contentVal.replace(/\n/g, "<br />"));
        });
        
        
        // top area on off //
          $('#topPlaneSecSwitch').change(function () {
            if ($(this).prop("checked") == false) {
                $('#TopArea').hide();
                $('#solid_color_switch_div').hide();
                $('#main_color_switch_div').hide();
                $('#custom_color_switch_div').hide();
                $('#FullArea').show();
                
                $('#solid_color_switch_full_div').show();
                $('#main_color_switch_full_div').show();
                $('#custom_color_switch_full_div').show();
                
                
                $('#FullPlaneSecSwitch').prop("checked", true);

            } else {
                $('#TopArea').show();
                  $('#solid_color_switch_div').show();
                $('#main_color_switch_div').show();
                $('#custom_color_switch_div').show();
                
                $('#solid_color_switch_full_div').hide();
                $('#main_color_switch_full_div').hide();
                $('#custom_color_switch_full_div').hide();
                
                
                $('#FullArea').hide();
                $('#FullPlaneSecSwitch').prop("checked", false);
                
            }
        });
         // top area on off //
        
        // full area on off //
          $('#FullPlaneSecSwitch').change(function () {
            if ($(this).prop("checked") == false) {
                $('#FullArea').hide();
                 $('#solid_color_switch_full_div').hide();
                $('#main_color_switch_full_div').hide();
                $('#custom_color_switch_full_div').hide();
                $('#TopArea').show();
                
                 $('#solid_color_switch_div').show();
                $('#main_color_switch_div').show();
                $('#custom_color_switch_div').show();
                
                
                $('#topPlaneSecSwitch').prop("checked", true);
               
            } else {
                $('#FullArea').show();
                 $('#solid_color_switch_full_div').show();
                $('#main_color_switch_full_div').show();
                $('#custom_color_switch_full_div').show();
                
                 $('#solid_color_switch_div').hide();
                $('#main_color_switch_div').hide();
                $('#custom_color_switch_div').hide();
                
                $('#TopArea').hide();
                 $('#topPlaneSecSwitch').prop("checked", false);
                
            }
        });
         // full area on off //
        
        
         // *********** select main area for top area *************8 // 
        $('.selectMainColor').click(function () {
            $("#area_type").val("1");
        $(".Parent").removeAttr("style");
        $('.headerbg, .subarea, .Parent').removeClass('red_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('yellow_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('orange_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('green_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('blue_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('purple_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('white_preview_1');
        $('.headerbg, .subarea, .Parent').css('background-image', '');
        // all buttons close on full action//
        $('#solid_color_switch_bottom').prop('checked', false);
        $('#main_color_switch_bottom').prop('checked', false);
        $('#custom_color_switch_bottom').prop('checked', false);
        $('#solid_color_switch_full').prop('checked', false);
        $('#main_color_switch_full').prop('checked', false);
        $('#custom_color_switch_full').prop('checked', false);
        // all buttons close on full action//
            
            
         $('#main_colors').val($(this).attr('color-data'));
            $('.selectMainColor').removeClass('active');
            $(this).addClass('active');
            $('.headerbg').removeClass('red_preview_1');
            $('.headerbg').removeClass('yellow_preview_1');
            $('.headerbg').removeClass('orange_preview_1');
            $('.headerbg').removeClass('green_preview_1');
            $('.headerbg').removeClass('blue_preview_1');
            $('.headerbg').removeClass('purple_preview_1');
            $('.headerbg').removeClass('white_preview_1');
            $('.headerbg').css('background-image', '');
            $('#main_color_switch').prop('checked', true);
            $('#custom_color_switch').prop('checked', false);
            $('#solid_color_switch').prop('checked', false);
            $('.headerbg').addClass($(this).attr('color-class'));
            var colorName = $('.selectMainColor.active').attr('color-data');
            if(colorName == 'white')
            {
             $('.customColor, .customColor i').attr('style', 'color:#09204f!important');
             $('.customColorBar').css('background-color', '#ccc');  
            }
            else
            {
            $('.customColor, .customColor i').attr('style', 'color:' + getColorName(colorName) + '!important');
            $('.customColorBar').css('background-color', getColorName(colorName));   
            }
            
            
           if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        }); // select main area for top area // 
        
        

        
         // ************ select main area for Full area ************** // 
         $('.selectFullMainColor').click(function () {
          $("#area_type").val("2");
            // all buttons close on full action//
            $('#solid_color_switch').prop('checked', false);
            $('#solid_color_switch_bottom').prop('checked', false);
            $('#main_color_switch').prop('checked', false);
            $('#main_color_switch_bottom').prop('checked', false);
            $('#custom_color_switch').prop('checked', false); 
            $('#custom_color_switch_bottom').prop('checked', false);
             // all buttons close on full action//
              


         $('#main_colors_full').val($(this).attr('color-data'));
            $('.selectFullMainColor').removeClass('active');
            $(this).addClass('active');
            $('.headerbg, .subarea, .Parent').removeClass('red_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('yellow_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('orange_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('green_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('blue_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('purple_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('white_preview_1');
            $('.headerbg, .subarea').css('background-image', '');
            $('#main_color_switch_full').prop('checked', true);
            $('#custom_color_switch_full').prop('checked', false);
            $('#solid_color_switch_full').prop('checked', false);
             $('.Parent').removeAttr("style");
            $('.Parent').addClass($(this).attr('color-class'));
            var colorName = $('.selectFullMainColor.active').attr('color-data');
            if(colorName == 'white')
            {
            $('.customColor, .customColor i').attr('style', 'color:#09204f!important');
            $('.customColorBar').css('background-color', '#ccc');  
            }
            else
            {
            $('.customColor, .customColor i').attr('style', 'color:' + getColorName(colorName) + '!important');
            $('.customColorBar').css('background-color', getColorName(colorName));   
            }

           
             //$('.Parent').css('background-image', '');
             //$('.Parent').css('background-color', getColorName(colorName))+ '!important';
              //$('.Parent').children().css('background-color', 'none');
              $('.brand_page_gr').css('background', 'none');
            if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        });  // select main area for Full area // 
        

       
        // ********** Custom colors for Top area ************ // 
        $('#custom_colors1, #custom_colors2').change(function () {
            $("#area_type").val("1");
        $(".Parent").removeAttr("style");
        $('.headerbg, .subarea, .Parent').removeClass('red_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('yellow_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('orange_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('green_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('blue_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('purple_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('white_preview_1');
        $('.headerbg, .subarea, .Parent').css('background-image', '');
        // all buttons close on full action//
        $('#solid_color_switch_bottom').prop('checked', false);
        $('#main_color_switch_bottom').prop('checked', false);
        $('#custom_color_switch_bottom').prop('checked', false);
        $('#solid_color_switch_full').prop('checked', false);
        $('#main_color_switch_full').prop('checked', false);
        $('#custom_color_switch_full').prop('checked', false);
        // all buttons close on full action//
            
            
            $('.customColor, .customColor i').attr('style', 'color:' + $('#custom_colors1').val() + '!important');
            $('.customColorBar').css('background-color', $('#custom_colors1').val());
            
            
            if ($('#custom_colors1').val() != '' && $('#custom_colors2').val() != '') {
                $('.headerbg').removeClass('red_preview_1');
                $('.headerbg').removeClass('yellow_preview_1');
                $('.headerbg').removeClass('orange_preview_1');
                $('.headerbg').removeClass('green_preview_1');
                $('.headerbg').removeClass('blue_preview_1');
                $('.headerbg').removeClass('purple_preview_1');
                $('.headerbg').removeClass('white_preview_1');
                $('#main_color_switch').prop('checked', false);
                $('#custom_color_switch').prop('checked', true);
                $('#solid_color_switch').prop('checked', false);
                $('.headerbg').css('background-image', 'linear-gradient(45deg, ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
            }
           if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        });// Custom colors for top area // 
        


                   // ********** orientation for Top area fix ************ // 
        $('#TopArea .orientation_top_fix .choose_orientation li a').click(function () {
           $('#TopArea .orientation_top_fix .choose_orientation li a').removeClass('active');
              $(this).addClass('active');
               $("#area_type").val("1");
          
            if ($(this).prop("checked") == false) {
	
                var gColor = $('.selectMainColor.active').attr('color-class');
                var colorName = $('.selectMainColor.active').attr('color-data');
				
				
                $('headerbg').addClass(gColor);
                $('headerbg').css('background-image', '');
                $('.customColor, .customColor i').attr('style', 'color:' + getColorName(colorName) + '!important');
                $('.customColorBar').css('background-color', getColorName(colorName));
            } else {
                var color1 = '';
                var color2 = '';
				
                var gColor = $('.selectMainColor.active').attr('color-class');
                if( gColor == 'blue_preview_1')
                {
                color1 = '#4d4d7c';
                color2 = '#1e1e40';
                }
				else if( gColor == 'red_preview_1')
                {
                color1 = '#e93474';
                color2 = '#541069';
                }
				else if( gColor == 'yellow_preview_1')
                {
                color1 = '#f9d84a';
                color2 = '#f9814a';
                }
				else if( gColor == 'orange_preview_1')
                {
                color1 = '#ef9d39';
                color2 = '#d92a3f';
                }
				else if( gColor == 'green_preview_1')
                {
                color1 = '#93cf48';
                color2 = '#076768';
                }
				else if( gColor == 'purple_preview_1')
                {
                color1 = '#4d4d7c';
                color2 = '#1e1e40';
                }
                var customOrientation = $(this).attr('color-orientation');
                $('.headerbg').removeClass('red_preview_1');
                $('.headerbg').removeAttr('style');


                if(customOrientation == 'circle')
                {
                $('.headerbg').attr('style', 'background-image:radial-gradient('+customOrientation+', ' +color1+ ' 1%, ' +color2+ ')');
                }
                else
                {
                     
                $('.headerbg').attr('style', 'background-image:linear-gradient('+customOrientation+', ' +color1+ ' 1%, ' +color2+ ')');
                  
                }
                
                $('#color_orientation_top_value').val($(this).attr('color-orientation'));
                
               // $('.customColor, .customColor i').attr('style', 'color:' + $('#custom_colors1_full').val() + '!important');
               // $('.customColorBar').css('background-color', $('#custom_colors1_full').val());
               
            }
           if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        }); // ********** orientation for Top area fix ************ // 
		
        
               // ********** orientation for Top area custom  ************ // 
        $('#TopArea .orientation_top .choose_orientation li a').click(function () {
            $("#area_type").val("1");
            $('#TopArea .choose_orientation li a').removeClass('active');
            $(this).addClass('active');
            
        $(".Parent").removeAttr("style");
        $('.headerbg, .subarea, .Parent').removeClass('red_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('yellow_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('orange_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('green_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('blue_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('purple_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('white_preview_1');
        $('.headerbg, .subarea, .Parent').css('background-image', '');
        $('#solid_color_switch_bottom').prop('checked', false);
        $('#main_color_switch_bottom').prop('checked', false);
        $('#custom_color_switch_bottom').prop('checked', false);
        $('#solid_color_switch_full').prop('checked', false);
        $('#main_color_switch_full').prop('checked', false);
        $('#custom_color_switch_full').prop('checked', false);
        // all buttons close on full action//
            
            
           // $('.customColor, .customColor i').attr('style', 'color:' + $('#custom_colors1').val() + '!important');
           // $('.customColorBar').css('background-color', $('#custom_colors1').val());
            
            
            if ($('#custom_colors1').val() != '' && $('#custom_colors2').val() != '') {
                $('.headerbg').removeClass('red_preview_1');
                $('.headerbg').removeClass('yellow_preview_1');
                $('.headerbg').removeClass('orange_preview_1');
                $('.headerbg').removeClass('green_preview_1');
                $('.headerbg').removeClass('blue_preview_1');
                $('.headerbg').removeClass('purple_preview_1');
                $('.headerbg').removeClass('white_preview_1');
                $('#main_color_switch').prop('checked', false);
                $('#custom_color_switch').prop('checked', true);
                $('#solid_color_switch').prop('checked', false);
                
               
                var customOrientation = $(this).attr('color-orientation');
                $('.headerbg').removeClass('red_preview_1');
                $('.headerbg').removeAttr('style');
               if(customOrientation == 'circle')
                {
                $('.headerbg').attr('style', 'background-image:radial-gradient('+customOrientation+', ' +$('#custom_colors1').val()+ ' 1%, ' +$('#custom_colors2').val()+ ')');
                }
                else
                {
                     
                $('.headerbg').attr('style', 'background-image:linear-gradient('+customOrientation+', ' +$('#custom_colors1').val()+ ' 1%, ' +$('#custom_colors2').val()+ ')');
                  
                }
               
                $('#color_orientation_top_value').val($(this).attr('color-orientation'));
                
                
            }
             if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        }); // ********** orientation for Top area custom  ************ // 
        
        

        
           // ********** orientation for Full area (custom) ************ // 
        $('#FullArea .orientation_full .choose_orientation li a').click(function () {
             $('#FullArea .orientation_full .choose_orientation li a').removeClass('active');
              $(this).addClass('active');
        $("#area_type").val("2");
            // all buttons close on full action//
            $('#solid_color_switch').prop('checked', false);
            $('#solid_color_switch_bottom').prop('checked', false);
            $('#main_color_switch').prop('checked', false);
            $('#main_color_switch_bottom').prop('checked', false);
            $('#custom_color_switch').prop('checked', false); 
            $('#custom_color_switch_bottom').prop('checked', false);
             // all buttons close on full action//
              


            if ($(this).prop("checked") == false) {

                $('#main_color_switch_full').prop('checked', true);
				 $('.main_color_switch_full_div').show();
				$('.custom_color_switch_full_div').hide();
				
                var gColor = $('.selectFullMainColor.active').attr('color-class');
                var colorName = $('.selectFullMainColor.active').attr('color-data');
                $('headerbg, .subarea').addClass(gColor);
                $('headerbg, .subarea').css('background-image', '');
                $('.customColor, .customColor i').attr('style', 'color:' + getColorName(colorName) + '!important');
                $('.customColorBar').css('background-color', getColorName(colorName));
            } else {

                $('#main_color_switch_full').prop('checked', false);
                $('#solid_color_switch_full').prop('checked', false);
				
				$('.main_color_switch_full_div').hide();
                $('.solid_color_switch_full_div').hide();
				$('.custom_color_switch_full_div').show();
				
				
                 $('.brand_page_gr').css('background', 'none');
                $('.subarea').css('background', 'none');
                $('.headerbg, .subarea').removeClass('red_preview_1');
                $('.headerbg, .subarea').removeClass('yellow_preview_1');
                $('.headerbg, .subarea').removeClass('orange_preview_1');
                $('.headerbg, .subarea').removeClass('green_preview_1');
                $('.headerbg, .subarea').removeClass('blue_preview_1');
                $('.headerbg, .subarea').removeClass('purple_preview_1');
                 $('.headerbg, .subarea').removeClass('white_preview_1');
                
                
                var customOrientation = $(this).attr('color-orientation');
                $('.Parent').removeClass('red_preview_1');
                $('.Parent').removeAttr('style');

                
               if(customOrientation == 'circle')
                {
                $('.Parent').attr('style', 'background-image:radial-gradient('+customOrientation+', ' +$('#custom_colors1_full').val()+ ' 1%, ' +$('#custom_colors2_full').val()+ ')');
                }
                else
                {
                     
                $('.Parent').attr('style', 'background-image:linear-gradient('+customOrientation+', ' +$('#custom_colors1_full').val()+ ' 1%, ' +$('#custom_colors2_full').val()+ ')');
                  
                }
                
                
                $('#color_orientation_full_value').val($(this).attr('color-orientation'));
                
                $('.customColor, .customColor i').attr('style', 'color:' + $('#custom_colors1_full').val() + '!important');
                $('.customColorBar').css('background-color', $('#custom_colors1_full').val());
               
            }
           if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
            
        }); // ********** orientation for Full area custom ************ // 
        
        
        
		
         // ********** orientation for Full area (fix) ************ // 
        $(document).on("click",'#FullArea .orientation_fix .choose_orientation li a', function () {
             $('#FullArea .orientation_fix .choose_orientation li a').removeClass('active');
              $(this).addClass('active');
               $("#area_type").val("2");
          
            if ($(this).prop("checked") == false) {
	
                var gColor = $('.selectFullMainColor.active').attr('color-class');
                var colorName = $('.selectFullMainColor.active').attr('color-data');
                $('headerbg, .subarea').addClass(gColor);
                $('headerbg, .subarea').css('background-image', '');
                $('.customColor, .customColor i').attr('style', 'color:' + getColorName(colorName) + '!important');
                $('.customColorBar').css('background-color', getColorName(colorName));
                $('#color_orientation_full_value').val($("#FullArea .orientation_fix .choose_orientation .active").attr('color-orientation'));
               // alert( $('#color_orientation_full_value').val());
            } else {
                var color1 = '';
                var color2 = '';
                var gColor = $('.selectFullMainColor.active').attr('color-class');
                if( gColor == 'blue_preview_1')
                {
                color1 = '#4d4d7c';
                color2 = '#1e1e40';
                }
				else if( gColor == 'red_preview_1')
                {
                color1 = '#e93474';
                color2 = '#541069';
                }
				else if( gColor == 'yellow_preview_1')
                {
                color1 = '#f9d84a';
                color2 = '#f9814a';
                }
				else if( gColor == 'orange_preview_1')
                {
                color1 = '#ef9d39';
                color2 = '#d92a3f';
                }
				else if( gColor == 'green_preview_1')
                {
                color1 = '#93cf48';
                color2 = '#076768';
                }
				else if( gColor == 'purple_preview_1')
                {
                color1 = '#4d4d7c';
                color2 = '#1e1e40';
                }
				
				var customOrientation = $(this).attr('color-orientation');
                $('.Parent').removeClass('red_preview_1');
                $('.Parent').removeAttr('style');

                if(customOrientation == 'circle')
                {
                $('.Parent').attr('style', 'background-image:radial-gradient('+customOrientation+', ' +color1+ ' 1%, ' +color2+ ')');
                }
                else
                {
                     
                $('.Parent').attr('style', 'background-image:linear-gradient('+customOrientation+', ' +color1+ ' 1%, ' +color2+ ')');
                  
                }
                
                $('#color_orientation_full_value').val($(this).attr('color-orientation'));
                
            
               //$('#color_orientation_full_value').val($(this).attr('color-orientation'));
            }
           if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
            
        }); // ********** CHOOSE ORIENTATION for Full area (fix) ************ // 
        
        
        
         // *********** Custom colors for Full area ************* // 
        $('#custom_colors1_full, #custom_colors2_full').change(function () {
          $("#area_type").val("2");
           // all buttons close on full action//
            $('#solid_color_switch').prop('checked', false);
            $('#solid_color_switch_bottom').prop('checked', false);
            $('#main_color_switch').prop('checked', false);
            $('#main_color_switch_bottom').prop('checked', false);
            $('#custom_color_switch').prop('checked', false); 
            $('#custom_color_switch_bottom').prop('checked', false);
             // all buttons close on full action//
              

            $('.customColor, .customColor i').attr('style', 'color:' + $('#custom_colors1_full').val() + '!important');
            $('.customColorBar').css('background-color', $('#custom_colors1_full').val());
            if ($('#custom_colors1_full').val() != '' && $('#custom_colors2_full').val() != '') {
                $('.headerbg, .subarea').removeClass('red_preview_1');
                $('.headerbg, .subarea').removeClass('yellow_preview_1');
                $('.headerbg, .subarea').removeClass('orange_preview_1');
                $('.headerbg, .subarea').removeClass('green_preview_1');
                $('.headerbg, .subarea').removeClass('blue_preview_1');
                $('.headerbg, .subarea').removeClass('purple_preview_1');
                 $('.headerbg, .subarea').removeClass('white_preview_1');
                $('#main_color_switch_full').prop('checked', false);
                $('#custom_color_switch_full').prop('checked', true);
                $('#solid_color_switch_full').prop('checked', false);
                $('.headerbg').css('background-image', 'linear-gradient(45deg, ' + $('#custom_colors1_full').val() + ' 1%, ' + $('#custom_colors2_full').val() + ')');
                $('.brand_page_gr').css('background', 'none');
            }
            if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
        });// Custom colors for Full area // 
        
        
            $('#addQuestionFrm').on('submit', function (e) {
            e.preventDefault();

            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url(); ?>/admin/brandboost/addFaqData",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data)
                {
                    if (data.status == "ok")
                    {
                            setTimeout(function () {
                            $('.overlaynew').hide();
                            window.location.href='?tab=3';
                        }, 1000);
                    } else {
                        alertMessage("Something went wrong");
                    }
                }
            });
        });
        
  
        
        
          $(document).on('click', '.FaQSection .chg_status', function () {
             
            $('.overlaynew').show();
            var status = $(this).attr('change_status');
             var faq_id = $(this).attr('faq_id');

            $.ajax({
                url: '<?php echo base_url(); ?>/admin/brandboost/update_faq_status',
                type: "POST",
                data: {status: status, faq_id: faq_id,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });
        
        
        $(document).on('click', '.deleteFaq', function () {
            var elem = $(this);
            var faq_id = $(this).attr('faq_id');
              deleteConfirmationPopup(
            "This Question will deleted immediately.<br>You can't undo this action.", 
            function() {
                $('.overlaynew').show();
              	$.ajax({
						url: '<?php echo base_url(); ?>/admin/brandboost/delete_faq',
						type: "POST",
						data: {'faq_id': faq_id},
						dataType: "json",
						success: function (data) {
                            if (data.status == 'success') {
						         $('.overlaynew').hide();
                                   window.location.href='?tab=3';
                            } else {
								alertMessage('Error: Some thing wrong!');
								$('.overlaynew').hide();
							}
						}
					});
            });
		});


        $('#frmSubmitCampaign').on('submit', function(e) {
            e.preventDefault();

            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url(); ?>/admin/brandboost/addBrandCampaign",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data)
                {
                    if (data.status == "ok")
                    {
                        setTimeout(function () {
                            $('.overlaynew').hide();
                             displayMessagePopup();
                            //window.location.href = 'http://brandboost.io/admin/brandboost/brand_configuration/' + $('#design_brandboost_id').val();
                        }, 1000);
                    } else {
                        alertMessage("Something went wrong");
                    }
                }
            });

        });
        

        $('#frmSubmit').on('submit', function (e) {
            e.preventDefault();

            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url(); ?>/admin/brandboost/addBrandConfigurationData",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data)
                {
                    if (data.status == "ok")
                    {
                        setTimeout(function () {
                            $('.overlaynew').hide();
                            displayMessagePopup();
                            $('.tabbable a[href="#Design"]').click();
                        }, 1000);
                    } else {
                        alertMessage("Something went wrong");
                    }
                }
            });
        });
        
        $('#brand_themes').on('change', function() {
            //$('.overlaynew').show();
            
            
             $.ajax({
                url: "<?php echo base_url(); ?>/admin/brandboost/getBrandThemeData",
                method: "POST",
                data: {'BrandthemeId': this.value,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data)
                {
                   
                    if (data.status == "ok")
                    {
                         if(data.company_logo=='')
                         {
                         $(".company_avatar").attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+data.default_logo);
                         }
                          if(data.company_header_logo=='')
                         {
                         $(".company_header_avatar").attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+data.default_header_logo);
                         }
                        
                        
                        if(data.area_type == '1')
                        {
                            $('#topPlaneSecSwitch').prop("checked", true);
                            $('#FullPlaneSecSwitch').prop("checked", false);
                            $('#TopArea').show();
                            $('#FullArea').hide();
                            
                            if(data.header_color_solid =='1')
                            {
                                
                               // $('#main_color_switch').prop("checked", false);
                                $('#solid_color_switch').prop("checked", true);
                                
                                $('.solid_color_switch_div').show();
                                
                               
                                $('#solid_color').val(data.header_solid_color);
                                $('#TopArea .solidcolorpicker i').css('color',data.header_solid_color);
                                $('#solid_color_switch').trigger("change");
                                
                            }
                            else if(data.header_color_fix =='1')
                            {  
                                $('#main_color_switch').prop("checked", true);
                                $('.main_color_switch_div').show();
                                 $('.main_color_switch_div').show();
                                 $('#TopArea .orientation_top_fix').show();
                                $('#TopArea .orientation_top').hide();
                                $('.custom_color_switch_div').hide();
                                $('#TopArea .selectMainColor[color-data="'+data.header_color+'"]').click();
                                
                                if(data.color_orientation_top == 'to right top' && data.color_orientation_top!='')
                                    { 
                                    $('#TopArea .orientation_top_fix .choose_orientation li.torighttop a').addClass("active"); 
                                    $('#TopArea .orientation_top_fix .choose_orientation li.torighttop a').trigger("click"); 

                                    } 
                                    else if(data.color_orientation_top == 'to right' && data.color_orientation_top!='')
                                    {
                                    $('#TopArea .orientation_top_fix li.toright a').addClass("active");   
                                    $('#TopArea .orientation_top_fix li.toright a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'to right bottom' && data.color_orientation_top!='')
                                    {
                                     $('#TopArea .orientation_top_fix li.torightbottom a').addClass("active"); 
                                     $('#TopArea .orientation_top_fix li.torightbottom a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'to bottom' && data.color_orientation_top!='')
                                    {
                                    $('#TopArea .orientation_top_fix .choose_orientation li.tobottom a').addClass("active"); 
                                    $('#TopArea .orientation_top_fix .choose_orientation li.tobottom a').trigger("click"); 
                                    }
                                    else if(data.color_orientation_top == 'to left bottom' && data.color_orientation_top!='')
                                    {
                                        $('#TopArea .orientation_top_fix .toleftbottom a').addClass("active"); 
                                    $('#TopArea .orientation_top_fix .toleftbottom a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'to left' && data.color_orientation_top!='')
                                    {
                                        $('#TopArea .orientation_top_fix .toleft a').addClass("active"); 
                                        $('#TopArea .orientation_top_fix .toleft a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'to left top' && data.color_orientation_top!='')
                                    {
                                     $('#TopArea .orientation_top_fix .choose_orientation li.tolefttop a').addClass("active");  
                                     $('#TopArea .orientation_top_fix .choose_orientation li.tolefttop a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'to top' && data.color_orientation_top!='')
                                    {
                                    $('#TopArea .orientation_top_fix .choose_orientation li.totop a').addClass("active");   
                                    $('#TopArea .orientation_top_fix .choose_orientation li.totop a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'circle' && data.color_orientation_top!='')
                                    {
                                    $('#TopArea .orientation_top_fix .choose_orientation li.circle a').addClass("active");  
                                    $('#TopArea .orientation_top_fix .choose_orientation li.circle a').trigger("click");  
                                    }
                                
                                
                                
                            }
                            
                             if(data.header_color_custom =='1')
                            {
                                
                                $('#custom_color_switch').prop("checked", true);
                                $('#custom_colors1').val(data.header_custom_color1);
                                 $('#custom_colors2').val(data.header_custom_color2);
                                $('.custom_color_switch_div').show();
                                 $('#TopArea .orientation_top').show();
                                 $('#TopArea .orientation_top_fix').hide();
                                $('.main_color_switch_div').hide();
                                
                                
                                $('#TopArea .colorpicker1 i').css('color',data.header_custom_color1);
                                $('#TopArea .colorpicker2 i').css('color',data.header_custom_color2);
                                $('#custom_color_switch').trigger("change");
                                
                                 if(data.color_orientation_top == 'to right top' && data.color_orientation_top!='')
                                    { 
                                    $('#TopArea .orientation_top .choose_orientation li.torighttop a').addClass("active"); 
                                    $('#TopArea .orientation_top .choose_orientation li.torighttop a').trigger("click"); 

                                    } 
                                    else if(data.color_orientation_top == 'to right' && data.color_orientation_top!='')
                                    {
                                    $('#TopArea .orientation_top .choose_orientation li.toright a').addClass("active");   
                                    $('#TopArea .orientation_top .choose_orientation li.toright a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'to right bottom' && data.color_orientation_top!='')
                                    {
                                     $('#TopArea .orientation_top .choose_orientation li.torightbottom a').addClass("active"); 
                                     $('#TopArea .orientation_top .choose_orientation li.torightbottom a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'to bottom' && data.color_orientation_top!='')
                                    {
                                    $('#TopArea .orientation_top .choose_orientation li.tobottom a').addClass("active"); 
                                    $('#TopArea .orientation_top .choose_orientation li.tobottom a').trigger("click"); 
                                    }
                                    else if(data.color_orientation_top == 'to left bottom' && data.color_orientation_top!='')
                                    {
                                    $('#TopArea .orientation_top .choose_orientation li.toleftbottom a').addClass("active"); 
                                    $('#TopArea .orientation_top .choose_orientation li.toleftbottom a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'to left' && data.color_orientation_top!='')
                                    {
                                        $('#TopArea .orientation_top .choose_orientation li.toleft a').addClass("active"); 
                                        $('#TopArea .orientation_top .choose_orientation li.toleft a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'to left top' && data.color_orientation_top!='')
                                    {
                                     $('#TopArea .orientation_top .choose_orientation li.tolefttop a').addClass("active");  
                                     $('#TopArea .orientation_top .choose_orientation li.tolefttop a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'to top' && data.color_orientation_top!='')
                                    {
                                    $('#TopArea .orientation_top .choose_orientation li.totop a').addClass("active");   
                                    $('#TopArea .orientation_top .choose_orientation li.totop a').trigger("click");  
                                    }
                                    else if(data.color_orientation_top == 'circle' && data.color_orientation_top!='')
                                    {
                                    $('#TopArea .orientation_top .choose_orientation li.circle a').addClass("active");  
                                    $('#TopArea .orientation_top .choose_orientation li.circle a').trigger("click");  
                                    }
                                
                                
                                
                            }
                            
                            
                        }
                      else  if(data.area_type == '2')
                        {
                              $('#FullPlaneSecSwitch').prop("checked", true);
                              $('#topPlaneSecSwitch').prop("checked", false);
                              $('#TopArea').hide();


                              $('#FullArea').show();
                            
                            if(data.header_color_solid =='1')
                            {
                                
                                $('#solid_color_switch_full').prop("checked", true);
                                 $('.solid_color_switch_full_div').show();
                                
                                $('.main_color_switch_full_div').hide();
                                $('#solid_color_full').val(data.header_solid_color);
                                $('#FullArea .solidcolorpicker i').css('color',data.header_solid_color);
                                $('#solid_color_switch_full').trigger("change");
                                
                            }
                            else if(data.header_color_fix =='1')
                            {
                                $('#main_color_switch_full').prop("checked", true);
                                $('#FullArea .selectFullMainColor[color-data="'+data.header_color+'"]').click();
                                 $('.main_color_switch_full_div').show();
                                $('#FullArea .orientation_fix').show();
                                  $('#FullArea .orientation_full').hide();
                                
                                 
                                    if(data.color_orientation_full == 'to right top' && data.color_orientation_full!='')
                                    { 
                                    $('#FullArea .orientation_fix .choose_orientation li.torighttop a').addClass("active"); 
                                    $('#FullArea .orientation_fix .choose_orientation li.torighttop a').trigger("click"); 

                                    } 
                                    else if(data.color_orientation_full == 'to right' && data.color_orientation_full!='')
                                    {
                                    $('#FullArea .orientation_fix li.toright a').addClass("active");   
                                    $('#FullArea .orientation_fix li.toright a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'to right bottom' && data.color_orientation_full!='')
                                    {
                                     $('#FullArea .orientation_fix li.torightbottom a').addClass("active"); 
                                     $('#FullArea .orientation_fix li.torightbottom a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'to bottom' && data.color_orientation_full!='')
                                    {
                                    $('#FullArea .orientation_fix .choose_orientation li.tobottom a').addClass("active"); 
                                    $('#FullArea .orientation_fix .choose_orientation li.tobottom a').trigger("click"); 
                                    }
                                    else if(data.color_orientation_full == 'to left bottom' && data.color_orientation_full!='')
                                    {
                                        $('#FullArea .orientation_fix .toleftbottom a').addClass("active"); 
                                    $('#FullArea .orientation_fix .toleftbottom a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'to left' && data.color_orientation_full!='')
                                    {
                                        $('#FullArea .orientation_fix .toleft a').addClass("active"); 
                                        $('#FullArea .orientation_fix .toleft a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'to left top' && data.color_orientation_full!='')
                                    {
                                     $('#FullArea .orientation_fix .choose_orientation li.tolefttop a').addClass("active");  
                                     $('#FullArea .orientation_fix .choose_orientation li.tolefttop a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'to top' && data.color_orientation_full!='')
                                    {
                                    $('#FullArea .orientation_fix .choose_orientation li.totop a').addClass("active");  
                                     $('#FullArea .orientation_fix .choose_orientation li.totop a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'circle' && data.color_orientation_full!='')
                                    {
                                   $('#FullArea .orientation_fix .choose_orientation li.circle a').addClass("active");  
                                     $('#FullArea .orientation_fix .choose_orientation li.circle a').trigger("click");  
                                    }
                                
                                
                            }
                            
                             if(data.header_color_custom =='1')
                            {
                                
                                $('#custom_color_switch_full').prop("checked", true);
                                $('#FullArea #custom_colors1_full').val(data.header_custom_color1);
                                 $('#FullArea #custom_colors2_full').val(data.header_custom_color2);
                                $('.custom_color_switch_full_div').show();
                                $('.main_color_switch_full_div').hide();
                                
                                 $('#FullArea .orientation_fix').hide();
                                  $('#FullArea .orientation_full').show();
                                
                                
                                $('#FullArea .colorpicker1 i').css('color',data.header_custom_color1);
                                $('#FullArea .colorpicker2 i').css('color',data.header_custom_color2);
                                $('#custom_color_switch_full').trigger("change");
                                
                                
                                 if(data.color_orientation_full == 'to right top' && data.color_orientation_full!='')
                                    { 
                                    $('#FullArea .orientation_full .choose_orientation li.torighttop a').addClass("active"); 
                                    $('#FullArea .orientation_full .choose_orientation li.torighttop a').trigger("click"); 

                                    } 
                                    else if(data.color_orientation_full == 'to right' && data.color_orientation_full!='')
                                    {
                                    $('#FullArea .orientation_full .choose_orientation li.toright a').addClass("active");   
                                    $('#FullArea .orientation_full .choose_orientation li.toright a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'to right bottom' && data.color_orientation_full!='')
                                    {
                                     $('#FullArea .orientation_full .choose_orientation li.torightbottom a').addClass("active"); 
                                     $('#FullArea .orientation_full .choose_orientation li.torightbottom a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'to bottom' && data.color_orientation_full!='')
                                    {
                                    $('#FullArea .orientation_full .choose_orientation li.tobottom a').addClass("active"); 
                                    $('#FullArea .orientation_full .choose_orientation li.tobottom a').trigger("click"); 
                                    }
                                    else if(data.color_orientation_full == 'to left bottom' && data.color_orientation_full!='')
                                    {
                                        $('#FullArea .orientation_full .choose_orientation li.toleftbottom a').addClass("active"); 
                                    $('#FullArea .orientation_full .choose_orientation li.toleftbottom a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'to left' && data.color_orientation_full!='')
                                    {
                                        $('#FullArea .orientation_full .choose_orientation li.toleft a').addClass("active"); 
                                        $('#FullArea .orientation_full .choose_orientation li.toleft a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'to left top' && data.color_orientation_full!='')
                                    {
                                     $('#FullArea .orientation_full .choose_orientation li.tolefttop a').addClass("active");  
                                     $('#FullArea .orientation_full .choose_orientation li.tolefttop a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'to top' && data.color_orientation_full!='')
                                    {
                                    $('#FullArea .orientation_full .choose_orientation li.totop a').addClass("active");   
                                    $('#FullArea .orientation_full .choose_orientation li.totop a').trigger("click");  
                                    }
                                    else if(data.color_orientation_full == 'circle' && data.color_orientation_full!='')
                                    {
                                    $('#FullArea .orientation_full .choose_orientation li.circle a').addClass("active");  
                                    $('#FullArea .orientation_full .choose_orientation li.circle a').trigger("click");  
                                    }
                                
                                
                                
                                
                            }
                            
                            
                        }
                        
                        
                    } else {
                        alertMessage("Something went wrong");
                    }
                    
                  // setTimeout(function(){  $('.overlaynew').hide(); }, 3000);
                }
            });
        
        });
        

        $('#frmDesignSubmit').on('submit', function (e) {
            //return false;
             e.preventDefault();
            $('.overlaynew').show();
            
            // $('#color_orientation_full_value').val($('#FullArea .choose_orientation .active').attr('color-orientation'));
            //$('#color_orientation_top_value').val($('#TopArea .choose_orientation .active').attr('color-orientation'));
		
            $.ajax({
                url: "<?php echo base_url(); ?>/admin/brandboost/updateBrandConfigurationData",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data)
                {
                    if (data.status == "ok")
                    {
                        setTimeout(function () {
                          setTimeout(function(){  $('.overlaynew').hide(); displayMessagePopup(); }, 2000);
                           
                             if($('#brand_theme_title').val()!='') {  window.location.href='';  } 
                            $('.tabbable a[href="#Campaign"]').click();
                            //window.location.href = 'http://brandboost.io/admin/brandboost/brand_configuration/' + $('#design_brandboost_id').val();
                        }, 1000);
                    } else {
                        alertMessage("Something went wrong");
                    }
                }
            });
        });

        $('.setPositionValue').click(function () {
            alert($(this).attr('field-data'));
            $(this).parent().parent().prev().val($(this).attr('field-data'));
        });

        $(document).on('change', '.changeAction', function () {
            var actionType = $(this).attr('action-type');
            var actionValue = $(this).val();
            //alert(actionType);
            if ($(this).prop('checked') == true) {
                if (actionType == 'avatar') {
                    $('.avatarSection').show();
                    $('.aboutCompanySection').parent().addClass('pl30');
                }

                if (actionType == 'company_description') {
                    $('.companySection').show();
                }

                if (actionType == 'services') {
                    $('.servicesSection').show();
                }

                if (actionType == 'contact_btn') {
                    $('.contactUsBtnSection').show();
                }

                if (actionType == 'contact_info') {
                    $('.contactInfoSection').show();
                }

                if (actionType == 'socials') {
                    $('.socialSection').show();
                }

                if (actionType == 'customer_experiance') {
                    $('.customerExpSection').show();
                }

                if (actionType == 'chat_widget') {
                    //$('.customerExpSection').show();
                }

                if (actionType == 'referral_widget') {
                    //$('.customerExpSection').show();
                }
            } else {
                if (actionType == 'avatar') {
                    $('.avatarSection').hide();
                    $('.aboutCompanySection').parent().removeClass('pl30');
                }

                if (actionType == 'company_description') {
                    $('.companySection').hide();
                }

                if (actionType == 'services') {
                    $('.servicesSection').hide();
                }

                if (actionType == 'contact_btn') {
                    $('.contactUsBtnSection').hide();
                }

                if (actionType == 'contact_info') {
                    $('.contactInfoSection').hide();
                }

                if (actionType == 'socials') {
                    $('.socialSection').hide();
                }

                if (actionType == 'customer_experiance') {
                    $('.customerExpSection').hide();
                }

                if (actionType == 'chat_widget') {
                    //$('.customerExpSection').hide();
                }

                if (actionType == 'referral_widget') {
                    //$('.customerExpSection').hide();
                }
            }

            if (actionType == 'about_company') {
                if (actionValue == 'left' || actionValue == '') {
                    $('.aboutCompanySection').css('float', 'left');
                    //$('.leftPosition').show();
                    //$('.rightPosition').hide();
                    //$('#reviews_list_position').val('right');
                } else {
                    $('.aboutCompanySection').css('float', 'right');
                    //$('.leftPosition').hide();
                    //$('.rightPosition').show();
                    //$('#reviews_list_position').val('left');
                }
            }

            if (actionType == 'review_list') {
                $('.mediaSection').css('float', 'left');
                if (actionValue == 'left') {
                    $('.mediaSection').css('float', 'right');
                    //$('.leftPosition').hide();
                    //$('.rightPosition').show();
                    //$('#about_company_position').val('right');
                } else {
                    //$('.leftPosition').show();
                    //$('.rightPosition').hide();
                    //$('#about_company_position').val('left');
                }
            }

            if (actionType == 'rating') {
                if (actionValue == 'on') {
                    $('.ratingSection').show();
                } else {
                    $('.ratingSection').hide();
                }
            }
        });

        
        // ******** move colors custom color1 for top area *********** // 
        var greadentColor1 = $('#custom_colors1').val();
        var greadentColor1_bottom = $('#custom_colors1_bottom').val();
        var greadentColor1_full = $('#custom_colors1_full').val();

        $("#TopArea .colorpicker1").spectrum({
            change: function (color) {
                $("#area_type").val("1");
            $(".Parent").removeAttr("style");
            $('.headerbg, .subarea, .Parent').removeClass('red_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('yellow_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('orange_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('green_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('blue_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('purple_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('white_preview_1');
            $('.headerbg, .subarea, .Parent').css('background-image', '');
            // all buttons close on full action//
            $('#solid_color_switch_bottom').prop('checked', false);
            $('#main_color_switch_bottom').prop('checked', false);
            $('#custom_color_switch_bottom').prop('checked', false);
            $('#solid_color_switch_full').prop('checked', false);
            $('#main_color_switch_full').prop('checked', false);
            $('#custom_color_switch_full').prop('checked', false);
            // all buttons close on full action//
                
                greadentColor1 = color.toHexString();
                $('#custom_colors1').val(color.toHexString());
                $('#TopArea .colorpicker1 i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColorBar').css('background-color', color.toHexString());
                if ($('#custom_colors1').val() != '' && $('#custom_colors2').val() != '') {
                    $('.headerbg').removeClass('red_preview_1');
                    $('.headerbg').removeClass('yellow_preview_1');
                    $('.headerbg').removeClass('orange_preview_1');
                    $('.headerbg').removeClass('green_preview_1');
                    $('.headerbg').removeClass('blue_preview_1');
                    $('.headerbg').removeClass('purple_preview_1');
                     $('.headerbg').removeClass('white_preview_1');
                    $('#main_color_switch').prop('checked', false);
                    $('#custom_color_switch').prop('checked', true);
                    $('#solid_color_switch').prop('checked', false);
                    $('.headerbg').css('background-image', 'linear-gradient(45deg, ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                }
                
                 if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
            },
            move: function (color) {
                greadentColor1 = color.toHexString();
                //$('#custom_colors1').val(color.toHexString());
                $('#TopArea .colorpicker1 i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColorBar').css('background-color', color.toHexString());
                //if($('#custom_colors1').val() != '' && $('#custom_colors2').val() != ''){
                $('.headerbg').removeClass('red_preview_1');
                $('.headerbg').removeClass('yellow_preview_1');
                $('.headerbg').removeClass('orange_preview_1');
                $('.headerbg').removeClass('green_preview_1');
                $('.headerbg').removeClass('blue_preview_1');
                $('.headerbg').removeClass('purple_preview_1');
                $('#main_color_switch').prop('checked', false);
                $('#custom_color_switch').prop('checked', true);
                $('#solid_color_switch').prop('checked', false);
                $('.headerbg').css('background-image', 'linear-gradient(45deg, ' + color.toHexString() + ' 1%, ' + $('#custom_colors2').val() + ')');
                //}
            }
        }); // move colors custom color1 for top area // 
        
        
        

        
        
        
              // *********** move colors custom color1 for Full area ************** // 
       
        $("#FullArea .colorpicker1").spectrum({
            change: function (color) {
                $("#area_type").val("2");
              // all buttons close on full action//
            $('#solid_color_switch').prop('checked', false);
            $('#solid_color_switch_bottom').prop('checked', false);
            $('#main_color_switch').prop('checked', false);
            $('#main_color_switch_bottom').prop('checked', false);
            $('#custom_color_switch').prop('checked', false); 
            $('#custom_color_switch_bottom').prop('checked', false);
             // all buttons close on full action//
              
                greadentColor1_full = color.toHexString();
                $('#custom_colors1_full').val(color.toHexString());
                $('#FullArea .colorpicker1 i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColorBar').css('background-color', color.toHexString());
                if ($('#custom_colors1_full').val() != '' && $('#custom_colors2').val() != '') {
                    $('.brand_page_gr').css('background', 'none');
                    $('.subarea').css('background', 'none');
                    $('.headerbg, .subarea').removeClass('red_preview_1');
                    $('.headerbg, .subarea').removeClass('yellow_preview_1');
                    $('.headerbg, .subarea').removeClass('orange_preview_1');
                    $('.headerbg, .subarea').removeClass('green_preview_1');
                    $('.headerbg, .subarea').removeClass('blue_preview_1');
                    $('.headerbg, .subarea').removeClass('purple_preview_1');
                     $('.headerbg, .subarea').removeClass('white_preview_1');
                    $('#main_color_switch_full').prop('checked', false);
                    $('#custom_color_switch_full').prop('checked', true);
                    $('#solid_color_switch_full').prop('checked', false);
                    $('.Parent').css('background-image', 'linear-gradient(45deg, ' + $('#custom_colors1_full').val() + ' 1%, ' + $('#custom_colors2_full').val() + ')');
                    
                }
                if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
            },
            move: function (color) {

          // all buttons close on full action//
            $('#solid_color_switch').prop('checked', false);
            $('#solid_color_switch_bottom').prop('checked', false);
            $('#main_color_switch').prop('checked', false);
            $('#main_color_switch_bottom').prop('checked', false);
            $('#custom_color_switch').prop('checked', false); 
            $('#custom_color_switch_bottom').prop('checked', false);
             // all buttons close on full action//
              

                greadentColor1_full = color.toHexString();
                //$('#custom_colors1').val(color.toHexString());
                $('#FullArea .colorpicker1 i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColorBar').css('background-color', color.toHexString());
                //if($('#custom_colors1').val() != '' && $('#custom_colors2').val() != ''){
                 $('.brand_page_gr').css('background', 'none');
                $('.subarea').css('background', 'none');
                $('.headerbg, .subarea').removeClass('red_preview_1');
                $('.headerbg, .subarea').removeClass('yellow_preview_1');
                $('.headerbg, .subarea').removeClass('orange_preview_1');
                $('.headerbg, .subarea').removeClass('green_preview_1');
                $('.headerbg, .subarea').removeClass('blue_preview_1');
                $('.headerbg, .subarea').removeClass('purple_preview_1');
                 $('.headerbg, .subarea').removeClass('white_preview_1');
                $('#main_color_switch_full').prop('checked', false);
                $('#custom_color_switch_full').prop('checked', true);
                $('#solid_color_switch_full').prop('checked', false);
                $('.Parent').css('background-image', 'linear-gradient(45deg, ' + color.toHexString() + ' 1%, ' + $('#custom_colors2_full').val() + ')');
               
                //}
            }
        }); // move colors custom color1 for Full area // 
        
        
        
            // ************** move colors custom color2 for Top area ************ // 
        $("#TopArea .colorpicker2").spectrum({
            change: function (color) {
                $("#area_type").val("1");
        $(".Parent").removeAttr("style");
        $('.headerbg, .subarea, .Parent').removeClass('red_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('yellow_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('orange_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('green_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('blue_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('purple_preview_1');
        $('.headerbg, .subarea, .Parent').removeClass('white_preview_1');
        $('.headerbg, .subarea, .Parent').css('background-image', '');
        // all buttons close on full action//
        $('#solid_color_switch_bottom').prop('checked', false);
        $('#main_color_switch_bottom').prop('checked', false);
        $('#custom_color_switch_bottom').prop('checked', false);
        $('#solid_color_switch_full').prop('checked', false);
        $('#main_color_switch_full').prop('checked', false);
        $('#custom_color_switch_full').prop('checked', false);
        // all buttons close on full action//
                
                
                $('#custom_colors2').val(color.toHexString());
                $('#TopArea .colorpicker2 i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + greadentColor1 + '!important');
                $('.customColorBar').css('background-color', greadentColor1);
                if ($('#custom_colors1').val() != '' && $('#custom_colors2').val() != '') {
                    $('.headerbg').removeClass('red_preview_1');
                    $('.headerbg').removeClass('yellow_preview_1');
                    $('.headerbg').removeClass('orange_preview_1');
                    $('.headerbg').removeClass('green_preview_1');
                    $('.headerbg').removeClass('blue_preview_1');
                    $('.headerbg').removeClass('purple_preview_1');
                    $('.headerbg').removeClass('white_preview_1');
                    $('#main_color_switch').prop('checked', false);
                    $('#custom_color_switch').prop('checked', true);
                    $('#solid_color_switch').prop('checked', false);
                    $('.headerbg').css('background-image', 'linear-gradient(45deg, ' + $('#custom_colors1').val() + ' 1%, ' + $('#custom_colors2').val() + ')');
                }
                 $('#frmDesignSubmit').trigger('submit');
            },
            move: function (color) {
                //$('#custom_colors2').val(color.toHexString());
                $('#TopArea .colorpicker2 i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + greadentColor1 + '!important');
                $('.customColorBar').css('background-color', greadentColor1);
                //if($('#custom_colors1').val() != '' && $('#custom_colors2').val() != ''){
                $('.headerbg').removeClass('red_preview_1');
                $('.headerbg').removeClass('yellow_preview_1');
                $('.headerbg').removeClass('orange_preview_1');
                $('.headerbg').removeClass('green_preview_1');
                $('.headerbg').removeClass('blue_preview_1');
                $('.headerbg').removeClass('purple_preview_1');
                $('.headerbg').removeClass('white_preview_1');
                $('#main_color_switch').prop('checked', false);
                $('#custom_color_switch').prop('checked', true);
                $('#solid_color_switch').prop('checked', false);
                $('.headerbg').css('background-image', 'linear-gradient(45deg, ' + greadentColor1 + ' 1%, ' + color.toHexString() + ')');
                //}
            }
        });  // move colors custom color2 for Top area // 
        

        
        
           // *********** move colors custom color2 for Full area ************** // 
        $("#FullArea .colorpicker2").spectrum({
            change: function (color) {
                $("#area_type").val("2");
                greadentColor1_full = color.toHexString();
                $('#custom_colors2_full').val(color.toHexString());
                $('#FullArea .colorpicker2 i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + greadentColor1_full + '!important');
                $('.customColorBar').css('background-color', greadentColor1_full);
                if ($('#custom_colors1_full').val() != '' && $('#custom_colors2_full').val() != '') {
                    $('.brand_page_gr').css('background', 'none'); 
                    $('.subarea').css('background', 'none'); 
                    $('.headerbg, .subarea').removeClass('red_preview_1');
                    $('.headerbg, .subarea').removeClass('yellow_preview_1');
                    $('.headerbg, .subarea').removeClass('orange_preview_1');
                    $('.headerbg, .subarea').removeClass('green_preview_1');
                    $('.headerbg, .subarea').removeClass('blue_preview_1');
                    $('.headerbg, .subarea').removeClass('purple_preview_1');
                     $('.headerbg, .subarea').removeClass('white_preview_1');
                    $('#main_color_switch_full').prop('checked', false);
                    $('#custom_color_switch_full').prop('checked', true);
                    $('#solid_color_switch_full').prop('checked', false);
                    $('.Parent').css('background-image', 'linear-gradient(45deg, ' + $('#custom_colors1_full').val() + ' 1%, ' + $('#custom_colors2_full').val() + ')');
                   if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }        }
            },
            move: function (color) {
                //$('#custom_colors2').val(color.toHexString());
                greadentColor1_full = color.toHexString();
                $('#FullArea .colorpicker2 i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + greadentColor1_full + '!important');
                $('.customColorBar').css('background-color', greadentColor1_full);
                //if($('#custom_colors1').val() != '' && $('#custom_colors2').val() != ''){
                 $('.brand_page_gr').css('background', 'none'); 
                 $('.subarea').css('background', 'none'); 
                $('.headerbg , .subarea').removeClass('red_preview_1');
                $('.headerbg , .subarea').removeClass('yellow_preview_1');
                $('.headerbg , .subarea').removeClass('orange_preview_1');
                $('.headerbg , .subarea').removeClass('green_preview_1');
                $('.headerbg , .subarea').removeClass('blue_preview_1');
                $('.headerbg , .subarea').removeClass('purple_preview_1');
                $('.headerbg , .subarea').removeClass('white_preview_1');
                $('#main_color_switch_full').prop('checked', false);
                $('#custom_color_switch_full').prop('checked', true);
                $('#solid_color_switch_full').prop('checked', false);
                $('.Parent').css('background-image', 'linear-gradient(45deg, ' + color.toHexString() + ' 1%, ' + $('#custom_colors1_full').val() + ')');
                              //}
            }
        });   // move colors custom color2 for Full area // 
        

        // *********** solidcolorpicker for Top area ************** // 
        $("#TopArea .solidcolorpicker").spectrum({
            change: function (color) {
                 $("#area_type").val("1");
            $(".Parent").removeAttr("style");
            $('.headerbg, .subarea, .Parent').removeClass('red_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('yellow_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('orange_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('green_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('blue_preview_1');
            $('.headerbg, .subarea, .Parent').removeClass('purple_preview_1');
             $('.headerbg, .subarea, .Parent').removeClass('white_preview_1');
            $('.headerbg, .subarea, .Parent').css('background-image', '');
            // all buttons close on full action//
            $('#solid_color_switch_bottom').prop('checked', false);
            $('#main_color_switch_bottom').prop('checked', false);
            $('#custom_color_switch_bottom').prop('checked', false);
            $('#solid_color_switch_full').prop('checked', false);
            $('#main_color_switch_full').prop('checked', false);
            $('#custom_color_switch_full').prop('checked', false);
            // all buttons close on full action//
                
                $('#solid_color').val(color.toHexString());
                $('#TopArea .solidcolorpicker i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColorBar').css('background-color', color.toHexString());
                if ($('#solid_color').val() != '') {
                    $('.headerbg').removeClass('red_preview_1');
                    $('.headerbg').removeClass('yellow_preview_1');
                    $('.headerbg').removeClass('orange_preview_1');
                    $('.headerbg').removeClass('green_preview_1');
                    $('.headerbg').removeClass('blue_preview_1');
                    $('.headerbg').removeClass('purple_preview_1');
                    $('.headerbg').removeClass('white_preview_1');
                    $('#main_color_switch').prop('checked', false);
                    $('#custom_color_switch').prop('checked', false);
                    $('#solid_color_switch').prop('checked', true);
                    $('.headerbg').css('background-image', '');
                    $('.headerbg').css('background', $('#solid_color').val());
                }
                if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
            },
            move: function (color) {
                //$('#solid_color').val(color.toHexString());
                $('#TopArea .solidcolorpicker i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColorBar').css('background-color', color.toHexString());
                //if($('#solid_color').val() != ''){
                $('.headerbg').removeClass('red_preview_1');
                $('.headerbg').removeClass('yellow_preview_1');
                $('.headerbg').removeClass('orange_preview_1');
                $('.headerbg').removeClass('green_preview_1');
                $('.headerbg').removeClass('blue_preview_1');
                $('.headerbg').removeClass('purple_preview_1');
                $('.headerbg').removeClass('white_preview_1');
                $('#main_color_switch').prop('checked', false);
                $('#custom_color_switch').prop('checked', false);
                $('#solid_color_switch').prop('checked', true);
                $('.headerbg').css('background-image', '');
                $('.headerbg').css('background', color.toHexString());
                //}
            }
        });  // solidcolorpicker for Top area // 
        

        
                  // ********* solidcolorpicker for Full area **************8 // 
        $("#FullArea .solidcolorpicker").spectrum({
            change: function (color) {
                 $("#area_type").val("2");
                $('#solid_color_full').val(color.toHexString());
                $('#FullArea .solidcolorpicker i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColorBar').css('background-color', color.toHexString());
                if ($('#solid_color_full').val() != '') {
                    $('.headerbg, .subarea').removeClass('red_preview_1');
                    $('.headerbg, .subarea').removeClass('yellow_preview_1');
                    $('.headerbg, .subarea').removeClass('orange_preview_1');
                    $('.headerbg, .subarea').removeClass('green_preview_1');
                    $('.headerbg, .subarea').removeClass('blue_preview_1');
                    $('.headerbg, .subarea').removeClass('purple_preview_1');
                    $('.headerbg, .subarea').removeClass('white_preview_1');
                    $('#main_color_switch_full').prop('checked', false);
                    $('#custom_color_switch_full').prop('checked', false);
                    $('#solid_color_switch_full').prop('checked', true);
                    $('.headerbg, .subarea, .Parent').css('background-image', '');
                    $('.Parent').css('background', $('#solid_color_full').val());
                }
                if($('#brand_theme_title').val() == "") { $('#frmDesignSubmit').trigger('submit'); }
            },
            move: function (color) {
                //$('#solid_color').val(color.toHexString());
                $('#FullArea .solidcolorpicker i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColor, .customColor i').attr('style', 'color:' + color.toHexString() + '!important');
                $('.customColorBar').css('background-color', color.toHexString());
                //if($('#solid_color').val() != ''){
                $('.headerbg, .subarea').removeClass('red_preview_1');
                $('.headerbg, .subarea').removeClass('yellow_preview_1');
                $('.headerbg, .subarea').removeClass('orange_preview_1');
                $('.headerbg, .subarea').removeClass('green_preview_1');
                $('.headerbg, .subarea').removeClass('blue_preview_1');
                $('.headerbg, .subarea').removeClass('purple_preview_1');
                 $('.headerbg, .subarea').removeClass('white_preview_1');
                $('#main_color_switch_full').prop('checked', false);
                $('#custom_color_switch_full').prop('checked', false);
                $('#solid_color_switch_full').prop('checked', true);
                $('.headerbg, .subarea, .Parent').css('background-image', '');
                $('.Parent').css('background', color.toHexString());
                //}
            }
        });  // solidcolorpicker for Full area // 
        
        
    });

    $(document).on('change', '.campaignSelectAll', function() {

        if($(this).prop('checked') == true) {

            $('.changeAction').prop('checked', true);
        }
        else {
            $('.changeAction').prop('checked', false);
        }
    });
</script> 

@endsection