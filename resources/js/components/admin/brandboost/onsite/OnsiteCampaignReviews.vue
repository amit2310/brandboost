<template>
    <div>
        Content goes here
    </div>
</template>

<script>
    import UserAvatar from '../../../helpers/UserAvatar';
    import Pagination from '../../../helpers/Pagination';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data() {
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                reviews : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                campaigns: ''
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.loadPaginatedData();
            //console.log("Component mounted "+this.$route.params.id)
        },
        methods: {
            loadPaginatedData: function () {
                axios.get('/admin/brandboost/reviews/' + this.$route.params.id)
                    .then(response => {
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaigns = response.data.oCampaign;
                        this.allData = response.data.allData;
                        this.reviews = response.data.aReviews;
                        console.log(this.reviews);
                    });
            },
            showPaginationData: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            }
        }
    }
</script>
