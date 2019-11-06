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
                        <h3 class="htxt_medium_24 dark_700">People Contact Import</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right d-none">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 slidebox">Main Action <span><img src="assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div class="content-area">
            <div class="container-fluid">

                <div id="upload-file-step-1">
                    <div class="table_head_action bbot pb30">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="import_list">
                                    <li><a class="active" href="#">Select import type</a></li>
                                    <li><a class="" href="#">Upload contacts</a></li>
                                    <li><a href="#">Match fields</a></li>
                                    <li><a href="#">Confirm Import</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="htxt_bold_18 dark_700 mt30">How do you want to import contact?</h3>
                            <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import!</h3>
                        </div>
                    </div>


                    <div class="row mt30">
                        <div class="col-md-3 text-center" @click="uploadFile()" style="cursor: pointer;">
                            <div class="card p30 min_h_240">
                                <img src="assets/images/create-contact.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">Import contact <br>from a file</h3>
                                <p class="htxt_regular_12 dark_300 mb10">Upload .csv or .txt files from your computer</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="card p30 min_h_240">
                                <img src="assets/images/edit_new_write.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">Copy & paste <br>contacts</h3>
                                <p class="htxt_regular_12 dark_300 mb10">Just copy and past your contact list from file to BrandBoost</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="card p30 min_h_240">
                                <img src="assets/images/people_plus.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">Add individual <br>contacts</h3>
                                <p class="htxt_regular_12 dark_300 mb10">Fill in all the details of contacts and add them one by one</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="card p30 min_h_240">
                                <img src="assets/images/people_another.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">Import from <br>another service</h3>
                                <p class="htxt_regular_12 dark_300 mb10">Import contact from Google, Mailchimp or another service</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="upload-file-step-2" style="display: none;">
                    <upload-file></upload-file>
                </div>


            </div>
        </div>
        <!--******************
          Content Area End
         **********************-->
    </div>

</template>

<script>
    import PeopleContactsUploadFile from '../contact/PeopleContactsUploadFile';

    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        title: 'People Contacts Import - Brand Boost',
        components: {'upload-file': PeopleContactsUploadFile},
        data() {
            return {}
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods: {
            uploadFile: function() {
                $('#upload-file-step-1').hide();
                $('#upload-file-step-2').show();
            }
        }
    }


    /* Customized Functions */
    $(document).ready(function () {

    });
</script>
