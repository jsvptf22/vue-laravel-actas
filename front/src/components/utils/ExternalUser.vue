<template>
  <div>
    <b-modal
      v-model="lunchModal"
      ref="modal"
      title="Crear usuario"
      @show="resetModal"
      @hidden="hideModal"
      @ok="handleOk"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group label="Nombre" label-for="nameInput">
          <b-form-input id="nameInput" v-model="username  "></b-form-input>
        </b-form-group>
        <b-form-group label="Correo electrónico" label-for="emailInput">
          <b-form-input id="emailInput" v-model="email"></b-form-input>
        </b-form-group>
      </form>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: "ExternalUser",
  props: ["newUserName", "showModal"],
  data() {
    return {
      lunchModal: this.showModal,
      username: this.newUserName,
      email: ""
    };
  },
  methods: {
    hideModal() {
      this.lunchModal = false;
      this.resetModal();
      this.$emit("toggleModal", this.lunchModal);
    },
    resetModal() {
      this.name = "";
      this.email = "";
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      if(bvModalEvt.preventDefault()){
        alert('validar');
        return;
      }
      
      this.$nextTick(() => {
        this.$refs.modal.hide();
      });
    }
  }
};
</script>
