import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import App from "./pages/App";
import Landing from "./pages/Landing";
import Login from "./pages/Login";
import Register from "./pages/Register";
import Home from "./pages/Home";
import Profile from "./pages/Profile";
import ProjectBoard from "./pages/ProjectBoard";
import DivisionBoard from "./pages/DivisionBoard";

const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/",
      name: "landing",
      component: Landing,
    },
    {
      path: "/login",
      name: "login",
      component: Login,
    },
    {
      path: "/register",
      name: "register",
      component: Register,
    },
    {
      path: "/home",
      name: "home",
      component: Home,
      meta: {
        requiresAuth: true,
      },
    },
    {
      path: "/profile",
      name: "profile",
      component: Profile,
      meta: {
        requiresAuth: true,
      },
    },
    {
      path: "/project/:id",
      name: "project-board",
      component: ProjectBoard,
      meta: {
        requiresAuth: true,
      },
    },
    {
      path: "/division/:id",
      name: "division-board",
      component: DivisionBoard,
      meta: {
        requiresAuth: true,
      },
    },
  ],
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem("token");
  const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
  if (requiresAuth) {
    axios
      .get("api/user", {
        headers: { Authorization: "Bearer " + token },
      })
      .then(() => {
        next();
      })
      .catch(() => {
        router.push({ name: "login" });
      });
  } else next();
});

const app = new Vue({
  el: "#app",
  components: { App },
  router,
});
