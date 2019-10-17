<template>
<div>
    <table v-if="oData" class="table" id="offsiteFeedback">
        <thead>
        <tr>
            <th style="display: none;"></th>
            <th style="display: none;"></th>
            <th class="nosort editAction" style="display:none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
            <th><i class="icon-user"></i>Name</th>
            <th><i class="icon-user"></i>Campaign</th>
            <th><i class="icon-star-full2"></i>Ratings</th>
            <th><i class="icon-paragraph-left3"></i>Feedback</th>
            <th><i class="icon-calendar"></i>Created</th>
            <th><i class="icon-hash"></i>Tags</th>
            <th><i class="icon-folder2"></i>Category</th>
            <th><i class="icon-diff-modified"></i>Status</th>
            <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
            <th style="display: none;"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="row in oData" :id="`append-feedback-${row.id}`" class="selectedClass">
            <td style="display: none;">{{ row.created }}</td>
            <td style="display: none;">{{ row.id }}</td>
            <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left">
                <input type="checkbox" name="checkRows[]" class="checkRows"  :value="row.id" ><span class="custmo_checkmark"></span></label></td>
            <td class="viewSmartPopup" :feedbackid="row.id">
                <div class="media-left media-middle">
                    <user-avatar
                        :avatar="row.avatar"
                        :firstname="row.firstname"
                        :lastname="row.lastname"
                    ></user-avatar>
                </div>
                <div v-if="row.firstname != ''" class="media-left">
                    <div class="pt-5">
                        <a href="javascript:void(0);" class="text-default text-semibold">
                            <span>{{ row.firstname }} {{ row.lastname }}</span>
                            <img class="flags" src="/assets/images/flags/us.png"/>
                        </a>
                    </div>
                    <div class="text-muted text-size-small">{{ row.email }}</div>
                </div>
                <div v-if="row.firstname != ''" class="media-left" v-html="displayNoData()">
                </div>
            </td>
            <td>
                <div class="media-left media-middle">
                    <a
                        :href="`/admin/brandboost/offsite_setup/${row.brandboost_id}`"
                        :brandID="row.brandboost_id"
                        :b_title="row.brand_title">
                        <img src="/assets/images/default_table_img2.png" class="img-circle img-xs br5" alt="Img">
                    </a>
                </div>
                <div class="media-left">
                    <div class="">
                        <a
                            :href="`/admin/brandboost/offsite_setup/${row.brandboost_id}`"
                            :brandID="row.brandboost_id"
                            :b_title="row.brand_title"
                            class="text-default text-semibold" v-html="row.brand_title">
                        </a>
                    </div>
                    <div class="text-muted text-size-small" v-html="setStringLimit(row.brand_desc, 28)"></div>
                </div>
            </td>

            <td v-html="row.smily">
            </td>

            <td>
                <a :href="`/admin/feedback/details/${row.id}`" class="txt_dblack">
                    <div v-if="row.title != ''" class="text-semibold" v-html="setStringLimit(row.title, '23')"></div>
                    <div v-else class="text-semibold" v-html="displayNoData()"></div>
                    <div v-if="row.feedback != ''" class="text-size-small text-muted"
                         v-html="setStringLimit(row.feedback.replace(' ', '').replace('<br>', '').replace(/(<([^>]+)>)/ig,''), '31')"
                    ></div>
                    <div v-else class="text-size-small text-muted" v-html="displayNoData()">
                    </div>
                </a>
            </td>

            <td>
                <div class="media-left">
                    <div class="pt-5">
                        <a href="#" class="text-default text-semibold">
                            {{ row.created }}
                        </a>
                    </div>
                    <div class="text-muted text-size-small">{{ row.created }}</div>
                </div>
            </td>

            <td :id="`feedback_tag_${ row.id }`">
                <feedback-tags :feedbackId="row.id"></feedback-tags>
            </td>

            <td>
                <div class="tdropdown">
                    <i v-if="row.category == 'Positive'" class="icon-primitive-dot txt_green fsize16"></i>

                    <i v-else-if="row.category == 'Neutral'" class="icon-primitive-dot txt_grey fsize16"></i>

                    <i v-else class="icon-primitive-dot txt_red fsize16"></i>

                    <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                        {{ (row.category != '') ? row.category : 'Negative' }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right status">

                        <template v-if="row.category == 'Positive'">
                            <li><a href="javascript:void(0);" :feedback_id="row.id" fb_status="Neutral" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_grey"></i> Neutral</a> </li>
                            <li><a href="javascript:void(0);" :feedback_id="row.id" fb_status="Negative" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_red"></i> Negative</a> </li>
                        </template>

                        <template v-else-if="row.category == 'Neutral'">
                            <li><a href="javascript:void(0);" :feedback_id="row.id" fb_status="Positive" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_green"></i> Positive</a> </li>
                            <li><a href="javascript:void(0);" :feedback_id="row.id" fb_status="Negative" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_red"></i> Negative</a> </li>
                        </template>

                        <template v-else>
                            <li><a href="javascript:void(0);" :feedback_id="row.id" fb_status="Positive" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_green"></i> Positive</a> </li>
                            <li><a href="javascript:void(0);" :feedback_id="row.id" fb_status="Neutral" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_grey"></i> Neutral</a> </li>
                        </template>
                    </ul>
                </div>
            </td>

            <td>
                <div class="tdropdown">

                    <i v-if="row.status == 0" class="icon-primitive-dot txt_red fsize16"></i>

                    <i v-else-if="row.status == 2" class="icon-primitive-dot txt_grey fsize16"></i>

                    <i v-else class="icon-primitive-dot txt_green fsize16"></i>

                    <a v-if="row.status == 0" class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">Inactive</a>
                    <a v-else-if="row.status == 2" class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">Pending</a>
                    <a v-else class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">Active</a>

                    <ul class="dropdown-menu dropdown-menu-right status">
                        <template v-if="canWrite">
                            <template v-if="row.status == 1">
                                <li><a :feedback_id="row.id" change_status = '0'  class='chg_status'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>
                            </template>
                            <template v-else-if="row.status == 2">
                                <li><a :feedback_id="row.id" change_status = '1' class='chg_status'><i class='icon-primitive-dot txt_green'></i> Active</a></li>
                                <li><a :feedback_id="row.id" change_status = '0'  class='chg_status'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>
                            </template>
                            <template v-else>
                                <li><a :feedback_id="row.id" change_status = '1' class='chg_status'><i class='icon-primitive-dot txt_green'></i> Active</a></li>
                            </template>
                        </template>
                    </ul>
                </div>
            </td>

            <td class="text-center">
                <div class="tdropdown ml10">
                    <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="/assets/images/more.svg"></a>
                    <ul class="dropdown-menu dropdown-menu-right more_act">
                        <a href="javascript:void(0);" class="dropdown_close">X</a>
                        <template v-if="canWrite">
                            <template v-if="row.status == 1">
                                <li><a :feedback_id="row.id" change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>
                            </template>
                            <template v-else-if="row.status == 2">
                                <li><a :feedback_id="row.id" change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>
                                <li><a :feedback_id="row.id" change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>
                            </template>
                            <template v-else>
                                <li><a :feedback_id="row.id" change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>";
                            </template>
                        </template>

                        <li><a target="_blank" :href="`/admin/feedback/details/${row.id}`"><i class="icon-file-locked"></i> View Details</a></li>
                    </ul>
                </div>
            </td>

            <td style="display: none;">
                <template v-if="row.category == 'Positive'">positive</template>
                <template v-else-if="row.category == 'Neutral'">neutral</template>
                <template v-if="">negative</template>
            </td>

        </tr>
        </tbody>
    </table>

    <table v-else class="table datatable-basic">
        <thead>
        <tr>
            <th><i class="icon-user"></i>Name</th>
            <th><i class="icon-user"></i>Campaign</th>
            <th><i class="icon-star-full2"></i>Ratings</th>
            <th><i class="icon-paragraph-left3"></i>Feedback</th>
            <th><i class="icon-calendar"></i>Created</th>
            <th><i class="icon-hash"></i>Tags</th>
            <th><i class="icon-folder2"></i>Category</th>
            <th><i class="icon-diff-modified"></i>Status</th>
            <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>

        </tr>
        </thead>

        <tbody>
        <td style="display: none"></td>
        <td style="display: none"></td>
        <td colspan="10">
            <div class="row">
                <div class="col-md-12">
                    <div style="margin: 20px 0px 0;" class="text-center">
                        <h5 class="mb-20 mt40">
                            Looks Like You Don’t Have Any Feedback Yet <img src="/assets/images/smiley.png"> <br>
                            Lets Create Your First Feedback.
                        </h5>
                    </div>
                </div>
            </div>
        </td>
        <td style="display: none"></td>
        <td style="display: none"></td>
        <td style="display: none"></td>
        <td style="display: none"></td>
        <td style="display: none"></td>
        <td style="display: none"></td>
        </tbody>
    </table>

</div>

</template>

<script>
    import UserAvatar from '../../../helpers/UserAvatar';
    import FeedbackTags from './FeedbackTags';
    /*import FeedbackJS from '../../../../../../assets/js/modules/offsite/feedback.js';*/
    export default {
        name : 'feedback-list-table',
        props : ['oData', 'canRead', 'canWrite'],
        components: { UserAvatar, FeedbackTags },
        data() {
            return {

            }
        },

        methods : {},

        mounted() {
             axios.get('/admin/brandboost/offsite_overview')
                .then(response => {
                    this.oBrandboosts = response.data.aBrandbosts;
                    this.viewstats = response.data.viewstats;
                    this.bActiveSubsription = response.data.bActiveSubsription;
                    this.iActiveCount = response.data.iActiveCount;
                    this.iArchiveCount = response.data.iArchiveCount;
                    this.user_role = response.data.user_role;
                    this.canRead = response.data.canRead;
                    this.canWrite = response.data.canWrite;
                    this.currentUserId = response.data.currentUserId;

                    setTimeout(function(){
                        loadJS();
                    }, 50);

                    /*let tableId = 'offsiteFeedback';
                    this.paginate(tableId);*/

                });
        }

    }

    function loadJS() {
        // DOM: Create the script element
        var jsElm = document.createElement("script");
        // set the type attribute
        jsElm.type = "application/javascript";
        // make the script element load file
        jsElm.src = '/assets/js/modules/offsite/feedback.js';
        // finally insert the element to the body element in order to load the script
        document.body.appendChild(jsElm);
    }




</script>

<!-- /theme JS files -->
<style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
</style>
