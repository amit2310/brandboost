<template>

<!--    <div class="content" id="masterContainer">-->
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
<!--            <div class="content-area">-->
                <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
                <loading :isLoading="loading"></loading>
                <div class="table_head_action">
<!--                    <div class="row">-->
<!--                        <div class="col-md-6">-->
<!--                            <span class="htxt_medium_16 dark_400">Review Widgets</span> |-->
<!--                            <span class="htxt_medium_16 dark_400">Configuration</span> |-->
<!--                            <span class="htxt_medium_16 dark_400">Integration</span> |-->
<!--                            <span class="htxt_medium_16 dark_400">Statistics</span>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
                <div class="container-fluid">

                    <div class="table_head_action" v-if="showHeader !== false">
                        <div class="row">
                            <div class="col-md-6">
                                <a v-on:click="setReq()" class="htxt_medium_16 dark_400">Review Widgets</a> |
                                <span class="htxt_medium_16 dark_400">Configuration</span> |
                                <span class="htxt_medium_16 dark_400">Integration</span> |
                                <span class="htxt_medium_16 dark_400">Statistics</span>
<!--                                <h3 class="htxt_medium_16 dark_400">Statistics Details</h3>-->
<!--                                {{ allData.length }}-->
                            </div>
                            <div class="col-md-6">
                                <div class="table_action">
                                    <div class="float-right">
                                        <button type="button" class="dropdown-toggle table_action_dropdown"
                                                data-toggle="dropdown">
                                            <span><img src="/assets/images/date_created.svg"/></span>&nbsp; Date Created
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Link 1</a>
                                            <a class="dropdown-item" href="#">Link 2</a>
                                            <a class="dropdown-item" href="#">Link 3</a>
                                        </div>
                                    </div>
                                    <div class="float-right ml10 mr10">
                                        <button type="button" class="dropdown-toggle table_action_dropdown"
                                                data-toggle="dropdown">
                                            <span><img src="/assets/images/list_view.svg"/></span>&nbsp; List View
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Link 1</a>
                                            <a class="dropdown-item" href="#">Link 2</a>
                                            <a class="dropdown-item" href="#">Link 3</a>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <input class="table_search" type="text" placeholder="Search"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <span class="htxt_medium_16 dark_400"><strong>{{ allData.total }} Records</strong></span>
                        </div>
                        <div class="col-md-8">
<!--                            <a v-on:click="setReq('today')" class="htxt_medium_16 dark_400">Today</a>-->
                            <a v-on:click="setReq('all')" href="javascript:void(0)" class="htxt_regular_12 dark_400">All Time</a> |
                            <a v-on:click="setReq('today')" href="javascript:void(0)" class="htxt_regular_12 dark_400">Today</a> |
                            <a v-on:click="setReq('yest')" href="javascript:void(0)" class="htxt_regular_12 dark_400">Yesterday</a> |
                            <a v-on:click="setReq('week')" href="javascript:void(0)"class="htxt_regular_12 dark_400">Week</a> |
                            <a v-on:click="setReq('month')" href="javascript:void(0)" class="htxt_regular_12 dark_400">Month</a> |
                            <a v-on:click="setReq('3month')" href="javascript:void(0)" class="htxt_regular_12 dark_400">3 Month</a>
                        </div>
                    </div>
                    <br/>

                    <div class="row">
                        <div class="col-md-3 d-flex">
                            <div class="card p0 col">
                                <div class="p15 pl30 bbot">
                                    <a href="#" class="fsize12 dark_200 fw500">Views</a>
                                </div>
                                <div class="p30 pl40 pb0">
                                    <h3 class="htxt_regular_28 dark_700 mb10">{{ widget.totalViews }}</h3>
                                    <p class="fsize14 mb-0"><span class="red_400">{{ widget.totalViewsPre }}%</span> &nbsp;
<!--                                        <span class="dark_400"> / week</span>-->
                                    </p>
                                </div>
                                <widget-event-graph></widget-event-graph>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex">
                            <div class="card p0 col">
                                <div class="p15 pl30 bbot">
                                    <a href="#" class="fsize12 dark_200 fw500">Clicks</a>
                                </div>
                                <div class="p30 pl40 pb0">
                                    <h3 class="htxt_regular_28 dark_700 mb10">{{ widget.totalClicks }}</h3>
                                    <p class="fsize14 mb-0"><span class="green_400">{{ widget.totalClicksPre }}%</span> &nbsp;
                                        <!--                                        <span class="dark_400"> / week</span>-->
                                    </p>

                                </div>
                                <widget-event-graph></widget-event-graph>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex">
                            <div class="card p0 col">
                                <div class="p15 pl30 bbot">
                                    <a href="#" class="fsize12 dark_200 fw500">Commentshhhhh</a>
                                </div>
                                <div class="p30 pl40 pb0">
                                    <h3 class="htxt_regular_28 dark_700 mb10">{{ widget.totalComments }}</h3>
                                    <p class="fsize14 mb-0"><span class="green_400">{{ widget.totalCommentsPre }}%</span> &nbsp;
                                        <!--                                        <span class="dark_400"> / week</span>-->
                                    </p>

                                </div>
                                <widget-event-graph></widget-event-graph>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex">
                            <div class="card p0 col">
                                <div class="p15 pl30 bbot">
                                    <a href="#" class="fsize12 dark_200 fw500">Helpfull</a>
                                </div>
                                <div class="p30 pl40 pb0">
                                    <h3 class="htxt_regular_28 dark_700 mb10">{{ widget.totalHelpful }}</h3>
                                    <p class="fsize14 mb-0"><span class="green_400">{{ widget.totalHelpfulPre }}%</span> &nbsp;
                                        <!--                                        <span class="dark_400"> / week</span>-->
                                    </p>

                                </div>
                                <widget-event-graph></widget-event-graph>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>

                                    <tr>

                                        <td><span class="fsize12 fw300">Widget Name </span></td>
                                        <td><span class="fsize12 fw300">Type </span></td>
                                        <td><span class="fsize12 fw300">Campaign Name </span></td>
                                        <td><span class="fsize12 fw300">Created </span></td>
                                        <td><span class="fsize12 fw300">Action </span></td>
                                        <td><span class="fsize12 fw300">Source </span></td>
                                        <td><span class="fsize12 fw300">IP </span></td>
                                        <td><span class="fsize12 fw300">Platform </span></td>
                                        <td><span class="fsize12 fw300">Browser </span></td>
                                        <td><span class="fsize12 fw300">City </span></td>
                                        <td><span class="fsize12 fw300">Country </span></td>
                                    </tr>
<!--                                    {{allData.data}}-->

                                    <tr v-if="allData.data.length==0">
                                        <td colspan="10" class="text-center">No Record found.</td>
                                    </tr>
                                    <tr v-for="os in allData.data" v-if="allData.data.length>0">
<!--                                        {{os.brand_img}}-->
                                        <td>
                                            {{os.widget_title}}</td>

                                        <td>

                                            <span v-if="os.widget_type === 'cpw'"> Center Popup </span>
                                            <span v-if="os.widget_type === 'bww'"> Small Popup </span>
                                            <span v-if="os.widget_type === 'bfw'"> Horizontal Popup </span>
                                            <span v-if="os.widget_type === 'vpw'"> Vertical Popup </span>
                                            <span v-if="os.widget_type === 'rfw'"> Embeded Reviews </span>

                                        </td>
                                        <td>{{os.bbBrandTitle}}</td>
                                        <td>{{os.created_at}}</td>
                                        <td>{{os.track_type}}</td>
                                        <td>{{os.section_type}}</td>
                                        <td>{{os.ip_address}}</td>
                                        <td>{{os.platform}}</td>
                                        <td>{{os.browser}}</td>

                                        <td>{{os.city}}</td>
                                        <td>{{os.country}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                                <pagination
                                    :pagination="allData"
                                    @paginate="showPaginationData"
                                    :offset="2">
                                </pagination>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--        </div>-->
<!--    </div>-->
</template>


<script>

    import WidgetEventGraph from '@/components/admin/modules/widgets/onsite/WidgetEventGraph.vue';
    import Pagination from '@/components/helpers/Pagination';
    export default {
        title: 'Onsite Widgets - Brand Boost',
        components: {Pagination,WidgetEventGraph},
        data() {
            return {
                form: {
                    campaignName: '',
                },
                successMsg: '',
                errorMsg: '',
                loading: true,
                showHeader:true,
                current_page: 1,
                widget_type: '',
                widget:[],
                allData:[],
                widgetID:'',
                req:'all'
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
            showPaginationData: function(current_page){
                this.loading=true;
                this.current_page = current_page;
                this.getWidgetDetails();

            },
            setReq: function(req){
                this.loading=true;
                this.req = req;
                this.getWidgetDetails();

            },
            getWidgetDetails: function () {
                //getData
                axios.get('/admin/widgets/statistics-details',{
                    params: {
                        widgetID: this.$route.params.id,
                        page: this.current_page,
                        req:this.req,
                    }
                })
                .then(response => {
                        // console.log(response.data);
                        this.widget = response.data.oWidget;
                        this.allData = response.data.oStats;
                        console.log(this.allData);
                        this.loading =false;

                    });
            },


        }
    }

</script>

<style scoped>
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
