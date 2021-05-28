<template>
  <div class="task-card-container">
    <div class="task-card-top">
      <p>Add New Task ({{ clickedList.list_name }})</p>
    </div>
    <div class="task-card">
      <h4>Project Task</h4>
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
      <h4>Add to Card</h4>

      <button
        @click="addCard"
        type="submit"
        class="btn-submit"
        style="float: right"
      >
        <p>Create</p>
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
        card_name: null,
        card_desc: null,
        card_deadline: null,
        list_id: this.clickedList.list_id,
        order: this.clickedList.cards.length,
      },
      token: localStorage.getItem("token"),
    };
  },
  props: ["clickedList"],
  methods: {
    backToLists() {
      this.$emit("updateShowComponentCardManagement", "card");
    },
    addCard() {
      axios
        .post("api/card", this.cardForm, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then(() => {
          this.$router.go();
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
