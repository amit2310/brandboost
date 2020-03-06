<template>
    <div>
        <loading :isLoading="loading"></loading>
        <div class="row">
            <div class="col-md-8">
                <div class="card min-h-280">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_32 dark_700">79,3%</h3>
                            <p class="grey-sub-headings">YOUR EMAIL MARKETING IS GOOD</p>
                            <hr>
                            <p class="fsize14 mb30" style="color: #5a6f80;">Your recent emails have low avg.
                                9%
                                bounce rate. We suggest you to send new email
                                in next 3 days.</p>
                            <a class="fsize15 blue_300" href="javascript:void(0);"><img src="assets/images/editpen.svg"/>&nbsp;
                                Create new email</a>
                        </div>
                        <div class="col-md-6 text-center">
                            <img class="mt40" style="max-width: 225px; "
                                 src="assets/images/dashboard_image_01.png"/>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card min-h-280 text-center">
                    <img class="mb20" style="max-width: 130px; margin: 0 auto"
                         src="assets/images/dashboard_graph0.png"/>
                    <p class="grey-sub-headings mb10">CREDITS BALANCE</p>
                    <p class="fsize14 mb30" style="color: #5a6f80;">You used 408/450 montly credits</p>
                    <a class="fsize15 dark_600 fw500" href="javascript:void(0);">Purchase more credits</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card min-h-280">
                    <h3 class="htxt_medium_32 dark_700">51,913</h3>
                    <p class="grey-sub-headings">Emails</p>
                    <img style="max-height: 130px;" src="assets/images/dashboard_graph2.png"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card min-h-280">
                    <h3 class="htxt_medium_32 dark_700">139</h3>
                    <p class="grey-sub-headings">Subscriptions</p>
                    <img style="max-height: 130px;" src="assets/images/dashboard_graph1.png"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                breadcrumb: {Home:'#/', People:'#/contacts/dashboard', Dashboard:''},
                loading: true,
            }
        },
        created() {
            this.makeBreadcrumb(this.breadcrumb);
        },
        mounted() {
            this.loading = false;
        }
    };
</script>



