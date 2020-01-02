<template>
    <div>
        <workflow-grid :workflowData="workflowData" v-bind="workflowData" @realoadTree="refreshTree"></workflow-grid>
        <div class="row" style="position: fixed; bottom:20px;right:80px;left:445px;">
            <div class="col-6">
                <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" v-show="true" @click="displayStep(2)"><span class="ml0 mr10"><img
                    src="/assets/images/arrow-left-line.svg"></span>Back
                </button>
            </div>
            <div class="col-6">
                <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="displayStep(4)">Save and continue <span><img
                    src="/assets/images/arrow-right-line.svg"></span></button>
            </div>
        </div>
    </div>

</template>
<script>
    import workflowGrid from '@/components/admin/workflow/MasterWorkflow';
    export default {
        components : {workflowGrid},
        data(){
            return {
                campaignId: this.$route.params.id,
                workflowData: ''

            }
        },
        mounted() {
            this.applyWorkflowStyle();
            this.getWorkflowData();
        },
        methods: {
            getWorkflowData: function(){
                axios.get('/admin/modules/referral/setup/' + this.campaignId)
                    .then(response => {
                        this.workflowData = response.data;
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
            applyWorkflowStyle: function(){
                document.querySelector(".navbar-custom").style = "background: #ffffff!important; padding-left: 320px";
            },
            removeWorkflowStyle: function(){
                document.querySelector(".navbar-custom").style = "";
            },
            refreshTree: function(){
                this.getWorkflowData();
            }
        },
        beforeRouteLeave(to, from, next){
            this.removeWorkflowStyle();
            next();
        }

    }
</script>





