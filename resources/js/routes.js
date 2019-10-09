import Dashboard from './components/admin/dashboard/';
import Live from './components/admin/live/';
import Service from './components/Services.vue';
import OnsiteList from './components/admin/brandboost/onsite/';
import Tags from './components/admin/tags/';
import TagsReview from './components/admin/tags/tagsreview';
import TagsFeedback from './components/admin/tags/tagsfeedback';

const routes = [
    { path: '/dashboard', component: Dashboard },
    { path: '/live', component: Live },
    { path: '/contacts/mycontacts', component: Service },
    { path: '/brandboost/onsite', component: OnsiteList },
    { path: '/tags', component: Tags, meta: { title: 'Insight Tags - Brand Boost'} },
    { path: '/tags/tagsreview', component: TagsReview, meta: { title: 'Tags Review - Brand Boost'} },
    { path: '/tags/tagsfeedback', component: TagsFeedback, meta: { title: 'Tags Feedback - Brand Boost'} }
];

export default routes;

