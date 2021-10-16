import Api from '../../Api';
import axios from 'axios';
axios.defaults.withCredentials = true;

const auth = {
    namespaced : true,
    state      : {
        user: null
    },
    mutations: {
        setUser(state, username) {
            state.user = username;
        },
        LogOut(state) {
            state.user = null;
        }
    },
    actions: {
        LogIn({commit}, params) {
            Api.post(
                '/apiplatform/login', {
                    'username' : params.username,
                    'password' : params.password
                },
                (response) => {
                    console.log(response.data);
                    commit('setUser', params.username);
                }
            ).catch(error => {
                console.log(error.message);
            });
        },
        LogOut({commit}) {
            Api.post('/logout', {},
                () => {
                    let user = null;
                    commit('LogOut', user);
                }
            ).catch(error => {
                console.log(error.message);
            });
        }
    },
    getters: {
        isAuthenticated : state => { return !!state.user; },
        StateUser       : state => { return state.user; }
    }
};
export default auth;
