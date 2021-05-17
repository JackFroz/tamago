<template>
  <div class="project-card-container">
    <div class="row">
      <div
        v-for="item in projects"
        :key="item.project_id"
        class="col-3"
        style="float: center"
      >
        <div
          class="project-card"
          type="button"
          @click="getDetail(item.project_id)"
        >
          <div class="project-card-top">
            <p>{{ item.project_name }}</p>
          </div>
          <p>
            {{ item.project_desc }}
          </p>
        </div>
        <br />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      token: localStorage.getItem("token"),
    };
  },
  props: ["projects"],
  methods: {
    getDetail(projectId) {
      axios
        .get(`api/project/${projectId}`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          let project = response.data;
          this.$emit("updateSelectedProject", project);
        });
    },
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
