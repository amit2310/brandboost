@php 
    list($canRead, $canWrite) = fetchPermissions('Onsite Campaign') 
    $widgetType = $widgetData->widget_type;
@endphp
<div class="tab-pane {{ $rs }}" id="right-icon-tab1">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Choose widget</h6>
                </div>
                <div class="panel-body pl20 pr20 pt-10 pb-10 bkg_white">
                    <div class="form-group mb0">
                        <div class="input-group review_source_search w100">
                            <input type="text" class="form-control h40 pl0" id="searchInput" placeholder="Search widget templates..."/>
                            <span class="input-group-addon pr0"><i class="fa fa-search txt_grey"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2 review_source_new bwwCWBox reviewWidgetBox">
                    <label for="radiocheck1">
                        <div class="inner {{ $widgetType == 'bww' ? 'active' : '' }}">
                            <span class="custmo_checkbox checkboxs">
                                <input id="radiocheck1" type="radio" name="widgetList" class="selectwidget" widget-id="bww" {{ $widgetType == 'bww' ? 'checked="checked"' : '' }}>
                                <span class="custmo_checkmark purple"></span>
                            </span>
                            <figure><img src="{{ base_url() }}assets/images/review_source1_new.png"/></figure>
                            <div class="text_sec">
                                <p><strong>Small Popup</strong></p>
                                <h5>Displays reviews in a fixed vertical popup positioned on the left or right side</h5>	
                            </div>
                        </div>
                    </label>
                </div>
                <div class="col-md-2 review_source_new bfwCWBox reviewWidgetBox">
                    <label for="radiocheck2">
                        <div class="inner {{ $widgetType == 'bfw' ? 'active' : '' }}">
                            <span class="custmo_checkbox checkboxs">
                                <input id="radiocheck2" type="radio" name="widgetList" class="selectwidget" widget-id="bfw" {{ $widgetType == 'bfw' ? 'checked="checked"' : '' }}>
                                <span class="custmo_checkmark purple"></span>
                            </span>
                            <figure><img src="{{ base_url() }}assets/images/review_source2_new.png"/></figure>
                            <div class="text_sec">
                                <p><strong>Horizontal Popup</strong></p>
                                <h5>Displays 4 latest review in a bottom fixed scrollable reviews pannel</h5>	
                            </div>
                        </div>
                    </label>
                </div>
                <div class="col-md-2 review_source_new cpwCWBox reviewWidgetBox">
                    <label for="radiocheck3">
                        <div class="inner {{ $widgetType == 'cpw' ? 'active' : '' }}">
                            <span class="custmo_checkbox checkboxs">
                                <input id="radiocheck3" type="radio" name="widgetList" class="selectwidget" widget-id="cpw" {{ $widgetType == 'cpw' ? 'checked="checked"' : '' }}>
                                <span class="custmo_checkmark purple"></span>
                            </span>

                            <figure><img src="{{ base_url() }}assets/images/review_source3_new.png"/></figure>
                            <div class="text_sec">
                                <p><strong>Center Popup</strong></p>
                                <h5>Displays reviews in a lightbox slider with full focus on the details</h5>	
                            </div>
                        </div>
                    </label>
                </div>
                <div class="col-md-2 review_source_new vpwCWBox reviewWidgetBox">
                    <label for="radiocheck4">
                        <div class="inner  {{ $widgetType == 'vpw' ? 'active' : '' }}">
                            <span class="custmo_checkbox checkboxs">
                                <input id="radiocheck4" type="radio" name="widgetList" class="selectwidget" widget-id="vpw" {{ $widgetType == 'vpw' ? 'checked="checked"' : '' }}>
                                <span class="custmo_checkmark purple"></span>
                            </span>

                            <figure><img src="{{ base_url() }}assets/images/review_source4_new.png"/></figure>
                            <div class="text_sec">
                                <p><strong>Vertical Popup</strong></p>
                                <h5>Displays reviews in a scrollable feed component on page</h5>	
                            </div>
                        </div>
                    </label>
                </div>
                <div class="col-md-2 review_source_new rfwCWBox reviewWidgetBox">
                    <label for="radiocheck5">
                        <div class="inner {{ $widgetType == 'rfw' ? 'active' : '' }}">
                            <span class="custmo_checkbox checkboxs">
                                <input id="radiocheck5" type="radio" name="widgetList" class="selectwidget" widget-id="rfw" {{ $widgetType == 'rfw' ? 'checked="checked"' : '' }}>
                                <span class="custmo_checkmark purple"></span>
                            </span>
                            <figure><img src="{{ base_url() }}assets/images/review_source5_new.png"/></figure>
                            <div class="text_sec">
                                <p><strong>Embeded Reviews</strong></p>
                                <h5>Displays reviews in a lightbox slider with full focus on the details</h5>	
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>


    </div>
</div>
<script>
    var bbwpReviewType = '{{ $widgetData->widget_type }}';
    $(document).ready(function () {
        var widgetTypeID = '{{ $widgetData->widget_type }}';
        $(".selectwidget").click(function () {
            //$('.overlaynew').show();
            $('.review_source_new .inner').removeClass('active');

            $(this).parent().parent().addClass('active');
            widgetTypeID = $(this).attr("widget-id");

            $('.' + widgetTypeID + 'CWBox .inner').addClass('active');
            $('.' + widgetTypeID + 'CWBox .inner input.selectwidget1').prop('checked', 'checked');
            bbwpReviewType = widgetTypeID;
            $.ajax({
                url: "{{ base_url('admin/brandboost/setOnsiteWidget') }}",
                type: "POST",
                data: {widgetTypeID: widgetTypeID, widgetID: '{{ $widgetData->id }}', _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        displayMessagePopup();
                        $('.previewWidgetBox').addClass('hidden');

                        if (bbwpReviewType == 'bww') {
                            $("#newcampaign span").text('Small Popup');
                            $(".widgetPosition, .widgetIcon").show();
                            $("#widgetPositionVal").hide();
                        }
                        if (bbwpReviewType == 'bfw') {
                            $("#newcampaign span").text('Horizontal Popup');
                            $(".widgetPosition, .widgetIcon").hide();
                            $("#widgetPositionVal").show().val('Bottom');
                        }
                        if (bbwpReviewType == 'cpw') {
                            $("#newcampaign span").text('Center Popup');
                            $(".widgetPosition, .widgetIcon").hide();
                            $("#widgetPositionVal").show().val('Center');
                        }
                        if (bbwpReviewType == 'vpw') {
                            $("#newcampaign span").text('Vertical Popup');
                            $(".widgetPosition, .widgetIcon").show();
                            $("#widgetPositionVal").hide();
                        }
                        if (bbwpReviewType == 'rfw') {
                            $("#newcampaign span").text('Embeded Reviews');
                            $(".widgetPosition, .widgetIcon").hide();
                            $("#widgetPositionVal").show();
                        }

                        if (bbwpReviewType == 'bww' || bbwpReviewType == 'bfw') {
                            if ($('#alternative_design').prop("checked") == false) {
                                $('.' + bbwpReviewType + 'Main').removeClass('hidden');
                            } else {
                                $('.' + bbwpReviewType + 'Alternat').removeClass('hidden');
                            }
                        } else {
                            $('.' + bbwpReviewType).removeClass('hidden');
                        }

                        bbwpReviewType = widgetTypeID;
                    } else {
                        //$('.overlaynew').hide();
                        displayMessagePopup('error');
                    }
                }
            });
        });

        $(".selectwidget1").click(function () {
            $('.smart-widget-type-box .review_source_new .inner').removeClass('active');
            $(this).parent().parent().addClass('active');
            widgetTypeID = $(this).attr("widget-id");
        });

        $(".chooseWidget").click(function () {
            $('.overlaynew').show();
            $('#right-icon-tab1 .review_source_new .inner').removeClass('active');
            $('.' + widgetTypeID + 'CWBox .inner').addClass('active');
            $('.' + widgetTypeID + 'CWBox .inner input.selectwidget').prop('checked', 'checked');
            bbwpReviewType = widgetTypeID;

            $.ajax({
                url: "{{ base_url('admin/brandboost/setOnsiteWidget') }}",
                type: "POST",
                data: {widgetTypeID: widgetTypeID, widgetID: '{{ $widgetData->id }}', _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        displayMessagePopup();
                        $('.previewWidgetBox').addClass('hidden');

                        if (bbwpReviewType == 'bww') {
                            $("#newcampaign span").text('Small Popup');
                            $(".widgetPosition, .widgetIcon").show();
                            $("#widgetPositionVal").hide();
                        }
                        if (bbwpReviewType == 'bfw') {
                            $("#newcampaign span").text('Horizontal Popup');
                            $(".widgetPosition, .widgetIcon").hide();
                            $("#widgetPositionVal").show().val('Bottom');
                        }
                        if (bbwpReviewType == 'cpw') {
                            $("#newcampaign span").text('Center Popup');
                            $(".widgetPosition, .widgetIcon").hide();
                            $("#widgetPositionVal").show().val('Center');
                        }
                        if (bbwpReviewType == 'vpw') {
                            $("#newcampaign span").text('Vertical Popup');
                            $(".widgetPosition, .widgetIcon").show();
                            $("#widgetPositionVal").hide();
                        }
                        if (bbwpReviewType == 'rfw') {
                            $("#newcampaign span").text('Embeded Reviews');
                            $(".widgetPosition, .widgetIcon").hide();
                            $("#widgetPositionVal").show();
                        }

                        if (bbwpReviewType == 'bww' || bbwpReviewType == 'bfw') {
                            if ($('#alternative_design').prop("checked") == false) {
                                $('.' + bbwpReviewType + 'Main').removeClass('hidden');
                            } else {
                                $('.' + bbwpReviewType + 'Alternat').removeClass('hidden');
                            }
                        } else {
                            $('.' + bbwpReviewType).removeClass('hidden');
                        }

                        $(".smart-widget-type-box").animate({
                            width: "toggle"
                        });
                        bbwpReviewType = widgetTypeID;
                        $('.overlaynew').hide();

                    } else {
                        displayMessagePopup('error');
                    }
                }
            });
        });


        $("#searchInput").on("keyup", function () {
            var myLength = $(this).val().length;
            var value = $(this).val().toLowerCase();
            if (myLength > 0)
            {
                $(".reviewWidgetBox .text_sec p").filter(function () {
                    $(this).parent().parent().parent().parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            } else {
                $(".reviewWidgetBox").show();
            }
        });
    });
</script>