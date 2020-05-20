<template>
    <div class="content">
        <!--******************
                  Top Heading area
                 **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Brand Settings</h3>
                    </div>
                    <div class="col-md-6 text-right">
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--****************** Content area *********************-->
        <div class="content-area">
            <div class="container-fluid">
                <div class="table_head_action">


                    <div class="row">
                        <div class="col-md-12">
                            <ul class="table_filter">
                                <li><a href="#/settings/general" tyle="cursor:pointer; padding: 5px;">GENERAL</a></li>&nbsp;&nbsp;
                                <li><a class="active"  href="#/settings/preferences" style="cursor:pointer; padding: 5px;">PREFERENCES</a></li>&nbsp;&nbsp;
                                <li><a href="#/settings/subscription" style="cursor:pointer; padding: 5px;">SUBSCRIPTION & CREDITS</a></li>&nbsp;&nbsp;
                                <li><a href="#/settings/billing" style="cursor:pointer; padding: 5px;">BILLING</a></li>&nbsp;&nbsp;
                                <li><a href="#/settings/notification" style="cursor:pointer; padding: 5px;">NOTIFICATIONS</a></li>&nbsp;&nbsp;
                                <li><a href="#/settings/import" style="cursor:pointer; padding: 5px;">IMPORT</a></li>&nbsp;&nbsp;
                                <li><a href="#/settings/export" style="cursor:pointer;">EXPORT</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-flat review_ratings">
                            <div class="panel-heading" style="padding: 10px;">
                                <h4 class="panel-title">General Preferences</h4>
                            </div>
                            <!--                    <form id="frmGeneralBusinessInfo3" name="frmGeneralBusinessInfo3" method="post">-->
                            <div class="panel-body p0">
                                <!--====GENERAL SETTINGS====-->
                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">General</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Language</label>
                                                <div class="">
                                                    <select name="language" class="form-control" v-model="oUser.language">
                                                        <option value="english" :selected="oUser.language == 'english' ? 'selected' : ''" >English</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Main currency</label>
                                                <div class="">
                                                    <select name="currency" class="form-control" v-model="oUser.currency">
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
                                                    <select name="timezone" class="form-control" v-model="oUser.timezone">
                                                        <option timeZoneId="1" gmtAdjustment="GMT-12:00" useDaylightTime="0" value="1" :selected="oUser.timezone == '1' ? 'selected' : ''" >(GMT-12:00) International Date Line West</option>
                                                        <option timeZoneId="2" gmtAdjustment="GMT-11:00" useDaylightTime="0" value="2" :selected="oUser.timezone == '2' ? 'selected' : ''" >(GMT-11:00) Midway Island, Samoa</option>
                                                        <option timeZoneId="3" gmtAdjustment="GMT-10:00" useDaylightTime="0" value="3" :selected="oUser.timezone == '3' ? 'selected' : ''" >(GMT-10:00) Hawaii</option>
                                                        <option timeZoneId="4" gmtAdjustment="GMT-09:00" useDaylightTime="1" value="4" :selected="oUser.timezone == '4' ? 'selected' : ''" >(GMT-09:00) Alaska</option>
                                                        <option timeZoneId="5" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="5" :selected="oUser.timezone == '5' ? 'selected' : ''" >(GMT-08:00) Pacific Time (US & Canada)</option>
                                                        <option timeZoneId="6" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="6" :selected="oUser.timezone == '6' ? 'selected' : ''" >(GMT-08:00) Tijuana, Baja California</option>
                                                        <option timeZoneId="7" gmtAdjustment="GMT-07:00" useDaylightTime="0" value="7" :selected="oUser.timezone == '7' ? 'selected' : ''" >(GMT-07:00) Arizona</option>
                                                        <option timeZoneId="8" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="8" :selected="oUser.timezone == '8' ? 'selected' : ''" >(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                        <option timeZoneId="9" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="9" :selected="oUser.timezone == '9' ? 'selected' : ''" >(GMT-07:00) Mountain Time (US & Canada)</option>
                                                        <option timeZoneId="10" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="10" :selected="oUser.timezone == '10' ? 'selected' : ''" >(GMT-06:00) Central America</option>
                                                        <option timeZoneId="11" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="11" :selected="oUser.timezone == '11' ? 'selected' : ''" >(GMT-06:00) Central Time (US & Canada)</option>
                                                        <option timeZoneId="12" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="12" :selected="oUser.timezone == '12' ? 'selected' : ''" >(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                        <option timeZoneId="13" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="13" :selected="oUser.timezone == '13' ? 'selected' : ''" >(GMT-06:00) Saskatchewan</option>
                                                        <option timeZoneId="14" gmtAdjustment="GMT-05:00" useDaylightTime="0" value="14" :selected="oUser.timezone == '14' ? 'selected' : ''" >(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                                        <option timeZoneId="15" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="15" :selected="oUser.timezone == '15' ? 'selected' : ''" >(GMT-05:00) Eastern Time (US & Canada)</option>
                                                        <option timeZoneId="16" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="16" :selected="oUser.timezone == '16' ? 'selected' : ''" >(GMT-05:00) Indiana (East)</option>
                                                        <option timeZoneId="17" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="17" :selected="oUser.timezone == '17' ? 'selected' : ''" >(GMT-04:00) Atlantic Time (Canada)</option>
                                                        <option timeZoneId="18" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="18" :selected="oUser.timezone == '18' ? 'selected' : ''" >(GMT-04:00) Caracas, La Paz</option>
                                                        <option timeZoneId="19" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="19" :selected="oUser.timezone == '19' ? 'selected' : ''" >(GMT-04:00) Manaus</option>
                                                        <option timeZoneId="20" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="20" :selected="oUser.timezone == '20' ? 'selected' : ''" >(GMT-04:00) Santiago</option>
                                                        <option timeZoneId="21" gmtAdjustment="GMT-03:30" useDaylightTime="1" value="21" :selected="oUser.timezone == '21' ? 'selected' : ''" >(GMT-03:30) Newfoundland</option>
                                                        <option timeZoneId="22" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="22" :selected="oUser.timezone == '22' ? 'selected' : ''" >(GMT-03:00) Brasilia</option>
                                                        <option timeZoneId="23" gmtAdjustment="GMT-03:00" useDaylightTime="0" value="23" :selected="oUser.timezone == '23' ? 'selected' : ''" >(GMT-03:00) Buenos Aires, Georgetown</option>
                                                        <option timeZoneId="24" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="24" :selected="oUser.timezone == '24' ? 'selected' : ''" >(GMT-03:00) Greenland</option>
                                                        <option timeZoneId="25" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="25" :selected="oUser.timezone == '25' ? 'selected' : ''" >(GMT-03:00) Montevideo</option>
                                                        <option timeZoneId="26" gmtAdjustment="GMT-02:00" useDaylightTime="1" value="26" :selected="oUser.timezone == '26' ? 'selected' : ''" >(GMT-02:00) Mid-Atlantic</option>
                                                        <option timeZoneId="27" gmtAdjustment="GMT-01:00" useDaylightTime="0" value="27" :selected="oUser.timezone == '27' ? 'selected' : ''" >(GMT-01:00) Cape Verde Is.</option>
                                                        <option timeZoneId="28" gmtAdjustment="GMT-01:00" useDaylightTime="1" value="28" :selected="oUser.timezone == '28' ? 'selected' : ''" >(GMT-01:00) Azores</option>
                                                        <option timeZoneId="29" gmtAdjustment="GMT+00:00" useDaylightTime="0" value="29" :selected="oUser.timezone == '29' ? 'selected' : ''" >(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                                                        <option timeZoneId="30" gmtAdjustment="GMT+00:00" useDaylightTime="1" value="30" :selected="oUser.timezone == '30' ? 'selected' : ''" >(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                                                        <option timeZoneId="31" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="31" :selected="oUser.timezone == '31' ? 'selected' : ''" >(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                                        <option timeZoneId="32" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="32" :selected="oUser.timezone == '32' ? 'selected' : ''" >(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                                        <option timeZoneId="33" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="33" :selected="oUser.timezone == '33' ? 'selected' : ''" >(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                        <option timeZoneId="34" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="34" :selected="oUser.timezone == '34' ? 'selected' : ''" >(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                                        <option timeZoneId="35" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="35" :selected="oUser.timezone == '35' ? 'selected' : ''" >(GMT+01:00) West Central Africa</option>
                                                        <option timeZoneId="36" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="36" :selected="oUser.timezone == '36' ? 'selected' : ''" >(GMT+02:00) Amman</option>
                                                        <option timeZoneId="37" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="37" :selected="oUser.timezone == '37' ? 'selected' : ''" >(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                                        <option timeZoneId="38" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="38" :selected="oUser.timezone == '38' ? 'selected' : ''" >(GMT+02:00) Beirut</option>
                                                        <option timeZoneId="39" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="39" :selected="oUser.timezone == '39' ? 'selected' : ''" >(GMT+02:00) Cairo</option>
                                                        <option timeZoneId="40" gmtAdjustment="GMT+02:00" useDaylightTime="0" value="40" :selected="oUser.timezone == '40' ? 'selected' : ''" >(GMT+02:00) Harare, Pretoria</option>
                                                        <option timeZoneId="41" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="41" :selected="oUser.timezone == '41' ? 'selected' : ''" >(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                                                        <option timeZoneId="42" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="42" :selected="oUser.timezone == '42' ? 'selected' : ''" >(GMT+02:00) Jerusalem</option>
                                                        <option timeZoneId="43" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="43" :selected="oUser.timezone == '43' ? 'selected' : ''" >(GMT+02:00) Minsk</option>
                                                        <option timeZoneId="44" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="44" :selected="oUser.timezone == '44' ? 'selected' : ''" >(GMT+02:00) Windhoek</option>
                                                        <option timeZoneId="45" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="45" :selected="oUser.timezone == '45' ? 'selected' : ''" >(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                                        <option timeZoneId="46" gmtAdjustment="GMT+03:00" useDaylightTime="1" value="46" :selected="oUser.timezone == '46' ? 'selected' : ''" >(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                        <option timeZoneId="47" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="47" :selected="oUser.timezone == '47' ? 'selected' : ''" >(GMT+03:00) Nairobi</option>
                                                        <option timeZoneId="48" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="48" :selected="oUser.timezone == '48' ? 'selected' : ''" >(GMT+03:00) Tbilisi</option>
                                                        <option timeZoneId="49" gmtAdjustment="GMT+03:30" useDaylightTime="1" value="49" :selected="oUser.timezone == '49' ? 'selected' : ''" >(GMT+03:30) Tehran</option>
                                                        <option timeZoneId="50" gmtAdjustment="GMT+04:00" useDaylightTime="0" value="50" :selected="oUser.timezone == '50' ? 'selected' : ''" >(GMT+04:00) Abu Dhabi, Muscat</option>
                                                        <option timeZoneId="51" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="51" :selected="oUser.timezone == '51' ? 'selected' : ''" >(GMT+04:00) Baku</option>
                                                        <option timeZoneId="52" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="52" :selected="oUser.timezone == '52' ? 'selected' : ''" >(GMT+04:00) Yerevan</option>
                                                        <option timeZoneId="53" gmtAdjustment="GMT+04:30" useDaylightTime="0" value="53" :selected="oUser.timezone == '53' ? 'selected' : ''" >(GMT+04:30) Kabul</option>
                                                        <option timeZoneId="54" gmtAdjustment="GMT+05:00" useDaylightTime="1" value="54" :selected="oUser.timezone == '54' ? 'selected' : ''" >(GMT+05:00) Yekaterinburg</option>
                                                        <option timeZoneId="55" gmtAdjustment="GMT+05:00" useDaylightTime="0" value="55" :selected="oUser.timezone == '55' ? 'selected' : ''" >(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                                        <option timeZoneId="56" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="56" :selected="oUser.timezone == '56' ? 'selected' : ''" >(GMT+05:30) Sri Jayawardenapura</option>
                                                        <option timeZoneId="57" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="57" :selected="oUser.timezone == '57' ? 'selected' : ''" >(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                        <option timeZoneId="58" gmtAdjustment="GMT+05:45" useDaylightTime="0" value="58" :selected="oUser.timezone == '58' ? 'selected' : ''" >(GMT+05:45) Kathmandu</option>
                                                        <option timeZoneId="59" gmtAdjustment="GMT+06:00" useDaylightTime="1" value="59" :selected="oUser.timezone == '59' ? 'selected' : ''" >(GMT+06:00) Almaty, Novosibirsk</option>
                                                        <option timeZoneId="60" gmtAdjustment="GMT+06:00" useDaylightTime="0" value="60" :selected="oUser.timezone == '60' ? 'selected' : ''" >(GMT+06:00) Astana, Dhaka</option>
                                                        <option timeZoneId="61" gmtAdjustment="GMT+06:30" useDaylightTime="0" value="61" :selected="oUser.timezone == '61' ? 'selected' : ''" >(GMT+06:30) Yangon (Rangoon)</option>
                                                        <option timeZoneId="62" gmtAdjustment="GMT+07:00" useDaylightTime="0" value="62" :selected="oUser.timezone == '62' ? 'selected' : ''" >(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                                        <option timeZoneId="63" gmtAdjustment="GMT+07:00" useDaylightTime="1" value="63" :selected="oUser.timezone == '63' ? 'selected' : ''" >(GMT+07:00) Krasnoyarsk</option>
                                                        <option timeZoneId="64" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="64" :selected="oUser.timezone == '64' ? 'selected' : ''" >(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                        <option timeZoneId="65" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="65" :selected="oUser.timezone == '65' ? 'selected' : ''" >(GMT+08:00) Kuala Lumpur, Singapore</option>
                                                        <option timeZoneId="66" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="66" :selected="oUser.timezone == '66' ? 'selected' : ''" >(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                        <option timeZoneId="67" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="67" :selected="oUser.timezone == '67' ? 'selected' : ''" >(GMT+08:00) Perth</option>
                                                        <option timeZoneId="68" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="68" :selected="oUser.timezone == '68' ? 'selected' : ''" >(GMT+08:00) Taipei</option>
                                                        <option timeZoneId="69" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="69" :selected="oUser.timezone == '69' ? 'selected' : ''" >(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                        <option timeZoneId="70" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="70" :selected="oUser.timezone == '70' ? 'selected' : ''" >(GMT+09:00) Seoul</option>
                                                        <option timeZoneId="71" gmtAdjustment="GMT+09:00" useDaylightTime="1" value="71" :selected="oUser.timezone == '71' ? 'selected' : ''" >(GMT+09:00) Yakutsk</option>
                                                        <option timeZoneId="72" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="72" :selected="oUser.timezone == '72' ? 'selected' : ''" >(GMT+09:30) Adelaide</option>
                                                        <option timeZoneId="73" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="73" :selected="oUser.timezone == '73' ? 'selected' : ''" >(GMT+09:30) Darwin</option>
                                                        <option timeZoneId="74" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="74" :selected="oUser.timezone == '74' ? 'selected' : ''" >(GMT+10:00) Brisbane</option>
                                                        <option timeZoneId="75" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="75" :selected="oUser.timezone == '75' ? 'selected' : ''" >(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                                        <option timeZoneId="76" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="76" :selected="oUser.timezone == '76' ? 'selected' : ''" >(GMT+10:00) Hobart</option>
                                                        <option timeZoneId="77" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="77" :selected="oUser.timezone == '77' ? 'selected' : ''" >(GMT+10:00) Guam, Port Moresby</option>
                                                        <option timeZoneId="78" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="78" :selected="oUser.timezone == '78' ? 'selected' : ''" >(GMT+10:00) Vladivostok</option>
                                                        <option timeZoneId="79" gmtAdjustment="GMT+11:00" useDaylightTime="1" value="79" :selected="oUser.timezone == '79' ? 'selected' : ''" >(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                                        <option timeZoneId="80" gmtAdjustment="GMT+12:00" useDaylightTime="1" value="80" :selected="oUser.timezone == '80' ? 'selected' : ''" >(GMT+12:00) Auckland, Wellington</option>
                                                        <option timeZoneId="81" gmtAdjustment="GMT+12:00" useDaylightTime="0" value="81" :selected="oUser.timezone == '81' ? 'selected' : ''" >(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                                        <option timeZoneId="82" gmtAdjustment="GMT+13:00" useDaylightTime="0" value="82" :selected="oUser.timezone == '82' ? 'selected' : ''" >(GMT+13:00) Nuku'alofa</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Date format</label>
                                                <div class="">
                                                    <select name="date_format" class="form-control" v-model="oUser.date_format">
                                                        <option value="">Select</option>
                                                        <option value="Y-M-d" :selected="oUser.date_format == 'Y-M-d' ? 'selected' : ''" >YYYY-MM-DD</option>
                                                        <option value="d-M-Y" :selected="oUser.date_format == 'd-M-Y' ? 'selected' : ''" >DD-MM-YYYY</option>
                                                        <option value="M-d-Y" :selected="oUser.date_format == 'M-d-Y' ? 'selected' : ''" >MM-DD-YYYY</option>
                                                        <option value="M d,Y" :selected="oUser.date_format == 'M d,Y' ? 'selected' : ''" >MM DD,YYYY</option>
                                                        <option value="d M,Y" :selected="oUser.date_format == 'd M,Y' ? 'selected' : ''" >DD MM,YYYY</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Time format</label>
                                                <div class="">
                                                    <select name="time_format" class="form-control" v-model="oUser.time_format">
                                                        <option value="">Select</option>
                                                        <option value="h:i" :selected="oUser.time_format == 'h:i' ? 'selected' : ''" >12H</option>
                                                        <option value="H:i" :selected="oUser.time_format == 'H:i' ? 'selected' : ''" >24H</option>
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
                                                    <select name="wh_start_week" class="form-control" v-model="oUser.wh_start_week">
                                                        <option value="">Select</option>
                                                        <option value="monday" :selected="oUser.wh_start_week == 'monday' ?  'selected' : ''" >Monday</option>
                                                        <option value="tuesday" :selected="oUser.wh_start_week == 'tuesday' ?  'selected' : ''" >Tuesday</option>
                                                        <option value="wednesday" :selected="oUser.wh_start_week == 'wednesday' ? 'selected' : ''" >Wednesday</option>
                                                        <option value="thursday" :selected="oUser.wh_start_week == 'thursday' ?  'selected' : ''">Thursday</option>
                                                        <option value="friday" :selected="oUser.wh_start_week == 'friday' ?  'selected' : ''" >Friday</option>
                                                        <option value="saturday" :selected="oUser.wh_start_week == 'saturday' ?  'selected' : ''" >Saturday</option>
                                                        <option value="sunday" :selected="oUser.wh_start_week == 'sunday' ?  'selected' : ''" >Sunday</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Start of the working day</label>
                                                <div class="">
                                                    <select name="wh_start_day" class="form-control" style="width:48%; float:left;" v-model="oUser.wh_start_day">
                                                        <option value="">Select Hours</option>
                                                        <option value="7am" :selected="oUser.wh_start_day == '7am' ? 'selected' : ''" >7 AM</option>
                                                        <option value="8am" :selected="oUser.wh_start_day == '8am' ? 'selected' : ''" >8 AM</option>
                                                        <option value="9am" :selected="oUser.wh_start_day == '9am' ? 'selected' : ''" >9 AM</option>
                                                        <option value="10am" :selected="oUser.wh_start_day == '10am' ? 'selected' : ''" >10 AM</option>
                                                        <option value="11am" :selected="oUser.wh_start_day == '11am' ? 'selected' : ''" >11 AM</option>
                                                    </select>

                                                    <select name="wh_start_day_minutes" class="form-control" style="width:48%; float:right;" v-model="oUser.wh_start_day_minutes">
                                                        <option value="">Select Minutes</option>
                                                        <option value="00" :selected="oUser.wh_start_day_minutes == '00' ? 'selected' : ''" >00</option>
                                                        <option value="15" :selected="oUser.wh_start_day_minutes == '15' ? 'selected' : ''" >15</option>
                                                        <option value="30" :selected="oUser.wh_start_day_minutes == '30' ? 'selected' : ''" >30</option>
                                                        <option value="45" :selected="oUser.wh_start_day_minutes == '45' ? 'selected' : ''" >45</option>
                                                    </select>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">End of the working day</label>
                                                <div class="">
                                                    <select name="wh_end_day" class="form-control" style="width:48%; float:left;" v-model="oUser.wh_end_day">
                                                        <option value="">Select Hours</option>
                                                        <option value="4pm" :selected="oUser.wh_end_day == '4pm' ? 'selected' : ''" >4 PM</option>
                                                        <option value="5pm" :selected="oUser.wh_end_day == '5pm' ? 'selected' : ''" >5 PM</option>
                                                        <option value="6pm" :selected="oUser.wh_end_day == '6pm' ? 'selected' : ''" >6 PM</option>
                                                        <option value="7pm" :selected="oUser.wh_end_day == '7pm' ? 'selected' : ''" >7 PM</option>
                                                        <option value="8pm" :selected="oUser.wh_end_day == '8pm' ? 'selected' : ''" >8 PM</option>
                                                    </select>
                                                    <select name="wh_end_day_minutes" class="form-control" style="width:48%; float:right;" v-model="oUser.wh_end_day_minutes">
                                                        <option value="">Select Minutes</option>
                                                        <option value="00" :selected="oUser.wh_end_day_minutes == '00' ? 'selected' : ''" >00</option>
                                                        <option value="15" :selected="oUser.wh_end_day_minutes == '15' ? 'selected' : ''" >15</option>
                                                        <option value="30" :selected="oUser.wh_end_day_minutes == '30' ? 'selected' : ''" >30</option>
                                                        <option value="45" :selected="oUser.wh_end_day_minutes == '45' ? 'selected' : ''" >45</option>
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
                                            <button type="submit" class="btn dark_btn ml20 bkg_purple" @click="saveGeneralPreferences()"><span>Save</span> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                    </form>-->
                        </div>

                        <div class="panel panel-flat review_ratings pt25">
                            <div class="panel-heading" style="padding: 10px;">
                                <h4 class="panel-title">Fields</h4>
                            </div>
                            <!--                    <form id="frmGeneralBusinessInfo4" name="frmGeneralBusinessInfo4" method="post">-->
                            <div class="panel-body p0">
                                <!--====GENERAL SETTINGS====-->
                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Fields settings</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">We call people who leave reviews</label>
                                                <div class="">
                                                    <select name="reviewer_alias" class="form-control" v-model="oUser.reviewer_alias">
                                                        <option value="">Select</option>
                                                        <option value="customer" :selected="oUser.reviewer_alias == 'customer' ? 'selected' : ''" >Customer</option>
                                                        <option value="client" :selected="oUser.reviewer_alias == 'client' ? 'selected' : ''" >Client</option>
                                                        <option value="buyer" :selected="oUser.reviewer_alias == 'buyer' ? 'selected' : ''" >Buyer</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">We call people who sell to us</label>
                                                <div class="">
                                                    <select name="seller_alias" class="form-control" v-model="oUser.seller_alias">
                                                        <option value="">Select</option>
                                                        <option value="seller" :selected="oUser.seller_alias == 'seller' ? 'selected' : ''" >Seller</option>
                                                        <option value="partner" :selected="oUser.seller_alias == 'partner' ? 'selected' : ''" >Partner</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">We call reviews</label>
                                                <div class="">
                                                    <select name="review_alias" class="form-control" v-model="oUser.review_alias">
                                                        <option value="">Select</option>
                                                        <option value="review" :selected="oUser.review_alias == 'review' ? 'selected' : ''" >Reviews</option>
                                                        <option value="feedback" :selected="oUser.review_alias == 'feedback' ? 'selected' : ''" >Feedback</option>

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
                                            <input type="hidden" id="settingsUserId" :value="oUser.id" />
                                            <button type="submit" class="btn dark_btn ml20 bkg_purple" @click="saveFieldsSettings()"><span>Save</span> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                    </form>-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-flat review_ratings">
                            <div class="panel-heading" style="padding: 10px;">
                                <h4 class="panel-title">Help Card</h4>
                            </div>
                            <div class="panel-body min_h405 p40 pt60 info_card text-center">
                                <div class="img_icon mb20"><img src="/assets/images/icon_cog.png" width="35"></div>
                                <p class="mb20"><strong>Learn more about how to<br> configurate your brand<br> account</strong></p>
                                <p class="mb20"><span>Being the savage's bowsman, that <br>is, the person who pulled.</span></p>
                                <a class="txt_purple" href="#">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        title: 'Admin Settings - Brand Boost',
        name: "SettingPreferences",
        data() {
            return {



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
        mounted() {
            this.loadData();
            setTimeout(function(){
                loadJQCode();
            },2000);
        },
        methods: {
            loadData: function () {
                //getData
                this.showLoading(true);
                axios.get('/admin/settings',{
                          params: {
                            current_tab:'preferences'
                        }
                    })
                    .then(response => {
                        //console.log(response.data);
                        this.showLoading(false);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.settingsData = response.data.settingsData;
                        this.notificationData = response.data.notificationData;
                        this.oImportHistory = response.data.oImportHistory;
                        this.oExportHistory = response.data.oExportHistory;
                        this.oMemberships = response.data.oMemberships;
                        this.oCurrentPlanData = response.data.oCurrentPlanData;
                        this.oCurrentTopupPlanData = response.data.oCurrentTopupPlanData;
                        this.seletedTab = response.data.seletedTab;
                        this.oInvoices = response.data.oInvoices;
                        this.notificationlisting = response.data.notificationlisting;
                        this.oUser = response.data.oUser;
                        this.countries = response.data.countries;
                    });
            },
            saveGeneralPreferences: function () {
                this.showLoading(true);
                axios.post('/admin/settings/saveGeneralPreferences',{
                    language:this.oUser.language,
                    currency:this.oUser.currency,
                    timezone:this.oUser.timezone,
                    date_format:this.oUser.date_format,
                    time_format:this.oUser.time_format,
                    wh_start_week:this.oUser.wh_start_week,
                    wh_start_day:this.oUser.wh_start_day,
                    wh_start_day_minutes:this.oUser.wh_start_day_minutes,
                    wh_end_day:this.oUser.wh_end_day,
                    wh_end_day_minutes:this.oUser.wh_end_day_minutes,
                })
                    .then(response => {
                        //console.log(response.data);
                        this.showLoading(false);
                        this.loadData();
                    });
            },
            saveFieldsSettings: function () {
                this.showLoading(false);
                axios.post('/admin/settings/saveFieldsSettings',{
                    reviewer_alias:this.oUser.reviewer_alias,
                    seller_alias:this.oUser.seller_alias,
                    review_alias:this.oUser.review_alias,
                })
                    .then(response => {
                        this.showLoading(false);
                        this.loadData();
                    });
            },
        }
    }
    function loadJQCode(){
        $(document).ready(function () {
            $(".token-field").on('tokenfield:createdtoken tokenfield:removedtoken change', function (e) {
                if($(this).parent().children().hasClass('token')) {
                    $(this).parent().find('.token-input').attr('placeholder', '');
                }
                else {
                    $(this).parent().find('.token-input').attr('placeholder', '- Tokenfield');
                }
            }).trigger('change');

            $('.showSubPage').click(function(){
                $('.nav-tabs a[href="#right-icon-tab2"]').tab('show');
            });


            $('.changeBA1').click(function(){
                $('.changeBA1').removeClass('txt_purple');
                $(this).addClass('txt_purple');
            });

            $('.changeBA2').click(function(){
                $('.changeBA2').removeClass('txt_purple');
                $(this).addClass('txt_purple');
            });

            $('#public_publish_page').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="public_publish_page"]').attr("value", 1);
                } else {
                    $('input[name="public_publish_page"]').attr("value", 0);
                }
            });

            $('#business_address_dppa').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="business_address_dppa"]').attr("value", 1);
                } else {
                    $('input[name="business_address_dppa"]').attr("value", 0);
                }
            });

            $('#phone_no_dppa').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="phone_no_dppa"]').attr("value", 1);
                } else {
                    $('input[name="phone_no_dppa"]').attr("value", 0);
                }
            });

            $('#website_dppa').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="website_dppa"]').attr("value", 1);
                } else {
                    $('input[name="website_dppa"]').attr("value", 0);
                }
            });


            // Dropzone.autoDiscover = false;
            // var settingUserId = $("#settingsUserId").val();
            // var myDropzone = new Dropzone(
            //     '#myDropzone', //id of drop zone element 1
            //     {
            //         url: '/webchat/dropzone/upload_s3_attachment/'+settingUserId+'/onsite',
            //         uploadMultiple: false,
            //         maxFiles: 1,
            //         maxFilesize: 600,
            //         acceptedFiles: 'image/*',
            //         addRemoveLinks: false,
            //         success: function (response) {
            //
            //             if(response.xhr.responseText != "") {
            //
            //                 $('#brand_logo_image_preview').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
            //                 var dropImage = $('#company_logo').val();
            //                 $.ajax({
            //                     url: 'admin/brandboost/deleteObjectFromS3',
            //                     headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            //                     type: "POST",
            //                     data: {dropImage: dropImage},
            //                     dataType: "json",
            //                     success: function (data) {
            //                         console.log(data);
            //                     }
            //                 });
            //
            //                 $('#company_logo').val(response.xhr.responseText);
            //                 $('.saveUserOtherInfo').trigger('click');
            //             }
            //         }
            //     });

            // myDropzone.on("complete", function(file) {
            //     myDropzone.removeFile(file);
            // });
        });

    }
</script>
<style scoped>

</style>
