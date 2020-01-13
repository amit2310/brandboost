<template>

    <div id="Campaign" class="tab-pane fade">
        <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
        <loading :isLoading="loading"></loading>
        <div class="p20 bbot pt10 pb10">
            <p class="text-uppercase m-0 fw400 dark_200">Select Campaign  <a class="float-right" href="javascript:void(0);"><i class="icon-arrow-down12 fsize15"></i></a></p>
        </div>
        <div class="p20">
            <h3 class="dark_500 mb0 fsize14 fw400">Select All
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" @change="updateAll($event)">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <h3 v-for="campaing in aBrandbosts" class="dark_500 mb0 fsize14 fw400">{{campaing.brand_title}}
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" name="campaign[]" @change="updateSelectedCampaign($event, campaing.id)" :checked="selectedCampaigns.indexOf(campaing.id) != -1">
                    <span class="toggle email"></span>
                </label>
            </h3>

        </div>
        <div class="p20 btop">
            <button class="btn btn-md bkg_blue_200 light_000 w-100" @click="saveSelectedCampaigns">Save </button>
        </div>
    </div>

</template>
<script>
    export default {
        props: ['brandData', 'brandThemeData', 'aBrandbosts', 'selectedCampaigns'],
        data(){
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                loading: false
            }
        },
        methods: {
            updateAll: function(ev){
                this.selectedCampaigns = [];
                let elem = this;
                if(ev.target.checked){
                    this.aBrandbosts.forEach(function(item){
                        elem.selectedCampaigns.push(item.id);
                    });
                }
            },
            updateSelectedCampaign : function(ev, id){
                if(ev.target.checked){
                    this.selectedCampaigns.push(id);
                }else{
                    this.selectedCampaigns.splice( this.selectedCampaigns.indexOf(id), 1 );
                }
            },
            saveSelectedCampaigns: function(){
                this.loading = true;
                axios.post('/admin/brandboost/addBrandCampaign', {
                    campaign: this.selectedCampaigns,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.successMsg = 'Configuration saved successfully!!';
                        this.loading = false;

                    });
            }
        }
    }
</script>



