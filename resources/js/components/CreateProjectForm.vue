<template>
  <div class="content-create">
    <div class="create-logo">
      <img style="float: center" src="images/Group 254.png" alt="" />
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
          v-model="projectData.project_name"
        />
      </div>
      <div class="form-group">
        <p for="project-desc">Description Project</p>
        <input
          type="text"
          class="form-control"
          id="projectDesc"
          placeholder="input Description Project"
          v-model="projectData.project_desc"
        />
      </div>
      <button type="submit" class="btn-create">
        <p>Create</p>
      </button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      projectData: {
        project_name: "",
        project_desc: "",
      },
      message: "",
      token: localStorage.getItem("token"),
    };
  },
  props: ["showProjectComponent"],
  methods: {
    createProject() {
      axios
        .post("/api/project", this.projectData, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.message = response.data.message;
          this.showProjectComponent.showProjectForm = false;
          this.showProjectComponent.showProjectSuccess = true;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
