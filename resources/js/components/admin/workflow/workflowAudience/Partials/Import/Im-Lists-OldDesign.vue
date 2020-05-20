<template>
    <div class="p40">

        <div class="p10">
            <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="backtoOption"><span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button>
            <h3 style="float: right;">Add from Lists <span id="includeContactList">{{selected_lists.length}}</span></h3>
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
                                <th><i class=""></i> List Name</th>
                                <th><i class=""></i> Contacts</th>
                                <th class="text-right"><i class=""><img
                                    src="/assets/images/icon_created.png"></i> Created
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--<tr v-for="(list, index) in lists">
                                <td>{{list[0].list_name}}</td>
                            </tr>-->

                            <tr v-for="(list, idx) in lists">
                                <td>
                                    <label class="custmo_checkbox ">
                                        <input type="checkbox" name="checkRows[]" class="addToCampaign" @click="addToList($event, list[0].id)"
                                               :value="list[0].id" :checked="selected_lists.includes(list[0].id)" />
                                        <span class="custmo_checkmark sblue"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="media-left media-middle pl10">
                                        <a class="icons s24" href="#"><img src="/assets/images/icon_list[0].png" class="img-circle img-xs" alt=""></a>
                                    </div>
                                    <div class="media-left">
                                        <div class=""><a href="javascript:void(0);" class="text-default text-semibold">{{ list[0].list_name }}</a> </div>
                                    </div>
                                </td>
                                <td class="text-right">{{list.length}}</td>
                                <td class="text-right">
                                    <div class="media-left text-right pull-right">
                                        <div class=""><a href="#" class="txt_grey">{{ displayDateFormat('m d, Y', list[0].list_created) }}
                                            <span
                                                class="txt_grey">{{ displayDateFormat('h:i A', list[0].list_created) }}</span></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!--<pagination
                            :pagination="allData"
                            @paginate="navigatePagination"
                            :offset="4">
                        </pagination>-->
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
        props: ['moduleName', 'moduleUnitId'],
        components: {UserAvatar, Pagination},
        data() {
            return {



                lists: '',
                selected_lists: '',
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
                axios.post('/admin/workflow/loadWorkflowAudience?page='+this.current_page, {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    audienceType: 'lists',
                    actionType: 'import',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.lists = response.data.newolists;
                        this.selected_lists = response.data.aSelectedListIDs;
                        this.allData = response.data.allDataContacts;
                        this.userData = response.data.userData;
                        this.showLoading(false);
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
                this.showLoading(true);
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
            addToList: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                this.$emit('includeContact', id, actionName);
            }
        }

    };

</script>



