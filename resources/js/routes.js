import Dashboard from './components/admin/dashboard/';
import Contact from './components/ContactUs.vue';
import Service from './components/Services.vue';


const routes = [
    { path: '/dashboard', component: Dashboard },
    { path: '/live', component: Contact },
    { path: '/contacts/mycontacts', component: Service },
];

export default routes;

