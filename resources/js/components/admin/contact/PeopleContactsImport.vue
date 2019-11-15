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
                                    <li><a class="active" href="#/contacts/import">Select import type</a></li>
                                    <li><a class="" href="javascript:void(0);">Upload contacts</a></li>
                                    <li><a href="javascript:void(0);">Match fields</a></li>
                                    <li><a href="javascript:void(0);">Confirm Import</a></li>
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
                        <div class="col-md-3 text-center" @click="copyPaste()" style="cursor: pointer;">
                            <div class="card p30 min_h_240">
                                <img src="assets/images/edit_new_write.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">Copy & paste <br>contacts</h3>
                                <p class="htxt_regular_12 dark_300 mb10">Just copy and past your contact list from file to BrandBoost</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center " style="cursor: pointer;">
                            <div class="card p30 min_h_240" @click="displayForm('Create')">
                                <img src="assets/images/people_plus.svg">
                                <h3 class="htxt_bold_16 dark_700 mt25 mb15">Add individual <br>contacts</h3>
                                <p class="htxt_regular_12 dark_300 mb10">Fill in all the details of contacts and add them one by one</p>
                                <button class="js-contact-slidebox" v-show="false">
                                    Display Form
                                </button>
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


        <!--Smart Popup-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"><a class="cross_icon js-contact-slidebox"><i
                    class=""><img src="/assets/images/cross.svg"/></i></a>
                    <form method="post" @submit.prevent="processForm">
                        <div class="p40">
                            <div class="row">
                                <div class="col-md-12"><img src="/assets/images/create_cotact_people.svg"/>
                                    <h3 class="htxt_medium_24 dark_800 mt20">{{formLabel}} Contact </h3>
                                    <hr>
                                </div>

                                <div class="col-md-12">
                                    <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
                                    <!--<loading :isLoading="loading"></loading>-->
                                    <div class="form-group">
                                        <label for="firstname">First name</label>
                                        <input type="text" class="form-control h56" v-model="form.firstname"
                                               name="firstname" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Last name</label>
                                        <input type="text" class="form-control h56" v-model="form.lastname"
                                               placeholder="Enter last name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control h56" v-model="form.email"
                                               placeholder="Enter email address">
                                    </div>
                                    <!--<div class="form-group">
                                      <label for="pwd">Phone number</label>
                                      <input type="text" class="form-control h56" id="pwd" placeholder="Enter phone number" name="pswd">
                                    </div>-->
                                    <div class="form-group">
                                        <label for="phone">Phone number</label>
                                        <div class="phonenumber">
                                            <div class="float-left">
                                                <button type="button"
                                                        class="dropdown-toggle table_action_dropdown p0 mt10"
                                                        data-toggle="dropdown">
                                                    <span><img src="assets/images/USA.png"/></span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Link 1</a>
                                                    <a class="dropdown-item" href="#">Link 2</a>
                                                    <a class="dropdown-item" href="#">Link 3</a>
                                                </div>
                                            </div>
                                            <input type="number" class="inputbox" v-model="form.phone"
                                                   placeholder="Enter phone number">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="tags">Tags</label>
                                        <div class="clearfix"></div>
                                        <input type="text" class="form-control h56" id="tags"
                                               value='Removeable Tag, Other Tag' name="tags" style="display: none">
                                    </div>

                                </div>

                            </div>
                            <div class="row mb50">
                                <div class="col-md-6"><a class="htxt_medium_14 dark_300" href="#"><span class="mr10"><img
                                    src="assets/images/plus_icon.svg"/></span>Contact Details</a></div>
                                <div class="col-md-6 text-right"><a class="htxt_medium_14 dark_300" href="#">Assign Contact
                                    <span class="ml10"><img src="assets/images/plus_icon.svg"/></span></a></div>
                            </div>
                            <div class="row bottom-position">
                                <div class="col-md-12 mb15">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                    <input type="hidden" name="module_account_id" id="module_account_id"
                                           :value="moduleAccountID">

                                    <button type="submit"
                                            class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">Save
                                    </button>
                                    <a class="blue_300 fsize16 fw600 ml20" href="#">Close</a></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import PeopleContactsUploadFile from '../contact/PeopleContactsUploadFile';

    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        title: 'People Contacts Import - Brand Boost',
        components: {'upload-file': PeopleContactsUploadFile},
        data() {
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                form: {
                    firstname: '',
                    lastname: '',
                    email: '',
                    phone: '',
                    id: ''
                },
                formLabel: 'Create'
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods: {
            uploadFile: function() {
                //$('#upload-file-step-1').hide();
                //$('#upload-file-step-2').show();
                window.location.href='#/contacts/uploadfile';
            },
            copyPaste: function() {
                window.location.href='#/contacts/copypaste';
            },
            displayForm : function(lbl){
                if(lbl == 'Create'){
                    this.form={};
                }
                this.formLabel = lbl;
                document.querySelector('.js-contact-slidebox').click();
            },
            processForm : function(){
                this.loading = true;
                let formActionSrc = '';
                this.form.module_name = this.moduleName;
                if(this.form.id>0){
                    formActionSrc = '/admin/subscriber/update_contact';
                }else{
                    formActionSrc = '/admin/subscriber/add_contact';
                    this.form.module_account_id = this.moduleAccountID;
                }
                axios.post(formActionSrc , this.form)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.loading = false;
                            //this.form = {};
                            this.form.id ='';
                            //document.querySelector('.js-contact-slidebox').click();
                            this.successMsg = 'Action completed succloading: true,essfully.';
                            var elem = this;
                            setTimeout(function () {
                                elem.loadPaginatedData();
                            }, 500);

                            syncContactSelectionSources();
                        }
                    })
                    .catch(error => {
                        this.loading = false;
                        console.log(error);
                        //error.response.data
                        //alert('All form fields are required');
                    });
            },
        }
    }


    /* Customized Functions */
    $(document).ready(function () {
        $(document).on('click', '.js-contact-slidebox', function(){
            $('[name=tags]').tagify();
            $(".box").animate({
                //width: "toggle"
            });
        });

    });
</script>
