<template>
    <div>
        <div class="hiddenModelControls" style="display:none;">
            <button type="button" id="btnOpenImportOptions">Open Import Options</button>
            <button type="button" id="btnCloseImportOptions">Close Import Options</button>

            <button type="button" id="btnOpenExcludeOptions">Open Exclude Options</button>
            <button type="button" id="btnCloseExcludeOptions">Close Exclude Options</button>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="dark_600 fsize11 fw500 ls4"><img src="assets/images/addcirclegreen.svg"/> &nbsp; RECIPIENTS</label>
                    <div class="card border shadow-none p10 pb5 d-block mb15">
                        <span v-html="importButtons"></span>
                        <a class="addnewtags" href="javascript:void(0);" @click="openImportOptions"><img src="assets/images/blue_plus.svg"/></a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mb-0">
                    <label class="dark_600 fsize11 fw500 ls4"><img src="assets/images/minus_red.svg"/> &nbsp; EXCLUDE</label>

                    <div class="card border shadow-none p10 pb5 d-block m-0">
                        <span v-html="excludeButtons"></span>
                        <a class="addnewtags" href="javascript:void(0);" @click="openExcludeOptions"><img src="assets/images/blue_plus.svg"/></a>
                    </div>


                </div>
            </div>
        </div>

        <!--Include Popup-->
        <div class="modal fade" id="includeAudience">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:680px!important">
                <div class="modal-content review">
                    <a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
                    <div class="row" v-show="displayImportOptions">
                        <div class="col-12">
                            <h3 class="htxt_medium_24 dark_800 mb-2">Add Contacts</h3>
                            <p class="htxt_regular_14 dark_200 m-0">Choose how do you want to add contacts</p>
                            <hr/>
                        </div>



                        <div class="col-4">
                            <div class="card border text-center shadow-none p20" style="cursor:pointer;" @click="ShowListings('contacts')">
                                <img class="mb-3" src="assets/images/contacts_blue_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Contacts</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Choose from <br>all available contacts. </p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card border text-center shadow-none p20" style="cursor:pointer;" @click="ShowListings('lists')">
                                <img class="mb-3" src="assets/images/lists_blue_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Lists</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Select one or more<br> pre-made lists.</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card border text-center shadow-none p20" style="cursor:pointer;" @click="ShowListings('tags')">
                                <img class="mb-3" src="assets/images/tags_blue_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Tags</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Select contacts <br>that match specific tag.</p>
                            </div>
                        </div>



                        <div class="col-4">
                            <div class="card border text-center shadow-none m-0 p20" style="cursor:pointer;" @click="ShowListings('segments')">
                                <img class="mb-3" src="assets/images/segment_blue_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Segments</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Select one or more<br> pre-made segments. </p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card border text-center shadow-none m-0 p20">
                                <img class="mb-3" src="assets/images/copy_blue_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Copy campaign</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Copy all contacts from<br> another campaign.</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card border text-center shadow-none m-0 p20">
                                <img class="mb-3" src="assets/images/import_grey_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Import</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Import contacts from<br> another app or file</p>
                            </div>
                        </div>




                    </div>

                    <workflow-audience-contacts
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        v-show="displayContacts"
                        @includeContact="addContact"
                        @backToMain="backToMainMenu"
                    ></workflow-audience-contacts>


                    <workflow-audience-lists
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        v-show="displayLists"
                        @includeContact="addList"
                        @backToMain="backToMainMenu"
                    ></workflow-audience-lists>


                    <workflow-audience-segments
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        v-show="displaySegments"
                        @includeContact="addSegment"
                        @backToMain="backToMainMenu"
                    ></workflow-audience-segments>


                    <workflow-audience-tags
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        v-show="displayTags"
                        @includeContact="addTag"
                        @backToMain="backToMainMenu"
                    ></workflow-audience-tags>
                </div>
            </div>
        </div>

        <!--Exclude Popup-->
        <div class="modal fade" id="excludeAudience">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:680px!important">
                <div class="modal-content review">
                    <a class="cross_icon" data-dismiss="modal"><i class=""><img src="assets/images/cross.svg"></i></a>
                    <div class="row" v-show="displayExcludeOptions">
                        <div class="col-12">
                            <h3 class="htxt_medium_24 dark_800 mb-2">Exclude Contacts</h3>
                            <p class="htxt_regular_14 dark_200 m-0">Choose how do you want to exclude contacts</p>
                            <hr/>
                        </div>



                        <div class="col-4">
                            <div class="card border text-center shadow-none p20" style="cursor:pointer;" @click="ShowPanelExclude('contacts')">
                                <img class="mb-3" src="assets/images/contacts_blue_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Contacts</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Choose from <br>all available contacts. </p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card border text-center shadow-none p20" style="cursor:pointer;" @click="ShowPanelExclude('lists')">
                                <img class="mb-3" src="assets/images/lists_blue_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Lists</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Select one or more<br> pre-made lists.</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card border text-center shadow-none p20" style="cursor:pointer;" @click="ShowPanelExclude('tags')">
                                <img class="mb-3" src="assets/images/tags_blue_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Tags</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Select contacts <br>that match specific tag.</p>
                            </div>
                        </div>



                        <div class="col-4">
                            <div class="card border text-center shadow-none m-0 p20" style="cursor:pointer;" @click="ShowPanelExclude('segments')">
                                <img class="mb-3" src="assets/images/segment_blue_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Segments</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Select one or more<br> pre-made segments. </p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card border text-center shadow-none m-0 p20">
                                <img class="mb-3" src="assets/images/copy_blue_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Copy campaign</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Copy all contacts from<br> another campaign.</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card border text-center shadow-none m-0 p20">
                                <img class="mb-3" src="assets/images/import_grey_44.svg"/>
                                <p class="htxt_medium_14 dark_600 mb-3">Import</p>
                                <p class="htxt_regular_12 dark_300 m-0 lh_17">Import contacts from<br> another app or file</p>
                            </div>
                        </div>




                    </div>

                    <workflow-audience-contacts-exclude
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        v-show="displayContactsExclude"
                        @excludeContact="excludeContact"
                        @backToMain="backToMainMenuExclude"
                    ></workflow-audience-contacts-exclude>


                    <workflow-audience-lists-exclude
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        v-show="displayListsExclude"
                        @excludeContact="excludeList"
                        @backToMain="backToMainMenuExclude"
                    ></workflow-audience-lists-exclude>


                    <workflow-audience-segments-exclude
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        v-show="displaySegmentsExclude"
                        @excludeContact="excludeSegment"
                        @backToMain="backToMainMenuExclude"
                    ></workflow-audience-segments-exclude>


                    <workflow-audience-tags-exclude
                        :moduleName="moduleName"
                        :moduleUnitId="moduleUnitId"
                        v-show="displayTagsExclude"
                        @excludeContact="excludeTag"
                        @backToMain="backToMainMenuExclude"
                    ></workflow-audience-tags-exclude>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import ImportContacts from '@/components/admin/workflow/workflowAudience/Partials/Import/Im-Contacts';
    import ImportLists from '@/components/admin/workflow/workflowAudience/Partials/Import/Im-Lists';
    import ImportSegments from '@/components/admin/workflow/workflowAudience/Partials/Import/Im-Segments';
    import ImportTags from '@/components/admin/workflow/workflowAudience/Partials/Import/Im-Tags';

    import ContactsExclude from '@/components/admin/workflow/workflowAudience/Partials/Exclude/Ex-Contacts';
    import ImportListsExclude from '@/components/admin/workflow/workflowAudience/Partials/Exclude/Ex-Lists';
    import ImportSegmentsExclude from '@/components/admin/workflow/workflowAudience/Partials/Exclude/Ex-Segments';
    import ImportTagsExclude from '@/components/admin/workflow/workflowAudience/Partials/Exclude/Ex-Tags';
    export default {
        props: ['moduleName', 'moduleUnitId'],
        components: {
            'workflow-audience-contacts': ImportContacts,
            'workflow-audience-lists': ImportLists,
            'workflow-audience-segments': ImportSegments,
            'workflow-audience-tags': ImportTags,
            'workflow-audience-contacts-exclude': ContactsExclude,
            'workflow-audience-lists-exclude': ImportListsExclude,
            'workflow-audience-segments-exclude': ImportSegmentsExclude,
            'workflow-audience-tags-exclude': ImportTagsExclude
        },
        data() {
            return {
                current_page: 1,
                contactSelectionData: '',
                subscribersData: '',
                importButtons: '',
                excludeButtons: '',
                subscribers: '',
                allData: '',
                activeCount: 0,
                archiveCount: 0,
                loading: true,
                refreshKey: '1',

                displayContacts: false,
                displayLists: false,
                displaySegments: false,
                displayTags: false,
                displayImportOptions: false,
                displayExcludeOptions: false,

                displayContactsExclude: false,
                displayListsExclude: false,
                displaySegmentsExclude: false,
                displayTagsExclude: false,
            }
        },
        methods: {
            openImportOptions: function(){
                this.closeAllPopups();
                this.displayImportOptions = true;
                document.querySelector('#btnOpenImportOptions').click();
            },
            openExcludeOptions: function(){
                this.closeAllPopups();
                this.displayExcludeOptions = true;
                document.querySelector('#btnOpenExcludeOptions').click();
            },
            closeAllPopups: function(){
                this.displayImportOptions = false;
                this.displayExcludeOptions = false;
                this.closeImportOptions();
                this.closeExcludeOptions();
            },
            closeImportOptions: function(){
                document.querySelector('#btnCloseImportOptions').click();
            },
            closeExcludeOptions: function(){
                document.querySelector('#btnCloseExcludeOptions').click();
            },
            resetAllOptions: function () {
                this.displayContacts = false;
                this.displayLists = false;
                this.displaySegments = false;
                this.displayTags = false;
            },
            ShowListings: function (OptionName) {
                this.resetAllOptions();
                this.displayImportOptions = false;
                if (OptionName == 'contacts') {
                    this.displayContacts = true;
                } else if (OptionName == 'lists') {
                    this.displayLists = true;
                } else if (OptionName == 'segments') {
                    this.displaySegments = true;
                } else if (OptionName == 'tags') {
                    this.displayTags = true;
                }

            },
            backToMainMenu: function () {
                this.resetAllOptions();
                this.displayImportOptions = true;
            },
            addContact: function (id, actionName) {
                axios.post('/admin/workflow/addContactToWorkflowCampaign', {
                    contactId: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        document.querySelector('#includeContacts').innerHTML= response.data.total_contacts;
                        this.syncWorkflowAudience();
                        this.refreshSelectionData();
                        //this.$emit('syncWorkflowAudience');
                        //this.$emit('loadFreshSelectionData');
                    });
            },
            addList: function (id, actionName) {
                axios.post('/admin/workflow/addListToWorkflowCampaign', {
                    selectedLists: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        document.querySelector('#includeContactList').innerHTML= response.data.total_lists;
                        this.syncWorkflowAudience();
                        this.refreshSelectionData();
                        //this.$emit('syncWorkflowAudience');
                        //this.$emit('loadFreshSelectionData');
                    });
            },
            addSegment: function (id, actionName) {
                axios.post('/admin/workflow/addSegmentToWorkflowCampaign', {
                    segmentId: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        document.querySelector('#includeContactSegment').innerHTML= response.data.total_segments;
                        this.syncWorkflowAudience();
                        this.refreshSelectionData();
                        //this.$emit('syncWorkflowAudience');
                        //this.$emit('loadFreshSelectionData');
                    });
            },
            addTag: function (id, actionName) {
                axios.post('/admin/workflow/addTagToWorkflowCampaign', {
                    tagId: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        document.querySelector('#includeContactTag').innerHTML= response.data.total_tags;
                        this.syncWorkflowAudience();
                        this.refreshSelectionData();
                        //this.$emit('syncWorkflowAudience');
                        //this.$emit('loadFreshSelectionData');

                    });
            },

            ShowPanelExclude: function (OptionName) {
                this.resetAllOptionsExclude();
                this.displayExcludeOptions = false;
                if (OptionName == 'contacts') {
                    this.displayContactsExclude = true;
                } else if (OptionName == 'lists') {
                    this.displayListsExclude = true;
                } else if (OptionName == 'segments') {
                    this.displaySegmentsExclude = true;
                } else if (OptionName == 'tags') {
                    this.displayTagsExclude = true;
                }

            },
            resetAllOptionsExclude: function () {
                this.displayContactsExclude = false;
                this.displayListsExclude = false;
                this.displaySegmentsExclude = false;
                this.displayTagsExclude = false;
            },
            backToMainMenuExclude: function () {
                this.resetAllOptionsExclude();
                this.displayExcludeOptions = true;
            },
            excludeContact: function (id, actionName) {
                axios.post('/admin/workflow/addContactToExcludeWorkflowCampaign', {
                    contactId: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        document.querySelector('#excludedContacts').innerHTML= response.data.total_contacts;
                        this.syncWorkflowAudience();
                        this.refreshSelectionData();
                        /*this.$emit('syncWorkflowAudience');
                        this.$emit('loadFreshSelectionData');*/
                    });
            },
            excludeList: function (id, actionName) {
                axios.post('/admin/workflow/updateAutomationListsExcludedRecord', {
                    selectedLists: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        document.querySelector('#excludedContactList').innerHTML= response.data.total_lists;
                        this.syncWorkflowAudience();
                        this.refreshSelectionData();
                        /*this.$emit('syncWorkflowAudience');
                        this.$emit('loadFreshSelectionData');*/
                    });
            },
            excludeSegment: function (id, actionName) {
                axios.post('/admin/workflow/addExcludeSegmentToWorkflowCampaign', {
                    segmentId: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        document.querySelector('#excludedContactSegment').innerHTML= response.data.total_segments;
                        this.syncWorkflowAudience();
                        this.refreshSelectionData();
                        /*this.$emit('syncWorkflowAudience');
                        this.$emit('loadFreshSelectionData');*/
                    });
            },
            excludeTag: function (id, actionName) {
                axios.post('/admin/workflow/addExcludedTagToWorkflowCampaign', {
                    tagId: id,
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        document.querySelector('#excludedContactTag').innerHTML= response.data.total_tags;
                        this.syncWorkflowAudience();
                        this.refreshSelectionData();
                        /*this.$emit('syncWorkflowAudience');
                        this.$emit('loadFreshSelectionData');*/
                    });
            },

            loadPaginatedData: function(){
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getWorkflowContactSelectionInterfaceData?page='+this.current_page, {moduleName: this.moduleName, moduleUnitID:this.moduleUnitId})
                    .then(response => {
                        this.contactSelectionData = response.data.contactSelectionData;
                        this.importButtons = this.contactSelectionData.sImportButtons;
                        this.excludeButtons = this.contactSelectionData.sExcludButtons;
                        this.subscribers = this.contactSelectionData.oCampaignSubscribers;
                        this.allData = this.contactSelectionData.oCampaignSubscribersAll;
                        this.loading = false;
                        this.refreshalllists();
                    });
            },
            refreshSelectionData: function(){
                this.loadPaginatedData();

            },
            getWorkflowSubscribers: function(){
                axios.post('/f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/workflowSubscribers', {moduleName: this.moduleName, moduleUnitID:this.moduleUnitId})
                    .then(response => {
                        this.subscribersData = response.data.subscribersData;
                    });

            },
            syncWorkflowAudience : function(){
                axios.post('/admin/workflow/syncWorkflowAudience', {
                    moduleName: this.moduleName,
                    moduleUnitID: this.moduleUnitId,
                    _token: this.csrf_token()
                }).then(response => {

                });
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            backToWorkflowGrid: function(){
                this.$emit("displayTreeInterface")
            },
            refreshalllists: function(){
                let randomNo = new Date().getTime() + Math.random();
                this.refreshKey = randomNo;
            }
        },

        mounted() {
            //this.getWorkflowSubscribers();
            this.loadPaginatedData();
        }

    }

    $(document).ready(function(){

        //Import Options
        $(document).on('click', '#btnOpenImportOptions', function () {
            $("#includeAudience").modal("show");
        });
        $(document).on('click', '#btnCloseImportOptions', function () {
            $("#includeAudience").modal("hide");
        });

        //Exclude Options
        $(document).on('click', '#btnOpenExcludeOptions', function () {
            $("#excludeAudience").modal("show");
        });
        $(document).on('click', '#btnCloseExcludeOptions', function () {
            $("#excludeAudience").modal("hide");
        });
    });
</script>




