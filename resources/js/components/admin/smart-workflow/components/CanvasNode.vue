<template>
    <div>
        <!--Connector-->
        <div class="col-12 text-center">
            <a class="workflowadds slideAddNodebox" href="javascript:void(0);" @click="prepareToAddAction"><i class="ri-add-fill"></i></a>
        </div>
        <!--Connector-->

        <!--Empty Node-->
        <div class="col-md-12 mb0">
            <div class="workflow_box" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="workflow_card" :class="{'workflowSelectedBorder': metaData.selectedClass == event.id}" @click="metaData.selectedClass=event.id">
                            <div class="wf_icons br12 bkg_blue_300"><img width="18" src="assets/images/flashlight-fill-white.svg"></div>
                            <div class="edit_delete">
                                <a href="javascript:void(0);"><i class="icon-gear fsize12 dark_100"></i></a>
                                <a href="javascript:void(0);" @click="deleteEvent"><i class="icon-bin2 fsize10 dark_100"></i></a>
                            </div>
                            <p class="dark_100 fsize11 fw500 mb-1 text-uppercase ls_4">ACTION</p>
                            <p class="dark_200 fsize13 fw500 mb15 ls4">{{nodeName ? nodeName : 'Empty Action'}} </p>
                            <div class="p0 pt12 btop">
                                <ul class="workflow_list">
                                    <li style="border:none;">
                                        <a class="blue_300 fw500 fsize11" href="#" v-if="nodeTitle">
                                            <span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> {{nodeTitle ? nodeTitle : 'ADD Action'}}
                                        </a>
                                        <a class="blue_300 fw500 fsize11" href="#" v-else>
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
    </div>
</template>
<script>
    export default {
        props: ['event', 'unitInfo', 'metaData'],
        data(){
          return {
              column_index: 0,
          }
        },
        computed :{
            nodeName : function(){
                return this.capitalizeFirstLetter(JSON.parse(this.event.data)['action_name']);
            },
            nodeTitle : function(){
                return this.capitalizeFirstLetter(JSON.parse(this.event.data)['action_title']);
            },

        },
        methods: {
            prepareToAddAction: function(){
                this.$emit('setAddActionProps', this.event);
            },
            deleteEvent: function(){
                if(confirm("Are you sure you want to delete this node?")){
                    this.$emit('deleteEventNode', this.event);
                }
            }
        }
    };
</script>
