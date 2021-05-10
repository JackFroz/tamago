<template>
  <div class="content-join">
    <div class="join-logo">
      <img style="float: center" src="images/Group 254.png" alt="" />
    </div>

    <form action="#" @submit.prevent="joinProject" class="form-join">
      <h4>Join Project</h4>
      <div class="form-group">
        <p for="join-project">Project ID</p>
        <input
          type="text"
          class="form-control"
          id="joinID"
          placeholder="input ID Project"
          v-model="projectMemberData.project_id"
        />
        <p for="join-project">{{ message }}</p>
      </div>

      <button type="submit" class="btn-join">
        <p>Join</p>
      </button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: "",
      projectMemberData: {
        project_id: "",
      },
      token: localStorage.getItem("token"),
    };
  },
  props: ["showJoinProjectComponent"],
  methods: {
    joinProject() {
      axios
        .post("/api/project-member", this.projectMemberData, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          if (!response.data.status) {
            this.message = response.data.message;
          } else {
            this.showJoinProjectComponent.JoinProjectForm = false;
            this.showJoinProjectComponent.JoinProjectSuccess = true;
          }
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
