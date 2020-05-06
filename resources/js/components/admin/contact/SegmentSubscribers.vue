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
                        <h3 class="htxt_medium_24 dark_700">Segment Subscribers:: {{capitalizeFirstLetter(setStringLimit(segmentInfo.segment_name, 14))}}</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000">Main Action <span><img
                            src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="content-area">

            <loading :isLoading="loading"></loading>
            <workflow-subscribers
                :show-archived="true"
                :subscribers-data="subscribers"
                :all-data="allData"
                :active-count="activeCount"
                :archive-count="archiveCount"
                :module-name="moduleName"
                :module-unit-id="moduleUnitID"
                @navPage ="navigatePagination"
                @syncContacts="syncContacts"
                :key="subscribers"
            ></workflow-subscribers>
        </div>


        <!--Smart Popup-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"><a class="cross_icon slidebox"><i
                    class=""><img src="/assets/images/cross.svg"/></i></a>
                    <form method="post" id="addCentralSubscriberData">
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"><img src="/assets/images/create_cotact_people.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Create Contact </h3>
                                <hr>
                            </div>

                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="firstname">First name</label>
                                        <input type="text" class="form-control h56" id="firstname"
                                               placeholder="Enter name" name="firstname">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Last name</label>
                                        <input type="text" class="form-control h56" id="lastname"
                                               placeholder="Enter last name" name="lastname">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control h56" id="email"
                                               placeholder="Enter email address" name="email">
                                    </div>
                                    <!--<div class="form-group">
                                      <label for="pwd">Phone number</label>
                                      <input type="text" class="form-control h56" id="pwd" placeholder="Enter phone number" name="pswd">
                                    </div>-->
                                    <div class="form-group">
                                        <label for="phone">Phone number</label>
                                        <div class="phonenumber">
                                            <div class="float-left">
                                                <button type="button"
                                                        class="dropdown-toggle table_action_dropdown p0 mt10"
                                                        data-toggle="dropdown">
                                                    <span><img src="assets/images/USA.png"/></span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Link 1</a>
                                                    <a class="dropdown-item" href="#">Link 2</a>
                                                    <a class="dropdown-item" href="#">Link 3</a>
                                                </div>
                                            </div>
                                            <input type="number" class="inputbox" id="phone"
                                                   placeholder="Enter phone number" name="phone">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="tags">Tags</label>
                                        <div class="clearfix"></div>
                                        <input type="text" class="form-control h56" id="tags"
                                               value='Removeable Tag, Other Tag' name="tags" style="display: none">
                                    </div>

                                </div>

                        </div>
                        <div class="row mb50">
                            <div class="col-md-6"><a class="htxt_medium_14 dark_300" href="#"><span class="mr10"><img
                                src="assets/images/plus_icon.svg"/></span>Contact Details</a></div>
                            <div class="col-md-6 text-right"><a class="htxt_medium_14 dark_300" href="#">Assign Contact
                                <span class="ml10"><img src="assets/images/plus_icon.svg"/></span></a></div>
                        </div>
                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                <input type="hidden" name="module_account_id" id="module_account_id"
                                       :value="moduleAccountID">

                                <button type="submit"
                                        class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">Save
                                </button>
                                <a class="blue_300 fsize16 fw600 ml20" href="#">Close</a></div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

</template>
<script>
    import WorkflowSubscribers from '@/components/admin/workflow/WorkflowSubscribers.vue';

    export default {
        data() {
            return {
                successMsg : '',

                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                activeCount: 0,
                archiveCount: 0,
                subscribers: {},
                allData: {},
                segmentInfo: {},
                current_page: 1,
                breadcrumb: '',
                profileID : this.$route.params.id,


            }
        },
        components: {'workflow-subscribers': WorkflowSubscribers},
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            loadPaginatedData : function(){
                axios.get('/admin/broadcast/segmentcontacts/'+this.profileID +'?page='+this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.subscribers = response.data.subscribersData;
                        this.allData = response.data.allData;
                        this.segmentInfo = response.data.segmentInfo;
                        this.activeCount = response.data.activeCount;
                        this.archiveCount = response.data.archiveCount;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.loading = false;
                        /*let elem = this;
                        setTimeout(function(){
                            elem.successMsg = 'This is a success message';
                            elem.loading = false;
                        }, 10000);*/



                    });
            },

            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            syncContacts: function(segmentID) {
                if(confirm('Are you sure you want to perform this action?')){
                    this.loading = true;
                    //Do axios
                    axios.post('/admin/segments/syncSegment', {
                        segmentID:segmentID,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.loading = false;
                                this.displayMessage('success', 'Segment contacts have been synced successfully!');
                            }

                        })
                        .catch(error => {
                            this.loading = false;
                            //error.response.data
                            alert('Something went wrong.');
                        });
                }
            }
        }

    };

</script>



