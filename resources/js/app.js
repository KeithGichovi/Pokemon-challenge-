import "./bootstrap";
import { createApp } from "vue";
import router from "./router.js";
import { createVuetify } from "vuetify";

import App from "./App.vue";
const vuetify = createVuetify();

createApp(App)
    .use(router)
    .use(vuetify)
    .mount("#app");
