<template>
    <div class="content" id="masterContainer">
        <!--******************
          Top Heading area
         **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <span class="float-left mr20 back_btn">
                            <img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">On Site Widget Setup</h3>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <!--******************
              Content Area
             **********************-->
            <div class="content-area">
                <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
                <loading :isLoading="loading"></loading>
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="htxt_medium_16 dark_400">Review Widgets</span> |
                            <span class="htxt_medium_16 dark_400">Configuration</span> |
                            <span class="htxt_medium_16 dark_400">Integration</span> |
                            <span class="htxt_medium_16 dark_400">Statistics</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
<!--                            <div class="panel-heading">-->
<!--                                <h6 class="panel-title">Statistics Details<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>-->
<!--                                <div class="heading-elements">-->
<!--                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">-->
<!--                                        <input class="form-control input-sm" placeholder="Search by name" type="text">-->
<!--                                        <div class="form-control-feedback">-->
<!--                                            <i class="icon-search4"></i>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="table_action_tool">-->
<!--                                        <a href="#"><i class="icon-calendar52"></i></a>-->
<!--                                        <a href="#"><i class="icon-arrow-down16"></i></a>-->
<!--                                        <a href="#"><i class="icon-arrow-up16"></i></a>-->
<!--                                        <a href="#"><i class="icon-pencil"></i></a>-->
<!--                                    </div>-->

<!--                                </div>-->
<!--                            </div>-->
                            <div class="panel-body p0">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
<!--                                    <div class="top">-->
<!--                                        <div id="DataTables_Table_0_filter" class="dataTables_filter">-->
<!--                                            <label>-->
<!--                                                <span>Filter:</span> -->
<!--                                                <input type="search" class="" placeholder="Type to filter..." aria-controls="DataTables_Table_0">-->
<!--                                            </label>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <table class="table datatable-basic dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                    <tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Widget Name: activate to sort column ascending">Widget Name</th><th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="descending" aria-label="Type: activate to sort column ascending">Type</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Campaign Name: activate to sort column ascending">Campaign Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Created: activate to sort column ascending">Created</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Source: activate to sort column ascending">Source</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="IP: activate to sort column ascending">IP</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform: activate to sort column ascending">Platform</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Browser</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="City: activate to sort column ascending">City</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending">Country</th></tr>
                                    </thead>
                                    <tbody>
<!--                                    {{widget}}-->
                                         <tr v-for="wl in  widget">
                                             {{wl}}
                                             <td>{{wl.widget_title}}</td>
                                             <td>{{wl.review_type}}</td>
                                             <td>{{wl.widget_img}}</td>
                                             <td>{{wl.brand_title}}</td>
                                         </tr>


<!--                                    <tr role="row" class="odd">-->
<!--                                        <td>-->
<!--                                            <div class="media-left media-middle">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_widget_setup/10" widgetid="10" b_title="" class="text-default text-semibold">-->
<!--                                                    <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/text_review_5887_aa6f54ab87ddd24ac805bd046d6614db8b92fa25.jpg" class="img-circle img-xs br5" alt="Img"></a>-->
<!--                                            </div>-->
<!--                                            <div class="media-left">-->
<!--                                                <div class=""><a href="http://brandboost.io/admin/brandboost/onsite_widget_setup/56" widgetid="56" b_title="Bottom Review Widget" class="text-default text-semibold">Bottom Review Widget</a></div>-->
<!--                                                <div class="text-muted text-size-small">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </td>-->

<!--                                        <td class="sorting_1">Center Popup</td>-->
<!--                                        <td>-->
<!--                                            <div class="media-left media-middle">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_setup/111" class="text-default text-semibold">-->
<!--                                                    <img src="http://brandboost.io/assets/images/default_table_img2.svg" class="img-circle img-xs br5" alt="Img">-->
<!--                                                </a>-->
<!--                                            </div>-->
<!--                                            <div class="media-left">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_setup/111" target="_blank">-->
<!--                                                    Onsite New																													</a>-->
<!--                                                <div class="text-muted text-size-small">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                        <td>-->
<!--                                            <div class="media-left">-->
<!--                                                <div class="pt-5"><span class="text-default text-semibold">March 12th 2019</span></div>-->
<!--                                                <div class="text-muted text-size-small">03:45 PM</div>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                        <td>view</td>-->
<!--                                        <td>review</td>-->
<!--                                        <td>36.255.132.146</td>-->
<!--                                        <td><i class="icon-windows txt_blue_sky2"></i></td>-->
<!--                                        &lt;!&ndash; <td>No Data</td> &ndash;&gt;-->
<!--                                        <td><i class="icon-firefox txt_orange"></i></td>-->
<!--                                        &lt;!&ndash; <td>National Capital Territory of Delhi</td> &ndash;&gt;-->
<!--                                        <td>Delhi</td>-->
<!--                                        <td>India</td>-->
<!--                                    </tr>-->
<!--                                    <tr role="row" class="even">-->
<!--                                        <td>-->
<!--                                            <div class="media-left media-middle">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_widget_setup/10" widgetid="10" b_title="" class="text-default text-semibold">-->
<!--                                                    <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/text_review_5887_aa6f54ab87ddd24ac805bd046d6614db8b92fa25.jpg" class="img-circle img-xs br5" alt="Img"></a>-->
<!--                                            </div>-->
<!--                                            <div class="media-left">-->
<!--                                                <div class=""><a href="http://brandboost.io/admin/brandboost/onsite_widget_setup/69" widgetid="69" b_title="Bottom Review Widget" class="text-default text-semibold">Bottom Review Widget</a></div>-->
<!--                                                <div class="text-muted text-size-small">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </td>-->

<!--                                        <td class="sorting_1">Center Popup</td>-->
<!--                                        <td>-->
<!--                                            <div class="media-left media-middle">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_setup/111" class="text-default text-semibold">-->
<!--                                                    <img src="http://brandboost.io/assets/images/default_table_img2.svg" class="img-circle img-xs br5" alt="Img">-->
<!--                                                </a>-->
<!--                                            </div>-->
<!--                                            <div class="media-left">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_setup/111" target="_blank">-->
<!--                                                    Onsite New																													</a>-->
<!--                                                <div class="text-muted text-size-small">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                        <td>-->
<!--                                            <div class="media-left">-->
<!--                                                <div class="pt-5"><span class="text-default text-semibold">April 12th 2019</span></div>-->
<!--                                                <div class="text-muted text-size-small">06:50 PM</div>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                        <td>view</td>-->
<!--                                        <td>review</td>-->
<!--                                        <td>14.141.174.122</td>-->
<!--                                        <td><i class="icon-windows txt_blue_sky2"></i></td>-->
<!--                                        &lt;!&ndash; <td>No Data</td> &ndash;&gt;-->
<!--                                        <td><i class="icon-firefox txt_orange"></i></td>-->
<!--                                        &lt;!&ndash; <td>Haryana</td> &ndash;&gt;-->
<!--                                        <td>Gurgaon</td>-->
<!--                                        <td>India</td>-->
<!--                                    </tr>-->
<!--                                    <tr role="row" class="odd">-->
<!--                                        <td>-->
<!--                                            <div class="media-left media-middle">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_widget_setup/10" widgetid="10" b_title="" class="text-default text-semibold">-->
<!--                                                    <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/text_review_5887_aa6f54ab87ddd24ac805bd046d6614db8b92fa25.jpg" class="img-circle img-xs br5" alt="Img"></a>-->
<!--                                            </div>-->
<!--                                            <div class="media-left">-->
<!--                                                <div class=""><a href="http://brandboost.io/admin/brandboost/onsite_widget_setup/38" widgetid="38" b_title="Bottom Review Widget" class="text-default text-semibold">Bottom Review Widget</a></div>-->
<!--                                                <div class="text-muted text-size-small">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </td>-->

<!--                                        <td class="sorting_1">Bottom Fixed Popup</td>-->
<!--                                        <td>-->
<!--                                            <div class="media-left media-middle">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_setup/111" class="text-default text-semibold">-->
<!--                                                    <img src="http://brandboost.io/assets/images/default_table_img2.svg" class="img-circle img-xs br5" alt="Img">-->
<!--                                                </a>-->
<!--                                            </div>-->
<!--                                            <div class="media-left">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_setup/111" target="_blank">-->
<!--                                                    Onsite New																													</a>-->
<!--                                                <div class="text-muted text-size-small">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                        <td>-->
<!--                                            <div class="media-left">-->
<!--                                                <div class="pt-5"><span class="text-default text-semibold">February 19th 2019</span></div>-->
<!--                                                <div class="text-muted text-size-small">07:08 PM</div>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                        <td>view</td>-->
<!--                                        <td>review</td>-->
<!--                                        <td>103.254.97.14</td>-->
<!--                                        <td><i class="icon-windows txt_blue_sky2"></i></td>-->
<!--                                        &lt;!&ndash; <td>No Data</td> &ndash;&gt;-->
<!--                                        <td><i class="icon-firefox txt_orange"></i></td>-->
<!--                                        &lt;!&ndash; <td>National Capital Territory of Delhi</td> &ndash;&gt;-->
<!--                                        <td>Delhi</td>-->
<!--                                        <td>India</td>-->
<!--                                    </tr>-->
<!--                                    <tr role="row" class="even">-->
<!--                                        <td>-->
<!--                                            <div class="media-left media-middle">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_widget_setup/10" widgetid="10" b_title="" class="text-default text-semibold">-->
<!--                                                    <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/text_review_3577_b318c8481b828e2a6e9d5fbf34b99c9d1bdb8dc2.jpg" class="img-circle img-xs br5" alt="Img"></a>-->
<!--                                            </div>-->
<!--                                            <div class="media-left">-->
<!--                                                <div class=""><a href="http://brandboost.io/admin/brandboost/onsite_widget_setup/81" widgetid="81" b_title="Bottom Review Widget" class="text-default text-semibold">Bottom Review Widget</a></div>-->
<!--                                                <div class="text-muted text-size-small">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </td>-->

<!--                                        <td class="sorting_1">Bottom Fixed Popup</td>-->
<!--                                        <td>-->
<!--                                            <div class="media-left media-middle">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_setup/190" class="text-default text-semibold">-->
<!--                                                    <img src="http://brandboost.io/assets/images/default_table_img2.svg" class="img-circle img-xs br5" alt="Img">-->
<!--                                                </a>-->
<!--                                            </div>-->
<!--                                            <div class="media-left">-->
<!--                                                <a href="http://brandboost.io/admin/brandboost/onsite_setup/190" target="_blank">-->
<!--                                                    Tacoma																													</a>-->
<!--                                                <div class="text-muted text-size-small">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                        <td>-->
<!--                                            <div class="media-left">-->
<!--                                                <div class="pt-5"><span class="text-default text-semibold">April 16th 2019</span></div>-->
<!--                                                <div class="text-muted text-size-small">12:31 AM</div>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                        <td>view</td>-->
<!--                                        <td>review</td>-->
<!--                                        <td>71.68.120.136</td>-->
<!--                                        <td><i class="icon-apple2"></i></td>-->
<!--                                        &lt;!&ndash; <td>No Data</td> &ndash;&gt;-->
<!--                                        <td><i class="icon-safari txt_dark"></i></td>-->
<!--                                        &lt;!&ndash; <td>North Carolina</td> &ndash;&gt;-->
<!--                                        <td>Charlotte</td>-->
<!--                                        <td>United States</td>-->
<!--                                    </tr>-->
                                    </tbody>
                                </table>
                                    <div class="datatable-footer">
                                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous">Prev</a><span><a class="paginate_button current" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" id="DataTables_Table_0_next">Next</a></div><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite"><span><span class="text-muted ml10">Showing results</span><span class="txt_black ml10"> 1 - 4 of 4</span></span></div><div class="dataTables_length" id="DataTables_Table_0_length"><label>View <a style="cursor: pointer;" id="_5">5</a><a style="cursor: pointer;" id="_10" class="current">10</a><a style="cursor: pointer;" id="_20">20</a><a style="cursor: pointer;" id="_40">40</a><a style="cursor: pointer;" id="all">All</a></label></div></div><div class="clear"></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        title: 'Onsite Widgets - Brand Boost',
        data() {
            return {
                form: {
                    campaignName: '',
                },
                successMsg: '',
                errorMsg: '',
                loading: true,
                widget_type: '',
                widget:[],
                oStats:'',
                widgetID:''
            }
        },
        mounted() {
            this.widgetID = this.$route.params.id;
            this.widget_type = this.$route.params.id;
            this.getWidgetDetails()
        },
        methods: {
            setWidgetType:function(){
                this.loading =true;
                axios.post('/admin/brandboost/set-widget-type',{

                    widgetID: this.$route.params.id,
                    widgetTypeID: this.widget_type,

                }).then(response => {
                    // console.log(response.data.status);
                    this.getWidgetDetails();
                    if(response.data.status =='success'){
                        this.successMsg="Setting has beeb saved successfully.";
                    }
                    this.loading =false;
                });
            },
            getWidgetDetails: function () {
                //getData
                axios.get('/admin/widgets/statistics-details',{
                    params: {
                        widgetID: this.$route.params.id,

                    }
                })
                    .then(response => {
                        // console.log(response.data);
                        this.widget = response.data.oWidget.data;
                        this.oStats = response.data.oStats.data;
                        this.loading =false;

                    });
            },


        }
    }

    $(document).ready(function () {
        $(document).on('click', '.js-onsite-widget-slidebox', function () {
            $(".box").animate({
                width: "toggle"
            });
        });

        /*$('[name=tags]').tagify();*/

        $(document).on('click', '.viewECode', function () {
            var widgetID = $(this).attr('widgetID');
            $.ajax({
                url: 'admin/brandboost/getOnsiteWidgetEmbedCode',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: {widget_id: widgetID},
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

    });
</script>

<style>
    .review_source_new .inner {
        text-align: center;
        border-radius: 5px;
        box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);
        background-color: #ffffff;
        /* border: solid 1px #e3e9f3; */
        min-height: 248px;
        position: relative;
        padding: 15px;
    }
    .review_source_new .custmo_checkbox.checkboxs {
        position: absolute;
        width: 17px;
        right: 5px!important;
        top: 11px;
        z-index: 9;
        display: inline-block;
    }
    .custmo_checkbox {
        display: block;
        position: relative;
        padding-left: 18px;
        margin-bottom: 0px;
        cursor: pointer;
        font-size: 13px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        line-height: 17px;
        height: 17px;

    }
    .custmo_checkmark{
        border-radius: 10px;
        border: 1px solid #FFF !important;
    }
    .col-md-2.review_source_new .inner {
        text-align: center;
        border-radius: 5px;
        box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);
        background-color: #ffffff;
        /* border: solid 1px #e3e9f3; */
        min-height: 200px;
        position: relative;
        padding: 15px;
    }
    .col-md-2.review_source_new .inner.active {
        border: 1px solid #9986e4!important;
    }
    .col-md-2.review_source_new .inner .text_sec p {
        margin-bottom: 5px;
    }
    .col-md-2.review_source_new .inner .text_sec h5 {
        font-size: 12px;
        font-weight: 300 !important;
        color: #5e729d;
        line-height: 1.33;
        margin: 0;
    }
</style>
