/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vue from 'vue'
import Antd from 'ant-design-vue'
import 'ant-design-vue/dist/antd.css'
import VueRouter from 'vue-router'
import store from './store'
import {
    Pagination,
    Table,
    TableColumn,
} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/zh-TW'
import locale from 'element-ui/lib/locale'

/**
 * Route views
 */
import App from './view/App.vue'
import Index from './view/Index.vue'
import Login from './view/Login.vue'
import DashBoard from './view/Components/dashboard/DashBoard.vue'
import Form from './view/Components/form/Form.vue'
import User from './view/Components/user/User.vue'
import Admin from './view/Components/admin/Admin.vue'

Vue.config.productionTip = false

Vue.use(Antd)
Vue.use(VueRouter)
Vue.use(Pagination)
Vue.use(Table)
Vue.use(TableColumn)

locale.use(lang)

const prefix = '/admin'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: `${prefix}/`,
            component: Index,
            children: [
                {
                    path: '',
                    name: 'Index',
                    component: DashBoard
                },{
                    path: 'form',
                    name: 'Form',
                    component: Form
                },{
                    path: 'user',
                    name: 'User',
                    component: User
                },{
                    path: 'admin',
                    name: 'Admin',
                    component: Admin
                }
            ]
        },
        {
            path: `${prefix}/Login`,
            name: 'Login',
            component: Login
        }
    ]
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
