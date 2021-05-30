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
          <h4>Edit Project</h4>
          <p>{{ messageProject }}</p>
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
            <p>{{ messageDivision }}</p>
            <div
              class="row"
              v-for="(member, index) in members"
              :key="member.member_id"
            >
              <div class="col-3">
                <p>{{ member.username }}</p>
              </div>
              <div class="col-5">
                <div class="role-option" style="float: center">
                  <select
                    v-model="reactiveMembers[index].division_id"
                    name="role"
                    id="roles"
                  >
                    <option :value="null">
                      not assigned
                    </option>
                    <option
                      :value="division.division_id"
                      v-for="division in divisions"
                      :key="division.division_id"
                    >
                      {{ division.division_name }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <button
                  @click="
                    assignDivision(
                      member.member_id,
                      reactiveMembers[index].division_id
                    )
                  "
                  type="button"
                  class="btn-edit"
                >
                  <p>Assign</p>
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
import RocketImg from "../../../images/rocket.png";

export default {
  data() {
    return {
      RocketImg: RocketImg,
      messageProject: "",
      messageDivision: "",
      projectForm: {
        project_name: this.project.project_name,
        project_desc: this.project.project_desc,
        _method: "patch",
      },
      reactiveMembers: this.members,
      token: localStorage.getItem("token"),
    };
  },
  props: ["project", "members", "divisions"],
  methods: {
    backToDivisionCards() {
      this.$emit("updateShowComponentProjectBoard", "division-card");
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
          if (!response.data.status)
            this.messageDivision = "Failed to assign division!";
          else {
            this.$emit("updateProjectMembers");
            this.messageDivision = "Division assigned!";
            var that = this;
            setTimeout(function() {
              that.messageDivision = "";
            }, 5000);
          }
        });
    },
    updateProjectDetail() {
      axios
        .post(`api/project/${this.project.project_id}`, this.projectForm, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          if (!response.data.status)
            this.messageProject = "Failed to edit project!";
          else {
            this.$emit("updateProjectDetail");
            this.messageProject = "Project detail updated!";
            var that = this;
            setTimeout(function() {
              that.messageProject = "";
            }, 5000);
          }
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
