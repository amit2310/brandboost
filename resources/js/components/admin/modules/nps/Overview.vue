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
                        <h3 class="htxt_medium_24 dark_700">NPS Surveys</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-nps-slidebox">New NPS Survey<span><img src="assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div class="content-area">

            <div v-if="npsSurveys.length > 0" class="container-fluid">
                <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
                <loading :isLoading="loading"></loading>
                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">{{ npsSurveys.length }} NPS Surveys</h3>
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

                    <div v-for="nps in npsSurveys" class="col-md-3 text-center">
                        <div class="card p30 h235 animate_top">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" :href="'#/modules/nps/score/'+nps.hashcode" target="_blank"><i class="dripicons-user text-muted mr-2"></i> View Score</a>
                                    <a v-if="nps.status === 'inactive' && nps.status !== 'archive' && nps.status !== 'draft'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(nps.id, 'active')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                    <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(nps.id, 'inactive')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                    <a v-if="nps.status !== 'draft'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(nps.id, 'draft')"><i class="dripicons-user text-muted mr-2"></i> Draft</a>
                                    <a v-if="nps.status !== 'archive'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(nps.id, 'archive')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="prepareUpdate(nps.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(nps.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="showNpsStats(nps.id)"><i class="dripicons-user text-muted mr-2"></i> Stats</a>
                                    <a class="dropdown-item createSegment" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> Create Segment</a>
                                </div>
                            </div>
                            <div v-if="nps.id > 0" @click="showNpsSetup(nps.id)" style="cursor:pointer;">
                                <img class="mt20" src="assets/images/subs-icon_big.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">
                                    <span>{{capitalizeFirstLetter(setStringLimit(nps.title, 20))}}</span>
                                </h3>
                                <p><em>( Platform : {{ nps.platform }} / <strong>{{ nps.status }}</strong> )</em></p>
                                <p><em>[Created On: {{ displayDateFormat("M d, Y h:i A", nps.created) }} ]</em></p>
                            </div>
                            <div v-else>
                                <img class="mt20" src="assets/images/subs-icon_big.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">
                                    <span>{{capitalizeFirstLetter(setStringLimit(nps.title, 20))}}</span>
                                </h3>
                                <p><em>( Platform : {{ nps.platform }} / <strong>{{ nps.status }}</strong> )</em></p>
                                <p><em>[Created On: {{ displayDateFormat("M d, Y h:i A", nps.created) }} ]</em></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 text-center js-nps-slidebox" style="cursor: pointer;">
                        <div class="card p30 bkg_light_200 shadow_none h235 animate_top">
                            <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                            <p class="htxt_regular_16 dark_100 mb15">Create<br>NPS Survey</p>
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
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any NPS Survey</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create!</h3>
                                    <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-nps-slidebox">Add NPS Survey</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    &nbsp;
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                        Learn how to use NPS Survey
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
          Create New Sliding Smart Popup
         **********************-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-nps-slidebox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="processForm">
                        <div class="p40">
                            <div class="row">
                                <div class="col-md-12"> <img src="assets/images/list-icon.svg"/>
                                    <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} NPS Survey </h3>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">NPS Survey Name</label>
                                        <input type="text" class="form-control h56" id="fname" placeholder="Enter nps survey name" name="title"
                                               v-model="form.title">
                                    </div>

                                    <div class="form-group">
                                        <label for="fname">Platform</label>
                                        <select class="form-control" name="platform" v-model="form.platform" placeholder="Please Select">
                                            <option value="">Please Select</option>
                                            <option value="email">email</option>
                                            <option value="sms">sms</option>
                                            <option value="web">web</option>
                                            <option value="link">link</option>
                                        </select>
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

        <!-- Add Segment Popup -->
        <div id="addSegment" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" name="addBroadcastSegment" id="addBroadcastSegment" action="javascript:void();">
                        <div class="modal-header">
                            <h5 class="modal-title"><img src="/assets/css/menu_icons/Email_Color.svg"/> Add Segment &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Segment Title:</label>
                                        <input class="form-control" id="segmentName" name="segmentName" placeholder="Enter Segment Title" type="text" required>
                                        <div id="addSegmentValidation" style="color:#FF0000;display:none;"></div>

                                    </div>

                                    <div class="form-group mb0">
                                        <label>Segment Description:</label>
                                        <input class="form-control h52" type="text" id="segmentDescription" name="segmentDescription" value="" placeholder="Enter segment description"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-left">
                            <input type="hidden" value="" name="broadcastID" id="hidSegmentCampaignID">
                            <input type="hidden" value="Email" name="segmentType" id="hidSegmentType">
                            <input type="hidden" value="Email" name="campaignType" id="hidCampaignType">
                            <input type="hidden" value="Email" name="sendingMethod" id="hidSendingMethod">

                            <input type="hidden" :value="`${npsSurveys.moduleName}`" name="moduleName" />

                            <button data-toggle="modal" type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Continue</button>
                            <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</template>
<script>
    import UserAvatar from '../../../helpers/UserAvatar';
    import Pagination from '../../../helpers/Pagination';
    export default {
        title: 'NPS Module - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {
                form: {
                    title: '',
                    platform: '',
                    description: '',
                    nps_id: ''
                },
                formLabel: 'Create',
                bActiveSubsription: '',
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                npsSurveys: '',
                current_page: 1,
                allData: ''
            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            showNpsSetup: function(npsId){
                window.location.href='#/modules/nps/setup/'+npsId;
            },
            showNpsViewScore: function(hashcode) {
                window.location.href='#/modules/nps/score/'+hashcode;
            },
            showNpsStats: function(npsId) {
                window.location.href='#/modules/nps/stats/'+npsId;
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-nps-slidebox').click();
            },
            prepareUpdate: function(npsId) {
                this.getInfo(npsId);
            },
            getInfo: function(npsId){
                axios.post('/admin/modules/nps/getNPS', {
                    nps_id:npsId,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        //console.log(response.data);
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.title = formData.title;
                            this.form.platform = formData.platform;
                            this.form.description = formData.description;
                            this.form.nps_id = formData.id;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }
                    });
            },
            processForm : function(){
                this.loading = true;
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.nps_id > 0){
                    formActionSrc = '/admin/modules/nps/updateNPS';
                }else{
                    formActionSrc = '/admin/modules/nps/addNPS';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response =>  {
                        //console.log(response.data);
                        if (response.data.status == 'success') {
                            this.loading = false;
                            //this.form = {};
                            this.form.nps_id ='';

                            document.querySelector('.js-nps-slidebox').click();
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
                axios.get('/admin/modules/nps/?page='+this.current_page)
                    .then(response => {
                        //console.log(response.data);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.loading = false;
                        this.npsSurveys = response.data.oPrograms;
                        this.allData = response.data.allData;
                        //console.log(this.npsSurveys);
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
            changeStatus: function(npsId, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/modules/nps/changeStatus', {
                        npsId:npsId,
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
            deleteItem: function(npsId) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/modules/nps/deleteNPS', {
                        nps_id:npsId,
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

    };

    $(document).ready(function () {
        $(document).on('click', '.js-nps-slidebox', function () {
            $(".box").animate({
                width: "toggle"
            });
        });

        $('[name=tags]').tagify();

        /* Create Segment */
        $(document).on("click", ".createSegment", function () {

            var campaignID = $(this).attr('campaign-id');
            var segmentType = $(this).attr('segment-type');
            var campaignType = $(this).attr('campaign-type');
            var sendingMethod = $(this).attr('sending_method');
            $("#hidSegmentCampaignID").val(campaignID);
            $("#hidSegmentType").val(segmentType);
            $("#hidCampaignType").val(campaignType);
            $("#hidSendingMethod").val(sendingMethod);
            $("#addSegment").modal("show");
        });

        $('#addBroadcastSegment').submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            var tkn = $('meta[name="_token"]').attr('content');
            $.ajax({
                url: "/admin/broadcast/createSegment",
                type: "POST",
                data: formData + '&_token=' + tkn,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        displayMessagePopup('sccess', '', 'Segment created successfully!');
                        $("#addSegment").modal("hide");

                    } else if (data.status == 'error' && data.msg == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#addSegmentValidation").html('Segment with the same name already exists. Choose other title please').show();
                        setTimeout(function () {
                            $("#addSegmentValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });
    });
</script>

<style>

</style>
