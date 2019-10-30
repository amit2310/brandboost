import Dashboard from './components/admin/dashboard/';
import Live from './components/admin/live/';
import Contact from './components/admin/contact/Contacts.vue';
import ContactProfile from './components/admin/contact/ContactProfile';
import ContactDashboard from './components/admin/contact/Dashboard';
import ListTemplates from './components/admin/templates/ListTemplates.vue';
import Service from './components/Services.vue';
import OnsiteOverview from './components/admin/brandboost/onsite/onsite_overview';
import OnsiteReviews from './components/admin/brandboost/onsite/reviews';
import OnsiteQuestions from './components/admin/brandboost/onsite/questions';
import OnsiteList from './components/admin/brandboost/onsite/';
import OnsiteReviewRequest from './components/admin/brandboost/onsite/ReviewRequest.vue';
import OffsiteReviewRequest from './components/admin/brandboost/offsite/ReviewRequest.vue';
import Media from './components/admin/brandboost/Media.vue';
import Tags from './components/admin/tags/';
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


const routes = [
    { path: '/contacts/dashboard', component: ContactDashboard, props: { pageColor: 'onsite_sec'} },
    { path: '/dashboard', component: Dashboard, props: { pageColor: 'onsite_sec'}  },
    { path: '/live', component: Live, props: {pageColor: 'live_sec'} },
    { path: '/contacts/mycontacts', component: Contact, props:{ pageColor: 'people_sec'} },
    { path: '/contacts/profile/:id', component: ContactProfile, props:{ pageColor: 'people_sec'} },

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
    { path: '/templates/email', component: ListTemplates, props : {pageColor: 'email_sec', title : 'Email Templates', type : 'email' } },
    { path: '/templates/sms', component: ListTemplates, props : {pageColor: 'sms_sec', title : 'Sms Templates', type : 'sms' } },



    { path: '/brandboost/media', component: Media, props: {title : 'On Site Brand Boost Media'} },
    { path: '/tags', component: Tags, meta: { title: 'Insight Tags - Brand Boost'} },
    { path: '/tags/tagsreview', component: TagsReview, meta: { title: 'Tags Review - Brand Boost'} },
    { path: '/tags/tagsfeedback', component: TagsFeedback, meta: { title: 'Tags Feedback - Brand Boost'} },
    { path: '/lists', component: EmailLists, meta: { title: 'Email Lists - Brand Boost'} },
    { path: '/lists/getListContacts/:id', component: ListSubscribers, meta: { title: 'Segments Subscribers'} },
    { path: '/broadcast/email', component: EmailBroadcasts, meta: { title: 'Email Broadcast - Brand Boost'} },

    /*Segments*/
    { path: '/broadcast/mysegments', component: Segments, meta: { title: 'My Segments'} },
    { path: '/broadcast/segmentContacts/:id', component: SegmentSubscribers, meta: { title: 'Segments Subscribers'} },

];

export default routes;

