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
                        <h3 class="htxt_medium_24 dark_700">List Subscribers:: {{capitalizeFirstLetter(setStringLimit(listName, 14))}}</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button type="button" class="btn btn-md bkg_blue_200 light_000 importModuleContact" data-modulename="list"
                                :data-moduleaccountid="listID"
                                data-redirect="/admin/contacts/mycontacts"><i
                            class="icon-arrow-up16 bkg_blue_200 light_000"></i><span> &nbsp;  Import Contact</span></button>
                        <a :href="`/admin/subscriber/exportSubscriberCSV?module_name=list&module_account_id=${ listID }`">
                            <button type="button" class="btn btn-md bkg_blue_200 light_000"><i
                                class="icon-arrow-down16 bkg_blue_200 light_000"></i><span> &nbsp;  Export Contact</span></button> </a>
                        <button class="circle-icon-40 mr15"><img src="/assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000"  @click="displayForm('Create')">New Subscriber<span><img
                            src="/assets/images/blue-plus.svg"/></span></button>
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
                @prepareUpdate="getContactInfo"
                :key="subscribers"
            ></workflow-subscribers>
        </div>


        <!--Smart Popup-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"><a class="cross_icon js-contact-subscriber-slidebox"><i
                    class=""><img src="/assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="processForm">
                        <div class="p40">
                            <div class="row">
                                <div class="col-md-12"><img src="/assets/images/create_cotact_people.svg"/>
                                    <h3 class="htxt_medium_24 dark_800 mt20">{{formLabel}} New Subscriber </h3>
                                    <hr>
                                </div>

                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="firstname">First name</label>
                                        <input type="text" class="form-control h56" v-model="form.firstname"
                                               name="firstname" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Last name</label>
                                        <input type="text" class="form-control h56" v-model="form.lastname"
                                               name="lastname" placeholder="Enter last name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control h56" v-model="form.email"
                                               name="email" placeholder="Enter email address">
                                    </div>
                                    <!--<div class="form-group">
                                      <label for="pwd">Phone number</label>
                                      <input type="text" class="form-control h56" id="pwd" placeholder="Enter phone number" name="pswd">
                                    </div>-->
                                    <div class="form-group">
                                        <label for="phone">Phone number</label>
                                        <input type="number" class="form-control" v-model="form.phone"
                                               name="phone" placeholder="Enter phone number">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <div class="clearfix"></div>
                                        <select class="form-control h52" name="gender" id="gender" v-model="form.gender">
                                            <!-- <option>Select Gender</option> -->
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Countries</label>
                                        <div class="clearfix"></div>
                                        <select class="form-control h52" name="country_code" id="country_code" v-model="form.country_code">
                                            <option v-for="countries in countriesList" :value="countries.country_code">{{ countries.name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cityName">City</label>
                                        <input type="text" class="form-control h56" name="cityName" v-model="form.cityName"
                                               placeholder="Enter city name">
                                    </div>
                                    <div class="form-group">
                                        <label for="stateName">State</label>
                                        <input type="text" class="form-control h56" name="stateName" v-model="form.stateName"
                                               placeholder="Enter state name">
                                    </div>
                                    <div class="form-group">
                                        <label for="zipCode">Zipcode</label>
                                        <input type="text" class="form-control h56" name="zipCode" v-model="form.zipCode"
                                               placeholder="Enter zip code">
                                    </div>
                                </div>

                            </div>
                            <div class="row bottom-position">
                                <div class="col-md-12 mb15">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="list_id" id="list_id" :value="this.$route.params.id">
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

        <!-- Import Popup -->
        <div id="importCentralCSV" class="modal modalpopup fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" class="form-horizontal" action="/admin/subscriber/importSubscriberCSV" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Import Contacts CSV</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <div class="alert-danger" style="margin-bottom:10px;">{{ error_message }}</div>

                            <!-- <div class="form-group">
                               <label class="control-label col-lg-3">Import CSV</label>
                               <div class="col-lg-9">
                                   <input type="file" name="userfile" style="margin-top:3px;" accept=".csv, application/vnd.ms-excel" required>
                               </div>
                           </div>  -->


                            <div class="form-group">
                                <label class="control-label">Import CSV</label>
                                <div class="">
                                    <input type="file" name="userfile"  accept=".csv, application/vnd.ms-excel" class="form-control h52" style="padding-left: 182px; padding-top: 14px;" data-icon="false" required>
                                </div>
                            </div>

                            <!-- <label class="w100" for="myinputfile" >Import CSV
                               <div class="myfilebrowse">
                                 <input class="hidden" type="file" id="myinputfile"/>
                               </div>
                           </label>  -->

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="module_name" id="import_active_module_name" value="">
                            <input type="hidden" name="module_account_id" id="import_module_account_id" value="">
                            <input type="hidden" name="redirect_url" id="import_redirect_url" value="">
                            <!-- <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Import</button> -->
                            <button type="submit" class="btn dark_btn bkg_sblue fsize14 h52"> Import</button>
                            <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Import Popup -->

    </div>

</template>
<script>
    import WorkflowSubscribers from '@/components/admin/workflow/WorkflowSubscribers.vue';

    export default {
        components: {'workflow-subscribers': WorkflowSubscribers},
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
                listName: '',
                current_page: 1,
                breadcrumb: '',
                countriesList: '',
                listID : this.$route.params.id,
                form: {
                    firstname: '',
                    lastname: '',
                    email: '',
                    phone: '',
                    gender: '',
                    country_code: '',
                    cityName: '',
                    stateName: '',
                    zipCode: '',
                    list_id: this.$route.params.id,
                    id: ''
                },
                formLabel: 'Create'

            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-contact-subscriber-slidebox').click();
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
                            this.form.gender = formData.gender;
                            this.form.country_code = formData.country_code;
                            this.form.cityName = formData.cityName;
                            this.form.stateName = formData.stateName;
                            this.form.zipCode = formData.zipCode;
                            this.form.id = formData.id;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);

                            //document.get    '.js-contact-slidebox'

                        }

                    });
            },
            prepareContactUpdate: function(contactId) {
                this.$emit('prepareUpdate', {contactId});
            },
            processForm : function(){
                this.showLoading(true);
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                this.form.list_id = this.$route.params.id;
                if(this.form.id>0){
                    formActionSrc = '/admin/subscriber/update_contact';
                }else{
                    formActionSrc = '/admin/subscriber/add_contact';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.showLoading(false);
                            //this.form = {};
                            this.form.id ='';
                            document.querySelector('.js-contact-subscriber-slidebox').click();
                            this.displayMessage('success', 'Action completed successfully.');
                            var elem = this;
                            setTimeout(function () {
                                elem.loadPaginatedData();
                            }, 500);

                            syncContactSelectionSources();
                        }
                    })
                    .catch(error => {
                        this.showLoading(false);
                        console.log(error);
                        //error.response.data
                        alert('All form fields are required');
                    });
            },
            loadPaginatedData : function(){
                axios.get('/admin/lists/getListContacts?list_id='+this.listID +'&page='+this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.subscribers = response.data.subscribersData;
                        this.allData = response.data.allData;
                        this.listName = response.data.listName;
                        this.countriesList = response.data.countriesList;
                        this.activeCount = response.data.activeCount;
                        this.archiveCount = response.data.archiveCount;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.showLoading(false);
                        /*let elem = this;
                        setTimeout(function(){
                            elem.successMsg = 'This is a success message';
                            elem.loading = false;
                        }, 10000);*/

                    });
            },

            navigatePagination: function(p){
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            }
        }

    };

    $(document).ready(function () {
        $(document).on('click', '.js-contact-subscriber-slidebox', function(){
            /*$('[name=tags]').tagify();*/
            $(".box").animate({
                width: "toggle"
            });
        });

        $(document).on("click", ".importModuleContact", function () {
            var moduleaccountid = $(this).attr('data-moduleaccountid');
            var modulename = $(this).attr('data-modulename');
            var redirectURL = $(this).attr('data-redirect');
            $("#import_module_account_id").val(moduleaccountid);
            $("#import_active_module_name").val(modulename);
            $("#import_redirect_url").val(redirectURL);
            $("#importCentralCSV").modal();
        });

    });

</script>



