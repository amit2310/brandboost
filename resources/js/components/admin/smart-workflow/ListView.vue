<template>
    <div class="row">
        <!--Fixed Trigger Node-->
        <div class="col-12">
            <div class="card p35 br6 mb10" :class="metaData.selectedClass == 'trigger'? 'dark_border2' : 'light_border2'" @click="metaData.selectedClass='trigger'">
                <div class="row">
                    <div style="max-width:64px" class="col"><img width="36" src="assets/images/trigger_start_grey.png"/></div>
                    <div class="col">
                        <p class=" fsize11 dark_100 mb-1 fw500 ">TRIGGER</p>
                        <p class=" fsize16 dark_200 m-0 fw500" v-if="!unitInfo.workflow_entry_trigger">Entry Trigger</p>
                        <p class=" fsize16 dark_700 mb-1 fw500 ls_4" v-if="unitInfo.workflow_entry_trigger">{{triggerName}}</p>
                        <p class="m-0 fsize14 dark_600" v-if="unitInfo.workflow_entry_trigger">{{capitalizeFirstLetter(unitInfo.workflow_entry_trigger)}}&nbsp; <img src="assets/images/file-list-2-fill_blue.svg"/> &nbsp;  Lead Form Home</p>
                    </div>
                    <div class="col text-right">
                        <button class="btn border br35 blue_300 fsize13 fw500 p10 pl30 pr30 shadow-none slideTriggerbox" v-if="unitInfo.workflow_entry_trigger">
                            Edit
                        </button>
                        <button class="btn border br35 blue_300 fsize13 fw500 p10 pl30 pr30 shadow-none slideTriggerbox" v-else>
                            <img src="assets/images/plus_add_16.svg"/>  ADD TRIGGER
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--Nodes-->
        <list-node
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
        ></list-node>
        <!--Nodes-->

        <!--Fixed Goal Node-->
        <div class="col-12">
            <div class="card p35  mb10">
                <div class="row">
                    <div style="max-width: 64px" class="col mt-1">
                        <span class="circle-icon-36 br12 bkg_sms_400 light_000 d-block fsize16 fw500 rotate45"><i class="ri-checkbox-circle-fill light_000 fsize18"></i></span>
                    </div>
                    <div class="col-9">
                        <h3 class="htxt_medium_16 dark_700 mb-2" v-if="unitInfo.workflow_goal">Goal: {{capitalizeFirstLetter(unitInfo.workflow_goal)}}</h3>
                        <h3 class="htxt_medium_16 dark_700 mb-2" v-else>Goal: Empty</h3>
                        <ul class="review_camapaign_list">
                            <li><span>Tag</span><strong><i class="ri-add-circle-fill green_400"></i> New Customer</strong></li>
                            <li><span>Contacts</span><strong>1,356</strong></li>
                        </ul>
                    </div>
                    <div class="col text-right">
                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none slideGoalbox">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import ListNode from "./components/ListNode";
    export default {
        components: {ListNode},
        props: ['events', 'unitInfo', 'metaData', 'moduleName', 'moduleUnitId'],
        data(){
            return {
                viewType: 'list',
            }
        },
        computed: {
          triggerName: function(){
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




