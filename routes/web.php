<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/', 'Admin\Dashboard@index');

Route::get('admin/login', 'Admin\Login@index');
Route::post('admin/login', 'Admin\Login@index');
Route::get('admin/forgot_password', 'User\Login@forgot_password');
Route::post('admin/forgot_password', 'User\Login@forgot_password');
Route::get('admin/login/logout', 'Admin\Login@logout');


// User Section
Route::get('user/login', 'User\Login@index');
Route::post('user/login', 'User\Login@index');
Route::post('admin/profile/changePassword', 'Admin\Profile@changePassword');
Route::get('user/profile', 'User\Profile@Index');
Route::get('user/review', 'User\Review@Index');
Route::get('user/media', 'User\Media@Index');
Route::get('user/setting', 'User\Setting@Index');
Route::get('user/nps', 'User\Nps@Index');
Route::get('user/nps/reports/{npsId}', 'User\Nps@Reports');
Route::get('user/referral', 'User\Referral@Index');
Route::get('user/login/logout', 'User\Login@logout');
Route::get('user/review/edit/{commentId}', 'User\Review@Edit');
Route::post('user/setting/updateProfile', 'User\Setting@updateProfile');



Route::post('reviews/saveNewReview', 'Reviews@saveNewReview');
Route::post('reviews/submitOnsiteReview', 'Reviews@submitOnsiteReview');



Route::post('dropzone/upload_image', 'Dropzone@upload_image');

Route::post('reviews/deleteReviewNote', 'Reviews@deleteReviewNote');


Route::post('reviews/saveHelpful', 'Reviews@saveHelpful');
Route::post('reviews/displayReview/{id}', 'Reviews@displayReview');
Route::post('reviews/addcomment', 'Reviews@addComment');


Route::post('referrals/display_widget/{id1}/{id2}', 'Referrals@displayWidget');
Route::post('referrals/registerReferral', 'Referrals@registerReferral');
Route::post('referrals/recordSale', 'Referrals@recordSale');
Route::get('ref/t/{id}', 'Ref@t');


//Chat Module
Route::post('webchat/display_chat_widget/{widgetType}/{userAccountID}', 'Admin\WebChat@display_chat_widget');
Route::post('webchat/getUserMessages', 'Admin\WebChat@getUserMessages');
Route::post('webchat/addChatMsg', 'Admin\WebChat@addChatMsg');
Route::post('webchat/supportUser', 'Admin\WebChat@supportUser');
Route::post('webchat/getMessages', 'Admin\WebChat@getMessages');
Route::post('webchat/readChatMsg', 'Admin\WebChat@readChatMsg');
Route::post('webchat/readMessages', 'Admin\WebChat@readMessages');
Route::post('webchat/markRead', 'Admin\WebChat@markRead');




// Company
Route::post('company/saveHelpful', 'Company@saveHelpful');
Route::post('company/saveComment', 'Company@saveComment');



Route::post('webchat/settings/updateCompanyFormData', 'Admin\Settings@updateCompanyFormData');



//Payment
Route::post('payment/upgradeMembership', 'Payment@upgradeMembership');



//Dropzone Section
Route::post('dropzone/upload_editor_image', 'Dropzone@upload_editor_image');
Route::post('dropzone/upload_s3_attachment/{clientId?}/{folderName?}', 'Dropzone@upload_s3_attachment');
Route::post('webchat/dropzone/upload_profile_image', 'Dropzone@upload_profile_image');
Route::post('webchat/dropzone/upload_s3_attachment/{clientId}/{folderName}', 'Dropzone@upload_s3_attachment');
Route::post('webchat/dropzone/upload_s3_attachment_product_review/{clientId}/{folderName}/{orderVal?}', 'Dropzone@upload_s3_attachment_product_review');
Route::post('webchat/dropzone/edit_review_image', 'Dropzone@edit_review_image');
Route::post('webchat/dropzone/upload_s3_attachment_question_review/{clientId}/{folderName}', 'Dropzone@upload_s3_attachment_question_review');
Route::post('webchat/dropzone/upload_s3_attachment_review/{clientId}/{folderName}', 'Dropzone@upload_s3_attachment_review');
Route::post('dropzone/upload_s3_attachment_question_review/{clientId}/{folderName}', 'Dropzone@upload_s3_attachment_question_review');


Route::get('for/{brand}/{id}', 'Company@index');
Route::get('for/{brand}', 'Company@index');
Route::post('admin/questions/saveNewQuestion', 'Admin\Questions@saveNewQuestion');
Route::post('admin/brandboost/DeleteObjectFromS3', 'Admin\Brandboost@DeleteObjectFromS3');
Route::post('reviews/saveNewReview', 'Reviews@saveNewReview');
Route::get('reviews/addnew', 'Reviews@addnew');
Route::post('reviews/getReviewNoteById', 'Reviews@getReviewNoteById');
Route::get('r/{brandboostid?}/{websiteid?}', 'R@index');




//Front Website
Route::get('price', 'Price@index');
Route::get('checkout/buy/{plan_id}', 'Checkout@buy');
Route::post('payment/charging', 'Payment@charging');
Route::post('payment/cbCharge', 'Payment@cbCharge');
Route::post('admin/users/checkEmailExist', 'Admin\Users@checkEmailExist');
Route::get('thankyou', 'Thankyou@index');
Route::post('payment/upgradeTopupMembership', 'Payment@upgradeTopupMembership');
Route::post('payment/buyCreditAddons', 'Payment@buyCreditAddons');
Route::post('payment/storeCreditCard', 'Payment@storeCreditCard');


//Webhook URLs
Route::post('recurring/saveCBRecurring', 'Recurring@saveCBRecurring');
Route::get('recurring/saveCBRecurring', 'Recurring@saveCBRecurring');

//Mediagallery Front end Module
Route::post('mediagallery/index/{id}', 'Mediagallery@index');
Route::post('mediagallery/getReviewData', 'Mediagallery@getReviewData');


//Npm Front end Module
Route::post('nps/display_widget/{name}/{key}', 'Nps@display_widget');
Route::post('nps/recordSurvey', 'Nps@recordSurvey');
Route::get('nps/t/{refKey}', 'Nps@t');
Route::post('nps/saveFeedback', 'Nps@saveFeedback');

//Route::get('admin/dashboard','Admin\Dashboard@index');

Route::group(['middleware' => ['bb_authorize']], function () {

    Route::get('admin/dashboard', 'Admin\Dashboard@index');

    //Dashborad

    Route::post('admin/dashboard/getReviewData', 'Admin\Dashboard@getReviewData');
    Route::post('admin/utility/addContactToList', 'Admin\Utility@addContactToList');

//Email Modules
    Route::get('admin/modules/emails/overview', 'Admin\Modules\Emails@overview');
    Route::get('admin/modules/emails', 'Admin\Modules\Emails@index');
    Route::get('admin/modules/emails/setupAutomation/{id}', 'Admin\Modules\Emails@setupAutomation');
    Route::post('admin/modules/emails/publishAsDraft', 'Admin\Modules\Emails@publishAsDraft');
    Route::post('admin/modules/emails/publishAutomationEvent', 'Admin\Modules\Emails@publishAutomationEvent');
    Route::get('admin/modules/emails/sms', 'Admin\Modules\Emails@sms');
    Route::post('admin/modules/emails/addAutiomation', 'Admin\Modules\Emails@addAutiomation');
    Route::get('admin/modules/emails/automationStats/{id}', 'Admin\Modules\Emails@automationStats');
    Route::post('admin/modules/emails/getAutomation', 'Admin\Modules\Emails@getAutomation');
    Route::post('admin/modules/emails/updateAutomation', 'Admin\Modules\Emails@updateAutomation');
    Route::post('admin/modules/emails/changeAutomationStatus', 'Admin\Modules\Emails@changeAutomationStatus');
    Route::post('admin/modules/emails/deleteAutomation', 'Admin\Modules\Emails@deleteAutomation');
    Route::post('admin/modules/emails/multipalDeleteAutomation', 'Admin\Modules\Emails@multipalDeleteAutomation');
    Route::post('admin/modules/emails/multipalArchiveAutomation', 'Admin\Modules\Emails@multipalArchiveAutomation');


//Onsite and Offsite Modules
    Route::get('admin/brandboost/onsite_overview', 'Admin\Brandboost@onsiteOverview');
    Route::get('admin/brandboost/onsite', 'Admin\Brandboost@onsite');
    Route::get('admin/brandboost/review_request/{type}', 'Admin\Brandboost@reviewRequest');
    Route::get('admin/brandboost/campaignSetup/{id}', 'Admin\Brandboost@campaignSetup');
    Route::get('admin/brandboost/onsite_setup/{id}', 'Admin\Brandboost@onsiteSetup');
    Route::get('admin/brandboost/onsiteSetupSubscribers/{id}', 'Admin\Brandboost@onsiteSetupSubscribers');
    Route::get('admin/brandboost/onsiteSetupReview/{id}', 'Admin\Brandboost@onsiteSetupReview');
    Route::get('admin/brandboost/info', 'Admin\Brandboost@campaignInfo');
    Route::get('admin/brandboost/reviews', 'Admin\Brandboost@reviews');
    Route::get('admin/brandboost/reviews/{id}', 'Admin\Brandboost@reviews');
    Route::get('admin/brandboost/media', 'Admin\Brandboost@media');
    Route::post('admin/brandboost/reviewdetails/{id}', 'Admin\Brandboost@reviewDetails');
    Route::get('admin/brandboost/reviewdetails/{id}', 'Admin\Brandboost@reviewDetails');
    Route::get('admin/brandboost/reviewInfo/{id}', 'Admin\Brandboost@reviewInfo');
    Route::post('admin/brandboost/setTab/', 'Admin\Brandboost@setTab');
    Route::get('admin/brandboost/offsite_overview', 'Admin\Brandboost@offsiteOverview');
    Route::get('admin/brandboost/offsite', 'Admin\Brandboost@offsite');
    Route::post('admin/brandboost/updateOnsiteStatus/', 'Admin\Brandboost@updateOnsiteStatus');
    Route::post('admin/brandboost/getBBECode', 'Admin\Brandboost@getBBECode');
    Route::post('admin/brandboost/archive_multipal_brandboost', 'Admin\Brandboost@archiveMultipalBrandboost');
    Route::post('admin/brandboost/delete_brandboost', 'Admin\Brandboost@deleteBrandboost');
    Route::get('admin/brandboost/offsite_setup/{id}', 'Admin\Brandboost@offsiteSetup');
    Route::post('admin/brandboost/deleteObjectFromS3', 'Admin\Brandboost@deleteObjectFromS3');
    Route::get('admin/brandboost/widget_overview', 'Admin\Brandboost@widgetOverview');
    Route::get('admin/brandboost/widgets', 'Admin\Brandboost@widgets');
    Route::get('admin/brandboost/subscribers/{id}', 'Admin\Brandboost@subscribers');
    Route::post('admin/contacts/update_status', 'Admin\Contacts@update_status');
    Route::post('admin/contacts/delete_contact', 'Admin\Contacts@delete_contact');
    Route::post('admin/contacts/deleteBulkContacts', 'Admin\Contacts@deleteBulkContacts');
    Route::post('admin/brandboost/deleteWidgets', 'Admin\Brandboost@deleteWidgets');
    Route::get('admin/brandboost/export-review-request', 'Admin\Brandboost@exportReviewRequests');
    Route::get('admin/brandboost/export-onsite-campaigns', 'Admin\Brandboost@exportOnsiteCampaigns');
    /**
     * --------------------------------------------------------------------------
     *  Add component of widget onsite section.
     *  @Pavan
     * --------------------------------------------------------------------------
     */

    Route::get('admin/brandboost/get-widget', 'Admin\Brandboost@getWidget');
    Route::post('admin/brandboost/set-widget-type', 'Admin\Brandboost@setWidgetType');
    Route::get('admin/widgets/statistics-details', 'Admin\Brandboost@widgetStatisticDetails');
    Route::get('admin/widgets/statistics-details-stats-graph', 'Admin\Brandboost@widgetStatisticDetailsStatsGraph');
    /**
     * --------------------------------------------------------------------------
     *                                 End
     * --------------------------------------------------------------------------
     */
    /**
     * --------------------------------------------------------------------------
     *  Add component of widget onsite setup section.
     *  @Pavan
     * --------------------------------------------------------------------------
     */

    Route::get('/admin/brandboost/onsite-widget-setup/{id}', 'Admin\Brandboost@widgetOnsiteSetup');
    Route::get('/admin/brandboost/updateOnsiteWidgetStatus', 'Admin\Brandboost@updateOnsiteWidgetStatus');
    Route::post('/admin/brandboost/saveOnsiteWidgetSingleSettings', 'Admin\Brandboost@saveOnsiteWidgetSingleSettings');
    Route::post('/admin/brandboost/createBrandBoostWidgetTheme', 'Admin\Brandboost@createBrandBoostWidgetTheme');
    Route::get('/admin/brandboost/getWidgetThemeData/{themeId}', 'Admin\Brandboost@getWidgetThemeData');
    /**
     * --------------------------------------------------------------------------
     *                                 End
     * --------------------------------------------------------------------------
     */

    Route::post('admin/brandboost/switchTemplate', 'Admin\Brandboost@switchTemplate');
    Route::post('admin/brandboost/campaignPreferences', 'Admin\Brandboost@campaignPreferences');
    Route::post('admin/brandboost/add_offsite_edit', 'Admin\Brandboost@addOffsiteEdit');
    Route::post('admin/brandboost/add_offsite_resources', 'Admin\Brandboost@addOffsiteResources');
    Route::post('admin/brandboost/add_offsite_url', 'Admin\Brandboost@addOffsiteUrl');
    Route::post('admin/brandboost/continueStepOffsite', 'Admin\Brandboost@continueStepOffsite');
    Route::post('admin/brandboost/update_subscriber_status', 'Admin\Brandboost@updateSubscriberStatus');
    Route::post('admin/brandboost/deleteRRrecord', 'Admin\Brandboost@deleteRRrecord');
    Route::get('admin/brandboost/onsite_widget_setup/{id}', 'Admin\Brandboost@onsiteWidgetSetup');
    Route::post('admin/brandboost/setOnsiteWidget', 'Admin\Brandboost@setOnsiteWidget');
    Route::post('admin/brandboost/addBrandBoostWidgetData', 'Admin\Brandboost@addBrandBoostWidgetData');
    Route::post('admin/brandboost/savePreviewData', 'Admin\Brandboost@savePreviewData');
    Route::post('admin/brandboost/addBrandBoostWidgetDesign', 'Admin\Brandboost@addBrandBoostWidgetDesign');
    Route::post('admin/brandboost/getReviewCampaign', 'Admin\Brandboost@getReviewCampaign');
    Route::post('admin/brandboost/updateReviewCampaign', 'Admin\Brandboost@updateReviewCampaign');
    Route::post('admin/brandboost/addBrandBoostWidgetCampaign', 'Admin\Brandboost@addBrandBoostWidgetCampaign');
    Route::post('admin/brandboost/publishOnsiteStatusBB', 'Admin\Brandboost@publishOnsiteStatusBB');
    Route::post('admin/brandboost/saveOnsitePreferences', 'Admin\Brandboost@saveOnsitePreferences');
    Route::post('admin/brandboost/addOnsiteWidget', 'Admin\Brandboost@addOnsiteWidget');
    Route::post('admin/brandboost/delete_brandboost_widget', 'Admin\Brandboost@deleteBrandboostWidget');
    Route::post('admin/brandboost/getOnsiteWidgetEmbedCode', 'Admin\Brandboost@getOnsiteWidgetEmbedCode');
    Route::post('admin/brandboost/updateOnsiteWidgetStatus', 'Admin\Brandboost@updateOnsiteWidgetStatus');
    Route::post('admin/brandboost/archive_multipal_brandboost_widget', 'Admin\Brandboost@archiveMultipalBrandboostWidget');
    Route::post('admin/brandboost/delete_multipal_brandboost_widget', 'Admin\Brandboost@deleteMultipalBrandboostWidget');
    Route::post('admin/brandboost/addOnsite', 'Admin\Brandboost@addOnsite');
    Route::post('admin/brandboost/deleteProduct', 'Admin\Brandboost@deleteProduct');
    Route::post('admin/brandboost/addOffsite', 'Admin\Brandboost@addOffsite');
    Route::get('admin/brandboost/addreview/{id}', 'Admin\Brandboost@addReview');
    Route::get('admin/brandboost/addReview', 'Admin\Brandboost@addReview');
    Route::post('reviews/addManualReview', 'Reviews@addManualReview');
    Route::post('admin/brandboost/delete_multipal_brandboost', 'Admin\Brandboost@deleteMultipalBrandboost');
    Route::post('admin/brandboost/publishOnsiteWidget', 'Admin\Brandboost@publishOnsiteWidget');
    Route::post('admin/brandboost/deleteReviewRequest', 'Admin\Brandboost@deleteReviewRequest');
    Route::get('admin/brandboost/campaign_specific', 'Admin\Brandboost@campaignSpecific');
    Route::get('admin/brandboost/statistics/{bbid}', 'Admin\Brandboost@statistics');
    Route::post('admin/offsite/add_website', 'Admin\Offsite@add_website');
    Route::post('admin/brandboost/saveOnsiteSettings', 'Admin\Brandboost@saveOnsiteSettings');
    Route::post('admin/brandboost/changeStatus', 'Admin\Brandboost@changeStatus');
    Route::post('admin/brandboost/saveOnsiteConfiguration', 'Admin\Brandboost@saveOnsiteConfiguration');
    Route::post('admin/brandboost/addCampaignToOnsite', 'Admin\Brandboost@addCampaignToOnsite');
    Route::post('admin/brandboost/addOnsiteRequest', 'Admin\Brandboost@addOnsiteRequest');
    Route::post('admin/brandboost/getReviewRequest', 'Admin\Brandboost@getReviewRequest');
    Route::post('admin/brandboost/updateReviewRequest', 'Admin\Brandboost@updateReviewRequest');
    Route::post('admin/brandboost/previewRequest', 'Admin\Brandboost@previewRequest');
    Route::post('admin/brandboost/sendRequestTestMail', 'Admin\Brandboost@sendRequestTestMail');
    Route::post('admin/brandboost/sendManualReviewRequest', 'Admin\Brandboost@sendManualReviewRequest');
    Route::post('admin/brandboost/getManualRequests', 'Admin\Brandboost@getManualRequests');


    Route::get('admin/modules/referral/widgets', 'Admin\Modules\Referral@widgets');
    Route::get('admin/modules/nps/widgets', 'Admin\Modules\Nps@widgets');
	Route::get('admin/modules/nps/{id}', 'Admin\Modules\Nps@index');
    Route::get('admin/modules/referral/{id}', 'Admin\Modules\Referral@index');
    /**
     * --------------------------------------------------------------------------
     *  Add Route of widget chat section.
     *  @Pavan
     * --------------------------------------------------------------------------
     */
    Route::post('admin/modules/chat/addChat', 'Admin\Modules\Chat@addChat');
    Route::get('admin/modules/chat/setup/{id}', 'Admin\Modules\Chat@setup');
    Route::post('/admin/modules/chat/updateSingleField', 'Admin\Modules\Chat@updateSingleField');
    Route::post('/admin/modules/chat/updateChatWidgetInfo', 'Admin\Modules\Chat@updateChatWidgetInfo');
    Route::post('/admin/modules/chat/updateChatCustomize', 'Admin\Modules\Chat@updateChatCustomize');
    Route::post('admin/modules/chat/updateChatPreferences', 'Admin\Modules\Chat@updateChatPreferences');
    Route::post('admin/modules/chat/publishChatCampaign', 'Admin\Modules\Chat@publishChatCampaign');
    Route::post('admin/modules/chat/changeStatus', 'Admin\Modules\Chat@changeStatus');
    Route::post('admin/modules/chat/getChat', 'Admin\Modules\Chat@getChat');
    Route::post('admin/modules/chat/deleteChat', 'Admin\Modules\Chat@deleteChat');
    Route::post('admin/modules/chat/moveToArchiveChat', 'Admin\Modules\Chat@moveToArchiveChat');
    Route::post('admin/modules/chat/deleteChat', 'Admin\Modules\Chat@deleteChat');
    Route::post('admin/modules/chat/bulkDeleteChat', 'Admin\Modules\Chat@bulkDeleteChat');
    Route::post('admin/modules/chat/bulkArchiveChat', 'Admin\Modules\Chat@bulkArchiveChat');
    Route::post('admin/modules/chat/updateChat', 'Admin\Modules\Chat@updateChat');
    Route::post('admin/modules/chat/updateChatDesign', 'Admin\Modules\Chat@updateChatDesign') ;
    Route::get('admin/modules/chat', 'Admin\Modules\Chat@index');

    /**
     * --------------------------------------------------------------------------
     *  Add Route of widget chat section.
     *  @Pavan
     * --------------------------------------------------------------------------
     */
    Route::get('admin/modules/referral/widget/setup/{id}', 'Admin\Modules\Referral@widgetSetup');
    Route::post('admin/modules/referral/auto-save-referral-widget', 'Admin\Modules\Referral@autoSaveReferralWidget');
    Route::get('admin/modules/referral/overview', 'Admin\Modules\Referral@overview');
    Route::get('admin/modules/referral', 'Admin\Modules\Referral@index');
    Route::post('admin/modules/referral/changeStatus', 'Admin\Modules\Referral@changeStatus');
    Route::post('admin/modules/referral/moveToArchiveReferral', 'Admin\Modules\Referral@moveToArchiveReferral');
    Route::post('admin/modules/referral/deleteReferral', 'Admin\Modules\Referral@deleteReferral');
    Route::post('admin/modules/referral/addReferral', 'Admin\Modules\Referral@addReferral');
    Route::get('admin/modules/referral/setup/{id}', 'Admin\Modules\Referral@setup');
    Route::post('admin/modules/referral/updateSource', 'Admin\Modules\Referral@updateSource');
    Route::post('admin/modules/referral/getReferral', 'Admin\Modules\Referral@getReferral');
    Route::post('admin/modules/referral/updateReferral', 'Admin\Modules\Referral@updateReferral');
    Route::get('admin/modules/referral/reports/{id}', 'Admin\Modules\Referral@reports');
    Route::get('admin/modules/referral/stats/{id}', 'Admin\Modules\Referral@stats');
    Route::get('admin/modules/referral/reward/{id}', 'Admin\Modules\Referral@reward');
    Route::get('admin/modules/referral/advocates', 'Admin\Modules\Referral@advocates');
    Route::get('admin/modules/referral/advocates/{referralId}', 'Admin\Modules\Referral@advocates');
    Route::get('admin/modules/referral/advocateProfile/{referralId}', 'Admin\Modules\Referral@advocateProfile');
    Route::post('admin/modules/referral/advocateProfile/{referralId}', 'Admin\Modules\Referral@advocateProfile');
    Route::get('admin/modules/referral/workflow/{id}', 'Admin\Modules\Referral@workflow');
    Route::get('admin/modules/referral/integrations/{id}', 'Admin\Modules\Referral@integrations');
    Route::get('admin/modules/referral/configurations/{id}', 'Admin\Modules\Referral@configurations');
    Route::post('admin/modules/referral/saveSettings', 'Admin\Modules\Referral@saveSettings');
    Route::post('admin/modules/referral/publishReferralStatus', 'Admin\Modules\Referral@publishReferralStatus');
    Route::post('admin/modules/referral/saveRewards', 'Admin\Modules\Referral@saveRewards');
    Route::post('admin/modules/referral/saveCoupons', 'Admin\Modules\Referral@saveCoupons');
    Route::post('admin/modules/referral/updatReferralWidgetStatus', 'Admin\Modules\Referral@updatReferralWidgetStatus');
    Route::post('admin/modules/referral/delete_referral_widget', 'Admin\Modules\Referral@deleteReferralWidget');
    Route::post('admin/modules/referral/getReferralWidgetEmbedCode', 'Admin\Modules\Referral@getReferralWidgetEmbedCode');
    Route::get('admin/modules/referral/referral_widget_setup/{id}', 'Admin\Modules\Referral@referralWidgetSetup');
    Route::post('admin/modules/referral/addReferralWidgetApp', 'Admin\Modules\Referral@addReferralWidgetApp');
    Route::post('admin/modules/referral/publishReferralWidget', 'Admin\Modules\Referral@publishReferralWidget');
    Route::post('admin/modules/referral/addReferralWidget', 'Admin\Modules\Referral@addReferralWidget');
    Route::post('admin/modules/referral/deleteBulkReferralWidgets', 'Admin\Modules\Referral@deleteBulkReferralWidgets');
    Route::post('admin/modules/referral/archiveBulkReferralWidgets', 'Admin\Modules\Referral@archiveBulkReferralWidgets');



    Route::post('admin/reviews/updateReviewStatus', 'Admin\Reviews@updateReviewStatus');
    Route::post('admin/reviews/updateReviewCategory', 'Admin\Reviews@updateReviewCategory');
    Route::post('admin/reviews/deleteReview', 'Admin\Reviews@deleteReview');
    Route::post('admin/reviews/saveReviewNotes', 'Admin\Reviews@saveReviewNotes');
    Route::post('admin/reviews/getReviewMedia', 'Admin\Reviews@getReviewMedia');
    Route::post('admin/reviews/saveCommentLikeStatus', 'Admin\Reviews@saveCommentLikeStatus');
    Route::post('admin/reviews/update_review', 'Admin\Reviews@updateReview');
    Route::post('admin/comments/deleteComment', 'Admin\Comments@deleteComment');
    Route::post('admin/reviews/deleteReviewNote', 'Admin\Reviews@deleteReviewNote');
    Route::post('admin/comments/update_comment_status', 'Admin\Comments@update_comment_status');
    Route::post('admin/reviews/update_note', 'Admin\Reviews@update_note');
    Route::post('admin/reviews/deleteMultipalReview', 'Admin\Reviews@deleteMultipalReview');


    Route::post('admin/comments/add_comment', 'Admin\Comments@addComment');
    Route::post('admin/comments/getCommentById', 'Admin\Comments@getCommentById');
    Route::post('admin/comments/update_comment', 'Admin\Comments@update_comment');


    Route::get('admin/feedback/listall', 'Admin\Feedback@getAllListingData');
    Route::get('admin/feedback/listall/{id}', 'Admin\Feedback@getAllListingData');
    Route::get('admin/feedback/details/{id}', 'Admin\Feedback@feedbackDetails');
    Route::post('admin/feedback/details/{id}', 'Admin\Feedback@feedbackDetails');
    Route::post('admin/feedback/updateFeedbackStatus', 'Admin\Feedback@updateFeedbackStatus');
    Route::post('admin/feedback/updateFeedbackRatings', 'Admin\Feedback@updateFeedbackRatings');
    Route::post('admin/feedback/deleteMultipalFeedbackData', 'Admin\Feedback@deleteMultipalFeedbackData');
    Route::post('admin/feedback/addFeedbackcomment', 'Admin\Feedback@addFeedbackcomment');
    Route::post('admin/feedback/deleteFeedbackComment', 'Admin\Feedback@deleteFeedbackComment');




    Route::post('admin/tags/listAllTags', 'Admin\Tags@listAllTags');
    Route::post('admin/tags/applyQuestionTag', 'Admin\Tags@applyQuestionTag');
    Route::post('admin/tags/applyFeedbackTag', 'Admin\Tags@applyFeedbackTag');


    Route::get('admin/questions/view/{id}', 'Admin\Questions@questionView');
    Route::get('admin/questions/details/{id}', 'Admin\Questions@questionDetails');
    Route::post('admin/questions/details/{id}', 'Admin\Questions@questionDetails');
    Route::post('admin/questions/add_answer', 'Admin\Questions@add_answer');
    Route::post('admin/questions/update_answer_status', 'Admin\Questions@update_answer_status');
    Route::post('admin/questions/getAnswer', 'Admin\Questions@getAnswer');
    Route::post('admin/questions/updateAnswer', 'Admin\Questions@updateAnswer');
    Route::post('admin/questions/delete_answer', 'Admin\Questions@delete_answer');
    Route::get('admin/questions', 'Admin\Questions@index');
    Route::post('admin/questions/saveQuestionNotes', 'Admin\Questions@saveQuestionNotes');
    Route::post('admin/questions/getQuestionNotes', 'Admin\Questions@getQuestionNotes');
    Route::post('admin/questions/updateQuestionNote', 'Admin\Questions@updateQuestionNote');
    Route::post('admin/questions/deleteQuestionNote', 'Admin\Questions@deleteQuestionNote');
    Route::post('admin/questions/update_question_status', 'Admin\Questions@update_question_status');
    Route::post('admin/questions/deleteQuestion', 'Admin\Questions@delete_question');
    Route::post('admin/questions/deleteMultipalQuestion', 'Admin\Questions@deleteMultipalQuestion');
    Route::get('admin/questions/add', 'Admin\Questions@add');
    Route::post('admin/questions/saveManualQuestion', 'Admin\Questions@saveManualQuestion');



    Route::get('admin/mediagallery', 'Admin\Mediagallery@index');
    Route::post('admin/mediagallery/updateStatus', 'Admin\Mediagallery@updateStatus');
    Route::post('admin/mediagallery/deleteGallery', 'Admin\Mediagallery@deleteGallery');
    Route::post('admin/mediagallery/addList', 'Admin\Mediagallery@addList');
    Route::get('admin/mediagallery/setup/{id}', 'Admin\Mediagallery@setup');
    Route::post('admin/mediagallery/saveReviewsList', 'Admin\Mediagallery@saveReviewsList');
    Route::post('admin/mediagallery/updateWidgetType', 'Admin\Mediagallery@updateWidgetType');
    Route::post('admin/mediagallery/getReviewData', 'Admin\Mediagallery@getReviewData');
    Route::post('admin/mediagallery/updateGallery', 'Admin\Mediagallery@updateGallery');
    Route::post('admin/mediagallery/getGalleryImages', 'Admin\Mediagallery@getGalleryImages');
    Route::post('admin/mediagallery/getMediaInfo', 'Admin\Mediagallery@getMediaInfo');
    Route::post('admin/mediagallery/updateMediaWidget', 'Admin\Mediagallery@updateMediaWidget');
    Route::post('admin/mediagallery/updateSingleField', 'Admin\Mediagallery@updateSingleField');
    Route::post('admin/mediagallery/updateSingleFieldCompress', 'Admin\Mediagallery@updateSingleFieldCompress');
    //chat module
    Route::get('admin/webchat', 'Admin\WebChat@index');
    Route::post('admin/webchat/getUserinfo', 'Admin\WebChat@getUserinfo');
    Route::post('admin/webchat/listingNotes', 'Admin\WebChat@listingNotes');
    Route::post('admin/webchat/addWebNotes', 'Admin\WebChat@addWebNotes');
    Route::post('admin/webchat/changeLoginStatus', 'Admin\WebChat@changeLoginStatus');
    Route::post('admin/webchat/addChatMsg', 'Admin\WebChat@addChatMsg');
    Route::post('admin/webchat/updateSupportuser', 'Admin\WebChat@updateSupportuser');
    Route::post('admin/webchat/listAllTagsWebchat', 'Admin\WebChat@listAllTagsWebchat');
    Route::post('admin/webchat/applyWebTag', 'Admin\WebChat@applyWebTag');
    Route::post('admin/webchat/getWebTaglist', 'Admin\WebChat@getWebTaglist');
    Route::post('admin/webchat/deleteTagFromWeb', 'Admin\WebChat@deleteTagFromWeb');
    Route::post('admin/webchat/reassignChat', 'Admin\WebChat@reassignChat');
    Route::post('admin/webchat/showUntabAjax', 'Admin\WebChat@showUntabAjax');
    Route::post('admin/webchat/showYoutabAjax', 'Admin\WebChat@showYoutabAjax');
    Route::post('admin/webchat/showYoutabAjaxSmallbox', 'Admin\WebChat@showYoutabAjaxSmallbox');
    Route::post('admin/webchat/setChatboxstatus', 'Admin\WebChat@setChatboxstatus');
    Route::post('admin/webchat/removeBoxStatus', 'Admin\WebChat@removeBoxStatus');
    Route::post('admin/webchat/sortWebChatContactList', 'Admin\WebChat@sortWebChatContactList');
    Route::post('admin/webchat/listShortcuts', 'Admin\WebChat@listShortcuts');
    Route::post('admin/webchat/getUnreadMsgs', 'Admin\WebChat@getUnreadMsgs');
    Route::post('admin/webchat/sendEmail', 'Admin\WebChat@sendEmail');
    Route::post('admin/webchat/showEmailThread', 'Admin\WebChat@showEmailThread');
    Route::post('admin/webchat/getThreadInfo', 'Admin\WebChat@getThreadInfo');


//Setting
    Route::get('admin/settings', 'Admin\Settings@index');
    Route::post('admin/settings/saveGeneralInfo', 'Admin\Settings@saveUserSettings');
    Route::post('admin/settings/savePublicProfile', 'Admin\Settings@saveUserSettings');
    Route::post('admin/settings/saveGeneralPreferences', 'Admin\Settings@saveUserSettings');
    Route::post('admin/settings/saveFieldsSettings', 'Admin\Settings@saveUserSettings');
    Route::post('admin/settings/saveBillingInfo', 'Admin\Settings@saveUserSettings');



    Route::get('admin/settings/setup_system_notifications', 'Admin\Settings@setup_system_notifications');
    Route::post('admin/settings/getEmailNotificationContent', 'Admin\Settings@getEmailNotificationContent');
    Route::post('admin/settings/updateEmailNotificationContent', 'Admin\Settings@updateEmailNotificationContent');
    Route::post('admin/settings/updateSMSNotificationContent', 'Admin\Settings@updateSMSNotificationContent');
    Route::post('admin/settings/updateSystemNotificationContent', 'Admin\Settings@updateSystemNotificationContent');
//    Setting export
    Route::get('admin/brandboost/exportMedia', 'Admin\Brandboost@exportMedia');
    Route::get('admin/brandboost/exportReviews', 'Admin\Brandboost@exportReviews');
    Route::get('admin/tags/exportTags', 'Admin\Tags@exportTags');

    Route::post('admin/webchat/favouriteUser', 'Admin\WebChat@favouriteUser');
    Route::post('admin/webchat/smallwfilter', 'Admin\WebChat@smallwfilter');
    Route::post('admin/webchat/bigwfilter', 'Admin\WebChat@bigwfilter');
    Route::get('admin/chatshortcut', 'Admin\Chatshortcut@index');
    Route::post('admin/chatshortcut/addShortCut', 'Admin\Chatshortcut@addShortCut');
    Route::post('admin/chatshortcut/getChatShortcutById', 'Admin\Chatshortcut@getChatShortcutById');
    Route::post('admin/chatshortcut/updateShortCut', 'Admin\Chatshortcut@updateShortCut');
    Route::post('admin/chatshortcut/deleteChatShortcut', 'Admin\Chatshortcut@deleteChatShortcut');
    Route::post('admin/chatshortcut/deleteMultipalChatShortcut', 'Admin\Chatshortcut@deleteMultipalChatShortcut');
    Route::get('admin/chat/overview', 'Admin\WebChat@overview');




    Route::get('admin/smschat', 'Admin\SmsChat@index');
    Route::get('admin/smschat/getSubsinfo', 'Admin\SmsChat@getSubsinfo');
    Route::post('admin/smschat/showSmsThreads', 'Admin\SmsChat@showSmsThreads');
    Route::post('admin/smschat/listingNotes', 'Admin\SmsChat@listingNotes');
    Route::post('admin/smschat/sendMsg', 'Admin\SmsChat@sendMsg');
    Route::get('admin/smschat/livesearch', 'Admin\SmsChat@livesearch');
    Route::post('admin/smschat/getSearchSmsListByinput', 'Admin\SmsChat@getSearchSmsListByinput');
    Route::post('admin/smschat/add_contact_notes', 'Admin\SmsChat@add_contact_notes');
    Route::post('admin/smschat/addSmsNotes', 'Admin\SmsChat@addSmsNotes');
    Route::post('admin/smschat/listingSmsNotes', 'Admin\SmsChat@listingSmsNotes');
    Route::post('admin/smschat/shortcutListing', 'Admin\SmsChat@shortcutListing');
    Route::post('admin/smschat/small_shortcutListing', 'Admin\SmsChat@small_shortcutListing');
    Route::post('admin/smschat/small_shortcutListing_sms', 'Admin\SmsChat@small_shortcutListing_sms');
    Route::post('admin/smschat/sendMMS', 'Admin\SmsChat@sendMMS');
    Route::post('admin/smschat/addSMSFavourite', 'Admin\SmsChat@addSMSFavourite');
    Route::get('admin/smschat/SearchSBox', 'Admin\SmsChat@SearchSBox');


//Profile module
    Route::get('admin/profile', 'Admin\AccountSetting@index');
    Route::post('admin/profile/changeUsername', 'User\Setting@changeUsername');
    Route::post('admin/profile/changeUserphone', 'User\Setting@changeUserphone');
    Route::post('admin/account_setting/saveProfileDetail', 'Admin\AccountSetting@saveProfileDetail');
    Route::post('admin/profile/changePassword', 'Admin\AccountSetting@changePassword');
    Route::post('admin/account_setting/account_deleted', 'Admin\AccountSetting@account_deleted');
    Route::get('admin/accounts/usage', 'Admin\AccountSetting@usage');
    Route::post('admin/accounts/usageInfo', 'Admin\AccountSetting@usageInfo');

// Invoice
    Route::get('admin/invoices/view/{clientID}', 'Admin\Invoice@view');
    Route::get('admin/invoices/download_invoice/{invoiceID}', 'Admin\Invoice@download_invoice');
    Route::post('admin/invoices/get', 'Admin\Invoice@get');

// Notification
    Route::post('admin/notifications/getNotificationSmartPopup', 'Admin\Notification@getNotificationSmartPopup');
    Route::get('admin/notifications', 'Admin\Notification@Index');
    Route::post('admin/notifications/getNotificationFilterDate', 'Admin\Notification@getNotificationFilterDate');
    Route::post('admin/notifications/getNotificationData', 'Admin\Notification@getNotificationData');

    Route::post('admin/settings/updateCompanyProfile', 'Admin\Settings@updateCompanyProfile');
    Route::post('admin/settings/updateNotificationPermisson', 'Admin\Settings@updateNotificationPermisson');
    Route::post('admin/settings/updateNotificationSettings', 'Admin\Settings@updateNotificationSettings');
    Route::post('admin/settings/updateNotification', 'Admin\Settings@updateNotification');
    Route::post('admin/notifications/markRead', 'Admin\Notification@markRead');
    Route::post('admin/notifications/delete_multipal_notification', 'Admin\Notification@delete_multipal_notification');



// Membership
    Route::get('admin/membership', 'Membership@Index');

//Users module
    Route::post('admin/users/updateUserData', 'Admin\Users@updateUserData');

//Workfow
    Route::post('admin/workflow/updateEventTime', 'Admin\WorkFlow@updateEventTime');
    Route::post('admin/workflow/addWorkflowEventToTree', 'Admin\WorkFlow@addWorkflowEventToTree');
    Route::post('admin/workflow/addWorkflowEventToTreeNew', 'Admin\WorkFlow@addWorkflowEventToTreeNew');
    Route::post('admin/workflow/addWorkflowNode', 'Admin\WorkFlow@addWorkflowNode');
    Route::post('admin/workflow/connectWorkflowNode', 'Admin\WorkFlow@connectWorkflowNode');
    Route::get('admin/workflow/createEventNode', 'Admin\WorkFlow@createEventNode');
    Route::get('admin/workflow/createWorkflowEventNode', 'Admin\WorkFlow@createWorkflowEventNode');
    Route::post('admin/workflow/updateWorkflowCampaign', 'Admin\WorkFlow@updateWorkflowCampaign');
    Route::post('admin/workflow/updateWorkflowDecisionCampaign', 'Admin\WorkFlow@updateWorkflowDecisionCampaign');
    Route::post('admin/workflow/saveWorkflowDraft', 'Admin\WorkFlow@saveWorkflowDraft');
    Route::post('admin/workflow/savetoMyTemplates', 'Admin\WorkFlow@savetoMyTemplates');
    Route::post('admin/workflow/updateWorkflowDraft', 'Admin\WorkFlow@updateWorkflowDraft');
    Route::post('admin/workflow/updateWorkflowTemplate', 'Admin\WorkFlow@updateWorkflowTemplate');
    Route::post('admin/workflow/sendTestEmailworkflowCampaign', 'Admin\WorkFlow@sendTestEmailworkflowCampaign');
    Route::post('admin/workflow/sendTestEmailworkflowDecisionCampaign', 'Admin\WorkFlow@sendTestEmailworkflowDecisionCampaign');
    Route::post('admin/workflow/sendTestSMSworkflowCampaign', 'Admin\WorkFlow@sendTestSMSworkflowCampaign');
    Route::post('admin/workflow/sendTestSMSworkflowDecisionCampaign', 'Admin\WorkFlow@sendTestSMSworkflowDecisionCampaign');
    Route::post('admin/workflow/previewWorkflowCampaign', 'Admin\WorkFlow@previewWorkflowCampaign');
    Route::post('admin/workflow/previewWorkflowDecisionCampaign', 'Admin\WorkFlow@previewWorkflowDecisionCampaign');
    Route::post('admin/workflow/getWorkflowCampaign', 'Admin\WorkFlow@getWorkflowCampaign');
    Route::post('admin/workflow/getWorkflowTemplate', 'Admin\WorkFlow@getWorkflowTemplate');
    Route::post('admin/workflow/deleteWorkflowEvent', 'Admin\WorkFlow@deleteWorkflowEvent');
    Route::post('admin/workflow/deleteWorkflowDraft', 'Admin\WorkFlow@deleteWorkflowDraft');
    Route::get('admin/workflow/loadStripoCampaign/{module_name}/{campaign_id}/{module_unit_id?}', 'Admin\WorkFlow@loadStripoCampaign');
    Route::get('admin/workflow/loadDecisionStripoCampaign/{module_name}/{campaign_id}/{module_unit_id?}', 'Admin\WorkFlow@loadDecisionStripoCampaign');
    Route::get('admin/workflow/loadStripoSMSCampaign/{module_name}/{campaign_id}/{module_unit_id?}', 'Admin\WorkFlow@loadStripoSMSCampaign');
    Route::get('admin/workflow/loadDecisionStripoSMSCampaign/{module_name}/{campaign_id}/{module_unit_id?}', 'Admin\WorkFlow@loadDecisionStripoSMSCampaign');
    Route::get('admin/workflow/loadStripoTemplate', 'Admin\WorkFlow@loadStripoTemplate');
    Route::get('admin/workflow/loadStripoTemplatePreview', 'Admin\WorkFlow@loadStripoTemplatePreview');
    Route::post('admin/workflow/loadStripoTemplatePreview', 'Admin\WorkFlow@loadStripoTemplatePreview');
    Route::get('admin/workflow/loadStripoCampaignResources', 'Admin\WorkFlow@loadStripoCampaignResources');
    Route::get('admin/workflow/templates', 'Admin\WorkFlow@templates');
    Route::post('admin/workflow/addWorkflowTemplate', 'Admin\WorkFlow@addWorkflowTemplate');
    Route::post('admin/workflow/deleteWorkflowTemplate', 'Admin\WorkFlow@deleteWorkflowTemplate');
    Route::get('admin/workflow/getStripoBlankContent', 'Admin\WorkFlow@getStripoBlankContent');
    Route::get('admin/workflow/getReferralUnitInfo', 'Admin\WorkFlow@getReferralUnitInfo');
    Route::get('admin/workflow/referralEmailTagReplace', 'Admin\WorkFlow@referralEmailTagReplace');
    Route::get('admin/workflow/brandboostEmailTagReplace', 'Admin\WorkFlow@brandboostEmailTagReplace');
    Route::post('admin/workflow/loadWorkflowEmailStats', 'Admin\WorkFlow@loadWorkflowEmailStats');
    Route::post('admin/workflow/loadWorkflowSMSStats', 'Admin\WorkFlow@loadWorkflowSMSStats');
    Route::post('admin/workflow/loadWorkflowTree', 'Admin\WorkFlow@loadWorkflowTree');
    Route::post('admin/workflow/addContactToWorkflowCampaign', 'Admin\WorkFlow@addContactToWorkflowCampaign');
    Route::post('admin/workflow/addListToWorkflowCampaign', 'Admin\WorkFlow@addListToWorkflowCampaign');
    Route::post('admin/workflow/addSegmentToWorkflowCampaign', 'Admin\WorkFlow@addSegmentToWorkflowCampaign');
    Route::post('admin/workflow/addTagToWorkflowCampaign', 'Admin\WorkFlow@addTagToWorkflowCampaign');
    Route::post('admin/workflow/addContactToExcludeWorkflowCampaign', 'Admin\WorkFlow@addContactToExcludeWorkflowCampaign');
    Route::post('admin/workflow/updateAutomationListsExcludedRecord', 'Admin\WorkFlow@updateAutomationListsExcludedRecord');
    Route::post('admin/workflow/addExcludeSegmentToWorkflowCampaign', 'Admin\WorkFlow@addExcludeSegmentToWorkflowCampaign');
    Route::post('admin/workflow/addExcludedTagToWorkflowCampaign', 'Admin\WorkFlow@addExcludedTagToWorkflowCampaign');
    Route::post('admin/workflow/getWorkflowImportedProperties', 'Admin\WorkFlow@getWorkflowImportedProperties');
    Route::post('admin/workflow/getWorkflowExportedProperties', 'Admin\WorkFlow@getWorkflowExportedProperties');
    Route::post('admin/workflow/syncWorkflowAudience', 'Admin\WorkFlow@syncWorkflowAudience');
    Route::get('admin/workflow/addAudienceToWorkflowCampaign', 'Admin\WorkFlow@addAudienceToWorkflowCampaign');
    Route::get('admin/workflow/syncWorkflowAudienceGlobal', 'Admin\WorkFlow@syncWorkflowAudienceGlobal');
    Route::post('admin/workflow/syncWorkflowAudienceGlobal', 'Admin\WorkFlow@syncWorkflowAudienceGlobal');
    Route::get('admin/workflow/loadStripoTemplate/{type}/{id}', 'Admin\WorkFlow@loadStripoTemplate');
    Route::get('admin/workflow/loadStripoTemplateResources/{type}/{module_name}/{temp_id}', 'Admin\WorkFlow@loadStripoTemplateResources');
    Route::post('admin/workflow/loadWorkflowAudience', 'Admin\WorkFlow@loadWorkflowAudience');
    Route::post('admin/workflow/getWorkflowCampaignSubscribers', 'Admin\WorkFlow@getWorkflowCampaignSubscribers');


//Templates Module
    Route::get('admin/templates', 'Admin\Templates@index');
    Route::get('admin/templates/email', 'Admin\Templates@email');
    Route::get('admin/templates/sms', 'Admin\Templates@sms');
    Route::post('admin/templates/addUserTemplate', 'Admin\Templates@addUserTemplate');
    Route::get('admin/templates/editTemplate', 'Admin\Templates@editTemplate');
    Route::post('admin/templates/getTemplateInfo', 'Admin\Templates@getTemplateInfo');
    Route::post('admin/templates/editUserTemplate', 'Admin\Templates@editUserTemplate');
    Route::post('admin/templates/updateUserTemplate', 'Admin\Templates@updateUserTemplate');
    Route::post('admin/templates/updateUserTemplateName', 'Admin\Templates@updateUserTemplateName');
    Route::get('admin/templates/loadEmailTemplate/{id}', 'Admin\Templates@loadEmailTemplate');
    Route::get('admin/templates/loadSMSTemplate/{id}', 'Admin\Templates@loadSMSTemplate');
    Route::post('admin/templates/getCategorizedTemplates', 'Admin\Templates@getCategorizedTemplates');
    Route::post('admin/templates/loadTemplatePreview', 'Admin\Templates@loadTemplatePreview');
    Route::get('admin/templates/loadStripoResources', 'Admin\Templates@loadStripoResources');
    Route::get('admin/templates/parseModuleStatictemplate', 'Admin\Templates@parseModuleStatictemplate');
    Route::get('admin/templates/getStripoBlankTemplateContent', 'Admin\Templates@getStripoBlankTemplateContent');
    Route::post('admin/templates/sendTestEmail', 'Admin\Templates@sendTestEmail');
    Route::post('admin/templates/sendTestSMS', 'Admin\Templates@sendTestSMS');
    Route::post('admin/templates/cloneTemplate', 'Admin\Templates@cloneTemplate');
    Route::post('admin/templates/deleteTemplate', 'Admin\Templates@deleteTemplate');
    Route::get('admin/templates/saveThumbnail/{id}', 'Admin\Templates@saveThumbnail');
    Route::post('admin/templates/updateThumbnail', 'Admin\Templates@updateThumbnail');
    Route::get('admin/templates/brandboostEmailTagReplace', 'Admin\Templates@brandboostEmailTagReplace');
    Route::get('admin/templates/edit/{id}', 'Admin\Templates@edit');


//Broadcast Module
    Route::get('admin/broadcast', 'Admin\Broadcast@index');
    Route::get('admin/broadcast/index', 'Admin\Broadcast@index');
    Route::get('admin/broadcast/email', 'Admin\Broadcast@email');
    Route::get('admin/broadcast/sms', 'Admin\Broadcast@sms');
    Route::get('admin/broadcast/smsoverview', 'Admin\Broadcast@smsoverview');
    Route::get('admin/broadcast/edit/{id?}', 'Admin\Broadcast@edit');
    Route::get('admin/broadcast/setup/{id?}', 'Admin\Broadcast@setup');
    Route::get('admin/broadcast/smsSetup/{id?}', 'Admin\Broadcast@smsSetup');
    Route::get('admin/broadcast/setupTargetAudience/{id?}', 'Admin\Broadcast@setupTargetAudience');
    Route::get('admin/broadcast/setupViewSummary/{id?}', 'Admin\Broadcast@setupViewSummary');
    Route::get('admin/broadcast/setupLoadTemplates/{id?}', 'Admin\Broadcast@setupLoadTemplates');
    Route::post('admin/broadcast/addVariation', 'Admin\Broadcast@addVariation');
    Route::post('admin/broadcast/updateSplitTest', 'Admin\Broadcast@updateSplitTest');
    Route::post('admin/broadcast/updateBroadcastSettingUnit', 'Admin\Broadcast@updateBroadcastSettingUnit');
    Route::post('admin/broadcast/updateVariation', 'Admin\Broadcast@updateVariation');
    Route::post('admin/broadcast/deleteVariation', 'Admin\Broadcast@deleteVariation');
    Route::post('admin/broadcast/getBroadcastAudience', 'Admin\Broadcast@getBroadcastAudience');
    Route::post('admin/broadcast/getCategorizedTemplates', 'Admin\Broadcast@getCategorizedTemplates');
    Route::post('admin/broadcast/deleteBroadcastAudience', 'Admin\Broadcast@deleteBroadcastAudience');
    Route::post('admin/broadcast/deleteBroadcastBulkAudience', 'Admin\Broadcast@deleteBroadcastBulkAudience');
    Route::get('admin/broadcast/automationStats/{id?}', 'Admin\Broadcast@automationStats');
    Route::post('admin/broadcast/moveArchive', 'Admin\Broadcast@moveArchive');
    Route::post('admin/broadcast/multipalArchiveAutomation', 'Admin\Broadcast@multipalArchiveAutomation');
    Route::post('admin/broadcast/addContactToCampaign', 'Admin\Broadcast@addContactToCampaign');
    Route::get('admin/broadcast/addAudienceToBraodcast', 'Admin\Broadcast@addAudienceToBraodcast');
    Route::get('admin/broadcast/importExcludeAudienceCount/{boradcast_id}', 'Admin\Broadcast@importExcludeAudienceCount');
    Route::get('admin/broadcast/syncBroadcastAudience/{boradcast_id}', 'Admin\Broadcast@syncBroadcastAudience');
    Route::post('admin/broadcast/addContactToExcludeCampaign', 'Admin\Broadcast@addContactToExcludeCampaign');
    Route::post('admin/broadcast/addTagToCampaign', 'Admin\Broadcast@addTagToCampaign');
    Route::post('admin/broadcast/addExcludedTagToCampaign', 'Admin\Broadcast@addExcludedTagToCampaign');
    Route::post('admin/broadcast/addSegmentToCampaign', 'Admin\Broadcast@addSegmentToCampaign');
    Route::post('admin/broadcast/addExcludeSegmentToCampaign', 'Admin\Broadcast@addExcludeSegmentToCampaign');
    Route::post('admin/broadcast/updateAutomationListsRecord', 'Admin\Broadcast@updateAutomationListsRecord');
    Route::post('admin/broadcast/updateAutomationListsExcludedRecord', 'Admin\Broadcast@updateAutomationListsExcludedRecord');
    Route::post('admin/broadcast/updateBroadcastTempalte', 'Admin\Broadcast@updateBroadcastTempalte');
    Route::post('admin/broadcast/updateStripoCampaign', 'Admin\Broadcast@updateStripoCampaign');
    Route::post('admin/broadcast/updateBroadcastFromEmail', 'Admin\Broadcast@updateBroadcastFromEmail');
    Route::post('admin/broadcast/updateBroadcastClone', 'Admin\Broadcast@updateBroadcastClone');
    Route::post('admin/broadcast/updateBroadcast', 'Admin\Broadcast@updateBroadcast');
    Route::post('admin/broadcast/updateBroadcastData', 'Admin\Broadcast@updateBroadcastData');
    Route::post('admin/broadcast/updateAutomationScheduleDate', 'Admin\Broadcast@updateAutomationScheduleDate');
    Route::post('admin/broadcast/updateBroadcastSubject', 'Admin\Broadcast@updateBroadcastSubject');
    Route::post('admin/broadcast/updateBroadcastSettings', 'Admin\Broadcast@updateBroadcastSettings');
    Route::post('admin/broadcast/clonBroadcastCampaign', 'Admin\Broadcast@clonBroadcastCampaign');
    Route::post('admin/broadcast/createBroadcast', 'Admin\Broadcast@createBroadcast');
    Route::get('admin/broadcast/mysegments', 'Admin\Broadcast@mysegments');
    Route::post('admin/broadcast/getSegment', 'Admin\Broadcast@getSegment');
    Route::post('admin/broadcast/updateSegment', 'Admin\Broadcast@updateSegment');
    Route::get('admin/broadcast/segmentcontacts/{segment_id}', 'Admin\Broadcast@segmentcontacts');
    Route::post('admin/broadcast/deleteMultipalSegment', 'Admin\Broadcast@deleteMultipalSegment');
    Route::post('admin/broadcast/deleteMultipalSegmentUser', 'Admin\Broadcast@deleteMultipalSegmentUser');
    Route::post('admin/broadcast/addFiltersToSegment', 'Admin\Broadcast@addFiltersToSegment');
    Route::post('admin/broadcast/deleteSegment', 'Admin\Broadcast@deleteSegment');
    Route::post('admin/broadcast/archive_multipal_segment', 'Admin\Broadcast@archive_multipal_segment');
    Route::post('admin/broadcast/createSegment', 'Admin\Broadcast@createSegment');
    Route::post('admin/broadcast/makeSegment', 'Admin\Broadcast@makeSegment');
    Route::post('admin/broadcast/syncSegment', 'Admin\Broadcast@syncSegment');
    Route::post('admin/broadcast/syncSegmentMultiple', 'Admin\Broadcast@syncSegmentMultiple');
    Route::post('admin/broadcast/addCampaignToBroadcast', 'Admin\Broadcast@addCampaignToBroadcast');
    Route::post('admin/broadcast/previewBroadcastCampaign', 'Admin\Broadcast@previewBroadcastCampaign');
    Route::post('admin/broadcast/sendPreviewBroadcastEmail', 'Admin\Broadcast@sendPreviewBroadcastEmail');
    Route::post('admin/broadcast/setTab', 'Admin\Broadcast@setTab');
    Route::get('admin/broadcast/records/{email_sms}/{broadcast_id}', 'Admin\Broadcast@records');
    Route::post('admin/broadcast/getEmailReport', 'Admin\Broadcast@getEmailReport');
    Route::post('admin/broadcast/loadImportOption', 'Admin\Broadcast@loadImportOption');
    Route::post('admin/broadcast/loadExcludeOption', 'Admin\Broadcast@loadExcludeOption');
    Route::post('admin/broadcast/getImportedProperties', 'Admin\Broadcast@getImportedProperties');
    Route::post('admin/broadcast/getExportedProperties', 'Admin\Broadcast@getExportedProperties');
    Route::post('admin/broadcast/loadBroadcastAudience', 'Admin\Broadcast@loadBroadcastAudience');
    Route::post('admin/broadcast/multipalDeleteRecord', 'Admin\Broadcast@multipalDeleteRecord');
    Route::post('admin/broadcast/createSegmentWithSavedFilters', 'Admin\Broadcast@createSegmentWithSavedFilters');
    Route::get('admin/broadcast/report/{broadcastID}', 'Admin\Broadcast@report');

//Tags
    Route::post('admin/tags/getSubscriberTags', 'Admin\Tags@getSubscriberTags');
    Route::post('admin/tags/applySubscriberTag', 'Admin\Tags@applySubscriberTag');

//Subscriber
    Route::post('admin/subscriber/add_contact', 'Admin\Subscribers@add_contact');
    Route::post('admin/subscriber/update_contact', 'Admin\Subscribers@update_contact');
    Route::get('admin/subscriber/exportSubscriberCSV', 'Admin\Subscribers@exportSubscriberCSV');
    Route::post('admin/subscriber/importSubscriberCSV', 'Admin\Subscribers@importSubscriberCSV');
    Route::post('admin/subscriber/importSubscriberList', 'Admin\Subscribers@importSubscriberList');
    Route::post('admin/subscriber/readSubscriberCSV', 'Admin\Subscribers@readSubscriberCSV');
    Route::post('admin/subscriber/mapSubscriberCSV', 'Admin\Subscribers@mapSubscriberCSV');
    Route::post('admin/subscriber/readSubscriberCSVToMap', 'Admin\Subscribers@readSubscriberCSVToMap');
    Route::post('admin/subscriber/moveToArchiveModuleContact', 'Admin\Subscribers@moveToArchiveModuleContact');
    Route::post('admin/subscriber/changeModuleContactStatus', 'Admin\Subscribers@changeModuleContactStatus');
    Route::post('admin/subscriber/getSubscriberDetail', 'Admin\Subscribers@getSubscriberDetail');
    Route::post('admin/subscriber/getSubscriberDetailFile', 'Admin\Subscribers@getSubscriberDetailFile');
    Route::post('admin/subscriber/updateSubscriberDetails', 'Admin\Subscribers@updateSubscriberDetails');
    Route::post('admin/subscriber/deleteModuleSubscriber', 'Admin\Subscribers@deleteModuleSubscriber');
    Route::post('admin/subscriber/deleteBulkModuleContacts', 'Admin\Subscribers@deleteBulkModuleContacts');
    Route::post('admin/subscriber/archiveBulkModuleContacts', 'Admin\Subscribers@archiveBulkModuleContacts');

//Lists
    Route::get('admin/lists', 'Admin\Lists@index');
    Route::get('admin/lists/smslists', 'Admin\Lists@smslists');
    Route::get('admin/lists/getListContacts', 'Admin\Lists@getListContacts');
    Route::get('admin/lists/getSMSListContacts', 'Admin\Lists@getSMSListContacts');
    Route::post('admin/lists/getContactDetail', 'Admin\Lists@getContactDetail');
    Route::post('admin/lists/updateSubscriber', 'Admin\Lists@updateSubscriber');
    Route::post('admin/lists/addList', 'Admin\Lists@addList');
    Route::post('admin/lists/getList', 'Admin\Lists@getList');
    Route::post('admin/lists/updateList', 'Admin\Lists@updateList');
    Route::post('admin/lists/updatePeopleList', 'Admin\Lists@updatePeopleList');
    Route::post('admin/lists/archiveMultipalLists', 'Admin\Lists@archiveMultipalLists');
    Route::post('admin/lists/deleteMultipalLists', 'Admin\Lists@deleteMultipalLists');
    Route::post('admin/lists/deleteLists', 'Admin\Lists@deleteLists');
    Route::post('admin/lists/addListSusbscriber', 'Admin\Lists@addListSusbscriber');
    Route::post('admin/lists/importListCSV', 'Admin\Lists@importListCSV');
    Route::post('admin/lists/exportListCSV', 'Admin\Lists@exportListCSV');
    Route::get('admin/lists/rolelist', 'Admin\Lists@rolelist');
    Route::get('admin/lists/memberlist', 'Admin\Lists@memberlist');
    Route::get('admin/lists/viewLog', 'Admin\Lists@viewLog');
    Route::get('admin/lists/activitylist', 'Admin\Lists@activitylist');
    Route::post('admin/lists/addTeamMember', 'Admin\Lists@addTeamMember');
    Route::post('admin/lists/addRole', 'Admin\Lists@addRole');
    Route::post('admin/lists/getRole', 'Admin\Lists@getRole');
    Route::post('admin/lists/updateRole', 'Admin\Lists@updateRole');
    Route::post('admin/lists/deleteRole', 'Admin\Lists@deleteRole');
    Route::post('admin/lists/getTeamMember', 'Admin\Lists@getTeamMember');
    Route::post('admin/lists/updateTeamMember', 'Admin\Lists@updateTeamMember');
    Route::post('admin/lists/deleteTeamMember', 'Admin\Lists@deleteTeamMember');
    Route::post('admin/lists/manageRolePermission', 'Admin\Lists@manageRolePermission');
    Route::post('admin/lists/addRolePermission', 'Admin\Lists@addRolePermission');
    Route::post('admin/lists/updateRolePermission', 'Admin\Lists@updateRolePermission');
    Route::post('admin/lists/updateContactStatus', 'Admin\Lists@updateContactStatus');
    Route::post('admin/lists/deleteMultipalListContact', 'Admin\Lists@deleteMultipalListContact');
    Route::post('admin/lists/archiveMultipalListContact', 'Admin\Lists@archiveMultipalListContact');
    Route::post('admin/lists/moveToArchiveListContact', 'Admin\Lists@moveToArchiveListContact');
    Route::post('admin/lists/moveToArchiveList', 'Admin\Lists@moveToArchiveList');
    Route::post('admin/lists/changeListStatus', 'Admin\Lists@changeListStatus');
    Route::post('admin/lists/deleteListContact', 'Admin\Lists@deleteListContact');

//Brand Module
    Route::get('admin/brandboost/brand_configuration', 'Admin\Brandboost@brand_configuration');
    Route::post('admin/brandboost/addBrandConfigurationData', 'Admin\Brandboost@addBrandConfigurationData');
    Route::post('admin/brandboost/updateBrandConfigurationData', 'Admin\Brandboost@updateBrandConfigurationData');
    Route::post('admin/brandboost/createBrandPageTheme', 'Admin\Brandboost@createBrandPageTheme');
    Route::post('admin/contacts/profile/{contactId}', 'Admin\Contacts@profile');
    Route::post('admin/contacts/add_contact_notes', 'Admin\Contacts@add_contact_notes');
    Route::get('admin/contacts/mycontacts', 'Admin\Contacts@mycontacts');
    Route::get('admin/contacts/profile/{contactId}', 'Admin\Contacts@profile');
    Route::post('admin/brandboost/getFaqdetails/{faqId}', 'Admin\Brandboost@getFaqdetails');
    Route::post('admin/brandboost/UpdateFaqData', 'Admin\Brandboost@UpdateFaqData');
    Route::post('admin/brandboost/update_faq_status', 'Admin\Brandboost@update_faq_status');
    Route::post('admin/brandboost/addBrandCampaign', 'Admin\Brandboost@addBrandCampaign');
    Route::post('admin/brandboost/getBrandThemeData', 'Admin\Brandboost@getBrandThemeData');
    Route::post('admin/brandboost/addFaqData', 'Admin\Brandboost@addFaqData');
    Route::get('admin/brandboost/stats/{type}/{id}', 'Admin\Brandboost@stats');


//Team Module
    Route::get('admin/team/dashboard', 'Admin\Team@dashboard');
    Route::post('admin/team/addTeamMember', 'Admin\Team@addTeamMember');
    Route::post('admin/team/manageRolePermission', 'Admin\Team@manageRolePermission');
    Route::post('admin/team/updateRolePermission', 'Admin\Team@updateRolePermission');
    Route::get('admin/team/rolelist', 'Admin\Team@rolelist');
    Route::get('admin/team/manageRolePermission', 'Admin\Team@manageRolePermission');
    Route::post('admin/team/getRole', 'Admin\Team@getRole');
    Route::post('admin/team/updateRole', 'Admin\Team@updateRole');
    Route::post('admin/team/deleteRole', 'Admin\Team@deleteRole');
    Route::post('admin/team/addRole', 'Admin\Team@addRole');
    Route::get('admin/team/memberlist', 'Admin\Team@memberlist');
    Route::post('admin/team/getTeamMember', 'Admin\Team@getTeamMember');
    Route::post('admin/team/updateTeamMember', 'Admin\Team@updateTeamMember');
    Route::get('admin/team/activitylist', 'Admin\Team@activitylist');
    Route::post('admin/team/deleteTeamMember', 'Admin\Team@deleteTeamMember');
    Route::post('admin/team/twilioNumberlisting', 'Admin\Team@twilioNumberlisting');

//Live
    Route::get('admin/live', 'Admin\Live@index');
    Route::get('admin/live/details/{id}', 'Admin\Live@details');

//Tag Module
    Route::get('admin/tags', 'Admin\Tags@index');
    Route::get('admin/tags/getTagContacts', 'Admin\Tags@getTagContacts');
    Route::get('admin/tags/groups', 'Admin\Tags@TagGroups');
    Route::get('admin/tags/tagsreview', 'Admin\Tags@tagsreview');
    Route::get('admin/tags/tagsfeedback', 'Admin\Tags@tagsfeedback');
    Route::get('admin/tags/feedback/{id}', 'Admin\Tags@feedback');
    Route::get('admin/tags/{id}', 'Admin\Tags@getTagList');
    Route::post('admin/tags/addgroupentity', 'Admin\Tags@addgroupentity');
    Route::post('admin/tags/addgroup', 'Admin\Tags@addgroup');
    Route::post('admin/tags/deleteTagGroup', 'Admin\Tags@deleteTagGroup');
    Route::post('admin/tags/deleteTagGroupEntity', 'Admin\Tags@deleteTagGroupEntity');
    Route::get('admin/tags/review/{id}', 'Admin\Tags@review');
    Route::get('admin/tags/listAllTags', 'Admin\Tags@listAllTags');
    Route::post('admin/tags/applyReviewTag', 'Admin\Tags@applyReviewTag');
    Route::post('admin/tags/addTagReviews', 'Admin\Tags@addTagReviews');
    Route::post('admin/reviews/update_review_status', 'Admin\Reviews@updateReviewStatus');
    Route::post('admin/reviews/displayreview', 'Admin\Reviews@displayreview');
    Route::post('admin/reviews/saveReviewNotes', 'Admin\Reviews@saveReviewNotes');
    Route::post('admin/reviews/getReviewPopupData', 'Admin\Reviews@getReviewPopupData');
    Route::post('admin/reviews/getReviewFeedPopupData', 'Admin\Reviews@getReviewFeedPopupData');
    Route::post('admin/reviews/getReviewById', 'Admin\Reviews@getReviewById');
    Route::post('admin/reviews/update_video_review', 'Admin\Reviews@update_video_review');

//NPS Module
    /**
     * --------------------------------------------------------------------------
     *  Import component for NPS widget section.
     *  @Pavan
     * --------------------------------------------------------------------------
     */
    Route::get('/admin/modules/nps/nps_widget/setup/{widgetID}', 'Admin\Modules\Nps@npsWidgetSetup');
    Route::post('/admin/modules/nps/autoSaveNPSWidget', 'Admin\Modules\Nps@autoSaveNPSWidget');
    Route::post('/admin/modules/nps/changeStatusNPSWidget', 'Admin\Modules\Nps@updatNPSWidgetStatus');

    Route::get('admin/modules/nps', 'Admin\Modules\Nps@index');
    Route::get('admin/modules/nps/overview', 'Admin\Modules\Nps@overview');
    Route::get('admin/modules/nps/setup/{npsID}', 'Admin\Modules\Nps@setup');
    Route::get('/admin/modules/nps/setup/survey-auto-save/{npsID}', 'Admin\Modules\Nps@surveyAutoSave');
    Route::get('admin/modules/nps/nps_widget_list/{widgetID}', 'Admin\Modules\Nps@nps_widget_List');
    Route::post('admin/modules/nps/updateNPSCustomize', 'Admin\Modules\Nps@updateNPSCustomize');
    Route::post('admin/modules/nps/addNPSWidget', 'Admin\Modules\Nps@addNPSWidget');
    Route::post('admin/modules/nps/updatNPSWidgetStatus', 'Admin\Modules\Nps@updatNPSWidgetStatus');
    Route::post('admin/modules/nps/delete_nps_widget', 'Admin\Modules\Nps@delete_nps_widget');
    Route::post('admin/modules/nps/getNPSWidgetEmbedCode', 'Admin\Modules\Nps@getNPSWidgetEmbedCode');
    Route::get('admin/modules/nps/nps_widget_setup/{widgetID}', 'Admin\Modules\Nps@nps_widget_setup');
    Route::post('admin/modules/nps/addNPSWidgetSurvey', 'Admin\Modules\Nps@addNPSWidgetSurvey');
    Route::post('admin/modules/nps/deleteBulkNPSWidgets', 'Admin\Modules\Nps@deleteBulkNPSWidgets');
    Route::post('admin/modules/nps/archiveBulkNPSWidgets', 'Admin\Modules\Nps@archiveBulkNPSWidgets');
    Route::post('admin/modules/nps/bulkArchiveNPSWidgets', 'Admin\Modules\Nps@bulkArchiveNPSWidgets');
    Route::post('admin/modules/nps/publishNPSWidgetSurvey', 'Admin\Modules\Nps@publishNPSWidgetSurvey');
    Route::post('admin/modules/nps/getNpsUserById', 'Admin\Modules\Nps@getNpsUserById');
    Route::post('admin/modules/nps/updateNpsSubscriber', 'Admin\Modules\Nps@updateNpsSubscriber');
    Route::post('admin/modules/nps/bulkDeleteNpsUser', 'Admin\Modules\Nps@bulkDeleteNpsUser');
    Route::post('admin/modules/nps/deleteNpsUser', 'Admin\Modules\Nps@deleteNpsUser');
    Route::post('admin/modules/nps/addNPS', 'Admin\Modules\Nps@addNPS');
    Route::post('admin/modules/nps/updateAllCampaign', 'Admin\Modules\Nps@updateAllCampaign');
    Route::post('admin/modules/nps/updateUserCampaign', 'Admin\Modules\Nps@updateUserCampaign');
    Route::post('admin/modules/nps/updateNPSEvent', 'Admin\Modules\Nps@updateNPSEvent');
    Route::post('admin/modules/nps/deleteNPSCampaign', 'Admin\Modules\Nps@deleteNPSCampaign');
    Route::post('admin/modules/nps/updateNPSReminderCampaign', 'Admin\Modules\Nps@updateNPSReminderCampaign');
    Route::post('admin/modules/nps/updateNPSReminderLoop', 'Admin\Modules\Nps@updateNPSReminderLoop');
    Route::post('admin/modules/nps/updateNPSCampaign', 'Admin\Modules\Nps@updateNPSCampaign');
    Route::post('admin/modules/nps/getNPSCampaign', 'Admin\Modules\Nps@getNPSCampaign');
    Route::post('admin/modules/nps/getNPS', 'Admin\Modules\Nps@getNPS');
    Route::post('admin/modules/nps/changeStatus', 'Admin\Modules\Nps@changeStatus');
    Route::post('admin/modules/nps/publishNPSCampaign', 'Admin\Modules\Nps@publishNPSCampaign');
    Route::post('admin/modules/nps/publishNPSCampaignStatus', 'Admin\Modules\Nps@publishNPSCampaignStatus');
    Route::post('admin/modules/nps/updateNPS', 'Admin\Modules\Nps@updateNPS');
    Route::post('admin/modules/nps/deleteNPS', 'Admin\Modules\Nps@deleteNPS');
    Route::post('admin/modules/nps/moveToArchiveNPS', 'Admin\Modules\Nps@moveToArchiveNPS');
    Route::post('admin/modules/nps/bulkDeleteNPS', 'Admin\Modules\Nps@bulkDeleteNPS');
    Route::post('admin/modules/nps/bulkArchiveNPS', 'Admin\Modules\Nps@bulkArchiveNPS');
    Route::post('admin/modules/nps/choosePlatform', 'Admin\Modules\Nps@choosePlatform');
    Route::get('admin/modules/nps/template/{platform}/{hashKey}', 'Admin\Modules\Nps@template');
    Route::get('admin/modules/nps/score/{?hashKey}', 'Admin\Modules\Nps@score');
    Route::get('admin/modules/nps/feedbackdetails/{?scoreID}', 'Admin\Modules\Nps@feedbackdetails');
    Route::post('admin/modules/nps/saveNPSNotes', 'Admin\Modules\Nps@saveNPSNotes');
    Route::post('admin/modules/nps/applyNPSTag', 'Admin\Modules\Nps@applyNPSTag');
    Route::post('admin/modules/nps/removeNPSTag', 'Admin\Modules\Nps@removeNPSTag');
    Route::post('admin/modules/nps/getNPSNoteById', 'Admin\Modules\Nps@getNPSNoteById');
    Route::post('admin/modules/nps/deleteNPSNote', 'Admin\Modules\Nps@deleteNPSNote');
    Route::post('admin/modules/nps/updatNotes', 'Admin\Modules\Nps@updatNotes');
    Route::post('admin/modules/nps/listAllTags', 'Admin\Modules\Nps@listAllTags');
    Route::post('admin/modules/nps/registerInvite', 'Admin\Modules\Nps@registerInvite');
    Route::post('admin/modules/nps/exportCSV', 'Admin\Modules\Nps@exportCSV');
    Route::post('admin/modules/nps/importInviteCSV', 'Admin\Modules\Nps@importInviteCSV');
    Route::get('admin/modules/nps/stats/{npsID}', 'Admin\Modules\Nps@stats');
    Route::get('admin/modules/nps/feedbackdetails/{scoreID}', 'Admin\Modules\Nps@feedbackdetails');
    Route::get('admin/modules/nps/score/{hashKey}', 'Admin\Modules\Nps@score');
    Route::get('admin/modules/nps/score', 'Admin\Modules\Nps@score');

//Segment Module
    Route::get('admin/broadcast/mysegments', 'Admin\Broadcast@mysegments');
    Route::post('admin/segments/syncSegment', 'Admin\Segments@syncSegment');
    Route::post('admin/broadcast/getSegment', 'Admin\Broadcast@getSegment');
    Route::post('admin/broadcast/updateSegment', 'Admin\Broadcast@updateSegment');
    Route::post('admin/broadcast/updatePeopleSegment', 'Admin\Broadcast@updatePeopleSegment');
    Route::post('admin/broadcast/archive_multipal_segment', 'Admin\Broadcast@archive_multipal_segment');
    Route::post('admin/broadcast/deleteSegment', 'Admin\Broadcast@deleteSegment');

//Analytics Reports
    Route::get('admin/brandboost/reports', 'Admin\Brandboost@reports');
    Route::get('admin/brandboost/feedbackreports', 'Admin\Brandboost@feedbackreports');
    Route::get('admin/brandboost/responseperformance', 'Admin\Brandboost@responseperformance');
    Route::get('admin/brandboost/repResTimeTrends', 'Admin\Brandboost@repResTimeTrends');
    Route::get('admin/brandboost/servicereports', 'Admin\Brandboost@servicereports');
    Route::get('admin/brandboost/reportsOptOut', 'Admin\Brandboost@reportsOptOut');
    Route::get('admin/brandboost/insightTags', 'Admin\Brandboost@insightTags');


//superadmin Area
    Route::get('admin/settings/amazon_s3_storage', 'Admin\Settings@amazon_s3_storage');
    Route::post('admin/settings/getEmailNotificationContent', 'Admin\Settings@getEmailNotificationContent');
    Route::post('admin/settings/getuserbyid', 'Admin\Settings@getuserbyid');
    Route::post('admin/settings/updateS3setting', 'Admin\Settings@updateS3setting');
    Route::get('admin/settings/creditValues', 'Admin\Settings@creditValues');
    Route::post('admin/settings/getCreditPropery', 'Admin\Settings@getCreditPropery');
    Route::post('admin/settings/updateCreditPropery', 'Admin\Settings@updateCreditPropery');
    Route::get('admin/users', 'Admin\Users@index');
    Route::post('admin/users/update_status', 'Admin\Users@update_status');
    Route::post('admin/users/getUserById', 'Admin\Users@getUserById');
    Route::post('admin/users/user_delete', 'Admin\Users@user_delete');
    Route::post('admin/users/getUserInfo', 'Admin\Users@getUserInfo');
    Route::get('admin/users/sendgriddata/{ID}', 'Admin\Users@sendgriddata');
    Route::get('admin/settings/list_client_details/{ID}', 'Admin\Settings@list_client_details');
    Route::get('admin/settings/twillo_log', 'Admin\Settings@twillo_log');
    Route::get('admin/feedback', 'Admin\Feedback@index');
    Route::post('admin/feedback/saveFeedbackNotes', 'Admin\Feedback@saveFeedbackNotes');
    Route::post('admin/feedback/getFeedbackNotes', 'Admin\Feedback@getFeedbackNotes');
    Route::post('admin/feedback/updateFeedbackNote', 'Admin\Feedback@updateFeedbackNote');
    Route::post('admin/feedback/deleteFeedbackNote', 'Admin\Feedback@deleteFeedbackNote');
    Route::post('admin/transactions/addManualCredits', 'Admin\Transactions@addManualCredits');
    Route::get('admin/workflow/templates/{type}', 'Admin\WorkFlow@templates');
    Route::get('admin/workflow/getWorkflowTemplate', 'Admin\WorkFlow@getWorkflowTemplate');
    Route::get('admin/workflow/updateWorkflowTemplate', 'Admin\WorkFlow@updateWorkflowTemplate');
    Route::get('admin/subscriptions', 'Admin\Subscriptions@index');

    Route::get('admin/settings/team_accounts/{id}', 'Admin\Settings@team_accounts');
    Route::get('admin/settings/list_details/{id}', 'Admin\Settings@list_details');

    Route::get('admin/contacts', 'Contacts@index');

    //Add admin routes here
});
//Middleware Routes above


Route::post('payment/changeSubscription', 'Payment@changeSubscription');
Route::post('reviews/deleteReviewMultipal', 'Reviews@deleteReviewMultipal');
Route::post('reviews/getCommonCommentPopup/{widgetHash?}', 'Reviews@getCommonCommentPopup');

//offsite
Route::get('feedback', 'Feedback@index');
Route::post('feedback/saveFeedback', 'Feedback@saveFeedback');
Route::get('feedback/{page}', 'Feedback@index');
Route::post('feedback/saveResolution', 'Feedback@saveResolution');

//Servey
Route::get('survey/{hashcode}', 'Survey@index');

//VueJS Helper Utilities Controller
Route::post('admin/helperutility/getSubscriberTags', 'Admin\HelperUtility@getSubscriberTags');
Route::post('admin/helperutility/getFeedbackTags', 'Admin\HelperUtility@getFeedbackTags');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/eventCampaigns', 'Admin\HelperUtility@eventCampaigns');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/workflowSubscribers', 'Admin\HelperUtility@workflowSubscribers');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getWorkflowContactSelectionInterfaceData', 'Admin\HelperUtility@getWorkflowContactSelectionInterfaceData');
//New Workflow Tree
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getWorkflowData', 'Admin\WorkFlow@getWorkflowData');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateWorkflowUnitInfo', 'Admin\WorkFlow@updateWorkflowUnitInfo');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/createWorkflowBlankAction', 'Admin\WorkFlow@createWorkflowBlankAction');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateWorkflowBlankAction', 'Admin\WorkFlow@updateWorkflowBlankAction');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/deleteWorkflowEvent', 'Admin\WorkFlow@deleteWorkflowEvent');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/moveWorkflowNode', 'Admin\WorkFlow@moveWorkflowNode');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateEventDelay', 'Admin\WorkFlow@updateEventDelay');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getSplitInfo', 'Admin\WorkFlow@getSplitInfo');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateSplitData', 'Admin\WorkFlow@updateSplitData');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowActionField', 'Admin\WorkFlow@loadWorkflowActionField');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/addEndCampaignToEvent', 'Admin\WorkFlow@addEndCampaignToEvent');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getEndCampaign', 'Admin\WorkFlow@getEndCampaign');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateTriggerData', 'Admin\WorkFlow@updateTriggerData');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateCustomFields', 'Admin\WorkFlow@updateCustomFields');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getDecisionInfo', 'Admin\WorkFlow@getDecisionInfo');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateDecisionData', 'Admin\WorkFlow@updateDecisionData');

Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getWorkflowDecisionData', 'Admin\WorkFlow@getWorkflowDecisionData');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/createWorkflowDecisionBlankAction', 'Admin\WorkFlow@createWorkflowDecisionBlankAction');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateWorkflowDecisionBlankAction', 'Admin\WorkFlow@updateWorkflowDecisionBlankAction');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/deleteWorkflowDecisionEvent', 'Admin\WorkFlow@deleteWorkflowDecisionEvent');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/moveWorkflowDecisionNode', 'Admin\WorkFlow@moveWorkflowDecisionNode');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateDecisionEventDelay', 'Admin\WorkFlow@updateDecisionEventDelay');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/loadWorkflowDecisionActionField', 'Admin\WorkFlow@loadWorkflowDecisionActionField');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/addDecisionEndCampaignToEvent', 'Admin\WorkFlow@addDecisionEndCampaignToEvent');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/getDecisionEndCampaign', 'Admin\WorkFlow@getDecisionEndCampaign');
Route::post('f9e64c81dd00b76e5c47ed7dc27b193733a847c0f/updateDecisionTriggerData', 'Admin\WorkFlow@updateDecisionTriggerData');










