<template>
  <div class="content-home-bg">
    <div class="content-home">
      <div class="title-home">
        <p>My Project</p>
      </div>
      <div class="home-menu">
        <button class="btn-tamago" @click="openJoinProject">
          <p>Join Project</p>
        </button>
        <button class="btn-tamago2" @click="openCreateNewProject">
          <p>Create New Project</p>
        </button>
      </div>
    </div>
    <CreateProject v-if="showCreateProject" />
    <JoinProject v-if="showJoinProject" />
    <ProjectCard
      :tempProject="tempProject"
      @updateSelectedProject="updateSelectedProject"
      v-if="showProjectCard"
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
  data() {
    return {
      showCreateProject: false,
      showJoinProject: false,
      showProjectCard: true,
      tempProject: [],
      token: localStorage.getItem("token"),
    };
  },
  props: ["projects", "selectedProject"],
  methods: {
    openCreateNewProject() {
      this.showCreateProject = !this.showCreateProject;
      if (this.showCreateProject) {
        this.showJoinProject = false;
        this.showProjectCard = false;
      }

      if (!this.showCreateProject && !this.showJoinProject)
        this.showProjectCard = true;
    },
    openJoinProject() {
      this.showJoinProject = !this.showJoinProject;
      if (this.showJoinProject) {
        this.showCreateProject = false;
        this.showProjectCard = false;
      }

      if (!this.showCreateProject && !this.showJoinProject)
        this.showProjectCard = true;
    },
    updateSelectedProject(project) {
      this.tempProject = project;
      this.$emit("updateSelectedProject", project);
    },
  },
  components: {
    CreateProject,
    JoinProject,
    ProjectCard,
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
