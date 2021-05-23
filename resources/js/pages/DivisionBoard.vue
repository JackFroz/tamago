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
      <CardManagement v-bind:lists="lists" />
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
      projectId: "",
      project: [],
      division: [],
      lists: [],
      token: localStorage.getItem("token"),
    };
  },
  methods: {
    getProject() {
      axios
        .get(`api/project-division/${this.divisionId}/project`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.project = response.data;
          this.projectId = this.project.project_id;
          console.log(this.project);
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
  },
  created() {
    this.getProject();
    this.getDivision();
    this.getLists();
    console.log(this.lists.cards);
    if (!this.division) this.$router.replace({ path: "home" });
  },
};
</script>

<style lang="css">
@import "../../css/app.css";
</style>
