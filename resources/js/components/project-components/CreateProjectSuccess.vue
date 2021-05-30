<template>
  <div class="content-create">
    <div class="create-logo">
      <img style="float: center" :src="RocketImg" alt="" />
    </div>

    <div class="form-create-success">
      <form action="#" @submit.prevent="done" class="form-create">
        <h4>Project Successfully Created!</h4>
        <div class="form-group-success">
          <div class="form-group-success-top">
            <p>Nama Project</p>
          </div>
          <p>Project ID : {{ projectId }}</p>
        </div>
        <button @click="done" type="submit" class="btn-join">
          <p>Done</p>
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import RocketImg from "../../../images/rocket.png";

export default {
  data(){
    return {
      RocketImg: RocketImg
    };
  },
  props: ["projectId"],
  methods: {
    done() {
      this.$emit("updateShowComponentProjectManagement", "project-card");
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
