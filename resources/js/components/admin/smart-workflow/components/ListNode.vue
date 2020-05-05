<template>
    <div class="row" style="margin-left:0px;margin-right:0px;width:100%;">

        <div class="col-12" v-if="nodeType != 'split'">
            <div class="card p35  mb10">
                <div class="row">
                    <div style="max-width: 64px" class="col mt-1">
                        <span v-if="nodeName.toLowerCase() == 'email'" class="circle-icon-36 br12 bkg_email_300 light_000 d-block fsize16 fw500">
                            <i class="ri-mail-open-fill"></i>
                        </span>
                        <span v-if="nodeName.toLowerCase() == 'sms'" class="circle-icon-36 last br12 bkg_sms_400 light_000 d-block fsize16 fw500">
                            <i class="ri-message-3-line"></i>
                        </span>
                        <span v-if="nodeName.toLowerCase() == 'delay'" class="circle-icon-36 last br12 bkg_reviews_300 light_000 d-block fsize16 fw500">
                            <i class="ri-time-fill"></i>
                        </span>
                        <span v-if="nodeType.toLowerCase() == 'decision'" class="circle-icon-36 last br12 bkg_yellow_500 light_000 d-block fsize16 fw500">
                            <i class="ri-mail-open-fill"></i>
                        </span>
                    </div>
                    <div class="col-9">
                        <h3 class="htxt_medium_16 dark_700 mb-2">{{capitalizeFirstLetter(nodeType)}}: {{capitalizeFirstLetter(nodeTitle)}}</h3>
                        <ul class="review_camapaign_list">
                            <li v-if="nodeName.toLowerCase() == 'email'">
                                <span><figure><img src="assets/images/Create_Ema_preview.png"></figure></span>
                                <strong v-if="campaignInfo">
                                    <strong>{{setStringLimit(campaignInfo.greeting+' '+campaignInfo.introduction, 55)}}</strong><br>
                                    <a href="javascript:void(0);">Preview Template “{{templateInfo.template_name}}”</a><br>
                                    <a href="javascript:void(0);">Send test email</a>
                                </strong>
                                <strong v-else>
                                    Empty Email
                                </strong>
                            </li>
                            <li v-if="nodeName.toLowerCase() == 'sms'">
                                <span class="smsbox">
                                    <div class="row mb-1">
                                        <div class="col"><p class="m-0 fsize8 light_700"><img width="10" src="assets/images/message_icon_green.svg"> &nbsp; MESSAGES</p></div>
                                        <div class="col text-right"><p class="m-0 fsize8 light_700">now</p></div>
                                    </div>
                                    <p class="fsize9 fw500 dark_900 mb-1">{{campaignInfo.greeting}}</p>
                                    <p class="fsize9 fw300 dark_900 m-0" v-html="setStringLimit(campaignInfo.introduction + ' '+ getDecodeContent(campaignInfo.stripo_compiled_html), 150)"></p>
                                </span>
                                <strong v-if="campaignInfo">
                                    <strong>{{setStringLimit(campaignInfo.greeting+' '+campaignInfo.introduction, 55)}}</strong><br>
                                    <a href="javascript:void(0);">Preview SMS Template “{{templateInfo.template_name}}”</a><br>
                                    <a href="javascript:void(0);">Send test SMS</a>
                                </strong>
                                <strong v-else>
                                    Empty SMS
                                </strong>
                            </li>
                        </ul>
                    </div>
                    <div class="col text-right">
                        <button @click="editNode" class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
                        <button @click="deleteEvent" class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['event', 'unitInfo', 'metaData', 'moduleName', 'moduleUnitId'],
        data(){
            return {
                column_index: 0,
                splitNodeInfo: '',
                templateInfo: '',
                campaignInfo: ''
            }
        },
        mounted() {
            if(this.nodeType == 'split'){
                this.getSplitNodeInfo(this.event);
            }else if(this.nodeName.toLowerCase()=='email' || this.nodeName.toLowerCase()=='sms'){
                this.getNodeInfo(this.event);
            }
        },
        computed :{
            nodeClass : function(){
                let className = JSON.parse(this.event.data)['node_type'];
                if(className == 'action'){
                    return 'bkg_blue_300';
                }else if(className == 'decision'){
                    return 'bkg_yellow_400';
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
                this.$emit('editEventNode', this.nodeType, this.event);
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
            getNodeInfo: function(){
                let formData = {
                    id: this.event.id,
                    name:this.nodeName.toLowerCase(),
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                };
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getEndCampaign', formData).then(response => {
                    if(response.data.status == 'success'){
                        this.templateInfo = response.data.templateInfo;
                        this.campaignInfo = response.data.campaignInfo;
                    }
                });

            },
            getDecodeContent: function(content){
                return atob(content);
            },
        }
    };
</script>
