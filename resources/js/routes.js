import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomeComponent from './pages/HomeComponent'
import BlogComponent from './pages/BlogComponent'
import ContactsComponent from './pages/ContactsComponent'
import PostDetail from './pages/PostDetail'
import NotFoundComponent from './pages/NotFoundComponent'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeComponent
        },
        {
            path: '/blog',
            name: 'blog',
            component: BlogComponent
        },
        {
            path: '/blog/:id',
            name: 'postDetail',
            component: PostDetail
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: ContactsComponent
        },
        {
            path: '/*',
            name: 'notFound',
            component: NotFoundComponent
        }
    ]
})

export default router;
