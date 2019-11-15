<template>
    <div class="p40">
        <loading :isLoading="loading"></loading>
        <div class="p10">
            <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="backtoOption"><span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button>
            <h3 style="float: right;">Add from Tags <span>{{selected_tags.length}}</span></h3>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="p0 bkg_white bbot">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th></th>
                                <th><i class=""></i> Tag Name</th>
                                <th><i class=""></i> Group Name</th>
                                <th><i class=""></i> Contacts</th>
                                <th class="text-right"><i class=""><img
                                    src="/assets/images/icon_created.png"></i> Created
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="tag in tags">
                                <td style="display: none;">{{ tag.tag_created ? displayDateFormat('m/d/Y', tag.tag_created): 'Not Available' }}</td>
                                <td style="display: none;">{{ tag.tagid }}</td>
                                <td>
                                    <label class="custmo_checkbox ">
                                        <input type="checkbox" name="checkRows[]" class="addToCampaign" @click="addToTags($event,tag.tagid)"
                                               :value="tag.tagid" :checked="selected_tags.includes(tag.tagid)" />
                                        <span class="custmo_checkmark sblue"></span>
                                    </label>
                                </td>
                                <td>
                                    {{ tag.tag_name }}
                                </td>
                                <td>
                                    {{ tag.group_name }}
                                </td>
                                <td class="text-left">{{ tag.subscribersData.total }}</td>
                                <td class="text-right">
                                    <div class="media-left text-right pull-right">
                                        <div class=""><a href="#" class="txt_grey">{{ tag.tag_created ? displayDateFormat('m d, Y', tag.tag_created) : 'Not Available' }}
                                            <span
                                                class="txt_grey">{{ tag.tag_created ? displayDateFormat('h:i A', tag.tag_created) : '' }}</span></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <pagination
                            :pagination="allData"
                            @paginate="navigatePagination"
                            :offset="4">
                        </pagination>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    import UserAvatar from '../../../../../helpers/UserAvatar';
    import Pagination from '../../../../../helpers/Pagination';
    export default {
        props: ['campaignId'],
        components: {UserAvatar, Pagination},
        data() {
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                tags: '',
                selected_tags: '',
                allData: '',
                userData: '',
                current_page: 1,
            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            loadPaginatedData: function(){
                axios.post('/admin/broadcast/loadBroadcastAudience?page='+this.current_page, {
                    broadcastId: this.campaignId,
                    audienceType: 'tags',
                    actionType: 'import',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.tags = response.data.aTags;
                        this.selected_tags = response.data.aSelectedTags;
                        this.allData = response.data.allDataTags;
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
                        this.userData = response.data.userData;
                        this.loading = false;
                    });
            },
            displayStep: function (step) {
                let path = '';
                if (!step) {
                    path = '/admin#/modules/emails/broadcast';
                } else {
                    path = '/admin#/modules/emails/broadcast/setup/' + this.campaignId + '/' + step;
                }

                window.location.href = path;
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            loadProfile: function(id){
                window.location.href='/admin#/contacts/profile/'+id;
                /*alert('Load Profile for '+id);*/
            },
            backtoOption: function(){
                this.$emit('backToMain');
            },
            addToTags: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                this.$emit('includeContact', id, actionName);
            }
        }

    };

</script>

