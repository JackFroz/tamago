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
                    <p> Already with Tamago? </p>
                    <button class="btn-tamago">
                        <p>Login</p>
                    </button>
                </div>
            </div>
        </nav>
    </div>

    <div class="container-login"> 
        <form class="form-login">
            <h1> Register </h1>
            <h2> your account Now! </h2>
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="firstname" placeholder="Enter your first name">
            </div>
            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lastname" placeholder="Enter your last name">
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" class="form-control" id="emailaddress" placeholder="Enter your email address">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="text" class="form-control" id="password" placeholder="Enter your password">
            </div>
            <div class="form-group">
                <label for="confpass">Confirm Password</label>
                <input type="text" class="form-control" id="confirmpass" placeholder="Confirm your password">
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
  name: "Register",
};
</script>

<style lang="css">
@import "../css/navbar.css";
</style>