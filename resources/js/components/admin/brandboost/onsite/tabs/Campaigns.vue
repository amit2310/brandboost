<template>

    <div>
        <div class="page_sidebar bkg_light_000 fixed">
            <div style="width: 279px;">
                <div class="p20 bbot top_headings">
                    <div class="row">
                        <div class="col"><p>REVIEWS</p></div>
                        <div class="col text-right"><p><a class="close_sidebar" href="#">OPEN MENU &nbsp; <img src="assets/images/menu-2-line.svg"></a></p></div>
                    </div>
                </div>

                <div class="p20 pt30 pb10">
                    <div class="row">
                        <div class="col"><h3 class="htxt_medium_24 dark_800">Campaigns</h3></div>
                        <div class="col text-right"><button class="circle-icon-32 shadow3"><img src="assets/images/add-fill-review.svg"></button></div>
                    </div>
                </div>

                <div class="p20 top_headings">
                    <div class="row">
                        <div class="col-md-4">
                            <!--<p>
                                <a href="#"><img src="assets/images/filter-line.svg"> &nbsp; Filter</a>
                            </p>-->
                            <a class="" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);"><i><img src="assets/images/filter-line.svg"></i> &nbsp;Filter</a>
                            <div class="dropdown-menu p10 mt-1">
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Name'}" @click="sortBy='Name'">ALL</a><br />
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Active'}" @click="sortBy='Active'">ACTIVE</a><br />
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Inactive'}" @click="sortBy='Inactive'">INACTIVE</a><br />
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Pending'}" @click="sortBy='Pending'">PENDING</a><br />
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Archive'}" @click="sortBy='Archive'">ARCHIVE</a><br />
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Positive'}" @click="sortBy='Positive'">POSITIVE</a><br />
                                <a href="javascript:void(0);" :class="{'active': viewType == 'Negative'}" @click="sortBy='Negative'">NEGATIVE</a>
                            </div>
                        </div>
                        <div class="col-md-8 text-right">
                            <p>
                                <!--<a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a>-->
                                <input class="table_search" type="text" placeholder="Search" v-model="searchBy" @input="searchItem">
                                <a href="javascript:void(0);"><i><img src="assets/images/sort_16_grey.svg"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p20 pt0 pb0 bkg_light_050">
                    <ul class="list_with_icons3">
                        <li v-for="campaign in campaigns" :key="campaign.id" class="d-flex">
                            <span>
                                <span v-if="(campaign.revRA != '' && campaign.revRA > '3')" class="circle_icon_24 bkg_green_200">
                                    <img src="assets/images/start-fill-white.svg">
                                </span>
                                <span v-else-if="(campaign.revRA != '' && campaign.revRA == '3')" class="circle_icon_24 bkg_yellow_200">
                                    <img src="assets/images/start-fill-white.svg">
                                </span>
                                <span v-else-if="(campaign.revRA != '' && campaign.revRA < '3')" class="circle_icon_24 bkg_red_200">
                                    <img src="assets/images/start-fill-white.svg">
                                </span>
                                <span v-else class="circle_icon_24 bkg_blue_200">
                                    <img src="assets/images/start-fill-white.svg">
                                </span>
                                <a href="javascript:void(0);" @click="setupBroadcast(campaign.id)">
                                    <span>{{ setStringLimit(capitalizeFirstLetter(campaign.brand_title), 25) }}</span>
                                </a>
                            </span>
                            <strong>
                                <span v-if="campaign.revRA != ''">{{ number_format(campaign.revRA, 1) }}&nbsp;</span>
                                <span v-else>&nbsp;</span>
                                <i v-if="(campaign.revRA != '' && campaign.revRA > '3')" class="ri-star-fill green_400"></i>
                                <i v-else-if="(campaign.revRA != '' && campaign.revRA == '3')" class="ri-star-fill yellow_400"></i>
                                <i v-else-if="(campaign.revRA != '' && campaign.revRA < '3')" class="ri-star-fill red_400"></i>
                                <i v-else class=""></i>
                            </strong>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <pagination
                        :pagination="allData"
                        @paginate="showPaginationData"
                        :offset="4"
                        :noItemPerPage="true"
                        class="mt-4">
                    </pagination>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Onsite Reviews - Brand Boost',
        name: "OnsiteCampaignsTab",
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data(){
            return {
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                company_name: '',
                count : 0,
                campaigns : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                viewType: 'List View',
                sortBy: 'Date Created',
                searchBy: ''
            }
        },
        created() {
            this.loadPaginatedData();
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
        },
        watch: {
            'sortBy' : function(){
                this.loadPaginatedData();
            }
        },
        methods: {
            searchItem: function(){
                this.loadPaginatedData();
            },
            setupBroadcast: function(id){
                window.location.href='#/reviews/onsite/setup/'+id+'/1';
            },
            showContacts: function(id){
                window.location.href='#/brandboost/stats/onsite/'+id+'?t=contact';
            },
            showCampaignPage: function(id,companyName,campaignName){
                window.location.href='#/for/'+companyName+'/'+campaignName+'-'+id;
            },
            showReviews: function(id){
                window.location.href='#/brandboost/reviews/'+id;
            },
            showQuestions: function(id){
                window.location.href='#/brandboost/questions/'+id;
            },
            loadPaginatedData : function(){
                axios.get('/admin/brandboost/onsite?page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.company_name = response.data.company_name;
                        this.allData = response.data.allData;
                        this.campaigns = response.data.aBrandbosts;
                        this.loading = false;
                        //console.log(this.campaigns)
                    });
            },
            showPaginationData: function(p){
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.current_page = p;
                this.loadPaginatedData();
            }
        }
    }

</script>
