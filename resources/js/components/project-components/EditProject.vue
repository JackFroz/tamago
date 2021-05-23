<template>
  <div class="content-edit-project">
    <div class="row">
      <div class="col-1">
        <div class="edit-logo">
          <img src="images/Group 254.png" alt="" style="float: center" />
        </div>
      </div>
      <div class="col-4">
        <div class="form-create">
          <h4>Edit Project</h4>
          <p>{{ message }}</p>
          <div class="form-group">
            <p for="edit-project-name">{{ project.project_name }}</p>
            <input
              type="text"
              class="form-control"
              id="projectName"
              v-model="projectForm.project_name"
            />
            <br />
            <p for="edit-project-name">Project Description</p>
            <input
              type="text"
              class="form-control"
              id="projectDesc"
              v-model="projectForm.project_desc"
            />
          </div>
          <button
            @click="updateProjectDetail"
            type="button"
            class="btn-profile"
          >
            <p>Save Changes</p>
          </button>
          <br />
          <br />
          <div class="assign-role">
            <h4>Assign Division</h4>
            <div
              class="row"
              v-for="(member, index) in members"
              :key="member.member_id"
            >
              <div class="col-7">
                <p>{{ member.username }}</p>
              </div>
              <div class="col-5">
                <div class="role-option" style="float: center">
                  <select v-model="divisionId[index]" name="role" id="roles">
                    <option
                      :value="null"
                      :selected="member.division_id === null"
                    >
                      not assigned
                    </option>
                    <option
                      :value="division.division_id"
                      v-for="division in divisions"
                      :key="division.division_id"
                      :selected="member.division_id === division.division_id"
                    >
                      {{ division.division_name }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-7">
                <button
                  @click="assignDivision(member.member_id, divisionId[index])"
                  type="button"
                  class="btn-profile"
                >
                  <p>Assign Division</p>
                </button>
              </div>
            </div>

            <button
              @click="backToDivisionCards"
              type="button"
              class="btn-profile"
            >
              <p>Exit</p>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: "",
      projectForm: {
        project_name: this.project.project_name,
        project_desc: this.project.project_desc,
        _method: "patch",
      },
      divisionId: [],
      token: localStorage.getItem("token"),
    };
  },
  props: ["project", "members", "divisions"],
  methods: {
    backToDivisionCards() {
      this.$emit("updateShowComponentProjectBoard", "division-card");
    },
    getDivisions(projectId) {
      axios
        .get(`api/project/${projectId}/project-divisions`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.projectDivisions = response.data;
        });
    },
    assignDivision(memberId, divisionId) {
      console.log(memberId);
      console.log(divisionId);
      axios
        .patch(
          `api/project-member/${memberId}`,
          { division_id: divisionId },
          {
            headers: { Authorization: "Bearer " + this.token },
          }
        )
        .then((response) => {
          this.message = response.data.status
            ? "Member added to division"
            : "Failed to add member to division!";
        });
    },
    updateProjectDetail() {
      axios
        .post(`api/project/${this.project.project_id}`, this.projectForm, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          if (!response.data.status) this.message = "Failed to edit project!";
          else this.$router.go();
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
