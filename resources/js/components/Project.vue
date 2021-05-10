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
      <CreateProject v-if="showCreateProject"/>
      <JoinProject v-if="showJoinProject" />
    </div>
</template>

<script>
// @ is an alias to /src
import CreateProject from "./CreateProject.vue";
import JoinProject from "./JoinProject.vue";

export default {
  data() {
    return {
      showCreateProject: false,
      showJoinProject: false,
      token: localStorage.getItem("token"),
    };
  },
  methods: {
    openCreateNewProject() {
      this.showCreateProject = !this.showCreateProject;
      if (this.showCreateProject) this.showJoinProject = false;
    },
    openJoinProject() {
      this.showJoinProject = !this.showJoinProject;
      if (this.showJoinProject) this.showCreateProject = false;
    },
  },
  components: {
    CreateProject,
    JoinProject,
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
