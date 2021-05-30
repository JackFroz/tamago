<template>
  <div>
    <Sidenav />
    <div class="main">
      <!--Header-->
      <div class="fixed-top judul-page">
        <p class="top-bar-static">
          Profile
        </p>
      </div>
      <!--End Header-->
      <div class="content-home-bg">
        <div class="content-profile">
          <div class="name-foto">
            <p>{{ user.first_name }} {{ user.last_name }}</p>
            <div class="row">
              <div class="col-12">
                <img style="float: center" :src="ProfileImg" alt="" />
              </div>
            </div>
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
                  v-model="profileForm.first_name"
                />
              </div>
              <div class="form-group">
                <p for="lname">Last Name</p>
                <input
                  type="text"
                  class="form-control"
                  id="lastname"
                  v-model="profileForm.last_name"
                />
              </div>
              <div class="form-group">
                <p for="id">Username</p>
                <input
                  type="text"
                  class="form-control"
                  id="userid"
                  readonly
                  v-model="user.username"
                />
              </div>
              <h4>Change Password</h4>
              <div class="form-group">
                <p for="oldpass">Old Password</p>
                <input
                  type="password"
                  class="form-control"
                  id="oldpassword"
                  v-model="passwordForm.old_password"
                />
              </div>
              <div class="form-group">
                <p for="newpass">New Password</p>
                <input
                  type="password"
                  class="form-control"
                  id="newpassword"
                  v-model="passwordForm.new_password"
                  maxlength="25"
                />
              </div>
              <div class="form-group">
                <p for="confpass">Confirm Password</p>
                <input
                  type="password"
                  class="form-control"
                  id="confirmpass"
                  v-model="passwordForm.repeat_new_password"
                  maxlength="25"
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
import Sidenav from "../components/Sidenav.vue";
import ProfileImg from "../../images/default-user.png";

export default {
  components: {
    Sidenav,
  },

  data() {
    return {
      ProfileImg: ProfileImg,
      message: "",
      user: [],
      profileForm: {
        first_name: "",
        last_name: "",
      },
      passwordForm: {
        old_password: "",
        new_password: "",
        repeat_new_password: "",
      },
      token: localStorage.getItem("token"),
    };
  },
  props: [],
  computed: {
    isDisabled() {
      if (this.isNameColumnsChanged() || this.isPasswordColumnsChanged())
        return true;

      return false;
    },
  },

  methods: {
    getUser() {
      axios
        .get("api/user", {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.user = response.data.user;
          this.profileForm.first_name = this.user.first_name;
          this.profileForm.last_name = this.user.last_name;
        });
    },
    isNameColumnsChanged() {
      let isNameColumnsChanged =
        this.user.first_name !== this.profileForm.first_name ||
        this.user.last_name !== this.profileForm.last_name;

      return isNameColumnsChanged;
    },
    isPasswordColumnsChanged() {
      let isPasswordColumnsChanged =
        this.passwordForm.new_password !== "" &&
        this.passwordForm.old_password !== "" &&
        this.passwordForm.repeat_new_password !== "" &&
        this.passwordForm.new_password ===
          this.passwordForm.repeat_new_password
          && this.passwordForm.new_password.length >= 8;

      return isPasswordColumnsChanged;
    },
    changeName() {
      axios
        .post("api/change-name", this.profileForm, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          if (response.data.success) {
            this.user.first_name = this.profileForm.first_name;
            this.user.last_name = this.profileForm.last_name;
            var that = this;
            setTimeout(function() {
              that.message = "Profile updated!";
            }, 5000);
          } else {
            var that = this;
            setTimeout(function() {
              that.message = "Failed updating profile!";
            }, 5000);
          }
        });
    },
    changePassword() {
      axios
        .post("api/change-password", this.passwordForm, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then(() => {
          this.message = "Password changed!";
        })
        .catch(() => {
          this.message = "Wrong old password!";
        });
    },
    saveChanges() {
      if (this.isNameColumnsChanged()) this.changeName();

      if (this.isPasswordColumnsChanged()) this.changePassword();
    },
  },
  created() {
    this.getUser();
  },
};
</script>

<style lang="css">
@import "../../css/app.css";
</style>
