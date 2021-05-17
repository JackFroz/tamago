<template>
  <div>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <div class="sidenav">
      <div class="row">
        <div class="col-12">
          <img class="navbar-brand" src="images/logo-tamago.png" alt="" />
        </div>
      </div>
      <a @click="openHome" class="nav-link"><i class="fa fa-home"></i>Home</a>
      <a @click="openProfile" class="nav-link"
        ><i class="fa fa-user"></i>Profile</a
      >
      <a @click="logout" class="nav-link"><i class="fa fa-sign-out"></i>Log Out</a>
    </div>
    <!-- End Sidebar -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      token: localStorage.getItem("token"),
    };
  },
  props: ["showVar"],
  methods: {
    openHome() {
      this.showVar.showHome = true;
      this.showVar.showProfile = false;
    },
    openProfile() {
      this.showVar.showProfile = true;
      this.showVar.showHome = false;
    },
    logout() {
      axios
        .get("api/logout", {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.$router.push("login");
        });
    },
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
