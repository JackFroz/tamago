<template>
  <div class="content-home-bg">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <div class="content-home">
      <div class="title-home">
        <p>My Project</p>
      </div>
      <div class="home-menu">
        <button class="btn-tamago" @click="showJoinProject">
          <p><i class="fa fa-user-plus" aria-hidden="true"></i> Join Project</p>
        </button>
        <button class="btn-tamago2" @click="showCreateProject">
          <p>
            <i class="fa fa-plus" aria-hidden="true"></i> Create New Project
          </p>
        </button>
      </div>
    </div>
    <CreateProject
      v-if="showComponentProjectManagement === 'create-project'"
      v-bind:user="user"
      @updateProjects="updateProjects"
      @updateShowComponentProjectManagement="
        updateShowComponentProjectManagement
      "
    />
    <JoinProject
      v-if="showComponentProjectManagement === 'join-project'"
      v-bind:user="user"
      @updateProjects="updateProjects"
      @updateShowComponentProjectManagement="
        updateShowComponentProjectManagement
      "
    />
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
  props: ["projects", "user"],
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
    updateShowComponentProjectManagement(componentName) {
      this.showComponentProjectManagement = componentName;
    },
    updateProjects(projects) {
      this.$emit("updateProjects", projects);
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
