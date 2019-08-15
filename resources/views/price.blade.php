@extends('layouts.front_template') 

@section('contents')
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            .switch input {display:none;}

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked + .slider {
                background-color: #2196F3;
            }

            input:focus + .slider {
                box-shadow: 0 0 1px #2196F3;
            }

            input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }
        </style>
        <section class="top_text price">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top_bar">
                            <div class="col-md-4"><p style="padding-left:45px;"><i class="fa fa-check"></i> Create Account</p></div>
                            <div class="col-md-4"><p><i class="fa fa-check"></i> Install Brand Boost On Your Web Site</p></div>
                            <div class="col-md-4 active"><p><i class="fa fa-check"></i>  Confirm My Account</p></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="alert-success" style="margin-bottom:10px;">
                        <?php echo Session::get('success_msg'); ?>
                    </div>
                    <div class="alert-danger" style="margin-bottom:10px;">
                        <?php echo Session::get('error_msg'); ?>
                    </div>

                    <div class="col-md-12">
                        <h1>Choose A Brand Boost Plan That Fits Your Business</h1>
                        <div class="switchtext">
        <!--                    <h3>Monthly</h3><label class="switch"><input type="checkbox" id="switch"><span class="slider round"></span></label> <h3>Annual (Save 25%)</h3>-->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php foreach ($membership_data as $key => $data) {
                        if ($data->type == 'membership' || $data->type == '') {
                            ?>
                            <div class="col-md-4">
                                <?php
                                if ($key == 1) {
                                    echo '<div class="pricebox_green"><h4>MOST POPULAR</h4>';
                                }
                                //pre($data); 
                                ?>
                                <div class="pricebox">
                                    <h1><?php echo $data->level_name; ?></h1>

                                    <h2  class="txt_blue monthly_fee">$<?php echo $data->price; ?> / Month</h2>
                                    <input type="hidden" name="plan_id" value="<?php echo $data->plan_id; ?>">

                                    <a class="btn-orange monthly_link" href="<?php echo base_url('checkout/buy/' . $data->plan_id); ?>"><span>&nbsp; &nbsp; Start For FREE</span></a>
                                    <ul>
                                        <li><?php echo number_format($data->sms_limit); ?> SMS invites included per month</li>
                                        <li>You can buy SMS packs at 100, 250, 500, 1,000 SMS packs (price to be determined for each pack size)</li>
                                        <li><?php echo number_format($data->email_limit); ?> Email Invites Included per month</li>
                                        <li>You can buy email packs at 100, 250, 500, and 1,000 email credits)</li>
                                        <li>Text reviews on web site (<?php echo number_format($data->text_review_limit); ?> displayed per month)</li>
                                        <li>Video reviews on web site (<?php echo number_format($data->video_review_limit); ?> displayed per month)</li>
                                        <li><?php echo $data->social_invite_sources; ?></li>
                                        <li>“add your own” allowed as well</li>
                                    </ul>
                                    <?php
                                    if ($key == 1) {
                                        echo '<div class="clearfix"></div></div>';
                                    }
                                    ?>
                                </div>
                            </div>
    <?php }
}
?>

                </div>
            </div>
        </section>

        <script type="text/javascript">

            $(document).ready(function () {

                $('#switch').change(function () {
                    // this will contain a reference to the checkbox   
                    if (this.checked) {
                        // the checkbox is now checked 
                        $('.yearly_fee').show();
                        $('.yearly_link').show();
                        $('.monthly_fee').hide();
                        $('.monthly_link').hide();
                    } else {
                        // the checkbox is now no longer checked
                        $('.monthly_fee').show();
                        $('.monthly_link').show();
                        $('.yearly_fee').hide();
                        $('.yearly_link').hide();
                    }
                });
            });
        </script>
        @endsection