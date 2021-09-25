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
                    // console.log(response.data[0].categories);
                    // let modelCategories = [];
                    // let json = response.data[0].categories;
                    // json.forEach(function (obj) {
                    //     modelCategories.push(obj.name);
                    // });
                    // console.log(modelCategories);
                    // commit('GET_CATEGORIES', modelCategories);
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
        // modelCategories: state => { // utiliser plugins !!!!!!
        //     let model = state.models;
        //     let categories = {'category': state.categories.toString()};
        //     // model.category = state.categories.toString();
        //     // let merged = {...model, ...categories};
        //     let combined1 = [].concat(model, categories);
        //     console.log(combined1);
        //     return combined1;
        // }
    }
};
export default models;
