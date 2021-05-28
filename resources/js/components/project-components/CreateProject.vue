<template>
  <div>
    <CreateProjectForm
      v-if="showComponentCreateProject === 'create-project-form'"
      @updateShowComponentCreateProject="updateShowComponentCreateProject"
      @updateProjectId="updateProjectId"
      @updateProjects="updateProjects"
    />
    <CreateProjectSuccess
      v-if="showComponentCreateProject === 'create-project-success'"
      v-bind:projectId="projectId"
    />
  </div>
</template>
<script>
import CreateProjectForm from "./CreateProjectForm.vue";
import CreateProjectSuccess from "./CreateProjectSuccess.vue";

export default {
  components: {
    CreateProjectForm,
    CreateProjectSuccess,
  },
  data() {
    return {
      projectId: "",
      showComponentCreateProject: "create-project-form",
    };
  },
  methods: {
    updateShowComponentCreateProject(componentName) {
      this.showComponentCreateProject = componentName;
    },
    updateProjectId(projectId) {
      this.projectId = projectId;
      console.log(this.projectId);
    },
    updateProjects() {
      this.$emit("updateProjects");
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
