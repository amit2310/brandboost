<template>
    <div>
        <loading :isLoading="loading"></loading>
        <div style="display: block;">
        <div class="row">
            <div class="col-12">
                <img class="float-left mr-3 mt-1" src="assets/images/contacts_blue_44.svg"/>
                <h3 class="htxt_medium_24 dark_800 mb-2">Select Contacts</h3>
                <h3 style="float: right;display:none;">Add from Contacts <span id="includeContacts">{{selected_contacts.length}}</span></h3>
                <p class="htxt_regular_14 dark_200 m-0">Choose contacts do you want to the campaign</p>
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
							<input
                                type="checkbox"
                                >
							<span class="custmo_checkmark blue"></span>
						</label>
					</span>
                            </td>
                            <td><span class="fsize10 fw500">NAME </span></td>
                            <td><span class="fsize10 fw500">Email</span></td>
                            <td class="text-right"><span class="mr-1"><img src="assets/images/settings-2-line.svg"></span></td>
                        </tr>
                        <tr v-for="contact in contacts">
                            <td width="20" class="pl-0">
						<span>
							<label class="custmo_checkbox pull-left">
								<input
                                    type="checkbox"
                                    name="checkRows[]"
                                    class="addToCampaign"
                                    @click="addToContact($event, contact.subscriber_id)"
                                    :value="contact.subscriber_id"
                                    :checked="selected_contacts.indexOf(contact.subscriber_id)>-1"
                                >
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                            </td>
                            <td @click="loadProfile(contact.subscriber_id)" style="cursor:pointer;">
                                <span class="table-img mr15">
                                    <span class="circle_icon_24" :class="contact.status =='1' ? 'bkg_blue_300' : 'bkg_light_800'">{{ capitalizeFirstLetter(contact.firstname).charAt(0) }}</span>
                                </span> {{ capitalizeFirstLetter(contact.firstname) }} {{ capitalizeFirstLetter(contact.lastname) }}</td>
                            <td>{{ contact.email }}</td>
                            <td class="text-right"><span class="float-right"><span class="status_icon_modal" :class="contact.status =='1' ? 'bkg_blue_300' : 'bkg_light_800'"></span></span></td>
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
                <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize13 fw500">Add Contacts</button>
                <button class="btn btn-lg bkg_light_000 dark_200 pr20 min_w_160 fsize13 fw500 ml20 shadow-none border" @click="backtoOption">Back</button>
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
                successMsg: '',
                errorMsg: '',
                loading: true,
                contacts: '',
                selected_contacts: '',
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
                    audienceType: 'contacts',
                    actionType: 'import',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.contacts = response.data.subscribersData;
                        this.selected_contacts = response.data.aSelectedContacts;
                        this.allData = response.data.allDataContacts;
                        this.userData = response.data.userData;
                        this.loading = false;
                    });
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
            addToContact: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                this.$emit('includeContact', id, actionName);
            }
        }

    };

</script>



