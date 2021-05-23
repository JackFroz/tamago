<template>
  <div>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <img
          href="/home"
          class="logo"
          alt="tamago logo"
          src="images/logo-tamago.png"
        />
        <div class="collapse navbar-collapse" id="navbarText">
          <div class="navbar-nav ml-auto">
            <p>Already with Tamago?</p>
            <button class="btn-tamago">
              <router-link
                :to="{ name: 'login' }"
                class="nav-link"
                v-if="!isLoggedIn"
                >Login</router-link
              >
            </button>
          </div>
        </div>
      </nav>
    </div>

    <div class="container-login">
      <form action="#" @submit.prevent="handleRegister" class="form-login">
        <h1>Register</h1>
        <h2>your account Now!</h2>
        <div class="form-group">
          <label for="fname">First Name</label>
          <input
            type="text"
            class="form-control"
            id="firstname"
            placeholder="Enter your first name"
            v-model="registerForm.first_name"
          />
        </div>
        <div class="form-group">
          <label for="lname">Last Name</label>
          <input
            type="text"
            class="form-control"
            id="lastname"
            placeholder="Enter your last name"
            v-model="registerForm.last_name"
          />
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input
            type="text"
            class="form-control"
            id="emailaddress"
            placeholder="Enter your email address"
            v-model="registerForm.email"
          />
        </div>
        <div class="form-group">
          <label for="email">Username</label>
          <input
            type="text"
            class="form-control"
            id="username"
            placeholder="Enter your username"
            v-model="registerForm.username"
          />
        </div>
        <div class="form-group">
          <label for="pass">Password</label>
          <input
            type="password"
            class="form-control"
            id="password"
            placeholder="Enter your password"
            v-model="registerForm.password"
          />
        </div>
        <div class="form-group">
          <label for="confpass">Confirm Password</label>
          <input
            type="password"
            class="form-control"
            id="confirmpass"
            placeholder="Confirm your password"
            v-model="confirm_password"
          />
        </div>

        <div class="centre-login">
          <button type="submit" class="btn-tamago">Sign Up</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      registerForm: {
        email: "",
        username: "",
        password: "",
        first_name: "",
        last_name: "",
        password: "",
      },
    };
  },
  methods: {
    handleRegister() {
      axios
        .post("api/register", this.registerForm)
        .then(() => {
          this.$router.push("login");
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>

<style lang="css">
@import "../../css/app.css";
</style>
