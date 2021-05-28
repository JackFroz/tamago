<template>
  <div class="task-card-container">
    <div class="task-card-top">
      <p>Edit Task</p>
    </div>
    <div class="task-card">
      <h4>Edit Details</h4>
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          id="task-title"
          placeholder="input Task Title"
          v-model="cardForm.card_name"
        />
      </div>
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          id="task-title"
          placeholder="Input Description of Project Task"
          v-model="cardForm.card_desc"
        />
      </div>
      <br />
      <button
        @click="addCard"
        type="submit"
        class="btn-submit"
        style="float: right"
      >
        <p>Save</p>
      </button>
      <!-- <button
        @click="backToLists"
        type="submit"
        class="btn-submit"
        style="float: right"
      >
        <p>Close</p>
      </button> -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cardForm: {
        card_name: this.clickedCard.card_name,
        card_desc: this.clickedCard.card_desc,
        card_deadline: this.clickedCard.card_deadline,
      },
      token: localStorage.getItem("token"),
    };
  },
  props: ["clickedCard"],
  methods: {
    backToLists() {
      this.$emit("updateShowComponentCardManagement", "card");
    },
    addCard() {
      axios
        .patch(`api/card/${this.clickedCard.card_id}`, this.cardForm, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then(() => {
          this.$router.go();
        });
    },
  },
  created() {},
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
