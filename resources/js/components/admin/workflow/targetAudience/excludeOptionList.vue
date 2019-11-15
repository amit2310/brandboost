<template>
    <div class="p40">
        <div class="row" v-show="displayImportOptions">
            <div class="col-md-12">
                <div class="p30 bbot">
                    <h3 class="fsize20 fw500 txt_dark m0">Exclude Contacts</h3>
                    <p class="txt_grey m0 fw300">Choose how do you want to exclude contacts</p>
                </div>
                <div class="alert alert-danger" id="validateAddedContacts" style="display:none;">You did not exclude any
                    contact yet
                </div>
                <div class="p30">
                    <div class="contact_box" style="cursor:pointer;" @click="ShowPanel('contacts')">
                        <div class="media-left pr10"><a class="loadAudience icons s32" href="javascript:void(0);"
                                                        audience-type="contacts" action-type="import"><img
                            class="img-circle img-xs" src="/assets/images/blue_contact_32.png"></a></div>
                        <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);"
                                                                          class="loadAudience txt_dark"
                                                                          audience-type="contacts" action-type="import"><strong>Contacts</strong></a>
                        </p>
                            <p class="fsize12 fw300 txt_grey m0">Choose from all available contacts. The list of
                                contacts will be created automatically based on this broadcast.</p>
                        </div>
                    </div>
                    <div class="contact_box" style="cursor:pointer;" @click="ShowPanel('lists')">
                        <div class="media-left pr10"><a class="loadAudience icons s32" href="javascript:void(0);"
                                                        audience-type="lists" action-type="import"><img
                            class="img-circle img-xs" src="/assets/images/blue_list_32.png"></a></div>
                        <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);"
                                                                          class="loadAudience txt_dark"
                                                                          audience-type="lists"
                                                                          action-type="import"><strong>List</strong></a>
                        </p>
                            <p class="fsize12 fw300 txt_grey m0">Select one or more of the pre-prepared contact lists.
                                You can create a new list of contacts in the “People” module.</p>
                        </div>
                    </div>
                    <div class="contact_box" style="cursor:pointer;" @click="ShowPanel('segments')">
                        <div class="media-left pr10"><a class="loadAudience icons s32" href="javascript:void(0);"
                                                        audience-type="segments" action-type="import"><img
                            class="img-circle img-xs" src="/assets/images/blue_segment_32.png"></a></div>
                        <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);"
                                                                          class="loadAudience txt_dark"
                                                                          audience-type="segments" action-type="import"><strong>Segment</strong></a>
                        </p>
                            <p class="fsize12 fw300 txt_grey m0">Select one or more of the pre-prepared contact
                                segments. You can create a new segment of contacts in the "People" module.</p>
                        </div>
                    </div>
                    <div class="contact_box" style="cursor:pointer;" @click="ShowPanel('tags')">
                        <div class="media-left pr10"><a class="loadAudience icons s32" href="javascript:void(0);"
                                                        audience-type="tags" action-type="import"><img
                            class="img-circle img-xs" src="/assets/images/blue_tags_32.png"></a></div>
                        <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);"
                                                                          class="loadAudience txt_dark"
                                                                          audience-type="tags"
                                                                          action-type="import"><strong>Tags</strong></a>
                        </p>
                            <p class="fsize12 fw300 txt_grey m0">Select all contacts that match a specific tag or group
                                of tags.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div>
            <target-audience-contacts :campaignId="campaignId" v-show="displayContacts" @excludeContact="excludeContact"
                                      @backToMain="backToMainMenu"></target-audience-contacts>
            <target-audience-lists :campaignId="campaignId" v-show="displayLists" @excludeContact="excludeList"
                                   @backToMain="backToMainMenu"></target-audience-lists>
            <target-audience-segments :campaignId="campaignId" v-show="displaySegments" @excludeContact="excludeSegment"
                                      @backToMain="backToMainMenu"></target-audience-segments>
            <target-audience-tags :campaignId="campaignId" v-show="displayTags" @excludeContact="excludeTag"
                                  @backToMain="backToMainMenu"></target-audience-tags>
        </div>
    </div>
</template>
<script>
    import TargetAudienceContacts from './Partials/Exclude/Ex-Contacts';
    import TargetAudienceImportLists from './Partials/Exclude/Ex-Lists';
    import TargetAudienceImportSegments from './Partials/Exclude/Ex-Segments';
    import TargetAudienceImportTags from './Partials/Exclude/Ex-Tags';

    export default {
        components: {
            'target-audience-contacts': TargetAudienceContacts,
            'target-audience-lists': TargetAudienceImportLists,
            'target-audience-segments': TargetAudienceImportSegments,
            'target-audience-tags': TargetAudienceImportTags
        },
        props: ['campaignId'],
        data() {
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                displayContacts: false,
                displayLists: false,
                displaySegments: false,
                displayTags: false,
                displayImportOptions: true

            }
        },
        methods: {
            ShowPanel: function (OptionName) {
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
            resetAllOptions: function () {
                this.displayContacts = false;
                this.displayLists = false;
                this.displaySegments = false;
                this.displayTags = false;
            },
            backToMainMenu: function () {
                this.resetAllOptions();
                this.displayImportOptions = true;
            },
            excludeContact: function (id, actionName) {
                axios.post('/admin/broadcast/addContactToExcludeCampaign', {
                    contactId: id,
                    automation_id: this.campaignId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.$emit('loadFreshData');
                    });
            },
            excludeList: function (id, actionName) {
                axios.post('/admin/broadcast/updateAutomationListsExcludedRecord', {
                    selectedLists: id,
                    automation_id: this.campaignId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.$emit('loadFreshData');
                    });
            },
            excludeSegment: function (id, actionName) {
                axios.post('/admin/broadcast/addExcludeSegmentToCampaign', {
                    segmentId: id,
                    automation_id: this.campaignId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.$emit('loadFreshData');
                    });
            },
            excludeTag: function (id, actionName) {
                axios.post('/admin/broadcast/addExcludedTagToCampaign', {
                    tagId: id,
                    automation_id: this.campaignId,
                    actionValue: actionName,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.$emit('loadFreshData');
                    });
            },

        },
        mounted() {
            /*axios.get('/admin/broadcast/setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oBroadcast;
                    this.user = response.data.userData;
                    this.loading = false;
                });*/
        }

    };

</script>


<style scoped>
    .contact_box {
        padding-bottom: 20px;
        border-bottom: 1px solid #f4f6fa;
        margin-bottom: 20px;
    }

    .pr10 {
        padding-right: 10px !important;
    }

    .media-left, .media > .pull-left {
        padding-right: 20px;
    }

    .txt_dark {
        color: #09204f !important;
    }

    .p30 {
        padding: 30px !important;
    }

    .media-left, .media-right, .media-body {
        display: table-cell;
        vertical-align: top;
        position: relative;
    }

    a.icons.s32 {
        width: 32px;
        height: 32px;
        box-shadow: none !important;
        border: none;
        line-height: 32px;
    }

    element.style {
    }

    a.icons.s32 {
        width: 32px;
        height: 32px;
        box-shadow: none !important;
        border: none;
        line-height: 32px;
    }

    a.icons {
        display: inline-block;
        height: 26px;
        width: 26px;
        line-height: 26px;
        margin-right: 5px;
        text-align: center;
        background: #f0f1f6;
        border-radius: 100%;
        font-size: 12px;
        color: #8592a9;
    }

    .bkg_grey_light {
        background: #f4f6fa !important;
        background-color: #f4f6fa !important;
    }

    *:before, *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .reviews {
        color: #fff;
        z-index: 9;
        display: block;
        padding: 0px;
        border-radius: 100px;
        width: 28px;
        height: 28px;
        text-align: center;
        line-height: 26px;
    }

    .box h5 {
        height: 56px;
        padding: 17px 20px 18px 20px;
        border-radius: 0 5px 0 0;
        color: #313b50;
        border-bottom: 1px solid #f5f4f5 !important;
    }

    .panel-title {
        margin-top: 0;
        margin-bottom: 0;
        position: relative;
    }
</style>
