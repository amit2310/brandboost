<template>

    <div class="content">
        Coming up with the content shortly
    </div>
</template>

<script>

    export default {
        data() {
            return {
                refreshMessage: 1,



                brandData: '',
                brandThemeData: '',
                aBrandbosts: '',
                selectedCampaigns: '',
                user: {},
                breadcrumb: ''

            }
        },
        created() {
            axios.get('/admin/brandboost/brand_configuration')
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.brandData = response.data.brandData;
                    this.brandThemeData = response.data.brandThemeData;
                    this.aBrandbosts = response.data.aBrandbosts;
                    this.selectedCampaigns = response.data.selectedCampaigns;
                    this.showLoading(false);
                    //loadJQScript(this.user.id);

                });
        },
        mounted() {

        },
        methods: {
            syncConfigure: function(param1){
                this.brandData = param1;

            },
            setSource: function(source){
                this.showLoading(true);
                this.campaign.source_type = source;
                axios.post('/admin/modules/referral/updateSource', {
                    source_type: source,
                    ref_id: this.campaignId,
                    _token: this.csrf_token(),
                })
                    .then(response => {
                        this.displayMessage('success', 'Source has been updated successfully');
                        this.showLoading(false);
                    });


            },
            displayStep: function(step){
                let path = '';
                if(!step){
                    path = '/admin#/referral/';
                }else{
                    path = '/admin#/referral/setup/'+this.campaignId+'/'+step;
                }

                window.location.href = path;
            },
            updateSettings: function (fieldName, fieldValue,  type) {
                this.showLoading(true);

                if(type =='expiry'){
                    this.displayCustomLinkExpiry = fieldValue == 'custom' || fieldName =='txtInteger' || fieldName =='exp_duration' ? true : false;
                }
                axios.post('/admin/brandboost/saveOnsiteSettings', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: fieldValue,
                    brandboostId: this.campaignId,
                    linkExpiryData : this.campaign.link_expire_custom,
                    requestType: type

                }).then(response => {

                    this.displayMessage('success', 'Test email sent successfully!');
                    this.showLoading(false);
                });

            },
            saveDraft: function(){
                this.showLoading(true);
                axios.post('/admin/broadcast/updateBroadcast', {
                    broadcastId: this.campaignId,
                    status: 'draft',
                    current_state: '',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.showLoading(false);
                        if(response.data.status == 'success'){
                            this.displayMessage('success', 'Campaign saved as a draft successfully');
                        }else{
                            this.displayMessage('error', 'Something went wrong');
                        }
                    });
            }
        }

    };

</script>


