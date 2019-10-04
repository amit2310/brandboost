import Dashboard from './components/admin/dashboard/';
import Contact from './components/ContactUs.vue';
import Service from './components/Services.vue';
import OnsiteList from './components/admin/brandboost/onsite/';
import Tags from './components/admin/tags/';

const routes = [
    { path: '/dashboard', component: Dashboard },
    { path: '/live', component: Contact },
    { path: '/contacts/mycontacts', component: Service },
    { path: '/brandboost/onsite', component: OnsiteList },
    { path: '/tags', component: Tags, meta: { title: 'Insight Tags - Brand Boost'} }
];

export default routes;

