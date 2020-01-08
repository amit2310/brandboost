<template>

    <div class="content" id="masterContainer">

        <!--******************
        Top Heading area
        **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Tag Reviews</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-tag-group-slidebox">New Tag Group<span><img src="assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>

</template>

<script>

    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Insight Tags - Brand Boost',
        props: ['pageColor'],
        components: {Pagination},
        data() {
            return {
                form: {
                    txtGroupName: '',
                    description: ''
                },
                successMsg: '',
                errorMsg: '',
                loading: true,
                current_page: 1,
                oTagGroups: '',
                allData: ''
            }
        },
        mounted() {
            //this.loadPaginatedData();

            console.log('Component mounted.');
        },
        methods: {
        }
    }

    $(document).ready(function(){
        $(document).on('click', '.js-tag-group-slidebox', function () {
            $(".box").animate({
                width: "toggle"
            });
        });
    });


</script>

