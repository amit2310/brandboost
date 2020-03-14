<template>
    <div class="tab-pane " id="right-icon-tab0">
        <!--******************Top Heading area **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Brand Settings</h3>
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li><a href="#/settings/general" tyle="cursor:pointer; padding: 5px;">General&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/preferences" style="cursor:pointer; padding: 5px;"> Preferences&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/subscription" style="cursor:pointer; padding: 5px;">Subscription & Credits&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/billing" style="cursor:pointer; padding: 5px;">Billing&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/notification" style="cursor:pointer; padding: 5px;">Notifications&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/import" style="cursor:pointer; padding: 5px;">Import&nbsp;</a></li>&nbsp;&nbsp;
                            <li  class="active"><a href="#/settings/export" style="cursor:pointer;">Export</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
        <loading :isLoading="loading"></loading>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-flat review_ratings">
                    <div class="panel-heading" style="padding: 10px;">
                        <h6 class="panel-title">Export Data</h6>
                    </div>

                    <div class="panel-body p0">
                        <!--====GENERAL SETTINGS====-->
                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="">Start new Export</p>
                                    <p class="text-muted fsize13 mb-20">Import data into Copper from Google Contacts, CSV files, or Excel files.</p>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <div class="import_box">
                                        <div class="img_icon mb20">
                                            <a href="admin/tags/exportTags"><img src="assets/images/icon_tab.png" width="27"></a></div>
                                        <p class="mb0">Export Tags</p>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="import_box">
                                        <div class="img_icon mb20"><a href="admin/brandboost/exportMedia">
                                            <img src="assets/images/icon_media.png" width="27"></a></div>
                                        <p class="mb0">Export  Media</p>
                                    </div>
                                </div>

                                <div class="col-md-3 text-center">
                                    <div class="import_box">
                                        <div class="img_icon mb20"><a v-bind:href="'admin/subscriber/exportSubscriberCSV?module_name=people&module_account_id='+oUser.id+''">
                                            <img src="assets/images/contact_icon.png" width="27"></a></div>
                                        <p class="mb0">Export Contacts</p>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="import_box">
                                        <div class="img_icon mb20"><a href="admin/brandboost/exportReviews"><img src="assets/images/icon_star.png" width="27"></a></div>
                                        <p class="mb0">Export Reviews</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-flat review_ratings">
                    <div class="panel-heading" style="padding: 10px;">
                        <h6 class="panel-title">Past Imports</h6>
<!--                        <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>-->
                    </div>

                    <div class="panel-body p0">
                        <!--====GENERAL SETTINGS====-->
                        <div class="bbot p30">
                            <div class="row">
                                <table class="table datatable-basic-new">
                                    <tbody>
                                    <tr v-for="oHistory in oExportHistory">
                                        <td>
                                            <div class="media-left media-middle">
                                                <a class="icons br5" href="#"><i class="icon-arrow-down16 txt_purple"></i></a>
                                            </div>
                                            <div class="media-left">
                                                <div class="pt-2">
                                                    <a href="#" class="text-default text-semibold">Export {{ oHistory.import_name }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted">{{ displayDateFormat("d M Y  h:iA", oHistory.created) }}</span></td>
                                        <td class="text-right"><span class="txt_purple">{{ oHistory.item_count }} Items</span></td>
                                    </tr>
                                    <tr v-if="!oExportHistory">
                                        <td colspan="3" class="text-center">No Record found</td>
                                    </tr>
                                    <!--                            @endif-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-flat review_ratings">
                    <div class="panel-heading" style="padding: 10px;">
                        <h6 class="panel-title">Info Card</h6>
                    </div>

                    <div class="panel-body min_h405 p40 pt60 info_card text-center">
                        <div class="img_icon mb20"><img src="assets/images/bulb.png" width="27"></div>
                        <p class="mb20"><strong>Tips For a Smooth Import</strong></p>
                        <p class="mb20"><span>We recommend using our formatted<br> Excel and CSV templates to ensure your<br> data is formatted properly.</span></p>
                        <a class="txt_purple" href="#">Learn More</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "SettingExport",
        title: 'Admin Settings - Brand Boost',
        data() {
            return {
                refreshMessage: '',
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                seletedTab: 1,
                settingsData: '',
                notificationData: '',
                notificationEventData: '',
                oImportHistory: '',
                oExportHistory: '',
                oMemberships: '',
                oCurrentPlanData: '',
                oCurrentTopupPlanData: '',
                oInvoices: '',
                invoiceData: '',
                notificationlisting: '',
                oUser: '',
                countries: {},
                ccCardDetail: {},
                current_page: 1,
            }
        },
        mounted() {
            this.loadData();
            setTimeout(function(){
                loadJQCode();
            },2000);
        },
        filters: {
            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            }
        },

        methods: {

            loadData: function () {
                //getData
                this.loading = true;
                console.log(this.current_page);
                axios.get('/admin/settings?page='+this.current_page)
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.settingsData = response.data.settingsData;
                        this.notificationData = response.data.notificationData;
                        this.notificationEventData = response.data.notificationEventData;
                        this.oImportHistory = response.data.oImportHistory;
                        this.oExportHistory = response.data.oExportHistory;
                        this.oMemberships = response.data.oMemberships;
                        this.oCurrentPlanData = response.data.oCurrentPlanData;
                        this.oCurrentTopupPlanData = response.data.oCurrentTopupPlanData;
                        this.seletedTab = response.data.seletedTab;
                        this.oInvoices = response.data.oInvoices;
                        this.invoiceData = response.data.invoiceData;
                        this.notificationlisting = response.data.notificationlisting;
                        this.oUser = response.data.oUser;
                        this.countries = response.data.countries;
                    });
            },


        }
    }
    function loadJQCode(){
        $(document).ready(function () {

        });

    }
</script>
<style scoped>

</style>
