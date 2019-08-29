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
        }
    },
    mutations: {
        refreshDocumentInformation(state, information) {
            state.documentInformation = { ...state.documentInformation, ...information };
        }
    }
})

export { store as default };