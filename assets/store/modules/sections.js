import Api from '../../Api';

const sections = {
    namespaced : true,
    state      : {
        sections: []
    },
    mutations: {
        GET_SECTIONS(state, sections) {
            state.sections = sections;
        },
        SET_SECTION(state, sections) {
            state.sections.push(sections);
        }
    },
    actions: {
        getSections({commit}) {
            Api.get(
                '/apiplatform/sections',
                (response) => {
                    console.log(response.data);
                    commit('GET_SECTIONS', response.data['hydra:member']);
                }
            ).catch(error => {
                console.log(error.message);
            });
        }
    },
    getters: {
        allSections: state => {
            return state.sections;
        }
    }
};
export default sections;
