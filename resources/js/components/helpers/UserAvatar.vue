<template>
    <span class="table-img mr15" v-if="avatar">
        <img :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/${avatar}`"
             onerror="this.src='/assets/images/default_avt.jpeg'"
             class="rounded-circle" :class="(width == null || height == null) ? 'img-xs' : ''"
             :style="`width: ${width}px!important; height: ${height}px; line-height: ${width}px; font-size: ${fontsize}px;`"
        >
    </span>

    <span class="table-img mr15" v-else>
        <span
            class="fl_name"
            :class="(firstname || lastname) ? 'fl_letters' : 'fl_letters_gray'"
            v-if="firstname || lastname"
            :style="`width: ${width}px!important; height: ${height}px; line-height: ${width}px; font-size: ${fontsize}px;`"
        >
            {{(firstname) ? firstname.charAt(0).toUpperCase() : ''}}{{(lastname) ? lastname.charAt(0).toUpperCase() : ''}}
        </span>

        <span
            class="fl_name"
            :class="(firstname || lastname) ? 'fl_letters' : 'fl_letters_gray'"
            :style="`width: ${width}px!important; height: ${height}px; line-height: ${width}px; font-size: ${fontsize}px;`"
            v-else
        >NA</span>
    </span>


</template>

<script>

    export default {
        name: 'user-avatar',
        props: ['avatar','firstname', 'lastname', 'width', 'height', 'fontsize'],
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
