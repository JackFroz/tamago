<template>
  <div class="divisi-card-container">
    <div class="row">
      <div
        v-for="item in divisions"
        :key="item.division_id"
        class="col-4"
        style="float: center"
      >
        <div class="project-card-div">
          <div class="row">
            <div class="col-12">
              <div
                @click="showDivision(item.division_id)"
                type="button"
                class="project-card-div-top"
              >
                <p>{{ item.division_name }}</p>
              </div>
            </div>
            <div class="col-12">
              <img :src="FolderImg" alt="" style="float: center" />
            </div>
          </div>
          <i
            v-if="ownership"
            @click="editDivision(item)"
            class="fa fa-pencil-square"
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
import FolderImg from "../../../images/folder.png";

export default {
  data() {
    return {
      FolderImg: FolderImg,
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
