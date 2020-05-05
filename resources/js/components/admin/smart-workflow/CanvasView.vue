<template>
    <div class="row">

        <div class="col-md-12 mb-3">
            <div class="workflow_box" id="canvasDragger" style="position:relative;top:0px;cursor:move;">
                <div class="row">
                    <!--Trigger-->
                    <div class="col-md-12">
                        <div class="workflow_box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="workflow_card slideTriggerbox" :class="{'workflowSelectedBorder': metaData.selectedClass == 'trigger'}" @click="metaData.selectedClass='trigger'">
                                        <div class="wf_icons br12 bkg_dark_100 rotate_45 border"><img class="rotate_45_minus small" src="assets/images/play_white_small.svg"></div>
                                        <p class="dark_200 fsize11 fw500 mb-1 text-uppercase ls_4">TRIGGER </p>
                                        <p class="dark_600 fsize13 fw500 mb15" v-if="unitInfo.workflow_entry_trigger">{{triggerName}}</p>
                                        <p class="dark_200 fsize13 fw500 mb15 ls4" v-else>Entry Trigger </p>
                                        <div class="p0 pt12 btop">
                                            <ul class="workflow_list">
                                                <li style="border:none;">
                                                    <a class="dark_200 fsize12" href="javascript:void(0);" v-if="unitInfo.workflow_entry_trigger">
                                                        <span class="d-inline-block"><i class="ri-file-list-2-fill blue_300 fsize15"></i></span> Lead Form Home
                                                    </a>
                                                    <a class="blue_300 fw500 fsize11" href="javascript:void(0);" v-else>
                                                        <span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> ADD TRIGGER
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Trigger-->

                    <!--Nodes-->
                    <canvas-node
                        v-for="oEvent in events"
                        :event="oEvent"
                        :unitInfo="unitInfo"
                        :metaData="metaData"
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        :key="oEvent.id"
                        @setAddActionProps="setAddActionProps"
                        @deleteEventNode="deleteEventNode"
                        @editEventNode="editEventNode"
                        @createBlankAction="createBlankAction"
                        @createBlankDecision="createBlankDecision"
                        @createBlankDelay="createBlankDelay"
                    ></canvas-node>
                    <!--Nodes-->

                    <!--Connector-->
                    <div class="col-12 text-center droppable_grid" @drop="onDrop($event)" @dragover="$event.preventDefault()">
                        <a class="workflowadds slideAddNodebox" href="javascript:void(0);" @click="addCoherentAction"><i class="ri-add-fill"></i></a>
                    </div>
                    <!--Connector-->

                    <!--Goal-->
                    <div class="col-md-12 mb-3">
                        <div class="workflow_box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="workflow_card slideGoalbox" :class="{'workflowSelectedBorder': metaData.selectedClass == 'goal'}" @click="metaData.selectedClass='goal'">
                                        <div class="wf_icons br12 bkg_dark_100 rotate_45 border"><img class="rotate_45_minus small" src="assets/images/play_white_small.svg"></div>
                                        <p class="dark_200 fsize11 fw500 mb-1 text-uppercase ls_4">GOAL </p>
                                        <p class="dark_200 fsize13 fw500 mb15 ls4" v-if="unitInfo.workflow_goal">{{capitalizeFirstLetter(unitInfo.workflow_goal)}} </p>
                                        <p class="dark_200 fsize13 fw500 mb15 ls4" v-else>Empty Goal </p>
                                        <div class="p0 pt12 btop">
                                            <ul class="workflow_list">
                                                <li style="border:none;">
                                                    <a class="blue_300 fw500 fsize11" href="javascript:void(0);" v-if="unitInfo.workflow_goal">
                                                        <span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> {{capitalizeFirstLetter(unitInfo.workflow_goal)}}
                                                    </a>
                                                    <a class="blue_300 fw500 fsize11" href="javascript:void(0);" v-else>
                                                        <span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> ADD GOAL
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Goal-->

                </div>
            </div>
        </div>


    </div>
</template>
<script>
    import CanvasNode from "./components/CanvasNode";
    export default {
        components: {CanvasNode},
        props: ['events', 'unitInfo', 'metaData', 'moduleName', 'moduleUnitId'],
        data(){
            return {
                viewType: 'list',
            }
        },
        computed: {
            triggerName : function(){
                if(this.unitInfo.workflow_entry_trigger.toLowerCase() == 'contact'){
                    return 'Added Contact';
                }else if(this.unitInfo.workflow_entry_trigger.toLowerCase() == 'tags'){
                    return 'Applied Tag';
                }else if(this.unitInfo.workflow_entry_trigger.toLowerCase() == 'lists'){
                    return 'Added to List';
                }else if(this.unitInfo.workflow_entry_trigger.toLowerCase() == 'segment'){
                    return 'Added to Segment';
                }else if(this.unitInfo.workflow_entry_trigger.toLowerCase() == 'form'){
                    return 'Submitted a form';
                }
            }
        },
        methods: {
            setAddActionProps: function(eventData){
                this.$emit("setActionProps", eventData);
            },
            deleteEventNode: function(eventData){
                this.$emit("deleteWorkflowNode", eventData);
            },
            editEventNode: function(nodeType, eventData){
                this.$emit("editWorkflowNode", nodeType, eventData);
            },
            createBlankAction: function(eventData){
                this.$emit("addBlankAction", eventData);
            },
            createBlankDecision: function(eventData){
                this.$emit("addBlankDecision", eventData);
            },
            createBlankDelay: function(eventData){
                this.$emit("addDelay", eventData);
            },
            addCoherentAction: function(){
                this.metaData.selectedClass = '';
                this.$emit("setActionProps");
            },
            onDrop: function(ev){
                var nodetype = ev.dataTransfer.getData("nodetype");
                if(nodetype =='action'){
                    this.createBlankAction();
                }else if(nodetype =='decision'){
                    this.createBlankDecision();
                }else if(nodetype =='delay'){
                    this.createBlankDelay();
                }
                let elems = document.querySelectorAll(".droppable_grid");
                elems.forEach(function(elem){
                    elem.classList.remove('droppable_highlight');
                })

            }
        }
    }
</script>
