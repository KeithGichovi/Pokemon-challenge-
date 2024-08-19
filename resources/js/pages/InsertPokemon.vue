<template>
    <Navbar/>
    <div class="flex flex-col items-center justify-center h-screen px-4">
        <div v-if="errorMessage" class="bg-red-500 rounded-md text-white p-4 mb-4">
            <p class="text-center">{{ errorMessage }}</p>
        </div>
        <div class="w-full max-w-sm">
            <form @submit.prevent="handleFiles" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4 flex flex-col items-center">
                <!-- File Input -->
                <div class="w-full mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fileInput">
                        Choose a CSV file:
                    </label>
                    <input
                        type="file"
                        accept=".csv"
                        class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border file:border-gray-300 file:bg-gray-50 file:text-blue-700 hover:file:bg-blue-100"
                        ref="fileInput"
                        id="fileInput"
                    />
                </div>
                <!-- Submit Button -->
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >
                    Upload Pokemon CSV
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Navbar from "../components/Navbar.vue";

export default {
    name: 'InsertPokemon',
    components: {
        Navbar
    },
    data() {
        return {
            errorMessage: '',
        }
    },
    methods: {
        async handleFiles() {
            try {
                // get the file from the input
                const file = this.$refs.fileInput.files[0];
                if (!file) {
                    throw new Error('No file selected');
                }
                // create a new FormData object
                const formData = new FormData();
                // append the file to the FormData object
                formData.append('pokemon_csv', file);
                // send the file to the server
                await axios.post('/api/insertPokemoncsv', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    }
                });
                // Show success message and redirect
                this.errorMessage = 'Pokemon CSV uploaded successfully';
                setTimeout(() => {
                    this.$router.push('/pokemonTable');
                }, 2000);

            } catch (error) {
                this.errorMessage = error.response?.data?.message || 'An error occurred during upload';
            }
        }
    }
}
</script>
