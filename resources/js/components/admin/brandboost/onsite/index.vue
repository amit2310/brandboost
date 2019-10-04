<template>

        <!-- Content area -->
        <div class="content" id="masterContainer">
            Content here
            <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
            <div class="page_header">
                <div class="row">

                    <div class="col-md-3" v-if="true">
                        <h3><img src="/assets/images/onsite_icons.png"> On Site Overview</h3>
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="active all"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="1|0|2">Active Campaigns</a></li>
                            <li><a style="javascript:void();" class="filterByColumn" fil="3">Archive</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3" v-else>
                        <h3><img src="/assets/images/onsite_icons.png"> On Site Review Campaigns</h3>
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="active all"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="1|0|2">Active Campaigns</a></li>
                            <li><a style="javascript:void();" class="filterByColumn" fil="3">Archive</a></li>
                        </ul>
                    </div>

                    <div class="col-md-9 text-right btn_area">
                        <div class="btn-group">
                            <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Campaign &nbsp; &nbsp; <span class="caret"></span>
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


                        <button title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription" id="addBrandboost" type="button" ><i class="icon-plus3"></i> Add On Site Review Campaign</button>


                    </div>

                </div>
            </div>
            <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

            <div class="tab-content" v-if="true">
                <!--===========TAB 1===========-->
                <div class="tab-pane active" id="right-icon-tab0">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Marketing campaigns -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                <span class="pull-left">
                                    <h6 class="panel-title">78 On Site Review Campaigns</h6>
                                </span>
                                    <div class="heading_links pull-left">
                                        <a class="top_links btn btn-xs btn_white_table ml20 top_links_all">All</a>
                                        <a class="top_links top_links_Status" getValue="1" style="cursor: pointer;">Active</a>
                                        <a class="top_links top_links_Status" getValue="0" style="cursor: pointer;">Inactive</a>
                                        <a class="top_links top_links_positive" getValue="positive" style="cursor: pointer;">Positive</a>
                                        <a class="top_links top_links_neutral" getValue="neutral" style="cursor: pointer;">Neutral</a>
                                        <a class="top_links top_links_negative" getValue="negative" style="cursor: pointer;">Negative</a>
                                        <a class="top_links top_links_added_today"  getValue="today" style="cursor: pointer;">Added Today</a>
                                    </div>
                                    <div class="heading-elements">
                                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                            <input class="form-control input-sm cus_search" tableID="onsiteBrandboostCampaign" placeholder="Search by name" type="text">
                                            <div class="form-control-feedback">
                                                <i class="icon-search4"></i>
                                            </div>
                                        </div>
                                        <div class="table_action_tool">
                                            <a href="javascript:void(0);"><i class="icon-calendar52"></i></a>
                                            <a href="javascript:void(0);" class="editDataList"><i class="icon-pencil"></i></a>
                                            <a href="javascript:void(0);" style="display: none;" id="deleteButtonBrandboostOnline" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                            <a href="javascript:void(0);" style="display: none;" id="archiveButtonBrandboostOnline" class="custom_action_box"><i class="icon-gear position-left"></i></a>
                                        </div>
                                    </div>

                                </div>

                                <div class="panel-body p0">
                                    <table class="table datatable-basic-new" id="onsiteBrandboostCampaign">
                                        <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                            <th><i class=""><img src="/assets/images/star_name.png"/></i>Name</th>
                                            <th><i class="icon-star-full2"></i>Rating</th>
                                            <th><i class="icon-calendar"></i>Created</th>
                                            <th><i class="icon-user"></i> Contacts</th>
                                            <th><i class=""><img src="/assets/images/emoji_smile.png"/></i> Positive</th>
                                            <th><i class=""><img src="/assets/images/emoji_smile2.png"/></i> Neutral</th>
                                            <th><i class=""><img src="/assets/images/emoji_smile3.png"/></i> Negative</th>
                                            <th><i class=""><img src="/assets/images/clock.png"/></i>Last review</th>
                                            <th><i class="icon-diff-modified"></i>Status</th>
                                            <th style="display: none;">status</th>
                                            <th style="display: none;">status</th>
                                            <th style="display: none;">Positive</th>
                                            <th style="display: none;">Neutral</th>
                                            <th style="display: none;">Negative</th>
                                            <th style="display: none;">Today</th>
                                            <th><i class="icon-calendar"></i>Last Incoming Lead</th>
                                            <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>

                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr v-for="oBrandbost in oBrandbosts" :id="append-oBrandbost.id" class="selectedClass">
                                            <td style="display: none;">{{oBrandbost.created}}</td>
                                            <td style="display: none;">{{oBrandbost.id}}</td>
                                            <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk{oBrandbost.id}" value="{oBrandbost.id}" ><span class="custmo_checkmark"></span></label></td>

                                            <td>
                                                <div class="media-left media-middle">
                                                    <a :href="`/admin/brandboost/onsite_setup/${oBrandbost.id}`" :brandID="oBrandbost.id" :b_title="oBrandbost.brand_title">
                                                        <img src="/assets/images/default_table_img2.png" class="img-circle img-xs br5" alt="Img"></a>
                                                </div>
                                                <div class="media-left">
                                                    <div class=""><a :href="`/admin/brandboost/onsite_setup/${oBrandbost.id}`" :brandID="oBrandbost.id" :b_title="oBrandbost.brand_title" class="text-default text-semibold">{{oBrandbost.brand_title}}</a></div>
                                                    <div class="text-muted text-size-small">
                                                        {{oBrandbost.brand_desc}}
                                                    </div>
                                                </div>

                                            </td>

                                            <td>
                                                ratingView
                                            </td>
                                            <td>
                                                <div class="media-left">
                                                    <div class=""><span class="text-default text-semibold">{{oBrandbost.created}}</span></div>
                                                    <div class="text-muted text-size-small">{{oBrandbost.created}}</div>
                                                </div>
                                            </td>

                                            <td>
                                                <div data-toggle="tooltip" title="Total contacts 0" data-placement="top">
                                                    <a href="`/admin/brandboost/onsite_setup/${oBrandbost.id}`"  class="text-default text-semibold">0 <span style="color:#FF0000;">new</span></a>
                                                </div>
                                            </td>
                                                <div class="media-left">
                                                    <div class="progress-circle over50 green cp60 createSegment" segment-type="total-positive" :campaign-id="oBrandbost.id" campaign-type="email" title="click to create segment">
                                                        <div class="left-half-clipper">
                                                            <div class="first50-bar"></div>
                                                            <div class="value-bar"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-left">
                                                    <div data-toggle="tooltip" title="7 out of 10 Responses" data-placement="top">
                                                        <a href="`/admin/brandboost/onsite_setup/${oBrandbost.id}?cate=positive`" class="text-default text-semibold">7</a>
                                                        <span style="color:#FF0000;"> (new)</span>

                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="media-left">
                                                    <div class="progress-circle over50 grey cp60 createSegment" segment-type="total-neutral" :campaign-id="oBrandbost.id" campaign-type="email" title="click to create segment">
                                                        <div class="left-half-clipper">
                                                            <div class="first50-bar"></div>
                                                            <div class="value-bar"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-left">
                                                    <div data-toggle="tooltip" title="3 out of 10 Response" data-placement="top">
                                                        <a  href="`/admin/brandboost/onsite_setup/${oBrandbost.id}?cate=neutral`" class="text-default text-semibold">
                                                            3
                                                        </a>
                                                        <span style="color:#FF0000;"> (new)</span>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="media-left">
                                                    <div class="progress-circle over50 red cp60 createSegment" segment-type="total-negative" :campaign-id="oBrandbost.id" campaign-type="email" title="click to create segment">
                                                        <div class="left-half-clipper">
                                                            <div class="first50-bar"></div>
                                                            <div class="value-bar"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-left">
                                                    <div data-toggle="tooltip" title="3 out of 10 Response" data-placement="top">
                                                        <a  href="`/admin/brandboost/onsite_setup/${oBrandbost.id}?cate=negative`" class="text-default text-semibold">
                                                            3</a>
                                                        <span style="color:#FF0000;"> (new)</span>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="media-left media-middle"> <img src="" class="img-circle" width="26" alt=""> </div>
                                                <div class="media-left">
                                                    <div class=""><a href="#" class="text-default text-semibold">5.5</a> </div>
                                                    <div class="text-muted text-size-small">Glen</div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="tdropdown">

                                                    <i v-if="oBrandbost.status == 0" class="icon-primitive-dot txt_red fsize16"></i>
                                                    <i v-else-if="oBrandbost.status == 2" class="icon-primitive-dot txt_grey fsize16"></i>
                                                    <i v-else-if="oBrandbost.status == 3" class="icon-primitive-dot txt_red fsize16"></i>
                                                    <i v-else class="icon-primitive-dot txt_green fsize16"></i>
                                                    <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">

                                                        {{oBrandbost.status == 0 ? 'Inactive' :
                                                            (oBrandbost.status == 2 ? 'Pending' :
                                                                (oBrandbost.status == 3 ? 'Archive' : 'Active')
                                                            )
                                                        }}
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-right status">

                                                    </ul>
                                                </div>
                                            </td>


                                            <td style="display: none;">{{oBrandbost.status}}</td>
                                            <td style="display: none;">{{oBrandbost.status}}</td>
                                            <td style="display: none;">positive</td>
                                            <td style="display: none;">neutral</td>
                                            <td style="display: none;">negative</td>
                                            <td style="display: none;">
                                                today
                                            </td>
                                            <td>Last Time</td>
                                            <td class="text-center">
                                                <div v-if="oBrandbost.status==1 || oBrandbost.status == 0 || oBrandbost.status ==2" class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="/assets/images/more.svg"></a>
                                                    <ul class="dropdown-menu dropdown-menu-right more_act">

                                                        <li v-if="oBrandbost.status == 1"><a href="javascript:void(0);" class="changeStatusCampaign" :brandID="oBrandbost.id" status="2"><i class="icon-file-stats"></i> Pause</a></li>
                                                        <li v-if="oBrandbost.status == 2"><a href="javascript:void(0);" class="changeStatusCampaign" :brandID="oBrandbost.id" status="1"><i class="icon-file-stats"></i> Start</a></li>

                                                        <li><a :href="`/admin/brandboost/onsite_setup/${oBrandbost.id}`" :brandID="oBrandbost.id" :b_title="oBrandbost.brand_title" class="text-default text-semibold"><i class="icon-pencil"></i>  Edit</a></li>

                                                        <li><a href="javascript:void(0);" class="deleteCampaign" :brandID="oBrandbost.id"><i class="icon-trash"></i> Delete</a></li>
                                                        <li><a href="javascript:void(0);" class="archiveCampaign" :brandID="oBrandbost.id"><i class="icon-file-text2"></i> Move to Archive</a></li>

                                                        <li><a href="`/admin/brandboost/stats/onsite/${oBrandbost.id}?t=contact`" target="_blank"><i class="icon-gear"></i> Contacts</a></li>
                                                        <li>Company Name<a :href="`/for/test/${oBrandbost.brand_title}-{oBrandbost.id}`" target="_blank"><i class="icon-menu"></i>Campaign Page</a></li>
                                                        <li><a :href="`/admin/brandboost/reviews/${oBrandbost.id}`" target="_blank"><i class="icon-menu"></i>Reviews</a></li>
                                                        <li><a href="`/admin/questions/view/${oBrandbost.id}`" target="_blank"><i class="icon-menu"></i>Question</a></li>
                                                    </ul>
                                                </div>
                                                <div v-else class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="/assets/images/more.svg"></a>
                                                    <ul class="dropdown-menu dropdown-menu-right more_act">
                                                        <li><a href="`/admin/brandboost/onsite_setup/${oBrandbost.id}`" :brandID="oBrandbost.id" :b_title="oBrandbost.brand_title" class="text-default text-semibold"><i class="icon-pencil"></i>  Edit</a></li>
                                                        <li><a href="javascript:void(0);" class="deleteCampaign" :brandID="oBrandbost.id"><i class="icon-trash"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


</template>
<script src="/assets/js/modules/segments/segments.js" type="text/javascript"></script>

<!-- /addBrandboost -->

<script type="text/javascript">


    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#onsiteBrandboostCampaign thead tr').clone(true).appendTo('#onsiteBrandboostCampaign thead');

        $('#onsiteBrandboostCampaign thead tr:eq(1) th').each(function (i) {


            if (i === 12) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="1|0|2" placeholder="Search ' + title + '" /><input type="checkbox" class="" id="colStatus">');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                            .column(i)
                            .search(this.value, $('#colStatus').prop('checked', true))
                            .draw();
                    }
                });
            }

            if (i === 13) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterStatus" value="" placeholder="Search ' + title + '" /><input type="checkbox" class="" id="colStatusActive">');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                            .column(i)
                            .search(this.value, $('#colStatusActive').prop('checked', true))
                            .draw();
                    }
                });
            }

            if (i === 14) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterPositive" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            }

            if (i === 15) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterNeutral" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            }

            if (i === 16) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterNegative" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            }

            if (i === 17) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterAddedToday" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            }

        });

        setTimeout(function () {
            $('#activeCampaign').trigger('click');
        }, 2000);


        $(document).on('click', '.filterByColumn', function () {

            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterByStatus').val(fil);
            $('#filterByStatus').keyup();

        });

        $(document).on('click', '.top_links_Status', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            var getStatus = $('#filterStatus').val();
            var statusArr = [];
            if ($(this).hasClass('btn_white_table')) {
                var findStatus = $(this).attr('getValue');
                statusArr = getStatus.split("|");
                var index = statusArr.indexOf(findStatus);
                if (index > -1) {
                    statusArr.splice(index, 1);
                }
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {

                var findStatus = $(this).attr('getValue');
                if (getStatus == '') {
                    statusArr.push(findStatus);
                } else {
                    statusArr = getStatus.split("|");
                    statusArr.push(findStatus);
                }

                $(this).addClass('btn btn-xs btn_white_table');
            }

            var newStatusArray = statusArr.join('|');
            $('#filterStatus').val(newStatusArray);
            $('#filterStatus').keyup();

            $('.top_links_all').removeClass('btn btn-xs btn_white_table');

        });

        $(document).on('click', '.top_links_all', function () {

            $('.heading_links').each(function (i) {
                $(this).children('a').removeClass('btn btn-xs btn_white_table');
            });
            $(this).addClass('btn btn-xs btn_white_table');
            //var findStatus = $(this).attr('getValue');

            $('#filterStatus').val('');
            $('#filterStatus').keyup();

            $('#filterPositive').val('');
            $('#filterPositive').keyup();

            $('#filterNeutral').val('');
            $('#filterNeutral').keyup();

            $('#filterNegative').val('');
            $('#filterNegative').keyup();

            $('#filterAddedToday').val('');
            $('#filterAddedToday').keyup();

        });


        $(document).on('click', '.top_links_positive', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterPositive').val(findValue);
            $('#filterPositive').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });

        $(document).on('click', '.top_links_neutral', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterNeutral').val(findValue);
            $('#filterNeutral').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });

        $(document).on('click', '.top_links_negative', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterNegative').val(findValue);
            $('#filterNegative').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });

        $(document).on('click', '.top_links_added_today', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterAddedToday').val(findValue);
            $('#filterAddedToday').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });


        var tableId = 'onsiteBrandboostCampaign';
        var tableBase = custom_data_table(tableId);

    });




    $(document).ready(function () {

        $('#checkAll').change(function () {

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

        $(document).on('click', '.checkRows', function () {
            var inc = 0;


            var rowId = $(this).val();

            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
            } else {
                $('#append-' + rowId).addClass('success');
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

        });

        $(document).on('click', '#deleteButtonBrandboostOnline', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
                    "This campaign will deleted immediately.<br>You can't undo this action.",
                    function() {

                        $('.overlaynew').show();
                        $.ajax({
                            url: "{{ base_url('admin/brandboost/delete_multipal_brandboost') }}",
                            type: "POST",
                            data: {multi_brandboost_id: val, _token: '{{csrf_token()}}'},
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

        $('#checkAllA').change(function () {

            if (false == $(this).prop("checked")) {

                $(".checkRowsA").prop('checked', false);
                $(".selectedClassA").removeClass('success');
                $('.custom_action_boxA').hide();
            } else {

                $(".checkRowsA").prop('checked', true);
                $(".selectedClassA").addClass('success');
                $('.custom_action_boxA').show();
            }

        });

        $(document).on('click', '.checkRowsA', function () {
            var inc = 0;


            var rowId = $(this).val();

            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
            } else {
                $('#append-' + rowId).addClass('success');
            }

            $('.checkRowsA:checkbox:checked').each(function (i) {
                inc++;
            });
            if (inc == 0) {

                $('.custom_action_boxA').hide();
            } else {
                $('.custom_action_boxA').show();
            }

            var numberOfChecked = $('.checkRowsA:checkbox:checked').length;
            var totalCheckboxes = $('.checkRowsA:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAllA').prop('checked', false);
            }

        });

        $(document).on('click', '#deleteButtonBrandboostOnlineA', function () {

            var val = [];
            $('.checkRowsA:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
                    "This campaign will deleted immediately.<br>You can't undo this action.",
                    function() {

                        $('.overlaynew').show();
                        $.ajax({
                            url: "{{ base_url('admin/brandboost/delete_multipal_brandboost') }}",
                            type: "POST",
                            data: {multi_brandboost_id: val},
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


        $(document).on('click', '#archiveButtonBrandboostOnline', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                archiveConfirmationPopup(
                    "This campaign will move to archive immediately.<br>You can't undo this action.",
                    function() {

                        $('.overlaynew').show();
                        $.ajax({
                            url: "{{ base_url('admin/brandboost/archive_multipal_brandboost') }}",
                            type: "POST",
                            data: {multi_brandboost_id: val, _token: '{{csrf_token()}}'},
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

        $(document).on('click', '.archiveCampaign', function () {
            var brandID = $(this).attr('brandID');
            var val = [brandID];

            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                archiveConfirmationPopup(
                    "This campaign will move to archive immediately.<br>You can't undo this action.",
                    function() {

                        $('.overlaynew').show();
                        $.ajax({
                            url: "{{ base_url('admin/brandboost/archive_multipal_brandboost') }}",
                            type: "POST",
                            data: {multi_brandboost_id: val, _token: '{{csrf_token()}}'},
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

        $(document).on('click', '#addBrandboost', function () {
            $('#addBrandboostModal').modal();
        });

        $('#frmAddOnsiteBrandboost').on('submit', function (e) {
            $('.overlaynew').show();
            var campaignName = $('#campaignName').val();
            var OnsitecampaignDescription = $('#OnsitecampaignDescription').val();

            $.ajax({
                url: "{{ base_url('admin/brandboost/addOnsite') }}",
                type: "POST",
                data: {'campaignName': campaignName,'OnsitecampaignDescription':OnsitecampaignDescription, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '{{ base_url() }}admin/brandboost/onsite_setup/' + data.brandboostID;
                    } else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });


        $(document).on("click", ".changeStatusCampaign", function () {
            var brandboostID = $(this).attr('brandID');
            var status = $(this).attr('status');
            $.ajax({
                url: "{{ base_url('admin/brandboost/updateOnsiteStatus') }}",
                type: "POST",
                data: {'brandboostID': brandboostID, 'status': status, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = "{{ base_url('admin/brandboost/onsite') }}";
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on('click', '.deleteCampaign', function () {

            var brandID = $(this).attr('brandID');

            deleteConfirmationPopup(
                "This campaign will deleted immediately.<br>You can't undo this action.",
                function() {

                    $('.overlaynew').show();

                    $.ajax({
                        url: "{{ base_url('admin/brandboost/delete_brandboost') }}",
                        type: "POST",
                        data: {brandboost_id: brandID, _token: '{{csrf_token()}}'},
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

        });

        $(document).on('click', '.viewECode', function () {
            var brandID = $(this).attr('brandID');
            $.ajax({
                url: '{{ base_url('admin/brandboost/getBBECode') }}',
                type: "POST",
                data: {brandboost_id: brandID, _token: '{{csrf_token()}}'},
            dataType: "json",
                success: function (data) {
                if (data.status == 'success') {
                    var embeddedCode = data.result;
                    $('#embeddedCode').html(embeddedCode);
                    $("#viewEModel").modal();
                }
            }
        });
        });

        $(document).on('click', '.editArchiveDataList', function () {
            $('.editArchiveAction').toggle();
            $('#deleteButtonBrandboostOnlineA').toggle();
        });

        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });

        $('[data-toggle="tooltip"]').tooltip();

    });
</script>
<script>
    //import SegmentPopup from './SegmentPopup.vue';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        data() {
            return {
                oBrandbosts: {}
            }
        },
        // components: {'dashboard-reivews' : DashReviews},
        mounted() {
            //getData
            axios.get('/admin/brandboost/onsite')
                .then(response => {
                    //console.log(response);
                    //console.log(response.data.iTotalRecords);
                    this.oBrandbosts = response.data.aBrandbosts;
                    console.log(this.oBrandbosts);
                });
        }

    }
</script>
