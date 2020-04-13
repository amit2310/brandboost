<template>
    <div class="content" id="masterContainer">

        <!--******************Top Heading area **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Brand Settings</h3>
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li :class="[ seletedTab === 1 ? 'active' : '' ]"><a @click="seletedTab=1" data-toggle="tab" style="cursor:pointer; padding: 5px;">General&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 2 ? 'active' : '' ]"><a @click="seletedTab=2" data-toggle="tab" style="cursor:pointer; padding: 5px;"> Preferences&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 3 ? 'active' : '' ]"><a @click="seletedTab=3" data-toggle="tab" style="cursor:pointer; padding: 5px;">Subscription & Credits&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 4 ? 'active' : '' ]"><a @click="seletedTab=4" data-toggle="tab" style="cursor:pointer; padding: 5px;">Billing&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 5 ? 'active' : '' ]"><a @click="seletedTab=5" data-toggle="tab" style="cursor:pointer; padding: 5px;">Notifications&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 6 ? 'active' : '' ]"><a @click="seletedTab=6" data-toggle="tab" style="cursor:pointer; padding: 5px;">Import&nbsp;</a></li>&nbsp;&nbsp;
                            <li :class="[ seletedTab === 7 ? 'active' : '' ]"><a @click="seletedTab=7" data-toggle="tab" style="cursor:pointer;">Export</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--****************** Content Area **********************-->
        <SettingGeneral v-if="(seletedTab === '' || seletedTab === 1)"></SettingGeneral>
        <SettingPreferences v-if="(seletedTab == 2)"></SettingPreferences>

    </div>
</template>

<script>
    import SettingGeneral from '@/components/admin/settings/tabs/General';
    import SettingPreferences from '@/components/admin/settings/tabs/SettingPreferences';
    export default {
        components: {SettingGeneral,SettingPreferences},
        title: 'Admin Settings - Brand Boost',
        name: "Settings",
        data() {
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                seletedTab: 1,
                settingsData: '',
                notificationData: '',
                oImportHistory: '',
                oExportHistory: '',
                oMemberships: '',
                oCurrentPlanData: '',
                oCurrentTopupPlanData: '',
                oInvoices: '',
                notificationlisting: '',
                oUser: '',
                countries: ''
            }
        },
    }
</script>

<style scoped>

</style>
