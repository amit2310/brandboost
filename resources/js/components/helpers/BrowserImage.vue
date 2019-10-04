<template>
    <i v-if="browser == 'Mozilla Firefox'"  class="icon-firefox txt_orange"></i>

    <i v-else-if="browser == 'Google Chrome'"  class="icon-chrome txt_red"></i>

    <i v-else-if="browser == 'Safari' || browser =='Apple Safari'"  class="icon-safari txt_dark"></i>

    <img v-else-if="browser == 'Opera'" src="/assets/images/opera.png" alt="Opera" title="Opera" width="30">

    <i v-else-if="browser == 'IE'"  class="fa fa-internet-explorer txt_blue_sky2"></i>

    <i v-else>{{browser}}</i>
</template>

<script>
    export default {
        name: 'browser-image',
        props: ['browser'],
        data(){
            return {
                //alert(this.avatar);
            }
        },
        mounted() {

        }
    }
</script>

<style>

</style>
