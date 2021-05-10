<template>
  <div>
    <JoinProjectForm
      v-if="showJoinProjectComponent.JoinProjectForm"
      v-bind:showJoinProjectComponent="showJoinProjectComponent"
      
    />
    <JoinProjectSuccess
      v-if="showJoinProjectComponent.JoinProjectSuccess"
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
      showJoinProjectComponent: {
        JoinProjectForm: true,
        JoinProjectSuccess: false,
      },
    };
  },
};
</script>
