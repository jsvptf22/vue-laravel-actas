import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        documentInformation: {
            modalTitle: '',
            documentId: 0,
            identificator: 0,
            initialDate: '',
            finalDate: '',
            subject: '',
            topicList: [],
            topicListDescription: [],
            userList: [],
            roles: {}
        }
    },
    mutations: {
        refreshDocumentInformation(state, information) {
            state.documentInformation = {
                ...state.documentInformation,
                ...information
            };
        }
    }
});

export { store as default };
