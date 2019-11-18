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
                        <button class="btn btn-md bkg_blue_200 light_000 js-contact-slidebox">New Contact <span><img src="assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div v-if="!oSubscribers" class="content-area">
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
                        <p><a href="/assets/demo_data/subscribers.csv" target="_blank"> Click here to view sample csv file</a></p>
                    </div>
                </div>
                <!--<form method="post" action="/admin/subscriber/importSubscriberCSV" enctype="multipart/form-data" @submit.prevent="processForm">-->
                <div class="row mt30">
                    <div class="col-md-9 text-center">
                        <div class="card p20 min_h_240">
                            <label class="display-block m0" for="companylogo" style="padding-top:80px;">

                                <!--<div class="img_vid_upload">
                                    <input class="d-none" type="file" name="" value="" id="companylogo">
                                </div>-->
                                Files
                                <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" required/>

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
                    <!--<div class="col-6" @click="listMappingPage()" style="cursor: pointer;"><button class="btn btn-sm bkg_blue_200 light_000 float-right">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button></div>-->
                    <div class="col-6" style="cursor: pointer;"><button class="btn btn-sm bkg_blue_200 light_000 float-right" @click="submitFileToMap()">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button></div>
                </div>
                <!--</form>-->
            </div>
        </div>


        <div v-else-if="finalMappedSubscribers" class="content-area">
            <div class="container-fluid">

                <div class="table_head_action bbot pb30">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="import_list">
                                <li><a class="done" href="#">Select import type</a></li>
                                <li><a class="done" href="#">Upload contacts</a></li>
                                <li><a class="active" href="#">Match fields</a></li>
                                <li><a href="#">Confirm Import</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="htxt_bold_20 dark_700 mt30 mb10">Match the file columns with your list fields</h3>
                        <p class="fsize14 dark_200 fw300 mb50">For each column of your data, select field that it corresponds to or create new field.</p>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>

                                 <tr v-for="(finalMappedSubscriber, name, index) in finalMappedSubscribers.slice(0, 1)">
                                    <td>
                                         <span>
                                         <label class="custmo_checkbox pull-left">
                                             <input type="checkbox"
                                                    :checked="true"
                                                    v-model='isCheckAll_2'
                                                    @click='checkAll_2()' />
                                             <span class="custmo_checkmark blue"></span>
                                         </label>
                                     </span>
                                     </td>
                                    <td v-for="(mappedSubscriber, name1, index1) in finalMappedSubscriber"><span class="fsize12 fw300">{{ name1 }}</span></td>
                                </tr>

                                <tr v-for="(finalMappedSubscriber, name, index) in finalMappedSubscribers">
                                    <td>
                                        <span>
                                        <label class="custmo_checkbox pull-left">
                                            <input type="checkbox"
                                                   :checked="true"
                                                   :value="finalMappedSubscriber"
                                                   v-model="checkFields_2"
                                                   @change='updateCheckall_2()' />
                                            <span class="custmo_checkmark blue"></span>
                                        </label>
                                        </span>
                                    </td>
                                    <td v-for="(mappedSubscriber, name1, index1) in finalMappedSubscriber"><span class="htxt_medium_14 dark_900">{{ finalMappedSubscriber[name1].split('====')[0] }}</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt40">
                    <div class="col-md-12"><hr class="mb25"></div>
                    <div class="col-6"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="goToPrevious()" style="cursor: pointer;"> <span class="ml0 mr10"><img src="assets/images/arrow-left-line.svg"></span>Back</button></div>
                    <div class="col-6"><button class="btn btn-sm bkg_blue_200 light_000 float-right" @click="importSubscribers(dataSubscribers)" style="cursor: pointer;">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button></div>
                </div>
            </div>
        </div>




        <div v-else class="content-area">
            <div class="container-fluid">

                <div class="table_head_action bbot pb30">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="import_list">
                                <li><a class="done" href="#">Select import type</a></li>
                                <li><a class="done" href="#">Upload contacts</a></li>
                                <li><a class="active" href="#">Match fields</a></li>
                                <li><a href="#">Confirm Import</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="htxt_bold_20 dark_700 mt30 mb10">Match the file columns with your list fields</h3>
                        <p class="fsize14 dark_200 fw300 mb50">For each column of your data, select field that it corresponds to or create new field.</p>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">

                            <table class="table table-borderless">
                                <tbody>

                                <tr>
                                    <td><span>
                                        <label class="custmo_checkbox pull-left">
                                            <input type="checkbox"
                                                   v-model='isCheckAll'
                                                   @click='checkAll()' />
                                            <span class="custmo_checkmark blue"></span>
                                        </label>
                                    </span></td>
                                    <td><span class="fsize12 fw300">Column label from file</span></td>
                                    <td><span class="fsize12 fw300">Preview data</span></td>
                                    <td><span class="fsize12 fw300">List fields</span></td>
                                    <td><span class="fsize12 fw300">&nbsp;</span></td>
                                </tr>

                                <tr v-for="oSubscriberToMap in oSubscribersToMap">
                                    <td>
                                        <span>
                                        <label class="custmo_checkbox pull-left">
                                            <input type="checkbox"
                                                   :value="oSubscriberToMap"
                                                   v-model="checkFields"
                                                   @change='updateCheckall()' />
                                            <span class="custmo_checkmark blue"></span>
                                        </label>
                                    </span>
                                    </td>
                                    <td><span class="htxt_medium_14 dark_900">{{ oSubscriberToMap.ind }}</span></td>
                                    <td><span class="htxt_medium_14 dark_900">{{ oSubscriberToMap.val }}</span></td>
                                    <td>
                                        <span v-if="oSubscriberToMap.dbField != ''" class="htxt_medium_14 dark_400 fw300"><i><img src="assets/images/user-line.svg"/> </i> &nbsp; {{ oSubscriberToMap.dbField }}</span>
                                        <span v-else class="htxt_medium_14 dark_400 fw300"><i><img src="assets/images/question-line.svg"/> </i> &nbsp; Select field</span>
                                    </td>
                                    <td class="text-right"><span class=""><img src="assets/images/chevronbottom.svg" /> </span></td>
                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="row mt40">
                    <div class="col-md-12"><hr class="mb25"></div>
                    <div class="col-6"><button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="goToPrevious()" style="cursor: pointer;"> <span class="ml0 mr10"><img src="assets/images/arrow-left-line.svg"></span>Back</button></div>
                    <div class="col-6"><button class="btn btn-sm bkg_blue_200 light_000 float-right" @click="FiledMapSubscriber(dataSubscribers)" style="cursor: pointer;">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button></div>
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
                module_name: 'list',
                module_account_id: '0',
                redirect_url: '#/contacts/mycontacts',
                file: '',
                oSubscribers: '',
                dataSubscribers: '',
                oSubscribersToMap: {},
                finalMappedSubscribers: '',
                isCheckAll: false,
                checkFields: [],
                selectedFields: '',
                isCheckAll_2: false,
                checkFields_2: [],
                selectedFields_2: ''
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods: {
            goToPrevious: function() {
                this.$router.go()
            },
            listMappingPage: function() {
                window.location.href = '#/contacts/listmapping';
            },
            submitFileToMap(){
                let formData = new FormData();

                /* Add the form data we need to submit */
                formData.append('file', this.file);

                axios.post( '/admin/subscriber/readSubscriberCSVToMap',
                    formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    )
                    .then(response => {
                        //console.log(response.data);
                        if (response.data.status == 'success') {
                            this.oSubscribers = response.data.aSubscribers;
                            this.oSubscribersToMap = response.data.aSubscribersToMap;
                            this.dataSubscribers = JSON.stringify(this.oSubscribers);
                            //console.log("-------------"+this.dataSubscribers);
                        }
                        else if (response.data.status == 'errorFileType') {
                            alert('Error: '+response.data.msg);
                        }
                        else if (response.data.status == 'error') {
                            alert('Error: Something went wrong, seems not a valid file.');
                        }
                    })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
            },
            submitFile(){
                let formData = new FormData();

                /* Add the form data we need to submit */
                formData.append('file', this.file);

                axios.post( '/admin/subscriber/readSubscriberCSV',
                    formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    )
                    .then(response => {
                        //console.log(response.data);
                        if (response.data.status == 'success') {
                            this.oSubscribers = response.data.aSubscribers;
                            this.dataSubscribers = JSON.stringify(this.oSubscribers);
                        }
                        else if (response.data.status == 'error') {
                            alert('Error: Something went wrong.');
                        }
                    })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },
            FiledMapSubscriber : function(dataSubscribers){

                this.selectedFields = "";
                // Read Checked checkboxes value
                for (var key in this.checkFields) {
                    this.selectedFields += JSON.stringify(this.checkFields[key])+",";
                    //console.log(this.selectedFields)
                }
                //console.log(this.selectedFields)

                axios.post('/admin/subscriber/mapSubscriberCSV' , {
                    selectedFields: '['+(this.selectedFields).replace(/,\s*$/, "")+']',
                    dataSubscribers: dataSubscribers,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        //console.log(response.data);
                        if (response.data.status == 'success') {
                            this.oSubscribers = response.data.aSubscribers;
                            this.finalMappedSubscribers = response.data.aFinalMappedSubsArr;
                            //this.dataSubscribers = JSON.stringify(this.finalMappedSubscribers);
                            //console.log(this.finalMappedSubscribers);
                        }
                        else if (response.data.status == 'error') {
                            alert('Error: Something went wrong.');
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            checkAll: function(){
                this.isCheckAll = !this.isCheckAll;
                this.checkFields = [];
                if(this.isCheckAll){ // Check all
                    for (var key in this.oSubscribersToMap) {
                        this.checkFields.push(this.oSubscribersToMap[key]);
                    }
                }
            },
            updateCheckall: function(){
                if(this.checkFields.length == this.oSubscribersToMap.length){
                    this.isCheckAll = true;
                }else{
                    this.isCheckAll = false;
                }
            },
            checkAll_2: function(){
                this.isCheckAll_2 = !this.isCheckAll_2;
                this.checkFields_2 = [];
                if(this.isCheckAll_2){ // Check all
                    for (var key in this.finalMappedSubscribers) {
                        this.checkFields_2.push(this.finalMappedSubscribers[key]);
                    }
                }
            },
            updateCheckall_2: function(){
                if(this.checkFields_2.length == this.finalMappedSubscribers.length){
                    this.isCheckAll_2 = true;
                }else{
                    this.isCheckAll_2 = false;
                }
            },
            importSubscribers(dataSubscribers) {
                axios.post( '/admin/subscriber/importSubscriberList', {
                    module_name: this.module_name,
                    module_account_id: this.module_account_id,
                    redirect_url: this.redirect_url,
                    dataSubscribers:JSON.stringify(this.checkFields_2),
                    _token: this.csrf_token()
                })
                    .then(response => {
                        //console.log(response.data);
                        if (response.data.status == 'success') {
                            window.location.href = response.data.redirectURL;
                        }
                        else if (response.data.status == 'errorMsg') {
                            alert(response.data.msg);
                        }
                        else {
                            alert('Error: Something went wrong.');
                        }
                    })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
            }
        }
    }


    $(document).ready(function () {

    });
</script>

<style>

</style>
