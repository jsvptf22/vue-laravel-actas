<template>
  <div class="row d-flex justify-content-center pt-5">
    <div class="col-6">
      <div class="card card-default mb-0">
        <div class="card-header">
          <h4>Aprobación del documento</h4>
        </div>
        <div class="card-body">
          <input v-model="documentId" type="hidden" />
          <p>
            Los campos con
            <span class="bold text-danger" style="font-size:15px">*</span> son obligatorios
          </p>
          <div class="form-group form-group-default required">
            <label>Usuario</label>
            <input v-model="user" type="text" class="form-control" />
          </div>
          <div class="form-group form-group-default required">
            <label>Contraseña:</label>
            <input v-model="password" type="password" class="form-control" />
          </div>
        </div>
        <div class="card-footer">
          <button v-on:click="send(1)" class="btn btn-complete mr-3 float-right">Aprobar</button>
          <button v-on:click="send(0)" class="btn btn-danger mr-3 float-right">Rechazar</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "PLogin",
  data: function() {
    return {
      documentId: 0,
      user: "",
      password: ""
    };
  },
  methods: {
    send(approve) {
      this.$http
        .request({
          url: `${process.env.VUE_APP_MODULE_API_ROUTE}auth/externalApprobation`,
          method: "post",
          responseType: "json",
          data: {
            documentId: this.documentId,
            user: this.user,
            password: this.password,
            approve: approve
          }
        })
        .then(response => {
          if (response.data.success) {
            console.log(response);
          } else {
            alert("Error al guardar");
          }
        })
        .catch(response => {
          alert(response.message);
        });
    }
  }
};
</script>