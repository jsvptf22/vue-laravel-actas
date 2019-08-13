<template>
  <div class="row">
    <div class="col-12">
      <multiselect
        v-model="usersSelected"
        tag-placeholder="Add this as new tag"
        placeholder="Search or add a tag"
        label="name"
        track-by="code"
        :options="userList"
        :multiple="true"
        :taggable="true"
        @tag="addTag"
        @search-change="findUsers"
      ></multiselect>
    </div>
    <div>{{JSON.stringify(userList)}}</div>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";

export default {
  name: "UserAutocomplete",
  components: { Multiselect },
  data: function() {
    return {
      userList: [],
      usersSelected: [],
      isLoading: false
    };
  },
  methods: {
    addTag(newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000)
      };
      this.usersSelected.push(tag);
    },
    findUsers(query) {
      console.log(query);

      let list = [
        { name: "aa1", id: 1 },
        { name: "aa2", id: 2 },
        { name: "aa3", id: 3 },
        { name: "aa4", id: 4 },
        { name: "aa5", id: 5 },
        { name: "aa6", id: 6 },
        { name: "aa7", id: 7 }
      ];

      this.userList = list.filter(f => f.name.indexOf(query) != -1);
      console.log(this.userList);
    }
  }
};
</script>
<style src="../../../node_modules/vue-multiselect/dist/vue-multiselect.min.css"></style>

