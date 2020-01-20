<template>

    <div class="content" id="masterContainer">

        <div class="row">
            <div class="col-md-12">
                <div class="white_box profile_sec mb20">
                    <div class="backbtn">
                        <a href="#/user/profile"><img
                            src="/assets/profile_images/back_40.png"></a>
                    </div>

                    <div class="p25 bbot text-center">
                        <h3>Help Desk</h3>
                        <p>Basic information that you use in BrandBoost services.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2">&nbsp;</div>
            <div class="col-md-8 col-sm-8 col-xs-8">
                <div class="row">
                    <div class="col-md-12 text-center" style="padding:50px;">
                        <h3>Coming soon.</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2">&nbsp;</div>
        </div>

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    export default {
        title: 'Help Desk - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {

            }
        },
        mounted() {

            console.log('Component mounted');
        }
    }

    $(document).ready(function () {

    });
</script>
