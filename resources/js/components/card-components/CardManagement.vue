<template>
  <div>
    <Card
      v-if="showComponentCardManagement === 'card'"
      v-bind:divisionId="divisionId"
      v-bind:lists="lists"
      v-bind:canEdit="canEdit"
      @updateClickedList="updateClickedList"
      @updateClickedCard="updateClickedCard"
      @updateClickedCardMembers="updateClickedCardMembers"
      @updateClickedCardAttachments="updateClickedCardAttachments"
      @updateShowComponentCardManagement="updateShowComponentCardManagement"
    />
    <AddCard
      v-if="showComponentCardManagement === 'add-card'"
      v-bind:clickedList="clickedList"
      @updateLists="updateLists"
      @updateShowComponentCardManagement="updateShowComponentCardManagement"
    />
    <AddCardAttachment
      v-if="showComponentCardManagement === 'add-card-attachment'"
      v-bind:clickedCard="clickedCard"
      v-bind:clickedCardAttachments="clickedCardAttachments"
      @updateClickedCardAttachments="updateClickedCardAttachments"
      @updateShowComponentCardManagement="updateShowComponentCardManagement"
    />
    <AddCardMember
      v-if="showComponentCardManagement === 'add-card-member'"
      v-bind:clickedCard="clickedCard"
      v-bind:clickedCardMembers="clickedCardMembers"
      v-bind:clickedCardNonMembers="clickedCardNonMembers"
      v-bind:project="project"
      @updateClickedCardMembers="updateClickedCardMembers"
      @updateShowComponentCardManagement="updateShowComponentCardManagement"
    />
    <EditCard
      v-if="showComponentCardManagement === 'edit-card'"
      v-bind:clickedCard="clickedCard"
      @updateLists="updateLists"
      @updateShowComponentCardManagement="updateShowComponentCardManagement"
    />
  </div>
</template>

<script>
import Card from "./Card.vue";
import AddCard from "./AddCard.vue";
import AddCardAttachment from "./AddCardAttachment.vue";
import AddCardMember from "./AddCardMember.vue";
import EditCard from "./EditCard.vue";

export default {
  components: {
    Card,
    AddCard,
    AddCardAttachment,
    AddCardMember,
    EditCard,
  },
  data() {
    return {
      clickedList: [],
      clickedCard: [],
      clickedCardMembers: [],
      clickedCardNonMembers: [],
      clickedCardAttachments: [],
      showComponentCardManagement: "card",
      token: localStorage.getItem("token"),
    };
  },
  props: ["divisionId", "project", "lists", "divisionMembers", "canEdit"],
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
    updateClickedCardAttachments(card) {
      this.getAttachments(card.card_id);
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
          this.clickedCardNonMembers = [];
          console.log("card-member",this.clickedCardMembers);
          this.$emit("updateDivisionMembers");
          let temp = this.divisionMembers;
          console.log("division-member",this.divisionMembers)
          this.divisionMembers.forEach((divMem, index) => {
            this.clickedCardMembers.forEach((mem) => {
              if(divMem.username === mem.username)
                temp[index] = null;
            });
          });

          temp.forEach((member) => {
            if (member !== null) this.clickedCardNonMembers.push(member);
          });

          console.log("non-card-member",this.clickedCardNonMembers);
        });
    },
    getAttachments(cardId) {
      axios
        .get(`api/card/${cardId}/attachments`, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.clickedCardAttachments = response.data;
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
