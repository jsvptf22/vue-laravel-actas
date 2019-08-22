<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <button class="btn btn-danger" v-on:click="logout">Cerrar sesión</button>
        <button class="btn btn-primary" v-on:click="createDocument">Crear Documento</button>
      </div>
    </div>
    <div class="row pt-2">
      <div class="col-12">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PDashboard",
  methods: {
    logout() {
      this.$session.destroy();
      this.$router.push("/access");
    },
    createDocument() {
      this.$router.push("/document");
    }
  }
};
</script>