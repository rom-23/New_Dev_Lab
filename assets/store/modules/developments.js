import Api from '../../Api';

const developments = {
    namespaced : true,
    state      : {
        developments : [],
        documents    : []
    },
    mutations: {
        GET_DEV(state, developments) {
            state.developments = developments;
        },
        GET_DEV_BY_SECTION(state, developments) {
            state.developments = developments;
        },
        SET_DEV(state, documents) {
            state.documents.push(documents);
        }
    },
    actions: {
        getDevelopments({commit}) {
            Api.get(
                '/apiplatform/developments',
                (response) => {
                    // console.log(response.data);
                    commit('GET_DEV', response.data);
                }
            ).catch(error => {
                console.log(error.message);
            });
        },
        getDevBySection({commit}, {sel}) {
            Api.get(
                `/apiplatform/developments/section/${sel}`,
                (response) => {
                    // console.log(response.data);
                    commit('GET_DEV_BY_SECTION', response.data);
                }
            ).catch(error => {
                console.log(error.message);
            });
        },
        setDevelopmentDocument({commit}, params) {
            let file = params.get('file');
            let id = params.get('id');

            // console.log(params.get('id'));
            // console.log(params.get('file'));

            Api.post(
                `/apiplatform/developments/${id}/document`, {
                    file
                },
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                },
                (response) => {
                // console.log(response.data);
                    commit('SET_DEV', response.data);
                }
            ).
                catch(error => {
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
