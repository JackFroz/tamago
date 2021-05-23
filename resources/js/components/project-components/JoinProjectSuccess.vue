<template>
<div>
  <div class="content-join-success">
    <div class="join-logo-success">
      <img style=" float: center" src="images/Group 254.png" alt="" />
    </div>

    <div class="form-join-success">
      <h4>Successfully Joined The Project</h4>
      <div class="form-group-success">
        <p>Project ID : {{ projectId }}</p>
        <div class="form-group-success-top">
          <p>Nama project</p>
        </div>
      </div>
      <button type="submit" class="btn-join-success">
        <p>Done</p>
      </button>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ["projectId"]
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
