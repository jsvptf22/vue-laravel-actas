<template>
  <div class="card">
    <div class="card-body">
      <form @submit="submit">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input
            type="email"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter email"
            required
            v-model="email"
          />
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input
            type="password"
            class="form-control"
            id="exampleInputPassword1"
            placeholder="Password"
            required
            v-model="password"
          />
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" />
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
const axios = require("axios");

export default {
  name: "Login",
  data: function() {
    return {
      email: "",
      password: ""
    };
  },
  methods: {
    submit(e) {
      e.preventDefault();
      const ENVDATA = process.env;

      axios
        .request({
          url: `${ENVDATA.VUE_APP_MODULE_API_ROUTE}auth/login`,
          method: "post",
          responseType: "json",
          data: {
            email: this.email,
            password: this.password
          }
        })
        .then(response => {
          localStorage.setItem("token", "Bearer " + response.data.access_token);
          this.$router.push("/dashboard");
        })
        .catch(response => {
          alert(response.message);
        });
    }
  }
};
</script>

