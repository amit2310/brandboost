<template>
    <div class="row">

        <!--Main Event-->
        <!--<div class="col-md-12"><img src="/assets/images/wfline_single.png"/></div>
        <add-more-button :oEvent="oEvent" :wfData="wfData" @addAction="initAction"></add-more-button>-->
        <!--<template v-if="(oEvent && (oEvent.previous_event_id == '' || oEvent.previous_event_id ===null))">
            <div class="col-md-12"><img src="/assets/images/wfline_single.png"/></div>
            <div class="workflow_card" style="height:25px;background:transparent;border:none;box-shadow:none!important;">
                <div class="wf_icons circle_32 img bkg_light_300">
                    <img width="32" src="/assets/images/blue-plus.svg">
                </div>
            </div>
        </template>-->
        <!--End Main Event-->


        <div class="col-md-12"><img src="/assets/images/wfline_single.png" style="height:24px;"/></div>
        <div v-for="campaign in campaigns" :class="`col-md-${column_index}`">
            <div class="workflow_card" style="height:75px;cursor:pointer;" @click="editTimer">
                <div class="wf_icons circle_32 img bkg_dark_300"><img width="32" src="/assets/images/time-fill.svg"/></div>
                <p class="dark_800 htxt_bold_14 mb25"><span class="dark_200">Wait for</span> <span :id="`wf_event_${oEvent.id}`">{{delayTime}}</span></p>
            </div>

            <!--<div class="col-md-12"><img src="/assets/images/wfline_single.png" style="height:24px;"/></div>
            <add-more-button :oEvent="oEvent" :wfData="wfData" eventType="followup" @addAction="initAction"></add-more-button>-->

            <div class="col-md-12"><img src="/assets/images/wfline_single.png" style="height:24px;"/></div>
            <div class="workflow_card" v-if="campaign.campaign_type.toLowerCase() == 'email'">
                <div class="edit_delete">
                    <a href="javascript:void(0);" @click="editNode(campaign.id, 'email')"><i class="icon-gear fsize12 dark_100"></i></a>
                    <a href="javascript:void(0);" @click="deleteNode(oEvent.id)"><i class="icon-bin2 fsize10 dark_100"></i></a>
                </div>
                <div class="wf_icons bkg_brand_300"><img src="/assets/images/send-plane-fill-24.svg"/></div>
                <p class="dark_200 htxt_medium_12 mb10 text-uppercase">Email </p>
                <p class="dark_800 htxt_bold_14 mb25">{{campaign.name}} </p>
                <div class="p15 pt10 btop">
                    <ul class="workflow_list">
                        <li><a href="#"><span><img src="/assets/images/send-plane-line.svg"/></span> {{campaign.stats.processed>999 ? (campaign.stats.processed/100)+'k' : campaign.stats.processed}}</a></li>
                        <li><a href="#"><span><img src="/assets/images/mail-open-line.svg"/></span> {{campaign.stats.openRate}}%</a></li>
                        <li><a href="#"><span><img src="/assets/images/cursor-line.svg"/></span> {{campaign.stats.clickRate}}%</a></li>
                    </ul>
                </div>
            </div>
            <div class="workflow_card" v-if="campaign.campaign_type.toLowerCase() == 'sms'">
                <div class="edit_delete">
                    <a href="javascript:void(0);" @click="editNode(campaign.id, 'sms')"><i class="icon-gear fsize12 dark_100"></i></a>
                    <a href="javascript:void(0);" @click="deleteNode(oEvent.id)"><i class="icon-bin2 fsize10 dark_100"></i></a>
                </div>
                <div class="wf_icons bkg_sms_400"><img src="/assets/images/message-2-fill.svg"/></div>
                <p class="dark_200 htxt_medium_12 mb10 text-uppercase">SMS </p>
                <p class="dark_800 htxt_bold_14 mb25">{{campaign.name}}</p>
                <div class="p15 pt10 btop">
                    <ul class="workflow_list">
                        <li><a href="#"><span><img src="/assets/images/send-plane-line.svg"/></span> {{campaign.stats.sentSms>999 ? (campaign.stats.sentSms/100)+'k' : campaign.stats.sentSms}}</a></li>
                        <li><a href="#"><span><img src="/assets/images/mail-open-line.svg"/></span> {{campaign.stats.deliveryRate}}%</a></li>
                        <li><a href="#"><span><img src="/assets/images/cursor-line.svg"/></span> {{campaign.stats.failedRate}}%</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <!--<template v-if="lastNode">
            <div class="col-md-12"><img src="/assets/images/wfline_single.png"/></div>
            <add-more-button :oEvent="oEvent" :wfData="wfData" @addAction="initAction"></add-more-button>
        </template>-->
        <div class="col-md-12"><img src="/assets/images/wfline_single.png" style="height:24px;"/></div>
        <add-more-button :oEvent="oEvent" :wfData="wfData" eventType="followup" @addAction="initAction"></add-more-button>
    </div>
</template>
<script>
    import addMoreButton from './addMoreButton';
    export default {
        props: ['oEvent', 'wfData'],
        components: {addMoreButton},
       data(){
          return {
              moduleName: '',
              moduleUnitID: '',
              moduleAccountID: '',
              campaigns: '',
              total_campaigns: 0,
              column_index: 0,

          }
        },
         mounted() {
             this.moduleName = this.wfData.moduleName;
             this.moduleUnitID = this.wfData.moduleUnitID;
             this.getWorkflowCampaign();
             /*let d = JSON.parse(this.oEvent.data);
            alert(d.delivery_date);*/

        },
        watch: {
            campaigns: function () {
                this.total_campaigns = this.campaigns.length;
                this.column_index = Math.ceil(12/this.total_campaigns);
            }

        },
        computed: {
            delayTime: function(){
                let detalyData = JSON.parse(this.oEvent.data);
                let delayValue = (detalyData.delay_value == '' || detalyData.delay_value == undefined) ? '10' : detalyData.delay_value;
                let delayUnit = (detalyData.delay_unit == '' || detalyData.delay_unit == undefined) ? 'minute' : detalyData.delay_unit;
                return delayValue + ' ' + delayUnit;
            },
            lastNode: function(){
                let countElem = this.wfData.oEvents.length;
                let lastEvent = this.wfData.oEvents[countElem-1];
                return (this.oEvent.id == lastEvent.id) ? true : false;
            }
        },
        methods: {
            getWorkflowCampaign: function(){
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/eventCampaigns', {moduleName: this.moduleName, id:this.oEvent.id})
                    .then(response => {
                        this.campaigns = response.data.oCampaigns;
                    });
            },
            initAction: function(action, currentId, previousId, eventType){
                //alert('Adding '+action + ' CurrnetId = '+currentId+ ' PreviousId = '+previousId);
                if(previousId == null || previousId == ''){
                    //alert('Main Event ' + 'Adding '+action + ' CurrnetId = '+currentId+ ' PreviousId = '+previousId);
                }else{
                    //alert('Followup Event ' + 'Adding '+action + ' CurrnetId = '+currentId+ ' PreviousId = '+previousId);
                }
                this.$emit('chooseTemplate', action, currentId, previousId, eventType);
            },
            editNode: function(campaignId, nodeType){
                this.$emit('editNode', campaignId, nodeType);
            },
            deleteNode: function(eventId){
                this.$emit('deleteNode', eventId);
            },
            editTimer: function(){
                this.$emit("updateTimer", this.oEvent)
            }


        }

    };


</script>
<style scoped>
    .ddmtext{
        margin-top:10px !important;
    }
    .ddmli li{
        padding: 6px 0 !important;
        cursor:pointer;

    }
</style>






