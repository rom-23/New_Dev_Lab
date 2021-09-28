import Api from '../../Api';

const users = {
    namespaced : true,
    state      : {
        users: []
    },
    mutations: {
        GET_USERS(state, users) {
            state.users = users;
        },
        SET_USER(state, users) {
            state.users.push(users);
        }
    },
    actions: {
        getUsers({commit}) {
            Api.get(
                '/api/all-users',
                (response) => {
                    // console.log(response.data);
                    commit('GET_USERS', response.data);
                }
            ).catch(error => {
                console.log(error.message);
            });
        },
        setUser({commit}, params) {
            Api.post(
                '/api/users/add', {
                    params
                },
                (response) => {
                    commit('SET_USER', response.data);
                }
            ).catch(error => {
                console.log(error.message);
            });
        }
    },
    getters: {
        allUsers: state => {
            return state.users;
        }
    }
};
export default users;
