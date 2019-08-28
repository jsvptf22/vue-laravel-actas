import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        documentInformation: {}
    },
    mutations: {
        refreshDocumentInformation(state, information) {
            state.documentInformation = information;
        }
    }
})

export { store as default };