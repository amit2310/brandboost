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
import TemplateMaster from './components/admin/templates/TemplateMaster';
import Service from './components/Services.vue';
import OnsiteOverview from './components/admin/brandboost/onsite/onsite_overview';
import OnsiteReviews from './components/admin/brandboost/onsite/reviews';
import OnsiteQuestions from './components/admin/brandboost/onsite/questions';
import OnsiteList from './components/admin/brandboost/onsite/';
import OnsiteReviewRequest from './components/admin/brandboost/onsite/ReviewRequest.vue';
import OffsiteReviewRequest from './components/admin/brandboost/offsite/ReviewRequest.vue';
import Media from './components/admin/brandboost/Media.vue';
import Tags from './components/admin/tags/';
import TagSubscribers from './components/admin/tags/TagSubscribers';
import TagsReview from './components/admin/tags/tagsreview';
import TagsFeedback from './components/admin/tags/tagsfeedback';
import EmailLists from './components/admin/Lists';
import EmailBroadcasts from './components/admin/broadcast/Email';
import OffsiteOverview from './components/admin/brandboost/offsite/Overview';
import OffsiteNegativeFeedback from './components/admin/feedback/FeedbackList';
import OffsiteCampaigns from './components/admin/brandboost/offsite/ListOffsiteCampaign';
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
import ReferralOverview from './components/admin/modules/referral/Overview';

/*NPS Survey Module*/
import NpsOverview from './components/admin/modules/nps/Overview';
import NpsScore from './components/admin/modules/nps/Score';

import AutomationCampaigns from './components/admin/modules/emails/Workflow';
import WorkflowSetup from './components/admin/modules/emails/WorkflowSetup';
//import WorkflowSetup from './components/admin/workflow/MasterWorkflow';

/*Broadcast Setup*/
import broadcastStep1 from './components/admin/broadcast/Setup';
import broadcastStep2 from './components/admin/broadcast/Setup2';
import broadcastStep3 from './components/admin/broadcast/Setup3';
import broadcastStep4 from './components/admin/broadcast/Setup4';
import broadcastStep5 from './components/admin/broadcast/Setup5';

import Companies from './components/admin/companies/Companies';
import Configurations from './components/admin/contact/Configurations';
import PeopleDeals from './components/admin/deals/Deals';




const routes = [

    { path: '/dashboard', component: Dashboard, props: { pageColor: 'onsite_sec'}  },
    { path: '/live', component: Live, props: {pageColor: 'live_sec'} },

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
    { path: '/brandboost/reviews', component: OnsiteReviews, props: {pageColor: 'onsite_sec'}, meta: { title: 'Onsite reviews - Brand Boost'} },
    { path: '/questions', component: OnsiteQuestions, props: {pageColor: 'onsite_sec'}, meta: { title: 'Onsite questions - Brand Boost'} },
    { path: '/brandboost/review_request/onsite', component: OnsiteReviewRequest, props: {pageColor: 'onsite_sec', title : 'Review Requests', review_type: 'onsite'} },

    /*Offsite Module*/
    { path: '/brandboost/offsite_overview', component: OffsiteOverview, props: {pageColor:'offsite_sec', title: 'Offsite overview'} },
    { path: '/brandboost/offsite', component: OffsiteCampaigns, props: {pageColor:'offsite_sec', title: 'Offsite Brand Boost Campaigns'} },
    { path: '/brandboost/review_request/offsite', component: OffsiteReviewRequest, props: {pageColor:'offsite_sec', title : 'Review Requests', review_type: 'offsite'} },
    { path: '/feedback/listall/', component: OffsiteNegativeFeedback, props: { pageColor:'offsite_sec', title: 'Requires Attention'} },

    /* Templates Module */
    /*{ path: '/templates/email', component: ListTemplates, props : {pageColor: 'email_sec', title : 'Email Templates', type : 'email' } },
    { path: '/templates/sms', component: ListTemplates, props : {pageColor: 'sms_sec', title : 'Sms Templates', type : 'sms' } },*/



    { path: '/brandboost/media', component: Media, props: {title : 'On Site Brand Boost Media'} },
    { path: '/tags/getTagContacts/:id', component: TagSubscribers, meta: { title: 'Tag Subscribers'} },
    { path: '/tags/tagsreview', component: TagsReview, meta: { title: 'Tags Review - Brand Boost'} },
    { path: '/tags/tagsfeedback', component: TagsFeedback, meta: { title: 'Tags Feedback - Brand Boost'} },
    { path: '/lists/getListContacts/:id', component: ListSubscribers, meta: { title: 'Segments Subscribers'} },
    { path: '/broadcast/email', component: EmailBroadcasts, meta: { title: 'Email Broadcast - Brand Boost'} },

    /*Segments*/

    { path: '/broadcast/segmentContacts/:id', component: SegmentSubscribers, meta: { title: 'Segments Subscribers'} },

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

    /*Referral Module*/
    { path: '/modules/referral/overview', component: ReferralOverview, meta: { title: 'Referral Dashboard'} },
    { path: '/modules/referral/', component: ReferralOverview, meta: { title: 'Referral Dashboard'} },

    /* Nps Survey Module */
    { path: '/modules/nps/overview', component: NpsOverview, meta: { title: 'NPS Survey Dashboard'} },
    { path: '/modules/nps/', component: NpsOverview, meta: { title: 'NPS Survey Dashboard'} },
    { path: '/modules/nps/score/:hashKey', component: NpsScore, meta: { title: 'NPS Survey Score'} },

    /*Workflow Module*/
    { path: '/modules/emails/workflow', component: AutomationCampaigns, meta: { title: 'Email Campaigns'} },
    { path: '/modules/emails/workflow/setup/:id', component: WorkflowSetup, meta: { title: 'Workflow Setup'} },
    { path: '/modules/emails/templatestest', component: TemplateMaster, meta: { title: 'Workflow Setup'} },

    { path: '/modules/sms/workflow', component: SmsAutomationCampaigns, meta: { title: 'SMS Campaigns'} },



];

export default routes;

