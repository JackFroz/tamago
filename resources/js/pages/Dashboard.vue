<template>
<div>
    <Sidenav />
    <div class="main">
        <!--Header-->
        <div class="fixed-top judul-page">
            <a class="title">
                Home
            </a>
        </div>
        <!--End Header-->
        <div class="content-home">
        </div>
    </div>
</div>
</template>

<script>
// @ is an alias to /src
import Sidenav from "@/components/Sidenav.vue";

export default {
  name: "Dashboard",
  components: {
    Sidenav,
  },
};
</script>

<style lang="css">
@import "../css/navbar.css";
</style>