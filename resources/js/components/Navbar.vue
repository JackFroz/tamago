<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!--header-->
    <div class="container">
      <img
        href="/home"
        class="logo"
        alt="tamago logo"
        src="images/logo-tamago.png"
      />
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <button class="btn-nav-login" style="z-index:1">
            <router-link :to="{ name: 'login' }" class="nav-link">Login</router-link>
          </button>
          <button class="btn-nav-signup" style="z-index:1">
            <router-link :to="{ name: 'register' }" class="nav-link">Sign up</router-link>
          </button>
          
        </ul>
      </div>
    </div>
    <!--headerend-->
  </nav>
</template>

<script>
export default {};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>