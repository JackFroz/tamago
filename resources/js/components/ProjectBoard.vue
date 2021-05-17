<template>
  <div>
    <!--Header-->
    <div class="fixed-top judul-page">
      <p class="top-bar">
        {{ selectedProject.project_name }}
      </p>
    </div>
    <!--End Header-->
    <div class="content-home-bg">
      <DivTaskBoard
        v-bind:showProjectBoard="showProjectBoard"
        v-bind:listData="listData"
        v-if="showProjectBoard.showDivTaskBoard"
        v-bind:divisionId="divisionId"
      />
      <ProjectDetail
        v-bind:selectedProject="selectedProject"
        v-bind:showProjectBoard="showProjectBoard"
        v-if="showProjectBoard.showProjectDetail"
      />
      <DivisionCard
        v-bind:selectedProject="selectedProject"
        v-bind:showProjectBoard="showProjectBoard"
        v-bind:listData="listData"
        v-bind:divisionId="divisionId"
        @updateListData="updateListData"
        @updateDivisionId="updateDivisionId"
        v-if="showProjectBoard.showDivisionCard"
      />
      <CreateDivision
        v-bind:selectedProject="selectedProject"
        v-if="showProjectBoard.showCreateDivision"
      />
    </div>
  </div>
</template>

<script>
import ProjectDetail from "./ProjectDetail.vue";
import DivisionCard from "./DivisionCard.vue";
import CreateDivision from "./CreateDivision.vue";
import DivTaskBoard from "./DivTaskBoard.vue";

export default {
  data() {
    return {
      showProjectBoard: {
        showDivisionCard: true,
        showProjectDetail: true,
        showCreateDivision: false,
        showDivTaskBoard: false,
      },
      divisionId: "",
      listData: [],
    };
  },
  components: {
    ProjectDetail,
    DivisionCard,
    CreateDivision,
    DivTaskBoard,
  },
  props: ["selectedProject"],
  methods: {
    updateListData(lists) {
      this.listData = lists;
    },
    updateDivisionId(divisionId) {
      this.divisionId = divisionId;
    },
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
