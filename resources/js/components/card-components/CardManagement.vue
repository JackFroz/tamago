<template>
  <div>
    <Card
      v-if="showComponentCardManagement === 'card'"
      v-bind:divisionId="divisionId"
      v-bind:lists="lists"
      @updateClickedList="updateClickedList"
      @updateClickedCard="updateClickedCard"
      @updateShowComponentCardManagement="updateShowComponentCardManagement"
    />
    <AddCard
      v-if="showComponentCardManagement === 'add-card'"
      v-bind:clickedList="clickedList"
      @updateShowComponentCardManagement="updateShowComponentCardManagement"
    />
    <EditCard
      v-if="showComponentCardManagement === 'edit-card'"
      v-bind:clickedCard="clickedCard"
      @updateShowComponentCardManagement="updateShowComponentCardManagement"
    />
  </div>
</template>

<script>
import Card from "./Card.vue";
import AddCard from "./AddCard.vue";
import EditCard from "./EditCard.vue";

export default {
  components: {
    Card,
    AddCard,
    EditCard,
  },
  data() {
    return {
      clickedList: [],
      clickedCard: [],
      showComponentCardManagement: "card",
    };
  },
  props: ["divisionId", "lists", "cards"],
  methods: {
    updateShowComponentCardManagement(componentName) {
      this.showComponentCardManagement = componentName;
    },
    updateClickedList(list) {
      this.clickedList = list;
    },
    updateClickedCard(card) {
      this.clickedCard = card;
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
