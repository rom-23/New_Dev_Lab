import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    mode   : 'history',
    base   : process.env.BASE_URL,
    routes : [
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
            }
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
            }
        }
        // {
        //     path     : '*',
        //     redirect : '/'
        // }
    ]
});
