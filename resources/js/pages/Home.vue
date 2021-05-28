<template>
  <div>
    <Sidenav />
    <div class="main">
      <!--Header-->
      <div class="fixed-top judul-page">
        <p class="top-bar">
          Home
        </p>
      </div>
      <ProjectManagement v-bind:projects="projects" @updateProjects="updateProjects" />
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Sidenav from "../components/Sidenav.vue"
import ProjectManagement from "../components/project-components/ProjectManagement.vue";

export default {
  components: {
    Sidenav,
    ProjectManagement,
  },
  props: [],
  data() {
    return {
      projects: [],
      token: localStorage.getItem("token"),
    };
  },
  methods: {
    requestProjects() {
      axios
        .get("http://localhost/api/user", {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.getProjects(response.data.user.id);
        });
    },
    getProjects(id) {
      axios
        .get(`http://localhost/api/user/${id}/projects`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.projects = response.data.projects;
        });
    },
  },
  updateProjects() {
    this.getProjects();
  },
  created() {
    this.requestProjects();
  },
};
</script>

<style lang="css">
@import "../../css/app.css";
</style>
