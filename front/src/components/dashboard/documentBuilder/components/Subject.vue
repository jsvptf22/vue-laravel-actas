<template>
  <div class="row">
    <div class="col-12">
      <div class="form-group">
        <label for="subject">Asunto</label>
        <input id="subject" type="text" class="form-control" v-model="subject" />
        <button v-on:click="change">change</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Subject",
  data: function() {
    return {
      subject: ""
    };
  },
  methods: {
    change() {
      this.$store.commit("refreshDocumentInformation", {
        subject: this.subject
      });
    }
  }
};
</script>