<template>
  <div class="row">
    <div class="col-12">
      <multiselect
        v-model="usersSelected"
        placeholder="Search or add a tag"
        label="name"
        track-by="id"
        tagPlaceholder="Click para crear funcionario"
        selectLabel=" "
        :loading="loading"
        :options="userList"
        :multiple="true"
        :taggable="true"
        :value="Array"
        :hideSelected="true"
        @tag="addTag"
        @search-change="findUsers"
      ></multiselect>
    </div>
    <div>{{JSON.stringify(usersSelected)}}</div>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";
const axios = require("axios");
export default {
  name: "UserAutocomplete",
  components: { Multiselect },
  data: function() {
    return {
      userList: [],
      usersSelected: [],
      loading: false
    };
  },
  methods: {
    addTag(newTag) {
      const tag = {
        name: newTag,
        id: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000)
      };
      this.usersSelected.push(tag);
      alert("mostrar ventana modal");
    },
    findUsers(query) {
      this.loading = true;

      const ENVDATA = process.env;
      axios
        .request({
          url: `${ENVDATA.VUE_APP_MODULE_API_ROUTE}user/autocomplete`,
          method: "get",
          responseType: "json",
          params: {
            query
          },
          headers: {
            Authorization: localStorage.getItem("token")
          }
        })
        .then(response => {
          this.userList = response.data ? response.data : [];
          this.loading = false;
        })
        .catch(response => {
          alert(response.message);
          this.loading = false;
        });
    }
  }
};
</script>
<style src="../../../node_modules/vue-multiselect/dist/vue-multiselect.min.css"></style>

