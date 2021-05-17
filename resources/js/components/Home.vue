<template>
  <div class="main">
    <!--Header-->
    <div class="fixed-top judul-page">
      <p class="top-bar">
        Home
      </p>
    </div>
    <Project
      :selectedProject="selectedProject"
      @updateSelectedProject="updateSelectedProject"
      v-if="!isProjectSelected"
      v-bind:projects="projects"
    />
    <ProjectBoard
      v-if="isProjectSelected"
      v-bind:selectedProject="selectedProject"
    />
  </div>
</template>

<script>
// @ is an alias to /src
import Project from "./Project.vue";
import ProjectBoard from "./ProjectBoard.vue";

export default {
  components: {
    Project,
    ProjectBoard,
  },
  props: ["projects"],
  data() {
    return {
      token: localStorage.getItem("token"),
      selectedProject: [],
      isProjectSelected: false,
    };
  },
  methods: {
    updateSelectedProject(project) {
      this.selectedProject = project;
      this.isProjectSelected = true;
    },
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
