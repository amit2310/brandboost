<template>
    <div>
        <!--Connector-->
        <div class="col-12 text-center">
            <a class="workflowadds slideActionbox" href="javascript:void(0);"><i class="ri-add-fill"></i></a>
        </div>
        <!--Connector-->

        <!--Empty Node-->
        <div class="col-md-12 mb0">
            <div class="workflow_box" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="workflow_card" style="border:2px solid #4489F2;">
                            <div class="wf_icons br12 bkg_blue_300"><img width="18" src="assets/images/flashlight-fill-white.svg"></div>
                            <p class="dark_100 fsize11 fw500 mb-1 text-uppercase ls_4">ACTIONN </p>
                            <p class="dark_200 fsize13 fw500 mb15 ls4">Empty Action </p>
                            <div class="p0 pt12 btop">
                                <ul class="workflow_list">
                                    <li style="border:none;"><a class="blue_300 fw500 fsize11" href="#"><span class="d-inline-block"><img src="assets/images/plus_blue_7.svg"></span> ADD ACTION</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Empty Node-->
    </div>
</template>
<script>
    export default {
        props: ['event', 'unitInfo', 'metaData'],
        data(){
          return {
              column_index: 0,
          }
        },
    };
</script>
