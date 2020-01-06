<template>

    <table class="table datatable-basic-new" id="offsiteBrandboostCampaign">
        <thead>
        <tr>
            <th style="display: none;"></th>
            <th style="display: none;"></th>
            <th class="nosort editAction" style="width:30px;display:none;">
                <label class="custmo_checkbox pull-left">
                    <input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll">
                    <span class="custmo_checkmark"></span>
                </label>
            </th>
            <th><i class="icon-stack-star"></i>Name</th>
            <th><i class="icon-star-full2"></i>Source</th>
            <th><i class="icon-calendar"></i>Created</th>
            <th><i class="icon-user"></i> Contacts</th>
            <th><i class=""><img
                src="/assets/images/emoji_smile.png"/></i>
                Positive
            </th>
            <th><i class=""><img src="/assets/images/emoji_smile2.png"/></i>
                Neutral
            </th>
            <th><i class=""><img src="/assets/images/emoji_smile3.png"/></i>
                Negative
            </th>
            <th><i class=""><img src="/assets/images/clock.png"/></i>Last
                feedback
            </th>
            <th class="text-center"><i class="fa fa-dot-circle-o fsize12"></i>Status
            </th>
            <th style="display: none;">status</th>
            <th style="display: none;">status</th>
            <th style="display: none;">Positive</th>
            <th style="display: none;">Neutral</th>
            <th style="display: none;">Negative</th>
            <th style="display: none;">Today</th>
            <th><i class="icon-calendar"></i>Last Incoming Lead</th>
            <th v-if="user_role != '2'" class="text-center nosort"><i class="fa fa-dot-circle-o"></i> Action
            </th>
        </tr>
        </thead>
        <tbody>
        <!--=======================-->
        <tr v-for="oBrandboost in oBrandboosts" :id="`append-${oBrandboost.id}`" class="selectedClass">
            <td style="display: none;">{{ oBrandboost.created }}</td>
            <td style="display: none;">{{ oBrandboost.id }}</td>
            <td style="display: none;" class="editAction"><label
                class="custmo_checkbox pull-left"><input type="checkbox"
                                                         name="checkRows[]"
                                                         class="checkRows"
                                                         :value="oBrandboost.id"
                                                         :id="`chk${oBrandboost.id}`"><span
                class="custmo_checkmark"></span></label></td>
            <td>
                <div class="media-left media-middle"><a
                    :href="`/admin/brandboost/offsite_setup/${oBrandboost.id}`"
                    class="icons square" :brandID="oBrandboost.id"
                    :b_title="oBrandboost.brand_title"><i
                    class="icon-indent-decrease2 txt_blue"></i></a></div>
                <div class="media-left">
                    <div class=""><a
                        :href="`admin/brandboost/offsite_setup/${oBrandboost.id}`"
                        class="text-default text-semibold"
                        :brandID="oBrandboost.id"
                        :b_title="oBrandboost.brand_title">{{ oBrandboost.metaObj.offsiteTitle }}</a>
                    </div>
                    <div
                        class="text-muted text-size-small"> {{ setStringLimit(oBrandboost.brand_desc, 28) }}</div>
                </div>
            </td>

            <td>
                <template v-if="oBrandboost.metaObj.sourceName == '' || oBrandboost.metaObj.sourceName == 'NA'">
                    <span class="text-muted text-size-small">[No Data]</span>
                </template>
                <template v-else>
                    <div class="media-left media-middle">
                        <a class="icons" href="#">
                            <i :class="`icon-${ oBrandboost.metaObj.sourceName + ' ' + oBrandboost.metaObj.sourceClass}`"></i>
                        </a>
                    </div>
                    <div class="media-left">
                        <div class="pt-5">
                            <a href="#" class="text-default text-semibold">{{ oBrandboost.metaObj.sourceName }}</a>
                        </div>
                        <div class="text-muted text-size-small">View</div>
                    </div>
                </template>
            </td>

            <td>
                <div class="media-left">
                    <div class=""><a href="#"
                                     class="text-default text-semibold">{{oBrandboost.created}}</a>
                    </div>
                    <div
                        class="text-muted text-size-small">{{ oBrandboost.created }}</div>
                </div>
            </td>

            <td>
                <div data-toggle="tooltip"
                     :title="`Total contacts ${oBrandboost.metaObj.allSubscribers.length}`"
                     data-placement="top">
                    <a :href="`admin/brandboost/offsite_setup/${oBrandboost.id}?t=contacts`" class="text-default text-semibold">
                        {{ oBrandboost.metaObj.allSubscribers.length }}
                        <span v-if="oBrandboost.metaObj.newContacts" style="color:#FF0000;">({{oBrandboost.metaObj.newContacts}} new)</span>
                    </a>
                </div>
            </td>


            <td>
                <div class="media-left">
                    <div
                        :class="positiveClasses"
                        segment-type="total-positive" :campaign-id="oBrandboost.id"
                        campaign-type="email" title="click to create segment">
                        <div class="left-half-clipper">
                            <div class="first50-bar"></div>
                            <div class="value-bar"></div>
                        </div>
                    </div>
                </div>
                <div class="media-left">
                    <div data-toggle="tooltip"
                         :title="`${oBrandboost.metaObj.positiveRating} out of ${oBrandboost.metaObj.revCount} Responses`"
                         data-placement="top">
                        <a v-if="oBrandboost.metaObj.positiveRating >0" :href="`/admin/feedback/listall/${oBrandboost.id}/?t=positive`"
                           class="text-default text-semibold">{{ oBrandboost.metaObj.positiveRating }}</a>
                        <a v-else href="javascript:void(0);"
                           class="text-default text-semibold">{{ oBrandboost.metaObj.positiveRating }}</a>
                        <span v-if="oBrandboost.metaObj.newPositive > 0" style="color:#FF0000;"> ({{oBrandboost.metaObj.newPositive}} new)</span>
                    </div>
                </div>

            </td>
            <td>
                <div class="media-left">
                    <div
                        :class="neutralClasses"
                        segment-type="total-neutral" :campaign-id="oBrandboost.id"
                        campaign-type="email" title="click to create segment">
                        <div class="left-half-clipper">
                            <div class="first50-bar"></div>
                            <div class="value-bar"></div>
                        </div>
                    </div>
                </div>
                <div class="media-left">
                    <div data-toggle="tooltip"
                         :title="`${oBrandboost.metaObj.neutralRating} out of ${oBrandboost.metaObj.revCount} Responses`"
                         data-placement="top">
                        <a v-if="oBrandboost.metaObj.neutralRating > 0" :href="`/admin/feedback/listall/${oBrandboost.id}/?t=neutral`"
                           class="text-default text-semibold">
                            {{ oBrandboost.metaObj.neutralRating }}
                        </a>
                        <a v-else href="javascript:void(0);"
                           class="text-default text-semibold">{{ oBrandboost.metaObj.neutralRating }}</a>
                        <span v-if="oBrandboost.metaObj.newNeutral > 0" style="color:#FF0000;"> ({{oBrandboost.metaObj.newNeutral}} new)</span>
                    </div>
                </div>

            </td>
            <td>

                <div class="media-left">
                    <div
                        :class="negativeClasses"
                        segment-type="total-negative" :campaign-id="oBrandboost.id"
                        campaign-type="email" title="click to create segment">
                        <div class="left-half-clipper">
                            <div class="first50-bar"></div>
                            <div class="value-bar"></div>
                        </div>
                    </div>
                </div>
                <div class="media-left">
                    <div data-toggle="tooltip"
                         :title="`${oBrandboost.metaObj.negativeRating} out of ${oBrandboost.metaObj.revCount} Responses`"
                         data-placement="top">
                        <a v-if="oBrandboost.metaObj.negativeRating > 0" :href="`/admin/feedback/listall/${oBrandboost.id}/?t=negative`"
                           class="text-default text-semibold">
                            {{ oBrandboost.metaObj.negativeRating }}
                        </a>
                        <a v-else href="javascript:void(0);"
                           class="text-default text-semibold">{{ oBrandboost.metaObj.negativeRating }}</a>
                        <span v-if="oBrandboost.metaObj.newNegative > 0" style="color:#FF0000;"> ({{oBrandboost.metaObj.newNegative}} new)</span>

                    </div>
                </div>

            </td>
            <td>
                <template v-if="oBrandboost.metaObj.revCount>0">
                    <div class="media-left media-middle">
                        <img :src="oBrandboost.metaObj.ratingSrc" class="img-circle" width="26" alt="">
                    </div>
                    <div class="media-left">
                        <div class="">
                            <a href="#" class="text-default text-semibold">{{ oBrandboost.metaObj.ratingValue }} </a>
                        </div>
                        <div class="text-muted text-size-small" v-if="oBrandboost.metaObj.subscriberData != '' && oBrandboost.metaObj.subscriberData != null">
                            <template v-if="oBrandboost.metaObj.subscriberData.firstname">
                                {{oBrandboost.metaObj.subscriberData.firstname}}
                            </template>
                            <template v-else>
                                <span class="text-muted text-size-small">[No Data]</span>
                            </template>
                        </div>
                        <div class="text-muted text-size-small" v-else>
                            <span class="text-muted text-size-small">[No Data]</span>
                        </div>
                    </div>
                </template>
                <template v-else>
                    {{ displayNoData() }}
                </template>
            </td>

            <td>
                <div class="tdropdown">
                    <i v-if="oBrandboost.status == 0" class="icon-primitive-dot txt_red fsize16"></i>

                    <i v-else-if="oBrandboost.status == 2" class="icon-primitive-dot txt_grey fsize16"></i>

                    <i v-else-if="oBrandboost.status == 3" class="icon-primitive-dot txt_red fsize16"></i>

                    <i v-else class="icon-primitive-dot txt_green fsize16"></i>

                    <a class="text-default text-semibold bbot dropdown-toggle"
                       data-toggle="dropdown" v-text="getStatus(oBrandboost.status)"></a>
                    <ul class="dropdown-menu dropdown-menu-right status">

                    </ul>
                </div>
            </td>

            <td style="display: none;">{{ oBrandboost.status }}</td>
            <td style="display: none;">{{ oBrandboost.status }}</td>
            <td style="display: none;">{{ oBrandboost.metaObj.positive > 0 ? 'positive' : '' }}</td>
            <td style="display: none;">{{ oBrandboost.metaObj.neutral > 0 ? 'neutral' : '' }}</td>
            <td style="display: none;">{{ oBrandboost.metaObj.negative > 0 ? 'negative' : '' }}</td>
            <td style="display: none;">{{ oBrandboost.created === new Date()  ? 'today' : '' }}</td>


            <td v-html="oBrandboost.metaObj.lastListTime"></td>
            <td class="text-center">
                <div class="tdropdown ml10"><a class="table_more dropdown-toggle"
                                               data-toggle="dropdown"
                                               aria-expanded="false"><img
                    src="/assets/images/more.svg"></a>

                    <ul v-if="(user_role != 2) && (currentUserId == oBrandboost.user_id || user_role == 1)" class="dropdown-menu dropdown-menu-right more_act">


                        <template v-if="canWrite == true">
                            <li v-if="oBrandboost.status == 1">
                                <a href="javascript:void(0);"
                                   class="changeStatusCampaign"
                                   :brandID="oBrandboost.id" status="2"><i
                                    class="icon-file-stats"></i> Pause</a>
                            </li>

                            <li v-if="oBrandboost.status == 2">
                                <a href="javascript:void(0);"
                                   class="changeStatusCampaign"
                                   :brandID="oBrandboost.id" status="1"><i
                                    class="icon-file-stats"></i> Start</a>
                            </li>

                            <li>
                                <a :href="`/admin/brandboost/offsite_setup/${oBrandboost.id}`"
                                   :brandID="oBrandboost.id"
                                   :b_title="oBrandboost.brand_title"><i
                                    class="icon-gear"></i> Edit</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="deleteCampaign"
                                   :brandID="oBrandboost.id"><i
                                    class="icon-file-locked"></i> Delete</a>
                            </li>
                            <li><a href="javascript:void(0);" class="archiveCampaign"
                                   :brandID="oBrandboost.id"><i class="icon-file-text2"></i>
                                Move to Archive</a>
                            </li>
                            <li>
                                <a :href="`/admin/brandboost/statistics/${oBrandboost.id}`"
                                   class="" :brandID="oBrandboost.id"><i
                                    class="icon-file-text2"></i> Statistics</a>
                            </li>
                        </template>
                        <li>
                            <a :href="`/admin/brandboost/subscribers/${oBrandboost.id}`"><i
                                class="icon-gear"></i> Subscribers</a>
                        </li>
                    </ul>
                </div>


            </td>

        </tr>
        <!--=======================-->
        </tbody>
    </table>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    export default {
        name : 'campaign-list',
        props : ['oBrandboosts', 'bActiveSubsription', 'currentUserId', 'iActiveCount', 'iArchiveCount', 'user_role', 'canRead', 'canWrite'],
        components: { UserAvatar },
        /*components: { UserAvatar, OverviewStats },*/
        data() {
            return {

            }
        },

        methods : {
            positiveClasses: function(data){

                let addPC = '';
                let extClass = '';
                if(data.metaObj.positiveGraph > 50){
                    addPC = 'over50';
                }
                if(data.metaObj.positiveGraph > 0){
                    extClass = 'createSegment';
                }
                return 'progress-circle '+addPC+' green cp'+data.metaObj.positiveGraph+ ' '+ extClass;
            },

            neutralClasses: function(data){
                let addPC = '';
                let extClass = '';
                if(data.metaObj.neutralGraph > 50){
                    addPC = 'over50';
                }
                if(data.metaObj.neutralGraph > 0){
                    extClass = 'createSegment';
                }
                return 'progress-circle '+addPC+' grey cp'+data.metaObj.neutralGraph+ ' '+ extClass;
            },
            negativeClasses: function(data){
                let addPC = '';
                let extClass = '';
                if(data.metaObj.negativeGraph > 50){
                    addPC = 'over50';
                }
                if(data.metaObj.negativeGraph > 0){
                    extClass = 'createSegment';
                }
                return 'progress-circle '+addPC+' red cp'+data.metaObj.negativeGraph+ ' '+ extClass;
            },
            getStatus: function(status){
                let displayStatus = '';
                if(status == 0){
                    displayStatus = 'Inactive';
                }else if(status == 2){
                    displayStatus = 'Pending';
                }else if(status == 3){
                    displayStatus = 'Archive';
                }else{
                    displayStatus = 'Active';
                }
                return displayStatus;
            }
        },

        mounted() {
           let elem = this;
            setTimeout(function(){
                let tableId = 'offsiteBrandboostCampaign';
                elem.paginate(tableId);
            }, 1000)

        }

    }

</script>
