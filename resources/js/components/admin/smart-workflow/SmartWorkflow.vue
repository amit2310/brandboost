<template>
    <div class="reviews_workflows" :class="{'canvas_view': viewType=='canvas'}" style="width:100%;position:relative;min-height:calc(100vh - 0px);">
        <!--******************
          Top Heading area
        **********************-->
        <button id="displayOverviewPreviewForm" type="button" style="display:none;">Display Edit & Preview Email</button>
        <button id="hideOverviewPreviewForm" type="button" style="display:none;">Hide</button>
        <button id="displaySMSPreviewForm" type="button" style="display:none;">Display Edit & Preview SMS</button>
        <button id="hideSMSPreviewForm" type="button" style="display:none;">Hide</button>
        <div v-show="configureWorkflow == true" id="wf_top_bar" class="top-bar-top-section bbot shadow4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 wf_nodes_top_icon">
                        <ul class="wf_nodes">
                            <li><img id="action" draggable="true" @dragstart="onDrag($event)" src="assets/images/wf_drag_icon1.svg"/></li>
                            <li><img id="delay" draggable="true" @dragstart="onDrag($event)" src="assets/images/wf_drag_icon2.svg"/></li>
                            <li><img id="goal" draggable="true" @dragstart="onDrag($event)" src="assets/images/wf_drag_icon3.svg"/></li>
                            <li><img id="decision" draggable="true" @dragstart="onDrag($event)" src="assets/images/decision_28_circle.svg"/></li>
                            <li><img id="split" draggable="true" @dragstart="onDrag($event)" src="assets/images/wf_drag_icon5.svg"/></li>
                            <li><img id="exit" draggable="true" @dragstart="onDrag($event)" src="assets/images/wf_drag_icon6.svg"/></li>
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
                                <li><a href="javascript:void(0);" class="slideTriggerbox" @click="metaData.selectedClass='trigger'"><span class="circle-icon-20 bkg_dark_100 rotate_45 "><span class="rotate_45_minus d-block"><i class="ri-play-fill"></i></span></span> Entry Trigger: {{(unitInfo.workflow_entry_trigger) ? capitalizeFirstLetter(unitInfo.workflow_entry_trigger): 'Empty'}}</a></li>
                                <li v-for="evt in events" @click="editNode(evt)">
                                    <div
                                        class="col-12 text-center droppable_grid droppable_grid_linear"
                                        @drop="onDrop($event, evt)"
                                        @dragover="$event.preventDefault()">
                                    </div>
                                    <a id="jsMoveNode" href="javascript:void(0);" draggable="true" @dragstart="onLinearDrag($event, evt)">
                                        <span class="circle-icon-20" :class="nodeClass(evt)" v-html="nodeIcon(evt)"></span>  {{capitalizeFirstLetter(nodeType(evt))}}: {{nodeTitle(evt)?setStringLimit(nodeTitle(evt), 13): setStringLimit(nodeName(evt), 13)}}
                                    </a>
                                    <template v-if="nodeType(evt)=='decision'">
                                        <hr class="mt10">

                                        <ul class="workflow_list_new">
                                            <li><a href="#"><span class="circle-icon-20 bkg_light_000 br35 dark_100 shadow3">a</span> </a></li>
                                            <li><a href="#"><span class="circle-icon-20 bkg_blue_300"><i class="ri-folder-fill"></i></span> Action: Subscribe on List</a></li>
                                        </ul>

                                        <hr>
                                        <ul class="workflow_list_new">
                                            <li><a href="#"><span class="circle-icon-20 bkg_light_000 br35 dark_100 shadow3">b</span> </a></li>
                                            <li><a href="#"><span class="circle-icon-20 bkg_blue_300"><i class="ri-folder-fill"></i></span> Action: Subscribe on List</a></li>
                                        </ul>

                                        <hr>


                                    </template>
                                    <template v-if="nodeType(evt)=='split'">
                                        <hr class="mt10">

                                        <ul class="workflow_list_new">
                                            <li><a href="#"><span class="circle-icon-20 bkg_light_000 br35 dark_100 shadow3">a</span> </a></li>
                                            <li><a href="#"><span class="circle-icon-20 bkg_blue_300"><i class="ri-folder-fill"></i></span> Action: Subscribe on List</a></li>
                                        </ul>

                                        <hr>
                                        <ul class="workflow_list_new">
                                            <li><a href="#"><span class="circle-icon-20 bkg_light_000 br35 dark_100 shadow3">b</span> </a></li>
                                            <li><a href="#"><span class="circle-icon-20 bkg_blue_300"><i class="ri-folder-fill"></i></span> Action: Subscribe on List</a></li>
                                        </ul>

                                        <hr>


                                    </template>
                                </li>
                                <div
                                    class="col-12 text-center droppable_grid droppable_grid_linear"
                                    @drop="onDrop($event)"
                                    @dragover="$event.preventDefault()"
                                    >
                                </div>
                                <li><a href="javascript:void(0);" class="slideGoalbox" @click="metaData.selectedClass='goal'"><span class="circle-icon-20 bkg_dark_100 rotate_45 "><span class="rotate_45_minus d-block"><i class="ri-check-line"></i></span></span> Goal: {{(unitInfo.workflow_goal) ? capitalizeFirstLetter(unitInfo.workflow_goal): 'Empty'}}</a></li>
                            </ul>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--******************
                 PAGE LEFT SIDEBAR END
                **********************-->
                <div v-show="configureWorkflow == true">
                    <div id="wf_top_btn_area" class="">
                        <div class="row mb20">
                            <div class="col"><button class="circle-icon-32 bkg_reviews_400 mr15 shadow4 float-left slideAddNodebox"><img src="assets/images/plus_white_10.svg"></button>
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
                    </div>

                    <!--List View-->
                    <list-view
                        v-show="viewType=='list'"
                        :events="events"
                        :unitInfo="unitInfo"
                        :metaData="metaData"
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        @setActionProps="setActionProps"
                        @deleteWorkflowNode="deleteWorkflowNode"
                        @editWorkflowNode="editWorkflowNode"
                        @addBlankAction="addBlankAction"
                        @addBlankDecision="addBlankDecision"
                        @addDelay="addDelay"
                    ></list-view>

                    <!--Canvas View-->
                    <canvas-view
                        v-show="viewType=='canvas'"
                        :events="events"
                        :unitInfo="unitInfo"
                        :metaData="metaData"
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        @setActionProps="setActionProps"
                        @deleteWorkflowNode="deleteWorkflowNode"
                        @editWorkflowNode="editWorkflowNode"
                        @addBlankAction="addBlankAction"
                        @addBlankDecision="addBlankDecision"
                        @addDelay="addDelay"
                    ></canvas-view>

                </div>

                <email-templates
                    v-if="showEmailTemplates"
                    :categories="templateCategories"
                    :templates="emailTemplates"
                    :templatesAllData="allDataTemplates"
                    :user="user"
                    :event_id=actionEditId
                    :moduleName="moduleName"
                    :moduleUnitId="moduleUnitId"
                    :isDecisionNode="isDecisionNode"
                    :isSplitNode="isSplitNode"
                    @loadCategoriedTemplates="loadCategoriedTemplates"
                    @hideEmailTemplate="closeEmailTemplates"
                    @updateEmailCampaignId="setEmailCampaignId"
                    @deleteWorkflowEvent="deleteWorkflowNode"
                ></email-templates>
                <sms-templates
                    v-if="showSMSTemplates"
                    :categories="templateCategories"
                    :templates="smsTemplates"
                    :templatesAllData="allDataTemplates"
                    :user="user"
                    :event_id=actionEditId
                    :moduleName="moduleName"
                    :moduleUnitId="moduleUnitId"
                    :isDecisionNode="isDecisionNode"
                    :isSplitNode="isSplitNode"
                    @loadCategoriedTemplates="loadCategoriedTemplates"
                    @hideSMSTemplate="closeSMSTemplates"
                    @updateSMSCampaignId="setSMSCampaignId"
                    @deleteWorkflowEvent="deleteWorkflowNode"
                ></sms-templates>

                <!--Add Node Modal-->
                <div class="box addNodeBoxContent" style="width: 424px; display:none;">
                    <div style="width: 424px;overflow: hidden; height: 100%;">
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideAddNodebox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img src="assets/images/addnote44.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">Add Node </h3>
                                        <hr class="mt30 mb30">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 slideAddNodebox slideAddActionbox" style="cursor: pointer;">
                                            <span class="circle-icon-44 bkg_blue_300 m-auto br12 "><i class="ri-flashlight-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Action</p>
                                            <p class="fw400 fsize12 dark_300 m0">Perform an action, such as add tag or send single email</p>
                                        </div>
                                    </div>
                                    <div class="col-6 pl5 text-center">
                                        <div
                                            class="card border shadow-none p20 pl10 pr10 mb10"
                                            :class="isDecisionNode==true ? '': 'slideAddNodebox slideAddDecisionbox'"
                                            :style="isDecisionNode==true ? 'cursor:not-allowed;': 'cursor:pointer;'"
                                            >
                                            <span class="circle-icon-44 bkg_yellow_500 m-auto br12 "><i class="ri-mail-open-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Decision</p>
                                            <p class="fw400 fsize12 dark_300 m0">Send people down a single path based on selected criteria.</p>
                                        </div>
                                    </div>

                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 slideAddNodebox slideAddDelaybox" style="cursor: pointer;">
                                            <span class="circle-icon-44 bkg_reviews_300 m-auto  "><i class="ri-time-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Delay</p>
                                            <p class="fw400 fsize12 dark_300 m0">Wait for a given period of time before continue down the path</p>
                                        </div>
                                    </div>
                                    <div class="col-6 pl5 text-center">
                                        <div
                                            class="card border shadow-none p20 pl10 pr10 mb10"
                                            :class="isDecisionNode==true ? '': 'slideAddNodebox slideAddSplitbox'"
                                            :style="isDecisionNode==true ? 'cursor:not-allowed;': 'cursor:pointer;'"
                                        >
                                            <span class="circle-icon-44 bkg_email_300 m-auto br12 "><img src="assets/images/split.svg"/></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Split Test</p>
                                            <p class="fw400 fsize12 dark_300 m0">Split trafic to determine which is the most effective</p>
                                        </div>
                                    </div>

                                    <div class="col-6 pr5 text-center d-flex">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 col" style="cursor: pointer;">
                                            <span class="circle-icon-44 bkg_sms_400 m-auto "><i class="ri-checkbox-circle-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-2 mb-1">Goal</p>
                                            <p class="fw400 fsize12 dark_300 m0">Define a goal that will pull people to this point when achived</p>
                                        </div>
                                    </div>
                                    <div class="col-6 pl5 text-center d-flex">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 col" style="cursor: pointer;">
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
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideTriggerbox"><i class=""><img alt="close" src="assets/images/cross.svg"/></i></a>
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

                                            <select class="form-control h50 form-control-custom dark_800" id="triggerControl" @change="searchBy=''" v-model="unitInfo.workflow_entry_trigger">
                                                <option value="">Choose a trigger...</option>
                                                <option value="contact">Added Contact</option>
                                                <option value="tags">Applied Tag</option>
                                                <option value="lists">Added to List</option>
                                                <option value="segment">Added to Segment</option>
                                                <option value="form">Submitted a form</option>
                                            </select>
                                        </div>

                                        <div class="form-group" v-if="unitInfo.workflow_entry_trigger=='form'">
                                            <label for="formControl" class="fsize11 fw500 dark_600 ls4">SELECT FORM</label>

                                            <select class="form-control h50 form-control-custom dark_800" id="formControl">
                                                <option>Lead Generation Homepage Form </option>
                                                <option>Submitted a form</option>
                                                <option>Choose a trigger...</option>
                                                <option>Choose a trigger...</option>
                                            </select>
                                        </div>

                                        <div class="form-group" v-if="unitInfo.workflow_entry_trigger=='contact'">
                                            <label for="formControl" class="fsize11 fw500 dark_600 ls4">SELECT CONTACT</label>

                                            <div class="form-group m-0 review_forms">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle bkg_light_000 border br4 w-100 p-3 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select Contacts
                                                    </button>
                                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" style="height:300px;overflow:auto;">
                                                        <div class="p10">
                                                            <input type="text" v-model="searchBy" placeholder="Search" class="form-control"/>
                                                        </div>
                                                        <a class="dropdown-item" href="javascript:void(0);" v-for="contact in filteredContacts">
                                                            <label class="custmo_checkbox pull-left">
                                                                <input
                                                                    type="checkbox"
                                                                    name="checkRows[]"
                                                                    class="addToCampaign"
                                                                    @click="addToContact($event, contact.subscriber_id)"
                                                                    :value="contact.subscriber_id"
                                                                    :checked="selected_contacts.indexOf(contact.subscriber_id)>-1"
                                                                >
                                                                <span class="custmo_checkmark blue"></span>
                                                            </label>&nbsp; {{ capitalizeFirstLetter(contact.firstname) }} {{ capitalizeFirstLetter(contact.lastname) }} <{{contact.email}}>
                                                        </a>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group" v-if="unitInfo.workflow_entry_trigger=='tags'">
                                            <label for="formControl" class="fsize11 fw500 dark_600 ls4">SELECT TAG</label>

                                            <div class="form-group m-0 review_forms">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle bkg_light_000 border br4 w-100 p-3 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select Tags
                                                    </button>
                                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" style="height:300px;overflow:auto;">
                                                        <div class="p10">
                                                            <input type="text" v-model="searchBy" placeholder="Search" class="form-control"/>
                                                        </div>
                                                        <a class="dropdown-item" href="javascript:void(0);" v-for="tag in filteredTags">
                                                            <label class="custmo_checkbox pull-left">
                                                                <input
                                                                    type="checkbox"
                                                                    name="checkRows[]"
                                                                    class="addToCampaign"
                                                                    @click="addToTags($event,tag.tagid)"
                                                                    :value="tag.tagid"
                                                                    :checked="selected_tags.includes(tag.tagid)">
                                                                <span class="custmo_checkmark blue"></span>
                                                            </label>&nbsp;  {{ tag.tag_name }} ({{tag.subscribersData.total}})
                                                        </a>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group" v-if="unitInfo.workflow_entry_trigger=='lists'">
                                            <label for="formControl" class="fsize11 fw500 dark_600 ls4">SELECT LIST</label>

                                            <div class="form-group m-0 review_forms">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle bkg_light_000 border br4 w-100 p-3 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select Lists
                                                    </button>
                                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" style="height:300px;overflow:auto;">
                                                        <div class="p10">
                                                            <input type="text" v-model="searchBy" placeholder="Search" class="form-control"/>
                                                        </div>
                                                        <a class="dropdown-item" href="javascript:void(0);" v-for="list in filteredLists">
                                                            <label class="custmo_checkbox pull-left">
                                                                <input
                                                                    type="checkbox"
                                                                    name="checkRows[]"
                                                                    class="addToCampaign"
                                                                    @click="addToList($event, list.id)"
                                                                    :value="list.id"
                                                                    :checked="selected_lists.includes(list.id)">
                                                                <span class="custmo_checkmark blue"></span>
                                                            </label>&nbsp;  {{ list.list_name }} ({{list.subscribers.length}})
                                                        </a>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group" v-if="unitInfo.workflow_entry_trigger=='segment'">
                                            <label for="formControl" class="fsize11 fw500 dark_600 ls4">SELECT SEGMENT</label>

                                            <div class="form-group m-0 review_forms">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle bkg_light_000 border br4 w-100 p-3 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select Segments
                                                    </button>
                                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" style="height:300px;overflow:auto;">
                                                        <div class="p10">
                                                            <input type="text" v-model="searchBy" placeholder="Search" class="form-control"/>
                                                        </div>
                                                        <a class="dropdown-item" href="javascript:void(0);" v-for="segment in filteredSegments">
                                                            <label class="custmo_checkbox pull-left">
                                                                <input
                                                                    type="checkbox"
                                                                    name="checkRows[]"
                                                                    class="addToCampaign"
                                                                    @click="addToSegments($event,segment.id)"
                                                                    :value="segment.id"
                                                                    :checked="selected_segments.includes(segment.id)">
                                                                <span class="custmo_checkmark blue"></span>
                                                            </label>&nbsp;  {{ segment.segment_name }} ({{segment.subscribersData.length}})
                                                        </a>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>


                                </div>


                                <div class="row bottom-position">
                                    <div class="col-md-12 mb15">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-md bkg_blue_400 light_000 pr20 min_w_160 fsize13 fw500 mr20" @click.prevent="updateTrigger">Update Trigger</button>
                                        <button class="btn btn-md bkg_light_000 dark_200 pr20 fsize13 fw500 border slideTriggerbox">Close</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>







                </div>

                <!--Goal Modal-->
                <div class="box goalBoxContent" style="width: 424px; display:none;">
                    <div style="width: 424px;overflow: hidden; height: 100%;">
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideGoalbox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img width="44" src="assets/images/trigger_grey_45.png"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">Edit Goal </h3>
                                        <p class="fsize14 dark_200 mb0 mt-1">Choose goal what to do next?</p>
                                        <hr class="mt25 mb30">
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="goalControl" class="fsize11 fw500 dark_600 ls4">SELECT Goal</label>

                                            <select class="form-control h50 form-control-custom dark_800" id="goalControl" v-model="unitInfo.workflow_goal">
                                                <option value="">Choose a goal...</option>
                                                <option value="conversion goal">Conversion Goal</option>
                                                <option value="stop">Stop</option>
                                                <option value="report">Send Report</option>
                                                <option value="new automation">Start Another Automation</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>


                                <div class="row bottom-position">
                                    <div class="col-md-12 mb15">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-md bkg_blue_400 light_000 pr20 min_w_160 fsize13 fw500 mr20" @click.prevent="updateGoal">Update Goal</button>
                                        <button class="btn btn-md bkg_light_000 dark_200 pr20 fsize13 fw500 border slideGoalbox">Close</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!--Action Modal-->
                <div class="box addActionBoxContent" style="width: 424px; display:none;">
                    <div style="width: 424px;overflow: hidden; height: 100%;">
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideAddActionbox" id="slideAddActionbox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img width="44" src="assets/images/add_action_44.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">Add Action</h3>
                                        <p class="fsize14 dark_200 mb0 mt-1">What kind of step would you like to add?</p>
                                        <hr class="mt25 mb30">
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="actionTitle" class="fsize11 fw500 dark_600 ls4">ACTION NAME</label>
                                            <input type="text" class="form-control h50" v-model="actionTitle" id="actionTitle" placeholder="Enter new action name" />
                                        </div>


                                    </div>


                                </div>



                                <div class="row">
                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 slideAddActionbox" @click="addBlankAction('field')" style="cursor:pointer;">
                                            <span class="circle-icon-44 bkg_blue_300 m-auto br12 "><i class="ri-layout-left-line light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-3 mb-1">Field</p>
                                            <p class="fw400 fsize12 dark_300 m0">Edit contact field</p>
                                        </div>
                                    </div>

                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 slideAddActionbox" @click="addBlankAction('tag')" style="cursor:pointer;">
                                            <span class="circle-icon-44 bkg_blue_300 m-auto br12 "><i class="ri-price-tag-3-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-3 mb-1">Tag</p>
                                            <p class="fw400 fsize12 dark_300 m0">Apply, delete tag</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 slideAddActionbox" @click="addBlankAction('list')" style="cursor:pointer;">
                                            <span class="circle-icon-44 bkg_blue_300 m-auto br12 "><i class="ri-list-unordered light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-3 mb-1">List</p>
                                            <p class="fw400 fsize12 dark_300 m0">Subscribe to a list</p>
                                        </div>
                                    </div>

                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 slideAddActionbox" @click="addBlankAction('segment')" style="cursor:pointer;">
                                            <span class="circle-icon-44 bkg_blue_300 m-auto br12 "><i class="ri-pie-chart-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-3 mb-1">Segment</p>
                                            <p class="fw400 fsize12 dark_300 m0">Add, delete segment</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 slideAddActionbox" @click="addBlankAction('status')" style="cursor:pointer;">
                                            <span class="circle-icon-44 bkg_blue_300 m-auto br12 "><i class="ri-checkbox-multiple-line light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-3 mb-1">Status</p>
                                            <p class="fw400 fsize12 dark_300 m0">Apply, edit status</p>
                                        </div>
                                    </div>

                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 slideAddActionbox" @click="addBlankAction('webhook')" style="cursor:pointer;">
                                            <span class="circle-icon-44 bkg_blue_300 m-auto br12 "><i class="ri-link light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-3 mb-1">Webhook</p>
                                            <p class="fw400 fsize12 dark_300 m0">Subscribe to a list</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 slideAddActionbox" @click="addBlankAction('email')" style="cursor:pointer;">
                                            <span class="circle-icon-44 bkg_blue_300 m-auto br12 "><i class="ri-mail-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-3 mb-1">Email</p>
                                            <p class="fw400 fsize12 dark_300 m0">Send Email</p>
                                        </div>
                                    </div>

                                    <div class="col-6 pr5 text-center">
                                        <div class="card border shadow-none p20 pl10 pr10 mb10 slideAddActionbox" @click="addBlankAction('sms')" style="cursor:pointer;">
                                            <span class="circle-icon-44 bkg_blue_300 m-auto br12 "><i class="ri-message-2-fill light_000 fsize18"></i></span>
                                            <p class="fw500 fsize14 dark_600 mt-3 mb-1">SMS</p>
                                            <p class="fw400 fsize12 dark_300 m0">Send SMS</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb15">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-md bkg_light_000 dark_200 pr20 fsize13 fw500 border slideAddActionbox">Close</button>
                                        <a
                                            class="dark_200 fw500 d-inline-block mt10 pull-right"
                                            href="javascript:void(0);"
                                            @click="deleteWorkflowEvent(actionEditEvent, 'slideAddActionbox')"
                                        >Delete &nbsp; <i class="ri-delete-bin-6-line"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!--Edit Field Alias-->
                <div class="box editAliasBoxContent" style="width: 424px; display:none;">
                    <div style="width: 424px;overflow: hidden; height: 100%;">
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideEditAliasbox" id="slideEditAliasbox"><i class=""><img alt="close" src="assets/images/cross.svg"/></i></a>
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img width="44" src="assets/images/add_action_44.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">Edit Custom Field Alias</h3>
                                        <p class="fsize14 dark_200 mb0 mt-1">What custom field you want to rename?</p>
                                        <hr class="mt25 mb30">
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group" v-for="fieldId in [1,2,3,4,5]" :value="fieldId">
                                            <label class="fsize11 fw500 dark_600 ls4">Custom Field {{fieldId}}</label>
                                            <input type="text" class="form-control h50" v-model="fieldAlias['custom_field_'+fieldId]" placeholder="Alias this field" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row bottom-position">
                                <div class="col-md-12 mb15">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-md bkg_blue_400 light_000 pr20 min_w_160 fsize13 fw500 ml20 mr20" @click="updateFieldAlias">Update {{capitalizeFirstLetter(editActionItem)}}</button>
                                    <button class="btn btn-md bkg_light_000 dark_200 pr20 fsize13 fw500 border slideEditAliasbox">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Action Items-->
                <div class="box editActionItemBoxContent" style="width: 424px; display:none;">
                    <div style="width: 424px;overflow: hidden; height: 100%;">
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideEditActionItembox" id="slideEditActionItembox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img width="44" src="assets/images/add_action_44.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">Edit {{capitalizeFirstLetter(editActionItem)}}</h3>
                                        <p class="fsize14 dark_200 mb0 mt-1">What {{editActionItem}} you want to edit/update?</p>
                                        <hr class="mt25 mb30">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="actionName" class="fsize11 fw500 dark_600 ls4">ACTION NAME</label>
                                            <input type="text" class="form-control h50" v-model="actionTitle" id="actionName" placeholder="Enter new action name" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" v-if="editActionItem =='tag'">
                                        <label for="formControl" class="fsize11 fw500 dark_600 ls4">SELECT TAG</label>

                                        <div class="form-group m-0 review_forms">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle bkg_light_000 border br4 w-100 p-3 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select Tags
                                                </button>
                                                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" style="height:300px;overflow:auto;">
                                                    <div class="p10">
                                                        <input type="text" v-model="searchBy" placeholder="Search" class="form-control"/>
                                                    </div>
                                                    <a class="dropdown-item" href="javascript:void(0);" v-for="tag in filteredTags">
                                                        <label class="custmo_checkbox pull-left">
                                                            <input
                                                                type="checkbox"
                                                                name="checkRows[]"
                                                                class="addToCampaign"
                                                                @click="updateActionTags($event,tag.tagid)"
                                                                :value="tag.tagid"
                                                                :checked="selected_action_tags.includes(tag.tagid)">
                                                            <span class="custmo_checkmark blue"></span>
                                                        </label>&nbsp;  {{ tag.tag_name }} ({{tag.subscribersData.total}})
                                                    </a>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                        <div class="form-group" v-if="editActionItem =='list'">
                                        <label for="formControl" class="fsize11 fw500 dark_600 ls4">SELECT LIST</label>

                                        <div class="form-group m-0 review_forms">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle bkg_light_000 border br4 w-100 p-3 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select Lists
                                                </button>
                                                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" style="height:300px;overflow:auto;">
                                                    <div class="p10">
                                                        <input type="text" v-model="searchBy" placeholder="Search" class="form-control"/>
                                                    </div>
                                                    <a class="dropdown-item" href="javascript:void(0);" v-for="list in filteredLists">
                                                        <label class="custmo_checkbox pull-left">
                                                            <input
                                                                type="checkbox"
                                                                name="checkRows[]"
                                                                class="addToCampaign"
                                                                @click="updateActionLists($event,list.id)"
                                                                :value="list.id"
                                                                :checked="selected_action_lists.includes(list.id)">
                                                            <span class="custmo_checkmark blue"></span>
                                                        </label>&nbsp;  {{ list.list_name }} ({{list.subscribers.length}})
                                                    </a>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                        <div class="form-group" v-if="editActionItem =='field'">
                                            <label for="fieldControl" class="fsize11 fw500 dark_600 ls4">SELECT FIELD &nbsp;<a href="javascript:void(0);" class=" fsize12 slideEditActionItembox slideEditAliasbox"><i>(Rename Custom Fields)</i></a> </label>
                                            <select class="form-control h50 form-control-custom dark_800" id="fieldControl" v-model="selected_action_field_name">
                                                <option value="">Choose a field...</option>
                                                <option v-for="fieldId in ['firstname', 'lastname', 'email', 'ip_address', 'country', 'state', 'city', 'zip', 'area_code']" :value="fieldId">
                                                    {{capitalizeFirstLetter(fieldId.replace('_', ' '))}}
                                                </option>
                                                <option v-for="fieldId in [1,2,3,4,5]" :value="fieldId">
                                                    {{fieldAlias['custom_field_'+fieldId] ? capitalizeFirstLetter(fieldAlias['custom_field_'+fieldId]) : 'Custom Field '+fieldId}}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group" v-if="editActionItem =='field'">
                                            <label for="fieldValue" class="fsize11 fw500 dark_600 ls4">FIELD VALUE</label>
                                            <input type="text" class="form-control h50" v-model="selected_action_field_value" id="fieldValue" placeholder="Enter selected field value" />
                                        </div>

                                        <div class="form-group" v-if="editActionItem =='webhook'">
                                            <label class="fsize11 fw500 dark_600 ls4">WEBHOOK URL</label>
                                            <input type="text" class="form-control h50" v-model="selected_action_webhook_url" placeholder="Enter webhook url" />
                                        </div>
                                        <div class="form-group" v-if="editActionItem =='webhook'">
                                            <label for="webhookMethod" class="fsize11 fw500 dark_600 ls4">METHOD</label>
                                            <select class="form-control h50 form-control-custom dark_800" id="webhookMethod" v-model="selected_action_webhook_method">
                                                <option value="">Choose a method...</option>
                                                <option value="get">GET</option>
                                                <option value="post">POST</option>
                                            </select>
                                        </div>
                                        <div class="form-group" v-if="editActionItem =='webhook'">
                                            <label for="webhookMethod" class="fsize11 fw500 dark_600 ls4">WEBHOOK DATA <a class="fsize12" href="javascript:void(0)" @click="addWebhookParam"><i>(Add one or more parameters)</i></a></label>
                                            <div class="row mt15" v-for="(param, index) in selected_action_webhook_data">
                                                <div class="col-6">
                                                    <div class="form-group mb-0">
                                                        <label class="dark_600 fsize11 fw500 ls4">PARAMETER</label>
                                                        <input type="text" class="form-control h48" v-model="param.field" placeholder="Param Name">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mb-0">
                                                        <label class="dark_600 fsize11 fw500 ls4">VALUE</label>
                                                        <input type="text" class="form-control h48" v-model="param.value" placeholder="Param Value"> <a href="javascript:void(0);" @click="removeWebhookParam(index)" class="pull-right" style="display:block;margin-top:-35px;margin-right:-25px;"><i class="fsize15 ri-close-circle-line"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" v-if="editActionItem =='status'">
                                            <label for="userstatus" class="fsize11 fw500 dark_600 ls4">STATUS</label>
                                            <select class="form-control h50 form-control-custom dark_800" id="userstatus" v-model="selected_action_status">
                                                <option value="">Select user status...</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                                <option value="draft">Draft</option>
                                                <option value="archive">Archive</option>
                                            </select>
                                        </div>

                                        <div class="form-group" v-if="editActionItem =='segment'">
                                            <label for="formControl" class="fsize11 fw500 dark_600 ls4">SELECT SEGMENT</label>

                                            <div class="form-group m-0 review_forms">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle bkg_light_000 border br4 w-100 p-3 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select Segments
                                                    </button>
                                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" style="height:300px;overflow:auto;">
                                                        <div class="p10">
                                                            <input type="text" v-model="searchBy" placeholder="Search" class="form-control"/>
                                                        </div>
                                                        <a class="dropdown-item" href="javascript:void(0);" v-for="segment in filteredSegments">
                                                            <label class="custmo_checkbox pull-left">
                                                                <input
                                                                    type="checkbox"
                                                                    name="checkRows[]"
                                                                    class="addToCampaign"
                                                                    @click="updateActionSegments($event,segment.id)"
                                                                    :value="segment.id"
                                                                    :checked="selected_action_segments.includes(segment.id)">
                                                                <span class="custmo_checkmark blue"></span>
                                                            </label>&nbsp;  {{ segment.segment_name }} ({{segment.subscribersData.length}})
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="row bottom-position">
                                    <div class="col-md-12 mb15">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-md bkg_blue_400 light_000 pr20 min_w_160 fsize13 fw500 ml20 mr20" @click="updateActionItem">Update {{capitalizeFirstLetter(editActionItem)}}</button>
                                        <button class="btn btn-md bkg_light_000 dark_200 pr20 fsize13 fw500 border slideEditActionItembox" id="slideEditActionItembox">Close</button>
                                        <a
                                            class="dark_200 fw500 d-inline-block mt10 mr20 pull-right"
                                            href="javascript:void(0);"
                                            @click="deleteWorkflowEvent(editActionEvent, 'slideEditActionItembox')"
                                        >Delete &nbsp; <i class="ri-delete-bin-6-line"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                <!--Decision Modal New-->
                <div class="box addDecisionBoxContent" style="width: 424px; border-color:#64B2CB!important; display:none; ">
                    <div style="width: 424px;overflow: hidden; height: 100%;">
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideAddDecisionbox" id="slideAddDecisionbox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img width="40" src="assets/images/decision_arrow_45.png"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">Decision </h3>
                                        <p class="fsize14 dark_200 mb0 mt-1">Send people down a path based on selected criteria.</p>
                                        <hr class="mt20 mb20">
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="decisionTitle" class="fsize11 fw500 dark_600 ls4">DECISION NODE NAME</label>
                                            <input class="form-control h50" v-model="decisionProperties.decision_name" type="text" placeholder="Enter decision node name" id="decisionTitle" />
                                        </div>

                                        <div class="form-group">
                                            <label for="decisionType" class="fsize11 fw500 dark_600 ls4">DECISION BASED ON</label>
                                            <div class="min_h_48 border br4 p15">
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="custmo_checkbox pull-left m0">
                                                            <input
                                                                type="radio"
                                                                v-model="decisionProperties.decision_type"
                                                                name="decisionType"
                                                                value="attribute"
                                                                :checked="decisionProperties.decision_type=='attribute'"
                                                                id="decisionType">
                                                            <span class="custmo_checkmark br100 decision"></span>
                                                            &nbsp; Attribute
                                                        </label>
                                                    </div>
                                                    <div class="col">
                                                        <span class="v_line_48" style="left:-7px; top:-16px;"></span>
                                                        <label class="custmo_checkbox pull-left m0">
                                                            <input
                                                                type="radio"
                                                                v-model="decisionProperties.decision_type"
                                                                name="decisionType"
                                                                value="segment"
                                                                :checked="decisionProperties.decision_type=='segment'">
                                                            <span class="custmo_checkmark br100 decision"></span>
                                                            &nbsp; Segment
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="mt20" />

                                        <div class="form-group">
                                            <label for="decisionPathA" class="fsize11 fw500 dark_600 ls4">PATH 1</label>
                                            <select class="form-control h50 form-control-custom dark_800" id="decisionPathA">
                                                <option>Select segment </option>
                                                <option>Submitted a form</option>
                                                <option>Choose a trigger...</option>
                                                <option>Choose a trigger...</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="decisionPathB" class="fsize11 fw500 dark_600 ls4">PATH 2</label>
                                            <select class="form-control h50 form-control-custom dark_800" id="decisionPathB">
                                                <option>Select segment </option>
                                                <option>Submitted a form</option>
                                                <option>Choose a trigger...</option>
                                                <option>Choose a trigger...</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <a class="decision_300 fsize12 fw500 ls4 lh_20" href="#"><img src="assets/images/add-circle-fill-decision.svg"/>&nbsp; ADD SEGMENT</a>
                                        </div>
                                    </div>


                                </div>


                                <div class="row bottom-position">
                                    <div class="col-md-12 mb15">
                                        <hr>
                                    </div>
                                    <div class="col-md-6" v-if="decisionEditMode == true">
                                        <button
                                            class="btn btn-md bkg_decision_300 light_000 pr20 min_w_160 fsize13 fw500 mr20"
                                            @click="updateDecision"
                                        >UPDATE DECISION</button>
                                    </div>
                                    <div class="col-md-6" v-else>
                                        <button
                                            class="btn btn-md bkg_decision_300 light_000 pr20 min_w_160 fsize13 fw500 mr20 slideAddDecisionbox"
                                            @click="addBlankDecision"
                                        >SAVE DECISION</button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a
                                            v-if="decisionEditMode == true"
                                            class="dark_200 fw500 d-inline-block mt10"
                                            href="javascript:void(0);"
                                            @click="deleteWorkflowEvent(decisionEditEvent, 'slideAddDecisionbox')"
                                        >Delete &nbsp; <i class="ri-delete-bin-6-line"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Delay Modal-->
                <div class="box addDelayBoxContent" style="width: 424px; display:none;">
                    <div style="width: 424px;overflow: hidden; height: 100%;">
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideAddDelaybox" id="slideAddDelaybox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img width="44" src="assets/images/time_blue_44.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">Edit Delay</h3>
                                        <p class="fsize14 dark_200 mb0 mt-1">Which event should trigger this automation?</p>
                                        <hr class="mt25 mb30">
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="waitfor" class="fsize11 fw500 dark_600 ls4">WAIT FOR</label>
                                            <div class="campaign_name_sec border br4 p10 pl20 pr20 fsize14 dark_200">
                                                <div class="row">
                                                    <div class="col-6"><input type="text" v-model="delayProperties.delay_value" class="textfield fsize14 dark_200" id="waitfor" placeholder="1"></div>
                                                    <div class="col-6 pl0">
                                                        <div class="dropdown campaign_forms" style="width:100%!important;">
                                                            <button class="btn dropdown-toggle bkg_light_000 w-100 p-1 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{capitalizeFirstLetter(delayProperties.delay_unit)}}</button>
                                                            <div class="dropdown-menu w-100 dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-97px, 30px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" :class="{'active': delayProperties.delay_unit=='days'}" href="javascript:void(0);" @click="delayProperties.delay_unit='days'"> Days </a>
                                                                <a class="dropdown-item" :class="{'active': delayProperties.delay_unit=='month'}" href="javascript:void(0);" @click="delayProperties.delay_unit='month'"> Month </a>
                                                                <a class="dropdown-item" :class="{'active': delayProperties.delay_unit=='hour'}" href="javascript:void(0);" @click="delayProperties.delay_unit='hour'"> Hour </a>
                                                                <a class="dropdown-item" :class="{'active': delayProperties.delay_unit=='minute'}" href="javascript:void(0);" @click="delayProperties.delay_unit='minute'"> Minute </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb30">
                                            <label for="resume" class="fsize11 fw500 dark_600 ls4">WHAT DAYS OF THE WEEK CAN WE RESUME?</label>
                                            <select v-model="delayProperties.delay_weekday" class="form-control h50 form-control-custom dark_800" id="resume">
                                                <option value="all">All Days</option>
                                                <option value="1">Monday</option>
                                                <option value="2">Tuesday</option>
                                                <option value="3">Wednesday</option>
                                                <option value="4">Thursday</option>
                                                <option value="5">Friday</option>
                                                <option value="6">Saturday</option>
                                                <option value="7">Sunday</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="resume2" class="fsize11 fw500 dark_600 ls4">RESUME THE SAME TIME AS PAUSED</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <p class="m0 fsize11 fw500 float-left" :class="delayProperties.delay_paused? 'blue_400':'light_800'">{{delayProperties.delay_paused? 'YES':'NO'}}</p>
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" id="resume2" v-model="delayProperties.delay_paused" >
                                            <span class="toggle blue"></span>
                                        </label>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb30">
                                            <label for="resumeTime" class="fsize11 fw500 dark_600 ls4">WHAT TIME SHOULD WE RESUME?</label>

                                            <div class="row">
                                                <div class="col">
                                                    <select v-model="delayProperties.delay_hour" class="form-control small h50 form-control-custom dark_800" id="resumeTime">
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                        <option value="5">05</option>
                                                        <option value="6">06</option>
                                                        <option value="7">07</option>
                                                        <option value="8">08</option>
                                                        <option value="9">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <select v-model="delayProperties.delay_minute" class="form-control small h50 form-control-custom dark_800">
                                                        <option v-for="i in 59">{{(i<10)? ("0"+i): i}}</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select v-model="delayProperties.delay_ampm" class="form-control small h50 form-control-custom dark_800">
                                                        <option value="am">AM</option>
                                                        <option value="pm">PM</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="timezone" class="fsize11 fw500 dark_600 ls4">USE CUSTOMER TIME ZONES</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <p class="m0 fsize11 fw500 float-left" :class="delayProperties.delay_custom_zone? 'blue_400':'light_800'">{{delayProperties.delay_custom_zone ? 'YES': 'NO'}}</p>
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" id="timezone" v-model="delayProperties.delay_custom_zone" >
                                            <span class="toggle blue"></span>
                                        </label>
                                    </div>

                                    <div class="col-md-12" v-if="delayProperties.delay_custom_zone">
                                        <div class="form-group">
                                            <label for="timezone2" class="fsize11 fw500 dark_600 ls4">TIME ZONE</label>
                                            <select v-model="delayProperties.delay_time_zone" class="form-control h50 form-control-custom dark_800" id="timezone2">
                                                <option value="est">(GMT -05:00) Eastern Standard Time</option>
                                                <option value="edt">(GMT -04:00) Eastern Daylight Time</option>
                                                <option value="cst">(GMT -06:00) Central Standard Time</option>
                                                <option value="cdt">(GMT -05:00) Central Daylight Time</option>
                                                <option value="default">Default Timezone</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <div class="row bottom-position">
                                    <div class="col-md-12 mb15">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <button
                                            v-if="delayEditMode == true"
                                            class="btn btn-md bkg_blue_400 light_000 pr20 min_w_160 fsize13 fw500 mr20"
                                            @click="updateDelay"
                                        >Update Delay</button>
                                        <button
                                            v-else
                                            class="btn btn-md bkg_blue_400 light_000 pr20 min_w_160 fsize13 fw500 mr20 slideAddDelaybox"
                                            @click="addDelay"
                                        >Add Delay</button>
                                        <button class="btn btn-md bkg_light_000 dark_200 pr20 fsize13 fw500 border slideAddDelaybox">Close</button>
                                        <a
                                            v-if="delayEditMode == true"
                                            class="dark_200 fw500 d-inline-block mt10 pull-right"
                                            href="javascript:void(0);"
                                            @click="deleteWorkflowEvent(delayEditEvent, 'slideAddDelaybox')"
                                        >Delete &nbsp; <i class="ri-delete-bin-6-line"></i></a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Split Modal-->
                <div class="box addSplitBoxContent" style="width: 424px; display:none; border-color:#67B7E4!important">
                    <div style="width: 424px;overflow: hidden; height: 100%;">
                        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slideAddSplitbox" id="slideAddSplitbox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img width="44" src="assets/images/split_icon_44.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">Split Test</h3>
                                        <p class="fsize14 dark_200 mb0 mt-1">Which event should trigger this automation?</p>
                                        <hr class="mt25 mb30">
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="testname" class="fsize11 fw500 dark_600 ls4">SPLIT TEST NAME</label>
                                            <input type="text" v-model="splitProperties.test_name" class="form-control h50" placeholder="Enter new split test name" id="testname"/>
                                        </div>

                                        <div class="form-group mb30">
                                            <label for="splitPath" class="fsize11 fw500 dark_600 ls4">SPLIT INTO</label>
                                            <select v-model="splitProperties.total_path" class="form-control h50 form-control-custom dark_800" id="splitPath">
                                                <option value="2">2 paths (A/B)</option>
                                                <option value="3">3 paths (A/B/C)</option>
                                                <option value="4">4 paths (A/B/C/D)</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="evenTraffic" class="fsize11 fw500 dark_600 ls4">DISTRIBUTE TRAFFIC EVENLY</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <p class="m0 fsize11 fw500 float-left" :class="splitProperties.even_traffic? 'email_400': 'light_800'">{{splitProperties.even_traffic? 'YES' : 'NO'}}</p>
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" v-model="splitProperties.even_traffic" id="evenTraffic" >
                                            <span class="toggle email"></span>
                                        </label>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ex1" class="fsize11 fw500 dark_600 ls4">PATHS PERCENTAGES</label>
                                            <div class="row">
                                                <div class="col-12">
                                                    <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14" @change="alert('changing value')"/>
                                                </div>
                                                <div class="col-6 pr5">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text blue_300" style="width:48px; padding:0 17px; background: rgba(165, 206, 255, 0.1); border-color:#E1E9F6;">A</span>
                                                        </div>
                                                        <input type="text" class="form-control h48 brig_nonr" v-model="splitProperties.path_a">
                                                        <div class="input-group-append bkg_light_000">
                                                            <span class="input-group-text bkg_light_000 dark_100" style="border-color:#E1E9F6; width:48px; padding:0 17px;">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 pl5">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text green_400" style="width:48px; padding:0 17px; background: rgba(148, 215, 169, 0.1); border-color:#E1E9F6;">B</span>
                                                        </div>
                                                        <input type="text" class="form-control h48 brig_nonr" v-model="splitProperties.path_b">
                                                        <div class="input-group-append bkg_light_000">
                                                            <span class="input-group-text bkg_light_000 dark_100" style="border-color:#E1E9F6; width:48px; padding:0 17px;">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="splitProperties.total_path >=3" class="col-6 pr5">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text blue_300" style="width:48px; padding:0 17px; background: rgba(148, 215, 169, 0.1); border-color:#E1E9F6;">C</span>
                                                        </div>
                                                        <input type="text" class="form-control h48 brig_nonr" v-model="splitProperties.path_c">
                                                        <div class="input-group-append bkg_light_000">
                                                            <span class="input-group-text bkg_light_000 dark_100" style="border-color:#E1E9F6; width:48px; padding:0 17px;">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="splitProperties.total_path==4" class="col-6 pl5">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text green_400" style="width:48px; padding:0 17px; background: rgba(148, 215, 169, 0.1); border-color:#E1E9F6;">D</span>
                                                        </div>
                                                        <input type="text" class="form-control h48 brig_nonr" v-model="splitProperties.path_d">
                                                        <div class="input-group-append bkg_light_000">
                                                            <span class="input-group-text bkg_light_000 dark_100" style="border-color:#E1E9F6; width:48px; padding:0 17px;">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="conditionalsplit" class="fsize11 fw500 dark_600 ls4 text-uppercase">Conditional Split</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <p class="m0 fsize11 fw500 float-left" :class="splitProperties.conditional_split? 'email_400': 'light_800'">{{splitProperties.conditional_split? 'YES' : 'NO'}}</p>
                                        <label class="custom-form-switch float-right">
                                            <input class="field" type="checkbox" v-model="splitProperties.conditional_split" id="conditionalsplit" >
                                            <span class="toggle email"></span>
                                        </label>
                                    </div>

                                    <div class="col-md-12" v-if="splitProperties.conditional_split">
                                        <hr class="mt0" />
                                        <p class="fsize14 dark_400">Split traffic and send contacts to Path B until...</p>
                                        <div class="form-group">
                                            <label for="splitcondition" class="fsize11 fw500 dark_600 ls4">THE FOLLOWING condition is met:</label>
                                            <select v-model="splitProperties.sent_to" class="form-control h50 form-control-custom dark_800" id="splitcondition">
                                                <option value="b">X contacts have been sent to Path B</option>
                                                <option value="a">X contacts have been sent to Path A</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb30">
                                            <label for="numberofcontact" class="fsize11 fw500 dark_600 ls4">NUMBER OF CONTACTS</label>
                                            <select v-model="splitProperties.total_sent_to" class="form-control h50 form-control-custom dark_800" id="numberofcontact">
                                                <option value="500">500</option>
                                                <option value="1000">1000</option>
                                                <option value="1500">1500</option>
                                                <option value="2000">2000</option>
                                            </select>
                                        </div>

                                    </div>

                                </div>

                                <!-- <div class="row bottom-position">-->
                                <div class="row">
                                    <div class="col-md-12 mb15">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <button v-if="splitEditMode == true"
                                            class="btn btn-md bkg_email_400 light_000 pr20 min_w_160 fsize13 fw500 mr20"
                                            @click="updateSplitTest">Update Split Test
                                        </button>
                                        <button
                                            v-else
                                            class="btn btn-md bkg_email_400 light_000 pr20 min_w_160 fsize13 fw500 mr20 slideAddSplitbox"
                                            @click="addSplitTest">Save Split Test
                                        </button>
                                        <button class="btn btn-md bkg_light_000 dark_200 pr20 fsize13 fw500 border slideAddSplitbox" id="slideAddSplitbox">Close</button>
                                        <a
                                            v-if="splitEditMode == true"
                                            class="dark_200 fw500 d-inline-block mt10 pull-right"
                                            href="javascript:void(0);"
                                            @click="deleteWorkflowEvent(splitEditEvent, 'slideAddSplitbox')"
                                        >Delete &nbsp; <i class="ri-delete-bin-6-line"></i></a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Email Preview Modal-->
                <div class="modal fade show" id="EditOverviewPreview">
                    <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 1200px;">
                        <div class="modal-content review" style="width: 1200px;">
                            <div class="modal-body p0 mt0 br5" style="width: 1200px;">
                                <!--<system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="4"></system-messages>-->

                                <div class="row">
                                    <div class="col-md-4 pr0">
                                        <div class="email_editor_left">
                                            <div class="p10 bbot"><p class="m0 txt_dark fw500">Email Configuration</p></div>
                                            <div class="p20">
                                                <div class="form-group">
                                                    <label class="">Greetings</label>
                                                    <input v-model="greetings" class="form-control h52" required="" placeholder="Hi, We’d love your feeed..." type="text">
                                                </div>

                                                <div class="form-group mb0">
                                                    <label class="">Content</label>
                                                    <a class="fsize14 open_editor" href="#"><i class=""><img src="/assets/images/open_editor.png"/> </i> &nbsp; Open editor</a>
                                                    <textarea v-model="introduction" style="min-height: 238px; resize: none;" class="form-control p20 fsize12" v-html="introduction">I have hinted that I would often jerk poor Queequeg from between the whale and the ship—where he would occasionally fall, from the incessant rolling and swaying of both.

										But this was not the only jamming jeopardy he was exposed to. Unappalled by the massacre made upon them...</textarea>
                                                </div>
                                            </div>
                                            <div class="p20 pt0" v-if="sendTestBox==false">
                                                <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" @click="saveEditChanges">Save</button>
                                                <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" @click="openEmailTemplates">Change Template</button>
                                                <a class="dark_200 fsize12 fw500 ml20 text-uppercase" href="javascript:void(0);" @click="sendTestBox=true">Send test email</a>
                                            </div>
                                            <div class="p20 pt0" id="wfTestCtr" v-if="sendTestBox">
                                                <input type="text" class="mr20" placeholder="Email Address" v-model="user.email" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" />
                                                <button type="button" class="btn dark_btn h40 bkg_bl_gr" @click.prevent="sendTestEmail">Send</button>
                                                <a href="javascript:void(0);" class="btn btn-link fsize14" @click="sendTestBox=false">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 pl3">
                                        <div class="email_editor_right preview" style="max-height:800px;overflow:auto;border-left:5px solid;">
                                            <div class="p10 bbot position-relative"><p class="m0 txt_dark fw500">Preview</p>
                                            </div>
                                            <div class="p30" id="wf_preview_edit_template_content">
                                                <div class="email_preview_sec br5 pb20" style="min-height: 500px;" v-html="content">
                                                    Content goes here
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--SMS Preview Modal-->
                <div class="modal fade show" id="EditSMSPreview">
                    <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 1200px;">
                        <div class="modal-content review" style="width: 1200px;">
                            <div class="modal-body p0 mt0 br5" style="width: 1200px;">

                                <div class="row">
                                    <div class="col-md-4 pr0">
                                        <div class="email_editor_left">
                                            <div class="p10 bbot"><p class="m0 txt_dark fw500">SMS Configuration</p></div>
                                            <div class="p20">
                                                <div class="form-group">
                                                    <label class="">Greetings</label>
                                                    <input v-model="smsGreetings" class="form-control h52" required="" placeholder="Hi, We’d love your feeed..." type="text">
                                                </div>

                                                <div class="form-group mb0">
                                                    <label class="">Content</label>
                                                    <a class="fsize14 open_editor" href="#"><i class=""><img src="/assets/images/open_editor.png"/> </i> &nbsp; Open editor</a>
                                                    <textarea v-model="smsIntroduction" style="min-height: 238px; resize: none;" class="form-control p20 fsize12" v-html="smsIntroduction">I have hinted that I would often jerk poor Queequeg from between the whale and the ship—where he would occasionally fall, from the incessant rolling and swaying of both.

										But this was not the only jamming jeopardy he was exposed to. Unappalled by the massacre made upon them...</textarea>
                                                </div>
                                            </div>
                                            <div class="p20 pt0" v-if="sendTestBox==false">
                                                <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" @click="saveSMSEditChanges">Save</button>
                                                <button class="btn btn-lg bkg_reviews_400 light_000 pr20 min_w_160 fsize12 fw500 text-uppercase" @click="openSMSTemplates">Change Template</button>
                                                <a class="dark_200 fsize12 fw500 ml20 text-uppercase" href="javascript:void(0);" @click="sendTestBox=true">Send test SMS</a>
                                            </div>
                                            <div class="p20 pt0" id="wfTestCtr" v-if="sendTestBox">
                                                <input type="text" class="mr20" placeholder="Phone Number" v-model="user.phone" style="border-radius:5px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;height: 40px;color: #011540!important;font-size: 14px!important;font-weight:400!important;" />
                                                <button type="button" class="btn dark_btn h40 bkg_bl_gr" @click.prevent="sendTestSMS">Send</button>
                                                <a href="javascript:void(0);" class="btn btn-link fsize14" @click="sendTestBox=false">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 pl3">
                                        <div class="email_editor_right preview" style="max-height:800px;overflow:auto;border-left:5px solid;">
                                            <div class="p10 bbot position-relative"><p class="m0 txt_dark fw500">Preview</p>
                                            </div>
                                            <div class="sms_preview">
                                                <div class="phone_sms">
                                                    <div class="inner">
                                                        <p v-html="smsContent"></p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p><small>{{ timestampToDateFormat(Math.floor(Date.now() / 1000)) }}</small></p>
                                                </div>
                                            </div>
                                        </div>
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
    import jq from "jquery";

    var shiftInterval;
    import ListView from '@/components/admin/smart-workflow/ListView';
    import CanvasView from '@/components/admin/smart-workflow/CanvasView';
    import EmailTemplates from "@/components/admin/smart-workflow/components/EmailTemplates";
    import SmsTemplates from "@/components/admin/smart-workflow/components/SmsTemplates";
    export default {
        components: {ListView, CanvasView, EmailTemplates, SmsTemplates},
        props: ['moduleName', 'moduleUnitId'],
        data(){
            return {
                loading: false,
                pageRendered: false,
                successMsg : '',
                viewType: 'canvas',
                title: '',
                events: {},
                unitInfo: {},
                metaData: {
                    selectedClass: ''
                },
                selectedEvent: '',
                actionTitle: '',
                decisionProperties: {
                    decision_name: '',
                    decision_type: ''
                },
                delayProperties: {
                    delay_type: 'after',
                    delay_unit: 'minute',
                    delay_value: 10,
                    delay_weekday: '7',
                    delay_paused: false,
                    delay_hour: 8,
                    delay_minute: 30,
                    delay_ampm: 'am',
                    delay_custom_zone: false,
                    delay_time_zone: 'est'
                },
                splitProperties: {
                    test_name: '',
                    total_path: 2,
                    even_traffic: true,
                    path_a: 75,
                    path_b: 25,
                    path_c: 0,
                    path_d: 0,
                    conditional_split: false,
                    total_sent_to: 500,
                    sent_to: 'a'
                },
                isDragStarted: false,
                draggableEvent: '',
                draggedEvent: '',
                delayEditMode: false,
                delayEditId: '',
                delayEditEvent: '',
                splitEditMode: false,
                splitEditId: '',
                splitEditEvent: '',
                decisionEditMode: false,
                decisionEditId: '',
                decisionEditEvent: '',
                actionEditMode: false,
                actionEditId: '',
                actionEditEvent: '',
                configureWorkflow: true,
                templateCategories: '',
                showEmailTemplates: false,
                showSMSTemplates: false,
                emailTemplates: '',
                smsTemplates: '',
                allDataTemplates: '',
                user: '',
                greetings: '',
                introduction: '',
                content: '',
                smsGreetings: '',
                smsIntroduction: '',
                smsContent: '',
                sendTestBox: false,
                selected_SMSCampaignId: '',
                selected_emailCampaignId: '',
                selectedEmailNodeData: '',
                selectedSMSNodeData: '',
                lists: '',
                selected_lists: '',
                tags: '',
                selected_tags: '',
                segments: '',
                selected_segments: '',
                contacts: '',
                selected_contacts: '',
                current_page: 1,
                items_per_page: 100,
                searchBy: '',
                editActionEvent: '',
                editActionItem: '',
                selected_action_tags: '',
                selected_action_lists: '',
                selected_action_field_name: '',
                selected_action_field_value: '',
                fieldAlias: '',
                selected_action_webhook_url: '',
                selected_action_webhook_data: [],
                selected_action_webhook_method: '',
                selected_action_status: '',
                selected_action_segments: '',
                isDecisionNode: false,
                isSplitNode: false,
                decisionPathId: '',
                splitPathId: ''
            }
        },
        mounted() {
            if(document.querySelector('.topbar')){
                let elem = document.querySelector('.topbar');
                elem.classList.add('workflowtopbar');
            }
            setTimeout(function(){
                triggerSplitSlider();
            }, 5000);

        },
        created(){
            this.getWorkflowData();
            this.getAudienceData();
        },
        computed: {
            filteredTags() {
                if (this.tags) {
                    return this.tags.filter(tag => {
                        return tag.tag_name.toLowerCase().includes(this.searchBy.toLowerCase())
                    });
                }
            },
            filteredLists() {
                if (this.lists) {
                    return this.lists.filter(list => {
                        return list.list_name.toLowerCase().includes(this.searchBy.toLowerCase())
                    });
                }
            },
            filteredSegments() {
                if (this.segments) {
                    return this.segments.filter(segment => {
                        return segment.segment_name.toLowerCase().includes(this.searchBy.toLowerCase())
                    });
                }
            },
            filteredContacts() {
                if (this.contacts) {
                    return this.contacts.filter(contact => {
                        return contact.firstname.toLowerCase().includes(this.searchBy.toLowerCase()) || contact.lastname.toLowerCase().includes(this.searchBy.toLowerCase())
                    });
                }
            },
        },
        watch: {
            greetings: function(){
                jq("#wf_edit_template_greeting_EDITOR").text(this.greetings);
                jq("#wf_edit_sms_template_greeting_Preview").text(this.greetings);
            },
            introduction: function(){
                jq("#wf_edit_template_introduction_EDITOR").text(this.introduction);
                jq("#wf_edit_sms_template_introduction_Preview").text(this.introduction);
            },
            smsGreetings: function(){
                jq("#wf_edit_sms_template_greeting_Preview").text(this.smsGreetings);
            },
            smsIntroduction: function(){
                jq("#wf_edit_sms_template_introduction_Preview").text(this.smsIntroduction);
            },
            searchBy : function(){
                this.getAudienceData();
            },

        },
        methods: {
            getWorkflowData: function(){
                this.showLoading(true);
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getWorkflowData', { moduleName: this.moduleName, moduleUnitId: this.moduleUnitId})
                    .then(response => {
                        this.title = response.data.title;
                        this.events = response.data.oEvents;
                        this.unitInfo = response.data.moduleUnitData;
                        this.user = response.data.userInfo;
                        this.showLoading(false);
                        this.emailTemplates = response.data.oEmailTemplates;
                        this.smsTemplates = response.data.oSMSTemplates;
                        this.templateCategories = response.data.oCategories;
                        this.pageRendered = true;
                        //console.log(this.campaigns)
                    });
            },
            getAudienceData: function(){
                axios.post('/admin/workflow/loadWorkflowAudience?items_per_page='+this.items_per_page+ '&page='+this.current_page+'&search='+this.searchBy, {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    actionType: 'import',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.contacts = response.data.subscribersData;
                        this.selected_contacts = response.data.aSelectedContacts;
                        this.lists = response.data.oLists;
                        this.selected_lists = response.data.aSelectedListIDs;
                        this.tags = response.data.aTags;
                        this.selected_tags = response.data.aSelectedTags;
                        this.segments = response.data.oSegments;
                        this.selected_segments = response.data.aSelectedSegments;
                        this.showLoading(false);
                    });
            },
            updateTrigger: function(){
                let formData = {
                    workflow_entry_trigger: this.unitInfo.workflow_entry_trigger,
                }
                this.updateUnitData(formData);
            },
            updateGoal: function(){
                let formData = {
                    workflow_goal: this.unitInfo.workflow_goal,
                }
                this.updateUnitData(formData);
            },
            updateUnitData: function(data){
                this.showLoading(true);
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateWorkflowUnitInfo',
                    {
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        formData: data
                }).then(response => {
                        if(response.data.status == 'success'){
                            this.showLoading(false);
                            this.displayMessage('success', 'Data has been saved successfully!');
                            this.getWorkflowData();
                        }
                    });
            },
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
            },
            setActionProps: function(event, nodeCat, pathId){
                this.clearActionProps();
                this.clearAllForms();
                this.clearAllEditMode();
                if(event){
                    this.selectedEvent = event;
                }
                if(nodeCat == 'decision'){
                    this.isDecisionNode = true;
                    this.decisionPathId = pathId;
                }else if(nodeCat == 'split'){
                    this.isSplitNode = true;
                    this.splitPathId = pathId;
                }else{
                    this.isDecisionNode = false;
                    this.isSplitNode = false;
                    this.decisionPathId = '';
                    this.splitPathId = '';
                }
            },
            clearAllForms: function(){
              this.clearDelayProperties();
              this.clearSplitProperties();
              this.clearDecisionProperties();
            },
            deleteWorkflowNode: function(event, nodeCat){
                this.clearActionProps();
                this.showLoading(true);
                let formData = {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    event_id: event.id
                };
                let url='';
                if(this.isDecisionNode == true || nodeCat == 'decision'){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/deleteWorkflowDecisionEvent';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/deleteWorkflowEvent';
                }
                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        if(this.isDecisionNode == true || this.isSplitNode == true){
                            this.getWorkflowData();
                        }else{
                            this.events = response.data.oEvents;
                        }

                        this.displayMessage('success', 'Node deleted succcessfully!');
                    }
                });
            },
            editWorkflowNode: function(nodeType, event, nodeCat){
                this.showLoading(true);
                if(nodeCat == 'decision'){
                    this.isDecisionNode = true;
                }else if(nodeCat == 'split'){
                    this.isSplitNode = true;
                }else{
                    this.isDecisionNode = false;
                    this.isSplitNode = false;
                }
                this.clearAllEditMode();
                if(nodeType == 'delay'){
                    this.loadEditDelay(event);
                }else if(nodeType == 'split'){
                    this.loadSplitProperties(event);
                }else if(nodeType == 'action'){
                    this.loadActionData(event);
                }else if(nodeType == 'decision'){
                    this.loadDecisionProperties(event);
                }

            },
            clearAllEditMode: function(){
                this.actionEditMode = false;
                this.actionEditId = '';
                this.actionEditEvent = '';
                this.delayEditMode = false;
                this.delayEditId = '';
                this.delayEditEvent = '';
                this.splitEditMode = false;
                this.splitEditId = '';
                this.splitEditEvent = '';
                this.decisionEditMode = false;
                this.decisionEditId = '';
                this.decisionEditEvent = '';

            },
            loadActionData: function(event){
                this.actionEditMode = true;
                this.actionEditId = event.id;
                this.actionEditEvent = event;
                let triggerParams = JSON.parse(event.data);
                let actionName = triggerParams['name'];
                if(actionName == ''){
                    //Blank Action Node, Lets this setup
                    document.querySelector("#slideAddActionbox").click();
                }else if(actionName == 'email'){
                    //Email Node
                    this.loadEmail(event);
                }else if(actionName == 'sms'){
                    //SMS Node
                    this.loadSMS(event);
                }else if(actionName == 'tag'){
                    //Tag Node
                    this.loadTag(event);
                }else if(actionName == 'list'){
                    //List Node
                    this.loadList(event);
                }else if(actionName == 'field'){
                    //Field Node
                    this.loadField(event);
                }else if(actionName == 'webhook'){
                    //Webhook Node
                    this.loadWebhook(event);
                }else if(actionName == 'status'){
                    //Status Node
                    this.loadStatus(event);
                }else if(actionName == 'segment'){
                    //Status Node
                    this.loadSegment(event);
                }else{
                    //Other Nodes
                }
                this.showLoading(false);
            },
            loadSegment: function(event){
                this.showLoading(true);
                let formData = {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: event,
                };
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowDecisionActionField';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowActionField';
                }
                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        let event = response.data.eventData;
                        let params = JSON.parse(event.data);
                        let segmentParams = params['segment_properties'];
                        this.editActionItem = 'segment';
                        this.selected_action_segments = segmentParams ? segmentParams['segment_ids'] : [];
                        this.editActionEvent = event;
                        this.actionTitle = params['title'];
                        document.querySelector('#slideEditActionItembox').click();
                    }
                });

            },
            loadStatus: function(event){
                this.showLoading(true);
                let formData = {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: event,
                };
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowDecisionActionField';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowActionField';
                }
                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        let event = response.data.eventData;
                        let params = JSON.parse(event.data);
                        let statusParams = params['status_properties'];
                        this.editActionItem = 'status';
                        this.selected_action_status = statusParams ? statusParams['status'] : '';
                        this.editActionEvent = event;
                        this.actionTitle = params['title'];
                        document.querySelector('#slideEditActionItembox').click();
                    }
                });

            },
            loadWebhook: function(event){
                this.showLoading(true);
                let formData = {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: event,
                };
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowDecisionActionField';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowActionField';
                }
                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        let event = response.data.eventData;
                        let params = JSON.parse(event.data);
                        let webhookParams = params['webhook_properties'];
                        this.editActionItem = 'webhook';
                        this.selected_action_webhook_url = webhookParams ? webhookParams['url'] : '';
                        this.selected_action_webhook_data = webhookParams ? webhookParams['webhook_data'] : [];
                        this.selected_action_webhook_method = webhookParams ? webhookParams['method'] : '';
                        this.editActionEvent = event;
                        this.actionTitle = params['title'];
                        document.querySelector('#slideEditActionItembox').click();
                    }
                });

            },
            loadField: function(event){
                this.showLoading(true);
                let formData = {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: event,
                };
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowDecisionActionField';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowActionField';
                }
                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        this.fieldAlias = response.data.fieldAlias;
                        let event = response.data.eventData;
                        let params = JSON.parse(event.data);
                        let filedParams = params['field_properties'];
                        this.editActionItem = 'field';
                        this.selected_action_field_name = filedParams ? filedParams['field_name'] : '';
                        this.selected_action_field_value = filedParams ? filedParams['field_value'] : '';
                        this.editActionEvent = event;
                        this.actionTitle = params['title'];
                        document.querySelector('#slideEditActionItembox').click();
                    }
                });

            },
            loadList: function(event){
                this.showLoading(true);
                let formData = {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: event,
                };
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowDecisionActionField';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowActionField';
                }
                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        let event = response.data.eventData;
                        let params = JSON.parse(event.data);
                        let listParams = params['list_properties'];
                        this.editActionItem = 'list';
                        this.selected_action_lists = listParams ? listParams['list_ids'] : [];
                        this.editActionEvent = event;
                        this.actionTitle = params['title'];
                        document.querySelector('#slideEditActionItembox').click();
                    }
                });

            },
            loadTag: function(event){
                this.showLoading(true);
                let formData = {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: event,
                };
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowDecisionActionField';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowActionField';
                }
                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        let event = response.data.eventData;
                        let params = JSON.parse(event.data);
                        let tagParams = params['tag_properties'];
                        this.editActionItem = 'tag';
                        this.selected_action_tags = tagParams ? tagParams['tag_ids'] : [];
                        this.editActionEvent = event;
                        this.actionTitle = params['title'];
                        document.querySelector('#slideEditActionItembox').click();
                    }
                });

            },
            loadSMS: function(event){
                this.showLoading(true);
                let formData = {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: event,
                };
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowDecisionActionField';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowActionField';
                }
                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        this.selectedSMSNodeData = response.data.smsData;
                        if(response.data.smsData == ''){
                            this.openSMSTemplates(event);
                        }else{
                            this.loadSMSPreview(response.data.smsData.id);
                        }

                    }
                });
            },
            loadEmail: function(event){
                this.showLoading(true);
                let formData = {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: event,
                };
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowDecisionActionField';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowActionField';
                }
                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        this.selectedEmailNodeData = response.data.emailData;
                        if(response.data.emailData == ''){
                            this.openEmailTemplates(event);
                        }else{
                            this.loadEmailPreview(response.data.emailData.id);
                        }

                    }
                });
            },
            loadEmailPreview: function(campaignId){
                this.selected_emailCampaignId = campaignId;
                this.showLoading(true);
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/admin/workflow/previewWorkflowDecisionCampaign';
                }else{
                    url = '/admin/workflow/previewWorkflowCampaign';
                }
                axios.post(url, {
                    _token: this.csrf_token(),
                    moduleName: this.moduleName,
                    campaignId: campaignId,
                    moduleUnitId: this.moduleUnitId,
                })
                    .then(response => {
                        this.showLoading(false);
                        this.content = response.data.content;
                        this.introduction = response.data.introduction;
                        this.greetings = response.data.greeting;
                    });
                document.querySelector('#displayOverviewPreviewForm').click();
            },
            loadSMSPreview: function(campaignId){
                this.showLoading(true);
                this.selected_SMSCampaignId = campaignId;
                axios.post('/admin/workflow/previewWorkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: this.moduleName,
                    campaignId: campaignId,
                    moduleUnitId: this.moduleUnitId,
                })
                    .then(response => {
                        this.showLoading(false);
                        this.smsContent = response.data.content.replace(/\r\n|\r|\n/g, "<br />").replace('wf_edit_sms_template_greeting', 'wf_edit_sms_template_greeting_Preview').replace('wf_edit_sms_template_introduction_EDITOR', 'wf_edit_sms_template_introduction_Preview');
                        this.smsIntroduction = response.data.introduction;
                        this.smsGreetings = response.data.greeting;
                    });
                document.querySelector('#displaySMSPreviewForm').click();
            },
            loadEditDelay: function(event){
                this.delayEditMode = true;
                this.delayEditId = event.id;
                this.delayEditEvent = event;
                let triggerParams = JSON.parse(event.data);
                this.delayProperties = triggerParams['delay_properties'];
                document.querySelector("#slideAddDelaybox").click();
                this.showLoading(false);
            },
            loadSplitProperties: function(event){
                this.splitEditMode = true;
                this.splitEditEvent = event;
                let triggerParams = JSON.parse(event.data);
                let splitId = triggerParams['split_properties']['split_id'];
                if(splitId>0){
                    this.splitEditId = splitId;
                    let formData = {
                        id: splitId,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                    };
                    axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getSplitInfo', formData).then(response => {
                        if(response.data.status == 'success'){
                            this.splitProperties = response.data.splitData;
                            document.querySelector("#slideAddSplitbox").click();
                            this.showLoading(false);
                        }
                    });
                }
                this.showLoading(false);
            },
            loadDecisionProperties: function(event){
                this.decisionEditMode = true;
                this.decisionEditEvent = event;
                let triggerParams = JSON.parse(event.data);
                let decisionId = triggerParams['decision_properties']['decision_id'];
                if(decisionId>0){
                    this.decisionEditId = decisionId;
                    let formData = {
                        id: decisionId,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                    };
                    axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getDecisionInfo', formData).then(response => {
                        if(response.data.status == 'success'){
                            this.decisionProperties = response.data.decisionData;
                            document.querySelector("#slideAddDecisionbox").click();
                            this.showLoading(false);
                        }
                    });
                }
                this.showLoading(false);
            },
            moveWorkflowNode: function(event){
                this.showLoading(true);
                let formData = {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    sourceNode: this.draggableEvent,
                    destinationNode: this.draggedEvent
                };
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/moveWorkflowNode', formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        this.events = response.data.oEvents;
                    }
                });
            },
            clearActionProps: function(){
                this.selectedEvent = '';
            },
            addBlankAction: function(action, nodeCat){
                this.showLoading(true);
                let formData = {
                    nodeType: 'action',
                    name: action,
                    title: this.actionTitle,
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: this.selectedEvent
                };
                let url='';
                if(this.isDecisionNode == true || nodeCat == 'decision'){
                    if(this.actionEditMode == true){
                        url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateWorkflowDecisionBlankAction';
                        formData.id = this.actionEditId;
                        formData.pathId = this.decisionPathId;
                    }else{
                        url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/createWorkflowDecisionBlankAction';
                        formData.pathId = this.decisionPathId;
                    }

                }else{
                    if(this.actionEditMode == true){
                        url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateWorkflowBlankAction';
                        formData.id = this.actionEditId;
                    }else{
                        url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/createWorkflowBlankAction';
                    }
                }

                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        if(this.isDecisionNode == true || this.isSplitNode == true){
                            this.getWorkflowData();
                        }else{
                            this.events = response.data.oEvents;
                            this.metaData.selectedClass = response.data.newEventId;
                        }
                        if (this.actionEditMode == true){
                            this.actionEditMode = false;
                            this.actionEditId = '';
                            this.actionEditEvent = '';
                        }

                    }
                });
            },
            addBlankDecision: function(){
                this.showLoading(true);
                let formData = {
                    nodeType: 'decision',
                    name: 'decision',
                    title: this.decisionProperties.decision_name,
                    decisionData: this.decisionProperties,
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: this.selectedEvent
                };
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/createWorkflowDecisionBlankAction';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/createWorkflowBlankAction';
                }
                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        if(this.isDecisionNode == true){
                            this.getWorkflowData();
                        }else{
                            this.events = response.data.oEvents;
                        }
                        this.metaData.selectedClass = response.data.newEventId;
                    }
                });
            },
            updateDecision: function(){
                this.showLoading(true);
                let formData = {
                    id: this.decisionEditId,
                    decisionData: this.decisionProperties,
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                };
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateDecisionData', formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        this.events = response.data.oEvents;
                        this.displayMessage('success', 'Decision updated successfully!');
                    }
                });
            },
            addDelay: function(event, nodeCat){
                this.showLoading(true);
                let formData = {
                    nodeType: 'delay',
                    name: 'delay',
                    title: 'Wait for '+this.delayProperties.delay_value+' '+ this.capitalizeFirstLetter(this.delayProperties.delay_unit),
                    delayData: this.delayProperties,
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: this.selectedEvent,
                };
                let url = '';
                if(nodeCat == 'decision' || this.isDecisionNode == true){
                    formData.pathId = this.decisionPathId;
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/createWorkflowDecisionBlankAction';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/createWorkflowBlankAction';
                }
                axios.post(url, formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        if(nodeCat == 'decision' || this.isDecisionNode == true){
                            this.getWorkflowData();
                        }else{
                            this.events = response.data.oEvents;
                        }
                        this.metaData.selectedClass = response.data.newEventId;
                    }
                });
            },
            updateDelay: function(){
                this.showLoading(true);
                let formData = {
                    id: this.delayEditId,
                    delayData: this.delayProperties,
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                };
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateEventDelay', formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        this.events = response.data.oEvents;
                        this.displayMessage('success', 'Delay properties updated successfully!');
                    }
                });
            },
            addSplitTest: function(){
                this.showLoading(true);
                let formData = {
                    nodeType: 'split',
                    name: 'split Test',
                    title: this.splitProperties.test_name,
                    splitData: this.splitProperties,
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    eventData: this.selectedEvent,
                };
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/createWorkflowBlankAction', formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        this.events = response.data.oEvents;
                        this.metaData.selectedClass = response.data.newEventId;
                    }
                });
            },
            updateSplitTest: function(){
                this.showLoading(true);
                let formData = {
                    id: this.splitEditId,
                    splitData: this.splitProperties,
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                };
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateSplitData', formData).then(response => {
                    if(response.data.status == 'success'){
                        this.showLoading(false);
                        this.events = response.data.oEvents;
                        this.displayMessage('success', 'Split properties updated successfully!');
                    }
                });
            },
            nodeIcon : function(event){
                let className = JSON.parse(event.data)['node_type'];
                if(className == 'action'){
                    let name = JSON.parse(event.data)['name'];
                    if(name == 'email'){
                        return '<i class="ri-mail-fill"></i>';
                    }else if(name == 'sms'){
                        return '<i class="ri-message-2-fill"></i>';
                    }else if(name == 'field'){
                        return '<i class="ri-layout-left-line"></i>';
                    }else if(name == 'webhook'){
                        return '<i class="ri-link"></i>';
                    }else if(name == 'status'){
                        return '<i class="ri-checkbox-multiple-line"></i>';
                    }else if(name == 'tag'){
                        return '<i class="ri-price-tag-3-fill"></i>';
                    }else if(name == 'list'){
                        return '<i class="ri-list-unordered"></i>';
                    }else{
                        return '<i class="ri-folder-fill"></i>';
                    }

                }else if(className == 'decision'){
                    return '<span class="rotate_45 d-block"><i><img class="align-top mt-1 rotate_45_minus" width="12" src="assets/images/arrow_right_line.svg"/></i></span>';
                }else if(className == 'delay'){
                    return '<i class="ri-time-fill"></i>';
                }else if(className == 'split'){
                    return '<span class="rotate_45_minus d-block"><i><img class="align-top mt-1" width="12" src="assets/images/split-white.svg"/></i></span>';
                }else if(className == 'goal'){
                    return '<i class="ri-folder-fill"></i>';
                }else if(className == 'exit'){
                    return '<i class="ri-folder-fill"></i>';
                }
                return '';
            },
            nodeClass : function(event){
                let className = JSON.parse(event.data)['node_type'];
                if(className == 'action'){
                    return 'bkg_blue_300';
                }else if(className == 'decision'){
                    return 'bkg_decision_300';
                }else if(className == 'delay'){
                    return 'bkg_blue_300 br35';
                }else if(className == 'split'){
                    return 'bkg_email_300 rotate_45';
                }else if(className == 'goal'){
                    return 'bkg_sms_400';
                }else if(className == 'exit'){
                    return 'bkg_dark_100';
                }
                return '';
            },
            nodeType : function(event){
                return JSON.parse(event.data)['node_type'];
            },
            nodeName : function(event){
                let name = JSON.parse(event.data)['name'];
                let displayName = name ? this.capitalizeFirstLetter(name) : 'Empty '+ this.capitalizeFirstLetter(JSON.parse(event.data)['node_type']);
                return displayName;
            },
            nodeTitle : function(event){
                return this.capitalizeFirstLetter(JSON.parse(event.data)['title']);
            },
            clearDelayProperties: function(){
                this.delayEditMode = false;
                this.delayEditEvent = '';
                this.delayEditId = '';
                this.delayProperties = {
                    delay_type: 'after',
                    delay_unit: 'minute',
                    delay_value: 10,
                    delay_paused: false,
                    delay_hour: 8,
                    delay_minute: 30,
                    delay_ampm: 'am',
                    delay_custom_zone: false,
                    delay_time_zone: 'est'
                };
            },
            clearSplitProperties: function(){
                this.splitProperties= {
                    test_name: '',
                    total_path: 2,
                    even_traffic: true,
                    path_a: 75,
                    path_b: 25,
                    path_c: 0,
                    path_d: 0,
                    conditional_split: false,
                    total_sent_to: 500,
                    sent_to: 'a'
                }
            },
            clearDecisionProperties: function(){
                this.decisionProperties = {
                    decision_name: '',
                    decision_type: ''
                }
            },
            onLinearDrag: function(ev, selectedEventData){
                this.isDragStarted = true;
                this.draggableEvent = selectedEventData;
                ev.dataTransfer.setData("nodetype", ev.target.id);
                let elems = document.querySelectorAll(".droppable_grid_linear");
                elems.forEach(function(elem){
                    elem.classList.add('droppable_highlight');
                })
            },
            onLinearStopDrag: function(ev){
                this.isDragStarted = false;
            },
            onDrag: function(ev){
                this.isDragStarted = true;
                this.draggableEvent = '';
                ev.dataTransfer.setData("nodetype", ev.target.id);
                let elems = document.querySelectorAll(".droppable_grid");
                elems.forEach(function(elem){
                    elem.classList.add('droppable_highlight');
                })
            },
            onDrop: function(ev, selectedEventData){
                this.isDragStarted = false;
                this.setActionProps(selectedEventData);
                this.draggedEvent = selectedEventData;
                var nodetype = ev.dataTransfer.getData("nodetype");
                if(nodetype =='action'){
                    this.addBlankAction();
                }else if(nodetype =='decision'){
                    this.addBlankDecision();
                }else if(nodetype =='delay'){
                    this.clearDelayProperties();
                    this.addDelay();
                }else if(nodetype =='split'){
                    this.clearSplitProperties();
                    this.addSplitTest();
                }else if(nodetype =='jsMoveNode'){
                    this.moveWorkflowNode();
                }
                let elems = document.querySelectorAll(".droppable_grid");
                elems.forEach(function(elem){
                    elem.classList.remove('droppable_highlight');
                })

            },
            openEmailTemplates: function(event){
                this.showEmailTemplates = true;
                this.showSMSTemplates = false;
                this.configureWorkflow = false;
                document.querySelector("#hideOverviewPreviewForm").click();
            },
            closeEmailTemplates: function(){
                this.showEmailTemplates = false;
                this.showSMSTemplates = false;
                this.configureWorkflow = true;
            },
            openSMSTemplates: function(event){
                this.showSMSTemplates = true;
                this.showEmailTemplates = false;
                this.configureWorkflow = false;
                document.querySelector('#hideSMSPreviewForm').click();
            },
            closeSMSTemplates: function(){
                this.showSMSTemplates = false;
                this.showEmailTemplates = false;
                this.configureWorkflow = true;
            },
            setEmailCampaignId: function(id, templateName){
                /*this.emailCampaignId = id;
                this.emailTemplate.template_name = templateName;*/
            },
            setSMSCampaignId: function(id, templateName, oCampaign){
                /*this.smsCampaignId = id;
                this.smsTemplate.template_name = templateName;
                this.smsData = oCampaign;    */
            },
            saveSMSEditChanges: function(){
                this.showLoading(true);
                axios.post('/admin/workflow/updateWorkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: this.moduleName,
                    greeting: this.smsGreetings,
                    introduction: this.smsIntroduction,
                    campaignId: this.selected_SMSCampaignId,
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.showLoading(false);
                            this.displayMessage('success', 'Saved changes successfully!');
                        }
                    });
            },
            saveEditChanges: function(){
                this.showLoading(true);
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/admin/workflow/updateWorkflowDecisionCampaign';
                }else{
                    url = '/admin/workflow/updateWorkflowCampaign';
                }
                axios.post(url, {
                    _token: this.csrf_token(),
                    moduleName: this.moduleName,
                    greeting: this.greetings,
                    introduction: this.introduction,
                    campaignId: this.selected_emailCampaignId,
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.showLoading(false);
                            this.displayMessage('success', 'Saved changes successfully!');
                        }
                    });
            },
            sendTestEmail: function(){
                this.showLoading(true);
                let url = '';
                if(this.isDecisionNode == true){
                    url = '/admin/workflow/sendTestEmailworkflowDecisionCampaign';
                }else{
                    url = '/admin/workflow/sendTestEmailworkflowCampaign';
                }
                axios.post(url, {
                    _token: this.csrf_token(),
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    campaignId: this.selected_emailCampaignId,
                    email: this.user.email
                })
                    .then(response => {
                        if(response.data.status == 'success'){this.displayMessage('success', 'Saved changes successfully!');
                            this.showLoading(false);
                            this.displayMessage('success', 'Test email sent successfully!');
                        }
                    });
            },
            sendTestSMS: function(){
                this.showLoading(true);
                axios.post('/admin/workflow/sendTestSMSworkflowCampaign', {
                    _token: this.csrf_token(),
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    campaignId: this.selected_SMSCampaignId,
                    number: this.user.phone
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.showLoading(false);
                            this.displayMessage('success', 'Test email sent successfully!');
                        }
                    });
            },
            addToTags: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                axios.post('/admin/workflow/addTagToWorkflowCampaign', {
                    tagId: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.syncWorkflowAudience();
                    });
            },
            addToList: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                axios.post('/admin/workflow/addListToWorkflowCampaign', {
                    selectedLists: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.syncWorkflowAudience();
                    });
            },
            addToSegments: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                axios.post('/admin/workflow/addSegmentToWorkflowCampaign', {
                    segmentId: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.syncWorkflowAudience();
                    });
            },
            addToContact: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                axios.post('/admin/workflow/addContactToWorkflowCampaign', {
                    contactId: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.syncWorkflowAudience();
                    });
            },
            syncWorkflowAudience : function(){
                axios.post('/admin/workflow/syncWorkflowAudience', {
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    _token: this.csrf_token()
                }).then(response => {

                });
            },
            updateActionTags: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                let event = this.editActionEvent;
                let params = JSON.parse(event.data);
                let tagParams = params['tag_properties'];
                let tagIds = tagParams ? tagParams['tag_ids'] : [];
                if(actionName == 'addRecord'){
                    if(tagIds.indexOf(id) === -1){
                        tagIds.push(id);
                    }
                }else if(actionName == 'deleteRecord'){
                    if(tagIds.indexOf(id) > -1){
                        tagIds.splice(tagIds.indexOf(id), 1);
                    }
                }
                params['title'] = this.actionTitle;
                params['tag_properties'] = {tag_ids:tagIds};
                this.selected_action_tags = tagIds;
            },
            updateActionSegments: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                let event = this.editActionEvent;
                let params = JSON.parse(event.data);
                let segmentParams = params['segment_properties'];
                let segmentIds = segmentParams ? segmentParams['segment_ids'] : [];
                if(actionName == 'addRecord'){
                    if(segmentIds.indexOf(id) === -1){
                        segmentIds.push(id);
                    }
                }else if(actionName == 'deleteRecord'){
                    if(segmentIds.indexOf(id) > -1){
                        segmentIds.splice(segmentIds.indexOf(id), 1);
                    }
                }
                params['title'] = this.actionTitle;
                params['segment_properties'] = {segment_ids:segmentIds};
                this.selected_action_segments = segmentIds;
            },
            updateActionLists: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                let event = this.editActionEvent;
                let params = JSON.parse(event.data);
                let listParams = params['list_properties'];
                let listIds = listParams ? listParams['list_ids'] : [];
                if(actionName == 'addRecord'){
                    if(listIds.indexOf(id) === -1){
                        listIds.push(id);
                    }
                }else if(actionName == 'deleteRecord'){
                    if(listIds.indexOf(id) > -1){
                        listIds.splice(listIds.indexOf(id), 1);
                    }
                }
                params['title'] = this.actionTitle;
                params['list_properties'] = {list_ids:listIds};
                this.selected_action_lists = listIds;
            },
            updateTriggerData: function(event, params){
                let url='';
                if(this.isDecisionNode == true){
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateDecisionTriggerData';
                }else{
                    url = '/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateTriggerData';
                }
                axios.post(url, {
                    id: event.id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    params: params,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.getWorkflowData();
                            this.displayMessage('success', 'Changes updated successfully');
                        }
                    });
            },
            updateActionItem: function(){
                let event = this.editActionEvent;
                let params = JSON.parse(event.data);
                if(this.editActionItem =='tag'){
                    let tagParams = params['tag_properties'];
                    params['title'] = this.actionTitle;
                    params['tag_properties'] = {tag_ids:this.selected_action_tags};
                    this.updateTriggerData(event, params);
                }else if(this.editActionItem =='list'){
                    let tagParams = params['list_properties'];
                    params['title'] = this.actionTitle;
                    params['list_properties'] = {list_ids:this.selected_action_lists};
                    this.updateTriggerData(event, params);
                }else if(this.editActionItem =='field'){
                    let tagParams = params['field_properties'];
                    params['title'] = this.actionTitle;
                    params['field_properties'] = {field_name:this.selected_action_field_name, field_value:this.selected_action_field_value};
                    this.updateTriggerData(event, params);
                }else if(this.editActionItem =='webhook'){
                    let tagParams = params['webhook_properties'];
                    params['title'] = this.actionTitle;
                    params['webhook_properties'] = {url:this.selected_action_webhook_url, webhook_data: this.selected_action_webhook_data, method:this.selected_action_webhook_method};
                    this.updateTriggerData(event, params);
                }else if(this.editActionItem =='status'){
                    let tagParams = params['status_properties'];
                    params['title'] = this.actionTitle;
                    params['status_properties'] = {status:this.selected_action_status};
                    this.updateTriggerData(event, params);
                }else if(this.editActionItem =='segment'){
                    let tagParams = params['segment_properties'];
                    params['title'] = this.actionTitle;
                    params['segment_properties'] = {segment_ids:this.selected_action_segments};
                    this.updateTriggerData(event, params);
                }

            },
            updateFieldAlias: function(){
                this.showLoading(true);
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateCustomFields', {
                    customFieldData: this.fieldAlias,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            this.showLoading(false);
                            this.fieldAlias = response.data.fieldAlias;
                            this.displayMessage('success', 'Changes updated successfully');
                        }
                    });
            },
            addWebhookParam: function(){
                this.selected_action_webhook_data.push({field:'', value:''})
            },
            removeWebhookParam: function(i){
                this.selected_action_webhook_data.splice(i, 1);
            },
            loadCategoriedTemplates: function(data){
                if(data.actionName == 'static'){
                    this.getWorkflowData();
                    return;
                }
                this.showLoading(true);
                axios.post('/admin/templates/getCategorizedTemplates?page=' + data.currentPage+'&searchBy='+data.searchBy, {
                    'action':data.actionName,
                    'campaign_type':data.campaign_type,
                    'method': 'manage'
                    })
                    .then(response => {
                        if(data.campaign_type == 'email'){
                            this.emailTemplates = response.data.oTemplates;
                        }
                        if(data.campaign_type == 'sms'){
                            this.smsTemplates = response.data.oTemplates;
                        }
                        this.allDataTemplates = response.data.allData;
                        this.showLoading(false);
                    });
            },
            deleteWorkflowEvent: function(event, popupId){
                if(confirm('Are you sure you want to delete this node?')){
                    this.deleteWorkflowNode(event);
                    document.querySelector("#"+popupId).click();
                }
            },
            editNode: function(event){
                this.metaData.selectedClass=event.id;
                let nodeType = JSON.parse(event.data)['node_type'];
                if(nodeType == 'goal'){
                    this.metaData.selectedClass='goal';
                }
                this.editWorkflowNode(nodeType, event);
            },
        },
    }
    function triggerSplitSlider(){
        triggerSlider();
    }
    $(document).ready(function(){
        $(document).on("click", "#displayOverviewPreviewForm", function(){
            $("#EditOverviewPreview").modal('show');
        })
        $(document).on("click", "#hideOverviewPreviewForm", function(){
            $("#EditOverviewPreview").modal('hide');
        })
        $(document).on("click", "#displaySMSPreviewForm", function(){
            $("#EditSMSPreview").modal('show');
        })
        $(document).on("click", "#hideSMSPreviewForm", function(){
            $("#EditSMSPreview").modal('hide');
        })

    });
</script>
<style>
    .slider.slider-horizontal{ width:100%; margin:15px 0 20px}
    #ex1Slider .slider-handle{ width:24px; height:24px; background:#B4C0D4; border: 6px solid #FFFFFF;
        box-shadow: 0px 0px 1px rgba(0, 16, 47, 0.08), 0px 1px 1px rgba(0, 21, 62, 0.06); top:-2px;}
    #ex1Slider .slider-track{ background:#7ECD99}
    #ex1Slider .slider-selection {	background: #4489F2;}

    .workflowtopbar {
     background: #ffffff !important;
    }

    .workflowSelectedBorder {
        border:2px solid #97A4BD;
    }
    .workflow_box .droppable_highlight{border:none !important; height: 57px !important; background: none !important; border-style: none !important;}
    .workflow_box .droppable_highlight:before{ height:36px!important; border-radius:100px!important; width:36px!important;position:absolute; content:''; left:50%; top:12px; background: #73ABFF;opacity: 0.1; margin-left:-18px; }
    .workflow_box .droppable_highlight .workflowadds{ background:#73ABFF!important}
    .workflow_list_new .droppable_highlight{
        border:1px solid #4489F2 !important;
        height: 3px !important;
        background: #4489F2 !important;
        border-style: dashed !important;
        margin-top:-11px;
        margin-bottom: 8px;
    }

</style>
