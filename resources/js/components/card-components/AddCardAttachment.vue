<template>
  <div class="content-attachment">
    <div class="row">
      <div class="col-1">
        <div class="edit-logo">
          <img :src="RocketImg" alt="" style="float: center" />
        </div>
      </div>
      <div class="col-7">
        <h4>Add URL Attachment to "{{ clickedCard.card_name }}"</h4>
        <h4>{{ messageAssign }}</h4>
        <div class="form-create">
          <input
            type="text"
            class="form-control"
            id="task-title"
            placeholder="Input URL name"
            v-model="attachmentForm.attachment_name"
          />
          <input
            type="text"
            class="form-control"
            id="task-title"
            placeholder="Input URL"
            v-model="attachmentForm.attachment_url"
          />
          <button @click="addCardAttachment" class="btn-profile">
            <p>Add</p>
          </button>
          <br />
          <button @click="backToLists" class="btn-profile">
            <p>Close</p>
          </button>
        </div>
        <div class="form-group">
          <br />
          <br />

          <h4>Attachments of "{{ clickedCard.card_name }}"</h4>
          <h4>{{ messageRemove }}</h4>
          <div
            class="row"
            v-for="attachment in clickedCardAttachments"
            :key="attachment.attachment_id"
          >
            <div class="col-7">
              <a :href="attachment.attachment_url">{{
                attachment.attachment_name
              }}</a>
            </div>
            <div class="col-3">
              <button
                @click="removeCardAttachment(attachment.attachment_id)"
                class="btn-profile"
              >
                <p>Remove</p>
              </button>
            </div>
          </div>
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
      RocketImg: RocketImg,
      messageAssign: "",
      messageRemove: "",
      attachmentForm: {
        attachment_name: "",
        attachment_url: "",
        card_id: this.clickedCard.card_id,
      },
      token: localStorage.getItem("token"),
    };
  },
  methods: {
    backToLists() {
      this.$emit("updateShowComponentCardManagement", "card");
    },
    addCardAttachment() {
      axios
        .post("api/attachment", this.attachmentForm, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          if (response.data.status) {
            this.$emit("updateClickedCardAttachments", this.clickedCard);
            this.messageAssign = "Attachment added!";
            var that = this;
            setTimeout(function() {
              that.messageAssign = "";
            }, 5000);
          } else {
            this.messageAssign = "Failed to add attachment!";
            var that = this;
            setTimeout(function() {
              that.messageAssign = "";
            }, 5000);
          }
        });
    },
    removeCardAttachment(attachmentId) {
      axios
        .post(
          `api/attachment/${attachmentId}`,
          { _method: "delete" },
          {
            headers: { Authorization: "Bearer " + this.token },
          }
        )
        .then((response) => {
          if (response.data.status) {
            this.$emit("updateClickedCardAttachments", this.clickedCard);
            this.messageRemove = "Attachment removed!";
            var that = this;
            setTimeout(function() {
              that.messageRemove = "";
            }, 5000);
          } else {
            this.messageRemove = "Failed to remove attachment!";
            var that = this;
            setTimeout(function() {
              that.messageRemove = "";
            }, 5000);
          }
        });
    },
  },
  props: ["clickedCard", "clickedCardAttachments"],
};
</script>
