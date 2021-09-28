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
        GET_DEV_BY_SECTION(state, developments) {
            state.developments = developments;
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
        getDevBySection({commit}, {sel}) {
            Api.get(
                `/apiplatform/developments/section/${sel}`,
                (response) => {
                    console.log(response.data['hydra:member']);
                    commit('GET_DEV_BY_SECTION', response.data['hydra:member']);
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
