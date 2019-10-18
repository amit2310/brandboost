import Dashboard from './components/admin/dashboard/';
import Live from './components/admin/live/';
import Contact from './components/admin/contact/Contacts.vue';
import ListTemplates from './components/admin/templates/ListTemplates.vue';
import Service from './components/Services.vue';
import OnsiteOverview from './components/admin/brandboost/onsite/onsite_overview';
import OnsiteReviews from './components/admin/brandboost/onsite/reviews';
import OnsiteQuestions from './components/admin/brandboost/onsite/questions';
import OnsiteList from './components/admin/brandboost/onsite/';
import OnsiteReviewRequest from './components/admin/brandboost/ReviewRequest.vue';
import Media from './components/admin/brandboost/Media.vue';
import Tags from './components/admin/tags/';
import TagsReview from './components/admin/tags/tagsreview';
import TagsFeedback from './components/admin/tags/tagsfeedback';
import EmailLists from './components/admin/Lists';
import EmailBroadcasts from './components/admin/broadcast/Email';

const routes = [
    { path: '/', component: Dashboard },
    { path: '/dashboard', component: Dashboard },
    { path: '/live', component: Live },
    { path: '/contacts/mycontacts', component: Contact },
    /*{ path: '/templates/email', component: EmailTemplates },
    { path: '/templates/sms', component: SmsTemplates },*/
    { path: '/brandboost/onsite_overview', component: OnsiteOverview, meta: { title: 'Onsite overview - Brand Boost'} },
    { path: '/brandboost/reviews', component: OnsiteReviews, meta: { title: 'Onsite reviews - Brand Boost'} },
    { path: '/questions', component: OnsiteQuestions, meta: { title: 'Onsite questions - Brand Boost'} },
    { path: '/templates/email', component: ListTemplates, props : {title : 'Email Templates', type : 'email' } },
    { path: '/templates/sms', component: ListTemplates, props : {title : 'Sms Templates', type : 'sms' } },
    { path: '/brandboost/onsite', component: OnsiteList },
    { path: '/brandboost/review_request/onsite', component: OnsiteReviewRequest, props: {title : 'Review Requests', review_type: 'onsite'} },
    { path: '/brandboost/media', component: Media, props: {title : 'On Site Brand Boost Media'} },
    { path: '/tags', component: Tags, meta: { title: 'Insight Tags - Brand Boost'} },
    { path: '/tags/tagsreview', component: TagsReview, meta: { title: 'Tags Review - Brand Boost'} },
    { path: '/tags/tagsfeedback', component: TagsFeedback, meta: { title: 'Tags Feedback - Brand Boost'} },
    { path: '/lists', component: EmailLists, meta: { title: 'Email Lists - Brand Boost'} },
    { path: '/broadcast/email', component: EmailBroadcasts, meta: { title: 'Email Broadcast - Brand Boost'} }
];

export default routes;

