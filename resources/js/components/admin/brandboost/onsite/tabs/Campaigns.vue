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
                        <div class="col"><p><a href="#"><img src="assets/images/filter-line.svg"> &nbsp; Filter</a></p></div>
                        <div class="col text-right"><p><a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a> &nbsp; <a href="#"><i><img src="assets/images/sort_16_grey.svg"></i></a></p></div>
                    </div>
                </div>
                <div class="p20 pt0 pb0 bkg_light_050">
                    <ul class="list_with_icons3">
                        <li class="d-flex">
                            <span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/start-fill-white.svg"></span>IBM</span>
                            <strong>4.5 <i class="ri-star-fill green_400"></i></strong>
                        </li>
                        <li class="d-flex">
                            <span><span class="circle_icon_24 bkg_green_200"><img src="assets/images/start-fill-white.svg"></span>General Electric</span>
                            <strong>4.8 <i class="ri-star-fill green_400"></i></strong>
                        </li>
                        <li class="d-flex">
                            <span><span class="circle_icon_24 bkg_review_200"><img src="assets/images/start-fill-white.svg"></span>Louis Vuitton</span>
                            <strong>3.2 <i class="ri-star-fill yellow_400"></i></strong>
                        </li>
                        <li class="d-flex active">
                            <span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/start-fill-white.svg"></span>Apple</span>
                            <strong>4.3 <i class="ri-star-fill green_400"></i></strong>
                        </li>
                        <li class="d-flex">
                            <span><span class="circle_icon_24 bkg_red_200"><img src="assets/images/start-fill-white.svg"></span>IBM</span>
                            <strong>2.7 <i class="ri-star-fill red_400"></i></strong>
                        </li>
                        <li class="d-flex">
                            <span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/start-fill-white.svg"></span>General Electric</span>
                            <strong>4.8 <i class="ri-star-fill green_400"></i></strong>
                        </li>
                        <li class="d-flex">
                            <span><span class="circle_icon_24 bkg_yellow_200"><img src="assets/images/start-fill-white.svg"></span>Louis Vuitton</span>
                            <strong>4.5 <i class="ri-star-fill green_400"></i></strong>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
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
