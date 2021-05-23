<template>
  <div>
    <JoinProjectForm
      v-if="showComponentJoinProject === 'join-project-form'"
      @updateShowComponentJoinProject="updateShowComponentJoinProject"
      @updateProjectId="updateProjectId"
    />
    <JoinProjectSuccess
      v-if="showComponentJoinProject === 'join-project-success'"
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
  methods: {
    updateShowComponentJoinProject(componentName) {
      this.showComponentJoinProject = componentName;
    },
    updateProjectId(projectId) {
      this.projectId = projectId;
    },
  },
};
</script>
