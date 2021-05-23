<template>
  <div class="divisi-card-container">
    <div class="row">
      <div
        v-for="item in divisions"
        :key="item.division_id"
        class="col-3"
        style="float: center"
      >
        <div
          @click="showDivision(item.division_id)"
          class="project-card-div"
          type="button"
        >
          <img src="images/folder 1.png" alt="" />
          <div class="project-card-div-top">
            <p>{{ item.division_name }}</p>
          </div>
          <i
            v-if="ownership"
            @click="editDivision(item)"
            class="fa fa-tags"
            aria-hidden="true"
            type="button"
          ></i>
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
  props: ["divisions", "division", "ownership"],
  methods: {
    showDivision(divisionId) {
      this.$router.push({ name: "division-board", params: { id: divisionId } });
    },
    editDivision(division) {
      this.$emit("updateDivision", division);
      this.$emit("updateShowComponentProjectBoard", "edit-division");
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
