<template>
  <div>
    <div class="content-join-success">
      <div class="join-logo-success">
        <img style=" float: center" :src="RocketImg" alt="" />
      </div>

      <div class="form-join-success">
        <h4>Successfully Joined The Project</h4>
        <div class="form-group-success">
          <div class="form-group-success-top">
            <p>Nama project</p>
          </div>
          <p>Project ID : {{ projectId }}</p>
        </div>
        <button @click="done" type="submit" class="btn-join-success">
          <p>Done</p>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import RocketImg from "../../../images/rocket.png";

export default {
  data() {
    return {
      RocketImg: RocketImg,
    };
  },
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
