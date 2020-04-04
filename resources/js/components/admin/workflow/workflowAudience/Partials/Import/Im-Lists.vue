<template>
    <div>
        <loading :isLoading="loading"></loading>
        <div class="row">
            <div class="col-12">
                <img class="float-left mr-3 mt-1" src="assets/images/lists_blue_44.svg"/>
                <h3 class="htxt_medium_24 dark_800 mb-2">Select Lists</h3>
                <h3 style="float: right;display:none;">Add from Lists <span id="includeContactList">{{selected_lists.length}}</span></h3>
                <p class="htxt_regular_14 dark_200 m-0">Choose lists do you want to the campaign</p>
            </div>


            <div class="col-12">
                <div class="table_head_action bbot btop pb20 pt20 mb-0 mt20">
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="table_filter">
                                <li><a class="active" href="javascript:void(0);">All</a></li>
                                <li><a href="javascript:void(0);">Active</a></li>
                                <li><a href="javascript:void(0);">Draft</a></li>
                                <li><a href="javascript:void(0);">Archive</a></li>
                                <!--<li><a href="javascript:void(0);"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a></li>-->
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="table_filter text-right">
                                <li><a href="javascript:void(0);"><i><img src="assets/images/filter-line.svg"></i></a></li>
                                <li><a href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
                                <li><a href="javascript:void(0);"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                                <li><a href="javascript:void(0);"><i><img src="assets/images/list.svg"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <table class="table table-borderless mb-0">
                        <tbody>
                        <tr class="headings">
                            <td width="20">
				  	<span>
						<label class="custmo_checkbox pull-left">
							<input type="checkbox">
							<span class="custmo_checkmark blue"></span>
						</label>
					</span>
                            </td>
                            <td><span class="fsize10 fw500">LIST </span></td>
                            <td><span class="fsize10 fw500">CONTACTS</span></td>
                            <td><span class="fsize10 fw500">UPDATED <img src="assets/images/arrow-down-line-14.svg"> </span></td>
                            <td class="text-right"><span class="mr-1"><img src="assets/images/settings-2-line.svg"></span></td>
                        </tr>

                        <tr v-for="(list, idx) in lists">
                            <td width="20" class="pl-0">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox" name="checkRows[]" class="addToCampaign" @click="addToList($event, list[0].id)"
                                       :value="list[0].id" :checked="selected_lists.includes(list[0].id)">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                            </td>
                            <td>
                                <span class="table-img mr15">
                                    <span class="circle_icon_24" :class="list[0].l_status =='1' ? 'bkg_blue_300' : 'bkg_light_800'">
                                        <img src="assets/images/folder_white_12.svg">
                                    </span>
                                </span> {{ list[0].list_name }} </td>
                            <td>{{list.length}}</td>
                            <td>{{ timeAgo(list[0].list_created) }}</td>
                            <td class="text-right"><span class="float-right"><span class="status_icon_modal" :class="list[0].l_status =='1' ? 'bkg_blue_300' : 'bkg_light_800'"></span></span></td>
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

        <div class="row">
            <div class="col-12">
                <hr class="mt-2">
            </div>
            <div class="col-12">
                <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize13 fw500">Add Lists</button>
                <button class="btn btn-lg bkg_light_000 dark_200 pr20 min_w_160 fsize13 fw500 ml20 shadow-none border" @click="backtoOption">Back</button>
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
                successMsg: '',
                errorMsg: '',
                loading: true,
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
            addToList: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                this.$emit('includeContact', id, actionName);
            }
        }

    };

</script>



