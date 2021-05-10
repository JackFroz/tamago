<template>
  <div class="main">
    <!--Header-->
    <div class="fixed-top judul-page">
      <p class="top-bar">
        Home
      </p>
    </div>
    <!--iterasi-->
    <!-- <ul>
      <li v-for="item in projects" :key="item.project_id">
        {{ item.project_name }}
      </li>
    </ul> -->
    <!--iterasi-->
    <Project v-bind:projects="projects"/>
  </div>
</template>

<script>
// @ is an alias to /src
import Project from "./Project.vue";

export default {
  components: {
    Project,
  },
  props: ["projects"],
  data() {
    return {
      token: localStorage.getItem("token"),
    };
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
