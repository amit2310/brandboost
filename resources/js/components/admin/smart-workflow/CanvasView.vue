<template>
    <div class="row">

        <div class="col-md-12 mb-3">
            <div class="workflow_box" id="canvasDragger" style="position:absolute;left:25.44%;top:0px;cursor:move;">
                <div class="row">
                    <!--Trigger-->
                    <div class="col-md-12">
                        <div class="workflow_box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="workflow_card slideTriggerbox" :class="{'workflowSelectedBorder': metaData.selectedClass == 'trigger'}" @click="metaData.selectedClass='trigger'">
                                        <div class="wf_icons br12 bkg_dark_100 rotate_45 border"><img class="rotate_45_minus small" src="assets/images/play_white_small.svg"></div>
                                        <p class="dark_200 fsize11 fw500 mb-1 text-uppercase ls_4">TRIGGER </p>
                                        <p class="dark_200 fsize13 fw500 mb15 ls4" v-if="unitInfo.workflow_entry_trigger">{{capitalizeFirstLetter(unitInfo.workflow_entry_trigger)}} </p>
                                        <p class="dark_200 fsize13 fw500 mb15 ls4" v-else>Entry Trigger </p>
                                        <div class="p0 pt12 btop">
                                            <ul class="workflow_list">
                                                <li style="border:none;">
                                                    <a class="blue_300 fw500 fsize11" href="javascript:void(0);" v-if="unitInfo.workflow_entry_trigger">
                                                        <span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> Some Data
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
                        :key="oEvent.id"
                    ></canvas-node>
                    <!--Nodes-->

                    <!--Connector-->
                    <div class="col-12 text-center">
                        <a class="workflowadds slideActionbox" href="javascript:void(0);" @click="metaData.selectedClass = ''"><i class="ri-add-fill"></i></a>
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
        props: ['events', 'unitInfo', 'metaData'],
        data(){
            return {
                viewType: 'list',
            }
        },
        methods: {

        }
    }
</script>




