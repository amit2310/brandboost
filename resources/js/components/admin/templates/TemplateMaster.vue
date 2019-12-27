<template>

    <div>

        <!--Top Heading area-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Email Templates</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/emailfilter.svg"/></button>
                        <button class="btn btn-md bkg_email_300 light_000 js-email-templates-slidebox"> Create new <span style="opacity: 0.3"><img src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--Content Area-->
        <div class="content-area">
            <email-template-list v-if="temp_type == 'email'"></email-template-list>
            <sms-template-list v-if="temp_type == 'sms'"></sms-template-list>

        </div>

        <email-template-popups></email-template-popups>
    </div>

</template>


<script>
    import EmailTemplateList from "./TemplateComponents/EmailTemplateList";
    import EmailPopup from '@/components/admin/modals/templates/EmailTemplatesPopup.vue';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        props: ['title', 'type'],
        components: {Pagination, EmailTemplateList, 'email-template-popups': EmailPopup},
        data(){
            return {
                temp_type: 'email'
            }
        }
    };


</script>

