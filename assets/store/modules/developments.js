import Api from '../../Api';

const developments = {
    namespaced : true,
    state      : {
        developments: []
    },
    mutations: {
        GET_DEV(state, developments) {
            state.developments = developments;
        },
        SET_DEV(state, developments) {
            state.developments.push(developments);
        }
    },
    actions: {
        getDevelopments({commit}) {
            Api.get(
                '/apiplatform/developments',
                (response) => {
                    console.log(response.data);
                    commit('GET_DEV', response.data['hydra:member']);
                }
            ).catch(error => {
                console.log(error.message);
            });
        },
        setDevelopment({commit}, params) {
            Api.post(
                '/api/model/add',
                params,
                (response) => {
                    commit('SET_DEV', response.data);
                }
            ).catch(error => {
                console.log(error.message);
            });
        }
    },
    getters: {
        allDevelopments: state => {
            return state.developments;
        }
    }
};
export default developments;
