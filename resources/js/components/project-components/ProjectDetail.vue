<template>
  <div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="detail-project">
      <div class="content-detail-project">
        <p>Project ID</p>
        <div class="id-project">
          <p class="title text-center">{{ project.project_id }}</p>
        </div>

        <br />
        <p>Project Description</p>
        <div class="desc-project">
          <p>{{ project.project_desc }}</p>
        </div>
        <br />
        <p v-if="memberOfDivisionName !== ''">Assigned to</p>
        <p v-if="memberOfDivisionName !== ''">"{{ memberOfDivisionName }}"</p>
        <br />
        <button v-if="ownership" @click="showCreateDivision" class="btn-create-div">
          <p><i class="fa fa-plus" aria-hidden="true"></i>  Create a New Division Board</p>    
        </button>

        <br />
        <button v-if="ownership" @click="showEditProject" class="btn-create-div">
          <p><i class="fa fa-plus" aria-hidden="true"></i>  Edit Project and Assign Role</p>
        </button>
      </div>
    </div>
    <!-- End Sidebar -->
  </div>
</template>

<script>
export default {
  props: ["project", "ownership", "memberOfDivisionName"],
  methods: {
    showCreateDivision() {
      this.$emit("updateShowComponentProjectBoard", "create-division")
    },
    showEditProject() {
      this.$emit("updateShowComponentProjectBoard", "edit-project")
    }
  }
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
