<template>
    <div>
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7 col-7">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">People Contact List</h3>
                    </div>
                    <div class="col-md-2 col-2 text-left">
                        <a class="lh_32 blue_400 htxt_bold_14" href="#/contacts/import">
                            <span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="/assets/images/download-fill.svg"/></span>
                            Import contacts
                        </a>
                    </div>
                    <div class="col-md-3 col-3 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000" @click="displayForm('Create')">New Contact List <span><img
                            src="/assets/images/blue-plus.svg"/></span></button>
                        <button class="js-contact-slidebox" v-show="false">
                            Display Form
                        </button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="content-area">
            <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
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
                @prepareUpdate="getContactInfo"
                :key="current_page"
            ></workflow-subscribers>
        </div>
        <!--Smart Popup-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"><a class="cross_icon js-contact-slidebox"><i
                    class=""><img src="/assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="processForm">
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"><img src="/assets/images/create_cotact_people.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">{{formLabel}} Contact </h3>
                                <hr>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txtfirstname">First name</label>
                                        <input type="text" class="form-control h56" id="txtfirstname" v-model="form.firstname" name="firstname" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtlastname">Last name</label>
                                        <input type="text" class="form-control h56" id="txtlastname" v-model="form.lastname" placeholder="Enter last name">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtemail">Email</label>
                                        <input type="email" class="form-control h56" id="txtemail" v-model="form.email" placeholder="Enter email address">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtphone">Phone number</label>
                                        <div class="phonenumber">
                                            <div class="float-left">
                                                <button type="button" class="dropdown-toggle table_action_dropdown p0 mt10" data-toggle="dropdown">
                                                    <span><img src="assets/images/USA.png"/></span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);">Link 1</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Link 2</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Link 3</a>
                                                </div>
                                            </div>
                                            <input type="number" class="inputbox" id="txtphone" v-model="form.phone" placeholder="Enter phone number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tags">Tags</label>
                                        <div class="clearfix"></div>
                                        <input type="text" class="form-control h56" id="tags" value='Removeable Tag, Other Tag' name="tags" style="display: none">
                                    </div>
                                </div>
                        </div>
                        <div class="row mb50">
                            <div class="col-md-6">
                                <a class="htxt_medium_14 dark_300" href="javascript:void(0);">
                                    <span class="mr10">
                                        <img src="assets/images/plus_icon.svg"/>
                                    </span>Contact Details
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="htxt_medium_14 dark_300" href="javascript:void(0);">Assign Contact
                                    <span class="ml10"><img src="assets/images/plus_icon.svg"/></span>
                                </a>
                            </div>
                        </div>
                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                <input type="hidden" name="module_account_id" id="module_account_id" :value="moduleAccountID">
                                <button type="submit" class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">Save </button>
                                <a class="blue_300 fsize16 fw600 ml20" href="javascript:void(0);">Close</a></div>
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
        props: ['pageColor'],
        data() {
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                activeCount: 0,
                archiveCount: 0,
                subscribers: {},
                allData: {},
                current_page: 1,
                breadcrumb: '',
                form: {
                    firstname: '',
                    lastname: '',
                    email: '',
                    phone: '',
                    id: ''
                },
                formLabel: 'Create'
            }
        },
        components: {'workflow-subscribers': WorkflowSubscribers},
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-contact-slidebox').click();
            },
            getContactInfo: function(contactId){
                axios.post('/admin/subscriber/getSubscriberDetail', {
                    module_subscriber_id:contactId,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data.result[0];
                            this.form.firstname = formData.firstname;
                            this.form.lastname = formData.lastname;
                            this.form.email = formData.email;
                            this.form.phone = formData.phone;
                            this.form.id = formData.id;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }
                    });
            },
            processForm : function(){
                this.loading = true;
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.id>0){
                    formActionSrc = '/admin/subscriber/update_contact';
                }else{
                    formActionSrc = '/admin/subscriber/add_contact';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.loading = false;
                            //this.form = {};
                            this.form.id ='';
                            document.querySelector('.js-contact-slidebox').click();
                            this.successMsg = 'Action completed successfully.';
                            var elem = this;
                            setTimeout(function () {
                                elem.loadPaginatedData();
                            }, 500);
                            syncContactSelectionSources();
                        }
                    })
                    .catch(error => {
                        this.loading = false;
                        console.log(error);
                        //error.response.data
                        //alert('All form fields are required');
                    });
            },
            loadPaginatedData : function(){
                axios.get('/admin/contacts/mycontacts?page='+this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.subscribers = response.data.subscribersData;
                        this.allData = response.data.allData;
                        this.activeCount = response.data.activeCount;
                        this.archiveCount = response.data.archiveCount;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.loading = false;
                    });
            },
            addNewContact : function(e){
                let form = document.getElementById('addNewContactVue');
                let formData = new FormData(form);
                formData.append('_token', this.csrf_token());
                axios.post('/admin/subscriber/add_contact', this)
                    .then(response => {
                        if(response.data.status == 'success'){
                            alert(('form submitted successfully'))
                            /*vm.$forceUpdate();*/
                        }

                    });
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            }
        }
    };
    $(document).ready(function () {
        $(document).on('click', '.js-contact-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });

    });
</script>
