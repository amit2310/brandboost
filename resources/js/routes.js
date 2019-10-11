import Dashboard from './components/admin/dashboard/';
import Live from './components/admin/live/';
import Contact from './components/admin/contact/Contacts.vue';
import ListTemplates from './components/admin/templates/ListTemplates.vue';
import Service from './components/Services.vue';
import OnsiteOverview from './components/admin/brandboost/onsite/onsite_overview';
import OnsiteList from './components/admin/brandboost/onsite/';
import Tags from './components/admin/tags/';
import TagsReview from './components/admin/tags/tagsreview';
import TagsFeedback from './components/admin/tags/tagsfeedback';


const routes = [
    { path: '/', component: Dashboard },
    { path: '/dashboard', component: Dashboard },
    { path: '/live', component: Live },
    { path: '/contacts/mycontacts', component: Contact },
    /*{ path: '/templates/email', component: EmailTemplates },
    { path: '/templates/sms', component: SmsTemplates },*/
    { path: '/brandboost/onsite_overview', component: OnsiteOverview, meta: { title: 'Onsite overview - Brand Boost'} },
    { path: '/templates/email', component: ListTemplates, props : {title : 'Email Templates', type : 'email' } },
    { path: '/templates/sms', component: ListTemplates, props : {title : 'Sms Templates', type : 'sms' } },
    { path: '/brandboost/onsite', component: OnsiteList },
    { path: '/tags', component: Tags, meta: { title: 'Insight Tags - Brand Boost'} },
    { path: '/tags/tagsreview', component: TagsReview, meta: { title: 'Tags Review - Brand Boost'} },
    { path: '/tags/tagsfeedback', component: TagsFeedback, meta: { title: 'Tags Feedback - Brand Boost'} }
];

export default routes;

