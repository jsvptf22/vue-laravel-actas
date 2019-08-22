<template>
  <div>
    <div class="row">
      <div class="col-auto">
        <div class="btn-group-vertical mr-2" role="group" aria-label="First group">
          <button type="button" class="btn btn-secondary">Validar asistentes</button>
          <button type="button" class="btn btn-secondary">Crear asunto</button>
          <button type="button" class="btn btn-secondary">Crear temas</button>
          <button type="button" class="btn btn-secondary">Desarrollo de tema</button>
        </div>
      </div>
      <div class="col">
        <div class="template p-5">
          <div class="row-fluid mb-5">
            <div class="col-12 text-center p-3">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut maiores libero officiis, maxime ut esse necessitatibus distinctio ad dolorem reprehenderit obcaecati ratione eum commodi! Modi possimus consequuntur aliquid rerum beatae!</p>
              <!--<UserAutocomplete />-->
            </div>
          </div>
          <div class="row-fluid">
            <div class="col-12 p-3">
              <textarea class="form-control" rows="10"></textarea>
              <!--<UserAutocomplete />-->
            </div>
          </div>
          <div class="row-fluid mt-5">
            <div class="col-12 text-center p-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt eveniet excepturi accusantium corrupti quae, sapiente aperiam quam vitae error quibusdam atque, at, iusto perferendis quas debitis quia voluptas nisi suscipit?
              <!--<UserAutocomplete />-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
//import UserAutocomplete from "./../../utils/UserAutocomplete.vue";

export default {
  name: "PDocumentBuilder",
  components: {
    //UserAutocomplete
  }
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