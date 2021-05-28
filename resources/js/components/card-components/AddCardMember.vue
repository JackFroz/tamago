<template>
  <div class="content-edit-project">
    <div class="row">
      <div class="col-1">
        <div class="edit-logo">
          <img :src="RocketImg" alt="" style="float: center" />
        </div>
      </div>
      <div class="col-4">
        <div class="form-create">
          <br />
          <br />
          <div class="assign-role">
            <h4>Assign Card Member {{ clickedCard.card_name }}</h4>
            <p>{{ message }}</p>

            <div
              class="row"
              v-for="nonMember in clickedCardNonMembers"
              :key="nonMember.member_id"
            >
              <div class="col-7">
                <p>{{ nonMember.username }}</p>
              </div>
              <div class="col-5">
                <button
                  @click="
                    assignCardMember(
                      clickedCard.card_id,
                      nonMember.member_id,
                      nonMember.username
                    )
                  "
                  class="btn-profile"
                >
                  <p>Add To Card Member</p>
                </button>
              </div>
            </div>

            <br />
            <br />

            <h4>Card Member {{ clickedCard.card_name }}</h4>
            <div
              class="row"
              v-for="member in clickedCardMembers"
              :key="member.member_id"
            >
              <div class="col-7">
                <p>{{ member.username }}</p>
              </div>
              <div class="col-5">
                <button
                  @click="removeCardMember(member.card_member_id)"
                  class="btn-profile"
                >
                  <p>Remove Card Member</p>
                </button>
              </div>
            </div>
          </div>

          <button @click="backToDivisionCards" class="btn-profile">
            <p>Exit</p>
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
      message: "",
      RocketImg: RocketImg,
      token: localStorage.getItem("token"),
    };
  },
  props: [
    "clickedCardMembers",
    "clickedCardNonMembers",
    "clickedCard",
    "divisionMembers",
    "project",
    "isOwnerTagged",
  ],
  methods: {
    backToDivisionCards() {
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
            this.message = "Card member added";
            this.$emit("updateLists");
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
          this.message = "Card member added!";
        });
    },
  },
};
</script>

<style lang="css">
@import "../../../css/app.css";
</style>
