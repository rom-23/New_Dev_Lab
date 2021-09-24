import Api from '../../Api';

const models = {
    namespaced : true,
    state      : {
        models: []
    },
    mutations: {
        GET_MODELS(state, models) {
            state.models = models;
        },
        SET_MODEL(state, models) {
            state.models.push(models);
        }
    },
    actions: {
        getModels({commit}) {
            Api.get(
                '/api/all-models',
                (response) => {
                    console.log(response.data);
                    commit('GET_MODELS', response.data);
                }
            ).catch(error => {
                console.log(error.message);
            });
        },
        setModel({commit}, params) {
            Api.post(
                '/api/model/add',
                params,
                (response) => {
                    commit('SET_MODEL', response.data);
                }
            ).catch(error => {
                console.log(error.message);
            });
        }
    },
    getters: {
        allModels: state => {
            return state.models;
        }
    }
};
export default models;
