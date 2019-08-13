<template>
  <div class="container h-100">
    <div class="row justify-content-center d-flex align-items-center h-100">
      <div class="col-auto">
        <login />
      </div>
    </div>
  </div>
</template>

<script>
import Login from "./Login.vue";

export default {
  name: "PAccess",
  components: {
    Login
  },
  beforeRouteEnter(to, from, next) {
    if (localStorage.getItem("token")) {
      next(vm => {
        vm.$router.push("/dashboard");
      });
    } else {
      next();
    }
  }
};
</script>
