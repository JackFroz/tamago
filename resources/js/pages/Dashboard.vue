<template>
  <div>
    <Sidenav v-bind:showVar="showVar" />
    <Home
      v-if="showVar.showHome"
      v-bind:projects="projects"
    />
    <Profile
      v-if="showVar.showProfile"
      v-bind:firstNameData="firstNameData"
      v-bind:lastNameData="lastNameData"
      v-bind:passwordData="passwordData"
      v-bind:profileData="profileData"
    />
  </div>
</template>

<script>
import Sidenav from "../components/Sidenav.vue";
import Home from "../components/Home.vue";
import Profile from "../components/Profile.vue";

export default {
  name: "Dashboard",
  data() {
    return {
      showVar: {
        showHome: true,
        showProfile: false,
      },
      firstNameData: {
        first_name: "",
      },
      lastNameData: {
        last_name: "",
      },
      passwordData: {
        old_password: "",
        new_password: "",
        repeat_new_password: "",
      },
      profileData: [],
      projects: [],
      token: localStorage.getItem("token"),
    };
  },
  created() {
    this.getUser();
  },
  components: {
    Sidenav,
    Home,
    Profile,
  },
  methods: {
    getUser() {
      axios
        .get("/api/user", {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.profileData = response.data.user;
          this.getProjects();
          this.firstNameData.first_name = this.profileData.first_name;
          this.lastNameData.last_name = this.profileData.last_name; // assign response to state user
        });
    },
    getProjects() {
      axios
        .get(`api/user/${this.profileData.id}/projects`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.projects = response.data.projects;
        });
    },
  },
  beforeRouteEnter(to, from, next) {
    if (!localStorage.getItem("token")) {
      return next("login");
    }

    next();
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
