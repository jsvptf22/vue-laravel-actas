<template>
  <div>
    <div class="row">
      <div class="col-auto">
        <div class="btn-group-vertical mr-2" role="group" aria-label="First group">
          <button
            type="button"
            class="btn btn-secondary"
            v-on:click="showModal(1)"
          >Validar asistentes</button>
          <button type="button" class="btn btn-secondary" v-on:click="showModal(2)">Crear asunto</button>
          <button type="button" class="btn btn-secondary" v-on:click="showModal(3)">Crear temas</button>
          <button
            type="button"
            class="btn btn-secondary"
            v-on:click="showModal(4)"
          >Desarrollo de tema</button>
        </div>
      </div>
      <div class="col">
        <div class="template p-5">
          <div class="row-fluid mb-5">
            <div class="col-12 text-center p-3">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut maiores libero officiis, maxime ut esse necessitatibus distinctio ad dolorem reprehenderit obcaecati ratione eum commodi! Modi possimus consequuntur aliquid rerum beatae!</p>
            </div>
          </div>
          <div class="row-fluid">
            <div class="col-12 p-3">
              <span v-if="documentInformation.subject">Asunto :{{ documentInformation.subject }}</span>
              <!--<textarea class="form-control" rows="10"></textarea>-->
            </div>
          </div>
          <div class="row-fluid mt-5">
            <div
              class="col-12 text-center p-3"
            >Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt eveniet excepturi accusantium corrupti quae, sapiente aperiam quam vitae error quibusdam atque, at, iusto perferendis quas debitis quia voluptas nisi suscipit?</div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <b-modal id="componentModal" ref="modal" title="Crear usuario">
          <router-view></router-view>
        </b-modal>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  name: "PDocumentBuilder",
  methods: {
    showModal(type) {
      switch (type) {
        case 1:
          this.$router.push("/users");
          break;
        case 2:
          this.$router.push("/subject");
          break;
        case 3:
          this.$router.push("/topics");
          break;
        case 4:
          this.$router.push("/topic");
          break;
      }
      this.$bvModal.show("componentModal");
    }
  },
  computed: mapState(["documentInformation"])
};
</script>

<style>
.template {
  border: 1px solid #cacaca;
  margin-bottom: 8px;
  box-shadow: 2px 2px 8px #c6c6c6;
  height: 100%;
}
</style>