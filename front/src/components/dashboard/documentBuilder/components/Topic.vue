<template>
  <div class="row">
    <div class="col-12">
      <div class="form-group">
        <label class="typo__label">Listado de temas</label>
        <multiselect
          v-model="value"
          track-by="name"
          label="name"
          placeholder="Selecciona un tema"
          :options="options"
          :searchable="false"
          :allow-empty="false"
        ></multiselect>
      </div>
      <div class="form-gr">
        <label for>Desarrollo</label>
        <textarea rows="10" class="form-control"></textarea>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";
export default {
  name: "Topic",
  components: { Multiselect },
  data: function() {
    return {
      value: null,
      options: [
        { name: "Vue.js", id: 1 },
        { name: "Rails", id: 2 },
        { name: "Sinatra", id: 3 },
        { name: "Laravel", id: 4 },
        { name: "Phoenix", id: 5 }
      ]
    };
  }
};
</script>
<style src="../../../../../node_modules/vue-multiselect/dist/vue-multiselect.min.css"></style>