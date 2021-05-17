<template>
  <div class="task-card-container">
    <div class="task-card-top">
      <p>Add New Task ({{ cardData.division_id }})</p>
    </div>
    <div class="task-card">
      <h4>Project Task</h4>
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          id="task-title"
          placeholder="input Task Title"
          v-model="cardData.card_name"
        />
      </div>
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          id="task-title"
          placeholder="Input Description of Project Task"
          v-model="cardData.card_desc"
        />
      </div>
      <br />
      <h4>Add to Card</h4>
      <div class="addition">
        <div class="row">
          <div class="col-4" style="float: center">
            <div class="addition-button" type="button">
              <p>Member</p>
            </div>
          </div>
          <div class="col-4" style="float: center">
            <div class="addition-button" type="button">
              <p>Due Date</p>
            </div>
          </div>
          <div class="col-4" style="float: center">
            <div class="addition-button" type="button">
              <p>Attachment</p>
            </div>
          </div>
        </div>
      </div>
      <button
        @click="addTask"
        type="submit"
        class="btn-submit"
        style="float: right"
      >
        <p>Create</p>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      token: localStorage.getItem("token"),
      cardData: {
        list_name: this.listName,
        division_id: this.divisionId, 
        card_name: "",
        card_desc: "",
        card_deadline: null,
        order: 0,
      },
    };
  },
  props: ["listName", "showAddTaskCard", "divisionId"],
  methods: {
    addTask() {
      axios
        .post("/api/card", this.cardData, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.showAddTaskCard = !this.showAddTaskCard;
          console.log(response.data);
        });
    },
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
