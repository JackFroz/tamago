<template>
  <div class="content-create">
    <div class="create-logo">
      <img style="float: center" :src="RocketImg" alt="" />
    </div>

    <form action="#" @submit.prevent="createProject" class="form-create">
      <h4>Create New Project</h4>
      <div class="form-group">
        <p for="create-project-name">Project Name</p>
        <input
          type="text"
          class="form-control"
          id="projectName"
          placeholder="input Project Name"
          v-model="projectForm.project_name"
        />
      </div>
      <div class="form-group">
        <p for="project-desc">Description Project</p>
        <input
          type="text"
          class="form-control"
          id="projectDesc"
          placeholder="input Description Project"
          v-model="projectForm.project_desc"
        />
      </div>
      <button type="submit" class="btn-create">
        <p>Create</p>
      </button>
      <!-- <button @click="backToHome" type="button" class="btn-create">
        <p>Cancel</p>
      </button> -->
    </form>
  </div>
</template>

<script>
import RocketImg from "../../../images/rocket.png";

export default {
  data() {
    return {
      RocketImg: RocketImg,
      projectForm: {
        project_name: "",
        project_desc: "",
      },
      token: localStorage.getItem("token"),
    };
  },
  props: ["projectId"],
  methods: {
    backToHome() {
      this.$router.go();
    },
    createProject() {
      axios
        .post("api/project", this.projectForm, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          console.log(response.data);
          let projectId = response.data.projectId;

          this.$emit("updateProjectId", projectId);
          this.$emit("updateProjects");
          this.$emit(
            "updateShowComponentCreateProject",
            "create-project-success"
          );
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
