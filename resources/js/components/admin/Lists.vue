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
                        <h3 class="htxt_medium_24 dark_700">People Contact Manager</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-list-slidebox">New List<span><img src="assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--******************
          Content Area
         **********************-->
        <div class="content-area">
            <div v-if="lists" class="container-fluid">


                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">{{allData.total}} Contact lists</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/date_created.svg"/></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);">Link 1</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Link 2</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/list_view.svg"/></span>&nbsp; List View
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);">Link 1</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Link 2</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Link 3</a>
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
                    <div v-for="list in lists" class="col-md-3 text-center">
                        <div class="card p30 h235 animate_top">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a v-if="list.countSubscribers > 0" class="dropdown-item" href="javascript:void(0);" @click="showListSubscribers(list.id)"><i class="dripicons-user text-muted mr-2"></i> View Contacts</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareListUpdate(list.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                    <a v-if="list.status == 'inactive' && list.status != 'archive'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(list.id, 'active')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                    <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(list.id, 'inactive')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                    <a v-if="list.status != 'archive'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(list.id, 'archive')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteList(list.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                </div>
                            </div>
                            <div v-if="list.countSubscribers > 0" @click="showListSubscribers(list.id)" style="cursor:pointer;">
                                <img class="mt20" src="assets/images/subs-icon_big.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">
                                    <span>{{capitalizeFirstLetter(setStringLimit(list.list_name, 20))}}</span>
                                </h3>
                                <p><em>({{ list.status }})</em></p>
                                <p class="htxt_regular_12 dark_300 mb15"><i><img src="assets/images/user_16_grey.svg"/></i> {{ list.countSubscribers }}</p>
                            </div>
                            <div v-else>
                                <img class="mt20" src="assets/images/subs-icon_big.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">
                                    <span>{{capitalizeFirstLetter(setStringLimit(list.list_name, 20))}}</span>
                                </h3>
                                <p><em>({{ list.status }})</em></p>
                                <p class="htxt_regular_12 dark_300 mb15"><i><img src="assets/images/user_16_grey.svg"/></i> {{ list.countSubscribers }}</p>
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
            </div>
            <div v-else class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">
                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 225px; " src="assets/images/illustration2.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any List contacts</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import!</h3>
                                    <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-list-slidebox">Add List Contact</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 blue_400 htxt_bold_14" href="javascript:void(0);">
                                        <span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="assets/images/download-fill.svg"/></span>
                                        Import contacts
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="javascript:void(0);">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                        Learn how to use contacts
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--******************
          Content Area End
         **********************-->
        <!--******************
          Create Contact Sliding Smart Popup
         **********************-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-list-slidebox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="processForm">
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="assets/images/list-icon.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} List </h3>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">List name</label>
                                        <input type="text" class="form-control h56" id="fname" placeholder="Enter list name" name="title"
                                               v-model="form.title">
                                    </div>
                                    <div class="form-group">
                                        <label for="phonenumber">Color</label>
                                        <div class="phonenumber">
                                            <div class="colorbox">
                                                <div class="colorpickerplus-dropdown" id="color_picker">
                                                    <button type="button" class="dropdown-toggle pickerbutton" data-toggle="dropdown">
                                                        <span class="color-fill-icon dropdown-color-fill-icon"></span> &nbsp; Pick a Color  &nbsp; <b class="caret"></b></button>
                                                    <ul class="dropdown-menu">
                                                        <li class="disabled"><div class="colorpickerplus-container"></div></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="List description"
                                                  name="listDescription"
                                                  v-model="form.listDescription"></textarea>
                                    </div>
                            </div>
                        </div>
                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                <input type="hidden" name="module_account_id" id="module_account_id"
                                       :value="moduleAccountID">
                                <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">{{ formLabel }}</button>
                                <a class="blue_300 fsize16 fw600 ml20" href="javascript:void(0);">Close</a> </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import PeopleListCreateSmartPopup from '@/components/helpers/PeopleListCreateSmartPopup';
    import Pagination from '@/components/helpers/Pagination';
    export default {
        title: 'Email Lists - Brand Boost',
        components: {UserAvatar, PeopleListCreateSmartPopup, Pagination},
        data() {
            return {
                form: {
                    title: '',
                    listDescription: '',
                    list_id: ''
                },
                formLabel: 'Create',



                breadcrumb: '',
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                lists: '',
                current_page: 1,
                allData: ''
            }
        },
        created() {
            this.loadPaginatedData();
        },
        methods: {
            showListSubscribers: function(listId){
                window.location.href='#/lists/getListContacts/'+listId;
            },
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
                this.showLoading(true);
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
                            this.showLoading(false);
                            //this.form = {};
                            this.form.list_id ='';
                            document.querySelector('.js-list-slidebox').click();
                            this.displayMessage('success', 'Action completed successfully.');
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
                        this.showLoading(false);
                        console.log(error);
                        //error.response.data
                        alert('All form fields are required');
                    });
            },
            loadPaginatedData: function () {
                //getData
                axios.get('/admin/lists/?page='+this.current_page)
                    .then(response => {
                        //console.log(response.data);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.showLoading(false);
                        this.lists = response.data.oLists;
                        this.allData = response.data.allData;
                    });
            },
            showPaginationData: function (current_page) {
                this.navigatePagination(current_page);
            },
            navigatePagination: function (p) {
                this.showLoading(true);
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
            },
            submitAddList: function () {
                this.showLoading(true);
                axios.post('/admin/lists/addList', this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.showLoading(false);
                            this.displayMessage('success', 'New List Added successfully');
                            this.form = {};
                            this.showPaginationData(this.current_page);
                        }
                    })
                    .catch(error => {
                        this.showLoading(false);
                        //error.response.data
                        alert('All form fields are required');
                    });
            }
        }
    }
    $(document).ready(function () {
        $(document).on('click', '.js-list-slidebox', function () {
            $(".box").animate({
                width: "toggle"
            });
        });
    });
</script>
