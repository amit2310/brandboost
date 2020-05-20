<template>
    <div class="p40">

        <div class="p10">
            <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="backtoOption"><span class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back</button>
            <h3 style="float: right;">Exclude from Segments <span id="excludedContactSegment">{{selected_segments.length}}</span></h3>
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
                                <th><i class=""></i> Segment Name</th>
                                <th><i class=""></i> Contacts</th>
                                <th class="text-right"><i class=""><img
                                    src="/assets/images/icon_created.png"></i> Created
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="segment in segments">
                                <td style="display: none;">{{ displayDateFormat('m/d/Y', segment.created) }}</td>
                                <td style="display: none;">{{ segment.id }}</td>
                                <td>
                                    <label class="custmo_checkbox ">
                                        <input type="checkbox" name="checkRows[]" class="addToCampaign" @click="excludeToSegments($event,segment.id)"
                                               :value="segment.id" :checked="selected_segments.includes(segment.id)" />
                                        <span class="custmo_checkmark sblue"></span>
                                    </label>
                                </td>
                                <td>
                                    {{ segment.segment_name }}
                                </td>
                                <td class="text-left">{{ segment.subscribersData.length }}</td>
                                <td class="text-right">
                                    <div class="media-left text-right pull-right">
                                        <div class=""><a href="#" class="txt_grey">{{ displayDateFormat('m d, Y', segment.created) }}
                                            <span
                                                class="txt_grey">{{ displayDateFormat('h:i A', segment.created) }}</span></a>
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
        props: ['moduleName', 'moduleUnitId'],
        components: {UserAvatar, Pagination},
        data() {
            return {



                segments: '',
                selected_segments: '',
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
                    audienceType: 'segments',
                    actionType: 'exclude',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.segments = response.data.oSegments;
                        this.selected_segments = response.data.aSelectedSegments;
                        this.allData = response.data.allDataSegments;
                        this.userData = response.data.userData;
                        this.showLoading(false);
                    });
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
            excludeToSegments: function(e, id){
                let actionName = e.target.checked ? 'addRecord' : 'deleteRecord';
                this.$emit('excludeContact', id, actionName);
            }
        }

    };

</script>

