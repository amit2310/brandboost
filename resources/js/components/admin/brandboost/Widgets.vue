<template>
    <div class="content" id="masterContainer">
        <!--******************
          Top Heading area
         **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Onsite Widgets</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-list-slidebox">Add Widget<span><img src="assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <!--******************
              Content Area
             **********************-->
            <div class="content-area">
                <div v-if="widgets" class="container-fluid">
                    <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
                    <loading :isLoading="loading"></loading>
                    <div class="table_head_action">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="htxt_medium_16 dark_400">Onsite Widgets</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="table_action">
                                    <div class="float-right">
                                        <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                            <span><img src="assets/images/date_created.svg"/></span>&nbsp; Date Created
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Link 1</a>
                                            <a class="dropdown-item" href="#">Link 2</a>
                                            <a class="dropdown-item" href="#">Link 3</a>
                                        </div>
                                    </div>
                                    <div class="float-right ml10 mr10">
                                        <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                            <span><img src="assets/images/list_view.svg"/></span>&nbsp; List View
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Link 1</a>
                                            <a class="dropdown-item" href="#">Link 2</a>
                                            <a class="dropdown-item" href="#">Link 3</a>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <input class="table_search" type="text" placeholder="Search" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div v-for="widget in widgets" class="col-md-3 text-center">
                            <div class="card  h235 animate_top" style="padding:10px!important;">
                                <div class="dot_dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a v-if="widget.countSubscribers > 0" class="dropdown-item" href="javascript:void(0);" @click="showListSubscribers(widget.id)"><i class="dripicons-user text-muted mr-2"></i> View Contacts</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="prepareListUpdate(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                        <a v-if="widget.status == 'inactive' && widget.status != 'archive'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, 'active')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                        <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, 'inactive')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                        <a v-if="widget.status != 'archive'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, 'archive')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteList(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                    </div>
                                </div>
                                <div @click="showListSubscribers(widget.id)" style="cursor:pointer;">
                                    <img class="mt20" src="assets/images/subs-icon_big.svg">
                                    <h3 class="htxt_bold_16 dark_700">
                                        <span>{{capitalizeFirstLetter(setStringLimit(widget.widget_title, 20))}}</span>
                                    </h3>
                                    <p v-if="widget.brand_title"><em>({{ widget.brand_title }})</em></p>
                                    <p class="htxt_regular_12 dark_300 mb15"><i><img src="assets/images/user_16_grey.svg"/></i> {{ widget.countSubscribers }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 text-center js-list-slidebox" style="cursor: pointer;">
                            <div class="card p30 bkg_light_200 shadow_none h235 animate_top">
                                <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                                <p class="htxt_regular_16 dark_100 mb15">Create<br>contacts list</p>
                            </div>
                        </div>

                    </div>
                    <pagination
                        :pagination="allData"
                        @paginate="showPaginationData"
                        :offset="4">
                    </pagination>

                    <!--<div class="table_head_action mt10">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="htxt_medium_16 dark_400">Latest contacts</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="table_action">
                                    <div class="float-right">
                                        <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                            <span><img src="assets/images/date_created.svg"/></span>&nbsp; Date Created
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Link 1</a>
                                            <a class="dropdown-item" href="#">Link 2</a>
                                            <a class="dropdown-item" href="#">Link 3</a>
                                        </div>
                                    </div>
                                    <div class="float-right ml10 mr10">
                                        <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                            <span><img src="assets/images/list_view.svg"/></span>&nbsp; List View
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Link 1</a>
                                            <a class="dropdown-item" href="#">Link 2</a>
                                            <a class="dropdown-item" href="#">Link 3</a>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <input class="table_search" type="text" placeholder="Search" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td><span class="table-img mr15"><img src="assets/images/table_user.png"/></span> <span class="htxt_medium_14 dark_900">Courtney Black</span></td>
                                        <td class="text-right">nina.hernandez@example.com</td>
                                        <td># lead, subscriber</td>
                                        <td><span class="badge badge-dark">+4</span></td>
                                        <td>Customer</td>
                                        <td><span class="dot_6 bkg_blue_300">&nbsp;</span></td>
                                        <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><span class="table-img mr15"><img src="assets/images/table_user2.png"/></span> <span class="htxt_medium_14 dark_900">Savannah Webb</span></td>
                                        <td class="text-right">ivan.carter@example.com</td>
                                        <td># lead, subscriber</td>
                                        <td><span class="badge badge-dark">+4</span></td>
                                        <td>Ticket</td>
                                        <td><span class="dot_6 bkg_yellow_500">&nbsp;</span></td>
                                        <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><span class="table-img mr15"><img src="assets/images/table_user3.png"/></span> <span class="htxt_medium_14 dark_900">Bessie Flores</span></td>
                                        <td class="text-right">tim.jennings@example.com</td>
                                        <td># lead, subscriber</td>
                                        <td><span class="badge badge-dark">+4</span></td>
                                        <td>Customer</td>
                                        <td><span class="dot_6 bkg_blue_300">&nbsp;</span></td>
                                        <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><span class="table-img mr15"><img src="assets/images/table_user4.png"/></span> <span class="htxt_medium_14 dark_900">Dianne Mckinney</span></td>
                                        <td class="text-right">logan.hopkins@example.com</td>
                                        <td># lead, subscriber</td>
                                        <td><span class="badge badge-dark">+4</span></td>
                                        <td>Ticket</td>
                                        <td><span class="dot_6 bkg_yellow_500">&nbsp;</span></td>
                                        <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><span class="table-img mr15"><img src="assets/images/table_user2.png"/></span> <span class="htxt_medium_14 dark_900">Dianne Mckinney</span></td>
                                        <td class="text-right">logan.hopkins@example.com</td>
                                        <td># lead, subscriber</td>
                                        <td><span class="badge badge-dark">+4</span></td>
                                        <td>Ticket</td>
                                        <td><span class="dot_6 bkg_yellow_500">&nbsp;</span></td>
                                        <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                                        </td>
                                    </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>-->

                </div>

                <div v-else class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card_shadow min-h-280">
                                <div class="row mb65">

                                    <div class="col-md-12 text-center">
                                        <img class="mt40" style="max-width: 225px; " src="assets/images/illustration2.png">
                                        <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any Onsite widgets</h3>
                                        <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import!</h3>
                                        <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-list-slidebox">Add Onsite widgets</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                            <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                            Learn how to use onsite widgets
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--******************
              Content Area
             **********************-->
        </div>
    </div>
</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Onsite Widgets - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {
                form: {
                    title: '',
                    listDescription: '',
                    list_id: ''
                },
                formLabel: 'Create',
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                allData: '',
                widgets: '',
                current_page: 1,
                bActiveSubsription: '',
                oStats: '',
                user_role: ''
            }
        },
        mounted() {
            this.loadPaginatedData();

            console.log('Component mounted')
        },
        methods: {
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-list-slidebox').click();
            },
            prepareListUpdate: function(listId) {
                this.getListInfo(listId);
            },
            getListInfo: function(listId){
                axios.post('/admin/lists/getList', {
                    list_id:listId,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.title = formData.title;
                            this.form.listDescription = formData.description;
                            this.form.list_id = formData.list_id;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }

                    });
            },
            processForm : function(){
                this.loading = true;
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.list_id>0){
                    formActionSrc = '/admin/lists/updatePeopleList';
                }else{
                    formActionSrc = '/admin/lists/addList';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.loading = false;
                            //this.form = {};
                            this.form.list_id ='';
                            document.querySelector('.js-list-slidebox').click();
                            this.successMsg = 'Action completed successfully.';
                            var elem = this;
                            setTimeout(function () {
                                elem.loadPaginatedData();
                            }, 500);

                            syncContactSelectionSources();
                        }
                        else if (response.data.status == 'error') {
                            if (response.data.type == 'duplicate') {
                                alert('Error: List already exists.');
                            }
                            else {
                                alert('Error: Something went wrong.');
                            }
                        }
                    })
                    .catch(error => {
                        this.loading = false;
                        console.log(error);
                        //error.response.data
                        alert('All form fields are required');
                    });
            },
            loadPaginatedData: function () {
                //getData
                axios.get('/admin/brandboost/widgets?page='+this.current_page)
                    .then(response => {
                        //console.log(response.data);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.loading = false;
                        this.allData = response.data.allData;
                        this.widgets = response.data.oWidgetsList;
                        this.oStats = response.data.oStats;
                        this.bActiveSubsription = response.data.bActiveSubsription;
                        this.user_role = response.data.user_role;
                    });
            },
            showPaginationData: function (current_page) {
                this.navigatePagination(current_page);
            },
            navigatePagination: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            changeStatus: function(listID, status) {
                if(confirm('Are you sure you want to change the status of this list?')){
                    //Do axios
                    axios.post('/admin/lists/changeListStatus', {
                        list_id:listID,
                        status:status,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.showPaginationData(this.current_page);
                            }

                        });
                }
            },
            deleteList: function(listID) {
                if(confirm('Are you sure you want to delete this list?')){
                    //Do axios
                    axios.post('/admin/lists/deleteLists', {
                        list_id:listID,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.showPaginationData(this.current_page);
                            }

                        });
                }
            }
        }
    }
</script>

<style>

</style>
