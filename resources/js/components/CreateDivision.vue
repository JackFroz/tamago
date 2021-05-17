<template>
  <div class="create-div">
    <div class="content-create">
      <div class="create-logo">
        <img style="float: center" src="images/folder 1.png" alt="" />
      </div>

      <form action="#" @submit.prevent="createDivision" class="form-create">
        <h4>Create New Division</h4>
        <div class="form-group">
          <p for="create-project-name">Division Name</p>
          <input
            type="text"
            class="form-control"
            id="projectName"
            placeholder="input Division Name"
            v-model="divisionData.division_name"
          />
        </div>
        <p for="create-project-name">{{ message }}</p>
        <button type="submit" class="btn-create">
          <p>Create</p>
        </button>
      </form>
    </div>
    <!-- End Sidebar -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      token: localStorage.getItem("token"),
      divisionData: {
        project_id: this.selectedProject.project_id,
        division_name: "",
        division_desc: "",
      },
      message: "",
    };
  },
  props: ["selectedProject"],
  methods: {
    createDivision() {
      axios
        .post("api/project-division", this.divisionData, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
            this.message = "Division created!";
        });
    },
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
