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
                                <div class="img_vid_upload">
                                    <input class="d-none" type="file" name="" value="" id="companylogo">
                                </div>
                            </label>
                        </div>

                        <div id="app">
                            <!-- File Drop Zone -->
                            <div style="visibility:hidden; opacity:0" id="dropzone">
                                <div id="textnode">Drop files to add data.</div>
                            </div>

                            <div class="col-md-4" id="file-panel">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        Uploaded Files {{ uploadedFiles.length }} 111
                                        <ul id="upload-list">
                                            <li v-for="file in uploadedFiles">{{file.fileName}}</li>
                                        </ul>
                                    </div>
                                </div>

                                <!--<div class="panel panel-success">
                                    <div class="panel-heading">
                                        Data Preview
                                    </div>
                                    <div class="panel-body">
                                        <div id="results"></div>
                                    </div>
                                </div>-->

                            </div>

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
    let tkn = $('meta[name="_token"]').attr('content');
    let el = $("#app");

    export default {
        name: 'upload-file',
        title: 'People Contacts Upload File - Brand Boost',
        data() {
            return {
                uploadedFiles: []
            }
        },
        mounted() {
            var self = this;
            window.addEventListener("dragenter", function (e) {
                document.querySelector("#dropzone").style.visibility = "";
                document.querySelector("#dropzone").style.opacity = 1;
                document.querySelector("#textnode").style.fontSize = "48px";
            });

            window.addEventListener("dragleave", function (e) {
                e.preventDefault();

                document.querySelector("#dropzone").style.visibility = "hidden";
                document.querySelector("#dropzone").style.opacity = 0;
                document.querySelector("#textnode").style.fontSize = "42px";

            });

            window.addEventListener("dragover", function (e) {
                e.preventDefault();
                document.querySelector("#dropzone").style.visibility = "";
                document.querySelector("#dropzone").style.opacity = 1;
                document.querySelector("#textnode").style.fontSize = "48px";
            });

            window.addEventListener("drop", function (e) {
                e.preventDefault();
                document.querySelector("#dropzone").style.visibility = "hidden";
                document.querySelector("#dropzone").style.opacity = 0;
                document.querySelector("#textnode").style.fontSize = "42px";

                var files = e.dataTransfer.files;
                this.uploadedFiles = files[0];
                console.log("Drop files:", this.uploadedFiles);
                //this.uploadFile(files);
                self.uploadFiles(files);
            });

            console.log('Component mounted.');
        },
        methods: {
            goToPrevious: function() {
                this.$router.go()
            },
            listMappingPage: function() {
                window.location.href = '#/contacts/listmapping';
            },
            uploadFiles: function(f) {
                var self = this;

                function loadFiles(file) {
                    // Pull the file name and remove the ".txt" extension
                    var name =
                        file.name.substr(0, file.name.lastIndexOf(".txt")) || file.name;

                }

                for (var i = 0; i < f.length; i++) {
                    if (f[i].type !== "text/plain") {
                        //if text file is not submitted alert and skip over it
                        alert("Sorry, " + f[i].type + " is not an accepted file type.");
                        continue;
                    } else {
                        if (this.uploadedFiles.length > 0) {
                            if (
                                !this.checkDuplicateFile(
                                    f[i].name.substr(0, f[i].name.lastIndexOf(".txt"))
                                )
                            ) {
                                loadFiles(f[i]);
                            }
                        } else {
                            loadFiles(f[i]);
                        }
                    }
                }
            },
            checkDuplicateFile: function(filename) {
                if (this.uploadedFiles.find(el => el.fileName === filename)) {
                    alert("Duplicate file: " + filename);
                    return true;
                } else {
                    return false;
                }
            }
        }
    }


    $(document).ready(function () {

    });
</script>

<style>
    #file-panel {
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: auto;
    }

    .panel-body {
        height: auto;
    }


    #upload-list {
        height: auto;
        padding: 0px;
    }

    ul {
        list-style-type: none;
    }

    div#dropzone {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999999999;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        transition: visibility 175ms, opacity 175ms;
        display: table;
        text-shadow: 1px 1px 2px #000;
        color: #fff;
        background: rgba(0, 0, 0, 0.45);
        font: bold 42px Oswald, DejaVu Sans, Tahoma, sans-serif;
    }
    div#textnode {
        display: table-cell;
        text-align: center;
        vertical-align: middle;
        transition: font-size 175ms;
    }
</style>
