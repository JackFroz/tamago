<template>
  <div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="detail-project">
      <div class="content-detail-project">
        <p>Project ID</p>
        <div class="id-project">
          <p class="title text-center">{{ selectedProject.project_id }}</p>
        </div>

        <br />
        <p>Project Description</p>
        <div class="desc-project">
          <p>{{ selectedProject.project_desc }}</p>
        </div>
        <br />
        <button @click="openCreateDivision" class="btn-create-div">
          <p><i class="fa fa-plus" aria-hidden="true"></i>  Create a New Division Board</p>    
        </button>

        <br />
        <button @click="openEditProject" class="btn-create-div">
          <p><i class="fa fa-plus" aria-hidden="true"></i>  Edit Project and Assign Role</p>
        </button>
      </div>
    </div>
    <!-- End Sidebar -->
  </div>
</template>

<script>
export default {
  props: ["selectedProject", "showProjectBoard"],
  methods: {
    openCreateDivision() {
      this.showProjectBoard.showCreateDivision = !this.showProjectBoard.showCreateDivision;
      this.showProjectBoard.showDivisionCard = !this.showProjectBoard.showDivisionCard;
    },
    openEditProject() {

    }
  }
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
