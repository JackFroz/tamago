<template>
  <div class="task-card-container">
    <div class="task-card-top">
      <p>Add New Card to "{{ clickedList.list_name }}"</p>
    </div>
    <div class="task-card">
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
          placeholder="Input Description of Task"
          v-model="cardForm.card_desc"
        />
      </div>
      <div class="form-group">
        <input
          type="date"
          class="form-control"
          id="task-title"
          v-model="cardForm.card_deadline"
        />
      </div>
      <br />

      <button
        @click="addCard"
        type="submit"
        class="btn-submit"
        style="float: right"
      >
        <p>Add</p>
      </button>
      <button
        @click="backToLists"
        type="submit"
        class="btn-submit"
        style="float: right"
      >
        <p>Close</p>
      </button>
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
          this.$emit("updateLists");
          this.$emit("updateShowComponentCardManagement", "card");
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
