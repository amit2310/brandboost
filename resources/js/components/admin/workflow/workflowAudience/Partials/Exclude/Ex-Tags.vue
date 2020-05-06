<template>
    <div>
        <loading :isLoading="loading"></loading>
        <div class="row">
            <div class="col-12">
                <img class="float-left mr-3 mt-1" src="assets/images/tags_blue_44.svg"/>
                <h3 class="htxt_medium_24 dark_800 mb-2">Exclude Tags</h3>
                <h3 style="float: right;display:none;">Exclude from Tags <span id="excludedContactTag">{{selected_tags.length}}</span></h3>
                <p class="htxt_regular_14 dark_200 m-0">Choose tags do you want to exclude from the campaign</p>
            </div>


            <div class="col-12">
                <div class="table_head_action bbot btop pb20 pt20 mb-0 mt20">
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="table_filter">
                                <li><a :class="{'active': sortBy == ''}" @click="sortBy=''" href="javascript:void(0);">All</a></li>
                                <li><a :class="{'active': sortBy == 'Active'}" @click="sortBy='Active'" href="javascript:void(0);">Active</a></li>
                                <li><a :class="{'active': sortBy == 'Draft'}" @click="sortBy='Draft'" href="javascript:void(0);">Draft</a></li>
                                <li><a :class="{'active': sortBy == 'Archive'}" @click="sortBy='Archive'" href="javascript:void(0);">Archive</a></li>
                                <!--<li><a href="javascript:void(0);"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a></li>-->
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="table_filter text-right">
                                <li><a href="javascript:void(0);"><i><img src="assets/images/filter-line.svg"></i></a></li>
                                <li><a class="search_tables_open_close" href="javascript:void(0);"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
                                <li><a href="javascript:void(0);"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                                <li><a href="javascript:void(0);"><i><img src="assets/images/list.svg"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card p20 datasearcharea br6 shadow3" style="z-index: 999999!important;">
                        <div class="form-group m-0 position-relative">
                            <input id="InputToFocus" v-model="searchBy" type="text" placeholder="Search tags" class="form-control h48 fsize14 dark_200 fw400 br5"/>
                            <a class="search_tables_open_close searchcloseicon" href="javascript:void(0);" @click="searchBy=''"><img src="assets/images/close-icon-13.svg"/></a>
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
                            <td><span class="fsize10 fw500">TAG </span></td>
                            <td><span class="fsize10 fw500">CONTACTS</span></td>
                            <td><span class="fsize10 fw500">UPDATED <img src="assets/images/arrow-down-line-14.svg"> </span></td>
                            <td class="text-right"><span class="mr-1"><img src="assets/images/settings-2-line.svg"></span></td>
                        </tr>

                        <tr v-for="tag in tags">
                            <td width="20" class="pl-0">
						<span>
							<label class="custmo_checkbox pull-left">
								<input
                                    type="checkbox"
                                    name="checkRows[]"
                                    class="addToCampaign"
                                    @click="excludeToTags($event,tag.tagid)"
                                    :value="tag.tagid"
                                    :checked="selected_tags.includes(tag.tagid)">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                            </td>
                            <td>
                                <span class="table-img mr15">
                                    <span class="circle_icon_24" :class="tag.status =='1' ? 'bkg_blue_300' : 'bkg_light_800'">
                                        <img src="assets/images/price-tag-12-white.svg">
                                    </span>
                                </span> {{ tag.tag_name }}</td>
                            <td>{{ tag.subscribersData.total }}</td>
                            <td>{{ timeAgo(tag.tag_created) }}</td>
                            <td class="text-right">
                                <span class="float-right">
                                    <span class="status_icon_modal" :class="tag.status =='1' ? 'bkg_blue_300' : 'bkg_light_800'"></span>
                                </span>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <pagination
                        :pagination="allData"
                        @paginate="navigatePagination"
                        @paginate_per_page="navigatePaginationPerPage"
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
                <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize13 fw500">Add Tags</button>
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


                loading: true,
                tags: '',
                selected_tags: '',
                allData: '',
                userData: '',
                current_page: 1,
                items_per_page: 10,
                searchBy: '',
                sortBy: 'Active'
            }
        },
        watch: {
            'sortBy' : function(){
                this.loadPaginatedData();
            },
            'searchBy' : function(){
                this.loadPaginatedData();
            },
            'items_per_page' : function(){
                this.loadPaginatedData();
            }
        },
        mounted() {
            this.loadPaginatedData();
        },
        methods: {
            loadPaginatedData: function(){
                axios.post('/admin/workflow/loadWorkflowAudience?items_per_page='+this.items_per_page+ '&page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy, {
                    moduleName: this.moduleName,
                    moduleUnitId: this.moduleUnitId,
                    audienceType: 'tags',
                    actionType: 'exclude',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.tags = response.data.aTags;
                        this.selected_tags = response.data.aSelectedTags;
                        this.allData = response.data.allDataTags;
                        this.userData = response.data.userData;
                        this.loading = false;
                    });
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePaginationPerPage: function(p){
                this.loading=true;
                this.items_per_page = p;
                this.loadPaginatedData();
            },
            loadProfile: function(id){
                window.location.href='/admin#/contacts/profile/'+id;
                /*alert('Load Profile for '+id);*/
            },
            backtoOption: function(){
                this.$emit('backToMain');
            },
            excludeToTags: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                this.$emit('excludeContact', id, actionName);
            }
        }

    };

</script>

