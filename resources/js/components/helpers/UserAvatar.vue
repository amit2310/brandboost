<template>

    <span class="icons s32" v-if="avatar">
        <span class="icons s32">
            <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{avatar}"
                 onerror="this.src='/assets/images/default_avt.jpeg'"
                 class="img-circle" :class="(width == null || height == null) ? 'img-xs' : ''"
                 :style="`width: ${width}px!important; height: ${height}px; line-height: ${width}px; font-size: ${fontsize}px;`"
                 >

        </span>
    </span>

    <span class="icons s32" v-else>
        <span
            class="icons s32"
            :class="(firstname || lastname) ? 'fl_letters' : 'fl_letters_gray'"
            v-if="firstname || lastname"
            :style="`width: ${width}px!important; height: ${height}px; line-height: ${width}px; font-size: ${fontsize}px;`"
        >
            {{firstname}} {{lastname}}
        </span>

        <span
            class="icons s32"
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
