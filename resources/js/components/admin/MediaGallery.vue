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
                        <h3 class="htxt_medium_24 dark_700">Media Gallery Widgetsdddddddd</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-media-widget-slidebox">New Media Widgets<span><img src="assets/images/blue-plus.svg"/></span></button>
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
                                        <a class="dropdown-item" href="javascript:void(0);" @click="prepareUpdate(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                        <a v-if="widget.status == '0' && widget.status != '2'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                        <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                        <a v-if="widget.status != '2'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(widget.id, '2')"><i class="dripicons-user text-muted mr-2"></i> Move To Archive</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(widget.id)"><i class="dripicons-user text-muted mr-2"></i> Delete</a>
                                    </div>
                                </div>
                                <div style="cursor:pointer;">
                                    <span v-if="widget.gallery_logo != ''"><a class="icons" href="javascript:void(0);" @click="navigateToMediaSetup(widget.id)">
                                        <img :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/${widget.gallery_logo}`"
                                        onerror="this.src='/assets/images/wakerslogo.png'" class="img-circle br5 img-xs mt20 mb20" alt=""></a></span>
                                    <span v-else><img class="mt20 mb20" src="assets/images/subs-icon_big.svg"></span>

                                    <h3 class="htxt_bold_16 dark_700" @click="navigateToMediaSetup(widget.id)" style="cursor: pointer;">
                                        <span>{{capitalizeFirstLetter(setStringLimit(widget.name, 20))}}</span>
                                    </h3>
                                    <p class="getGalleryImage" :gallery-type="widget.gallery_type" :gallery-id="widget.id"><em>{{ widget.gallery_type < 3 ? '[Grid]' : '['+widget.gallery_type + ' Images]' }}</em></p>

                                    <p class="htxt_regular_12">
                                        <span v-if="widget.status  == '1'">Active</span>
                                        <span v-else-if="widget.status == '2'">Archived</span>
                                        <span v-else>Inactive</span>
                                        &nbsp;|&nbsp;
                                        {{ displayDateFormat('M d, h:i A', widget.created) }}
                                    </p>

                                    <p>
                                        Created By:
                                        <!--<span class="table-img mr15">
                                            <user-avatar
                                                :avatar="widget.createdByData.avatar"
                                                :firstname="widget.createdByData.firstname"
                                                :lastname="widget.createdByData.lastname"
                                                :width="32"
                                                :height="32"
                                                :fontsize="12"
                                            ></user-avatar>
                                        </span>-->
                                        {{ capitalizeFirstLetter(widget.createdByData.firstname) }} {{ capitalizeFirstLetter(widget.createdByData.lastname) }}
                                        <br />
                                        {{ widget.createdByData.email!='' ? '(' + capitalizeFirstLetter(widget.createdByData.email) + ')' : '' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 text-center js-media-widget-slidebox" style="cursor: pointer;">
                            <div class="card p30 bkg_light_200 shadow_none h235 animate_top">
                                <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                                <p class="htxt_regular_16 dark_100 mb15">Create<br>Media Widgets</p>
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
                                        <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any Media widgets</h3>
                                        <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import!</h3>
                                        <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-media-widget-slidebox">Add Media Widget</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                            <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"/></span>
                                            Learn how to use Media widgets
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
                    <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-media-widget-slidebox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                        <form method="post" @submit.prevent="processForm">
                            <div class="p40">
                                <div class="row">
                                    <div class="col-md-12"> <img src="assets/images/list-icon.svg"/>
                                        <h3 class="htxt_medium_24 dark_800 mt20">{{ formLabel }} Media Gallery</h3>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="referralTitle">Widget name</label>
                                            <input type="text" class="form-control h56" id="title" placeholder="Enter widget name" name="title"
                                                   v-model="form.title">
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
                                        <input type="hidden" name="editGalleryId" id="editGalleryId" value=""/>
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

            <div id="showGalleryImages" class="modal fade in">
                <div class="modal-dialog" style="width:1200px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><img src="/assets/images/menu_icons/List_Color.svg"/> Gallery Images &nbsp;
                                <i class="icon-info22 fsize12 txt_grey"></i></h5>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body" id="mediaGalleryPreview">
                            <div class="gallery_slider_widget"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link h52" data-dismiss="modal">Close</button>
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
        title: 'Media Gallery Widgets - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    editGalleryId: ''
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
            navigateToMediaSetup(wId) {
                window.location.href = '#/mediagallery/setup/'+wId;
            },
            navigateToWidgetSetup(wId) {
                window.location.href = '#/modules/referral/referral_widget_setup/'+wId;
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-media-widget-slidebox').click();
            },
            prepareUpdate: function(wId) {
                this.getInfo(wId);
            },
            getInfo: function(wId){
                axios.post('/admin/mediagallery/getMediaInfo', {
                    gallery_id:wId,
                    moduleName: this.moduleName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if(response.data.status == 'success'){
                            //Fill up the form fields
                            let formData = response.data;
                            this.form.editGalleryId = formData.gallery_id;
                            this.form.title = formData.title;
                            this.form.description = formData.description;
                            this.formLabel = 'Update';
                            this.displayForm(this.formLabel);
                        }

                    });
            },
            processForm : function(){
                this.showLoading(true);
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.editGalleryId>0){
                    formActionSrc = '/admin/mediagallery/updateGallery';
                }else{
                    formActionSrc = '/admin/mediagallery/addList';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.showLoading(false);
                            this.form.editGalleryId ='';
                            document.querySelector('.js-media-widget-slidebox').click();
                            this.displayMessage('success', 'Action completed successfully.');

                            this.navigateToMediaSetup(response.data.gallery_id);

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
                axios.get('/admin/mediagallery?page='+this.current_page)
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
                    axios.post('/admin/mediagallery/updateStatus', {
                        gallery_id:wID,
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
                    axios.post('/admin/mediagallery/deleteGallery', {
                        gallery_id:wId,
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

    /* Slideshow */
    var sliderBoxCount = 6;
    var slideIndex = 0;

    function showSlides(n = 1) {
        var i;
        var slides = document.getElementsByClassName("sliderImage");
        if (n > 0) {
            if (slides.length > sliderBoxCount + slideIndex) {
                slides[slideIndex].style.display = "none";
                slides[sliderBoxCount + slideIndex].style.display = "block";
                slideIndex++;
                document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#fff';
                document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#fff';
                if (slides.length == sliderBoxCount + slideIndex) {
                    document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#eee';
                }
            } else {
                document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#eee';
            }
        } else {
            if ((slides.length >= sliderBoxCount + slideIndex) && (slideIndex > 0)) {
                --slideIndex;
                slides[slideIndex].style.display = "block";
                slides[sliderBoxCount + slideIndex].style.display = "none";
                document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#fff';
                document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#fff';

                if (sliderBoxCount == sliderBoxCount + slideIndex) {
                    document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#eee';
                }
            } else {
                document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#eee';
            }
        }
    }
    /* Slideshow */

    $(document).ready(function () {
        $(document).on('click', '.js-media-widget-slidebox', function () {
            $(".box").animate({
                width: "toggle"
            });
        });

        /*$('[name=tags]').tagify();*/

        $(document).on('click', '.getGalleryImage', function (e) {
            $('.overlaynew').show();
            var galleryId = $(this).attr('gallery-id');
            sliderBoxCount = $(this).attr('gallery-type');
            e.preventDefault();
            $.ajax({
                url: "/admin/mediagallery/getGalleryImages",
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                method: "POST",
                data: {'gallery_id': galleryId},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $('.overlaynew').hide();
                    if (data.status == "success") {
                        //$('#mediaGalleryPreview .gallery_slider_widget').html('<div class="slides' + sliderBoxCount + '">' + data.sliderView + '</div>');
                        $('#mediaGalleryPreview .gallery_slider_widget').html('<div class="slides' + sliderBoxCount + '"></div>');
                        slideIndex = 0;
                        $('#showGalleryImages').modal();
                    } else {
                        alert('error');
                    }
                }
            });
        });
    });
</script>
