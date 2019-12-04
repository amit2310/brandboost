<template>
    <div>

        <div class="top-bar-top-section shadow2 bkg_light_000" style="padding-left: 310px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{setStringLimit(this.title, 15)}}</h3>
                    </div>
                    <div class="col-md-4">
                        <ul class="nav nav-pills top_tab mt-1" role="tablist">
                            <li class="mr40">
                                <a class="htxt_bold_14 active" data-toggle="pill" href="#Visual"><img src="/assets/images/git-merge-fill.svg" /> &nbsp; Visual Canvas</a>
                            </li>
                            <li class="">
                                <a class="htxt_bold_14" data-toggle="pill" href="#ListView"><img src="/assets/images/list-settings-line.svg" /> &nbsp; List View</a>
                            </li>
                        </ul>

                    </div>
                    <div class="col-md-5 col-5 text-right">
                        <button class="circle-icon-40 mr15 bkg_light_300 shadow_none"><img src="/assets/images/settings-3-fill.svg"/></button>
                        <button class="circle-icon-40 mr15 bkg_light_300 shadow_none"><img src="/assets/images/play-fill.svg"/></button>
                        <button class="circle-icon-40 mr15 bkg_light_300 shadow_none"><img src="/assets/images/checkbox-circle-fill.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 slidebox">Main Action <span><img src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area" :class="dynamo" style="padding-left: 310px;">
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
            <loading :isLoading="loading"></loading>

            <div class="workflowContainer">
                <div class="workflowTree" v-show="displayWorkflowTree">
                    <div class="tab-content" v-show="wfRendered">
                        <!--======Tab 1====-->
                        <div id="Visual" class="tab-pane active">
                            <div class="container-fluid">

                                <div class="row">
                                    <div class="col-md-6 mb20">
                                        <div class="link_button">
                                            <a href="#"><img src="/assets/images/arrow-right-line_grey.svg"/></a>
                                            <a href="#"><img src="/assets/images/arrow-left-line_grey.svg"/></a>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb20 text-right">
                                        <div class="link_button mr20">
                                            <a id="fullscreen" href="javascript:void(0);"><img src="/assets/images/share-box-fill.svg"/></a>
                                        </div>

                                        <div class="link_button" style="line-height: 35px;">
                                            <input type="text" name="" value="100" class="touchspin-step" />
                                        </div>
                                    </div>


                                </div>

                                <div class="row" @click="initiateDragger">
                                    <div class="col-md-12 mb-3">

                                        <div class="workflow_box" id="workflow_box" style="position:absolute;width:100%;">
                                            <div draggable="true" id="workflow_box_tree">
                                                <div class="row" >
                                                    <div class="col-md-12">
                                                        <div class="workflow_card" @click="displayContactInterface" style="cursor: pointer;">
                                                            <div class="wf_icons br8 bkg_blue_300"><img class="rotate-45" src="/assets/images/peopleLight.svg"/></div>
                                                            <p class="dark_200 htxt_medium_12 mb10 text-uppercase">Tag </p>
                                                            <p class="dark_800 htxt_bold_14 mb25">New Customer </p>
                                                            <div class="p15 btop">
                                                                <p class="dark_200 htxt_regular_12 text-uppercase m0">{{subscribersData.total}} Contacts </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-md-12"><img src="/assets/images/wfline.png"/></div>-->

                                                </div>




                                                <!--<div class="row">
                                                    <div class="col-md-6">
                                                        <div class="workflow_card">
                                                            <div class="wf_icons bkg_email_400"><img src="/assets/images/send-plane-fill-24.svg"/></div>
                                                            <p class="dark_200 htxt_medium_12 mb10 text-uppercase">Tag </p>
                                                            <p class="dark_800 htxt_bold_14 mb25">New Customer </p>
                                                            <div class="p15 pt10 btop">
                                                                <ul class="workflow_list">
                                                                    <li><a href="#"><span><img src="/assets/images/send-plane-line.svg"/></span> 3k</a></li>
                                                                    <li><a href="#"><span><img src="/assets/images/mail-open-line.svg"/></span> 28%</a></li>
                                                                    <li><a href="#"><span><img src="/assets/images/cursor-line.svg"/></span> 67%</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12"><img src="/assets/images/wfline_single.png"/></div>
                                                        <button class="btn btn-xs btn_white_table smallbtn rounded dropdown-toggle" style="border:1px solid #cccccc;"
                                                        >+
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="workflow_card">
                                                            <div class="wf_icons bkg_reviews_500"><img src="/assets/images/star-s-fill.png"/></div>
                                                            <p class="dark_200 htxt_medium_12 mb10 text-uppercase">Tag </p>
                                                            <p class="dark_800 htxt_bold_14 mb25">New Customer </p>
                                                            <div class="p15 pt10 btop">
                                                                <ul class="workflow_list">
                                                                    <li><a href="#"><span><img src="/assets/images/send-plane-line.svg"/></span> 3k</a></li>
                                                                    <li><a href="#"><span><img src="/assets/images/mail-open-line.svg"/></span> 28%</a></li>
                                                                    <li><a href="#"><span><img src="/assets/images/cursor-line.svg"/></span> 67%</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="workflow_card">
                                                            <div class="wf_icons bkg_email_400"><img src="/assets/images/send-plane-fill-24.svg"/></div>
                                                            <p class="dark_200 htxt_medium_12 mb10 text-uppercase">Tag </p>
                                                            <p class="dark_800 htxt_bold_14 mb25">New Customer </p>
                                                            <div class="p15 pt10 btop">
                                                                <ul class="workflow_list">
                                                                    <li><a href="#"><span><img src="/assets/images/send-plane-line.svg"/></span> 3k</a></li>
                                                                    <li><a href="#"><span><img src="/assets/images/mail-open-line.svg"/></span> 28%</a></li>
                                                                    <li><a href="#"><span><img src="/assets/images/cursor-line.svg"/></span> 67%</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="workflow_card">
                                                            <div class="wf_icons bkg_reviews_500"><img src="/assets/images/star-s-fill.png"/></div>
                                                            <p class="dark_200 htxt_medium_12 mb10 text-uppercase">Tag </p>
                                                            <p class="dark_800 htxt_bold_14 mb25">New Customer </p>
                                                            <div class="p15 pt10 btop">
                                                                <ul class="workflow_list">
                                                                    <li><a href="#"><span><img src="/assets/images/send-plane-line.svg"/></span> 3k</a></li>
                                                                    <li><a href="#"><span><img src="/assets/images/mail-open-line.svg"/></span> 28%</a></li>
                                                                    <li><a href="#"><span><img src="/assets/images/cursor-line.svg"/></span> 67%</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <div v-if="oEvents.length>0">
                                                    <div class="col-md-12"><img src="/assets/images/wfline_single.png" style="height:24px;"/></div>
                                                    <add-default-more-button :oEvent="oEvents[0]" :wfData="{}" eventType="main" @addAction="initActionPrimary"></add-default-more-button>
                                                </div>
                                                <div v-else>
                                                    <div class="col-md-12"><img src="/assets/images/wfline_single.png" style="height:24px;"/></div>
                                                    <add-default-more-button :oEvent="{}" :wfData="{}" eventType="main" @addAction="initActionPrimary"></add-default-more-button>
                                                </div>

                                                <workflow-node
                                                    v-for="oEvent in oEvents"
                                                    :oEvent="oEvent"
                                                    :wfData="wfData"
                                                    :key="oEvent.id"
                                                    @chooseTemplate="displayTemplateInterface"
                                                    @editNode="editNode"
                                                    @deleteNode="deleteNode"
                                                    @updateTimer="updateTimer"
                                                ></workflow-node>
                                                <!--<div v-if="oEvents.length==0">
                                                <div class="col-md-12"><img src="/assets/images/wfline_single.png"/></div>
                                                <add-default-more-button :oEvent="{}" :wfData="{}" @addAction="initActionPrimary"></add-default-more-button>
                                                </div>-->
                                            </div>
                                        </div>
                                    </div>

                                </div>




                            </div>

                        </div>
                        <!--======Tab 2=====-->
                        <div id="ListView" class="tab-pane fade">
                            2nd tab content goes here...
                        </div>
                    </div>
                    <!--******************
                   PAGE SIDEBAR
                   **********************-->
                    <div class="page_sidebar bkg_light_000 absl">
                        <div class="inner2 pb0">
                            <div class="title-box">
                                <h6 class="menu-title" style="line-height: 36px;"><span class="button-menu-mobile_sidebar"><img src="/assets/images/close_menu_circle.svg"></span> &nbsp; Open Menu</h6>
                            </div>
                            <h3 class="htxt_medium_20 dark_800" >Nodes </h3>
                            <hr />

                            <div class="sidebar_search_big">
                                <input type="text" name="" value="" placeholder="Search">
                                <button class="sidebar_search_submit"><img src="/assets/images/submit_grey.svg"></button>
                            </div>
                        </div>

                        <div class="sidebar_headings">
                            <span class="float-left">TRIGGERS</span>
                            <i class="float-right"><img src="/assets/images/arrow-down-s-line.svg"/></i>
                            <div class="clearfix"></div>
                        </div>


                        <div class="p20 pt0 pb0">
                            <ul class="list_with_icons">
                                <li>
                                    <div class="media_left">
                                        <span class="circle_32 img bkg_blue_400"><img src="/assets/images/user-3-fill.svg"/></span>
                                    </div>
                                    <div class="media_left">
                                        <p class="htxt_bold_14 dark_600">Contact</p>
                                        <p class="dark_300 fw300 fsize12">Eu maecenas nisl interdum.</p>
                                    </div>
                                </li>


                                <li>
                                    <div class="media_left">
                                        <span class="circle_32 img bkg_reviews_300"><img src="/assets/images/file-list-2-fill.svg"/></span>
                                    </div>
                                    <div class="media_left">
                                        <p class="htxt_bold_14 dark_600">Form</p>
                                        <p class="dark_300 fw300 fsize12">Tellus lectus platea.</p>
                                    </div>
                                </li>

                                <li>
                                    <div class="media_left">
                                        <span class="circle_32 img bkg_dark_300"><img src="/assets/images/time-fill.svg"/></span>
                                    </div>
                                    <div class="media_left">
                                        <p class="htxt_bold_14 dark_600">Timer</p>
                                        <p class="dark_300 fw300 fsize12">Arcu blandit duis phasellus.</p>
                                    </div>
                                </li>




                            </ul>
                            <div class="clearfix"></div>
                        </div>



                        <div class="sidebar_headings">
                            <span class="float-left">ACTIONS</span>
                            <i class="float-right"><img src="/assets/images/arrow-down-s-line.svg"/></i>
                            <div class="clearfix"></div>
                        </div>





                        <div class="p20 pt0 pb0">
                            <ul class="list_with_icons">
                                <li id="email" draggable="true" @dragstart="onDrag($event)">
                                    <div class="media_left">
                                        <span class="circle_32 img bkg_brand_300"><img src="/assets/images/send-plane-fill.svg"/></span>
                                    </div>
                                    <div class="media_left">
                                        <p class="htxt_bold_14 dark_600">Email</p>
                                        <p class="dark_300 fw300 fsize12">Semper aliquet viverra libero.</p>
                                    </div>
                                </li>


                                <li id="sms" draggable="true" @dragstart="onDrag($event)">
                                    <div class="media_left">
                                        <span class="circle_32 img bkg_sms_400"><img src="/assets/images/message-2-fill.svg"/></span>
                                    </div>
                                    <div class="media_left">
                                        <p class="htxt_bold_14 dark_600">SMS</p>
                                        <p class="dark_300 fw300 fsize12">Amet nec euismod.</p>
                                    </div>
                                </li>

                                <li id="review" draggable="true" @dragstart="onDrag($event)">
                                    <div class="media_left">
                                        <span class="circle_32 img bkg_reviews_400"><img src="/assets/images/star-s-fill.svg"/></span>
                                    </div>
                                    <div class="media_left">
                                        <p class="htxt_bold_14 dark_600">Review</p>
                                        <p class="dark_300 fw300 fsize12">Cras aenean vitae duis amet.</p>
                                    </div>
                                </li>

                                <li id="notification" draggable="true" @dragstart="onDrag($event)">
                                    <div class="media_left">
                                        <span class="circle_32 img bkg_red_400"><img src="/assets/images/notification-badge-fill.svg"/></span>
                                    </div>
                                    <div class="media_left">
                                        <p class="htxt_bold_14 dark_600">Notification</p>
                                        <p class="dark_300 fw300 fsize12">Mi vitae tortor, eget. </p>
                                    </div>
                                </li>




                            </ul>
                            <div class="clearfix"></div>
                        </div>





                        <div class="clearfix"></div>
                    </div>
                    <!--******************
                     END PAGE SIDEBAR
                     **********************-->
                </div>
                <div class="templateSection" v-if="nodeType == 'email' || nodeType == 'sms'">
                    <email-template-list v-if="nodeType == 'email'" @addWorkflowNode="addWorkflowNode"></email-template-list>
                    <sms-template-list v-if="nodeType == 'sms'" @addWorkflowNode="addWorkflowNode"></sms-template-list>
                    <div class="row">
                        <div  class="col-md-3"></div>
                        <div class="col-md-9">
                            <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96"
                                    @click="displayWorkflowTreeInterface"><span class="ml0 mr10"><img
                                src="/assets/images/arrow-left-line.svg"></span>Cancel
                            </button>
                        </div>
                    </div>

                </div>
                <div class="editTemplateSection" v-show="displayEditTemplateSection">
                    <div class="row">
                        <iframe id="loadGraptemplate" scrolling="no" :class="editorIframe" :src="grapEditorSrc" width="100%"
                                style="overflow:hidden; border:none!important;"></iframe>
                    </div>
                    <div class="row bottom-position">
                        <div class="col-md-12 mb15">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96"
                                    @click="displayWorkflowTreeInterface"><span class="ml0 mr10"><img
                                src="/assets/images/arrow-left-line.svg"></span>Back
                            </button>
                            <button type="submit"
                                    class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600"
                                    @click="displayWorkflowTreeInterface">Save & Close
                            </button>
                        </div>

                    </div>

                </div>
                <choose-workflow-subscribers
                    v-if="workflowData && displayContactSelectionInterface"
                    :moduleName="moduleName"
                    :moduleUnitId="moduleUnitID"
                    @displayTreeInterface="displayWorkflowTreeInterface"
                ></choose-workflow-subscribers>
                <modal-popup v-if="showModal" @close="showModal = false" width="sm">
                    <h3 slot="header">Delay Time</h3>
                    <div slot="body" class="pt0 pb0">
                        <div v-show="isUpdatedTimer" class="alert alert-success">Time updated successfully<i class="close" @click="isUpdatedTimer=false">x</i></div>
                        <div class="media_left p10">
                            <label class="control-label">Time</label>
                            <input type="number" name="delay_value" v-model="currentDelayValue" class="form-control h52" @change="clearUpdateTimer">
                        </div>
                        <div class="media_left p10">
                            <label class="control-label">&nbsp;</label>
                            <select name="delay_unit" v-model="currentDelayUnit" class="form-control h52" @change="clearUpdateTimer">
                                <option value="minute">Minute(s)</option>
                                <option value="hour">Hour(s)</option>
                                <option value="day">Day(s)</option>
                                <option value="week">Week(s)</option>
                                <option value="month">Month(s)</option>
                                <option value="year">Year(s)</option>

                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div slot="footer">
                        <button type="button" class="btn btn-md bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600" @click="confirmUpdateTimer">Save
                        </button>
                        <a href="javascript:void(0);" class="blue_300 fsize16 fw600 ml20" @click="showModal = false">Close</a>
                    </div>
                </modal-popup>
            </div>

        </div>
        <!--Content Area End-->

    </div>
</template>
<script>
    import modalPopup from "../../../components/helpers/Common/ModalPopup";
    import workflowNode from './workflowComponents/Node';
    import emailTemplateList from "../templates/TemplateComponents/EmailTemplateList";
    import smsTemplateList from "../templates/TemplateComponents/SmsTemplateList";
    import addDefaultMoreButton from './workflowComponents/addMoreButton';
    import ChooseWorkflowSubscribers from "./ChooseWorkflowSubscribers";
    export default {
        props: ['workflowData'],
        components: {ChooseWorkflowSubscribers,modalPopup, workflowNode, emailTemplateList, smsTemplateList, addDefaultMoreButton},
        data(){
          return {
              showModal: false,
              successMsg: '',
              errorMsg: '',
              loading: true,
              moduleName: '',
              moduleUnitID: '',
              moduleAccountID: '',
              title: '',
              oEvents: '',
              wfData: '',
              subscribersData: '',
              wfRendered: false,
              displayWorkflowTree: true,
              displayEditTemplateSection: false,
              dynamo: '',
              nodeType: '',
              eventType:'',
              currentId: '',
              previousId: '',
              currentTime: '',
              grapEditorSrc: '',
              editorIframe: '',
              currentDelayValue: '',
              currentDelayUnit: '',
              currentEventId: '',
              isUpdatedTimer: false,
              displayContactSelectionInterface: false

          }
        },
        mounted() {
            this.makeBreadcrumb(this.workflowData.breadcrumb);
            loadMasterWorkflowScripts();
            loadDraggerScript();

        },
        watch: {
            workflowData: function(){
                this.makeBreadcrumb(this.workflowData.breadcrumb);
                this.wfData = this.workflowData;
                this.title = this.workflowData.oAutomations[0].title;
                this.moduleName = this.workflowData.moduleName;
                this.moduleUnitID = this.workflowData.moduleUnitID;
                this.oEvents = this.workflowData.oEvents;
                this.getWorkflowSubscribers();
                let elem = this;
                setTimeout(function(){
                    elem.wfRendered= true;
                    elem.loading = false;
                }, 1000);

            }
        },
        methods: {
            displayContactInterface: function(){
                this.displayContactSelectionInterface = true;
                this.displayWorkflowTree = false;
                this.dynamo='workflowTemplateArea';
                this.nodeType = '',
                this.displayEditTemplateSection = false;
            },
            getWorkflowSubscribers: function(){
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/workflowSubscribers', {moduleName: this.moduleName, moduleUnitID:this.moduleUnitID})
                    .then(response => {
                        this.subscribersData = response.data.subscribersData;
                    });

            },

            displayTemplateInterface: function(nodeType, currentId, previousId, eventType){
                this.nodeType = nodeType; //'email' // 'sms';
                this.eventType= eventType;
                this.currentId = currentId;
                this.previousId = previousId;
                this.displayWorkflowTree = false;
                this.dynamo='workflowTemplateArea';
                //alert('currentID='+ currentId + ' previousID='+previousId);
            },
            displayEditTemplateInterface: function(){
                this.displayWorkflowTree = false;
                this.dynamo='workflowTemplateArea';
                this.nodeType = '',
                this.displayContactSelectionInterface = false;
                this.displayEditTemplateSection = true;
            },
            displayWorkflowTreeInterface: function(){
                this.nodeType = '';
                this.displayWorkflowTree = true;
                this.dynamo='';
                this.displayEditTemplateSection = false;
                this.displayContactSelectionInterface = false;
            },
            addWorkflowNode: function(templateId, mode){
                //Write all your code for adding node finally here
                let delayVal = '10';
                let delayUnit = 'minute';
                axios.post('/admin/workflow/addWorkflowNode', {
                    _token: this.csrf_token(),
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitID,
                    previous_event_id: this.previousId,
                    emailTemplateId: templateId,
                    smsTemplateId: '',
                    source: '',
                    delayVal: delayVal,
                    delayUnit: delayUnit,
                    current_event_id: this.currentId,
                    event_type: this.eventType,// (this.previousId == '' || this.previousId == null) ? 'main' : 'followup',
                    node_type: this.eventType //(this.previousId == '' || this.previousId == null) ? 'main' : 'followup',
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            if(mode == 'edit'){
                                //Open Template Editor
                                this.$emit('realoadTree');
                                if(this.nodeType == 'email'){
                                    this.grapEditorSrc= '/admin/workflow/loadStripoCampaign/' + this.moduleName + '/' + response.data.campaign_id + '/' + this.moduleUnitID;
                                    this.editorIframe = 'emailEditorIframe';
                                }

                                if(this.nodeType == 'sms'){
                                    this.grapEditorSrc= '/admin/workflow/loadStripoSMSCampaign/' + this.moduleName + '/' + response.data.campaign_id + '/' + this.moduleUnitID;
                                    this.editorIframe = 'smsEditorIframe';
                                }

                                let elem = this;
                                setTimeout(function(){
                                    elem.displayEditTemplateInterface();
                                }, 1500);



                            }else{
                                this.processReloadTree();
                            }


                            //Reaload the Workflow grid behind the scene
                        }
                    });

                //Once successfull hide all interface and Display Edit Template interface or editor and in the background relaod the tree

                //If mode = edit then display edit template section  otherwise bypass this step
            },
            initActionPrimary: function(action, currentId, previousId, eventType){
                this.displayTemplateInterface(action, currentId, previousId, eventType);
            },
            processReloadTree: function(){
                let elem = this;
                this.$emit('realoadTree');
                setTimeout(function(){
                    elem.displayWorkflowTreeInterface();
                }, 500)
            },
            processReloadTreeEditTemplate: function(){
                let elem = this;
                this.$emit('realoadTree');
                setTimeout(function(){
                    elem.displayWorkflowTreeInterface();
                }, 500)
            },
            editNode: function(campaignId, campaignType){
                if(campaignType == 'email'){
                    this.grapEditorSrc= '/admin/workflow/loadStripoCampaign/' + this.moduleName + '/' + campaignId + '/' + this.moduleUnitID;
                    this.editorIframe = 'emailEditorIframe';
                }

                if(campaignType == 'sms'){
                    this.grapEditorSrc= '/admin/workflow/loadStripoSMSCampaign/' + this.moduleName + '/' + campaignId + '/' + this.moduleUnitID;
                    this.editorIframe = 'smsEditorIframe';
                }

                this.loading = true;
                let elem = this;
                setTimeout(function(){
                    elem.displayEditTemplateInterface();
                    elem.loading = false;
                }, 1500);
            },
            deleteNode: function(eventId){
                if(confirm('Are you sure you want to delete this action from the workflow grid?')){
                    this.loading = true;
                    axios.post('/admin/workflow/deleteWorkflowEvent', {_token:this.csrf_token(), moduleName: this.moduleName, event_id:eventId})
                        .then(response => {
                            if(response.data.status == 'success'){
                                 this.processReloadTree();
                            }
                        });

                }
            },
            onDrag: function(ev){
                ev.dataTransfer.setData("nodetype", ev.target.id);
                let elems = document.querySelectorAll(".droppable_grid");
                elems.forEach(function(elem){
                    elem.classList.add('droppable_highlight');
                })
            },
            initiateDragger: function(){
                //dragElement(document.getElementById("workflow_box"));
            },
            updateTimer: function(currentEvent){
                this.isUpdatedTimer = false;
                let detalyData = JSON.parse(currentEvent.data);
                let delayValue = (detalyData.delay_value == '' || detalyData.delay_value == undefined) ? '10' : detalyData.delay_value;
                let delayUnit = (detalyData.delay_unit == '' || detalyData.delay_unit == undefined) ? 'minute' : detalyData.delay_unit;
                this.currentDelayValue = delayValue;
                this.currentDelayUnit = delayUnit;
                this.currentEventId = currentEvent.id;
                this.showModal = true;
            },
            confirmUpdateTimer: function(){
                axios.post('/admin/workflow/updateEventTime', {
                    _token:this.csrf_token(),
                    moduleName: this.moduleName,
                    event_id:this.currentEventId,
                    delay_value: this.currentDelayValue,
                    delay_unit: this.currentDelayUnit,
                    event_type: 'sent'
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            document.querySelector("#wf_event_"+this.currentEventId).innerHTML=this.currentDelayValue + ' ' + this.currentDelayUnit;
                            this.isUpdatedTimer = true;
                            this.processReloadTree();
                        }
                    });
            },
            clearUpdateTimer: function(){
                this.isUpdatedTimer = false;
            }

        },


    };

    $(document).on('dragend', function(){
        let elems = document.querySelectorAll(".droppable_grid");
        elems.forEach(function(elem){
            elem.classList.remove('droppable_highlight');
        })
    });

    function loadDraggerScript(){
        setTimeout(function(){
            dragElement(document.getElementById("workflow_box"));

        }, 2000);

        function dragElement(elmnt) {
            var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
            if (document.getElementById(elmnt.id + "_tree")) {
                /* if present, the header is where you move the DIV from:*/
                //alert('found');
                document.getElementById(elmnt.id + "_tree").onmousedown = dragMouseDown;
            } else {
                //alert('not found');
                /* otherwise, move the DIV from anywhere inside the DIV:*/
                elmnt.onmousedown = dragMouseDown;
            }

            function dragMouseDown(e) {
                e = e || window.event;
                e.preventDefault();
                // get the mouse cursor position at startup:
                pos3 = e.clientX;
                pos4 = e.clientY-357;
                //alert(pos3 + ' ' + pos4);
                console.log(pos3 + ' ' + pos4);
                document.onmouseup = closeDragElement;
                // call a function whenever the cursor moves:
                document.onmousemove = elementDrag;
            }

            function elementDrag(e) {
                e = e || window.event;
                e.preventDefault();
                // calculate the new cursor position:
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                // set the element's new position:
                //elmnt.style.top = (pos4-300) + "px";
                elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
                //console.log(elmnt.offsetLeft + ' ' + elmnt.offsetTop);
            }

            function closeDragElement() {
                /* stop moving when mouse button is released:*/
                document.onmouseup = null;
                document.onmousemove = null;
            }
        }

    }



    function zoom_page(step) {

        var zoomscale = $(".touchspin-step").val();
        $('.workflow_box').css('-moz-transform', 'scale(' + zoomscale / 10 + ',' + zoomscale / 10 + ')');
        $('.workflow_box').css('zoom', zoomscale / 10);
        $('.workflow_box').css('zoom', zoomscale + '%');

    }

    function loadMasterWorkflowScripts(){

        $("#fullscreen").click(function(){
            $(".content-area").toggleClass("fullscreen");
        });
        $(".touchspin-step").TouchSpin({
            step: 10,
            min: 1,
            max: 500
        });
        $(".bootstrap-touchspin-up, .bootstrap-touchspin-down").click(function () {
            zoom_page();
        });

        $(".touchspin-step").change(function(){
            zoom_page();
        });

    }
</script>
<style>
    .workflowTemplateArea {
        padding: 32px 64px !important;
    }
    .emailEditorIframe{
        height: 1500px;
    }

    .smsEditorIframe{
        height: 900px;
    }
    .droppable_highlight{
        border:1px solid #cccccc !important;
        height: 70px !important;
        background: #ffff00 !important;
        border-style: dashed !important;
    }
    .droppable_grid{
        cursor: pointer;
    }
</style>





