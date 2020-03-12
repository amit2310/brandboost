<template>

    <div class="content">
        <!--******************
                Top Heading area
                **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Add Review</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <!--<button class="circle-icon-40 mr15"><img src="assets/images/settings-2-line-reviews.svg"></button>-->
                        <button class="btn btn-md bkg_light_000 reviews_400 fw500 pl20 mr-2 shadow3" @click.prevent="saveReview" >Save</button>
                        <button class="btn btn-md bkg_reviews_400 fw500 light_000 pl20 pr20" @click.prevent="saveReview">Save & Publish <span><img width="16" src="assets/images/arrow-right-circle-fill.svg"></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <div class="content-area">
            <div class="container-fluid">
                <system-messages :successMsg="successMsg" :errorMsg="errorMsg"></system-messages>
                <loading :isLoading="loading"></loading>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_200 text-uppercase ls_4">BASIC</h3>
                            <hr>
                            <div class="form-group review_forms">
                                <label class="fw500 fsize11 dark_600 ls_4">REVIEW TYPE</label>
                                <select v-model="reviewType" class="form-control form-control-custom h48 dark_600">
                                    <option value="site">Site Review</option>
                                    <option value="product">Product/Service Review</option>
                                </select>
                            </div>

                            <div class="form-group m-0 review_forms" v-if="reviewType=='product'">
                                <label class="fw500 fsize11 dark_600 ls_4">PRODUCT dropdown</label>
                                <a class="fw500 fsize11 reviews_400 ls_4 float-right" href="javascript:void(0);">CREATE NEW <i class="ri-add-circle-fill"></i></a>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle bkg_light_000 border br4 w-100 p-3 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select review type
                                    </button>
                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                        <div class="p10">
                                            <input type="text" name="" value="" placeholder="Search" class="form-control"/>
                                        </div>

                                        <a class="dropdown-item" href="javascript:void(0);" @click="selectProduct('any')">Any</a>
                                        <a class="dropdown-item" href="javascript:void(0);" @click="selectProduct('any')">Specific Product</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_200 text-uppercase ls_4">FROM</h3>
                            <hr>
                            <div class="form-group m-0 review_forms">
                                <label class="fw500 fsize11 dark_600 ls_4">REVIEW AUTHOR dropdown</label>
                                <a class="fw500 fsize11 reviews_400 ls_4 float-right" href="javascript:void(0);">CREATE NEW <i class="ri-add-circle-fill"></i></a>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle bkg_light_000 border br4 w-100 p-3 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{selectedSubscriberName}}
                                    </button>
                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" style="height:300px;overflow:auto;">
                                        <div class="p10">
                                            <input type="text" v-model="searchContactBy" placeholder="Search" class="form-control"/>
                                        </div>

                                        <a class="dropdown-item" href="javascript:void(0);" v-for="subscriber in filteredContacts" @click="selectContact(subscriber)" :class="{'active': selectedSubscriber == subscriber.id}">{{subscriber.firstname}} {{subscriber.lastname}}</a>

                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_200 text-uppercase ls_4">REVIEW</h3>
                            <hr>
                            <div class="form-group review_forms">
                                <label class="fw500 fsize11 dark_600 ls_4">RATING</label>

                                <div class="p10 border br4 pl20">
                                    <div class="row">
                                        <div class="col-8">
                                            <i v-for="idx in [1,2,3,4,5]" class="ri-star-fill fsize17 mr-2" :class="selectedRating >= idx ? 'green_400': 'light_800'" @click="selectedRating=idx" style="cursor:pointer;"></i>
                                        </div>
                                        <div class="col-4 blef">
                                            <select v-model="selectedRating" class="form-control-custom2 border-0 fsize14 dark_200 p-1 pl0 pr20 w-100 dark_600">
                                                <option value="5">5.0</option>
                                                <option value="4">4.0</option>
                                                <option value="3">3.0</option>
                                                <option value="2">2.0</option>
                                                <option value="1">1.0</option>
                                                <option>Select rating</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group review_forms">
                                <label class="fw500 fsize11 dark_600 ls_4">REVIEW TITLE</label>
                                <input type="text" class="form-control h48 dark_600" v-model="title" placeholder="Enter review title" value="Great customer service!" />
                            </div>

                            <div class="form-group review_forms m-0">
                                <label class="fw500 fsize11 dark_600 ls_4">CONTENT</label>
                                <textarea class="form-control fsize14 dark_200 p-3 min-h-280 dark_600" v-model="description" placeholder="Robert was most helpfull and understanding when I made an error in my checkout. He took very good care of making sure the problem would be resolved. He gets 5* for being my hero!! Kayla helped me today to order my book, live chat is so helpful and very quick to sort my problem. Kayla was kind, helpful and made me at ease that we could do this no problem and quickly. thank you Kayla.

I had a problem with my order, and despite repeated attempts, I could not get Printerpix to sort it out. I contacted them via Paypal, and Kayla took up my case. She understood the problem, and fixed it. Thanks Kayla."></textarea>
                            </div>




                        </div>



                    </div>

                    <div class="col-md-4">

                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">STATUS</h3>
                            <hr>
                            <ul class="info_list">
                                <li><span>Status</span><strong>Published &nbsp; <i class="ri-checkbox-blank-circle-fill green_400 fsize8"></i> </strong> </li>
                                <li><span>Visibility</span><strong>Public &nbsp; <i class="ri-checkbox-blank-circle-fill green_400 fsize8"></i> </strong></li>
                                <li><span>Publish date</span><strong>Dec 16, 3:18 PM &nbsp; <i class="ri-checkbox-blank-circle-fill green_400 fsize8"></i> </strong></li>

                            </ul>
                        </div>

                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">CAMPAIGN</h3>
                            <hr>
                            <div class="form-group m-0 review_forms">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle bkg_light_000 border br4 w-100 p-3 text-left fw400 fsize14 shadow_none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{selectedCampaignName}}
                                    </button>
                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" style="height:300px;overflow:auto;">
                                        <div class="p10">
                                            <input type="text" v-model="searchCampaignBy" placeholder="Search" class="form-control"/>
                                        </div>
                                        <a class="dropdown-item" href="javascript:void(0);" v-for="campaign in filteredCampaigns" v-if="campaign.status=='1'" @click="selectCampaign(campaign)" :class="{'active': selectedCampaign == campaign.id}">{{campaign.brand_title}}</a>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4 mb-3">Media</h3>
                            <img class="br5 w-100" src="assets/images/media5.svg"/>
                            <!--<label class="m0 w-100" for="upload">
                             <div class="img_vid_upload_media">
                               <input class="d-none" type="file" name="" value="" id="upload">
                             </div>
                             </label>-->
                        </div>

                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">Tags</h3>
                            <hr>
                            <div>
                                <button class="tags_btn mb-3">customer</button>
                                <button class="tags_btn mb-3">email</button>
                                <button class="tags_btn mb-3">4 star</button>
                                <button class="tags_btn mb-3">website about</button>
                                <button class="tags_btn mb-3">positive</button>
                                <button class="tags_btn mb-3">4 star</button>
                                <button class="tags_btn mb-3">male</button>
                                <button class="tags_btn mb-3">user</button>
                                <button class="tags_btn mb-3">+</button>
                            </div>
                        </div>

                        <div class="card p25">
                            <h3 class="htxt_medium_12 dark_600 text-uppercase ls_4">Details</h3>
                            <hr>
                            <ul class="info_list">
                                <li><span>ID</span><strong>12391231</strong></li>
                                <li><span>Order ID</span><strong class="">32492</strong></li>
                                <li><span>Product ID</span><strong class="">1018</strong></li>
                                <li><span>Source</span><strong class="">Imported</strong></li>
                            </ul>
                        </div>
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
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data(){
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaigns : '',
                selectedCampaign : '',
                selectedCampaignName : 'Select Campaign',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                viewType: 'List View',
                sortBy: 'all',
                searchBy: '',
                deletedItems: [],
                subscribers: '',
                selectedSubscriber: '',
                selectedSubscriberName: 'Select review\'s author contact',
                selected_campaign: '',
                reviewType: 'site',
                selectedProduct: '',
                searchContactBy: '',
                searchProductBy: '',
                searchCampaignBy: '',
                selectedRating: '4',
                title: '',
                description: '',
                firstname: '',
                lastname: '',
                email: '',
                phone: '',
            }
        },
        created() {
            this.loadPaginatedData();
        },
        mounted() {
        },
        computed: {
            filteredContacts() {
                if (this.subscribers) {
                    return this.subscribers.filter(subscriber => {
                        return (subscriber.firstname.toLowerCase().includes(this.searchContactBy.toLowerCase()) || subscriber.lastname.toLowerCase().includes(this.searchContactBy.toLowerCase()))
                    });
                }
            },
            filteredCampaigns() {
                if (this.campaigns) {
                    return this.campaigns.filter(campaign => {
                        return campaign.brand_title.toLowerCase().includes(this.searchCampaignBy.toLowerCase())
                    });
                }
            },

        },
        methods: {
            selectContact: function(data){
                this.selectedSubscriber = data.id;
                this.selectedSubscriberName = data.firstname + ' '+ data.lastname;
                this.firstname = data.firstname;
                this.lastname = data.lastname;
                this.email = data.email;
                this.phone = data.phone;
            },
            selectCampaign: function(data){
                this.selectedCampaign = data.id;
                this.selectedCampaignName = data.brand_title;
            },
            selectProduct: function(data){
                this.selectedProduct = '';
            },
            loadPaginatedData : function(){
                axios.get('/admin/brandboost/addReview')
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.allData = response.data.aBrandboostList;
                        this.campaigns = response.data.aBrandboostList;
                        this.subscribers = response.data.subscribers;
                        this.loading = false;
                    });
            },
            saveReview: function(){
                if(confirm("Are you sure you want to add manual review?")){
                    this.loading = true;
                    let manualForm = {
                        campaign_id: this.selectedCampaign,
                        reviewType: this.reviewType,
                        title: this.title,
                        description: this.description,
                        ratingValue: this.selectedRating,
                        fullname: this.firstname+ ' '+ this.lastname,
                        emailid: this.email,
                        phone: this.phone,
                        display_name: '',
                        productId: this.reviewType == 'product' ? this.selectedProduct : '',
                        recomendationValue: '',
                        site_uploaded_name: '',
                        _token: this.csrf_token()
                    };
                    /*Some basic validations*/
                    if(this.reviewType == ''){
                        alert('Please select review type!');
                        return false;
                    }else if(this.selectedCampaign == ''){
                        alert('Please select a campaign to which you want to add review!');
                        return false;
                    }else if(this.selectedSubscriber == ''){
                        alert('Please select a review author for the review!');
                        return false;
                    }else if(this.title == ''|| this.description == ''){
                        alert('Please entery title and description for the review!');
                        return false;
                    }
                    axios.post('/reviews/addManualReview', manualForm)
                        .then(response => {
                            this.loading = false;
                            if(response.data.status == 'success'){
                                this.successMsg = 'Review has been added successfully!!';
                            }
                        });

                }
            }

        }
    }
</script>
