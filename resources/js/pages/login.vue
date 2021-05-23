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
            <p>Don't have any account?</p>
            <button class="btn-tamago">
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
export default {
  data() {
    return {
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
          .catch((error) => console.log(error));
      });
    },
  },
};
</script>

<style lang="css">
@import "../../css/app.css";
</style>
