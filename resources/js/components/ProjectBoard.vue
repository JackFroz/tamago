<template>
<div>
    <Sidenav />
    <div class="main">
        <!--Header-->
        <div class="fixed-top judul-page">
            <p class="top-bar">
                Nama Project
            </p>
        </div>
        <!--End Header-->
        <ProjectDetail />
    </div>
</div>
</template>

<script>
// @ is an alias to /src
import Sidenav from "./Sidenav.vue";
import ProjectDetail from "./ProjectDetail.vue";
export default {
  components: {
    Sidenav, ProjectDetail
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>