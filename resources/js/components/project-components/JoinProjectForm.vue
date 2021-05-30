<template>
  <div class="content-join">
    <div class="join-logo">
      <img style="float: center" :src="RocketImg" alt="" />
    </div>

    <form action="#" @submit.prevent="joinProject" class="form-join">
      <h4>Join Project</h4>
      <div class="form-group">
        <p for="join-project">Project ID</p>
        <p for="join-project">{{ message }}</p>
        <input
          type="text"
          class="form-control"
          id="joinID"
          placeholder="input ID Project"
          v-model="projectMemberForm.project_id"
        />
      </div>

      <button type="submit" class="btn-join">
        <p>Join</p>
      </button>
      <button @click="backToHome" type="button" class="btn-close">
        <p>Close</p>
      </button>
    </form>
  </div>
</template>

<script>
import RocketImg from "../../../images/rocket.png";

export default {
  data() {
    return {
      RocketImg: RocketImg,
      message: "",
      projectMemberForm: {
        project_id: "",
      },
      token: localStorage.getItem("token"),
    };
  },
  props: ["user"],
  methods: {
    backToHome() {
      this.$emit("updateShowComponentProjectManagement", "project-card");
    },
    joinProject() {
      axios
        .post("api/project-member", this.projectMemberForm, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          if (response.data.status) {
            let projectId = response.data.projectId;
            this.$emit("updateProjectId", projectId);
            this.getProjects(this.user.id);
          } else {
            this.message = "You already the member of this project!";
          }
        });
    },
    getProjects(id) {
      axios
        .get(`api/user/${id}/projects`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          let projects = response.data.projects;

          this.$emit("updateProjects", projects);
          this.$emit("updateShowComponentJoinProject", "join-project-success");
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
