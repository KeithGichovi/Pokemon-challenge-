import { createRouter, createMemoryHistory } from 'vue-router';
import Home from "./pages/Home.vue";
import Login from "./pages/Login.vue";
import Register from "./pages/Register.vue";
import InsertPokemon from "./pages/InsertPokemon.vue";
import PokemonTable from "./pages/PokemonTable.vue";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/insertPokemon',
        name: 'insertPokemon',
        component: InsertPokemon,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/pokemonTable',
        name: 'pokemonTable',
        component: PokemonTable,
        meta: {
            requiresAuth: true
        }
    },
];

const router = createRouter({
    history: createMemoryHistory(),
    routes,
});


export default router;
