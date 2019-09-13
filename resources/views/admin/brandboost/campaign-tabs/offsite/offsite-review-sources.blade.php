@php
list($canRead, $canWrite) = fetchPermissions('Offsite Campaign');

$searchfalg = 0;
$showextra = 0;
$showcount = 0;

@endphp
<div class="tab-pane {{ $sources }}" id="right-icon-tab0">
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-flat" style="margin-bottom:7px!important">
                <div class="panel-heading">
                    <h6 class="panel-title">Review Source</h6>
                </div>
                <div class="panel-body pl20 pr20 pt-10 pb-10 bkg_white">
                    <div class="form-group mb0">
                        <div class="input-group review_source_search w100">
                            <input id="myCustomInput" type="text" class="form-control h40 pl0" placeholder="Search review sites..."/>
                            <span class="input-group-addon pr0"><i class="fa fa-search txt_grey"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .othersources .rev_col {
                width: 220px!important;
                max-width: 220px!important;
                margin: 0 0px 20px 0;
            }
            .othersources .thumbnail {
                margin-bottom: 0px;
                border: 1px solid #e5ebe5!important;
                border-radius: 6px;
                transition: transform .15s ease;
                padding: 0px;
                box-shadow: 0 1px 2px 0 rgba(0,0,0,.02), 0 6px 18px 0 rgba(0,0,0,.055);
            }
            .othersources .thumbnail .thumb {
                padding: 33px 0;
                background: #f1f6ff;
                border-radius: 6px 6px 0 0!important;
                height: 124px;
                text-align: center;
            }
            .othersources .thumbnail .caption {
                padding-top: 15px!important;
                padding-left: 15px!important;
                padding-right: 15px!important;
                position: relative;
            }
        </style>
        <!-- Other Source category -->
        <div class="notFoundRow othersources" style="display: none;">
            <div class="panel-heading sidebarheadings active">
                <h6 class="panel-title"> <a class="" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-groupaccordion-control-group10" aria-expanded="true"><i class="icon-power2"></i>&nbsp;Other Sources</a> </h6>
            </div>
            <div id="" data-toggle="modal" data-target="#OtherSourcesId" aria-expanded="true" style="display:block">
                <div class="panel-body">
                    <div class="row filter_campaign">

                        <div class="col-xs-12 col-md-2 col-sm-2 rev_col">
                            <div class="thumbnail">
                                <div class="thumb bkg1">
                                    <a href="javascript:void(0);"><i class="txt_blue" style="font-style:inherit">M</i></a>
                                </div>
                                <div class="caption text-center">
                                    <div class="pull-left">
                                        <h5 class="no-margin sea">Custom Source</h5>
                                        <h6 class="text-muted">Use Custom Domain</h6>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Other Source category -->


        <div class="col-md-12">

            <div class="filter_campaign_new">

                <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                    @if (!empty($offsite_ids))
                       @php $selected_list = implode(",", $offsite_ids); @endphp
                    @else
                       @php $selected_list = 0; @endphp
                    @endif

                    <input type="hidden" name="selected_list" id='selected_list' value="{{ $selected_list }}">

                    @php
                    $siteDatarray = array();
                    $cateList = array(
                        'accordion-control-group1' => array(
                            'icon' => 'icon-stack2',
                            'title' => 'Most Popular',
                            'cat_img' => 'star_purple.png'
                        ),
                        'accordion-control-group2' => array(
                            'icon' => 'icon-copy',
                            'title' => 'Automotive',
                            'cat_img' => 'automative.png'
                        ),
                        'accordion-control-group3' => array(
                            'icon' => 'icon-droplet2',
                            'title' => 'Dental',
                            'cat_img' => 'dental.png'
                        ),
                        'accordion-control-group4' => array(
                            'icon' => 'icon-cart2',
                            'title' => 'E-commerce',
                            'cat_img' => 'ecom.png'
                        ),
                        'accordion-control-group5' => array(
                            'icon' => 'icon-select2',
                            'title' => 'Financial services',
                            'cat_img' => 'finse.png'
                        ),
                        'accordion-control-group6' => array(
                            'icon' => 'icon-user-plus',
                            'title' => 'Healthcare',
                            'cat_img' => '',
                            'icon_class' => 'icon-user-plus'
                        ),
                        'accordion-control-group7' => array(
                            'icon' => 'icon-home7',
                            'title' => 'Home services',
                            'cat_img' => '',
                            'icon_class' => 'icon-home2'
                        ),
                        'accordion-control-group8' => array(
                            'icon' => 'icon-office',
                            'title' => 'Hotels',
                            'cat_img' => '',
                            'icon_class' => 'icon-office'
                        ),
                        'accordion-control-group9' => array(
                            'icon' => 'icon-design',
                            'title' => 'Insurance',
                            'cat_img' => '',
                            'icon_class' => 'icon-power2'
                        ),
                        'accordion-control-group10' => array(
                            'icon' => 'icon-stamp',
                            'title' => 'Legal',
                            'cat_img' => '',
                            'icon_class' => 'icon-user-tie'
                        ),
                        'accordion-control-group11' => array(
                            'icon' => 'icon-stack',
                            'title' => 'Personal Services',
                            'cat_img' => '',
                            'icon_class' => 'icon-hammer-wrench'
                        ),
                        'accordion-control-group12' => array(
                            'icon' => 'icon-city',
                            'title' => 'Real Estate',
                            'cat_img' => '',
                            'icon_class' => ''
                        ),
                        'accordion-control-group13' => array(
                            'icon' => 'icon-home4',
                            'title' => 'Restaurants',
                            'cat_img' => '',
                            'icon_class' => ''
                        ),
                        'accordion-control-group14' => array(
                            'icon' => 'icon-database-edit2',
                            'title' => 'Software',
                            'cat_img' => '',
                            'icon_class' => ''
                        ),
                        'accordion-control-group15' => array(
                            'icon' => 'icon-database-edit2',
                            'title' => 'OtherSources',
                            'cat_img' => '',
                            'icon_class' => ''
                        )
                    );
                    $cinc = 0;
                    echo '<div  id="myTable">';
                    @endphp

                    @foreach ($cateList as $key => $cate)
                    <div class="panel panel-white" id="SPanel{{ $key }}">
                            <div class="panel-heading sidebarheadings active">
                                <h6 class="panel-title">
                                    <a class="{{ $cinc > 0 ? 'collapsed' : '' }}" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group{{ $key }}">

                                        @if (!empty($cate['cat_img']))
                                            <i class=""><img src="/assets/images/{{ $cate['cat_img'] }}"></i>
                                        @elseif (!empty($cate['icon_class']))
                                            <i class="{{ $cate['icon_class'] }}"></i>
                                        @else
                                            <i class="icon-power2"></i>
                                        @endif
                                        &nbsp;
                                        @if ($cate['title'] == 'OtherSources')
                                            {{ 'Other Sources' }}
                                        @else
                                            {{ $cate['title'] }}
                                        @endif
                                    </a>
                                </h6>
                            </div>
                            <div id="accordion-control-right-group{{ $key }}" class="panel-collapse collapse {{ $cinc == '0' ? 'in firstRow' : '' }}">
                                <div class="panel-body">
                                    <div class="row">

                                        @php
                                        $thumbColor = array('bkg1', 'bkg2', 'bkg3', 'bkg4', 'bkg5', 'bkg6');

                                        foreach ($offSiteData as $siteData) {

                                            $categoryunserilize = unserialize($siteData->site_categories);
                                            if ($categoryunserilize[0] == 'OtherSources') {
                                                $showextra = 1;
                                            }


                                            if (in_array($cate['title'], unserialize($siteData->site_categories))) {
                                                $getLinksSocial = @$offsites_links[$siteData->id]['shorturl'];
                                                $sourceName = strtolower($siteData->name);


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

                                                @if (in_array('OtherSources', unserialize($siteData->site_categories)) && $showcount < 1)
                                                    <div data-toggle="modal" id="rowDefault" data-target="#OtherSourcesId" class="col-xs-12 col-md-2 col-sm-2 rev_col">
                                                        <div class="thumbnail">
                                                            <div class="thumb bkg1">
                                                                <a href="javascript:void(0);"><i class="txt_blue" style="font-style:inherit">M</i></a>
                                                            </div>
                                                            <div class="caption text-center">
                                                                <div class="pull-left">
                                                                    <h5 class="no-margin sea">Custom Source</h5>
                                                                    <h6 class="text-muted">Use Custom Domain</h6>
                                                                </div>
                                                                <div class="clearfix"></div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php
                                                    $showcount++;
                                                    @endphp
                                                @endif



                                                <div onmouseover="ShowImg('{{ $siteData->id }}')" onmouseleave="HideImg('{{ $siteData->id }}')" class="
                                                    @if (in_array('OtherSources', unserialize($siteData->site_categories)))
                                                        OtMouseover_{{ $siteData->id }}
                                                    @endif
                                                    col-xs-12 col-md-2 col-sm-2 rev_col
                                                    @if (!empty($offsite_ids))
                                                        @if (in_array($siteData->id, $offsite_ids))
                                                            {{ 'selected' }}
                                                        @endif
                                                    @endif
                                                     " offsetId="{{ $siteData->id }}" id="review_steps{{ $siteData->id }}">
                                                    @if (in_array('OtherSources', unserialize($siteData->site_categories)))
                                                        <a id="tickImg_{{ $siteData->id }}" style="display:none" CsourceId="{{ $siteData->id }}" href="javascript:void(0);" class="deleteCustomSource"><i class="icon-cross2"></i></a>
                                                    @endif
                                                    <div class="thumbnail">

                                                        <div class="thumb {{ $thumbclass }}">
                                                            <a href="javascript:void(0);">
                                                                @if (in_array('OtherSources', unserialize($siteData->site_categories)))
                                                                    <i class="icon-{{ $sourceName . ' ' . $sourceClass }}" style="font-style:inherit">M</i>
                                                                @else
                                                                    <img src="{{ '/uploads/' . $siteData->image }}">
                                                                @endif
                                                            </a>
                                                        </div>



                                                        <div class="caption text-center">
                                                            <div class="pull-left">
                                                                <h5 class="no-margin sea">{{ ucfirst($siteData->name) }}</h5>
                                                                <h6 class="text-muted">
                                                                    @php
                                                                    if (in_array('OtherSources', unserialize($siteData->site_categories))) {
                                                                        $getLinksSocial = $getLinksSocial != '' ? $getLinksSocial : $siteData->website_url;
                                                                        $str = str_replace("www.", "", preg_replace('#^https?://#', '', $getLinksSocial));
                                                                        echo $str;
                                                                    } else {

                                                                        $str = preg_replace('#^https?://#', '', $siteData->website_url);
                                                                        echo $str;
                                                                    }
                                                                    @endphp
                                                                </h6>
                                                            </div>
                                                            @if ($canWrite)
                                                                <label class="custom-form-switch pull-right mt10">
                                                                    <input class="field offsite_selected" type="checkbox"
                                                                        @if (!empty($offsite_ids))
                                                                            @if (in_array($siteData->id, $offsite_ids))
                                                                                {{ 'checked' }}
                                                                            @else
                                                                                {{ '' }}
                                                                            @endif
                                                                        @endif
                                                                        offsiteSelected="
                                                                            @if (!empty($offsite_ids))
                                                                               @if (in_array($siteData->id, $offsite_ids))
                                                                                   {{ '1' }}
                                                                               @else
                                                                                   {{ '0' }}
                                                                               @endif
                                                                           @endif
                                                                        " offsiteId="{{ $siteData->id }}">
                                                                    <span class="toggle green"></span>
                                                                </label>
                                                            @endif
                                                            <div class="clearfix"></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @php
                                                }
                                            }
                                            @endphp

                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $cinc++;
                        @endphp
                    @endforeach
                    @if ($showextra == 0)
                    <script>

                        if (document.getElementById("SPanelaccordion-control-group15") !== null) {
                            document.getElementById("SPanelaccordion-control-group15").style.display = 'none';
                        }
                        if (document.getElementById('rowDefault') !== null) {
                            document.getElementById('rowDefault').style.display = 'none';
                        }
                    </script>
                    <!-- Other Source category -->
                    <div class="notFoundRow othersources" style="display: block;" id="defaultothersources">
                        <div class="panel-heading sidebarheadings active">
                            <h6 class="panel-title"> <a class="" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-groupaccordion-control-group15" aria-expanded="true"><i class="icon-power2"></i>&nbsp;Other Sources</a> </h6>
                        </div>
                        <div id="" data-toggle="modal" data-target="#OtherSourcesId" aria-expanded="true" style="display:block">
                            <div class="panel-body">
                                <div class="row filter_campaign">

                                    <div class="col-xs-12 col-md-2 col-sm-2 rev_col">
                                        <div class="thumbnail">
                                            <div class="thumb bkg1">
                                                <a href="javascript:void(0);"><i class="txt_blue" style="font-style:inherit">M</i></a>
                                            </div>
                                            <div class="caption text-center">
                                                <div class="pull-left">
                                                    <h5 class="no-margin sea">Custom Source</h5>
                                                    <h6 class="text-muted">Use Custom Domain</h6>
                                                </div>
                                                <div class="clearfix"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Other Source category -->
                    @endif


                </div>
            </div>
        </div>


    </div>
</div>
<div class="row">
    <div class="col-md-12 text-right">
        @if ($canWrite)
            <a href="javascript:void(0);" class="btn dark_btn mt10 saveReviewSource hidden" data-brandid="{{ $brandboostID }}">
                Continue
                <i class=" icon-arrow-right13 text-size-base position-right"></i>
            </a>
        @endif
    </div>
</div>
</div>
<script>

    function ShowImg(divid)
    {

        document.getElementById("tickImg_" + divid).style.display = 'block';
    }

    function HideImg(divid)
    {

        document.getElementById("tickImg_" + divid).style.display = 'none';
    }

    $(document).ready(function () {


        $("#myCustomInput").on("keyup", function () {
            $(".notFoundRow").hide();
            var myLength = $("#myCustomInput").val().length;
            var cnt = 0;
            var flag = 0;

            if (myLength > 0)
            {
                var value = $(this).val().toLowerCase();
                $("#myTable .panel-body .col-xs-12").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    if ($(this).text().toLowerCase().indexOf(value) == -1) {
                        //$(".notFoundRow").show();
                    } else {
                        $(".notFoundRow").hide();
                        cnt++;
                    }

                });

                $("#myTable .panel").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    if ($(this).text().toLowerCase().indexOf(value) == -1) {
                        $(".notFoundRow").show();
                    } else {
                        $(".notFoundRow").hide();
                        cnt++;
                    }

                });

            } else
            {
                $(".notFoundRow").hide();
                $(".panel").css("display", "block");
                $(".col-xs-12").css("display", "block");
                $('.panel-collapse').removeClass('in');
                $('.firstRow').addClass('in');
                $("#defaultothersources").show();
                flag = 1;
            }
            if (flag == 0)
            {
                if (cnt > 0)
                {
                    $(".notFoundRow").hide();
                    $("#defaultothersources").show();
                } else
                {
                    $(".notFoundRow").show();
                    $("#defaultothersources").hide();
                }
            }
        });

        $("#OtherSourcesPopupFrm").submit(function () {
            //$('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ base_url('admin/offsite/add_website') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //$('.overlaynew').hide();
                        var offstepIds = [];
                        var selected_list = $('#selected_list').val();
                        selected_list += ',' + data.id;
                        var offstepIds = selected_list.split(",");
                        CustomAddSource(offstepIds, data.brandboostID);
                        $('#selected_list').val(offstepIds);
                        //$('.saveReviewSource').trigger('click');

                        (function () {
                            $.ajax({
                                url: "{{ base_url('admin/brandboost/campaignPreferences') }}",
                                data: {brandboostID: '{{ $brandboostData->id }}'},
                                method: "POST",
                                dataType: "json",
                                success: function (data)
                                {
                                    if (data.status == 'success') {
                                        //$('.overlaynew').hide();
                                        $('.media-list').html(data.socialList);
                                        $('#selected_list_r').val(data.selectedList);
                                    } else {
                                        //$('.overlaynew').hide();
                                    }
                                }
                            });
                        })();
                        $('#offsitename').val('');
                        $('#txtURL').val('');
                        $('#OtherSourcesId').modal('hide');
                        displayMessagePopup();
                        $('[href="#right-icon-tab1"]').trigger('click');
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $(document).on('click', '.deleteCustomSource', function () {
            var elem = $(this);
            var CsourceId = $(this).attr('CsourceId');
            deleteConfirmationPopup(
                    "This Source will deleted immediately.<br>You can't undo this action.",
                    function () {

                        $('.overlaynew').show();
                        $.ajax({
                            url: "{{ base_url('admin/offsite/delete_customsource') }}",
                            type: "POST",
                            data: {'CustomSourceID': CsourceId, _token: '{{csrf_token()}}'},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    $('#review_steps' + CsourceId).hide();
                                    $('.overlaynew').hide();
                                    var offstepIds = [];
                                    var selected_list = $('#selected_list').val();
                                    var offstepIds = selected_list.split(",");
                                    offstepIds = $.grep(offstepIds, function (value) {
                                        return value != CsourceId;
                                    });
                                    offstepIds = offstepIds.join();
                                    $('#selected_list').val(offstepIds);
                                    //DelSourcefrmPrefrence(offstepIds);

                                    $('.saveReviewSource').trigger('click');
                                    (function () {
                                        $.ajax({
                                            url: "{{ base_url('admin/brandboost/campaignPreferences') }}",
                                            data: {brandboostID: '{{ $brandboostData->id }}'},
                                            method: "POST",
                                            dataType: "json",
                                            success: function (data)
                                            {
                                                if (data.status == 'success') {
                                                    $('.overlaynew').hide();
                                                    $('.media-list').html(data.socialList);
                                                    $('#selected_list_r').val(data.selectedList);
                                                } else {
                                                    $('.overlaynew').hide();
                                                }
                                            }
                                        });
                                    })();

                                    //$('[href="#right-icon-tab1"]').trigger('click');
                                    $('.overlaynew').hide();
                                    //displayMessagePopup('success', 'Success!', 'Your data has been deleted successfully.');
                                    // location.reload();
                                    window.location.href = "{{ base_url('admin/brandboost/offsite_setup/') }}{{ $brandboostData->id }}?type=del";
                                } else {
                                    alertMessage('Error: Some thing wrong!');
                                    $('.overlaynew').hide();
                                }
                            }
                        });
                    });
        });

        $(document).on('click', '.offsite_selected', function () {

            $('.overlaynew').show();
            var offsiteId = $(this).attr('offsiteid');
            var offsiteSelected = $(this).attr('offsiteselected');
            if (offsiteSelected == 0) {
                $(this).attr('offsiteselected', '1');
                $('#review_steps' + offsiteId).addClass('selected');
                $(this).addClass('btn-success');

                var selected_list = $('#selected_list').val();
                $('#selected_list').val(selected_list + ',' + offsiteId);
            } else {
                $(this).attr('offsiteselected', '0');
                $('#review_steps' + offsiteId).removeClass('selected');
                $(this).removeClass('btn-success');

                var selected_list = $('#selected_list').val();
                var offstepIds = selected_list.split(",");
                offstepIds = $.grep(offstepIds, function (value) {
                    return value != offsiteId;
                });
                offstepIds = offstepIds.join();
                $('#selected_list').val(offstepIds);
            }

            $('.saveReviewSource').trigger('click');

            (function () {
                $.ajax({
                    url: "{{ base_url('admin/brandboost/campaignPreferences') }}",
                    data: {brandboostID: '{{ $brandboostData->id }}', _token: '{{csrf_token()}}'},
                    method: "POST",
                    dataType: "json",
                    success: function (data)
                    {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            $('.media-list').html(data.socialList);
                            $('#selected_list_r').val(data.selectedList);
                        } else {
                            $('.overlaynew').hide();
                        }
                    }
                });
            })();
        });
    });

    function CustomAddSource(offstepIds, brandboostID) {
        if (offstepIds.length > 0) {
            $.ajax({
                url: "{{ base_url('admin/brandboost/add_offsite_edit') }}",
                type: "POST",
                data: {'offstepIds': offstepIds, brandboostID: brandboostID, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = "{{ base_url('admin/brandboost/offsite_setup/') }}" + brandboostID + "?type=add";
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        } else {
            alertMessage('Please select atleast one of them.')
        }
    }

</script>
