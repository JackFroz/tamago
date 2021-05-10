<template>
  <div>
    <CreateProjectForm
      v-if="showProjectComponent.showProjectForm"
      v-bind:showProjectComponent="showProjectComponent"
      
    />
    <CreateProjectSuccess
      v-if="showProjectComponent.showProjectSuccess"
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
      showProjectComponent: {
        showProjectForm: true,
        showProjectSuccess: false,
      },
    };
  },
};
</script>
