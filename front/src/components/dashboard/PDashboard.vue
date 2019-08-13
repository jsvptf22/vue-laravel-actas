<template>
  <div class="container h-100">
    <div class="row">
      <div class="col">
        <UserAutocomplete />
      </div>
    </div>
  </div>
</template>

<script>
import UserAutocomplete from "./../utils/UserAutocomplete.vue";

export default {
  name: "PDashboard",
  components: {
    UserAutocomplete
  }
};
</script>
