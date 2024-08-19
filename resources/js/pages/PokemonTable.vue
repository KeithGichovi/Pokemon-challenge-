<template>
  <Navbar />
  <div class="flex flex-col items-center justify-center min-h-screen py-8 px-4">
    <!-- No data message -->
    <div v-if="pokemonData.length === 0" class="w-full max-w-3xl mx-auto text-center">
      <h1 class="text-3xl md:text-5xl text-blue-500 font-bold">No Pokemon data yet.</h1>
    </div>

    <!-- DataTable -->
    <div v-else class="mx-auto max-w-[1300px]">
      <v-data-table
        :headers="headers"
        :items="paginatedPokemonData"
        :items-per-page="itemsPerPage"
        :single-select="true"
        item-key="name"
        show-select
        class="min-w-full"
        style="table-layout: fixed;"
      >
        <!-- Slot for rendering the GIF column -->
        <template v-slot:item.gif_link="{ item }">
          <v-img :src="item.gif_link" max-height="50" max-width="50" />
        </template>

        <!--- pagination --->
        <template v-slot:bottom>
            <div class="flex justify-between items-center py-3">
                <v-select
                  v-model="itemsPerPage"
                  :items="[10, 25, 50, 100]"
                  label="Items per page"
                  dense
                  hide-details
                  class="max-w-[150px]"
                ></v-select>
                <v-pagination
                  v-model="page"
                  :length="pageCount"
                ></v-pagination>
            </div>
        </template>

      </v-data-table>
    </div>
    
  </div>
</template>

<script>
  import Navbar from "../components/Navbar.vue";
  import axios from "axios";
  import { VDataTable, VImg, VPagination, VSelect } from "vuetify/components";

  export default {
    name: "PokemonTable",
    components: {
      Navbar,
      VDataTable,
      VImg,
      VPagination,
      VSelect,
    },
    data() {
      return {
        pokemonData: [],
        page: 1,
        itemsPerPage: 10,
        headers: [
          { title: "Pokemon", value: "name", sortable: true },
          { title: "Type 1", value: "type1", sortable: true },
          { title: "Type 2", value: "type2", sortable: true },
          { title: "Attack", value: "Attack", sortable: true },
          { title: "GIF", value: "gif_link", sortable: false },
        ],
      };
    },
    methods: {
      async fetchPokemonData() {
        try {
          const response = await axios.get("/api/displayPokemon");
          this.pokemonData = response.data;
        } catch (error) {
          console.error("Failed to fetch Pokémon data:", error);
        }
      },
    },
    mounted() {
      this.fetchPokemonData();
    },
    computed: {
      pageCount() {
        return Math.ceil(this.pokemonData.length / this.itemsPerPage)
      },
      paginatedPokemonData(){
        const start = (this.page - 1) * this.itemsPerPage;
        const end = start + this.itemsPerPage;
        return this.pokemonData.slice(start, end);
      }
    },
    watch: {
      itemsPerPage(){
        this.page = 1;
      }
    } 
  };
</script>
