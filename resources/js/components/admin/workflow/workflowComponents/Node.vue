<template>
    <div>
        <button class="btn btn-xs btn_white_table smallbtn rounded dropdown-toggle" style="border:1px solid #cccccc;">+</button>
        <div class="col-md-6">
            <div class="workflow_card">
                <div class="wf_icons bkg_email_400"><img src="/assets/images/send-plane-fill-24.svg"/></div>
                <p class="dark_200 htxt_medium_12 mb10 text-uppercase">Tag </p>
                <p class="dark_800 htxt_bold_14 mb25">New Customer </p>
                <div class="p15 pt10 btop">
                    <ul class="workflow_list">
                        <li><a href="#"><span><img src="/assets/images/send-plane-line.svg"/></span> 3k</a></li>
                        <li><a href="#"><span><img src="/assets/images/mail-open-line.svg"/></span> 28%</a></li>
                        <li><a href="#"><span><img src="/assets/images/cursor-line.svg"/></span> 67%</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="workflow_card">
                <div class="wf_icons bkg_reviews_500"><img src="/assets/images/star-s-fill.png"/></div>
                <p class="dark_200 htxt_medium_12 mb10 text-uppercase">Tag </p>
                <p class="dark_800 htxt_bold_14 mb25">New Customer </p>
                <div class="p15 pt10 btop">
                    <ul class="workflow_list">
                        <li><a href="#"><span><img src="/assets/images/send-plane-line.svg"/></span> 3k</a></li>
                        <li><a href="#"><span><img src="/assets/images/mail-open-line.svg"/></span> 28%</a></li>
                        <li><a href="#"><span><img src="/assets/images/cursor-line.svg"/></span> 67%</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {
        props: ['oEvent', 'wfData'],
       data(){
          return {
              moduleName: '',
              moduleUnitID: '',
              moduleAccountID: '',
              campaigns: ''
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
            wfData: function(){
                alert('called');
                this.moduleName = this.wfData.moduleName;
                this.moduleUnitID = this.wfData.moduleUnitID;
                this.getWorkflowCampaign();
            }
        },
        methods: {
            getWorkflowCampaign: function(){
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/eventCampaigns', {moduleName: this.moduleName, id:this.oEvent.id})
                    .then(response => {
                        this.campaigns = response.data.oCampaigns;
                    });
            }

        }
    }

    $("#fullscreen").click(function(){
        $(".content-area").toggleClass("fullscreen");
    });
    /*$(".touchspin-step").TouchSpin({
        step: 10
    });*/
</script>





