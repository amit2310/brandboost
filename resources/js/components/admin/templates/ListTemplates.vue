<template>
    <div class="content">

        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-3 mt20">
                    <h3><img src="/assets/images/people_sec_icon.png"> {{ title }}</h3>

                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-9 text-right btn_area">
                    <button type="button" class="btn dark_btn dropdown-toggle ml10 addUserTemplate" :template-type="templateType"><i class="icon-plus3"></i><span> &nbsp;  Add Template</span> </button>

                </div>
            </div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

        <div class="tab-content">
            <!--===========TAB 1===========-->
            <email-templates></email-templates>

            <!--<sms-templates></sms-templates>
            @if ($templateType == 'email')
            @include('admin.templates.emails.email-template-index')
            @endif

            @if ($templateType == 'sms')
            @include('admin.templates.sms.sms-template-index')
            @endif-->

        </div>
    </div>
</template>

<script>
    let tkn = $('meta[name="_token"]').attr('content');
    export default {
        name: 'template-list',
        props: ['subscriber_id'],
        data() {
            return {
                tags: {},
                tagCounts: 0,
            }
        },
        mounted() {
            console.log('Component mounted.');
            axios.post('/admin/helperutility/getSubscriberTags', {_token: tkn, subscriber_id: this.subscriber_id})
                .then(response => {
                    this.tags = response.data.oTags;
                    this.tagCounts = response.data.tagCount;
                });


        },
        methods: {},
    };

</script>
<style>
    .template_preview.sms .custmo_checkbox {display:none !important;}
    .template_preview .custmo_checkbox {display:none!important;}
    .template_preview .custmo_checkbox
    .email_preview_button.clone {
        position: absolute;
        width: 64px;
        height: 64px;
        box-shadow: 0 6px 8px 0 rgba(1, 21, 64, 0.16);
        background: #fff;
        border-radius: 100%;
        text-align: center;
        line-height: 64px;
        top: 54%;
        margin-top: 0px;
        left: 50%;
        margin-left: -32px;
        color: #2b9adc;
        display: block;
    }
</style>
