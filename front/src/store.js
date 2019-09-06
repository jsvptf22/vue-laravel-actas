import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        documentInformation: {
            documentId: 0,
            modalTitle: "",
            subject: "",
            topicList: [],
            topicListDescription: [],
            userList: []
        }
    },
    mutations: {
        refreshDocumentInformation(state, information) {
            state.documentInformation = { ...state.documentInformation, ...information };
        }
    }
})

export { store as default };