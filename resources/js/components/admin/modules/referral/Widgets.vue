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
                        <h3 class="htxt_medium_24 dark_700">Referral Widgets</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-referral-widget-slidebox">New Referral Widget<span><img src="assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <!--******************
              Content Area
             **********************-->
            <div class="content-area">
                <div v-if="widgets" class="container-fluid">


                    <div class="table_head_action">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="htxt_medium_16 dark_400">{{ widgets.length }} Referral Widgets</h3>
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
                            <div class="card  h235 animate_top" style="padding:0px!important;">
                                <div class="dot_dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" @click="navigateToWidgetSetup(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                        <a v-if="(widget.status == '0' || widget.status == '2') && widget.status != '3'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Start</a>
                                        <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '2')"><i class="dripicons-user text-muted mr-2"></i> Pause</a>
                                        <a v-if="widget.status != '3'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '3')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                        <a class="dropdown-item viewECode" href="javascript:void(0);" :widgetID="widget.id"><i class="dripicons-user text-muted mr-2"></i> Get Embedded Code</a>
                                    </div>
                                </div>
                                <div>
                                    <img class="mt20" src="assets/images/subs-icon_big.svg">
                                    <h3 class="htxt_bold_16 dark_700" @click="navigateToWidgetSetup(widget.id)" style="cursor: pointer;">
                                        <span>{{capitalizeFirstLetter(setStringLimit(widget.widget_title, 20))}}</span>
                                    </h3>
                                    <p v-if="widget.widget_desc != ''"><em>{{capitalizeFirstLetter(setStringLimit(widget.widget_desc, 40))}}</em></p>

                                    <p v-if="widget.referralData.title != ''" class="htxt_regular_12" @click="navigateToReferralSetup(widget.referralData.id)" style="cursor: pointer;">{{ setStringLimit(widget.referralData.title, 40) }}</p>

                                    <p class="htxt_regular_12">
                                        <span v-if="widget.status  == '1'">Published</span>
                                        <span v-else-if="widget.status == '2'">Paused</span>
                                        <span v-else-if="widget.status == '3'">Archived</span>
                                        <span v-else>Draft</span>
                                        &nbsp;|&nbsp;
                                        {{ displayDateFormat('M d, h:i A', widget.created) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 text-center js-referral-widget-slidebox" style="cursor: pointer;">
                            <div class="card p30 bkg_light_200 shadow_none h235 animate_top">
                                <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                                <p class="htxt_regular_16 dark_100 mb15">Create<br>Referral Widgets</p>
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
                                        <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any Referral widgets</h3>
                                        <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import!</h3>
                                        <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-referral-widget-slidebox">Add Referral Widget</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                            <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                            Learn how to use referral widgets
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
                    <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-referral-widget-slidebox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                        <form method="post" @submit.prevent="processForm">
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img src="assets/images/list-icon.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} Referral Widget</h3>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="referralTitle">Widget name</label>
                                            <input type="text" class="form-control h56" id="referralTitle" placeholder="Enter widget name" name="referralTitle"
                                                   v-model="form.referralTitle">
                                        </div>
                                        <div class="form-group">
                                            <label for="desc">Description</label>
                                            <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="Description"
                                                      name="description"
                                                      v-model="form.description"></textarea>
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
                                        <a class="blue_300 fsize16 fw600 ml20" href="#">Close</a> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="viewEModel" class="modal fade in">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Embedded Widget Code</h5>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12" id="embeddedCode" style="border:1px #ccc solid; padding:10px; margin:0 5px 10px;"></div>
                        </div>
                        <hr>
                        <div class="modal-footer">
                            <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                        </div>
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
        title: 'Onsite Widgets - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {
                form: {
                    referralTitle: '',
                    description: ''
                },
                formLabel: 'Create',



                breadcrumb: '',
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                allData: '',
                widgets: '',
                current_page: 1,
                bActiveSubsription: '',
                user_role: ''
            }
        },
        mounted() {
            this.loadPaginatedData();

            console.log('Component mounted')
        },
        methods: {
            navigateToReferralSetup(wId) {
                window.location.href = '#/modules/referral/setup/'+wId+'/1';
            },
            navigateToWidgetSetup(wId) {
                // window.location.href = '#/modules/referral/referral_widget_setup/'+wId;
                window.location.href = '#/modules/referral/widget/setup/'+wId+'/1';
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-referral-widget-slidebox').click();
            },
            prepareUpdate: function(wId) {
                this.navigateToOnsiteWidgetSetup(wId);
            },
            getInfo: function(wId){
                axios.post('/admin/lists/getList', {
                    wid:wId,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.campaignName = formData.campaignName;
                            this.form.wid = formData.wid;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }

                    });
            },
            processForm : function(){
                this.showLoading(true);
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.wid>0){
                    formActionSrc = '/admin/lists/updatePeopleList';
                }else{
                    formActionSrc = '/admin/modules/referral/addReferralWidget';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.showLoading(false);
                            this.form.wid ='';
                            document.querySelector('.js-referral-widget-slidebox').click();
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
                axios.get('/admin/modules/referral/widgets?page='+this.current_page)
                    .then(response => {
                        //console.log(response.data);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.showLoading(false);
                        this.allData = response.data.allData;
                        this.widgets = response.data.oWidgetsList;
                        this.bActiveSubsription = response.data.bActiveSubsription;
                        this.user_role = response.data.user_role;
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
                    axios.post('/admin/modules/referral/updatReferralWidgetStatus', {
                        widgetID:wID,
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
                    axios.post('/admin/modules/referral/delete_referral_widget', {
                        widget_id:wId,
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
        $(document).on('click', '.js-referral-widget-slidebox', function () {
            $(".box").animate({
                width: "toggle"
            });
        });

        /*$('[name=tags]').tagify();*/

        $(document).on('click', '.viewECode', function () {
            var widgetID = $(this).attr('widgetID');

            $.ajax({
                url: 'admin/modules/referral/getReferralWidgetEmbedCode',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: {widget_id: widgetID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var embeddedCode = data.result;
                        $('#embeddedCode').html(embeddedCode);
                        $("#viewEModel").modal();
                    }
                }
            });
        });

    });
</script>
