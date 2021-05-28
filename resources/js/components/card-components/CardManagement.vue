<template>
  <div>
    <Card
      v-if="showComponentCardManagement === 'card'"
      v-bind:divisionId="divisionId"
      v-bind:lists="lists"
      @updateClickedList="updateClickedList"
      @updateLists="updateLists"
      @updateClickedCard="updateClickedCard"
      @updateClickedCardMembers="updateClickedCardMembers"
      @updateShowComponentCardManagement="updateShowComponentCardManagement"
    />
    <AddCard
      v-if="showComponentCardManagement === 'add-card'"
      v-bind:clickedList="clickedList"
      @updateShowComponentCardManagement="updateShowComponentCardManagement"
    />
    <AddCardMember
      v-if="showComponentCardManagement === 'add-card-member'"
      v-bind:clickedCard="clickedCard"
      v-bind:divisionMembers="divisionMembers"
      v-bind:clickedCardMembers="clickedCardMembers"
      v-bind:clickedCardNonMembers="clickedCardNonMembers"
      v-bind:project="project"
      @updateLists="updateLists"
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
import AddCardMember from "./AddCardMember.vue";
import EditCard from "./EditCard.vue";

export default {
  components: {
    Card,
    AddCard,
    AddCardMember,
    EditCard,
  },
  data() {
    return {
      clickedList: [],
      clickedCard: [],
      clickedCardMembers: [],
      clickedCardNonMembers: [],
      showComponentCardManagement: "card",
      token: localStorage.getItem("token"),
    };
  },
  props: ["divisionId", "project", "lists", "divisionMembers"],
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
    updateClickedCardMembers(card) {
      this.getCardMembers(card.card_id);
    },
    updateLists() {
      this.$emit("updateLists");
    },
    getCardMembers(cardId) {
      axios
        .get(`api/card/${cardId}/card-members`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.clickedCardMembers = response.data;
          this.clickedCardNonMembers = this.divisionMembers;
          this.clickedCardNonMembers.forEach((nonMember, indexNonMember) => {
            this.clickedCardMembers.forEach(member => {
              if(nonMember.member_id === member.member_id) 
                this.clickedCardNonMembers[indexNonMember] = null;
            });
          });
          this.clickedCardNonMembers = this.clickedCardNonMembers.filter(obj => obj);
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
