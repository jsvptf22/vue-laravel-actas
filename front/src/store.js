import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        documentInformation: {
            modalTitle: "",
            subject: "",
            topicList: [],
            topicListDescription: []
        },
        newUser: {}
    },
    mutations: {
        refreshDocumentInformation(state, information) {
            state.documentInformation = { ...state.documentInformation, ...information };
        },
        createNewExternalUser(state, data) {
            state.newUser = data;
        }
    }
})

export { store as default };