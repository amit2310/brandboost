<div class="tab-pane <?php if($seletedTab=='prefer'):?>active<?php endif;?>" id="right-icon-tab1">
    <div class="row"> 
        <div class="col-md-6">
            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">General Preferences</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <form id="frmGeneralBusinessInfo3" name="frmGeneralBusinessInfo3" method="post">
                <div class="panel-body p0">


                    <!--====GENERAL SETTINGS====-->
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3"><p class="text-muted">General</p></div>
                            <div class="col-md-9">


                                <div class="form-group">
                                    <label class="control-label">Language</label>
                                    <div class="">
                                        <select name="language" class="form-control">
                                            <option value="english" <?php if ($oUser->language == 'english'): ?>selected="selected"<?php endif; ?> >English</option>
											<!-- 
                                            <option value="spanish" <?php if ($oUser->language == 'spanish'): ?>selected="selected"<?php endif; ?>>Spanish</option>
                                            <option value="russia" <?php if ($oUser->language == 'russia'): ?>selected="selected"<?php endif; ?>>Russian</option>
                                            <option value="french" <?php if ($oUser->language == 'french'): ?>selected="selected"<?php endif; ?>>French</option>
                                            <option value="arabic" <?php if ($oUser->language == 'arabic'): ?>selected="selected"<?php endif; ?>>Arabic</option>
                                            <option value="hindi" <?php if ($oUser->language == 'hindi'): ?>selected="selected"<?php endif; ?>>Hindi</option>
                                            <option value="portuguese" <?php if ($oUser->language == 'portuguese'): ?>selected="selected"<?php endif; ?>>Portuguese</option>
                                            <option value="chinese" <?php if ($oUser->language == 'chinese'): ?>selected="selected"<?php endif; ?>>Chinese</option>
											-->
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Main currency</label>
                                    <div class="">
                                        <select name="currency" class="form-control">
                                            <!-- <option>Please Select</option> -->
                                            <option value="USD" selected="selected">USD</option>
                                        </select>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
                    <!--====GENERAL SETTINGS====-->
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3"><p class="text-muted">Date & time</p></div>
                            <div class="col-md-9">


                                <div class="form-group">
                                    <label class="control-label">Time zone</label>
                                    <div class="">
                                        <select name="timezone" class="form-control">
                                            <option timeZoneId="1" gmtAdjustment="GMT-12:00" useDaylightTime="0" value="1" <?php if ($oUser->timezone == '1'): ?>selected="selected"<?php endif; ?>>(GMT-12:00) International Date Line West</option>
                                            <option timeZoneId="2" gmtAdjustment="GMT-11:00" useDaylightTime="0" value="2" <?php if ($oUser->timezone == '2'): ?>selected="selected"<?php endif; ?>>(GMT-11:00) Midway Island, Samoa</option>
                                            <option timeZoneId="3" gmtAdjustment="GMT-10:00" useDaylightTime="0" value="3" <?php if ($oUser->timezone == '3'): ?>selected="selected"<?php endif; ?>>(GMT-10:00) Hawaii</option>
                                            <option timeZoneId="4" gmtAdjustment="GMT-09:00" useDaylightTime="1" value="4" <?php if ($oUser->timezone == '4'): ?>selected="selected"<?php endif; ?>>(GMT-09:00) Alaska</option>
                                            <option timeZoneId="5" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="5" <?php if ($oUser->timezone == '5'): ?>selected="selected"<?php endif; ?>>(GMT-08:00) Pacific Time (US & Canada)</option>
                                            <option timeZoneId="6" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="6" <?php if ($oUser->timezone == '6'): ?>selected="selected"<?php endif; ?>>(GMT-08:00) Tijuana, Baja California</option>
                                            <option timeZoneId="7" gmtAdjustment="GMT-07:00" useDaylightTime="0" value="7" <?php if ($oUser->timezone == '7'): ?>selected="selected"<?php endif; ?>>(GMT-07:00) Arizona</option>
                                            <option timeZoneId="8" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="8" <?php if ($oUser->timezone == '8'): ?>selected="selected"<?php endif; ?>>(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                            <option timeZoneId="9" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="9" <?php if ($oUser->timezone == '9'): ?>selected="selected"<?php endif; ?>>(GMT-07:00) Mountain Time (US & Canada)</option>
                                            <option timeZoneId="10" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="10" <?php if ($oUser->timezone == '10'): ?>selected="selected"<?php endif; ?>>(GMT-06:00) Central America</option>
                                            <option timeZoneId="11" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="11" <?php if ($oUser->timezone == '11'): ?>selected="selected"<?php endif; ?>>(GMT-06:00) Central Time (US & Canada)</option>
                                            <option timeZoneId="12" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="12" <?php if ($oUser->timezone == '12'): ?>selected="selected"<?php endif; ?>>(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                            <option timeZoneId="13" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="13" <?php if ($oUser->timezone == '13'): ?>selected="selected"<?php endif; ?>>(GMT-06:00) Saskatchewan</option>
                                            <option timeZoneId="14" gmtAdjustment="GMT-05:00" useDaylightTime="0" value="14" <?php if ($oUser->timezone == '14'): ?>selected="selected"<?php endif; ?>>(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                            <option timeZoneId="15" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="15" <?php if ($oUser->timezone == '15'): ?>selected="selected"<?php endif; ?>>(GMT-05:00) Eastern Time (US & Canada)</option>
                                            <option timeZoneId="16" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="16" <?php if ($oUser->timezone == '16'): ?>selected="selected"<?php endif; ?>>(GMT-05:00) Indiana (East)</option>
                                            <option timeZoneId="17" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="17" <?php if ($oUser->timezone == '17'): ?>selected="selected"<?php endif; ?>>(GMT-04:00) Atlantic Time (Canada)</option>
                                            <option timeZoneId="18" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="18" <?php if ($oUser->timezone == '18'): ?>selected="selected"<?php endif; ?>>(GMT-04:00) Caracas, La Paz</option>
                                            <option timeZoneId="19" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="19" <?php if ($oUser->timezone == '19'): ?>selected="selected"<?php endif; ?>>(GMT-04:00) Manaus</option>
                                            <option timeZoneId="20" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="20" <?php if ($oUser->timezone == '20'): ?>selected="selected"<?php endif; ?>>(GMT-04:00) Santiago</option>
                                            <option timeZoneId="21" gmtAdjustment="GMT-03:30" useDaylightTime="1" value="21" <?php if ($oUser->timezone == '21'): ?>selected="selected"<?php endif; ?>>(GMT-03:30) Newfoundland</option>
                                            <option timeZoneId="22" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="22" <?php if ($oUser->timezone == '22'): ?>selected="selected"<?php endif; ?>>(GMT-03:00) Brasilia</option>
                                            <option timeZoneId="23" gmtAdjustment="GMT-03:00" useDaylightTime="0" value="23" <?php if ($oUser->timezone == '23'): ?>selected="selected"<?php endif; ?>>(GMT-03:00) Buenos Aires, Georgetown</option>
                                            <option timeZoneId="24" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="24" <?php if ($oUser->timezone == '24'): ?>selected="selected"<?php endif; ?>>(GMT-03:00) Greenland</option>
                                            <option timeZoneId="25" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="25" <?php if ($oUser->timezone == '25'): ?>selected="selected"<?php endif; ?>>(GMT-03:00) Montevideo</option>
                                            <option timeZoneId="26" gmtAdjustment="GMT-02:00" useDaylightTime="1" value="26" <?php if ($oUser->timezone == '26'): ?>selected="selected"<?php endif; ?>>(GMT-02:00) Mid-Atlantic</option>
                                            <option timeZoneId="27" gmtAdjustment="GMT-01:00" useDaylightTime="0" value="27" <?php if ($oUser->timezone == '27'): ?>selected="selected"<?php endif; ?>>(GMT-01:00) Cape Verde Is.</option>
                                            <option timeZoneId="28" gmtAdjustment="GMT-01:00" useDaylightTime="1" value="28" <?php if ($oUser->timezone == '28'): ?>selected="selected"<?php endif; ?>>(GMT-01:00) Azores</option>
                                            <option timeZoneId="29" gmtAdjustment="GMT+00:00" useDaylightTime="0" value="29" <?php if ($oUser->timezone == '29'): ?>selected="selected"<?php endif; ?>>(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                                            <option timeZoneId="30" gmtAdjustment="GMT+00:00" useDaylightTime="1" value="30" <?php if ($oUser->timezone == '30'): ?>selected="selected"<?php endif; ?>>(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                                            <option timeZoneId="31" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="31" <?php if ($oUser->timezone == '31'): ?>selected="selected"<?php endif; ?>>(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                            <option timeZoneId="32" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="32" <?php if ($oUser->timezone == '32'): ?>selected="selected"<?php endif; ?>>(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                            <option timeZoneId="33" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="33" <?php if ($oUser->timezone == '33'): ?>selected="selected"<?php endif; ?>>(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                            <option timeZoneId="34" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="34" <?php if ($oUser->timezone == '34'): ?>selected="selected"<?php endif; ?>>(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                            <option timeZoneId="35" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="35" <?php if ($oUser->timezone == '35'): ?>selected="selected"<?php endif; ?>>(GMT+01:00) West Central Africa</option>
                                            <option timeZoneId="36" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="36" <?php if ($oUser->timezone == '36'): ?>selected="selected"<?php endif; ?>>(GMT+02:00) Amman</option>
                                            <option timeZoneId="37" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="37" <?php if ($oUser->timezone == '37'): ?>selected="selected"<?php endif; ?>>(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                            <option timeZoneId="38" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="38" <?php if ($oUser->timezone == '38'): ?>selected="selected"<?php endif; ?>>(GMT+02:00) Beirut</option>
                                            <option timeZoneId="39" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="39" <?php if ($oUser->timezone == '39'): ?>selected="selected"<?php endif; ?>>(GMT+02:00) Cairo</option>
                                            <option timeZoneId="40" gmtAdjustment="GMT+02:00" useDaylightTime="0" value="40" <?php if ($oUser->timezone == '40'): ?>selected="selected"<?php endif; ?>>(GMT+02:00) Harare, Pretoria</option>
                                            <option timeZoneId="41" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="41" <?php if ($oUser->timezone == '41'): ?>selected="selected"<?php endif; ?>>(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                                            <option timeZoneId="42" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="42" <?php if ($oUser->timezone == '42'): ?>selected="selected"<?php endif; ?>>(GMT+02:00) Jerusalem</option>
                                            <option timeZoneId="43" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="43" <?php if ($oUser->timezone == '46'): ?>selected="selected"<?php endif; ?>>(GMT+02:00) Minsk</option>
                                            <option timeZoneId="44" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="44" <?php if ($oUser->timezone == '45'): ?>selected="selected"<?php endif; ?>>(GMT+02:00) Windhoek</option>
                                            <option timeZoneId="45" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="45" <?php if ($oUser->timezone == '46'): ?>selected="selected"<?php endif; ?>>(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                            <option timeZoneId="46" gmtAdjustment="GMT+03:00" useDaylightTime="1" value="46" <?php if ($oUser->timezone == '46'): ?>selected="selected"<?php endif; ?>>(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                            <option timeZoneId="47" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="47" <?php if ($oUser->timezone == '47'): ?>selected="selected"<?php endif; ?>>(GMT+03:00) Nairobi</option>
                                            <option timeZoneId="48" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="48" <?php if ($oUser->timezone == '48'): ?>selected="selected"<?php endif; ?>>(GMT+03:00) Tbilisi</option>
                                            <option timeZoneId="49" gmtAdjustment="GMT+03:30" useDaylightTime="1" value="49" <?php if ($oUser->timezone == '49'): ?>selected="selected"<?php endif; ?>>(GMT+03:30) Tehran</option>
                                            <option timeZoneId="50" gmtAdjustment="GMT+04:00" useDaylightTime="0" value="50" <?php if ($oUser->timezone == '50'): ?>selected="selected"<?php endif; ?>>(GMT+04:00) Abu Dhabi, Muscat</option>
                                            <option timeZoneId="51" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="51" <?php if ($oUser->timezone == '51'): ?>selected="selected"<?php endif; ?>>(GMT+04:00) Baku</option>
                                            <option timeZoneId="52" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="52" <?php if ($oUser->timezone == '52'): ?>selected="selected"<?php endif; ?>>(GMT+04:00) Yerevan</option>
                                            <option timeZoneId="53" gmtAdjustment="GMT+04:30" useDaylightTime="0" value="53" <?php if ($oUser->timezone == '53'): ?>selected="selected"<?php endif; ?>>(GMT+04:30) Kabul</option>
                                            <option timeZoneId="54" gmtAdjustment="GMT+05:00" useDaylightTime="1" value="54" <?php if ($oUser->timezone == '54'): ?>selected="selected"<?php endif; ?>>(GMT+05:00) Yekaterinburg</option>
                                            <option timeZoneId="55" gmtAdjustment="GMT+05:00" useDaylightTime="0" value="55" <?php if ($oUser->timezone == '55'): ?>selected="selected"<?php endif; ?>>(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                            <option timeZoneId="56" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="56" <?php if ($oUser->timezone == '56'): ?>selected="selected"<?php endif; ?>>(GMT+05:30) Sri Jayawardenapura</option>
                                            <option timeZoneId="57" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="57" <?php if ($oUser->timezone == '57'): ?>selected="selected"<?php endif; ?>>(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                            <option timeZoneId="58" gmtAdjustment="GMT+05:45" useDaylightTime="0" value="58" <?php if ($oUser->timezone == '58'): ?>selected="selected"<?php endif; ?>>(GMT+05:45) Kathmandu</option>
                                            <option timeZoneId="59" gmtAdjustment="GMT+06:00" useDaylightTime="1" value="59" <?php if ($oUser->timezone == '59'): ?>selected="selected"<?php endif; ?>>(GMT+06:00) Almaty, Novosibirsk</option>
                                            <option timeZoneId="60" gmtAdjustment="GMT+06:00" useDaylightTime="0" value="60" <?php if ($oUser->timezone == '60'): ?>selected="selected"<?php endif; ?>>(GMT+06:00) Astana, Dhaka</option>
                                            <option timeZoneId="61" gmtAdjustment="GMT+06:30" useDaylightTime="0" value="61" <?php if ($oUser->timezone == '61'): ?>selected="selected"<?php endif; ?>>(GMT+06:30) Yangon (Rangoon)</option>
                                            <option timeZoneId="62" gmtAdjustment="GMT+07:00" useDaylightTime="0" value="62" <?php if ($oUser->timezone == '62'): ?>selected="selected"<?php endif; ?>>(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                            <option timeZoneId="63" gmtAdjustment="GMT+07:00" useDaylightTime="1" value="63" <?php if ($oUser->timezone == '63'): ?>selected="selected"<?php endif; ?>>(GMT+07:00) Krasnoyarsk</option>
                                            <option timeZoneId="64" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="64" <?php if ($oUser->timezone == '64'): ?>selected="selected"<?php endif; ?>>(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                            <option timeZoneId="65" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="65" <?php if ($oUser->timezone == '65'): ?>selected="selected"<?php endif; ?>>(GMT+08:00) Kuala Lumpur, Singapore</option>
                                            <option timeZoneId="66" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="66" <?php if ($oUser->timezone == '66'): ?>selected="selected"<?php endif; ?>>(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                            <option timeZoneId="67" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="67" <?php if ($oUser->timezone == '67'): ?>selected="selected"<?php endif; ?>>(GMT+08:00) Perth</option>
                                            <option timeZoneId="68" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="68" <?php if ($oUser->timezone == '68'): ?>selected="selected"<?php endif; ?>>(GMT+08:00) Taipei</option>
                                            <option timeZoneId="69" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="69" <?php if ($oUser->timezone == '69'): ?>selected="selected"<?php endif; ?>>(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                            <option timeZoneId="70" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="70" <?php if ($oUser->timezone == '70'): ?>selected="selected"<?php endif; ?>>(GMT+09:00) Seoul</option>
                                            <option timeZoneId="71" gmtAdjustment="GMT+09:00" useDaylightTime="1" value="71" <?php if ($oUser->timezone == '71'): ?>selected="selected"<?php endif; ?>>(GMT+09:00) Yakutsk</option>
                                            <option timeZoneId="72" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="72" <?php if ($oUser->timezone == '72'): ?>selected="selected"<?php endif; ?>>(GMT+09:30) Adelaide</option>
                                            <option timeZoneId="73" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="73" <?php if ($oUser->timezone == '73'): ?>selected="selected"<?php endif; ?>>(GMT+09:30) Darwin</option>
                                            <option timeZoneId="74" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="74" <?php if ($oUser->timezone == '74'): ?>selected="selected"<?php endif; ?>>(GMT+10:00) Brisbane</option>
                                            <option timeZoneId="75" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="75" <?php if ($oUser->timezone == '75'): ?>selected="selected"<?php endif; ?>>(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                            <option timeZoneId="76" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="76" <?php if ($oUser->timezone == '76'): ?>selected="selected"<?php endif; ?>>(GMT+10:00) Hobart</option>
                                            <option timeZoneId="77" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="77" <?php if ($oUser->timezone == '77'): ?>selected="selected"<?php endif; ?>>(GMT+10:00) Guam, Port Moresby</option>
                                            <option timeZoneId="78" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="78" <?php if ($oUser->timezone == '78'): ?>selected="selected"<?php endif; ?>>(GMT+10:00) Vladivostok</option>
                                            <option timeZoneId="79" gmtAdjustment="GMT+11:00" useDaylightTime="1" value="79" <?php if ($oUser->timezone == '79'): ?>selected="selected"<?php endif; ?>>(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                            <option timeZoneId="80" gmtAdjustment="GMT+12:00" useDaylightTime="1" value="80" <?php if ($oUser->timezone == '80'): ?>selected="selected"<?php endif; ?>>(GMT+12:00) Auckland, Wellington</option>
                                            <option timeZoneId="81" gmtAdjustment="GMT+12:00" useDaylightTime="0" value="81" <?php if ($oUser->timezone == '81'): ?>selected="selected"<?php endif; ?>>(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                            <option timeZoneId="82" gmtAdjustment="GMT+13:00" useDaylightTime="0" value="82" <?php if ($oUser->timezone == '82'): ?>selected="selected"<?php endif; ?>>(GMT+13:00) Nuku'alofa</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Date format</label>
                                    <div class="">
                                        <select name="date_format" class="form-control">
                                            <option>Select</option>
                                            <option value="Y-M-d" <?php if($oUser->date_format == 'Y-M-d'):?>selected="selected"<?php endif;?>>YYYY-MM-DD (<?php echo date("Y-M-d");?>)</option>
                                            <option value="d-M-Y" <?php if($oUser->date_format == 'd-M-Y'):?>selected="selected"<?php endif;?>>DD-MM-YYYY (<?php echo date("d-M-Y");?>)</option>
                                            <option value="M-d-Y" <?php if($oUser->date_format == 'M-d-Y'):?>selected="selected"<?php endif;?>>MM-DD-YYYY (<?php echo date("M-d-Y");?>)</option>
                                            <option value="M d,Y" <?php if($oUser->date_format == 'M d,Y'):?>selected="selected"<?php endif;?>>MM DD,YYYY (<?php echo date("M d,Y");?>)</option>
                                            <option value="d M,Y" <?php if($oUser->date_format == 'd M,Y'):?>selected="selected"<?php endif;?>>DD MM,YYYY (<?php echo date("d M,Y");?>)</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Time format</label>
                                    <div class="">
                                        <select name="time_format" class="form-control">
                                            <option>Select</option>
                                            <option value="h:i" <?php if($oUser->time_format == 'h:i'):?>selected="selected"<?php endif;?>>12H</option>
                                            <option value="H:i" <?php if($oUser->time_format == 'H:i'):?>selected="selected"<?php endif;?>>24H</option>
                                        </select>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>

                    <!--====GENERAL SETTINGS====-->
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3"><p class="text-muted">Working hours</p></div>
                            <div class="col-md-9">


                                <div class="form-group">
                                    <label class="control-label">Start of the week</label>
                                    <div class="">
                                        <select name="wh_start_week" class="form-control">
                                            <option value="">Select</option>
                                            <option value="monday" <?php if($oUser->wh_start_week == 'monday'):?>selected="selected"<?php endif;?>>Monday</option>
                                            <option value="tuesday" <?php if($oUser->wh_start_week == 'tuesday'):?>selected="selected"<?php endif;?>>Tuesday</option>
                                            <option value="wednesday" <?php if($oUser->wh_start_week == 'wednesday'):?>selected="selected"<?php endif;?>>Wednesday</option>
                                            <option value="thursday" <?php if($oUser->wh_start_week == 'thursday'):?>selected="selected"<?php endif;?>>Thursday</option>
                                            <option value="friday" <?php if($oUser->wh_start_week == 'friday'):?>selected="selected"<?php endif;?>>Friday</option>
                                            <option value="saturday" <?php if($oUser->wh_start_week == 'saturday'):?>selected="selected"<?php endif;?>>Saturday</option>
                                            <option value="sunday" <?php if($oUser->wh_start_week == 'sunday'):?>selected="selected"<?php endif;?>>Sunday</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Start of the working day</label>
                                    <div class="">
                                        <select name="wh_start_day" class="form-control" style="width:48%; float:left;">
                                            <option value="">Select Hours</option>
                                            <option value="7am" <?php if($oUser->wh_start_day == '7am'):?>selected="selected"<?php endif;?>>7 AM</option>
                                            <option value="8am" <?php if($oUser->wh_start_day == '8am'):?>selected="selected"<?php endif;?>>8 AM</option>
                                            <option value="9am" <?php if($oUser->wh_start_day == '9am'):?>selected="selected"<?php endif;?>>9 AM</option>
                                            <option value="10am" <?php if($oUser->wh_start_day == '10am'):?>selected="selected"<?php endif;?>>10 AM</option>
                                            <option value="11am" <?php if($oUser->wh_start_day == '11am'):?>selected="selected"<?php endif;?>>11 AM</option>
                                        </select>
                                    
										<select name="wh_start_day_minutes" class="form-control" style="width:48%; float:right;">
                                            <option value="">Select Minutes</option>
                                            <option value="00" <?php if($oUser->wh_start_day_minutes == '00'):?>selected="selected"<?php endif;?>>00</option>
                                            <option value="15" <?php if($oUser->wh_start_day_minutes == '15'):?>selected="selected"<?php endif;?>>15</option>
                                            <option value="30" <?php if($oUser->wh_start_day_minutes == '30'):?>selected="selected"<?php endif;?>>30</option>
                                            <option value="45" <?php if($oUser->wh_start_day_minutes == '45'):?>selected="selected"<?php endif;?>>45</option>
                                        </select>
                                    </div>
									<div class="clearfix"></div>
                                </div>
								
                                <div class="form-group">
                                    <label class="control-label">End of the working day</label>
                                    <div class="">
                                        <select name="wh_end_day" class="form-control" style="width:48%; float:left;">
                                            <option value="">Select Hours</option>
                                            <option value="4pm" <?php if($oUser->wh_end_day == '4pm'):?>selected="selected"<?php endif;?>>4 PM</option>
                                            <option value="5pm" <?php if($oUser->wh_end_day == '5pm'):?>selected="selected"<?php endif;?>>5 PM</option>
                                            <option value="6pm" <?php if($oUser->wh_end_day == '6pm'):?>selected="selected"<?php endif;?>>6 PM</option>
                                            <option value="7pm" <?php if($oUser->wh_end_day == '7pm'):?>selected="selected"<?php endif;?>>7 PM</option>
                                            <option value="8pm" <?php if($oUser->wh_end_day == '8pm'):?>selected="selected"<?php endif;?>>8 PM</option>
                                        </select>
										<select name="wh_end_day_minutes" class="form-control" style="width:48%; float:right;">
                                            <option value="">Select Minutes</option>
                                            <option value="00" <?php if($oUser->wh_end_day_minutes == '00'):?>selected="selected"<?php endif;?>>00</option>
                                            <option value="15" <?php if($oUser->wh_end_day_minutes == '15'):?>selected="selected"<?php endif;?>>15</option>
                                            <option value="30" <?php if($oUser->wh_end_day_minutes == '30'):?>selected="selected"<?php endif;?>>30</option>
                                            <option value="45" <?php if($oUser->wh_end_day_minutes == '45'):?>selected="selected"<?php endif;?>>45</option>
                                        </select>
                                    </div>
									<div class="clearfix"></div>
                                </div>




                            </div>
                        </div>
                    </div>

                    <!--====SAVE====-->
                    <div class="p30">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn dark_btn ml20 bkg_purple" >Save</span> </button>
                            </div>
                        </div>
                    </div>


                </div>
            </form>
            </div>

            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Fields</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <form id="frmGeneralBusinessInfo4" name="frmGeneralBusinessInfo4" method="post">
                <div class="panel-body p0">


                    <!--====GENERAL SETTINGS====-->
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3"><p class="text-muted">Fields settings</p></div>
                            <div class="col-md-9">


                                <div class="form-group">
                                    <label class="control-label">We call people who leave reviews</label>
                                    <div class="">
                                        <select name="reviewer_alias" class="form-control">
                                            <option value="">Select</option>
                                            <option value="customer" <?php if($oUser->reviewer_alias == 'customer'):?>selected="selected"<?php endif;?>>Customer</option>
                                            <option value="client" <?php if($oUser->reviewer_alias == 'client'):?>selected="selected"<?php endif;?>>Client</option>
                                            <option value="buyer" <?php if($oUser->reviewer_alias == 'buyer'):?>selected="selected"<?php endif;?>>Buyer</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">We call people who sell to us</label>
                                    <div class="">
                                        <select name="seller_alias" class="form-control">
                                            <option value="">Select</option>
                                            <option value="seller" <?php if($oUser->seller_alias == 'seller'):?>selected="selected"<?php endif;?>>Seller</option>
                                            <option value="partner" <?php if($oUser->seller_alias == 'partner'):?>selected="selected"<?php endif;?>>Partner</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">We call reviews</label>
                                    <div class="">
                                        <select name="review_alias" class="form-control">
                                            <option value="">Select</option>
                                            <option value="review" <?php if($oUser->review_alias == 'review'):?>selected="selected"<?php endif;?>>Reviews</option>
                                            <option value="feedback" <?php if($oUser->review_alias == 'feedback'):?>selected="selected"<?php endif;?>>Feedback</option>
                                            
                                        </select>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>


                    <!--====SAVE====-->
                    <div class="p30">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn dark_btn ml20 bkg_purple" >Save</span> </button>
                            </div>
                        </div>
                    </div>


                </div>
                </form>
            </div>

        </div>


        <div class="col-md-3">
            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Help Card</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body min_h405 p40 pt60 info_card text-center">
                    <div class="img_icon mb20"><img src="<?php echo base_url(); ?>assets/images/icon_cog.png" width="35"></div>
                    <p class="mb20"><strong>Learn more about how to<br> configurate your brand<br> account</strong></p>
                    <p class="mb20"><span>Being the savage's bowsman, that <br>is, the person who pulled.</span></p>
                    <a class="txt_purple" href="#">Learn More</a>
                </div>
            </div>
        </div>




    </div>
</div> 