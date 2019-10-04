import Dashboard from './components/admin/dashboard/';
import Live from './components/admin/live/';
import Service from './components/Services.vue';


const routes = [
    { path: '/dashboard', component: Dashboard },
    { path: '/live', component: Live },
    { path: '/contacts/mycontacts', component: Service },
];

export default routes;

