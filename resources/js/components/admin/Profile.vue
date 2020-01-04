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
                        <h3 class="htxt_medium_24 dark_700">Account Settings</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        &nbsp;
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div class="content-area">

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading">
                            <h6 class="panel-title">Account Info</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0">

                            <!--====LOGO SETTINGS====-->
                            <form method="POST" name="frmSubmit" id="frmSubmit" action="#"  enctype="multipart/form-data">
                                <div class="bbot p30 profile_photo_settings">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Avatar</p></div>
                                        <div class="col-md-2 brig">
                                            <img v-if="aUInfo.avatar !== ''" class="avatar userAvatar" :src="'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'+aUInfo.avatar"/>
                                            <img v-else class="avatar userAvatar" :src="'/profile_images/avatar_image.png'" />
                                        </div>
                                        <div class="col-md-6 col-md-offset-1">
                                            <div class="form-group mb0">
                                                <label class="control-label">Photo</label>
                                                <div class="input-group dropzone" id="myDropzone_avatar">
                                                    <span class="input-group-addon"><i class="icon-upload7"></i></span>
                                                    <div class=""></div>
                                                    <input style="display: none;" type="text" name="avatar" id="avatar" :value="aUInfo.avatar" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--====GENERAL SETTINGS====-->
                                <!--<div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">General Info</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Firstname</label>
                                                <div class="">
                                                    <input name="firstname" id="firstname" class="form-control" required="" type="text" placeholder="maxive" value="{{ (!empty($aUInfo->firstname)) ? $aUInfo->firstname : '' }}">
                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Lastname</label>
                                                <div class="">
                                                    <input name="lastname" id="lastname" class="form-control" required="" type="text" placeholder="maxive" value="{{ (!empty($aUInfo->lastname)) ? $aUInfo->lastname : '' }}">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label">Country</label>
                                                <div class="">
                                                    <select class="form-control"  name="country">
                                                        @if (!empty($countries))
                                                        @foreach ($countries as $country)
                                                        <option value="{{ $country->country_code }}" {{ ($country->country_code == $aUInfo->country) ? 'selected' : '' }}>
                                                            {{ $country->name }}
                                                        </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label w100">Phone number <span class="pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
                                                <label class="custom-form-switch pull-right">
                                                    <input class="field chk_change" name="phone_display" chkName="phone_display" value="{{ $phone_display }}" type="checkbox" {{ ($phone_display == 1) ? 'checked' : '' }}>
                                                    <span class="toggle"></span>
                                                </label>
                                            </span>
                                                </label>
                                                <div class="">
                                                    <input name="mobile" id="mobile" class="form-control" required="" type="text" placeholder="+3 8063 612 53 69" value="{{ (!empty($aUInfo->mobile)) ? $aUInfo->mobile : '' }}">
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label class="control-label w100">Website <span class="pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
                                                <label class="custom-form-switch pull-right">
                                                    <input class="field chk_change" name="website_display" chkName="website_display" value="{{ $website_display }}" type="checkbox" {{ ($website_display == 1) ? 'checked' : '' }}>
                                                    <span class="toggle"></span>
                                                </label>
                                            </span>
                                                </label>

                                                <div class="">
                                                    <input name="website" id="website" class="form-control"  type="text" placeholder="www.wakers.co" value="{{ (!empty($aUInfo->website)) ? $aUInfo->website : '' }}">
                                                </div>
                                            </div>

                                            <input type="hidden" name="userId" id="userId" value="{{ $userId }}">

                                            &lt;!&ndash;====SAVE====&ndash;&gt;

                                            <button type="submit" style="float: right;" class="btn dark_btn ml20 bkg_purple" >Save</span> </button>

                                        </div>

                                    </div>


                                </div>-->




                            </form>
                            <!--====SOCIAL SETTINGS====-->

                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>

        </div>

        <!--******************
          Content Area End
         **********************-->

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import PeopleListCreateSmartPopup from '@/components/helpers/PeopleListCreateSmartPopup';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Email Lists - Brand Boost',
        components: {UserAvatar, PeopleListCreateSmartPopup, Pagination},
        data() {
            return {
                form: {
                    title: '',
                    listDescription: '',
                    list_id: ''
                },
                formLabel: 'Create',
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                userDetail: '',
                onsiteList: '',
                offsiteList: '',
                getCampEmail: '',
                getCampSms: '',
                membershipData: '',
                emailFooterData: '',
                bbStatsData: '',
                aUInfo: '',
                aTeamInfo: ''
            }
        },
        mounted() {
            this.loadData();

            console.log('Component mounted')
        },
        methods: {
            loadData: function () {
                //getData
                axios.get('/admin/profile/')
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.aUInfo = response.data.userDetail;
                        this.onsiteList = response.data.onsiteList;
                        this.offsiteList = response.data.offsiteList;
                        this.getCampEmail = response.data.getCampEmail;
                        this.getCampSms = response.data.getCampSms;
                        this.membershipData = response.data.membershipData;
                        this.emailFooterData = response.data.emailFooterData;
                        this.bbStatsData = response.data.bbStatsData;
                        this.userData = response.data.userData;
                        this.aTeamInfo = response.data.aTeamInfo;
                        console.log(this.aUInfo);
                    });
            }
        }
    }


    $(document).ready(function () {

    });


</script>
