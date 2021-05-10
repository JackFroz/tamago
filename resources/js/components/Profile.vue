<template>
  <div>
    <div class="main">
      <!--Header-->
      <div class="fixed-top judul-page">
        <p class="top-bar">
          Profile
        </p>
      </div>
      <!--End Header-->
      <div class="content-home-bg">
        <div class="content-profile">
          <div class="name-foto">
            <p>{{ firstNameData.first_name }} {{ lastNameData.last_name }}</p>
            <img class="mx-auto d-block rounded-circle" src="" alt="" />
          </div>
          <div class="form-profile">
            <p v-html="message"></p>
            <form class="form-login" action="#" @submit.prevent="saveChanges">
              <div class="form-group">
                <p for="fname">First Name</p>
                <input
                  type="text"
                  class="form-control"
                  id="firstname"
                  v-model="profileData.first_name"
                />
              </div>
              <div class="form-group">
                <p for="lname">Last Name</p>
                <input
                  type="text"
                  class="form-control"
                  id="lastname"
                  v-model="profileData.last_name"
                />
              </div>
              <div class="form-group">
                <p for="id">Username</p>
                <input
                  type="text"
                  class="form-control"
                  id="userid"
                  readonly
                  v-model="profileData.username"
                />
              </div>
              <h4>Change Password</h4>
              <div class="form-group">
                <p for="oldpass">Old Password</p>
                <input
                  type="password"
                  class="form-control"
                  id="oldpassword"
                  v-model="passwordData.old_password"
                />
              </div>
              <div class="form-group">
                <p for="newpass">New Password</p>
                <input
                  type="password"
                  class="form-control"
                  id="newpassword"
                  v-model="passwordData.new_password"
                />
              </div>
              <div class="form-group">
                <p for="confpass">Confirm Password</p>
                <input
                  type="password"
                  class="form-control"
                  id="confirmpass"
                  v-model="passwordData.repeat_new_password"
                />
              </div>
              <button v-if="isDisabled" type="submit" class="btn-profile">
                <p>Save Changes</p>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  data() {
    return {
      message: "",
      token: localStorage.getItem("token"),
    };
  },
  props: ["firstNameData", "lastNameData", "passwordData", "profileData"],
  computed: {
    isDisabled() {
      if (this.firstNameData.first_name !== this.profileData.first_name)
        return true;

      if (this.lastNameData.last_name !== this.profileData.last_name)
        return true;

      if (
        this.passwordData.new_password !== "" &&
        this.passwordData.old_password !== "" &&
        this.passwordData.repeat_new_password !== "" &&
        this.passwordData.new_password === this.passwordData.repeat_new_password
      )
        return true;

      return false;
    },
  },

  methods: {
    saveChanges() {
      if (this.firstNameData.first_name !== this.profileData.first_name) {
        this.firstNameData.first_name = this.profileData.first_name;
        axios
          .post("/api/change-first-name", this.firstNameData, {
            headers: { Authorization: "Bearer " + this.token },
          })
          .then((response) => {
            this.message = "Profile updated!";
          })
          .catch((error) => {
            if (!error.response.data.success) {
              this.message = "Please check your input again!";
            }
          }); // credentials didn't match
      }

      if (this.lastNameData.last_name !== this.profileData.last_name) {
        this.lastNameData.last_name = this.profileData.last_name;
        axios
          .post("/api/change-last-name", this.lastNameData, {
            headers: { Authorization: "Bearer " + this.token },
          })
          .then((response) => {
            this.message = response.data.message;
          })
          .catch((error) => {
            if (!error.response.data.success) {
              this.message = error.response.data.message;
            }
          }); // credentials didn't match
      }

      if (
        this.passwordData.new_password !== "" &&
        this.passwordData.old_password !== "" &&
        this.passwordData.repeat_new_password !== "" &&
        this.passwordData.new_password === this.passwordData.repeat_new_password
      ) {
        axios
          .post("/api/change-password", this.passwordData, {
            headers: { Authorization: "Bearer " + this.token },
          })
          .then((response) => {
            this.message = "Profile updated!";
          })
          .catch((error) => {
            if (!error.response.data.success) {
              this.message =
                "Failed updating profile! Please check your input!";
            }
          });
      }
    },
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
