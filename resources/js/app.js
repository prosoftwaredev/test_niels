require("./bootstrap");
require("alpinejs");

import { createApp, h } from "vue";
import { createWebHistory, createRouter } from "vue-router";
import axios from "axios";
import VueAxios from "vue-axios";

import App from "./App.vue";
import List from "./components/List.vue";
import Edit from "./components/Edit.vue";
import Create from "./components/Create.vue";

const routes = [
    {
        path: "/employments",
        name: "List",
        component: List,
    },
    {
        path: "/employments/edit/:id",
        name: "Edit",
        component: Edit,
    },
    {
        path: "/employments/create",
        name: "Create",
        component: Create,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

const app = createApp(App);
app.use(router);
app.use(VueAxios, axios);
app.mount("#app");
