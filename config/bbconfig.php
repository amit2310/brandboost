<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Default Brandboost Config Variables
      |--------------------------------------------------------------------------
      |
      | Here you may specify the default Brandboost Config Variables that should be used
      | by the framework. 
      |
     */
    'website_name' => 'Brand Boost',
    'mailFrom' => 'sandgrid',
    'siteemail' => 'alen@brandboost.io',
    'sandgriduser' => 'umair.nethues',
    'sandgridpass' => 'net_2013',
    'api_url' => 'https://api.sendgrid.com/',
//Twilio Details
    'sid' => 'ACf98e572bd4b7e10cc1fc3637a2327f62',
    'token' => 'c2218be1576b478392545bfcae6f87be', // 'token' => '572a09ee4ba0b098443d920693b865e9', // OLD ONE
    'password_hash' => 'Umair',
    'siteSalt' => 'Rahul',
    'email_tags' => [
        '{FIRST_NAME}',
        '{LAST_NAME}',
        '{EMAIL}',
        '{WEBSITE}',
        '{BRAND_NAME}',
        '{PRODUCTS_LIST}',
        '{BRAND_LOGO}',
        '{PASSWORD}',
        '{FIVE_STARS_RATINGS}',
        '{FOUR_STARS_RATINGS}',
        '{TOP_STAR_RATINGS}',
        '{WRITE_REVIEW_FORM}',
        '{TEXT_REVIEW_URL}',
        '{VIDEO_REVIEW_URL}',
        '{UNSUBSCRIBE_LINK}',
        '{REVIEW_URL}',
        '{ONSITE_REVIEW_URL}',
        '{OFFSITE_REVIEW_URL}',
        '{ADVOCATE_REWARD}',
        '{FRIEND_REWARD}',
        '{REFERRAL_LINK}',
        '{STORE_NAME}',
        '{STORE_URL}',
        '{STORE_EMAIL}',
        '{BRANDNAME}',
        '{INTRODUCTION}',
        '{QUESTION}',
        '{SITEURL}',
        '{ACCOUNTHASHCODE}',
        '{GREETING}',
        '{SURVEYURL}'
    ],
//Chargebee API configuration
    'cb_site_name' => 'brandboost-test',
    'cb_access_token' => 'test_JGrHJV8LseuhqKEFvcumU9SAxQTrIXcdqI',
    'emailFooter' => '<div style="width:100%; border-top:4px solid #ddd; margin-top:20px; padding:20px; font-size:14px; color:#666;"><div><img src="http://brandboost.io/assets/images/logo_dark2.png" style="width:200px;" alt=""></div><div style="margin-top:20px;">You are receiving this email because you booked your trip on Orbitz. Orbitz will process the personal data collected from you in accordance with Orbitz’s privacy policy. To review this privacy policy, please contact Orbitz or visit Orbitz’s web site. Feefo will only use your personal data on behalf of Orbitz to help us obtain and manage your feedback. Your feedback will be published on the Feefo website, however you can choose to keep your name private. To contact Orbitz by mail please write to Customer Services, Orbitz, LLC, 500 W Madison Suite 1000, Chicago, IL 60661. <br><br>It is the policy of Feefo not to distribute any information for any reason that users have not specifically made public. If you do not want to receive any more emails from us, please click here.</div></div>',
    'sms_track_url' => 'http://brandboost.io/trck/trkTwilioMaster.php',
    'stripo_plugin_id' => '4ff115904d9040f69dbb275d25c72909',
    'stripo_secret_key' => '0bd43841b50c4571bc051f0b7d1448b4',
    'trans_secret_key' => 'bb17becab77a1b0949cd80b989a320a6',
// --- S3 amazon ---
//'access_key' => 'AKIAJ52XK7ZH7VCR7XHQ',
//'secret_key' => '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',
    'blank_subject' => 'Brandboost promotional message',
];
