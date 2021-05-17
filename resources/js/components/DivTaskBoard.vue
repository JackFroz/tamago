<template>
  <div>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <div class="task-board-container">
      <div class="row">
        <div class="col-3" style="float: center">
          <div class="task-board-top">
            <p>
              TO DO
              <i
                class="fa fa-plus"
                @click="addTask('TO DO')"
                type="button"
                style="float: right"
              ></i>
            </p>
          </div>
          <TaskCard v-bind:lists="todoData" />
        </div>
        <div class="col-3" style="float: center">
          <div class="task-board-top">
            <p>
              In Progress
              <i
                class="fa fa-plus"
                @click="addTask('In Progress')"
                type="button"
                style="float: right"
              ></i>
            </p>
          </div>
          <TaskCard v-bind:lists="inProgressData" />
        </div>
        <div class="col-3" style="float: center">
          <div class="task-board-top">
            <p>
              Ready
              <i
                class="fa fa-plus"
                @click="addTask('Ready')"
                type="button"
                style="float: right"
              ></i>
            </p>
          </div>
          <TaskCard v-bind:lists="readyData" />
        </div>
        <div class="col-3" style="float: center">
          <div class="task-board-top">
            <p>
              Complete
              <i
                class="fa fa-plus"
                @click="addTask('Complete')"
                type="button"
                style="float: right"
              ></i>
            </p>
          </div>
        </div>
        <TaskCard v-bind:lists="completeData" v-bind:divisionId="divisionId"/>
      </div>
      <AddTaskCard
        v-if="showAddTaskCard"
        v-bind:listName="listName"
        v-bind:showAddTaskCard="showAddTaskCard"
        v-bind:divisionId="divisionId"
      />
    </div>
  </div>
  <!--End Header-->
</template>

<script>
// @ is an alias to /src
import Sidenav from "./Sidenav.vue";
import AddTaskCard from "./AddTaskCard.vue";
import TaskCard from "./TaskCard.vue";
export default {
  components: {
    Sidenav,
    AddTaskCard,
    TaskCard,
  },
  data() {
    return {
      showAddTaskCard: false,
      listName: "",
      todoData: this.listData.todo,
      inProgressData: this.listData.inProgress,
      readyData: this.listData.ready,
      completeData: this.listData.complete,
    };
  },
  props: ['listData', 'divisionId'],
  methods: {
    addTask(listName) {
      this.listName = listName;
      this.showAddTaskCard = !this.showAddTaskCard;
    },
  },
};
</script>

<style lang="css">
@import "../../css/navbar.css";
</style>
