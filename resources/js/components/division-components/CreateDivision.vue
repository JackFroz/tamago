<template>
  <div class="create-div">
    <div class="content-create">
      <div class="create-logo">
        <img style="float: center" src="images/folder 1.png" alt="" />
      </div>

      <div class="form-create">
        <h4>Create New Division</h4>
        <div class="form-group">
          <p for="create-project-name">{{ message }}</p>
          <p for="create-project-name">Division Name</p>
          <input
            type="text"
            class="form-control"
            id="projectName"
            placeholder="input Division Name"
            v-model="divisionForm.division_name"
          />
        </div>
        <button @click="createDivision" type="button" class="btn-create">
          <p>Create</p>
        </button>
        <!-- <button @click="backToDivisionCards" type="button" class="btn-create">
          <p>Cancel</p>
        </button> -->
      </div>
    </div>
    <!-- End Sidebar -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      token: localStorage.getItem("token"),
      divisionForm: {
        project_id: this.project.project_id,
        division_name: "",
        division_desc: "",
      },
      message: "",
    };
  },
  props: ["project"],
  methods: {
    backToDivisionCards() {
      this.$emit("updateShowComponentProjectBoard", "division-card");
    },
    createDivision() {
      axios
        .post("api/project-division", this.divisionForm, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          let divisionId = response.data.divisionId;
          this.createLists(divisionId, "TO DO", 0);
          this.createLists(divisionId, "In Progress", 1);
          this.createLists(divisionId, "Ready", 2);
          this.createLists(divisionId, "Complete", 3);
          if (!response.data.status)
            this.message = "Failed to create division!";
          else this.$router.go();
        });
    },
    createLists(divisionId, listName, order) {
      axios.post(
        "api/progress-list",
        { list_name: listName, division_id: divisionId, order: order },
        {
          headers: { Authorization: "Bearer " + this.token },
        }
      );
    },
    updateDivisions() {
      axios
        .get(`api/project/${this.project.project_id}/project-divisions`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.divisions = response.data;
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
