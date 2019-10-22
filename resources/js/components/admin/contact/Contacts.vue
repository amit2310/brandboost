<template>

    <div>
        <!--******************
      Top Heading area
     **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">People Contact List</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 slidebox">Main Action <span><img
                            src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="content-area">
            <workflow-subscribers
                :show-archived="true"
                :subscribers-data="subscribers"
                :active-count="activeCount"
                :archive-count="archiveCount"
                :module-name = "moduleName"
                :module-unit-id ="moduleUnitID"
            ></workflow-subscribers>
        </div>


        <!--Smart Popup-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"><a class="cross_icon slidebox"><i
                    class=""><img src="assets/images/cross.svg"/></i></a>
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"><img src="assets/images/list-icon.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Create List </h3>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <form action="/action_page.php">
                                    <div class="form-group">
                                        <label for="fname">List name</label>
                                        <input type="text" class="form-control h56" id="fname"
                                               placeholder="Enter list name" name="fname">
                                    </div>


                                    <div class="form-group">
                                        <label for="phonenumber">Color</label>
                                        <div class="phonenumber">
                                            <div class="colorbox">
                                                <div class="colorpickerplus-dropdown" id="color_picker">
                                                    <button type="button" class="dropdown-toggle pickerbutton"
                                                            data-toggle="dropdown">
                                                        <span class="color-fill-icon dropdown-color-fill-icon"></span>
                                                        &nbsp; Pick a Color &nbsp; <b class="caret"></b></button>
                                                    <ul class="dropdown-menu">
                                                        <li class="disabled">
                                                            <div class="colorpickerplus-container"></div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc"
                                                  placeholder="List description"></textarea>
                                    </div>


                                </form>
                            </div>
                        </div>

                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">Create
                                </button>
                                <a class="blue_300 fsize16 fw600 ml20" href="#">Close</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <!--<div class="content">

        <div class="page_header">
            <div class="row">
                &lt;!&ndash;=============Headings & Tabs menu==============&ndash;&gt;
                <div class="col-md-3">
                    <h3><img src="/assets/images/people_sec_icon.png"> Contacts</h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Active Contacts</a></li>
                        <li><a href="#right-icon-tab1" data-toggle="tab">Archive</a></li>
                    </ul>
                </div>
                &lt;!&ndash;=============Button Area Right Side==============&ndash;&gt;
                <div class="col-md-9 text-right btn_area">
                    <button type="button" class="btn light_btn importModuleContact" :data-modulename="moduleName" :data-moduleaccountid="moduleUnitID" data-redirect="/admin/contacts/mycontacts"><i class="icon-arrow-up16"></i><span> &nbsp;  Import Contacts</span> </button>
                    <a class="btn light_btn ml10" :href="`/admin/subscriber/exportSubscriberCSV?module_name=${moduleName}&module_account_id=${moduleUnitID}`"><i class="icon-arrow-down16"></i><span> &nbsp;  Export Contacts</span> </a>
                    <button type="button" class="btn dark_btn dropdown-toggle ml10 addModuleContact" :data-modulename="moduleName" :data-moduleaccountid="moduleUnitID"><i class="icon-plus3"></i><span> &nbsp;  Add Contact</span> </button>
                    &nbsp;
                </div>
            </div>
        </div>
        &lt;!&ndash;&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&&ndash;&gt;


            <workflow-subscribers
                :show-archived="true"
                :subscribers-data="subscribers"
                :active-count="activeCount"
                :archive-count="archiveCount"
                :module-name = "moduleName"
                :module-unit-id ="moduleUnitID"
            ></workflow-subscribers>

    </div>-->
</template>
<script>
    import WorkflowSubscribers from '../workflow/WorkflowSubscribers.vue';

    export default {
        props: ['pageColor'],
        data() {
            return {
                moduleName: '',
                moduleUnitID: '',
                activeCount: 0,
                archiveCount: 0,
                subscribers: {},

            }
        },
        components: {'workflow-subscribers': WorkflowSubscribers},
        mounted() {
            this.$parent.pageColor = this.pageColor;
            axios.get('/admin/contacts/mycontacts')
                .then(response => {

                    this.moduleName = response.data.moduleName;
                    this.moduleUnitID = response.data.moduleUnitID;
                    this.subscribers = response.data.subscribersData;
                    this.activeCount = response.data.activeCount;
                    this.archiveCount = response.data.archiveCount;

                });
        }

    };

    $(document).ready(function () {
        $(".slidebox").click(function () {
            $(".box").animate({
                width: "toggle"
            });
        });
    });

    /*$(document).on('click', '#addContactForm', function () {
        $('.addModuleContact').trigger('click');
    });*/

</script>



