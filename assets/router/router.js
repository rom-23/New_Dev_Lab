import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    mode   : 'history',
    base   : process.env.BASE_URL,
    routes : [
        {
            path       : '/',
            name       : 'home',
            components : {
                main: () => {
                    return import('../components/Example');
                },
                submain: () => {
                    return import('../components/card');
                }
            }
        },
        {
            path       : '/app/modelism',
            name       : 'modelism',
            components : {
                main: () => {
                    return import('../components/modelism/Modelism');
                }
            }
        },
        {
            path       : '/app/users',
            name       : 'users',
            components : {
                main: () => {
                    return import('../components/user/UserCrud');
                }
            }
        },
        {
            path       : '/app/dev',
            name       : 'dev',
            components : {
                main: () => {
                    return import('../components/development/Development');
                }
            }
        }
        // {
        //     path     : '*',
        //     redirect : '/'
        // }
    ]
});
