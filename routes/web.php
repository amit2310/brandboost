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

Route::get('admin/login','Admin\Login@index');
Route::post('admin/login','Admin\Login@index');
Route::get('admin/login/logout','Admin\Login@logout');

//Dashborad 
Route::get('admin/dashboard','Admin\Dashboard@index');
Route::post('admin/dashboard/getReviewData','Admin\Dashboard@getReviewData');

//Email Modules
Route::get('admin/modules/emails/overview','Admin\Modules\Emails@overview');
Route::get('admin/modules/emails','Admin\Modules\Emails@index');
Route::get('admin/modules/emails/setupAutomation/{id}','Admin\Modules\Emails@setupAutomation');

//Onsite and Offsite Modules
Route::get('admin/brandboost/onsite_overview','Admin\Brandboost@onsiteOverview');
Route::get('admin/brandboost/onsite','Admin\Brandboost@onsite');
Route::get('admin/questions','Admin\Questions@index');
Route::get('admin/brandboost/review_request/{type}','Admin\Brandboost@reviewRequest');
Route::get('admin/brandboost/onsite_setup/{id}','Admin\Brandboost@onsiteSetup');
Route::get('admin/brandboost/reviews/','Admin\Brandboost@reviews');
Route::get('admin/brandboost/reviews/{id}','Admin\Brandboost@reviews');
Route::get('admin/brandboost/media/','Admin\Brandboost@media');
Route::get('admin/reviews/update_review_status/','Admin\Reviews@updateReviewStatus');

//chat module
Route::get('admin/webchat','Admin\WebChat@index');
Route::post('admin/webchat/getUserinfo','Admin\WebChat@getUserinfo');
Route::post('admin/webchat/listingNotes','Admin\WebChat@listingNotes');
Route::post('admin/webchat/addWebNotes','Admin\WebChat@addWebNotes');
Route::post('admin/webchat/getMessages','Admin\WebChat@getMessages');
Route::post('admin/webchat/readMessages','Admin\WebChat@readMessages');
Route::post('admin/webchat/changeLoginStatus','Admin\WebChat@changeLoginStatus');
Route::post('admin/webchat/addChatMsg','Admin\WebChat@addChatMsg');
Route::post('admin/webchat/updateSupportuser','Admin\WebChat@updateSupportuser');
Route::post('admin/webchat/listAllTagsWebchat','Admin\WebChat@listAllTagsWebchat');
Route::post('admin/webchat/applyWebTag','Admin\WebChat@applyWebTag');
Route::post('admin/webchat/getWebTaglist','Admin\WebChat@getWebTaglist');
Route::post('admin/webchat/deleteTagFromWeb','Admin\WebChat@deleteTagFromWeb');
Route::post('admin/webchat/setChatboxstatus','Admin\WebChat@setChatboxstatus');



Route::get('admin/smschat','Admin\SmsChat@index');
Route::get('admin/smschat/getSubsinfo','Admin\SmsChat@getSubsinfo');
Route::post('admin/smschat/showSmsThreads','Admin\SmsChat@showSmsThreads');
Route::post('admin/smschat/listingNotes','Admin\SmsChat@listingNotes');
Route::post('admin/smschat/sendMsg','Admin\SmsChat@sendMsg');
Route::get('admin/smschat/livesearch','Admin\SmsChat@livesearch');
Route::post('admin/smschat/getSearchSmsListByinput','Admin\SmsChat@getSearchSmsListByinput');
Route::post('admin/smschat/add_contact_notes','Admin\SmsChat@add_contact_notes');
Route::post('admin/smschat/addSmsNotes','Admin\SmsChat@addSmsNotes');
Route::post('admin/smschat/listingSmsNotes','Admin\SmsChat@listingSmsNotes');
Route::post('admin/smschat/shortcutListing','Admin\SmsChat@shortcutListing');
Route::post('admin/smschat/small_shortcutListing','Admin\SmsChat@small_shortcutListing');
Route::post('admin/smschat/small_shortcutListing_sms','Admin\SmsChat@small_shortcutListing_sms');


//Profile module
Route::get('admin/profile','Admin\AccountSetting@index');

//Users module
Route::post('admin/users/updateUserData','Admin\Users@updateUserData');

//Workfow
Route::post('admin/workflow/updateEventTime','Admin\WorkFlow@updateEventTime');
Route::post('admin/workflow/addWorkflowEventToTree','Admin\WorkFlow@addWorkflowEventToTree');
Route::post('admin/workflow/addWorkflowEventToTreeNew','Admin\WorkFlow@addWorkflowEventToTreeNew');
Route::post('admin/workflow/addWorkflowNode','Admin\WorkFlow@addWorkflowNode');
Route::post('admin/workflow/connectWorkflowNode','Admin\WorkFlow@connectWorkflowNode');
Route::get('admin/workflow/createEventNode','Admin\WorkFlow@createEventNode');
Route::get('admin/workflow/createWorkflowEventNode','Admin\WorkFlow@createWorkflowEventNode');
Route::post('admin/workflow/updateWorkflowCampaign','Admin\WorkFlow@updateWorkflowCampaign');
Route::post('admin/workflow/saveWorkflowDraft','Admin\WorkFlow@saveWorkflowDraft');
Route::post('admin/workflow/savetoMyTemplates','Admin\WorkFlow@savetoMyTemplates');
Route::post('admin/workflow/updateWorkflowDraft','Admin\WorkFlow@updateWorkflowDraft');
Route::post('admin/workflow/updateWorkflowTemplate','Admin\WorkFlow@updateWorkflowTemplate');
Route::post('admin/workflow/sendTestEmailworkflowCampaign','Admin\WorkFlow@sendTestEmailworkflowCampaign');
Route::post('admin/workflow/sendTestSMSworkflowCampaign','Admin\WorkFlow@sendTestSMSworkflowCampaign');
Route::post('admin/workflow/previewWorkflowCampaign','Admin\WorkFlow@previewWorkflowCampaign');
Route::post('admin/workflow/getWorkflowCampaign','Admin\WorkFlow@getWorkflowCampaign');
Route::post('admin/workflow/getWorkflowTemplate','Admin\WorkFlow@getWorkflowTemplate');
Route::post('admin/workflow/deleteWorkflowEvent','Admin\WorkFlow@deleteWorkflowEvent');
Route::post('admin/workflow/deleteWorkflowDraft','Admin\WorkFlow@deleteWorkflowDraft');
Route::get('admin/workflow/loadStripoCampaign/{module_name}/{campaign_id}/{module_unit_id}','Admin\WorkFlow@loadStripoCampaign');
Route::get('admin/workflow/loadStripoSMSCampaign','Admin\WorkFlow@loadStripoSMSCampaign');
Route::get('admin/workflow/loadStripoTemplate','Admin\WorkFlow@loadStripoTemplate');
Route::get('admin/workflow/loadStripoTemplatePreview','Admin\WorkFlow@loadStripoTemplatePreview');
Route::post('admin/workflow/loadStripoTemplatePreview','Admin\WorkFlow@loadStripoTemplatePreview');
Route::get('admin/workflow/loadStripoCampaignResources','Admin\WorkFlow@loadStripoCampaignResources');
Route::get('admin/workflow/templates','Admin\WorkFlow@templates');
Route::post('admin/workflow/addWorkflowTemplate','Admin\WorkFlow@addWorkflowTemplate');
Route::post('admin/workflow/deleteWorkflowTemplate','Admin\WorkFlow@deleteWorkflowTemplate');
Route::get('admin/workflow/getStripoBlankContent','Admin\WorkFlow@getStripoBlankContent');
Route::get('admin/workflow/getReferralUnitInfo','Admin\WorkFlow@getReferralUnitInfo');
Route::get('admin/workflow/referralEmailTagReplace','Admin\WorkFlow@referralEmailTagReplace');
Route::get('admin/workflow/brandboostEmailTagReplace','Admin\WorkFlow@brandboostEmailTagReplace');
Route::post('admin/workflow/loadWorkflowEmailStats','Admin\WorkFlow@loadWorkflowEmailStats');
Route::post('admin/workflow/loadWorkflowSMSStats','Admin\WorkFlow@loadWorkflowSMSStats');
Route::post('admin/workflow/loadWorkflowTree','Admin\WorkFlow@loadWorkflowTree');
Route::post('admin/workflow/addContactToWorkflowCampaign','Admin\WorkFlow@addContactToWorkflowCampaign');
Route::post('admin/workflow/addListToWorkflowCampaign','Admin\WorkFlow@addListToWorkflowCampaign');
Route::post('admin/workflow/addSegmentToWorkflowCampaign','Admin\WorkFlow@addSegmentToWorkflowCampaign');
Route::post('admin/workflow/addTagToWorkflowCampaign','Admin\WorkFlow@addTagToWorkflowCampaign');
Route::post('admin/workflow/addContactToExcludeWorkflowCampaign','Admin\WorkFlow@addContactToExcludeWorkflowCampaign');
Route::post('admin/workflow/updateAutomationListsExcludedRecord','Admin\WorkFlow@updateAutomationListsExcludedRecord');
Route::post('admin/workflow/addExcludeSegmentToWorkflowCampaign','Admin\WorkFlow@addExcludeSegmentToWorkflowCampaign');
Route::post('admin/workflow/addExcludedTagToWorkflowCampaign','Admin\WorkFlow@addExcludedTagToWorkflowCampaign');
Route::post('admin/workflow/getWorkflowImportedProperties','Admin\WorkFlow@getWorkflowImportedProperties');
Route::post('admin/workflow/getWorkflowExportedProperties','Admin\WorkFlow@getWorkflowExportedProperties');
Route::post('admin/workflow/syncWorkflowAudience','Admin\WorkFlow@syncWorkflowAudience');
Route::get('admin/workflow/addAudienceToWorkflowCampaign','Admin\WorkFlow@addAudienceToWorkflowCampaign');
Route::get('admin/workflow/syncWorkflowAudienceGlobal','Admin\WorkFlow@syncWorkflowAudienceGlobal');

//Dropzone Section
Route::post('dropzone/upload_editor_image','Dropzone@upload_editor_image');