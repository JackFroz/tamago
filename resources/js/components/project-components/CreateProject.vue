<template>
  <div>
    <CreateProjectForm
      v-if="showComponentCreateProject === 'create-project-form'"
      v-bind:user="user"
      @updateShowComponentProjectManagement="
        updateShowComponentProjectManagement
      "
      @updateShowComponentCreateProject="updateShowComponentCreateProject"
      @updateProjectId="updateProjectId"
      @updateProjects="updateProjects"
    />
    <CreateProjectSuccess
      @updateShowComponentProjectManagement="
        updateShowComponentProjectManagement
      "
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
  props: ["user"],
  methods: {
    updateShowComponentCreateProject(componentName) {
      this.showComponentCreateProject = componentName;
    },
    updateProjectId(projectId) {
      this.projectId = projectId;
      console.log(this.projectId);
    },
    updateProjects(projects) {
      this.$emit("updateProjects", projects);
    },
    updateShowComponentProjectManagement(componentName) {
      this.$emit("updateShowComponentProjectManagement", componentName);
    }
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
