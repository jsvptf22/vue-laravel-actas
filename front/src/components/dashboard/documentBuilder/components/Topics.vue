<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="input-group mb-3">
          <input
            v-model="topic"
            type="text"
            class="form-control"
            placeholder="Nombre del tema"
            aria-describedby="button-addon2"
          />
          <div class="input-group-append">
            <button
              class="btn btn-secondary"
              type="button"
              id="button-addon2"
              v-on:click="save"
            >Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <ul v-if="topicList.length">
          <li v-for="topic of topicList" v-bind:key="topic.id">{{topic.label}}</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Topics",
  data: function() {
    return {
      topic: "",
      topicList: []
    };
  },
  methods: {
    save() {
      let item = {
        id: Math.round(Math.random() * 1000),
        label: this.topic
      };
      this.topicList.push(item);
      this.topic = "";
    }
  }
};
</script>