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
          v-if="showComponentProjectBoard === 'create-division'"
          v-bind:project="project"
        />
        <EditProject
          @updateShowComponentProjectBoard="updateShowComponentProjectBoard"
          v-if="showComponentProjectBoard === 'edit-project'"
          v-bind:project="project"
        />
        <EditDivision
          @updateShowComponentProjectBoard="updateShowComponentProjectBoard"
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
        });
    },
    getDivisions() {
      axios
        .get(`api/project/${this.projectId}/project-divisions`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.divisions = response.data;
        });
    },
    getMembers() {
      axios
        .get(`api/project/${this.projectId}/project-members`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.members = response.data;
        });
    },
    currentUser() {
      axios
        .get("api/user", {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.username = response.data.user.username;
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
  },
  created() {
    this.currentUser();
    this.getProject();
    this.getDivisions();
    this.getMembers();
  },
};
</script>

<style lang="css">
@import "../../css/app.css";
</style>
