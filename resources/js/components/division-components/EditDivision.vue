<template>
  <div class="content-edit-project">
    <div class="row">
      <div class="col-1">
        <div class="edit-logo">
          <img :src="RocketImg" alt="" style="float: center" />
        </div>
      </div>
      <div class="col-4">
        <div class="form-create">
          <h4>Edit Division</h4>
          <p>{{ message }}</p>
          <div class="form-group">
            <p for="edit-project-name">{{ division.division_name }}</p>
            <input
              type="text"
              class="form-control"
              id="projectName"
              v-model="divisionForm.division_name"
            />
            <br />
            <p for="edit-project-name">Division Description</p>
            <input
              type="text"
              class="form-control"
              id="projectDesc"
              v-model="divisionForm.division_desc"
            />
          </div>
          <button
            @click="updateDivisionDetail"
            type="button"
            class="btn-profile"
          >
            <p>Save Changes</p>
          </button>
          <button
            @click="backToDivisionCards"
            type="button"
            class="btn-profile"
          >
            <p>Exit</p>
          </button>
          <button @click="deleteDivision" type="button" class="btn-profile">
            <p>Delete</p>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import RocketImg from "../../../images/rocket.png";

export default {
  data() {
    return {
      RocketImg: RocketImg,
      message: "",
      divisionForm: {
        division_name: this.division.division_name,
        division_desc: this.division.division_desc,
        _method: "patch",
      },
      token: localStorage.getItem("token"),
    };
  },
  props: ["division"],
  methods: {
    backToDivisionCards() {
      this.$emit("updateShowComponentProjectBoard", "division-card");
    },
    updateDivisionDetail() {
      axios
        .patch(
          `api/project-division/${this.division.division_id}`,
          this.divisionForm,
          {
            headers: { Authorization: "Bearer " + this.token },
          }
        )
        .then((response) => {
          if (!response.data.status) this.message = "Failed to edit division!";
          else this.$router.go();
        });
    },
    deleteDivision() {
      axios
        .post(
          `api/project-division/${this.division.division_id}`,
          { _method: "delete" },
          {
            headers: { Authorization: "Bearer " + this.token },
          }
        )
        .then((response) => {
          if (!response.data.status)
            this.message = "Failed to delete division!";
          else this.$router.go();
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
