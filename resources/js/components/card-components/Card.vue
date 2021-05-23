<template>
  <div>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <div class="task-board-container">
      <div class="row">
        <div
          v-for="list in reactiveLists"
          :key="list.list_id"
          class="col-3"
          style="float: center"
        >
          <div class="task-board-top">
            <p>
              {{ list.list_name }}
              <i
                class="fa fa-plus"
                @click="addCard(list)"
                type="button"
                style="float: right"
              ></i>
            </p>
          </div>
          <Draggable
            :options="dragOptions"
            element="div"
            @end="changeOrder"
            v-model="list.cards"
          >
            <transition-group class="row" :id="list.list_id">
              <div
                v-for="card in list.cards"
                :key="card.list_id + ',' + card.order"
                class="col-12"
                style="float: center"
                :id="card.card_id"
              >
                <div class="divtask-card-container" type="button">
                  <div class="task-card-content">
                    <p>{{ card.card_name }}</p>
                  </div>
                  <div class="task-card-footer">
                    <i
                      class="fa fa-calendar-check-o"
                      aria-hidden="true"
                      type="button"
                    ></i>
                    <i
                      @click="editCard(card)"
                      class="fa fa-tags"
                      aria-hidden="true"
                      type="button"
                    ></i>
                    <i
                      @click="deleteCard(card.card_id)"
                      class="fa fa-trash"
                      aria-hidden="true"
                      type="button"
                    ></i>
                  </div>
                </div>
              </div>
            </transition-group>
          </Draggable>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Draggable from "vuedraggable";
export default {
  components: {
    Draggable,
  },
  props: ["divisionId", "lists"],
  data() {
    return {
      reactiveLists: this.lists,
      token: localStorage.getItem("token"),
    };
  },

  methods: {
    addCard(clickedList) {
      this.$emit("updateClickedList", clickedList);
      this.$emit("updateShowComponentCardManagement", "add-card");
    },
    editCard(clickedCard) {
      this.$emit("updateClickedCard", clickedCard);
      this.$emit("updateShowComponentCardManagement", "edit-card");
    },
    deleteCard(cardId) {
      axios
        .post(
          `api/card/${cardId}`,
          { _method: "delete" },
          {
            headers: { Authorization: "Bearer " + this.token },
          }
        )
        .then(() => {
          this.$router.go();
        });
    },
    changeOrder(data) {
      let toCard = data.to;
      let fromCard = data.from;
      let card_id = data.item.id;
      let list_id = fromCard.id == toCard.id ? null : toCard.id;
      let order = data.newIndex == data.oldIndex ? false : data.newIndex;

      console.log(card_id);
      console.log(order);

      if (order !== false) {
        axios
          .patch(
            `api/card/${card_id}`,
            { order: order, list_id: list_id, _method: "patch" },
            {
              headers: { Authorization: "Bearer " + this.token },
            }
          )
          .then((response) => {
            console.log(response.data);
          });
      }
    },
  },
  computed: {
    dragOptions() {
      return {
        animation: 1,
        group: "description",
        ghostClass: "ghost",
      };
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
