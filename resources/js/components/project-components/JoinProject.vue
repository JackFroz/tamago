<template>
  <div>
    <JoinProjectForm
      v-if="showComponentJoinProject === 'join-project-form'"
      v-bind:user="user"
      @updateShowComponentProjectManagement="
        updateShowComponentProjectManagement
      "
      @updateShowComponentJoinProject="updateShowComponentJoinProject"
      @updateProjectId="updateProjectId"
      @updateProjects="updateProjects"
    />
    <JoinProjectSuccess
      v-if="showComponentJoinProject === 'join-project-success'"
      @updateShowComponentProjectManagement="
        updateShowComponentProjectManagement
      "
      v-bind:projectId="projectId"
    />
  </div>
</template>
<script>
import JoinProjectForm from "./JoinProjectForm.vue";
import JoinProjectSuccess from "./JoinProjectSuccess.vue";

export default {
  components: {
    JoinProjectForm,
    JoinProjectSuccess,
  },
  data() {
    return {
      projectId: "",
      showComponentJoinProject: "join-project-form",
    };
  },
  props: ["user"],
  methods: {
    updateShowComponentJoinProject(componentName) {
      this.showComponentJoinProject = componentName;
    },
    updateShowComponentProjectManagement(componentName) {
      this.$emit("updateShowComponentProjectManagement", componentName)
    },
    updateProjectId(projectId) {
      this.projectId = projectId;
    },
    updateProjects(project) {
      this.$emit("updateProjects", project)
    }
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>