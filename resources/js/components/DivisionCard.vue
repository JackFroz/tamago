<template>
  <div class="divisi-card-container">
    <div class="row">
      <div
        v-for="item in divisions"
        :key="item.division_id"
        class="col-3"
        style="float: center"
      >
        <div @click="openDivision(item.division_id)" class="project-card-div" type="button">
          <img src="images/folder 1.png" alt="" />
          <div class="project-card-div-top">
            <p>{{ item.division_name }}</p>
          </div>
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
      divisions: [],
      token: localStorage.getItem("token"),
    };
  },
  props: ["selectedProject", "taskData", "showProjectBoard"],
  created() {
    axios
      .get(`api/project/${this.selectedProject.project_id}/project-divisions`, {
        headers: { Authorization: "Bearer " + this.token },
      })
      .then((response) => {
        this.divisions = response.data.projectDivisions;
      });
  },
  methods: {
    openDivision(divisionId) {
      axios
        .get(`api/project-division/${divisionId}/progress-lists`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.showProjectBoard.showDivTaskBoard = true;
          this.showProjectBoard.showDivisionCard = false;
          this.showProjectBoard.showProjectDetail = false;
          let lists = response.data.progressLists;
          this.getLists(lists, divisionId);
          console.log(lists);
        });
    },
    getLists(lists, divisionId) {
      this.$emit('updateListData', lists);
      this.$emit('updateDivisionId', divisionId);
    }
  }
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
