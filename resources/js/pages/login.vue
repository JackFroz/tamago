<template>
  <div>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <img
          class="logo"
          alt="tamago logo"
          :src="LogoTamago"
        />
        <div class="collapse navbar-collapse" id="navbarText">
          <div class="navbar-nav ml-auto">
            <p class="nav-text">Don't have any account?</p>
            <button class="btn-nav-signup">
              <router-link :to="{ name: 'register' }" class="nav-link"
                >Sign up</router-link
              >
            </button>
          </div>
        </div>
      </nav>
    </div>

    <div class="container-login">
      <form action="#" @submit.prevent="login" class="form-login">
        <h1>Welcome Back!</h1>
        <h2>to Tamago</h2>
        <p> {{ message }} </p>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input
            type="text"
            class="form-control"
            id="emailaddress"
            placeholder="Enter your email address"
            v-model="loginForm.email"
          />
        </div>
        <div class="form-group">
          <label for="pass">Password</label>
          <input
            type="password"
            class="form-control"
            id="password"
            placeholder="Enter your password"
            v-model="loginForm.password"
          />
        </div>
        <a href="">
          <p>Forgot Password?</p>
        </a>
        <div class="centre-login">
          <button type="submit" class="btn-tamago">Login</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import LogoTamago from "../../images/logo-tamago.png";

export default {
  data() {
    return {
      message: "",
      LogoTamago: LogoTamago,
      loginForm: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    login() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("api/login", this.loginForm)
          .then((response) => {
            localStorage.setItem("token", response.data.token);
            this.$router.push("home");
          })
          .catch(() => {
            this.message = "Wrong email or password!";
          });
      });
    },
  },
};
</script>

<style lang="css">
@import "../../css/app.css";
</style>
