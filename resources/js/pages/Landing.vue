<template>
  <!--section-top-->
  <div class="main-home">
    <Navbar />
    <section class="section-top">
      <div class="container">
        <div class="row">
          <div class="col-7">
            <br /><br /><br /><br />
            <h1 class="title">Stay organized and connected.</h1>
            <p class="text">
              The best organizational task manager platform in Indonesia
            </p>
            <br />
            <button href="" class="btn-tamago">
              <p>Get Started!</p>
            </button>
          </div>
          <div class="col-5">
            <img style="float: right" src="images/Frame-1.png" alt="" />
          </div>
        </div>
      </div>
    </section>

    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

    <section class="section-mid">
      <div class="container">
        <h1 class="title text-center">Tamago the future of work</h1>
        <br />
        <div class="row">
          <div class="col-6">
            <img style="float: left" src="images/Frame1.png" alt="" />
          </div>
          <div class="col-6">
            <h1 class="title">TO DO LIST</h1>
            <p class="text">
              Organize and assign tasks. With lists, teams see immediately what
              they need to do, which tasks are a priority, and when work is due
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <h1 class="title">PROJECT MANAGEMENT</h1>
            <p class="text">
              Manage all of your tasks in one place. Plan and structure your
              work as you see fit and organize your Goals on flexible boards
            </p>
          </div>
          <div class="col-6">
            <img style="float: right" src="images/Frame2.png" alt="" />
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <img style="float: left" src="images/Frame3.png" alt="" />
          </div>
          <div class="col-6">
            <h1 class="title">BOARD</h1>
            <p class="text">
              Make it easy for your team to focus on tasks currently at hand.
              Define each stage of work to see whats important and where things
              are getting stuck.
            </p>
          </div>
        </div>
      </div>
    </section>

    <br />

    <section class="section-bot">
      <h1 class="title text-center">MEET OUR TEAM</h1><br>
      <div class="title text-center">
        <div class="row">
          <div class="col-12">
            <img style="float: center" src="images/orang-3.png" alt="" />
            <p>Suriadi Vajrakaruna</p>
            <p>Project Manager</p>
          </div>
        </div>
      </div>
    </section>
    <section class="section-bot">
      <div class="title text-center">
        <div class="row">
          <div class="col-4">
            <img style="float: center" src="images/orang-1.png" alt="" />
            <p>M Razzaq Fadilah</p>
            <p>Back End Developer</p>
          </div>
          <div class="col-4">
            <img style="float: center" src="images/orang-2.png" alt="" />
            <p >Sitti Ufairoh A</p>
            <p>UI/UX Developer</p>
          </div>
          <div class="col-4">
            <img style="float: center" src="images/orang-1.png" alt="" />
            <p>M Reza Atthariq</p>
            <p>Front End Developer</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
// @ is an alias to /src
import Navbar from "../components/Navbar.vue";

export default {
  components: {
    Navbar,
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>