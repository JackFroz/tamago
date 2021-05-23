<template>
  <div class="content-home-bg">
    <div class="content-home">
      <div class="title-home">
        <p>My Project</p>
      </div>
      <div class="home-menu">
        <button class="btn-tamago" @click="showJoinProject">
          <p>Join Project</p>
        </button>
        <button class="btn-tamago2" @click="showCreateProject">
          <p>Create New Project</p>
        </button>
      </div>
    </div>
    <CreateProject v-if="showComponentProjectManagement === 'create-project'" />
    <JoinProject v-if="showComponentProjectManagement === 'join-project'" />
    <ProjectCard
      v-if="showComponentProjectManagement === 'project-card'"
      v-bind:projects="projects"
    />
  </div>
</template>

<script>
// @ is an alias to /src
import CreateProject from "./CreateProject.vue";
import JoinProject from "./JoinProject.vue";
import ProjectCard from "./ProjectCard.vue";

export default {
  components: {
    CreateProject,
    JoinProject,
    ProjectCard,
  },
  props: ["projects"],
  data() {
    return {
      showComponentProjectManagement: "project-card",
      tempProject: [],
      token: localStorage.getItem("token"),
    };
  },
  methods: {
    showCreateProject() {
      this.showComponentProjectManagement =
        this.showComponentProjectManagement !== "create-project"
          ? "create-project"
          : "project-card";
    },
    showJoinProject() {
      this.showComponentProjectManagement =
        this.showComponentProjectManagement !== "join-project"
          ? "join-project"
          : "project-card";
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
