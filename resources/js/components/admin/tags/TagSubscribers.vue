<template>
    <div>
        <!--******************
      Top Heading area
     **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Tag Subscribers:: {{capitalizeFirstLetter(setStringLimit(tagName, 14))}}</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <a :href="`/admin/subscriber/exportSubscriberCSV?module_name=people&module_account_id=${ tagID }`">
                            <button type="button" class="btn btn-md bkg_blue_200 light_000"><i
                                class="icon-arrow-down16 bkg_blue_200 light_000"></i><span> &nbsp;  Export Contact</span></button> </a>
                        <button class="circle-icon-40 mr15"><img src="/assets/images/filter.svg"/></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="content-area">


            <workflow-subscribers
                :show-archived="true"
                :subscribers-data="subscribers"
                :all-data="allData"
                :active-count="activeCount"
                :archive-count="archiveCount"
                :module-name="moduleName"
                :module-unit-id="moduleUnitID"
                @navPage ="navigatePagination"
                :key="subscribers"
            ></workflow-subscribers>
        </div>
    </div>
</template>
<script>
    import WorkflowSubscribers from '@/components/admin/workflow/WorkflowSubscribers.vue';
    export default {
        data() {
            return {
                successMsg : '',


                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                activeCount: 0,
                archiveCount: 0,
                subscribers: {},
                allData: {},
                tagName: '',
                current_page: 1,
                breadcrumb: '',
                tagID : this.$route.params.id,
            }
        },
        components: {'workflow-subscribers': WorkflowSubscribers},
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            loadPaginatedData : function(){
                axios.get('/admin/tags/getTagContacts?tag_id='+this.tagID +'&page='+this.current_page)
                    .then(response => {
                        console.log(response.data);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.subscribers = response.data.subscribersData;
                        this.allData = response.data.allData;
                        this.tagName = response.data.tagName;
                        this.activeCount = response.data.activeCount;
                        this.archiveCount = response.data.archiveCount;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.showLoading(false);
                    });
            },
            navigatePagination: function(p){
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            }
        }
    };
</script>
