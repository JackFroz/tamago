<template>
  <div class="content-create">
    <div class="create-logo">
      <img style="float: center" src="images/Group 254.png" alt="" />
    </div>

    <div class="form-create-success">
      <form action="#" @submit.prevent="done" class="form-create">
        <h4>Project Successfully Created!</h4>
        <div class="form-group-success">
          <p>Project ID : 123456</p>
          <div class="form-group-success-top">
            <p>Nama Project</p>
          </div>
        </div>
        <button type="submit" class="btn-join">
          <p>Done</p>
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    done() {
      this.$router.push("dashboard");
    },
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
