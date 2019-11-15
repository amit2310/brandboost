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
                                <li><a class="done" href="#/contacts/import">Select import type</a></li>
                                <li><a class="active" href="javascript:void(0);">Upload contacts</a></li>
                                <li><a href="javascript:void(0);">Match fields</a></li>
                                <li><a href="javascript:void(0);">Confirm Import</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="htxt_bold_20 dark_700 mt30 mb30">Import contacts using copy & paste</h3>
                        <p><a href="/assets/demo_data/subscribers.csv" target="_blank"> Click here to view sample csv file</a></p>
                    </div>
                </div>
                <form method="post" @submit.prevent="processForm">
                <div class="row mt30">
                    <div class="col-md-9 text-center">
                        <div class="card p20 min_h_240">

                            <p> Subscribers lists with details, please copy the sample data and paste in the below input area</p>
                                <label for="desc">Subscribers Details</label>
                                <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="Subscribers details"
                                          name="fileContent"
                                          v-model="form.fileContent" required></textarea>
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
                    <div class="col-6" style="cursor: pointer;"><button class="btn btn-sm bkg_blue_200 light_000 float-right">Save and continue <span><img src="assets/images/arrow-right-line.svg"></span></button></div>
                </div>
                </form>
            </div>
        </div>



        <div v-else class="content-area">
            <div class="container-fluid">

                <div class="table_head_action bbot pb30">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="import_list">
                                <li><a class="done" href="#/contacts/import">Select import type</a></li>
                                <li><a class="done" href="javascript:void(0);">Upload contacts</a></li>
                                <li><a class="active" href="javascript:void(0);">Match fields</a></li>
                                <li><a href="javascript:void(0);">Confirm Import</a></li>
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
                                    <!--<td>
                                        <span>
                                        <label class="custmo_checkbox pull-left">
                                            <input type="checkbox">
                                            <span class="custmo_checkmark blue"></span>
                                        </label>
                                    </span>
                                    </td>-->
                                    <td><span class="fsize12 fw300">FIRST_NAME</span></td>
                                    <td><span class="fsize12 fw300">LAST_NAME</span></td>
                                    <td><span class="fsize12 fw300">EMAIL</span></td>
                                    <td><span class="fsize12 fw300">&nbsp;PHONE</span></td>
                                    <td><span class="fsize12 fw300">GENDER</span></td>
                                    <td><span class="fsize12 fw300">COUNTRY</span></td>
                                    <td><span class="fsize12 fw300">STATE</span></td>
                                    <td><span class="fsize12 fw300">&nbsp;CITY</span></td>
                                    <td><span class="fsize12 fw300">ZIP</span></td>
                                </tr>

                                <tr v-for="(oSubscriber, name, index) in oSubscribers" :key="index">
                                    <!--<td>{{ index }} {{ name }}
                                        <span>
                                        <label class="custmo_checkbox pull-left">
                                            <input type="checkbox" checked>
                                            <span class="custmo_checkmark blue"></span>
                                        </label>
                                        </span>
                                    </td>-->
                                    <td><span class="htxt_medium_14 dark_900">{{ oSubscriber.FIRST_NAME }}</span></td>
                                    <td><span class="htxt_medium_14 dark_900">{{ oSubscriber.LAST_NAME }}</span></td>
                                    <td><span class="htxt_medium_14 dark_900">{{ oSubscriber.EMAIL }}</span></td>
                                    <td><span class="htxt_medium_14 dark_900">{{ oSubscriber.PHONE }}</span></td>
                                    <td><span class="htxt_medium_14 dark_900">{{ oSubscriber.GENDER }}</span></td>
                                    <td><span class="htxt_medium_14 dark_900">{{ oSubscriber.COUNTRY }}</span></td>
                                    <td><span class="htxt_medium_14 dark_900">{{ oSubscriber.STATE }}</span></td>
                                    <td><span class="htxt_medium_14 dark_900">{{ oSubscriber.CITY }}</span></td>
                                    <td><span class="htxt_medium_14 dark_900">{{ oSubscriber.ZIP }}</span></td>
                                    <!--<td><span class="htxt_medium_14 dark_900"><i><img src="assets/images/mail-open-line-16.svg"/> </i> &nbsp; Email</span></td>
                                    <td class="text-right"><span class=""><img src="assets/images/chevronbottom.svg" /> </span></td>-->
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
                form: {
                    fileContent: ''
                },
                oSubscribers: '',
                dataSubscribers: ''
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods: {
            goToPrevious: function() {
                this.$router.go()
            },
            processForm : function(){
                let formActionSrc = '';
                formActionSrc = '/admin/subscriber/readSubscriberCSV';
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        console.log(response.data)
                        if (response.data.status == 'success') {
                            this.oSubscribers = response.data.aSubscribers;
                            this.dataSubscribers = JSON.stringify(this.oSubscribers);
                        }
                        else if (response.data.status == 'error') {
                            alert('Error: Something went wrong.');
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            importSubscribers(dataSubscribers) {
                axios.post( '/admin/subscriber/importSubscriberList', {
                    dataSubscribers:dataSubscribers,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        console.log(response.data);
                        if (response.data.status == 'success') {
                            window.location.href = response.data.redirectURL;
                        }
                        else if (response.data.status == 'error') {
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
