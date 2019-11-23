<template>
    <div class="workflow_card" style="cursor:pointer;height:25px;background:transparent;border:none;box-shadow:none!important;padding:28px 0 0 0 !important;">
        <div class="wf_icons circle_32 img bkg_light_300" style="top:-33px !important;" data-toggle="dropdown">
            <img width="32" src="/assets/images/blue-plus.svg">
        </div>
        <div class="p20 pt0 pb0 dropdown-menu">
            <ul class="list_with_icons ddmli">
                <li @click="addAction('email')">
                    <div class="media_left">
                        <span class="circle_32 img bkg_brand_300"><img src="/assets/images/send-plane-fill.svg"/></span>
                    </div>
                    <div class="media_left">
                        <p class="htxt_bold_14 dark_600 ddmtext">Email</p>
                    </div>
                </li>


                <li @click="addAction('sms')">
                    <div class="media_left">
                        <span class="circle_32 img bkg_sms_400"><img src="/assets/images/message-2-fill.svg"/></span>
                    </div>
                    <div class="media_left">
                        <p class="htxt_bold_14 dark_600 ddmtext">SMS</p>
                    </div>
                </li>

                <li @click="addAction('review')">
                    <div class="media_left">
                        <span class="circle_32 img bkg_reviews_400"><img src="/assets/images/star-s-fill.svg"/></span>
                    </div>
                    <div class="media_left">
                        <p class="htxt_bold_14 dark_600 ddmtext">Review</p>
                    </div>
                </li>

                <li @click="addAction('notification')">
                    <div class="media_left">
                        <span class="circle_32 img bkg_red_400"><img src="/assets/images/notification-badge-fill.svg"/></span>
                    </div>
                    <div class="media_left">
                        <p class="htxt_bold_14 dark_600 ddmtext">Notification</p>
                    </div>
                </li>


            </ul>
            <div class="clearfix"></div>
        </div>


    </div>
</template>
<script>

    export default {
        props: ['oEvent', 'wfData'],
        methods: {
            addAction: function(actionName){
                let currentEventId = this.oEvent.id;
                let previousEventId = this.oEvent.previous_event_id;
                this.$emit('addAction', actionName, currentEventId, previousEventId);
            },
        }
    };
</script>







