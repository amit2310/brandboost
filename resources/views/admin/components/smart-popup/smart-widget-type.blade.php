<style>
    .box .col-md-2.review_source_new {
        max-width: 100%;
        width: 210px;
        margin-bottom: 10px;
    }

    .box .col-md-2.review_source_new .inner {
        border: 1px solid #f4f6fa;
        min-height: auto;
    }

    .box .col-md-2.review_source_new .inner .text_sec {
        padding: 15px 0 0;
    }

    .box .col-md-2.review_source_new .inner .text_sec img {
        width: 10px;
        height: 10px;
        vertical-align: top;
        margin-top: 3px;
    }
</style>
@php
    $widgetType = $widgetData->widget_type;
@endphp
<div class="box smart-widget-type-box" style="width: 680px; z-index:11;">
    <div style="width: 680px;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">

            <div class="row" style="height: 100%;">
                <div class="col-md-12">
                    <a style="left: 35px; top: 15px;" class="reviews smart-widget-type slide-toggle bkg_grey_light"><i
                            class=""><img src="{{ base_url() }}assets/images/icon_arrow_left.png"/></i></a>
                    <h5 style="padding-left: 75px;" class="panel-title">Choose widget</h5>
                </div>
                <div class="col-md-12">
                    <div class="p30 pt0 pb0">
                        <div class="bbot pb20 pt20">
                            <h3 class="m0 fsize20 txt_dark">Choose widget</h3>
                            <p class="m0 fsize14 txt_grey fw300">Choose type of item you want to create</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row p30">
                        <div class="col-md-2 review_source_new bwwCWBox">
                            <label for="radiocheck_sp_1">
                                <div class="inner {{ $widgetType == 'bww' ? 'active' : '' }}">
									<span class="custmo_checkbox checkboxs">
										<input id="radiocheck_sp_1" type="radio" name="widgetList1"
                                               class="selectwidget1" widget-id="bww" {{ $widgetType == 'bww' ? 'checked="checked"' : '' }}>
										<span class="custmo_checkmark purple"></span>
									</span>
                                    <figure><img src="{{ base_url() }}assets/images/review_source1_new.png"/></figure>
                                    <div class="text_sec">
                                        <p><strong>Small Popup</strong></p>
                                        <p class="txt_grey"><i class="mr-5"><img
                                                    src="{{ base_url() }}assets/images/icon_download_small2.png"/></i>1,395
                                        </p>

                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-2 review_source_new bfwCWBox">
                            <label for="radiocheck_sp_2">
                                <div class="inner {{ $widgetType == 'bfw' ? 'active' : '' }}">
									<span class="custmo_checkbox checkboxs">
										<input id="radiocheck_sp_2" type="radio" name="widgetList1"
                                               class="selectwidget1" widget-id="bfw" {{ $widgetType == 'bfw' ? 'checked="checked"' : '' }}>
										<span class="custmo_checkmark purple"></span>
									</span>
                                    <figure><img src="{{ base_url() }}assets/images/review_source2_new.png"/></figure>
                                    <div class="text_sec">
                                        <p><strong>Horizontal Popup</strong></p>
                                        <p class="txt_grey"><i class="mr-5"><img
                                                    src="{{ base_url() }}assets/images/icon_download_small2.png"/></i>1,395
                                        </p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-2 review_source_new cpwCWBox">
                            <label for="radiocheck_sp_3">
                                <div class="inner {{ $widgetType == 'cpw' ? 'active' : '' }}">
									<span class="custmo_checkbox checkboxs">
										<input id="radiocheck_sp_3" type="radio" name="widgetList1"
                                               class="selectwidget1" widget-id="cpw" {{ $widgetType == 'cpw' ? 'checked="checked"' : '' }}>
										<span class="custmo_checkmark purple"></span>
									</span>

                                    <figure><img src="{{ base_url() }}assets/images/review_source3_new.png"/></figure>
                                    <div class="text_sec">
                                        <p><strong>Center Popup</strong></p>
                                        <p class="txt_grey"><i class="mr-5"><img
                                                    src="{{ base_url() }}assets/images/icon_download_small2.png"/></i>1,395
                                        </p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-2 review_source_new vpwCWBox">
                            <label for="radiocheck_sp_4">
                                <div class="inner {{ $widgetType == 'vpw' ? 'active' : '' }}">
									<span class="custmo_checkbox checkboxs">
										<input id="radiocheck_sp_4" type="radio" name="widgetList1"
                                               class="selectwidget1" widget-id="vpw" {{ $widgetType == 'vpw' ? 'checked="checked"' : '' }}>
										<span class="custmo_checkmark purple"></span>
									</span>

                                    <figure><img src="{{ base_url() }}assets/images/review_source4_new.png"/></figure>
                                    <div class="text_sec">
                                        <p><strong>Vertical Popup</strong></p>
                                        <p class="txt_grey"><i class="mr-5"><img
                                                    src="{{ base_url() }}assets/images/icon_download_small2.png"/></i>1,395
                                        </p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-2 review_source_new rfwCWBox">
                            <label for="radiocheck_sp_5">
                                <div class="inner {{ $widgetType == 'rfw' ? 'active' : '' }}">
									<span class="custmo_checkbox checkboxs">
										<input id="radiocheck_sp_5" type="radio" name="widgetList1"
                                               class="selectwidget1" widget-id="rfw" {{ $widgetType == 'rfw' ? 'checked="checked"' : '' }}>
										<span class="custmo_checkmark purple"></span>
									</span>
                                    <figure><img src="{{ base_url() }}assets/images/review_source5_new.png"/></figure>
                                    <div class="text_sec">
                                        <p><strong>Embeded Reviews</strong></p>
                                        <p class="txt_grey"><i class="mr-5"><img
                                                    src="{{ base_url() }}assets/images/icon_download_small2.png"/></i>1,395
                                        </p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p30 pt0 pb0">
                        <div class="btop pb20 pt20">
                            <button type="button" class="btn dark_btn h52 bkg_purple mr20 chooseWidget">Choose Widget
                            </button>
                            <button style="min-width:120px;" type="button" class="btn white_btn h52 smart-widget-type">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".smart-widget-type").click(function () {
            $(".smart-widget-type-box").animate({
                width: "toggle"
            });

            $('.smart-widget-type-box .review_source_new .inner').removeClass('active');
            $('.smart-widget-type-box .' + bbwpReviewType + 'CWBox .inner').addClass('active');
            $('.smart-widget-type-box .' + bbwpReviewType + 'CWBox .inner input.selectwidget1').prop('checked', 'checked');
        });
    });

</script>
