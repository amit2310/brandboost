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

                <div class="table_head_action bbot pb30">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="import_list">
                                <li><a class="done" href="#">Select import type</a></li>
                                <li><a class="active" href="#">Upload contacts</a></li>
                                <li><a href="#">Match fields</a></li>
                                <li><a href="#">Confirm Import</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="htxt_bold_20 dark_700 mt30 mb30">Import contacts from a file</h3>
                    </div>
                </div>

                <div class="row mt30">
                    <div class="col-md-9 text-center">
                        <div class="card p20 min_h_240">
                            <label class="display-block m0" for="companylogo">
                                <form enctype="multipart/form-data">
                                <div class="img_vid_upload">
                                    <input class="d-none" type="file" name="" value="" id="companylogo">
                                </div>
                                </form>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img src="assets/images/information-line.svg"/>
                        <h3 class="fsize14 fw600 dark_700 mb10 mt10">Import Disclaimer</h3>
                        <p class="fsize12 fw300 dark_300">Each subscriber should be on a new line. You can include any extra details such as name and age, and we'll match them up with your custom fields in the next step. Before you import your list, make sure it meets our permission policies.</p>
                    </div>
                </div>

                <div class="row mt40">
                    <div class="col-md-12"><hr class="mb25"></div>
                    <div class="col-6" @click="goToPrevious()" style="cursor: pointer;"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96"> <span class="ml0 mr10"><img src="assets/images/arrow-left-line.svg"></span>Back</button></div>
                    <div class="col-6" @click="listMappingPage()" style="cursor: pointer;"><button class="btn btn-sm bkg_blue_200 light_000 float-right">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button></div>
                </div>
            </div>
        </div>
        <!--******************
          Content Area End
         **********************-->

    </div>

</template>

<script>
    export default {
        name: 'upload-file',
        title: 'People Contacts Upload File - Brand Boost',
        data() {
            return {

            }
        },
        mounted() {
            console.log('Component mounted....');
        },
        methods: {
            goToPrevious: function() {
                this.$router.go()
            },
            listMappingPage: function() {
                window.location.href = '#/contacts/listmapping';
            }
        }
    }


    $(document).ready(function () {

    });
</script>

<style>

</style>
