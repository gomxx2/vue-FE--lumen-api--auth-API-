import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Pagination from 'vue-pagination-2'
import Paginate from 'vuejs-paginate'


Vue.use(VueRouter);
Vue.component('pagination', Pagination);
Vue.component('paginate', Paginate)

//import bootstrap css & js
import 'bootstrap/dist/css/bootstrap.css'
import 'jquery/dist/jquery.min'
import 'popper.js/dist/popper.min'
import 'bootstrap/dist/js/bootstrap.min'
import './assets/style.css'

//import components
import PostsIndex from './components/posts/Index'
import PostsCreate from './components/posts/Create'
import PostsEdit from './components/posts/Edit'
import callsIndex from './components/calls/callsIndex'
import callsCreate from './components/calls/callsCreate'
import callsCreateid from './components/calls/callsCreateid'
import callsEdit from './components/calls/callsEdit'
//component AUTH
import Dashboard from './components/auth/dashboard'
import Login from './components/auth/Login'
import Register from './components/auth/register'

Vue.config.productionTip = false

const router = new VueRouter({
  routes: [
    {
      path: '/pages/:page/:select',
      name: 'page-filter'
    },{
      path: '/pages/:page',
      name: 'page' 
    },
    //contact
    {
      path: '/',
      name: 'karyawan',
      component: PostsIndex,
      meta: {
        auth:true,
        
      }
    },
    {
      path: '/create',
      name: 'create',
      component: PostsCreate,
      meta: {
        auth:true,
        
      },
    },
    {
      path: '/edit/:kode_tertentu',
      name: 'edit',
      component: PostsEdit,
      meta: {
        auth:true,
        
      }
    },   
    {
      //calls
      path: '/calls',
      name: 'calls',
      component: callsIndex,
      meta: {
        auth:true,
        
      }
    },
    {
      path: '/callscreate',
      name: 'callscreate',
      component: callsCreate,
      meta: {
        auth:true,
        
      }
    },
    {
      path: '/callscreateid',
      name: 'callscreateid',
      component: callsCreateid,
      meta: {
        auth:true,
        
      }
    },
    {
      path: '/callsEdit/:kode_telpon',
      name: 'callsEdit',
      component: callsEdit,
      
    },
    {
      //AUTH COMPONENT
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard
    },
    {      
      path: '/register',
      name: 'register',
      component: Register
    },
    
    
  ],
  mode: 'history'
});

router.beforeEach((to, from, next) => {
  // console.log(to);
  // console.log(localStorage.getItem('token'));
  // mengecek ada tidak meta auth di dalam meta
  if (to.matched.some(record => record.meta.auth)) {
    
    // cek di localstorage token
    if (localStorage.getItem('token') === 'undefined' || localStorage.getItem('token') === null) {
      next('/login');
    } else {
      // jika login auth maka cek adakah permission yang dibutuhkan, jika ada cek dulu permission
      // jika permission di dalam localstorage cocok dengan meta permission
      // langsung di next() jika tidak arahkan ke halaman 503
     next();
    }
  } else {
    next();
  }
});


new Vue({
  router,
  render: h => h(App),}).$mount('#app')