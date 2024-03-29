@php
list($canRead, $canWrite) = fetchPermissions('Offsite Campaign');
@endphp

<style type="text/css">
    .socialIcon {
        font-size: 25px;
        display: block;
        width: 55px;
        height: 55px;
        background: #fff;
        line-height: 55px;
        border-radius: 100px;
        box-shadow: 0 2px 6px 0 rgba(0,0,0,.1);
    }
    .media-list.newd li.panel-body .media-left a{  padding: 35px 50px 0!important; }
    .input-group .form-control:not(:first-child):not(:last-child) { padding-left: 0; }
    .bkg1{background: #ffeceb!important}
    .bkg2{background: #d8f0e5!important}
    .bkg3{background: #e7f0ff!important}
    .bkg5{background: #dce9f6!important}
</style>

<div class="tab-pane {{ $camp }}" id="right-icon-tab1">
    <div class="hidden"><input type="checkbox" class="switchery" style="display: none!important;" checked="checked"></div>
    <form method="post" id="addOffstepList" action="#" >
        @php
        $offsite_ids = $brandboostData->offsite_ids;
        $offsite_ids = unserialize($offsite_ids);
        if (!empty($offsite_ids)) {
            $selected_list = implode(",", $offsite_ids);
        } else {
            $selected_list = 0;
        }
        $aUserInfo = getLoggedUser();
        @endphp

        <input type="hidden" name="selected_list" id='selected_list_r' value="{{ $selected_list }}">
        <input type="hidden" name="brandboostID" value="{{ $brandboostID }}">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">General</h6>
                        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                    </div>
                    <div class="panel-body p0">
                        <div class="configurations bbot p25">
                            <div class="form-group mb20">
                                <label class="control-label">Campaign Name</label>
                                <div class="">
                                    <input value="{{ ($brandboostData->brand_title) ? $brandboostData->brand_title : '' }}" name="edit_campaignName" id="edit_campaignName" class="form-control" readonly="readonly" type="text">
                                </div>
                            </div>

                            <p><span class="pull-left">Active Campaign</span><label class="custom-form-switch pull-right">
                                    <input class="field autoSave" type="checkbox" id="publishOnsiteCampaign" {{ $brandboostData->status == 1 ? 'checked' : '' }}>
                                    <span class="toggle"></span>
                                </label></p>
                            <div class="clearfix"></div>
                        </div>


                        <div class="p25 bbot">
                            <div class="form-group mb0">
                                <label class="custmo_radiobox pull-left mb20">
                                    <input name="feedback_type" class="autoSave" value="public" type="radio"
                                        @if(!empty($feedbackResponseData))
                                            {{ ($feedbackResponseData->feedback_type == '' || $feedbackResponseData->feedback_type == 'public') ? 'checked' : '' }}
                                        @endif
                                    >
                                    <span class="custmo_radiomark"></span>
                                    Public
                                </label>
                                <label class="custmo_radiobox pull-left mb20 ml10">
                                    <input  name="feedback_type" class="autoSave" value="private" type="radio"
                                        @if(!empty($feedbackResponseData))
                                            {{ ($feedbackResponseData->feedback_type == 'private') ? 'checked' : '' }}
                                        @endif
                                    >
                                    <span class="custmo_radiomark"></span>
                                    Private
                                </label>
                            </div>
                        </div>

                        <div class="configurations bbot p25">
                            <div class="form-group">
                                <label class="control-label">Home Page URL</label>
                                <div class="">
                                    <input value="@if (!empty($feedbackResponseData)){{($brandboostData->store_url) ? $brandboostData->store_url : ''}}@endif" name="store_url" id="store_url" class="form-control autoSave" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Review Request "Form" Name</label>
                                <div class="">
                                    <input value="@if(!empty($feedbackResponseData)){{($feedbackResponseData->from_name) ? $feedbackResponseData->from_name : $aUserInfo->firstname . ' ' . $aUserInfo->lastname}}@endif" name="from_name" id="from_name" class="form-control autoSave" type="text" onkeypress="return IsAlphabet(event);">
                                    <div class="errorMsg"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Review Request "Form" Email</label>
                                <div class="">
                                    <input value="@if (!empty($feedbackResponseData)){{($feedbackResponseData->from_email) ? $feedbackResponseData->from_email : $aUserInfo->email}}@endif" name="from_email" id="from_email" class="form-control autoSave" type="text">
                                    <div class="errorMsg"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">SMS Sender Name</label>
                                <div class="">
                                    <input value="@if (!empty($feedbackResponseData)){{($feedbackResponseData->sms_sender) ? $feedbackResponseData->sms_sender : $aUserInfo->firstname . ' ' . $aUserInfo->lastname}}@endif" name="sender_name" id="sender_name" class="form-control autoSave" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Review Request Language </label>
                                <div class="">
                                    <select class="form-control">
                                        <option>English (USA)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="p25 bbot">
                            <div class="form-group mb0">
                                <label class="custmo_radiobox pull-left mb20">
                                    <input name="ratings_type" class="autoSave" value="happy"
                                        @if (!empty($feedbackResponseData))
                                            {{ ($feedbackResponseData->ratings_type == '' || $feedbackResponseData->ratings_type == 'happy') ? 'checked' : '' }}
                                        @endif
                                    type="radio">
                                    <span class="custmo_radiomark"></span>
                                    Happy Ratings
                                </label>
                                <label class="custmo_radiobox pull-left mb20 ml10">
                                    <input name="ratings_type" class="autoSave" value="star"
                                        @if (!empty($feedbackResponseData))
                                            {{ ($feedbackResponseData->ratings_type == 'star') ? 'checked' : '' }}
                                        @endif
                                    type="radio">
                                    <span class="custmo_radiomark"></span>
                                    Star Ratings
                                </label>
                            </div>
                        </div>

                        <div class="p25" id="happyDiv" style="
                            @if (!empty($feedbackResponseData))
                                {{ ($feedbackResponseData->ratings_type == '' || $feedbackResponseData->ratings_type == 'happy') ? 'display:block' : 'display:none' }}
                            @endif
                        ">
                            <div class="review_button text-center">
                                <button class="btn dark_btn bkg_blue_light mr10 sh_no"><img width="12" src="{{ base_url("assets/images/rating5.png") }}"/>&nbsp;  I'm happy</button>
                                <button class="btn light_btn bkg_grey_light ml10 txt_dark sh_no"><img src="{{ base_url("assets/images/icons/rating2.svg") }}"/> &nbsp;  Unhappy</button>
                            </div>
                            <div class="clearfix mb20"></div>
                            <span class="pull-right"><a href="javascript:void(0)" data-toggle="modal" data-target="#previewHappy">Preview</a></span>
                        </div>

                        <div class="p25 text-center" id="starDiv" style="
                            @if(!empty($feedbackResponseData))
                                {{ $feedbackResponseData->ratings_type == 'star' ? 'display:block' : 'display:none' }}
                            @endif
                        ">
                            <a class="mr10" href="#"><img src="{{ base_url() }}assets/images/fill-start.png" width="26"></a>
                            <a class="mr10" href="#"><img src="{{ base_url() }}assets/images/fill-start.png" width="26"></a>
                            <a class="mr10" href="#"><img src="{{ base_url() }}assets/images/fill-start.png" width="26"></a>
                            <a class="mr10" href="#"><img src="{{ base_url() }}assets/images/fill-start.png" width="26"></a>
                            <a class="mr10" href="#"><img src="{{ base_url() }}assets/images/fill-start.png" width="26"></a>
                            <div class="clearfix mb20"></div>
                            <span class="pull-right"><a href="javascript:void(0)" data-toggle="modal" data-target="#previewStar">Preview</a></span>
                        </div>



                        @if ($canWrite)
                            <div class="p25 text-center btop hidden">
                                <button
                                    @if ($bActiveSubsription == false)
                                        class="btn dark_btn w100 bkg_purple pDisplayNoActiveSubscription" title="No Active Subscription" type="button"
                                    @else
                                        type="submit" class="btn dark_btn w100 bkg_purple saveOffsiteButton"
                                    @endif
                                    > Save <i class=" icon-arrow-right13 text-size-base position-right"></i>
                                </button>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Sources configuration</h6>
                        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                    </div>
                    <div class="panel-body p25">

                        <ul class="media-list newd">
                            @php
                            if (!empty($offsite_ids)) {
                                $thumbColor = ['bkg1', 'bkg2', 'bkg3', 'bkg4', 'bkg5', 'bkg6'];

                                foreach ($offsite_ids as $value) {
                                    if (!empty($value) && $value > 0) {
                                        $getData = getOffsite($value);
                                        //pre($getData);
                                        if (!empty($getData)) {
                                            $inc = rand(0, 5);
                                            $getLinksSocial = isset($offsites_links[$getData->id]['link']) ? $offsites_links[$getData->id]['link'] : '';

                                            $sourceName = strtolower($getData->name);

                                            if ($sourceName == 'yelp') {
                                                $sourceClass = 'txt_red';
                                                $thumbclass = 'bkg2';
                                                $sourceImg = 'yelp_logo.png';
                                            } else if ($sourceName == 'google') {
                                                $sourceClass = 'txt_blue';
                                                $thumbclass = 'bkg1';
                                                $sourceImg = 'google_add_co.png';
                                            } else if ($sourceName == 'yahoo') {
                                                $sourceClass = 'txt_purple';
                                                $thumbclass = 'bkg5';
                                                $sourceImg = 'yahoo_logo.png';
                                            } else if ($sourceName == 'facebook') {
                                                $sourceClass = 'txt_dblue';
                                                $thumbclass = 'bkg3';
                                                $sourceImg = 'facebook_icon.png';
                                            } else {
                                                $sourceClass = 'txt_blue';
                                                $thumbclass = 'bkg1';
                                                $sourceImg = 'lawyers_logo.png';
                                            }


                                            $sourceName = !empty($sourceName) ? $sourceName : 'NA';
                                            @endphp

                                            <li class="media panel-body stack-media-on-mobile" id="socialIcon{{ $value }}">
                                                <div class="media-left">
                                                    <a class="{{ $thumbclass }}" href="javascript:void(0)">
                                                        @if (in_array('OtherSources', unserialize($getData->site_categories)))
                                                            <i class="icon-{{ $sourceName . ' ' . $sourceClass }} socialIcon" style="font-style:inherit">M</i>
                                                        @else
                                                            <img src="/uploads/{{ $getData->image }}" height="45" width="45">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="col-md-12 mb-10 pl0 pr0">
                                                        <h5>{{ $getData->name }} </h5>
                                                        <h6>
                                                            @php
                                                            if (in_array('OtherSources', unserialize($getData->site_categories))) {
                                                                $getLinksSocial = $getLinksSocial != '' ? $getLinksSocial : $getData->website_url;
                                                                $str = str_replace("www.", "", preg_replace('#^https?://#', '', $getLinksSocial));
                                                                echo $str;
                                                            } else {

                                                                $str = preg_replace('#^https?://#', '', $getData->website_url);
                                                                echo $str;
                                                            }
                                                            @endphp
                                                        </h6>
                                                    </div>
                                                    <div class="col-md-12 pl0 pr0">
                                                        <div class="input-group">

                                                            @if (in_array('OtherSources', unserialize($getData->site_categories)))
                                                                <input style="text-align:left;" class="input-group-addon form-control autoSave siteURLId_{{ $getData->id }}" autocomplete="off" linkid="{{ $getData->id }}" id="linkUrl{{ $getData->id }}" name="offsite_url[]" value="{{ $getLinksSocial != '' ? $getLinksSocial : $getData->website_url }}" placeholder="Enter Web Address" type="text" required="required">
                                                            @else
                                                                <span class="input-group-addon" style="padding-right: 0;">{{ $getData->website_url }}</span>
                                                                <input class="form-control autoSave siteURLId_{{ $getData->id }}" autocomplete="off" linkid="{{ $getData->id }}" id="linkUrl{{ $getData->id }}" name="offsite_url[]" value="{{ $getLinksSocial != '' ? $getLinksSocial : '' }}" placeholder="Enter Web Address" type="text" required="required">
                                                            @endif
                                                            <input type="hidden" name="offsite_id[]" value="{{ $getData->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-right text-nowrap">
                                                    @if (in_array('OtherSources', unserialize($getData->site_categories)))
                                                        <button type="button" class="btn save white_btn previewButtonOthers" siteUrl="{{ $getData->website_url }}" siteId="{{ $getData->id }}">Preview </button> &nbsp;
                                                    @else
                                                        <button type="button" class="btn save white_btn previewButton" siteUrl="{{ $getData->website_url }}" siteId="{{ $getData->id }}">Preview </button> &nbsp;
                                                    @endif
                                                    <button type="button" style="padding: 4px 20px!important" class="btn save dark_btn getReview linkurlC"  bbID="{{ $brandboostID }}" linkid="{{ $getData->id }}">Save </button>
                                                    <button type="submit" class="offsite_selected_r cancle" offsiteSelected="1" offsiteId="{{ $getData->id }}"><i class="fa fa-close"></i></button>
                                                </div>
                                            </li>
                                            @php
                                        }
                                    }
                                }
                            }
                            @endphp
                        </ul>
                    </div>
                </div>

                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Thank you message</h6>
                        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                    </div>
                    <div class="panel-body p0">
                        <div class="configurations p25">
                            <div class="form-group">
                                <label class="control-label">Review Request Language  </label>
                                <div class="">
                                    <select class="form-control">
                                        <option>English (USA)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="profile_headings big">Positive <a class="pull-right plus_icon" href="#"><i class="icon-arrow-up5"></i></a></div>
                        <div class="configurations p25">
                            <div class="form-group">
                                <label class="control-label">Positive Title</label>
                                <div class="">
                                    <input class="form-control thankMsgTitle autoSave" name="positive_title" id="positive_title"
                                           value="@if (!empty($feedbackResponseData)){{($feedbackResponseData->pos_title) ? $feedbackResponseData->pos_title : 'Thanks for leaving positive review'}}@else{{'Thanks for leaving positive review'}}@endif" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Positive Subtitle</label>
                                <div class="">
                                    <input  class="form-control thankMsgSubTitle autoSave" name="positive_subtitle" id="positive_subtitle" value="@if (!empty($feedbackResponseData)){{ ($feedbackResponseData->pos_sub_title) ? $feedbackResponseData->pos_sub_title : 'We will revert back to you soon'}}@else{{'We will revert back to you soon'}}@endif" required="" type="text">
                                </div>
                            </div>
                            <div class="alert bkg_green txt_white mt30 mb0 preview">
                                <div class="media-left">
                                    <img src="{{ base_url() }}assets/images/thankyou_smiley_green.png"/>
                                </div>
                                <div class="media-left">
                                    <div class="thanksTitlePreview">
                                        @if (!empty($feedbackResponseData))
                                            {{ $feedbackResponseData->pos_title == '' ? 'Thanks for leaving positive review' : $feedbackResponseData->pos_title }}
                                        @else
                                            {{ 'Thanks for leaving positive review' }}
                                        @endif
                                    </div>
                                    <div>
                                        <small class="thanksSubTitlePreview">
                                        @if (!empty($feedbackResponseData))
                                                {{ $feedbackResponseData->pos_sub_title == '' ? 'We will revert back to you soon' : $feedbackResponseData->pos_sub_title }}
                                        @else
                                                {{ 'We will revert back to you soon' }}
                                        @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="profile_headings big">Neutral <a class="pull-right plus_icon" href="#"><i class="icon-arrow-up5"></i></a></div>
                        <div class="configurations p25">
                            <div class="form-group">
                                <label class="control-label">Neutral Title</label>
                                <div class="">
                                    <input class="form-control thankMsgTitle autoSave" name="neutral_title" id="neutral_title" value="@if (!empty($feedbackResponseData)){{($feedbackResponseData->neu_title) ? $feedbackResponseData->neu_title : 'Thanks for leaving your review'}}@else{{'Thanks for leaving your review'}}@endif" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Neutral Subtitle</label>
                                <div class="">
                                    <input class="form-control thankMsgSubTitle autoSave" name="neutral_subtitle"  id="neutral_subtitle" value="@if (!empty($feedbackResponseData)){{($feedbackResponseData->neu_sub_title) ? $feedbackResponseData->neu_sub_title : 'We will revert back to you soon'}}@else{{'We will revert back to you soon'}}@endif" required="" type="text">
                                </div>
                            </div>
                            <div class="alert bkg_grey txt_white mt30 mb0 preview">
                                <div class="media-left">
                                    <img src="{{ base_url() }}assets/images/thankyou_smiley_grey.png"/>
                                </div>
                                <div class="media-left">
                                    <div class="thanksTitlePreview">
                                        @if (!empty($feedbackResponseData))
                                            {{ $feedbackResponseData->neu_title == '' ? 'Thanks for leaving review' : $feedbackResponseData->neu_title }}
                                        @else
                                            {{ 'Thanks for leaving review' }}
                                        @endif
                                    </div>
                                    <div>
                                        <small class="thanksSubTitlePreview">
                                            @if (!empty($feedbackResponseData))
                                                {{ $feedbackResponseData->neu_sub_title == '' ? 'We will revert back to you soon' : $feedbackResponseData->neu_sub_title }}
                                            @else
                                                {{ 'We will revert back to you soon' }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="profile_headings big">Negative <a class="pull-right plus_icon" href="#"><i class="icon-arrow-up5"></i></a></div>
                        <div class="configurations p25">
                            <div class="form-group">
                                <label class="control-label">Negative Title</label>
                                <div class="">
                                    <input class="form-control thankMsgTitle autoSave" name="negetive_title" id="negetive_title"
                                           value="@if (!empty($feedbackResponseData)){{($feedbackResponseData->neg_title) ? $feedbackResponseData->neg_title:'Thanks for leaving your review'}}@else{{'Thanks for leaving your review'}}@endif" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Negative Subtitle</label>
                                <div class="">
                                    <input class="form-control thankMsgSubTitle autoSave" name="negetive_subtitle"  id="negetive_subtitle" value="@if (!empty($feedbackResponseData)){{($feedbackResponseData->neg_sub_title) ? $feedbackResponseData->neg_sub_title:'We will revert back to you soon' }}@else{{'We will revert back to you soon'}}@endif" required="" type="text">
                                </div>
                            </div>

                            <div class="alert bkg_red txt_white mt30 mb0 preview">
                                <div class="media-left">
                                    <img src="{{ base_url() }}assets/images/thankyou_smiley_red.png"/>
                                </div>
                                <div class="media-left">
                                    <div class="thanksTitlePreview">
                                        @if (!empty($feedbackResponseData))
                                            {{ $feedbackResponseData->neg_title == '' ? 'Thanks for leaving review' : $feedbackResponseData->neg_title }}
                                        @else
                                            {{ 'Thanks for leaving review' }}
                                        @endif
                                    </div>
                                    <div>
                                        <small class="thanksSubTitlePreview">
                                            @if (!empty($feedbackResponseData))
                                                {{ $feedbackResponseData->neg_sub_title == '' ? 'We will revert back to you soon' : $feedbackResponseData->neg_sub_title }}
                                            @else
                                                {{ 'We will revert back to you soon' }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div style="margin: 0;" class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Review Link Expiration Settings</h6>
                        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                    </div>
                    @php
                    $linkExpireReview = $brandboostData->link_expire_review;
                    $jsonCustomExpire = $brandboostData->link_expire_custom;

                    if ($jsonCustomExpire != '') {
                        $linkExpireCustom = json_decode($jsonCustomExpire);
                        $delayValue = $linkExpireCustom->delay_value;
                        $delayUnit = $linkExpireCustom->delay_unit;

                        if (empty($delayValue)) {
                            $delayValue = 'never';
                        }

                        if (empty($linkExpireReview)) {
                            $linkExpireReview = 'no';
                        }
                    } else {
                        $delayValue = 'never';
                        $linkExpireReview = 'no';
                        $delayUnit = '';
                    }
                    @endphp
                    <div class="panel-body p0">
                        <div class="p25 configurations  bbot">
                            <div class="form-group mb0">
                                <label class="control-label mb20">Automatically expire link after user leaves review?</label>
                                <div class="clearfix"></div>
                                <label class="custmo_radiobox pull-left mb20">
                                    <input name="review_expire" class="autoSave" value="yes" {{ ($linkExpireReview == 'yes') ? 'checked' : '' }} type="radio">
                                    <span class="custmo_radiomark"></span>
                                    Yes
                                </label>
                                <label class="custmo_radiobox pull-left mb20 ml10">
                                    <input name="review_expire" class="autoSave" value="no" {{ ($linkExpireReview == 'no') ? 'checked' : '' }} type="radio">
                                    <span class="custmo_radiomark"></span>
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="p25 configurations ">
                            <div class="form-group mb0">
                                <label class="control-label mb20">Automatically expire link </label>
                                <div class="clearfix"></div>
                                <label class="custmo_radiobox pull-left mb20">
                                    <input name="review_expire_link" class="autoSave" id="review_expire_link" value="never" {{ ($delayValue == "never") ? "checked" : "" }} type="radio">
                                    <span class="custmo_radiomark"></span>
                                    Never Expire
                                </label>
                                <div class="clearfix"></div>
                                <label class="custmo_radiobox pull-left mb20">
                                    <input name="review_expire_link" class="autoSave" id="review_expire_link" value="custom" {{ ($delayValue != "never") ? "checked" : "" }} type="radio">
                                    <span class="custmo_radiomark"></span>
                                    Expire After
                                </label>
                            </div>
                            <div class="clearfix mb-10"></div>
                            <div class="expireLinkBox" style="{{ ($delayValue == "never") ? "display:none;" : "display:block;" }}">
                                <div class="form-group">
                                    <input type="text" name="txtInteger" id="txtInteger" size="3" class="numaric_only form-control daysnumber2 autoSave" value="{{ ($delayValue > 0) ? $delayValue : '1' }}" />
                                </div>
                                <div class="form-group">
                                    <select class="form-control autoSave" name="exp_duration">
                                        <option value="day" {{ ($delayUnit == 'day') ? 'selected="selected"' : '' }}>Day</option>
                                        <option value="week" {{ ($delayUnit == 'week') ? 'selected="selected"' : '' }}>Week</option>
                                        <option value="month" {{ ($delayUnit == 'month') ? 'selected="selected"' : '' }}>Month</option>
                                        <option value="year" {{ ($delayUnit == 'year') ? 'selected="selected"' : '' }}>Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-right">
                @if ($canWrite)
                    <button
                        @if($bActiveSubsription == false)
                            class="btn dark_btn mt10 pDisplayNoActiveSubscription hidden" title="No Active Subscription" type="button"
                        @else
                            type="submit" class="btn dark_btn mt10 hidden"
                        @endif
                        > Continue <i class=" icon-arrow-right13 text-size-base position-right"></i>
                    </button>
                @endif
            </div>
        </div>
    </form>
</div>

<div id="previewHappy" class="modal fade">
    <div class="modal-dialog modal-lg" style="background:#f2f5f9 !important;width:65%!important;height:80%;">
        <div class="review_request_sec">

            <div class="review_header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6">
                            <a class="fsize17 fw500 txt_white" href="{{ base_url() }}"><img src="{{ base_url("assets/images/logo_icon_bb.png") }}" width="28" alt=""></a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="#" class="fsize12 txt_white">FAQ</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review_main_box_new">
                <div class="review_top_icon"><img width="74" src="{{ base_url("assets/images/review/review_star_icon.png") }}"/></div>
                <h2>Are you happy with our service?</h2>
                <p>Hi Alen.S! Please take a moment to rate our service and leave us a feedback.</p>
                <div class="review_button mt30">
                    <button class="btn dark_btn bkg_blue_light h52 mr10 sh_no" data-dismiss="modal" id="yesfeed"><img width="12" src="{{ base_url("assets/images/rating5.png") }}"/>&nbsp;  I'm happy</button>
                    <button class="btn light_btn bkg_grey_light h52 ml10 txt_dark sh_no" id="nothappy" data-dismiss="modal"><img src="{{ base_url("assets/images/icons/rating2.svg") }}"/> &nbsp;  Unhappy</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="previewStar" class="modal fade">
    <div class="modal-dialog modal-lg" style="background:#f2f5f9 !important;width:65%!important;height:80%;">
        <div class="review_request_sec">

            <div class="review_header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6">
                            <a class="fsize17 fw500 txt_white" href="{{ base_url() }}"><img src="{{ base_url("assets/images/logo_icon_bb.png") }}" width="28" alt=""></a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="#" class="fsize12 txt_white">FAQ</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="review_main_box_new">
                <div class="review_top_icon"><img width="74" src="{{ base_url("assets/images/review/review_star_icon.png") }}"/></div>
                <h2>Are you happy with our service?</h2>
                <p>Hi @if(!empty($oSubscriber)) {{ $oSubscriber[0]->firstname . ' ' . $oSubscriber[0]->lastname }} @endif! Please take a moment to rate our service and leave us a feedback.</p>

                <div class="star_box" style="border:none !important;">
                    <i class="icon-star-full2 star selected yellow" title='Poor' data-value='1'></i>
                    <i class="icon-star-full2 star selected yellow" title='Fair' data-value='2'></i>
                    <i class="icon-star-full2 star selected yellow" title='Good' data-value='3'></i>
                    <i class="icon-star-full2 star selected yellow" title='Excellent' data-value='4'></i>
                    <i class="icon-star-full2 star"  title='WOW!!!' data-value='5'></i>
                </div>

                <div class="review_button mt30">
                    <button class="btn dark_btn bkg_blue_light h52 sh_no" data-dismiss="modal" id="continueStarRatings">Submit review <i class="icon-arrow-right13"></i></button>
                </div>


            </div>



        </div>


    </div>
</div>


<script>

    $("input[name='ratings_type']").click(function () {
        if ($(this).val() == 'happy') {
            $("#happyDiv").show();
            $("#starDiv").hide();
        } else {
            $("#happyDiv").hide();
            $("#starDiv").show();
        }
    });
    $(document).on("keyup", ".thankMsgTitle", function () {
        $(this).closest('.configurations').find('.thanksTitlePreview').html($(this).val());
    });

    $(document).on("keyup", ".thankMsgSubTitle", function () {
        $(this).closest('.configurations').find('.thanksSubTitlePreview').html($(this).val());
    });

    $('[name=review_expire_link]').change(function () {
        if ($(this).val() == 'custom') {
            $('.expireLinkBox').show();
        } else {
            $('.expireLinkBox').hide();
        }
    });

</script>
