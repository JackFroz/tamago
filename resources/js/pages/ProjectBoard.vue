<template>
  <div>
    <Sidenav />
    <div class="main">
      <!--Header-->
      <div class="fixed-top judul-page">
        <p class="top-bar">
          <router-link :to="{ name: 'home' }"> Home </router-link> >>
          {{ project.project_name }}
        </p>
      </div>
      <!--End Header-->
      <div class="content-home-bg">
        <ProjectDetail
          @updateShowComponentProjectBoard="updateShowComponentProjectBoard"
          v-bind:project="project"
          v-bind:ownership="ownership"
          v-bind:memberOfDivisionName="memberOfDivisionName"
        />
        <DivisionCard
          @updateDivision="updateDivision"
          @updateShowComponentProjectBoard="updateShowComponentProjectBoard"
          v-if="showComponentProjectBoard === 'division-card'"
          v-bind:divisions="divisions"
          v-bind:division="division"
          v-bind:ownership="ownership"
        />
        <CreateDivision
          @updateShowComponentProjectBoard="updateShowComponentProjectBoard"
          @updateDivisionCards="updateDivisionCards"
          v-if="showComponentProjectBoard === 'create-division'"
          v-bind:project="project"
        />
        <EditProject
          @updateProjectDetail="updateProjectDetail"
          @updateProjectMembers="updateProjectMembers"
          @updateShowComponentProjectBoard="updateShowComponentProjectBoard"
          v-if="showComponentProjectBoard === 'edit-project'"
          v-bind:project="project"
          v-bind:divisions="divisions"
          v-bind:members="members"
        />
        <EditDivision
          @updateShowComponentProjectBoard="updateShowComponentProjectBoard"
          @updateDivisionCards="updateDivisionCards"
          v-if="showComponentProjectBoard === 'edit-division'"
          v-bind:project="project"
          v-bind:division="division"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Sidenav from "../components/Sidenav.vue";
import ProjectDetail from "../components/project-components/ProjectDetail.vue";
import DivisionCard from "../components/division-components/DivisionCard.vue";
import CreateDivision from "../components/division-components/CreateDivision.vue";
import EditProject from "../components/project-components/EditProject.vue";
import EditDivision from "../components/division-components/EditDivision.vue";

export default {
  components: {
    Sidenav,
    ProjectDetail,
    DivisionCard,
    CreateDivision,
    EditProject,
    EditDivision,
  },
  data() {
    return {
      ownership: false,
      username: "",
      showComponentProjectBoard: "division-card",
      project: [],
      divisions: [],
      members: [],
      memberOfDivisionId: "",
      memberOfDivisionName: "",
      division: [],
      projectId: this.$route.params.id,
      token: localStorage.getItem("token"),
    };
  },
  methods: {
    getProject() {
      axios
        .get(`api/project/${this.projectId}`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.project = response.data;
          this.ownership =
            this.project.username === this.username ? true : false;
          this.getMembers();
        });
    },
    getDivisions() {
      axios
        .get(`api/project/${this.projectId}/project-divisions`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          response.data.forEach((division) => {
            if (division.division_id === this.memberOfDivisionId)
              this.memberOfDivisionName = division.division_name;
            this.divisions.push(division);
          });
        });
    },
    getMembers() {
      axios
        .get(`api/project/${this.projectId}/project-members`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          response.data.forEach((member) => {
            if (member.username !== this.project.username)
              this.members.push(member);

            if (member.username === this.username && member.division_id !== null)
              this.memberOfDivisionId = member.division_id;
          });
          this.getDivisions();
        });
    },
    currentUser() {
      axios
        .get("api/user", {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.username = response.data.user.username;
          this.getProject();
        });
    },
    updateShowComponentProjectBoard(componentName) {
      this.showComponentProjectBoard =
        this.showComponentProjectBoard !== "division-card"
          ? "division-card"
          : componentName;
    },
    updateDivision(division) {
      this.division = division;
    },
    updateProjectMembers() {
      this.members = [];
      this.divisions = [];
      this.getMembers();
    },
    updateProjectDetail() {
      this.members = [];
      this.divisions = [];
      this.getProject();
    },
    updateDivisionCards() {
      this.divisions = [];
      this.getDivisions();
    },
  },
  created() {
    this.currentUser();
  },
};
</script>

<style lang="css">
@import "../../css/app.css";
</style>
