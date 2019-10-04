<template>
    <i v-if="platform == 'linux'"  class="fa fa-linux txt_dark"></i>

    <i v-else-if="platform == 'windows'"  class="icon-windows txt_blue_sky2"></i>

    <i v-else-if="platform == 'mac'"  class="icon-apple2"></i>

    <i v-else>{{platform}}</i>
</template>

<script>
    export default {
        name: 'platform-image',
        props: ['platform'],
        data(){
            return {
                //alert(this.avatar);
            }
        },
        mounted() {

        }
    }
</script>


