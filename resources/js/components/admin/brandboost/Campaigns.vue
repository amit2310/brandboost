<template>
    <div class="content">

        <!--******************
        Top Heading area
        **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700"> Review Campaigns </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <!--<a :href="'admin/brandboost/export-onsite-campaigns?sortBy='+sortBy+'&search='+searchBy" >
                            <button class="circle-icon-40 mr15"><img src="assets/images/download-fill.svg"></button>
                        </a>-->
                        <button class="circle-icon-40 mr15"><img width="15" src="assets/images/settings-3-line.svg"></button>
                        <button class="btn btn-md bkg_reviews_400 light_000" id="displayAddCampaignForm" @click="displayAddCampaignForm"> Create campaign <span><img src="/assets/images/reviews_plus_icon.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <OnsiteCampaigns></OnsiteCampaigns>

        <OffsiteCampaigns></OffsiteCampaigns>
    </div>
</template>
<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    import OnsiteCampaigns from '@/components/admin/brandboost/onsite/Campaigns';
    import OffsiteCampaigns from '@/components/admin/brandboost/offsite/Campaigns';
    import jq from 'jquery';

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination, OnsiteCampaigns, OffsiteCampaigns},
        data(){
            return {

                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: ''
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
        }
    }
</script>
