<template>
  <div>
    <Sidenav />
    <div class="main">
      <!--Header-->
      <div class="fixed-top judul-page">
        <p class="top-bar">
          <router-link :to="{ name: 'home' }"> Home </router-link> >>
          <router-link
            :to="{
              name: 'project-board',
              params: { id: projectId },
            }"
          >
            {{ project.project_name }}
          </router-link>
          >> {{ division.division_name }}
        </p>
      </div>
      <CardManagement
        v-bind:divisionMembers="divisionMembers"
        v-bind:lists="lists"
        v-bind:project="project"
        v-bind:canEdit="canEdit"
        @updateLists="updateLists"
        @updateDivisionMembers="updateDivisionMembers"
      />
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Sidenav from "../components/Sidenav.vue";
import CardManagement from "../components/card-components/CardManagement.vue";

export default {
  components: {
    Sidenav,
    CardManagement,
  },
  data() {
    return {
      divisionId: this.$route.params.id,
      currentUsername: "",
      projectId: "",
      project: [],
      division: [],
      lists: [],
      divisionMembers: [],
      projectOwner: [],
      canEdit: false,
      token: localStorage.getItem("token"),
    };
  },
  methods: {
    currentUser() {
      axios
        .get("api/user", {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.currentUsername = response.data.user.username;
          this.getProject();
        });
    },
    getProject() {
      axios
        .get(`api/project-division/${this.divisionId}/project`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.project = response.data;
          this.projectId = this.project.project_id;
          this.getProjectOwner();
        });
    },
    getDivision() {
      axios
        .get(`api/project-division/${this.divisionId}`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.division = response.data;
        });
    },
    getLists() {
      axios
        .get(`api/project-division/${this.divisionId}/progress-lists`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          response.data.forEach((data) => {
            this.lists.push({
              list_id: data.list_id,
              division_id: data.division_id,
              list_name: data.list_name,
              order: data.order,
              cards: [],
            });
            this.getCards();
          });
        });
    },
    getCards() {
      this.lists.map((list) => {
        axios
          .get(`api/progress-list/${list.list_id}/cards`, {
            headers: { Authorization: "Bearer " + this.token },
          })
          .then((response) => {
            list.cards = response.data;
          });
      });
    },
    getDivisionMembers() {
      axios
        .get(`api/project-division/${this.divisionId}/project-members`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          response.data.forEach((member) => {
            this.divisionMembers.push(member);
            if (member.username === this.currentUsername) this.canEdit = true; 
          });
        });
    },
    getProjectOwner() {
      axios
        .get(`api/project/${this.projectId}/project-owner`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          if (this.currentUsername === response.data.username) this.canEdit = true;
          this.divisionMembers.push(response.data);
        });
    },
    updateLists() {
      this.lists = [];
      this.getLists();
    },
    updateDivisionMembers() {
      this.divisionMembers = [];
      this.getProjectOwner(); 
      this.getDivisionMembers();
    }
  },
  created() {
    this.currentUser();
    this.getDivision();
    this.getLists();
    this.getDivisionMembers();
  },
};
</script>

<style lang="css">
@import "../../css/app.css";
</style>
