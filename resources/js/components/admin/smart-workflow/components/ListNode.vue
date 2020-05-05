<template>
    <div class="row" style="margin-left:0px;margin-right:0px;width:100%;">
        <div class="col-12" v-if="nodeType != 'split'">
            <div class="card p35 br6 mb10" :class="metaData.selectedClass == event.id ? 'blue_border2' : 'light_border2'" @click="metaData.selectedClass=event.id">
                <div class="row">
                    <div style="max-width:64px" class="col">
                        <span v-if="nodeName.toLowerCase() == 'email'" class="circle-icon-36 dot_none br12 bkg_email_300 light_000 d-block fsize16 fw500">
                            <i class="ri-mail-open-fill"></i>
                        </span>
                        <span v-else-if="nodeName.toLowerCase() == 'sms'" class="circle-icon-36 dot_none br12 bkg_sms_400 light_000 d-block fsize16 fw500">
                            <i class="ri-message-3-line"></i>
                        </span>
                        <span v-else-if="nodeName.toLowerCase() == 'delay'" class="circle-icon-36 dot_none br12 bkg_reviews_300 light_000 d-block fsize16 fw500">
                            <i class="ri-time-fill"></i>
                        </span>
                        <span v-else-if="nodeType.toLowerCase() == 'decision'" class="circle-icon-36 dot_none br12 bkg_yellow_500 light_000 d-block fsize16 fw500">
                            <i class="ri-mail-open-fill"></i>
                        </span>
                        <span v-else class="circle-icon-36 dot_none br12 bkg_blue_300 light_000 d-block fsize16 fw500">
                            <i class="ri-flashlight-fill"></i>
                        </span>
                    </div>
                    <div class="col">
                        <p class=" fsize11 dark_100 mb-1 fw500" v-if="nodeName.toLowerCase() != 'email' && nodeName.toLowerCase() != 'sms'">{{nodeType.toUpperCase()}}</p>
                        <template v-if="nodeType.toLowerCase() == 'delay'">
                            <p class=" fsize16 dark_700 mb-1 fw500 ls_4" v-if="nodeTitle">{{capitalizeFirstLetter(nodeTitle)}}</p>
                            <p class=" fsize16 dark_200 m-0 fw500" v-else>Empty Delay</p>
                            <p class="m-0 fsize14 dark_600">Time  &nbsp; <img src="assets/images/time-fill-blue.svg"/> &nbsp;  {{delayTime}}</p>
                        </template>
                        <template v-if="nodeType.toLowerCase() == 'decision'">
                            <p class=" fsize16 dark_700 mb-1 fw500 ls_4" v-if="nodeTitle">{{capitalizeFirstLetter(nodeTitle)}}</p>
                            <p class=" fsize16 dark_200 m-0 fw500" v-else>Empty Decision</p>
                            <p class="m-0 fsize14 dark_600" v-if="nodeName">Decision  &nbsp; <img src="assets/images/account-circle-fill_blue.svg"/> &nbsp;  1,356</p>
                        </template>
                        <template v-if="nodeType.toLowerCase() == 'action'">
                            <ul class="review_camapaign_list" v-if="nodeName && (nodeName.toLowerCase() == 'email' || nodeName.toLowerCase() == 'sms')">
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
                            <p class=" fsize16 dark_700 mb-1 fw500 ls_4" v-else-if="nodeNameDescription">{{nodeNameDescription}}</p>
                            <p class=" fsize16 dark_200 m-0 fw500" v-else>Empty Action</p>
                            <p class="m-0 fsize14 dark_600" v-if="nodeName">Contacts  &nbsp; <img src="assets/images/account-circle-fill_blue.svg"/> &nbsp;  1,356</p>
                        </template>
                        <template v-if="nodeType.toLowerCase() == 'split'">
                            <p class=" fsize16 dark_700 mb-1 fw500 ls_4" v-if="nodeTitle">{{capitalizeFirstLetter(nodeTitle)}}</p>
                            <p class=" fsize16 dark_200 m-0 fw500" v-else>Empty Split</p>
                        </template>

                    </div>
                    <div class="col text-right">
                        <button @click="deleteEvent" class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Delete</button>
                        <button @click="editNode" class="btn border br35 blue_300 fsize13 fw500 p10 pl30 pr30 shadow-none" v-if="nodeName">
                            Edit
                        </button>
                        <button @click="editNode" class="btn border br35 blue_300 fsize13 fw500 p10 pl30 pr30 shadow-none" v-else>
                            <img src="assets/images/plus_add_16.svg"/>  {{buttonCaption}}
                        </button>
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
            nodeClass: function(){
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
            nodeNameDescription: function(){
                if(this.nodeName.toLowerCase() == 'field'){
                    return 'People field';
                }else if(this.nodeName.toLowerCase() == 'tag'){
                    return 'People tag';
                }else if(this.nodeName.toLowerCase() == 'list'){
                    return 'People list';
                }else if(this.nodeName.toLowerCase() == 'contact'){
                    return 'People contact';
                }else if(this.nodeName.toLowerCase() == 'status'){
                    return 'People status';
                }
            },
            buttonCaption: function(){
                if(this.nodeType.toLowerCase() == 'action'){
                    return 'Add Action';
                }else if(this.nodeType.toLowerCase() == 'delay'){
                    return 'Add Delay';
                }else if(this.nodeName.toLowerCase() == 'decision'){
                    return 'Add Decision';
                }else if(this.nodeName.toLowerCase() == 'split'){
                    return 'Add Split';
                }else{
                    return '';
                }
            },
            nodeType: function(){
                return JSON.parse(this.event.data)['node_type'];
            },
            nodeName: function(){
                return this.capitalizeFirstLetter(JSON.parse(this.event.data)['name']);
            },
            nodeTitle: function(){
                return this.capitalizeFirstLetter(JSON.parse(this.event.data)['title']);
            },
            delayTime: function(){
                let delayProps = JSON.parse(this.event.data)['delay_properties'];
                return 'At '+ delayProps['delay_hour']+':'+delayProps['delay_minute']+ ' '+ delayProps['delay_ampm'].toUpperCase();
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
                if(content){
                    return atob(content);
                }
                return content;
            },
        }
    };
</script>
