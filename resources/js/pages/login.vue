<template>
<div>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <img
                href="/home"
                class="logo"
                alt="tamago logo"
                src="../assets/logo-tamago.png"
            />
            <div class="collapse navbar-collapse" id="navbarText">
                <div class="navbar-nav ml-auto">
                    <p> Don't have any account? </p>
                    <button class="btn-tamago">
                        <p>Sign Up</p>
                    </button>
                </div>
            </div>
        </nav>
    </div>

    <div class="container-login"> 
        <form class="form-login">
            <h1> Welcome Back! </h1>
            <h2> to Tamago </h2>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" class="form-control" id="emailaddress" placeholder="Enter your email address">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="text" class="form-control" id="password" placeholder="Enter your password">
            </div>
            <a href="" >
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
  name: "Login",
};
</script>

<style lang="css">
@import "../css/navbar.css";
</style>