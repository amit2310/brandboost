<template>
    <div class="p40">

        <div class="p10">
            <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="backtoOption"><span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button>
            <h3 style="float: right;">Exclude from Contacts <span>{{selected_contacts.length}}</span></h3>
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
                                <th><i class=""><img src="/assets/images/icon_name.png"></i> Name</th>
                                <th><i class=""><img src="/assets/images/icon_name.png"></i> Email</th>
                                <th class="text-right"><i class=""><img
                                    src="/assets/images/icon_device.png"></i> Phone
                                </th>
                                <th class="text-right"><i class=""><img
                                    src="/assets/images/icon_created.png"></i> Created
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="contact in contacts">
                                <td style="display: none;">{{ displayDateFormat('m/d/Y', contact.created) }}</td>
                                <td style="display: none;">{{ contact.id }}</td>
                                <td>
                                    <label class="custmo_checkbox ">
                                        <input type="checkbox" name="checkRows[]" class="addToCampaign" @click="excludeToContact($event, contact.subscriber_id)"
                                               :value="contact.subscriber_id" :checked="selected_contacts.indexOf(contact.subscriber_id)>-1" />
                                        <span class="custmo_checkmark sblue"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" @click="loadProfile(contact.subscriber_id)">
                                        <user-avatar
                                            :avatar="contact.avatar"
                                            :firstname="contact.firstname"
                                            :lastname="contact.lastname"
                                            :width="32"
                                            :height="32"
                                            :fontsize="12"
                                        ></user-avatar>
                                    </a>
                                    <span class="htxt_medium_14 dark_900" style="cursor:pointer;" @click="loadProfile(contact.subscriber_id)">{{ capitalizeFirstLetter(contact.firstname) }} {{ capitalizeFirstLetter(contact.lastname) }}</span>
                                </td>
                                <td class="text-right">{{ contact.email }}</td>
                                <td>
                                    <a href="#" class="txt_grey" v-if="contact.phone">
                                        {{mobileNoFormat(contact.phone)}}
                                    </a>
                                    <a href="#" class="txt_grey" v-else>
                                        <span style="color:#999999">Phone Unavailable</span>
                                    </a>
                                </td>
                                <td class="text-right">
                                    <div class="media-left text-right pull-right">
                                        <div class=""><a href="#" class="txt_grey">{{ displayDateFormat('m d, Y', contact.created) }}
                                            <span
                                                class="txt_grey">{{ displayDateFormat('h:i A', contact.created) }}</span></a>
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
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    export default {
        props: ['campaignId'],
        components: {UserAvatar, Pagination},
        data() {
            return {


                loading: true,
                moduleName: '',
                moduleUnitID: '',
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
                axios.post('/admin/broadcast/loadBroadcastAudience?page='+this.current_page, {
                    broadcastId: this.campaignId,
                    audienceType: 'contacts',
                    actionType: 'exclude',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.contacts = response.data.subscribersData;
                        this.selected_contacts = response.data.aSelectedContacts;
                        this.allData = response.data.allDataContacts;
                        this.moduleName = response.data.moduleName;
                        this.moduleUnitID = response.data.moduleUnitID;
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
            excludeToContact: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                this.$emit('excludeContact', id, actionName);
            }
        }

    };

</script>



