<template>
    <Navbar/>
    <div class="flex flex-col items-center mt-20 h-screen px-4">
        <div class="w-full max-w-7xl mx-auto items-center justify-center" v-if="pokemonData.length == 0">
            <h1 class="text-5xl text-blue-500">No Pokemon data yet.</h1>
        </div>
        <div class="w-full max-w-7xl mx-auto" v-else>
            <!-- <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Pokemon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Type 1</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Type 2</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Attack</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Speed</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">More Details</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="pokemon in pokemonData" :key="pokemon.id">
                        <td class="px-6 py-4 whitespace-nowrap">{{ pokemon.name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ pokemon.type1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ pokemon.type2 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ pokemon.Attack }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ pokemon.Speed }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="text-blue-500 hover:text-blue-700" @click="handleModal(pokemon.id)">More Details</button>
                        </td>
                    </tr>
                </tbody>
            </table> -->
            <v-data-table
                :items="pokemonData"
                :headers="[
                    { text: 'Pokemon', value: 'name', filterable: true },
                    { text: 'Type 1', value: 'type1', filterable: true },
                    { text: 'Type 2', value: 'type2', filterable: true },
                    { text: 'Attack', value: 'Attack', filterable: true },
                    { text: 'Speed', value: 'Speed', filterable: true },
                    { text: 'More Details', value: 'id' },
                ]"
                item-key="id"
                :search="search"
                :items-per-page="10"
                class="elevation-1 px-6 py-4 whitespace-nowrap"
                :filter="filter"
            >
            </v-data-table>
        </div>
        <!-- <PokemonModal
            v-if="showModal"
            :id="selectedPokemonId"
            :isVisible="showModal"
            @update:isVisible="showModal = $event"
        /> -->
    </div>
</template>

<script>
    import Navbar from "../components/Navbar.vue";
    import axios from 'axios';
    import PokemonModal from "../components/PokemonModal.vue";
    import { VDataTable } from "vuetify/components";

    export default {
        name: 'PokemonTable',
        components: {
            Navbar,
            PokemonModal
        },
        data() {
            return {
                pokemonData: [],
                showModal: false,
                selectedPokemonId: null,
            }
        },
        methods: {
            async fetchPokemonData() {
                try {
                    const response = await axios.get('/api/displayPokemon');
                    this.pokemonData = response.data;
                } catch (error) {
                    console.error(error);
                }
            },
            handleModal(id) {
                this.selectedPokemonId = id;
                this.showModal = true;
            }
        },
        mounted() {
            this.fetchPokemonData();
        },
    }
</script>
