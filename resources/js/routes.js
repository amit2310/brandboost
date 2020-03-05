import Dashboard from './components/admin/dashboard/';
import Live from './components/admin/live/';
import Contact from './components/admin/contact/Contacts.vue';
import ContactProfile from './components/admin/contact/ContactProfile';
import ContactDashboard from './components/admin/contact/Dashboard';
import PeopleContactsImport from './components/admin/contact/PeopleContactsImport.vue';
import PeopleContactsUploadFile from './components/admin/contact/PeopleContactsUploadFile.vue';
import PeopleContactsCopyPaste from './components/admin/contact/PeopleContactsCopyPaste.vue';
import VueCsvImport from './components/admin/contact/VueCsvImport.vue';
import AppImport from './components/admin/contact/App.vue';
import PeopleContactsListMapping from './components/admin/contact/PeopleContactsListMapping.vue';
import ListTemplates from './components/admin/templates/ListTemplates.vue';
import ListSMSTemplates from './components/admin/templates/ListSMSTemplates.vue';
import TemplateMaster from './components/admin/templates/TemplateMaster';
import OnsiteOverview from './components/admin/brandboost/onsite/onsite_overview';
import ReviewsDashboard from './components/admin/brandboost/Dashboard';
import OnsiteReviews from './components/admin/brandboost/onsite/Reviews';
import onsiteReviewDetails from './components/admin/brandboost/onsite/ReviewDetails';
import OnsiteCampaignReviews from './components/admin/brandboost/onsite/OnsiteCampaignReviews';
import OnsiteCampaignQuestions from './components/admin/brandboost/onsite/OnsiteCampaignQuestions';
import QuestionsDetails from './components/admin/brandboost/onsite/QuestionsDetails';
import OnsiteQuestions from './components/admin/brandboost/onsite/questions';
import OnsiteList from './components/admin/brandboost/onsite/';
import OnsiteMedia from './components/admin/brandboost/onsite/Media';
import OnsiteReviewRequest from './components/admin/brandboost/onsite/ReviewRequest.vue';
import OffsiteReviewRequest from './components/admin/brandboost/offsite/ReviewRequest.vue';
import OnsiteReviewCampaigns from './components/admin/brandboost/onsite/ReviewCampaigns.vue';
/*Import Onsite Setup components*/
import onsiteStep1 from './components/admin/brandboost/onsite/setup/Setup';
import onsiteStep2 from './components/admin/brandboost/onsite/setup/Setup2';
import onsiteStep3 from './components/admin/brandboost/onsite/setup/Setup3';
import onsiteStep4 from './components/admin/brandboost/onsite/setup/Setup4';
import onsiteStep5 from './components/admin/brandboost/onsite/setup/Setup5';

import OffsiteReviewCampaigns from './components/admin/brandboost/offsite/ReviewCampaigns.vue';
/*Import Offsite Setup components*/
import offsiteStep1 from './components/admin/brandboost/offsite/setup/Setup';
import offsiteStep2 from './components/admin/brandboost/offsite/setup/Setup2';
import offsiteStep3 from './components/admin/brandboost/offsite/setup/Setup3';
import offsiteStep4 from './components/admin/brandboost/offsite/setup/Setup4';
import offsiteStep5 from './components/admin/brandboost/offsite/setup/Setup5';
import ReviewFeedback from './components/admin/brandboost/ReviewFeedback.vue';
import MediaTable from './components/admin/brandboost/MediaTable';
import Tags from './components/admin/tags/Index';
import TagGroups from './components/admin/tags/TagGroups';
import TagList from './components/admin/tags/TagList';
import TagSubscribers from './components/admin/tags/TagSubscribers';
import TagsReview from './components/admin/tags/TagReviews';
import TagsFeedback from './components/admin/tags/TagsFeedback';
import EmailLists from './components/admin/Lists';
import EmailBroadcasts from './components/admin/broadcast/Email';
import OffsiteOverview from './components/admin/brandboost/offsite/Overview';
import FeedbackList from './components/admin/feedback/FeedbackList';
import OffsiteCampaigns from './components/admin/brandboost/offsite/ListOffsiteCampaign';
import OffsiteNegativeFeedback from './components/admin/brandboost/offsite/Feedbacks';
import OffsiteFeedbackDetails from './components/admin/brandboost/offsite/FeedbackDetails';
import Segments from './components/admin/broadcast/Segments';
import SegmentSubscribers from './components/admin/contact/SegmentSubscribers';
import ListSubscribers from './components/admin/contact/ListSubscribers';
/*Email Module*/
import EmailDashboard from './components/admin/modules/emails/Dashboard';
import BroadcastCampaigns from './components/admin/modules/emails/Broadcast';

/*Sms Module*/
import SmsDashboard from './components/admin/modules/sms/Dashboard';
import SmsBroadcastCampaigns from './components/admin/modules/sms/Broadcast';
import SmsAutomationCampaigns from './components/admin/modules/sms/Workflow';

/*Referral Module*/


/*Brand Page*/
import BrandSetting from './components/admin/brand/Settings';
import BrandConfiguration from './components/admin/brand/Configurations';
import BrandConfigurationSingle from './components/admin/brand/Single';
/*Chat Module*/
import ChatDashboard from './components/admin/chat/Dashboard';
import ChatWeb from './components/admin/chat/web/BigChat';
import ChatSMS from './components/admin/chat/sms/BigChat';
import ChatShortcut from './components/admin/chat/Shortcuts';
/*Widget Section*/
import WidgetOverview from './components/admin/brandboost/WidgetOverview';
// import OnsiteWidgets from './components/admin/brandboost/Widgets';



import MediaGalleryWidget from './components/admin/MediaGallery';
import OnsiteWidgetSetup from './components/admin/brandboost/onsite/widget_setup/ReviewWidgets';

/*NPS Survey Module*/
import NpsOverview from './components/admin/modules/nps/Overview';
import NpsScore from './components/admin/modules/nps/Score';


import AutomationCampaigns from './components/admin/modules/emails/Workflow';
import WorkflowSetup from './components/admin/modules/emails/WorkflowSetup';
import SMSWorkflowSetup from './components/admin/modules/sms/WorkflowSetup';
//import WorkflowSetup from './components/admin/workflow/MasterWorkflow';
/*Broadcast Setup*/
import broadcastStep1 from './components/admin/broadcast/Setup';
import broadcastStep2 from './components/admin/broadcast/Setup2';
import broadcastStep3 from './components/admin/broadcast/Setup3';
import broadcastStep4 from './components/admin/broadcast/Setup4';
import broadcastStep5 from './components/admin/broadcast/Setup5';

import smsBroadcastStep1 from './components/admin/broadcast/sms/Setup';
import smsBroadcastStep2 from './components/admin/broadcast/sms/Setup2';
import smsBroadcastStep3 from './components/admin/broadcast/sms/Setup3';
import smsBroadcastStep4 from './components/admin/broadcast/sms/Setup4';
import smsBroadcastStep5 from './components/admin/broadcast/sms/Setup5';

import Companies from './components/admin/companies/Companies';
import Configurations from './components/admin/contact/Configurations';
import PeopleDeals from './components/admin/deals/Deals';

import Profile from './components/admin/Profile';


/* Sub User Section */
import UserProfile from './components/user/Profile';
import UserMedia from './components/user/Media';
import UserNps from './components/user/Nps';
import UserReferral from './components/user/Referral';
import UserReview from './components/user/Review';
import ReviewDetail from './components/user/ReviewDetail';
import EditReview from './components/user/EditReview';
import UserSetting from './components/user/Setting';
import UserSupport from './components/user/Support';

/**
 * --------------------------------------------------------------------------
 *  Import component for widget onsite section.
 *  @Pavan
 * --------------------------------------------------------------------------
 */
import WidgetsOnsiteList from './components/admin/modules/widgets/WidgetsList';
import WidgetsOnsiteSetup from './components/admin/modules/widgets/onsite/ReviewWidgets';
import WidgetsOnsiteStats from './components/admin/modules/widgets/onsite/Stats';
/**
 * --------------------------------------------------------------------------
 *  Add component of Chat Widgets section.
 *  @Pavan
 * --------------------------------------------------------------------------
 */
import ChatWidgets from './components/admin/modules/chat/Index';
import ChatWidgetsSetup1 from './components/admin/modules/chat/setup/Setup';
import ChatWidgetsSetup2 from './components/admin/modules/chat/setup/Setup2';
import ChatWidgetsSetup3 from './components/admin/modules/chat/setup/Setup3';
import ChatWidgetsSetup4 from './components/admin/modules/chat/setup/Setup4';


/**
 * --------------------------------------------------------------------------
 *  Import component for NPS widget section.
 *  @Pavan
 * --------------------------------------------------------------------------
 */
import NPSWidgets from './components/admin/modules/nps/Widgets';
import NPSWidgetsSetup1 from './components/admin/modules/nps/setup/Setup';
import NPSWidgetsSetup2 from './components/admin/modules/nps/setup/Setup2';

import npsStep1 from './components/admin/modules/nps/Survey/Setup';
import npsStep2 from './components/admin/modules/nps/Survey/Setup2';
import npsStep3 from './components/admin/modules/nps/Survey/Setup3';
import npsStep4 from './components/admin/modules/nps/Survey/Setup4';

/**
 * --------------------------------------------------------------------------
 *  Import component for Referral widget section.
 *  @Pavan
 * --------------------------------------------------------------------------
 */

import ReferralAdvocates from './components/admin/modules/referral/Advocates';
import ReferralStats from './components/admin/modules/referral/Stats';
import ReferralReports from './components/admin/modules/referral/Reports';
import ReferralStep1 from './components/admin/modules/referral/setup/Setup';
import ReferralStep2 from './components/admin/modules/referral/setup/Setup2';
import ReferralStep3 from './components/admin/modules/referral/setup/Setup3';
import ReferralStep4 from './components/admin/modules/referral/setup/Setup4';
import ReferralStep5 from './components/admin/modules/referral/setup/Setup5';


import ReferralWidgets from './components/admin/modules/referral/Widgets';
import ReferralWidgetsSetup1 from './components/admin/modules/referral/widget/setup/Setup';
import ReferralWidgetsSetup2 from './components/admin/modules/referral/widget/setup/Setup2';

import ReferralOverview from './components/admin/modules/referral/campaign/Overview';
import ReferralCampaignSetup1 from './components/admin/modules/referral/campaign/setup/Setup';
import ReferralCampaignSetup2 from './components/admin/modules/referral/campaign/setup/Setup2';
import ReferralCampaignSetup3 from './components/admin/modules/referral/campaign/setup/Setup3';
import ReferralCampaignSetup4 from './components/admin/modules/referral/campaign/setup/Setup4';
import ReferralCampaignSetup5 from './components/admin/modules/referral/campaign/setup/Setup5';

/**
 * --------------------------------------------------------------------------
 *  Import component for MediaGallery widget section.
 *  @Pavan
 * --------------------------------------------------------------------------
 */

import MediaGallery from './components/admin/modules/mediagallery/Widgets';
import MediaGallerySetup1 from './components/admin/modules/mediagallery/setup/Setup';
import MediaGallerySetup2 from './components/admin/modules/mediagallery/setup/Setup2';

/** -----------------------------------** END  **-----------------------------*/

/**
 * --------------------------------------------------------------------------
 *  Import component for Admin Setting section.
 *  @Pavan
 * --------------------------------------------------------------------------
 */
    // import Settings from './components/admin/Settings';
    import Settings from './components/admin/settings/Settings';
/** -----------------------------------** END  **-----------------------------*/

const routes = [

    /**
     * --------------------------------------------------------------------------
     *  Add Routes for Onsite Widgets
     *  @Pavan
     * --------------------------------------------------------------------------
     */

    { path: '/widgets/onsite', component: WidgetsOnsiteList, meta: { title: 'Onsite Widgets'} },
    { path: '/widgets/onsite/setup/:id/1', component: WidgetsOnsiteSetup, meta: { title: 'Onsite Widget Setup'} },
    { path: '/widgets/onsite/stats/:id/4', component: WidgetsOnsiteStats, meta: { title: 'Onsite Widget Stats'} },

    /**-----------------------------------End---------------------------------------*/

    /**
     * --------------------------------------------------------------------------
     *  Add Routes for chat Widgets
     *  @Pavan
     * --------------------------------------------------------------------------
     */
    { path: '/modules/chat', component: ChatWidgets, meta: { title: 'Chat Widgets'} },
    { path: '/modules/chat/setup/:id/1', component: ChatWidgetsSetup1, meta: { title: 'Chat Widget Setup'} },
    { path: '/modules/chat/setup/:id/2', component: ChatWidgetsSetup2, meta: { title: 'Chat Widget Setup'} },
    { path: '/modules/chat/setup/:id/3', component: ChatWidgetsSetup3, meta: { title: 'Chat Widget Setup'} },
    { path: '/modules/chat/setup/:id/4', component: ChatWidgetsSetup4, meta: { title: 'Chat Widget Setup'} },
    /**-----------------------------------End---------------------------------------*/

    /**
     * --------------------------------------------------------------------------
     *  Add Routes for NPS Widgets
     *  @Pavan
     * --------------------------------------------------------------------------
     */

    { path: '/modules/nps/widgets', component: NPSWidgets, meta: { title: 'NPS Widgets'} },
    { path: '/modules/nps/widgets/step/:id/1', component: NPSWidgetsSetup1, meta: { title: 'Nps Widget Setup'} },
    { path: '/modules/nps/widgets/step/:id/2', component: NPSWidgetsSetup2, meta: { title: 'Nps Widget Setup'} },
    // Survey
    { path: '/modules/nps/setup/:id/1', component: npsStep1, meta: { title: 'NPS Widgets'} },
    { path: '/modules/nps/setup/:id/2', component: npsStep2, meta: { title: 'NPS Widgets'} },
    { path: '/modules/nps/setup/:id/3', component: npsStep3, meta: { title: 'NPS Widgets'} },
    { path: '/modules/nps/setup/:id/4', component: npsStep4, meta: { title: 'NPS Widgets'} },
    /**-----------------------------------End---------------------------------------*/
    /**
     * --------------------------------------------------------------------------
     *  Add Routes for Referral Widgets.
     *  @Pavan
     * --------------------------------------------------------------------------
     */
    { path: '/modules/referral/widgets', component: ReferralWidgets, meta: { title: 'Referral Widgets'} },
    { path: '/modules/referral/widget/setup/:id/1', component: ReferralWidgetsSetup1, meta: { title: 'Referral Widgets'} },
    { path: '/modules/referral/widget/setup/:id/2', component: ReferralWidgetsSetup2, meta: { title: 'Referral Widgets'} },
    { path: '/modules/referral/setup/:id/1', component: ReferralCampaignSetup1, meta: { title: 'Referral Campaign Setup'} },
    { path: '/modules/referral/setup/:id/2', component: ReferralCampaignSetup2, props : {title : 'Referral Campaign Setup'} },
    { path: '/modules/referral/setup/:id/3', component: ReferralCampaignSetup3, props : {title : 'Referral Campaign Setup'} },
    { path: '/modules/referral/setup/:id/4', component: ReferralCampaignSetup4, props : {title : 'Referral Campaign Setup'} },
    { path: '/modules/referral/setup/:id/5', component: ReferralCampaignSetup5, props : {title : 'Referral Campaign Setup'} },

    /**
     * --------------------------------------------------------------------------
     *  Add Routes for Media Gallery Widgets
     *  @Pavan
     * --------------------------------------------------------------------------
     */

    { path: '/modules/mediagallery', component: MediaGallery, meta: { title: 'Media Gallery'} },
    { path: '/modules/mediagallery/setup/:id/1', component: MediaGallerySetup1, meta: { title: 'Media Gallery'} },
    { path: '/modules/mediagallery/setup/:id/2', component: MediaGallerySetup2, meta: { title: 'Media Gallery'} },

    /**-----------------------------------End---------------------------------------*/

    /*Referral Module*/
    { path: '/modules/referral/overview', component: ReferralOverview, meta: { title: 'Referral Dashboard'} },
    { path: '/modules/referral/', component: ReferralOverview, meta: { title: 'Referral Dashboard'} },
    { path: '/modules/referral/advocates/:id', component: ReferralAdvocates, meta: { title: 'Referral Advocates'} },
    { path: '/modules/referral/stats/:id', component: ReferralStats, meta: { title: 'Referral Statistics'} },
    { path: '/modules/referral/reports/:id', component: ReferralReports, meta: { title: 'Referral Reports'} },
    { path: '/referral/setup/:id/1', component: ReferralStep1, props : {title : 'Referral Campaign Setup'} },
    { path: '/referral/setup/:id/2', component: ReferralStep2, props : {title : 'Referral Campaign Setup'} },
    { path: '/referral/setup/:id/3', component: ReferralStep3, props : {title : 'Referral Campaign Setup'} },
    { path: '/referral/setup/:id/4', component: ReferralStep4, props : {title : 'Referral Campaign Setup'} },
    { path: '/referral/setup/:id/5', component: ReferralStep5, props : {title : 'Referral Campaign Setup'} },

    /**-----------------------------------End---------------------------------------*/
    { path: '/dashboard', component: Dashboard, props: { pageColor: 'onsite_sec'}  },
    { path: '/live', component: Live, props: {pageColor: 'live_sec'} },

    /**
     * --------------------------------------------------------------------------
     *  Add Routes for Admin Setting /Profile  Section
     *  @Pavan
     * --------------------------------------------------------------------------
     */

    { path: '/profile', component: Profile, meta: { title: 'Admin Settings - Brand Boost'} },
    { path: '/settings', component: Settings, meta: { title: 'Brand Settings - Brand Boost'} },

    /**-----------------------------------End---------------------------------------*/

    /*Contacts*/
    { path: '/contacts/dashboard', component: ContactDashboard, props: { pageColor: 'onsite_sec'} },
    { path: '/contacts/mycontacts', component: Contact, props:{ pageColor: 'people_sec'} },
    { path: '/contacts/import', component: PeopleContactsImport, props : {title : 'People Contacts Import', pageColor: 'people_sec' } },
    { path: '/contacts/uploadfile', component: PeopleContactsUploadFile, props : {title : 'People Contacts Upload File', pageColor: 'people_sec' } },
    { path: '/contacts/copypaste', component: PeopleContactsCopyPaste, props : {title : 'People Contacts Copy & Paste', pageColor: 'people_sec' } },
    { path: '/contacts/csvimport', component: VueCsvImport, props : {title : 'People Contacts Upload File', pageColor: 'people_sec' } },
    { path: '/contacts/appimport', component: AppImport, props : {title : 'People Contacts Upload File', pageColor: 'people_sec' } },
    { path: '/contacts/listmapping', component: PeopleContactsListMapping, props : {title : 'People Contacts List Mapping', pageColor: 'people_sec' } },
    { path: '/contacts/profile/:id', component: ContactProfile, props:{ pageColor: 'people_sec'} },
    { path: '/contacts/lists', component: EmailLists, meta: { title: 'Email Lists - Brand Boost'} },
    { path: '/contacts/segments', component: Segments, meta: { title: 'My Segments'} },
    { path: '/contacts/tags', component: Tags, meta: { title: 'Insight Tags - Brand Boost'} },
    { path: '/contacts/deals', component: PeopleDeals, meta: { title: 'Contact Deals'} },
    { path: '/contacts/companies', component: Companies, meta: { title: 'Companies'} },
    { path: '/contacts/configuration', component: Configurations, meta: { title: 'Contact Configuration'} },
    /*Onsite Module*/
    { path: '/brandboost/onsite_overview', component: OnsiteOverview, props:{pageColor: 'onsite_sec'}, meta: {title: 'Onsite overview - Brand Boost'} },
    { path: '/brandboost/onsite', component: OnsiteList, props: {pageColor: 'onsite_sec'} },
    { path: '/reviews/onsite/media', component: OnsiteMedia, props: {pageColor: 'onsite_sec'} },
    { path: '/brandboost/reviews', component: OnsiteReviews, props: {pageColor: 'onsite_sec'}, meta: { title: 'Onsite reviews - Brand Boost'} },
    { path: '/brandboost/reviews/:id', component: OnsiteCampaignReviews, props: {pageColor: 'onsite_sec'}, meta: { title: 'Onsite Campaign Reviews - Brand Boost'} },
    { path: '/brandboost/questions/:id', component: OnsiteCampaignQuestions, props: {pageColor: 'onsite_sec'}, meta: { title: 'Onsite Campaign Questions - Brand Boost'} },
    { path: '/questions/details/:id', component: QuestionsDetails, props: {pageColor: 'onsite_sec'}, meta: { title: 'Question Details - Brand Boost'} },
    { path: '/questions', component: OnsiteQuestions, props: {pageColor: 'onsite_sec'}, meta: { title: 'Onsite questions - Brand Boost'} },
    { path: '/brandboost/reviews/onsite/requests', component: OnsiteReviewRequest, props: {pageColor: 'onsite_sec', title : 'Review Requests', review_type: 'onsite'} },
    /*Offsite Module*/
    { path: '/brandboost/offsite_overview', component: OffsiteOverview, props: {pageColor:'offsite_sec', title: 'Offsite overview'} },
    { path: '/brandboost/offsite', component: OffsiteCampaigns, props: {pageColor:'offsite_sec', title: 'Offsite Brand Boost Campaigns'} },
    { path: '/brandboost/review_request/offsite', component: OffsiteReviewRequest, props: {pageColor:'offsite_sec', title : 'Review Requests', review_type: 'offsite'} },
    { path: '/feedback/listall/', component: FeedbackList, props: { pageColor:'offsite_sec', title: 'Requires Attention'} },
    { path: '/brandboost/offsite/feedbacks', component: OffsiteNegativeFeedback, props: { pageColor:'offsite_sec', title: 'Requires Attention'} },
    { path: '/feedback/:id', component: OffsiteFeedbackDetails, props: { pageColor:'offsite_sec', title: 'Feedback Details'} },
    { path: '/brandboost/media', component: MediaTable, props: {title : 'On Site Brand Boost Media'} },
    /* Templates Module */
    /*{ path: '/templates/email', component: ListTemplates, props : {pageColor: 'email_sec', title : 'Email Templates', type : 'email' } },
    { path: '/templates/sms', component: ListTemplates, props : {pageColor: 'sms_sec', title : 'Sms Templates', type : 'sms' } },*/
    /* Review Module */
    { path: '/reviews/dashboard', component: ReviewsDashboard, props: {pageColor: 'onsite_sec', title : 'Review Dashboard'} },
    { path: '/brandboost/review_campaigns/onsite', component: OnsiteReviewCampaigns, props: {pageColor: 'onsite_sec', title : 'Review Campaigns', review_type: 'onsite'} },
    { path: '/brandboost/review_feedback', component: ReviewFeedback, props: {pageColor: 'onsite_sec', title : 'Review Feedback'} },
    { path: '/reviews/onsite', component: OnsiteReviewCampaigns, props: {pageColor: 'onsite_sec', title : 'Review Campaigns', review_type: 'onsite'} },
    { path: '/reviews/onsite/setup/:id/1', component: onsiteStep1, props : {title : 'On Site Campaign'} },
    { path: '/reviews/onsite/setup/:id/2', component: onsiteStep2, props : {title : 'On Site Campaign'} },
    { path: '/reviews/onsite/setup/:id/3', component: onsiteStep3, props : {title : 'On Site Campaign'} },
    { path: '/reviews/onsite/setup/:id/4', component: onsiteStep4, props : {title : 'On Site Campaign'} },
    { path: '/reviews/onsite/setup/:id/5', component: onsiteStep5, props : {title : 'On Site Campaign'} },
    { path: '/reviews/onsite/reviews/:id', component: onsiteReviewDetails, props : {title : 'On Site Reviews'} },
    { path: '/reviews/offsite', component: OffsiteReviewCampaigns },
    { path: '/reviews/offsite/setup/:id/1', component: offsiteStep1, props : {title : 'Off Site Campaign'} },
    { path: '/reviews/offsite/setup/:id/2', component: offsiteStep2, props : {title : 'Off Site Campaign'} },
    { path: '/reviews/offsite/setup/:id/3', component: offsiteStep3, props : {title : 'Off Site Campaign'} },
    { path: '/reviews/offsite/setup/:id/4', component: offsiteStep4, props : {title : 'Off Site Campaign'} },
    { path: '/reviews/offsite/setup/:id/5', component: offsiteStep5, props : {title : 'Off Site Campaign'} },
    { path: '/tags/groups', component: TagGroups, meta: { title: 'Insight Tags - Brand Boost'} },
    { path: '/tags/:id', component: TagList, meta: { title: 'Insight Tag List - Brand Boost'} },
    { path: '/tags/getTagContacts/:id', component: TagSubscribers, meta: { title: 'Tag Subscribers'} },
    { path: '/contacts/tags/subscribers/:id', component: TagSubscribers, meta: { title: 'Tag Subscribers'} },
    { path: '/tagsreview', component: TagsReview, meta: { title: 'Tags Review - Brand Boost'} },
    { path: '/tagsfeedback', component: TagsFeedback, meta: { title: 'Tags Feedback - Brand Boost'} },
    /*Segments*/
    { path: '/lists/getListContacts/:id', component: ListSubscribers, meta: { title: 'Segments Subscribers'} },
    { path: '/contacts/segments/subscribers/:id', component: SegmentSubscribers, meta: { title: 'Segments Subscribers'} },
    { path: '/broadcast/email', component: EmailBroadcasts, meta: { title: 'Email Broadcast - Brand Boost'} },
    /*Email Module*/
    { path: '/modules/emails/dashboard', component: EmailDashboard, meta: { title: 'Email Dashboard'} },
    { path: '/modules/emails/broadcast', component: BroadcastCampaigns, meta: { title: 'Email Campaigns'} },
    { path: '/modules/emails/templates', component: ListTemplates, props : {title : 'Email Templates', type : 'email' } },
    { path: '/modules/emails/broadcast/setup/:id/1', component: broadcastStep1, props : {title : 'Email Templates', type : 'email' } },
    { path: '/modules/emails/broadcast/setup/:id/2', component: broadcastStep2, props : {title : 'Email Templates', type : 'email' } },
    { path: '/modules/emails/broadcast/setup/:id/3', component: broadcastStep3, props : {title : 'Email Templates', type : 'email' } },
    { path: '/modules/emails/broadcast/setup/:id/4', component: broadcastStep4, props : {title : 'Email Templates', type : 'email' } },
    { path: '/modules/emails/broadcast/setup/:id/5', component: broadcastStep5, props : {title : 'Email Templates', type : 'email' } },
    /*SMS Module*/
    { path: '/modules/sms/dashboard', component: SmsDashboard, meta: { title: 'SMS Dashboard'} },
    { path: '/modules/sms/broadcast', component: SmsBroadcastCampaigns, meta: { title: 'SMS Campaigns'} },
    { path: '/modules/sms/broadcast/setup/:id/1', component: smsBroadcastStep1, props : {title : 'Sms Campaign', type : 'sms' } },
    { path: '/modules/sms/broadcast/setup/:id/2', component: smsBroadcastStep2, props : {title : 'Sms Campaign', type : 'sms' } },
    { path: '/modules/sms/broadcast/setup/:id/3', component: smsBroadcastStep3, props : {title : 'Sms Campaign', type : 'sms' } },
    { path: '/modules/sms/broadcast/setup/:id/4', component: smsBroadcastStep4, props : {title : 'Sms Campaign', type : 'sms' } },
    { path: '/modules/sms/broadcast/setup/:id/5', component: smsBroadcastStep5, props : {title : 'Sms Campaign', type : 'sms' } },
    { path: '/modules/sms/templates', component: ListSMSTemplates, props : {title : 'SMS Templates', type : 'sms' } },
    { path: '/modules/sms/workflow/setup/:id', component: SMSWorkflowSetup, meta: { title: 'Workflow Setup'} },

    /* Nps Survey Module */
    { path: '/modules/nps/overview', component: NpsOverview, meta: { title: 'NPS Survey Dashboard'} },
    { path: '/modules/nps/', component: NpsOverview, meta: { title: 'NPS Survey Dashboard'} },
    { path: '/modules/nps/score/:hashKey', component: NpsScore, meta: { title: 'NPS Survey Score'} },

    /*Workflow Module*/
    { path: '/modules/emails/workflow', component: AutomationCampaigns, meta: { title: 'Email Campaigns'} },
    { path: '/modules/emails/workflow/setup/:id', component: WorkflowSetup, meta: { title: 'Workflow Setup'} },
    { path: '/modules/emails/templatestest', component: TemplateMaster, meta: { title: 'Workflow Setup'} },
    { path: '/modules/sms/workflow', component: SmsAutomationCampaigns, meta: { title: 'SMS Campaigns'} },
    /*Brand Page*/
    { path: '/brand/settings', component: BrandSetting, meta: { title: 'Brand Settings'} },
    { path: '/brand/configuration', component: BrandConfiguration, meta: { title: 'Brand Configuration'} },
    { path: '/brand/configuration/single', component: BrandConfigurationSingle, meta: { title: 'Campaign Specific Brand Configuration'} },
    /*Chat Module*/
    { path: '/chat/dashboard', component: ChatDashboard, meta: { title: 'Chat Dashboard'} },
    { path: '/chat/web', component: ChatWeb, meta: { title: 'Web Chat'} },
    { path: '/chat/sms', component: ChatSMS, meta: { title: 'SMS Chat'} },
    { path: '/chat/shortcuts', component: ChatShortcut, meta: { title: 'Chat Shortcuts'} },
    /*Widget Section*/

    // { path: '/modules/nps/widgets', component: NPSWidgets, meta: { title: 'NPS Surveys'} },
    { path: '/brandboost/widget/overview', component: WidgetOverview, meta: { title: 'Widgets Overview'} },
    { path: '/brandboost/onsite_widget_setup/:id', component: OnsiteWidgetSetup, meta: { title: 'Onsite Widget Setup'} },
    { path: '/mediagallery', component: MediaGalleryWidget, meta: { title: 'Media Gallery Widgets'} },
    /* Sub User Section */
    { path: '/user/profile', component: UserProfile, meta: { title: 'User Profile - Brand Boost'} },
    { path: '/user/media', component: UserMedia, meta: { title: 'My Media - Brand Boost'} },
    { path: '/user/nps', component: UserNps, meta: { title: 'My NPS Feedback - Brand Boost'} },
    { path: '/user/referral', component: UserReferral, meta: { title: 'My Referrals - Brand Boost'} },
    { path: '/user/review', component: UserReview, meta: { title: 'My Review - Brand Boost'} },
    { path: '/user/review/:id', component: ReviewDetail, meta: { title: 'My Review Detail- Brand Boost'} },
    { path: '/user/review/edit/:id', component: EditReview, meta: { title: 'Edit Review - Brand Boost'} },
    { path: '/user/setting', component: UserSetting, meta: { title: 'Personal Data - Brand Boost'} },
    { path: '/user/help', component: UserSupport, meta: { title: 'Help Desk - Brand Boost'} },
];
export default routes;
