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
                        <h3 class="htxt_medium_24 dark_700">Chat Widgets</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-chat-widget-slidebox">Add Chat Widget<span><img src="assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <!--******************
              Content Area
             **********************-->
            <div class="content-area">
                <div v-if="oPrograms" class="container-fluid">


                    <div class="table_head_action">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="htxt_medium_16 dark_400">Chat Widgets</h3>
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

                        <div v-for="oProgram in oPrograms" class="col-md-3 text-center">
                            <div class="card p30 h235 animate_top" style="padding:0px!important;">
                                <div class="dot_dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" @click="prepareUpdate(oProgram.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                        <a v-if="oProgram.status == 'draft' && oProgram.status != 'archive'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oProgram.id, 'active')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                        <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oProgram.id, 'draft')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                        <a v-if="oProgram.status != 'archive'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(oProgram.id, 'archive')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(oProgram.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                    </div>
                                </div>
                                <div @click="navigateToChatWidgetSetup(oProgram.id)" style="cursor:pointer;">
                                    <img class="mt20" src="assets/images/subs-icon_big.svg">
                                    <h3 class="htxt_bold_16 dark_700 mt25 mb15">
                                        <span>{{capitalizeFirstLetter(setStringLimit(oProgram.title, 20))}}</span>
                                    </h3>

                                    <!--<p v-if="oProgram.brandboost_id" class="htxt_regular_12">{{ oProgram.bbBrandTitle != '' ? 'Campaign: ' + setStringLimit(oProgram.bbBrandTitle, 20) : '[No Data]' }}</p>
                                    <p v-else class="htxt_regular_12">{{ oProgram.bbBrandTitle }}</p>

                                    <p class="htxt_regular_12">{{ setStringLimit(oProgram.bbBrandDesc, 40) }}</p>-->

                                    <p class="htxt_regular_12">
                                        <span v-if="oProgram.status  == 'active'">Published</span>
                                        <span v-else-if="oProgram.status == 'archive'">Archived</span>
                                        <span v-else>Inactive</span>
                                        &nbsp;|&nbsp;
                                        {{ displayDateFormat('M d, h:i A', oProgram.created) }}
                                    </p>
                                    <p>
                                        <img src="assets/images/table_graph.png" />
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 text-center js-chat-widget-slidebox" style="cursor: pointer;">
                            <div class="card p30 bkg_light_200 shadow_none h235 animate_top">
                                <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                                <p class="htxt_regular_16 dark_100 mb15">Create<br>Chat Widget</p>
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
                                        <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any Chat widgets</h3>
                                        <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import!</h3>
                                        <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-chat-widget-slidebox">Add Chat widgets</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                            <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                            Learn how to use chat widgets
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

            <!--******************
            Create Sliding Smart Popup
            **********************-->
            <div class="box" style="width: 424px;">
                <div style="width: 424px;overflow: hidden; height: 100%;">
                    <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-chat-widget-slidebox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                        <form method="post" @submit.prevent="processForm">
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img src="assets/images/list-icon.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} Chat Widget</h3>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Chat Name:</label>
                                            <input type="text" class="form-control h56" id="title" placeholder="Enter chat name" name="title"
                                                   v-model="form.title">
                                        </div>
                                    </div>
                                </div>

                                <div class="row bottom-position">
                                    <div class="col-md-12 mb15">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="chat_id" id="hidchatid" value="" />
                                        <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                        <input type="hidden" name="module_account_id" id="module_account_id"
                                               :value="moduleAccountID">
                                        <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">{{ formLabel }}</button>
                                        <a class="blue_300 fsize16 fw600 ml20" href="#">Close</a> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Chat Module - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {
                form: {
                    title: '',
                    chat_id: ''
                },
                formLabel: 'Create',


                loading: true,
                breadcrumb: '',
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                allData: '',
                oPrograms: '',
                current_page: 1,
                bActiveSubsription: ''
            }
        },
        mounted() {
            this.loadPaginatedData();

            console.log('Component mounted')
        },
        methods: {
            navigateToChatWidgetSetup(wId) {
                window.location.href = '#/modules/chat/setup/'+wId+'/1';
            },
            navigateStats(wId) {
                window.location.href = '#/brandboost/onsite_widget_stats/'+wId;
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-chat-widget-slidebox').click();
            },
            prepareUpdate: function(wId) {
                this.getInfo(wId);
            },
            getInfo: function(wId){
                axios.post('/admin/modules/chat/getChat', {
                    chat_id:wId,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.title = formData.title;
                            this.form.chat_id = formData.id;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }

                    });
            },
            processForm : function(){
                this.showLoading(true);
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.chat_id>0){
                    formActionSrc = '/admin/modules/chat/updateChat';
                }else{
                    formActionSrc = '/admin/modules/chat/addChat';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            if(response.data.id>0){
                                this.navigateToChatWidgetSetup(response.data.id);
                            }
                            this.showLoading(false);
                            this.form.chat_id ='';
                            document.querySelector('.js-chat-widget-slidebox').click();
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
            loadPaginatedData: function () {
                //getData
                axios.get('/admin/modules/chat/?page='+this.current_page)
                    .then(response => {
                        //console.log(response.data);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.showLoading(false);
                        this.allData = response.data.allData;
                        this.oPrograms = response.data.oPrograms;
                        this.bActiveSubsription = response.data.bActiveSubsription;
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
            changeStatus: function(wID, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/modules/chat/changeStatus', {
                        chatID:wID,
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
            deleteItem: function(wId) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/modules/chat/deleteChat', {
                        chat_id:wId,
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

    $(document).ready(function () {
        $(document).on('click', '.js-chat-widget-slidebox', function () {
            $(".box").animate({
                width: "toggle"
            });
        });

        /*$('[name=tags]').tagify();*/

    });
</script>
