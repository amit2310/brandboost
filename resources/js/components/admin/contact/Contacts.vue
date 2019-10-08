<template>
    <div class="content">

        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-3">
                    <h3><img src="/assets/images/people_sec_icon.png"> Contacts</h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Active Contacts</a></li>
                        <li><a href="#right-icon-tab1" data-toggle="tab">Archive</a></li>
                    </ul>
                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-9 text-right btn_area">
                    <button type="button" class="btn light_btn importModuleContact" :data-modulename="moduleName" :data-moduleaccountid="moduleUnitID" data-redirect="/admin/contacts/mycontacts"><i class="icon-arrow-up16"></i><span> &nbsp;  Import Contacts</span> </button>
                    <a class="btn light_btn ml10" :href="`/admin/subscriber/exportSubscriberCSV?module_name=${moduleName}&module_account_id=${moduleUnitID}`"><i class="icon-arrow-down16"></i><span> &nbsp;  Export Contacts</span> </a>
                    <button type="button" class="btn dark_btn dropdown-toggle ml10 addModuleContact" :data-modulename="moduleName" :data-moduleaccountid="moduleUnitID"><i class="icon-plus3"></i><span> &nbsp;  Add Contact</span> </button>
                    &nbsp;
                </div>
            </div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->


            <workflow-subscribers
                :show-archived="true"
                :subscribers-data="subscribers"
                :active-count="activeCount"
                :archive-count="archiveCount"
                :module-name = "moduleName"
                :module-unit-id ="moduleUnitID"
            ></workflow-subscribers>

    </div>
</template>
<script>
    import WorkflowSubscribers from '../workflow/WorkflowSubscribers.vue';
    export default {
        data() {
            return {
                moduleName: '',
                moduleUnitID: '',
                activeCount: 0,
                archiveCount: 0,
                subscribers: {},

            }
        },
        components: {'workflow-subscribers' : WorkflowSubscribers},
        mounted() {
            console.log('Component mounted.');
            axios.get('/admin/contacts/mycontacts')
                .then(response => {

                    this.moduleName = response.data.moduleName;
                    this.moduleUnitID = response.data.moduleUnitID;
                    this.subscribers = response.data.subscribersData;
                    this.activeCount = response.data.activeCount;
                    this.archiveCount = response.data.archiveCount;

                });
        }

    };

    /*$(document).on('click', '#addContactForm', function () {
        $('.addModuleContact').trigger('click');
    });*/

</script>



