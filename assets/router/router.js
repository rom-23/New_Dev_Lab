import Vue from 'vue';
import Router from 'vue-router';
import store from '../store';
Vue.use(Router);
const routes = [
    {
        path       : '/app/vue-js',
        name       : 'home',
        components : {
            main: () => {
                return import('../components/Home');
            }
            // submain: () => {
            //     return import('../components/card');
            // }
        }
    },
    {
        path       : '/app/vue-js/modelism',
        name       : 'modelism',
        components : {
            main: () => {
                return import('../components/modelism/Modelism');
            }
        }
    },
    {
        path       : '/app/vue-js/users',
        name       : 'users',
        components : {
            main: () => {
                return import('../components/user/UserCrud');
            }
        },
        meta: {requiresAuth: true}
    },
    {
        path       : '/app/vue-js/dev',
        name       : 'dev',
        components : {
            main: () => {
                return import('../components/development/Development');
            }
        }
    },
    {
        path       : '/app/vue-js/dev/login',
        name       : 'dev_login',
        components : {
            main: () => {
                return import('../components/auth/Login');
            }
        },
        meta: { guest: true }
    },
    {
        path       : '/app/vue-js/dev/register',
        name       : 'dev_register',
        components : {
            main: () => {
                return import('../components/auth/Register');
            }
        }
    }
    // {
    //     path     : '*',
    //     redirect : '/'
    // }
];
const router = new Router({
    mode : 'history',
    // mode : 'hash',
    base : process.env.BASE_URL,
    routes
});
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => { return record.meta.requiresAuth; })) {
        if (!store.getters['auth/isAuthenticated']) {
            next({
                path: '/app/vue-js/dev/login'
                // query : { nextUrl: to.fullPath }
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

// router.beforeEach((to, from, next) => {
//     if (to.matched.some((record) => { return record.meta.guest; })) {
//         if (store.getters['auth/isAuthenticated']) {
//             next('/app/vue-js/dev'
//             );
//             return;
//         }
//         next();
//     } else {
//         next();
//     }
// });

export default router;
