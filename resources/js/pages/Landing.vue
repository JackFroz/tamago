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
            <div class="get-started">
              <router-link :to="{ name: 'register' }" class="nav-link"
                ><p>Get Started!</p></router-link
              >
            </div>
          </div>
          <div class="col-5">
            <img style="float: right" :src="FrameLp1" alt="" />
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
            <img style="float: left" :src="FrameLp2" alt="" />
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
            <img style="float: right" :src="FrameLp3" alt="" />
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <img style="float: left" :src="FrameLp4" alt="" />
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
      <h1 class="title text-center">MEET OUR TEAM</h1>
      <br />
      <div class="title text-center">
        <div class="row">
          <div class="col-12">
            <img style="float: center" :src="Orang3" alt="" />
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
            <img style="float: center" :src="Orang1" alt="" />
            <p>M Razzaq Fadilah</p>
            <p>Back End Developer</p>
          </div>
          <div class="col-4">
            <img style="float: center" :src="Orang2" alt="" />
            <p>Sitti Ufairoh A</p>
            <p>UI/UX Developer</p>
          </div>
          <div class="col-4">
            <img style="float: center" :src="Orang1" alt="" />
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
import FrameLp1 from "../../images/frame-lp-1.png";
import FrameLp2 from "../../images/frame-lp-2.png";
import FrameLp3 from "../../images/frame-lp-3.png";
import FrameLp4 from "../../images/frame-lp-4.png";
import Orang1 from "../../images/orang-1.png";
import Orang2 from "../../images/orang-2.png";
import Orang3 from "../../images/orang-3.png";

export default {
  components: {
    Navbar,
  },
  data() {
    return {
      FrameLp1: FrameLp1,
      FrameLp2: FrameLp2,
      FrameLp3: FrameLp3,
      FrameLp4: FrameLp4,
      Orang1: Orang1,
      Orang2: Orang2,
      Orang3: Orang3
    }
  }
};
</script>

<style lang="css">
@import "../../css/app.css";
</style>
