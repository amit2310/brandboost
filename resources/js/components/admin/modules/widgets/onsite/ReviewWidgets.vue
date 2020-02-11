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



                        <div class="col-md-2 review_source_new bwwCWBox reviewWidgetBox">
                            <label for="radiocheck1"  v-on:change="setWidgetType">
                                <div class="inner" :class="{ 'active': widget.widgetData.widget_type == 'bww'}" >
                                    <span class="custmo_checkbox checkboxs">
                                        <input :checked="widget.widgetData.widget_type == 'bww'" v-model="widget_type" value="bww"   id="radiocheck1" type="radio" name="widgetList" class="selectwidget" widget-id="bww">
                                        <span class="custmo_checkmark purple"></span>
                                    </span>
                                    <figure><img src="assets/images/review_source1_new.png"/></figure>
                                    <div class="text_sec">
                                        <p><strong>Small Popup</strong></p>
                                        <h5>Displays reviews in a fixed vertical popup positioned on the left or right side</h5>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-2 review_source_new bfwCWBox reviewWidgetBox">
                            <label for="radiocheck2" v-on:change="setWidgetType">
                                <div class="inner" :class="{ 'active': widget.widgetData.widget_type == 'bfw'}">
                            <span class="custmo_checkbox checkboxs">
                                <input  :checked="widget.widgetData.widget_type == 'bfw'" value="bfw" v-model="widget_type"  id="radiocheck2" type="radio" name="widgetList" class="selectwidget" widget-id="bfw">
                                <span class="custmo_checkmark purple"></span>
                            </span>
                                    <figure><img src="assets/images/review_source2_new.png"/></figure>
                                    <div class="text_sec">
                                        <p><strong>Horizontal Popup</strong></p>
                                        <h5>Displays 4 latest review in a bottom fixed scrollable reviews panel</h5>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-2 review_source_new cpwCWBox reviewWidgetBox">
                            <label for="radiocheck3" v-on:change="setWidgetType">
                                <div class="inner" :class="{ 'active': widget.widgetData.widget_type == 'cpw'}">
                            <span class="custmo_checkbox checkboxs">
                                <input :checked="widget.widgetData.widget_type == 'cpw'" value="cpw" v-model="widget_type" id="radiocheck3" type="radio" name="widgetList" class="selectwidget" widget-id="cpw">
                                <span class="custmo_checkmark purple"></span>
                            </span>

                                    <figure><img src="assets/images/review_source3_new.png"/></figure>
                                    <div class="text_sec">
                                        <p><strong>Center Popup</strong></p>
                                        <h5>Displays reviews in a lightbox slider with full focus on the details</h5>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-2 review_source_new vpwCWBox reviewWidgetBox">
                            <label for="radiocheck4" v-on:change="setWidgetType">
                                <div class="inner" :class="{ 'active': widget.widgetData.widget_type == 'vpw'}">
                            <span class="custmo_checkbox checkboxs">
                                <input :checked="widget.widgetData.widget_type == 'vpw'" value="vpw" v-model="widget_type" id="radiocheck4" type="radio" name="widgetList" class="selectwidget" widget-id="vpw">
                                <span class="custmo_checkmark purple"></span>
                            </span>

                                    <figure><img src="assets/images/review_source4_new.png"/></figure>
                                    <div class="text_sec">
                                        <p><strong>Vertical Popup</strong></p>
                                        <h5>Displays reviews in a scrollable feed component on page</h5>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-2 review_source_new rfwCWBox reviewWidgetBox">
                            <label for="radiocheck5" v-on:change="setWidgetType">
                                <div class="inner"  :class="{ 'active': widget.widgetData.widget_type == 'rfw'}">
                                <span class="custmo_checkbox checkboxs">
                                    <input :checked="widget.widgetData.widget_type == 'rfw'"  value="rfw" v-model="widget_type" id="radiocheck5" type="radio" name="widgetList" class="selectwidget" widget-id="rfw">
                                    <span class="custmo_checkmark purple"></span>
                                </span>
                                    <figure><img src="assets/images/review_source5_new.png"/></figure>
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
                widget:{
                    widgetData:{widget_type:''}
                },
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
                axios.get('/admin/brandboost/get-widget',{
                            params: {
                                widgetID: this.$route.params.id,

                            }
                        })
                    .then(response => {
                        // console.log(response.data);
                        this.widget = response.data;
                        this.loading =false;
                        this.widget_type=response.data.widgetData.widget_type
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
