<template>
  <div class="content-create">
    <div class="create-logo">
      <img style="float: center" src="images/Group 254.png" alt="" />
    </div>

    <div class="form-create-success">
      <form action="#" @submit.prevent="done" class="form-create">
        <h4>Project Successfully Created!</h4>
        <div class="form-group-success">
          <p>Project ID : {{ projectId }}</p>
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
  props: ["projectId"],
  methods: {
    done() {
      this.$router.go();
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
