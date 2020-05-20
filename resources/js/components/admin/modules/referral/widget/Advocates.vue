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
                        <h3 class="htxt_medium_24 dark_700">Referral Advocates</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div class="content-area">

            <div v-if="programs.length > 0" class="container-fluid">


                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">{{ programs.length }} Referral Advocates</h3>
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

                    <div v-for="program in programs" class="col-md-3 text-center">
                        <div class="card p30 h235 animate_top">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right text-left">
                                    <span v-if="program.status !== 2">
                                        <a class="dropdown-item" href="javascript:void(0);" @click="changeStatus(program.id, '2')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                    </span>
                                    <span>
                                        <a v-if="program.status === 1" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(program.id, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                        <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(program.id, '1')"><i class="dripicons-user text-muted mr-2"></i>Active</a></i></a>
                                    </span>
                                    <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(program.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                </div>
                            </div>
                            <!--<div class="viewAdvocateSmartPopupNew" :data-modulecontactid="program.id" :data-modulesubscriberid="program.subscriber_id" :data-accountid="program.account_id">Popup{{program.subscriber_id}}</div>-->
                            <div v-if="program.id > 0" @click="showReferralSetup(program.id)" style="cursor:pointer;">
                                <img class="" src="assets/images/subs-icon_big.svg">
                                <h3 class="htxt_bold_16 dark_700  mb15">
                                    <span>{{ capitalizeFirstLetter(program.firstname) }} {{ capitalizeFirstLetter(program.lastname) }}</span>
                                    <br />
                                    <em><span style="font-weight: normal">{{ program.email }}</span></em>
                                </h3>
                                <p><em>( {{capitalizeFirstLetter(setStringLimit(program.referralData.title, 20))}}</em></p>
                                <p><em>[ Created On: {{ displayDateFormat("M d, Y h:i A", program.created) }} ]</em></p>
                            </div>
                            <div v-else>
                                <img class="" src="assets/images/subs-icon_big.svg">
                                <h3 class="htxt_bold_16 dark_700  mb15">
                                    <span>{{ capitalizeFirstLetter(program.firstname) }} {{ capitalizeFirstLetter(program.lastname) }}</span>
                                    <br />
                                    <em><span style="font-weight: normal">{{ program.email }}</span></em>
                                </h3>
                                <p><em>( {{capitalizeFirstLetter(setStringLimit(program.referralData.title, 20))}}</em></p>
                                <p><em>[ Created On: {{ displayDateFormat("M d, Y h:i A", program.created) }} ]</em></p>
                            </div>
                        </div>
                    </div>

                    <!--<div class="col-md-3 text-center js-referral-slidebox" style="cursor: pointer;">
                        <div class="card p30 bkg_light_200 shadow_none h235 animate_top">
                            <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                            <p class="htxt_regular_16 dark_100 mb15">Create<br>referral advocate</p>
                        </div>
                    </div>-->

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
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any Referral advocates</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create!</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    &nbsp;
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                        Learn how to use Referral advocates
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
        <div class="box smart-advocate-box" style="width: 680px;z-index:9999999999;">
            <div style="width: 680px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">
                    <div class="row" style="height: 100%;">
                        <div class="col-md-12">
                            <a style="left: 35px; top: 15px;" class="reviews smart-contact slide-toggle bkg_grey_light" ><i class=""><img src="/assets/images/icon_arrow_left.png"/></i></a>
                            <h5 style="padding-left: 75px;" class="panel-title">Advocate Report</h5>
                        </div>
                        <div id="advocateSmartPopupNew"></div>
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
        title: 'Referral Module - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {
                form: {
                    title: '',
                    source_type: '',
                    description: '',
                    ref_id: ''
                },
                formLabel: 'Create',
                bActiveSubsription: '',
                programId: this.$route.params.id,


                loading: true,
                breadcrumb: '',
                moduleName: 'referral',
                moduleUnitID: '',
                moduleAccountID: '',
                programs: '',
                current_page: 1,
                allData: ''
            }
        },
        mounted() {
            this.loadPaginatedData();
            console.log("Component Mounted");
        },
        methods: {
            showReferralSetup: function(programId){
                window.location.href='#/modules/referral/setup/'+programId;
            },
            loadPaginatedData: function () {
                //getData
                /*axios.get('/admin/modules/referral/advocates/'+this.programId+'?page='+this.current_page)*/
                axios.get('/admin/modules/referral/advocates/'+this.programId)
                    .then(response => {
                        //console.log(response.data);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.moduleAccountID = response.data.moduleAccountID;
                        this.showLoading(false);
                        this.allData = response.data.allData;
                        this.programs = response.data.oContacts;
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
            changeStatus: function(programId, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/subscriber/changeModuleContactStatus', {
                        subscriberId:programId,
                        contactStatus:status,
                        moduleName: this.moduleName.toLowerCase(),
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
            deleteItem: function(programId) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/subscriber/deleteModuleSubscriber', {
                        subscriberId:programId,
                        moduleName: this.moduleName.toLowerCase(),
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
        $(document).on('click', '.js-referral-slidebox', function () {
            $(".box").animate({
                width: "toggle"
            });
        });

        /*$('[name=tags]').tagify();*/


        $(".smart-contact").click(function () {
            $(".smart-advocate-box").animate({
                width: "toggle"
            });
        });

        $(document).on("click", ".viewAdvocateSmartPopupNew", function () {

            $("#advocateSmartPopupNew").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
            var contactId = $(this).attr('data-modulecontactid');
            var subscriberId = $(this).attr('data-modulesubscriberid');
            var accountID = $(this).attr('data-accountid');
            loadAdvocateSmartPopupNew(contactId,subscriberId, accountID);
            $(".smart-advocate-box").show();
        });
        $(".viewContactSmartPopup").first().trigger('click');
        $(".smart-advocate-box").hide();//For auto close

        $(document).on("click", ".addNoteButton2", function () {
            $('.overlaynew').show();
            var subscriberid = $("#subscriberid").val();
            var notes = $("#notes2").val();
            if (notes == '') {
                $('.overlaynew').hide();
                alertMessage('Please enter notes.');
            } else {
                $.ajax({
                    url: '/admin/contacts/add_contact_notes',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    type: "POST",
                    data: {notes: notes, subscriberid: subscriberid, type: 'smartpopup'},
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {
                            $('.overlaynew').hide();
                            $("#notes2").val('');
                            $("#contact-notes-container").html(response.notes);
                            $(".contactNewNote").tab('show');
                        }
                    },
                    error: function (response) {
                        $('.overlaynew').hide();
                        alertMessage(response.message);
                    }
                });
            }
        });

        var activityStart = 10;
        var activityEnd = 20;
        var activityDiff = activityEnd - activityStart;

        $(document).on('click', '.loadMoreActivity', function () {
            $('.activityShow').slice(activityStart, activityEnd).slideDown();
            activityStart = Number(activityStart) + Number(activityDiff);
            activityEnd = Number(activityEnd) + Number(activityDiff);
            if ($(".activityShow:hidden").length == 0) {
                $('.loadMoreRecordActivity').remove();
            }
        });

    });

    function loadAdvocateSmartPopupNew(contactId, subscriberID, accountId) {
        $.ajax({
            url: '/admin/modules/referral/advocateProfile/' + subscriberID,
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            type: "POST",
            data: {contactId: contactId, subscriberId: subscriberID, accountId: accountId, action: 'smart-popup'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var reviewData = data.content;
                    $("#advocateSmartPopupNew").html(reviewData);
                }
            }
        });
    }
</script>
