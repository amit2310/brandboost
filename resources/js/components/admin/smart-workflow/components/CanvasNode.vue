<template>
    <div class="row" style="margin-left:0px;margin-right:0px;">
        <!--Connector-->
        <div class="col-12 text-center droppable_grid" @drop="onDrop($event)" @dragover="$event.preventDefault()">
            <a class="workflowadds slideAddNodebox" href="javascript:void(0);" @click="prepareToAddAction"><i class="ri-add-fill"></i></a>
        </div>

        <!--Connector-->

        <!--Empty Node-->
        <div v-if="nodeType != 'split'" class="col-md-12 mb0">
            <div class="workflow_box" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="workflow_card" :class="nodeSelectedClass" @click="editNode">
                            <div class="wf_icons br12" :class="nodeClass">
                                <img v-if="nodeType=='action'" width="18" src="assets/images/flashlight-fill-white.svg">
                                <img v-if="nodeType=='decision'" class="rotate_45_minus" width="18" src="assets/images/arrow_right_line.svg">
                                <img v-if="nodeType=='delay'" width="18" src="assets/images/time-fill-14.svg">
                                <img v-if="nodeType=='split'" width="18" src="assets/images/split-white.svg">
                                <img v-if="nodeType=='goal'" width="18" src="assets/images/checkbox-circle-fill-white.svg">
                                <img v-if="nodeType=='exit'" width="18" src="assets/images/flag-2-fill.svg">
                            </div>
                            <div class="edit_delete" v-if="nodeName.toLowerCase() == 'email' || nodeName.toLowerCase() == 'sms'">
                                <a href="javascript:void(0);" @click="deleteEvent"><i class="icon-bin2 fsize10 dark_100"></i></a>
                            </div>
                            <p class="dark_100 fsize11 fw500 mb-1 text-uppercase ls_4">{{nodeType.toUpperCase()}}</p>
                            <template v-if="nodeType.toLowerCase() == 'delay'">
                                <p class="dark_600 fsize13 fw500 mb15" v-if="nodeTitle">{{capitalizeFirstLetter(nodeTitle)}}</p>
                                <p class="dark_200 fsize13 fw500 mb15 ls4" v-else>Empty Delay </p>
                            </template>
                            <template v-if="nodeType.toLowerCase() == 'decision'">
                                <p class="dark_600 fsize13 fw500 mb15" v-if="nodeTitle">{{capitalizeFirstLetter(nodeTitle)}}</p>
                                <p class="dark_200 fsize13 fw500 mb15 ls4" v-else>Empty Decision</p>
                            </template>
                            <template v-if="nodeType.toLowerCase() == 'action'">
                                <p class="dark_600 fsize13 fw500 mb15" v-if="nodeName && (nodeName.toLowerCase() == 'email' || nodeName.toLowerCase() == 'sms')">{{nodeName}}</p>
                                <p class="dark_600 fsize13 fw500 mb15" v-else-if="nodeNameDescription">{{nodeNameDescription}}</p>
                                <p class="dark_200 fsize13 fw500 mb15 ls4" v-else>Empty Action</p>
                            </template>
                            <template v-if="nodeType.toLowerCase() == 'split'">
                                <p class="dark_600 fsize13 fw500 mb15" v-if="nodeTitle">{{capitalizeFirstLetter(nodeTitle)}}</p>
                                <p class="dark_200 fsize13 fw500 mb15 ls4" v-else>Empty Split</p>
                            </template>
                            <div class="p0 pt12 btop">
                                <ul class="workflow_list">
                                    <li style="border:none;">
                                        <a class="blue_300 fw500 fsize11" href="javascript:void(0);" v-if="nodeType.toLowerCase() == 'delay'">
                                            <span class="d-inline-block"><i class="ri-time-fill blue_300 fsize15"></i></span>  {{delayTime}}
                                        </a>
                                        <a
                                            :class="decisionClass"
                                            href="javascript:void(0);"
                                            v-else-if="nodeType.toLowerCase() == 'decision'"
                                            v-html="decisionTitle"
                                        >
                                        </a>
                                        <a class="blue_300 fw500 fsize11" href="javascript:void(0);" v-else-if="nodeTitle">
                                            <span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> {{nodeTitle ? nodeTitle : 'ADD ACTION'}}
                                        </a>
                                        <a class="blue_300 fw500 fsize11" href="javascript:void(0);" v-else>
                                            <span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> ADD ACTION
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Empty Node-->

        <!--Empty Decision Node-->
        <template v-if="nodeType == 'decision'">
            <!--=====Split Image top=============-->
            <div class="col-md-12 text-center">
                <img src="assets/images/wfline.png">
            </div>
            <!--=====ADD nodes 2 circle icon ========-->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-6 text-center"> <div class="workflow_switch_div_small canvas mb20 mt20 text-center d-inline-block" :style="decisionEventsPathA ? 'width:auto;margin-bottom:0px!important;': 'width:auto;'"> <a class="workflow_switch dark_400 fw400 fsize13" href="#"><i class="ri-pie-chart-2-fill dark_100 fsize11"></i> Free Customers </a> <!--<a class="" href="#"> <i class="icon-bin2 fsize10 dark_100"></i></a>--> </div> </div>
                    <div class="col-6 text-center"> <div class="workflow_switch_div_small canvas mb20 mt20 text-center d-inline-block" :style="decisionEventsPathB ? 'width:auto;margin-bottom:0px!important;': 'width:auto;'"> <a class="workflow_switch dark_400 fw400 fsize13" href="#"><i class="ri-pie-chart-2-fill dark_100 fsize11"></i> Have not logged in ... </a> <!--<a class="" href="#"> <i class="icon-bin2 fsize10 dark_100"></i></a>--> </div> </div>
                </div>
            </div>
            <!--=====Splited two cards ========-->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 vline">
                        <!--Nodes-->
                        <canvas-decision-node
                            v-for="oEvent in decisionEventsPathA"
                            :event="oEvent"
                            :unitInfo="unitInfo"
                            :metaData="metaData"
                            :moduleName="moduleName"
                            :moduleUnitId="moduleUnitId"
                            :key="oEvent.id"
                            @setAddActionPropsDecision="setAddActionPropsDecision"
                            @deleteEventNodeDecision="deleteEventNodeDecision"
                            @editEventNodeDecision="editEventNodeDecision"
                            @createBlankActionDecision="createBlankActionDecision"
                            @createBlankDelayDecision="createBlankDelayDecision"
                        ></canvas-decision-node>

                        <!--Connector-->
                        <div v-if="decisionEventsPathA" class="col-12 text-center droppable_grid" @drop="onDrop($event)" @dragover="$event.preventDefault()">
                            <a class="workflowadds slideAddNodebox" href="javascript:void(0);" @click="addCoherentActionDecision(decisionPathA)"><i class="ri-add-fill"></i></a>
                        </div>
                        <div v-else class="workflow_card top_line_20 slideAddNodebox" @click="addCoherentActionDecision(decisionPathA)" @drop="onDrop($event)" @dragover="$event.preventDefault()" style="cursor:pointer;">
                            <img class="mb-2" src="assets/images/plus_circle_36.svg"><br>
                            <a class="blue_300 fw500 fsize11" href="javascript:void(0);"> ADD NODE</a>
                        </div>
                        <!--Connector-->
                    </div>
                    <div class="col-md-6 vline">
                        <!--Nodes-->
                        <canvas-decision-node
                            v-for="oEvent in decisionEventsPathB"
                            :event="oEvent"
                            :unitInfo="unitInfo"
                            :metaData="metaData"
                            :moduleName="moduleName"
                            :moduleUnitId="moduleUnitId"
                            :key="oEvent.id"
                            @setAddActionPropsDecision="setAddActionPropsDecision"
                            @deleteEventNodeDecision="deleteEventNodeDecision"
                            @editEventNodeDecision="editEventNodeDecision"
                            @createBlankActionDecision="createBlankActionDecision"
                            @createBlankDelayDecision="createBlankDelayDecision"
                        ></canvas-decision-node>

                        <!--Connector-->
                        <div v-if="decisionEventsPathB" class="col-12 text-center droppable_grid" @drop="onDrop($event)" @dragover="$event.preventDefault()">
                            <a class="workflowadds slideAddNodebox" href="javascript:void(0);" @click="addCoherentActionDecision(decisionPathB)"><i class="ri-add-fill"></i></a>
                        </div>
                        <div v-else class="workflow_card top_line_20 slideAddNodebox" @click="addCoherentActionDecision(decisionPathB)" @drop="onDrop($event)" @dragover="$event.preventDefault()" style="cursor:pointer;">
                            <img class="mb-2" src="assets/images/plus_circle_36.svg"><br>
                            <a class="blue_300 fw500 fsize11" href="javascript:void(0);"> ADD NODE</a>
                        </div>
                        <!--Connector-->
                    </div>
                </div>
            </div>
            <!--=====Split Image bot=============-->
            <div class="col-md-12"><img src="assets/images/wfline_reverse.png"></div>

        </template>
        <!--Empty Split Node-->

        <!--Empty Split Node-->
        <template v-if="nodeType == 'split'">
            <div class="col-md-12">
                <div class="workflow_switch_div_small canvas mb0 mt0 d-inline-block" style="width:auto;">
                    <a class="workflow_switch" href="javascript:void(0);"> <i><img src="assets/images/play_split.svg"/></i> SPLIT </a> &nbsp;
                    <a class="workflow_switch active" href="javascript:void(0);">
                        <template v-if="splitNodeInfo.total_path==2">{{splitNodeInfo.path_a+'/'+splitNodeInfo.path_b}}</template>
                        <template v-else-if="splitNodeInfo.total_path==3">{{splitNodeInfo.path_a+'/'+splitNodeInfo.path_b+'/'+splitNodeInfo.path_c}}</template>
                        <template v-else-if="splitNodeInfo.total_path==4">{{splitNodeInfo.path_a+'/'+splitNodeInfo.path_b+'/'+splitNodeInfo.path_c+'/'+splitNodeInfo.path_d}}</template>
                    </a>
                    <a href="javascript:void(0);" @click="editNode"><i class="icon-gear fsize12 dark_100"></i></a>&nbsp;
                    <a class="workflow_switch" href="javascript:void(0);" @click="deleteEvent"> <i class="icon-bin2 fsize10 dark_100"></i></a>
                </div>
            </div>
            <!--=====Split Image top==============-->
            <div class="col-md-12 text-center">
                <div class="split_icons_ab">
                    <span class="circle-icon-20 bkg_light_000 br35 dark_100 shadow3">a</span>
                    <span class="circle-icon-20 bkg_light_000 br35 dark_100 shadow3">b</span>
                </div>
                <img src="assets/images/wfline.png"></div>
            <!--=====ADD nodes 2 circle icon ========-->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-6 text-center"> <a class="workflowadds slidebox mt-2" href="javascript:void(0);"><i class="ri-add-fill"></i></a> </div>
                    <div class="col-6 text-center"> <a class="workflowadds slidebox mt-2" href="javascript:void(0);"><i class="ri-add-fill"></i></a> </div>
                </div>
            </div>
            <!--=====Splited two cards ========-->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="workflow_card top_line_20">
                            <img class="mb-2" src="assets/images/plus_circle_36.svg"/><br>
                            <a class="blue_300 fw500 fsize11" href="javascript:void(0);"> ADD NODE</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="workflow_card top_line_20">

                            <img class="mb-2" src="assets/images/plus_circle_36.svg"/><br>

                            <a class="blue_300 fw500 fsize11" href="javascript:void(0);"> ADD NODE</a>

                        </div>
                    </div>
                </div>
            </div>
            <!--=====ADD nodes 2 circle plus icon ========-->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-6 text-center"> <a class="workflowadds slidebox mt-4 mb-2" href="javascript:void(0);"><i class="ri-add-fill"></i></a> </div>
                    <div class="col-6 text-center"> <a class="workflowadds slidebox mt-4 mb-2" href="javascript:void(0);"><i class="ri-add-fill"></i></a> </div>
                </div>
            </div>
            <!--=====Split Image bot=============-->
            <div class="col-md-12">
                <img src="assets/images/wfline_reverse.png">
            </div>
        </template>
        <!--Empty Split Node-->
    </div>
</template>
<script>
    import CanvasDecisionNode from "./CanvasDecisionNode";
    export default {
        props: ['event', 'unitInfo', 'metaData', 'moduleName', 'moduleUnitId'],
        components: {CanvasDecisionNode},
        data(){
          return {
              column_index: 0,
              splitNodeInfo: '',
              decisionNodeInfo: '',
              decisionEventsPathA: '',
              decisionEventsPathB: '',
              decisionPathA: '',
              decisionPathB: ''
          }
        },
        mounted() {
            if(this.nodeType == 'split'){
                this.getSplitNodeInfo(this.event);
            }
            if(this.nodeType == 'decision'){
                this.getDecisionNodeInfo(this.event);
            }
        },
        computed :{
            nodeSelectedClass : function(){
                if(this.metaData.selectedClass == this.event.id){
                    let className = JSON.parse(this.event.data)['node_type'];
                    if(className == 'action'){
                        return 'workflowSelectedBorder';
                    }else if(className == 'decision'){
                        return 'decision_border2';
                    }else if(className == 'delay'){
                        return 'workflowSelectedBorder';
                    }else if(className == 'split'){
                        return 'workflowSelectedBorder';
                    }else if(className == 'goal'){
                        return 'workflowSelectedBorder';
                    }else if(className == 'exit'){
                        return 'workflowSelectedBorder';
                    }
                    return '';
                }
            },
            nodeClass : function(){
                let className = JSON.parse(this.event.data)['node_type'];
                if(className == 'action'){
                    return 'bkg_blue_300';
                }else if(className == 'decision'){
                    return 'bkg_decision_300 rotate_45';
                }else if(className == 'delay'){
                    return 'bkg_reviews_300';
                }else if(className == 'split'){
                    return 'bkg_email_300';
                }else if(className == 'goal'){
                    return 'bkg_sms_400';
                }else if(className == 'exit'){
                    return 'bkg_dark_100';
                }
                return '';
            },
            nodeType : function(){
                return JSON.parse(this.event.data)['node_type'];
            },
            nodeName : function(){
                return this.capitalizeFirstLetter(JSON.parse(this.event.data)['name']);
            },
            nodeTitle : function(){
                return this.capitalizeFirstLetter(JSON.parse(this.event.data)['title']);
            },
            nodeNameDescription: function(){
                if(this.nodeName.toLowerCase() == 'field'){
                    return 'People Field';
                }else if(this.nodeName.toLowerCase() == 'tag'){
                    return 'People Tag';
                }else if(this.nodeName.toLowerCase() == 'list'){
                    return 'People List';
                }else if(this.nodeName.toLowerCase() == 'segment'){
                    return 'People Segment';
                }else if(this.nodeName.toLowerCase() == 'contact'){
                    return 'People Contact';
                }else if(this.nodeName.toLowerCase() == 'status'){
                    return 'People Status';
                }else if(this.nodeName.toLowerCase() == 'webhook'){
                    return 'Webhook';
                }
            },
            delayTime: function(){
                let delayProps = JSON.parse(this.event.data)['delay_properties'];
                return 'At '+ delayProps['delay_hour']+':'+delayProps['delay_minute']+ ' '+ delayProps['delay_ampm'].toUpperCase();
            },
            decisionTitle: function(){
                let decisionProps = JSON.parse(this.event.data)['decision_properties'];
                if(decisionProps['type'] == 'segment'){
                    return '<span class="d-inline-block"><i class="ri-pie-chart-2-fill decision_300  fsize15"></i></span> Segments Split';
                }
                else if(decisionProps['type'] == 'attribute'){
                    return '<span class="d-inline-block"><i class="ri-pie-chart-2-fill decision_300  fsize15"></i></span> Attributes Split';
                }else{
                    return '<span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> SET UP DECISION';
                }
            },
            decisionClass: function(){
                let decisionProps = JSON.parse(this.event.data)['decision_properties'];
                if(decisionProps['type'] == 'segment'){
                    return 'dark_200 fsize12';
                }
                else if(decisionProps['type'] == 'attribute'){
                    return 'dark_200 fsize12';
                }else{
                    return 'decision_300 fw500 fsize11';
                }
            }

        },
        methods: {
            prepareToAddAction: function(){
                this.$emit('setAddActionProps', this.event);
            },
            deleteEvent: function(){
                if(confirm("Are you sure you want to delete this node?")){
                    this.$emit('deleteEventNode', this.event);
                }
            },
            onDrop: function(ev){
                var nodetype = ev.dataTransfer.getData("nodetype");
                this.prepareToAddAction();
                if(nodetype =='action'){
                    this.$emit('createBlankAction');
                }else if(nodetype =='decision'){
                    this.$emit('createBlankDecision');
                }else if(nodetype =='delay'){
                    this.$emit('createBlankDelay');
                }
                let elems = document.querySelectorAll(".droppable_grid");
                elems.forEach(function(elem){
                    elem.classList.remove('droppable_highlight');
                })

            },
            editNode: function(){
                this.metaData.selectedClass=this.event.id;
                this.$emit('editEventNode', this.nodeType, this.event);
            },
            getDecisionPathEvents: function(id, pathName){
                let formData = {
                    pathId: id,
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                };
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getWorkflowDecisionData', formData).then(response => {
                    if(response.data.status == 'success'){
                        if(pathName == 'A'){
                            this.decisionEventsPathA = response.data.oEvents;
                        }
                        if(pathName == 'B'){
                            this.decisionEventsPathB = response.data.oEvents;
                        }
                    }
                });
            },
            getSplitNodeInfo: function(event){
                let triggerParams = JSON.parse(event.data);
                let splitId = triggerParams['split_properties']['split_id'];
                if(splitId>0){
                    let formData = {
                        id: splitId,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                    };
                    axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getSplitInfo', formData).then(response => {
                        if(response.data.status == 'success'){
                            this.splitNodeInfo = response.data.splitData;
                        }
                    });
                }

            },
            getDecisionNodeInfo: function(event){
                let triggerParams = JSON.parse(event.data);
                let decisionId = triggerParams['decision_properties']['decision_id'];
                let pathA = triggerParams['decision_properties']['pathA'];
                let pathB = triggerParams['decision_properties']['pathB'];
                if(pathA>0){
                    this.decisionPathA = pathA;
                    this.getDecisionPathEvents(pathA, 'A');
                }
                if(pathB>0){
                    this.decisionPathB = pathB;
                    this.getDecisionPathEvents(pathB, 'B');
                }
                if(decisionId>0){
                    let formData = {
                        id: decisionId,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                    };
                    axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getDecisionInfo', formData).then(response => {
                        if(response.data.status == 'success'){
                            this.decisionNodeInfo = response.data.decisionData;
                        }
                    });
                }

            },
            setAddActionPropsDecision: function(event){
                this.$emit('setAddActionProps', event, 'decision');
            },
            deleteEventNodeDecision: function(event){
                this.$emit('deleteEventNode', event, 'decision');
            },
            editEventNodeDecision: function(nodeType, event){
                this.$emit("editEventNode", nodeType, event, 'decision');
            },
            createBlankActionDecision: function(event){
                this.$emit("createBlankAction", event, 'decision');
            },
            createBlankDelayDecision: function(event){
                this.$emit("createBlankDelay", 'decision');
            },
            addCoherentActionDecision: function(pathId){
                this.$emit('addCoherentAction', 'decision', pathId);
            }
        }
    };
</script>
