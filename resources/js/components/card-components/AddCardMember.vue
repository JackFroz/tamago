<template>
  <div class="content-add-member">
    <div class="row">
      <div class="col-1">
        <div class="edit-logo">
          <img :src="RocketImg" alt="" style="float: center" />
        </div>
      </div>
      <div class="col-4">
        <div class="form-create">
          <div class="assign-member">
            <h4>Assign Card Member to "{{ clickedCard.card_name }}"</h4>
            <p>{{ messageAssign }}</p>

            <div
              class="row"
              v-for="nonMember in clickedCardNonMembers"
              :key="nonMember.member_id"
            >
              <div class="col-7">
                <p>{{ nonMember.username }}</p>
              </div>
              <div class="col-3">
                <button
                  @click="
                    assignCardMember(
                      clickedCard.card_id,
                      nonMember.member_id,
                      nonMember.username
                    )
                  "
                  class="btn-edit"
                >
                  <p>Add</p>
                </button>
              </div>
            </div>

            <br />
            <br />

            <h4>Card Members of "{{ clickedCard.card_name }}"</h4>
            <p>{{ messageRemove }}</p>

            <div
              class="row"
              v-for="member in clickedCardMembers"
              :key="member.member_id"
            >
              <div class="col-7">
                <p>{{ member.username }}</p>
              </div>
              <div class="col-3">
                <button
                  @click="removeCardMember(member.card_member_id)"
                  class="btn-edit"
                >
                  <p>Remove</p>
                </button>
              </div>
            </div>
          </div>

          <button @click="backToLists" class="btn-profile">
            <p>Close</p>
          </button>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import RocketImg from "../../../images/rocket.png";

export default {
  data() {
    return {
      messageAssign: "",
      messageRemove: "",
      RocketImg: RocketImg,
      token: localStorage.getItem("token"),
    };
  },
  props: [
    "clickedCardMembers",
    "clickedCardNonMembers",
    "clickedCard",
    "project",
    "isOwnerTagged",
  ],
  methods: {
    backToLists() {
      this.$emit("updateShowComponentCardManagement", "card");
    },
    assignCardMember(cardId, memberId, username) {
      axios
        .post(
          "api/card-member",
          { card_id: cardId, member_id: memberId, username: username },
          {
            headers: { Authorization: "Bearer " + this.token },
          }
        )
        .then((response) => {
          if (response.data.status) {
            this.$emit("updateClickedCardMembers", this.clickedCard);
            this.messageAssign = "Card member added!";
            var that = this;
            setTimeout(function() {
              that.messageAssign = "";
            }, 5000);
          } else {
            this.messageAssign = "Failed to add card member!";
            var that = this;
            setTimeout(function() {
              that.messageAssign = "";
            }, 5000);
          }
        });
    },
    removeCardMember(cardMemberId) {
      axios
        .post(
          `api/card-member/${cardMemberId}`,
          { _method: "delete" },
          {
            headers: { Authorization: "Bearer " + this.token },
          }
        )
        .then((response) => {
          if (response.data.status) {
            this.$emit("updateClickedCardMembers", this.clickedCard);
            this.messageRemove= "Card member removed!";
            var that = this;
            setTimeout(function() {
              that.messageRemove = "";
            }, 5000);
          } else {
            this.messageRemove = "Failed to remove card member!";
            var that = this;
            setTimeout(function() {
              that.messageRemove = "";
            }, 5000);
          }
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
