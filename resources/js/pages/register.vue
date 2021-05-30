<template>
  <div>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <img
          href="/home"
          class="logo"
          alt="tamago logo"
          :src="LogoTamago"
        />
        <div class="collapse navbar-collapse" id="navbarText">
          <div class="navbar-nav ml-auto">
            <p class="nav-text">Already with Tamago?</p>
            <button class="btn-nav-signup">
              <router-link
                :to="{ name: 'login' }"
                class="nav-link"
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
        <p> {{ message }} </p>
        <div class="form-group">
          <label for="fname">First Name</label>
          <input
            type="text"
            class="form-control"
            id="firstname"
            placeholder="Enter your first name"
            v-model="registerForm.first_name"
            maxlength="25"
            required
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
            maxlength="25"
            required
          />
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input
            type="email"
            class="form-control"
            id="emailaddress"
            placeholder="Enter your email address"
            v-model="registerForm.email"
            required
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
            minlength="5"
            maxlength="16"
            required
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
            minlength="8"
            maxlength="25"
            required
          />
        </div>
        <div class="form-group">
          <label for="confpass">Confirm Password</label>
          <input
            type="password"
            class="form-control"
            id="confirmpass"
            placeholder="Confirm your password"
            v-model="registerForm.confirm_password"
            minlength="8"
            maxlength="25"
            required
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
import LogoTamago from "../../images/logo-tamago.png";

export default {
  data() {
    return {
      message: "",
      LogoTamago: LogoTamago,
      registerForm: {
        email: "",
        username: "",
        password: "",
        first_name: "",
        last_name: "",
        password: "",
        confirm_password: "",
      },
    };
  },
  methods: {
    handleRegister() {
      if(this.checkPasswordColumns()){
        this.message = "Please wait...";
         axios
        .post("api/register", this.registerForm)
        .then(() => {
          this.$router.push("login");
        })
        .catch(() => {
          this.message = "Your email or username is already registered!";
        });
      }
      else{
        this.message = "Password and Confirm Password columns do not match!"
      }
     
    },
    checkPasswordColumns() {
      if(this.registerForm.password === this.registerForm.confirm_password) return true;
      else false;
    }
  },
};
</script>

<style lang="css">
@import "../../css/app.css";
</style>
