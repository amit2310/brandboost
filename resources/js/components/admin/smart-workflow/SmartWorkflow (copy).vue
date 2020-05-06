<template>
    <div class="reviews_workflows">
        <!--******************
          Top Heading area
        **********************-->
        <div class="top-bar-top-section bbot shadow4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 wf_nodes_top_icon">
                        <ul class="wf_nodes">
                            <li><a class="circle-icon-28 bkg_blue_300" href="javascript:void(0);"><img src="assets/images/flashlight-fill-white.svg"/> </a></li>
                            <li><a class="circle-icon-28 bkg_brand_300" href="javascript:void(0);"><img src="assets/images/time-fill-14.svg"/> </a></li>
                            <li><a class="circle-icon-28 bkg_sms_400" href="javascript:void(0);"><img src="assets/images/checkbox-circle-fill-white.svg"/> </a></li>
                            <li><a class="circle-icon-28 bkg_yellow_500" href="javascript:void(0);"><img src="assets/images/mail-open-fill-white.svg"/> </a></li>
                            <li><a class="circle-icon-28 bkg_email_300" href="javascript:void(0);"><img src="assets/images/split-white.svg"/> </a></li>
                            <li><a class="circle-icon-28 bkg_dark_100" href="javascript:void(0);"><img src="assets/images/flag-2-fill.svg"/> </a></li>
                        </ul>
                    </div>
                    <div class="col-md-5">
                        <div class="table_head_action mb0 mt-1">
                            <ul class="table_filter">
                                <li><a class="active" href="javascript:void(0);">Actions</a></li>
                                <li><a href="javascript:void(0);">Settings</a></li>
                                <li><a href="javascript:void(0);">Analytics</a></li>
                                <li><a href="javascript:void(0);">History</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-3 text-right">
                        <!--<button class="circle-icon-40 mr15"><img src="assets/images/download-fill.svg"></button>-->
                        <button class="btn btn-md bkg_reviews_400 light_000 float-right">Save</button>
                        <div class="float-right mr-3">
                            <p class="fsize14 dark_600 m-0 float-left mr-3" style="line-height:33px;">Active </p>
                            <label class="custom-form-switch mt-2">
                                <input class="field" type="checkbox" checked="">
                                <span class="toggle green3"></span>		</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--******************
         Content Area
        **********************-->

        <loading :isLoading="loading"></loading>
        <div class="content-area pt20">
            <div class="container-fluid" v-show="pageRendered == true">
                <!--******************
                 PAGE LEFT SIDEBAR
                **********************-->
                <a class="close_sidebar" href="javascript:void(0);">&nbsp; <img src="assets/images/menu-2-line.svg"></a>
                <div class="page_sidebar bkg_light_000 fixed">
                    <div style="width: 279px;">
                        <div class="p20 bbot top_headings bkg_light_000">
                            <div class="row">
                                <div class="col"><p>WORKFLOW</p></div>
                            </div>
                        </div>

                        <div class="p20 bkg_light_000 shadow4 min_h_65">
                            <div class="row">
                                <div class="col"><p class="fsize12 fw500 dark_200 text-uppercase m-0">Nodes</p></div>
                                <div class="col text-right"><p class="fsize14 fw400 dark_300 m-0"><img width="16" src="assets/images/list_check2.svg"/> &nbsp; Flow View</p></div>
                            </div>
                        </div>

                        <div class="p30 workflow_list_box">
                            <ul class="workflow_list_new">
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 br35 bkg_dark_100 "><i class="ri-play-fill"></i></span> Start</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_blue_400"><i class="ri-price-tag-3-fill"></i></span> Triger: People Tag</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_email_400"><i class="ri-mail-open-fill"></i></span> Email: Sale campaign #1</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_email_400"><i class="ri-mail-open-fill"></i></span> Email: Thank you campaign...</a></li>
                                <li class="buttons text-center">
                                    <div class="workflow_switch_div_small" style="z-index:9">
                                        <a class="workflow_switch" href="javascript:void(0);"><i class="ri-git-merge-fill"></i> SPLIT </a>
                                        <a class="workflow_switch active" href="javascript:void(0);">50/50</a>
                                    </div>
                                </li>


                                <li><a href="javascript:void(0);"><span class="circle-icon-20 br35 bkg_dark_100">A</span> Variant A</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_sms_400"><i class="ri-message-3-line"></i></span> SMS: Greeting</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_blue_400"><i class="ri-message-3-line"></i></span> Request: SMS Request</a></li>


                                <li><hr></li>

                                <li><a href="javascript:void(0);"><span class="circle-icon-20 br35 bkg_dark_100">B</span> Variant B</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_email_400"><i class="ri-mail-open-fill"></i></span> Email: Greeting</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_reviews_400"><i class="ri-mail-open-fill"></i></span> Request: Email Request</a></li>

                                <li class="buttons text-center">
                                    <div class="workflow_switch_div_small" style="z-index:9">
                                        <a class="workflow_switch" href="javascript:void(0);"><i class="ri-add-line"></i> MERGE </a>
                                    </div>
                                </li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_blue_400"><i class="ri-price-tag-3-fill"></i></span> Tag: Review</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 bkg_blue_400"><i class="ri-folder-fill"></i></span> List: Customers</a></li>
                                <li><a href="javascript:void(0);"><span class="circle-icon-20 br35 bkg_dark_100"><i class="ri-check-fill"></i></span> End</a></li>

                            </ul>
                        </div>






                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--******************
                 PAGE LEFT SIDEBAR END
                **********************-->

                <div class="row mb20">
                    <div class="col"><button class="circle-icon-32 bkg_reviews_400 mr15 shadow4 float-left slideActionbox"><img src="assets/images/plus_white_10.svg"></button>
                        <div class="workflow_switch_div float-left" v-if="viewType=='canvas'">
                            <a class="workflow_switch"
                               href="javascript:void(0);"
                               @mousedown="shiftLeft"
                               @mouseup="stopShift"
                               @click="moveLeft"><i class="ri-arrow-left-line"></i></a>
                            <a class="workflow_switch"
                               href="javascript:void(0);"
                               @mousedown="shiftRight"
                               @mouseup="stopShift"
                               @click="moveRight"
                            ><i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="workflow_switch_div float-right">
                            <a class="workflow_switch" :class="{'active': viewType == 'list'}" href="javascript:void(0);" @click="viewType='list'"><i class="ri-list-check-2"></i> List view</a>
                            <a class="workflow_switch" :class="{'active': viewType == 'canvas'}" href="javascript:void(0);" @click="viewType='canvas'"><i class="ri-drag-move-line"></i> Canvas</a>
                        </div>
                    </div>
                </div>

                <!--List View-->
                <list-view v-show="viewType=='list'"></list-view>

                <!--Canvas View-->
                <canvas-view v-show="viewType=='canvas'"></canvas-view>

                <!--Action Modal-->
                <div class="box actionBoxContent" style="width: 424px; display:none;">
                    <div style="width: 424px;overflow: hidden; height: 100%;">
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideActionbox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img src="assets/images/addnote44.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">Add Node </h3>
                                        <hr class="mt30 mb30">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10">
                                            <span class="circle-icon-44 bkg_blue_300 m-auto br12 "><i class="ri-flashlight-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Action</p>
                                            <p class="fw400 fsize12 dark_300 m0">Perform an action, such as add tag or send single email</p>
                                        </div>
                                    </div>
                                    <div class="col-6 pl5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10">
                                            <span class="circle-icon-44 bkg_yellow_500 m-auto br12 "><i class="ri-mail-open-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Decision</p>
                                            <p class="fw400 fsize12 dark_300 m0">Send people down a single path based on selected criteria.</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10">
                                            <span class="circle-icon-44 bkg_reviews_300 m-auto  "><i class="ri-time-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Delay</p>
                                            <p class="fw400 fsize12 dark_300 m0">Wait for a given period of time before continue down the path</p>
                                        </div>
                                    </div>
                                    <div class="col-6 pl5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10">
                                            <span class="circle-icon-44 bkg_email_300 m-auto br12 "><img src="assets/images/split.svg"/></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Split Test</p>
                                            <p class="fw400 fsize12 dark_300 m0">Split trafic to determine which is the most effective</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-6 pr5 text-center d-flex">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 col">
                                            <span class="circle-icon-44 bkg_sms_400 m-auto "><i class="ri-checkbox-circle-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Goal</p>
                                            <p class="fw400 fsize12 dark_300 m0">Define a goal that will pull people to this point when achived</p>
                                        </div>
                                    </div>
                                    <div class="col-6 pl5 text-center d-flex">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 col">
                                            <span class="circle-icon-44 bkg_dark_100 m-auto "><i class="ri-flag-2-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Exit</p>
                                            <p class="fw400 fsize12 dark_300 m0">Exit the path<br> the person <br> is currently on.</p>
                                        </div>
                                    </div>
                                </div>





                            </div>
                        </div>
                    </div>
                </div>

                <!--Trigger Modal-->
                <div class="box triggerBoxContent" style="width: 424px; display:none;">
                    <div style="width: 424px;overflow: hidden; height: 100%;">
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideTriggerbox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img width="44" src="assets/images/trigger_grey_45.png"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">Edit Trigger </h3>
                                        <p class="fsize14 dark_200 mb0 mt-1">Which event should trigger this automation?</p>
                                        <hr class="mt25 mb30">
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="triggerControl" class="fsize11 fw500 dark_600 ls4">SELECT TRIGGER</label>

                                            <select class="form-control h50 form-control-custom dark_800" id="triggerControl">
                                                <option>Submitted a form</option>
                                                <option>Submitted a form</option>
                                                <option>Choose a trigger...</option>
                                                <option>Choose a trigger...</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="formControl" class="fsize11 fw500 dark_600 ls4">SELECT FORM</label>

                                            <select class="form-control h50 form-control-custom dark_800" id="formControl">
                                                <option>Lead Generation Homepage Form </option>
                                                <option>Submitted a form</option>
                                                <option>Choose a trigger...</option>
                                                <option>Choose a trigger...</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>


                                <div class="row bottom-position">
                                    <div class="col-md-12 mb15">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-md bkg_blue_400 light_000 pr20 min_w_160 fsize13 fw500 mr20">Update Trigger</button>
                                        <button class="btn btn-md bkg_light_000 dark_200 pr20 fsize13 fw500 border">Close</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>







                </div>
        </div>
    </div>
    </div>
</template>

<script>
    var shiftInterval;
    import ListView from '@/components/admin/smart-workflow/ListView';
    import CanvasView from '@/components/admin/smart-workflow/CanvasView';
    export default {
        components: {ListView, CanvasView},
        props: ['moduleName', 'moduleUnitId'],
        data(){
            return {
                loading: false,
                pageRendered: false,
                successMsg : '',

                viewType: 'list',
                title: '',
                events: {},
            }
        },
        created(){
            this.loading = true;
            axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getWorkflowData', { moduleName: this.moduleName, moduleUnitId: this.moduleUnitId})
                .then(response => {
                    this.title = response.data.title;
                    this.events = response.data.oEvents;
                    this.loading = false;
                    this.pageRendered = true;
                    //console.log(this.campaigns)
                });
        },
        methods: {
            stopShift(){
                clearInterval(shiftInterval);
            },
            shiftLeft: function(){
                let elem = this;
                if(shiftInterval){
                    clearInterval(shiftInterval);
                }
                shiftInterval = setInterval(function(){
                    elem.moveLeft();
                }, 200);

            },
            shiftRight: function(){
                let elem = this;
                if(shiftInterval){
                    clearInterval(shiftInterval);
                }
                shiftInterval = setInterval(function(){
                    elem.moveRight();
                }, 200);

            },
            moveLeft: function(){
                let leftOffset = document.querySelector("#canvasDragger").style.left.replace('%', '').replace('px','');
                document.querySelector("#canvasDragger").style.left = (Number(leftOffset)-1) + '%';
            },
            moveRight: function(){
                let leftOffset = document.querySelector("#canvasDragger").style.left.replace('%', '').replace('px','');
                document.querySelector("#canvasDragger").style.left = (Number(leftOffset)+1) + '%';
            }

        }
    }
    $(document).ready(function(){
        $(".slideActionbox").click(function(){
            $(".actionBoxContent").animate({
                width: "toggle"
            });
        });

        $(".slideTriggerbox").click(function(){
            $(".triggerBoxContent").animate({
                width: "toggle"
            });
        });
    });
</script>




