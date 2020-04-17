<template>
    <div class="row">
        <div class="col-12">
            <div class="card p35  mb10">
                <div class="row">
                    <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 br12 bkg_blue_400 light_000 d-block fsize16 fw500 rotate45"><i class="ri-price-tag-3-fill"></i></span></div>
                    <div class="col-9">
                        <h3 class="htxt_medium_16 dark_700 mb-2">Triger: Tag</h3>
                        <ul class="review_camapaign_list">
                            <li><span>Tag</span><strong><i class="ri-add-circle-fill green_400"></i> New Customer</strong></li>
                            <li><span>Contacts</span><strong>1,356</strong></li>
                        </ul>
                    </div>
                    <div class="col text-right">
                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card p35  mb10">
                <div class="row">
                    <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 br12 bkg_email_300 light_000 d-block fsize16 fw500"><i class="ri-mail-open-fill"></i></span></div>
                    <div class="col-9">
                        <h3 class="htxt_medium_16 dark_700 mb-2">Email: Sale campaign #1</h3>
                        <ul class="review_camapaign_list">
                            <li><span><figure><img src="assets/images/Create_Ema_preview.png"></figure></span><strong>
                                <strong>Max Iver  &nbsp; &nbsp;   iver.mdx@brandboost.com</strong><br>
                                <strong>Hello <strong class="reviews_400">[Fist name]</strong>, It was a pleasure doing business with you...</strong>
                                <a href="javascript:void(0);">Preview Template “Review Request Email”</a><br>
                                <a href="javascript:void(0);">Send test email</a>
                            </strong></li>
                        </ul>
                    </div>
                    <div class="col text-right">
                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card p35  mb10">
                <div class="row">
                    <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 br12 bkg_email_300 light_000 d-block fsize16 fw500"><i class="ri-mail-open-fill"></i></span></div>
                    <div class="col-9">
                        <h3 class="htxt_medium_16 dark_700 mb-2">Email: Thank you campaign</h3>
                        <ul class="review_camapaign_list">
                            <li><span><figure><img src="assets/images/Create_Ema_preview.png"></figure></span><strong>
                                <strong>Max Iver  &nbsp; &nbsp;   iver.mdx@brandboost.com</strong><br>
                                <strong>Hello <strong class="reviews_400">[Fist name]</strong>, It was a pleasure doing business with you...</strong>
                                <a href="javascript:void(0);">Preview Template “Review Request Email”</a><br>
                                <a href="javascript:void(0);">Send test email</a>
                            </strong></li>
                        </ul>
                    </div>
                    <div class="col text-right">
                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt20 mb30">
            <div class="col-12">
                <div class="p0 text-center">
                    <div class="workflow_switch_div_small mb20" style="z-index:9">
                        <a class="workflow_switch" href="javascript:void(0);"><i class="ri-git-merge-fill"></i> SPLIT </a>
                        <a class="workflow_switch active" href="javascript:void(0);">50/50</a>
                    </div>
                    <button class="circle-icon-32 bkg_light_000 blue_200 shadow4" style="z-index:9; position:relative">A</button>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card p35  mb10">
                <div class="row">
                    <div style="max-width: 64px" class="col mt-1"><span class="circle-icon-36 last br12 bkg_sms_400 light_000 d-block fsize16 fw500"><i class="ri-message-3-line"></i></span></div>
                    <div class="col-9">
                        <h3 class="htxt_medium_16 dark_700 mb-2">SMS: Greeting</h3>
                        <ul class="review_camapaign_list">
                            <li>
    						<span class="smsbox" style="margin-bottom:30px;">
    							<div class="row mb-1">
    								<div class="col"><p class="m-0 fsize8 light_700"><img src="assets/images/message_icon_green.svg" width="10"> &nbsp; MESSAGES</p></div>
    								<div class="col text-right"><p class="m-0 fsize8 light_700">now</p></div>
    							</div>
    							<p class="fsize9 fw500 dark_900 mb-1">Makers</p>
    							<p class="fsize9 fw300 dark_900 m-0">Hello Julia, It was a pleasure doing business with you. Thank you for giving us a try. You can click this link to leave your review...</p>
    						</span>

                                <strong><strong>Max Iver  &nbsp; &nbsp;   iver.mdx@brandboost.com</strong><br>
                                    Hello <strong class="reviews_400">[Fist name]</strong>, It was a pleasure doing business with you... <br>
                                    <a href="javascript:void(0);">Preview SMS Template “Review Request”</a><br>
                                    <a href="javascript:void(0);">Send test SMS</a>
                                </strong></li>
                        </ul>
                    </div>
                    <div class="col text-right">
                        <button class="btn border br35 dark_200 fsize13 fw500 p10 pl30 pr30 shadow-none">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['events', 'unitInfo'],
        data(){
            return {
                viewType: 'list'
            }
        },
        methods: {

        }
    }
</script>




