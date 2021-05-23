<template>
  <div class="project-card-container">
    <div class="row">
      <div
        v-for="item in projects.owned"
        :key="item.project_id"
        class="col-3"
        style="float: center"
      >
        <div
          class="project-card"
          type="button"
          @click="getProjectBoard(item.project_id)"
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
    <div class="row">
      <div
        v-for="item in projects.guest"
        :key="item.project_id"
        class="col-3"
        style="float: center"
      >
        <div
          class="project-card"
          type="button"
          @click="getProjectBoard(item.project_id)"
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
  props: ["projects"],
  methods: {
    getProjectBoard(projectId) {
      this.$router.push({name: 'project-board', params: { id: projectId }})
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
