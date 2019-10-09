import Dashboard from './components/admin/dashboard/';
import Live from './components/admin/live/';
import Contact from './components/admin/contact/Contacts.vue';
/*import EmailTemplates from './components/admin/templates/Email.vue';
import SmsTemplates from './components/admin/templates/Sms.vue';*/
import Service from './components/Services.vue';
import OnsiteList from './components/admin/brandboost/onsite/';
import Tags from './components/admin/tags/';


const routes = [
    { path: '/dashboard', component: Dashboard },
    { path: '/live', component: Live },
    { path: '/contacts/mycontacts', component: Contact },
    /*{ path: '/templates/email', component: EmailTemplates },
    { path: '/templates/sms', component: SmsTemplates },*/
    { path: '/brandboost/onsite', component: OnsiteList },
    { path: '/tags', component: Tags, meta: { title: 'Insight Tags - Brand Boost'} }
];

export default routes;

