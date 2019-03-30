import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Dashboard from './components/pages/Dashboard';
import EmailTemplate from './components/pages/EmailTemplate'


const routes = [
    {path: '/', component: Dashboard},
    {path: '/email-template', component: EmailTemplate},
];


const router = new VueRouter({
    routes,
    mode:'history'
});

export default new VueRouter({routes});