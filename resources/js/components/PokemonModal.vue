<template>
    <v-dialog v-if="isVisible" class="flex flex-col w-50 rounded-lg justify-center items-center h-[300px]" @click:outside="closeModal">
        <v-card>
            <v-card-title class="text-3xl text-gray-700">{{ name }}</v-card-title>
        </v-card>
        <v-card-subtitle>
            <v-img
                class="rounded-md w-[80%] h-auto py-3"
                :src="gifLink"
                alt="pokemon image"
                contain
                aspect-ratio="1"
            ></v-img>
        </v-card-subtitle>
        <v-card-text>
            <div class="flex flex-col pt-1">
                <h2 class="text-2xl text-gray-700">Description:</h2>
                <span class="text-gray-600 pt-2">{{ description }}</span>
            </div>

            <span class="flex flex-row text-gray-700">Pokemon Type: {{ type1 }} / <p class="text-gray-600"> {{ type2 }}</p> </span>

            <!-- Stats -->
            <div class="flex flex-col pt-4">
                <h2 class="text-2xl text-gray-700">Stats:</h2>
                <div class="flex flex-col pt-2">
                    <div class="flex items-center">
                        <span class="text-gray-700 pr-2">HP:</span>
                        <div class="w-full bg-gray-200 rounded-lg">
                            <div class="bg-green-500 text-xs leading-none py-1 text-center text-white rounded-lg" :style="{ width: hpPercentage }">
                                {{ hp }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="text-gray-700 pr-2">Attack:</span>
                        <div class="w-full bg-gray-200 rounded-lg">
                            <div class="bg-green-500 text-xs leading-none py-1 text-center text-white rounded-lg" :style="{ width: attackPercentage }">
                                {{ attack }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="text-gray-700 pr-2">Speed:</span>
                        <div class="w-full bg-gray-200 rounded-lg">
                            <div class="bg-green-500 text-xs leading-none py-1 text-center text-white rounded-lg" :style="{ width: speedPercentage }">
                                {{ speed }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="text-gray-700 pr-2">Special Attack:</span>
                        <div class="w-full bg-gray-200 rounded-lg">
                            <div class="bg-green-500 text-xs leading-none py-1 text-center text-white rounded-lg" :style="{ width: specialAttackPercentage }">
                                {{ specialAttack }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </v-card-text>

        <v-card-actions>
            <div class="flex flex-row justify-center w-full">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4" @click="closeModal">Close</button>
            </div>
        </v-card-actions>
    </v-dialog>
</template>

<script>
import axios from 'axios';
import { VDialog, VCard, VCardTitle, VCardSubtitle, VCardText, VCardActions, VImg } from 'vuetify/components';


export default {
    name: 'PokemonModal',
    props: {
        id: {
            type: Number,
            required: true
        },
        isVisible: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            type1: '',
            type2: '',
            name: '',
            description: '',
            hp: 0,
            attack: 0,
            speed: 0,
            specialAttack: 0,
            gifLink: '' 
        }
    },
    watch: {
        id(newId) {
            if (newId && this.isVisible) {
                this.fetchPokemonData();
            }
        }
    },
    methods: {
        closeModal() {
            this.$emit('update:isVisible', false);
        },
        async fetchPokemonData() {
            try {
                const response = await axios.get(`/api/specificPokemon/${this.id}`);
                const data = response.data;
                this.type1 = data.type1;
                this.type2 = data.type2;
                this.name = data.name;
                this.description = data.description;
                this.hp = data.hp;
                this.attack = data.attack;
                this.speed = data.speed;
                this.specialAttack = data.special_attack;
                this.gifLink = data.gifLink;
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>
