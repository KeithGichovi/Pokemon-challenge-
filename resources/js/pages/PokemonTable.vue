<template>
    <Navbar/>
    <div class="flex flex-col items-center mt-20 h-screen px-4">
        <div class="w-full max-w-7xl mx-auto items-center justify-center">
            <h1 class="text-xl">No Pokemon data yet. </h1>
        </div>
        <div class="w-full max-w-7xl mx-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg">
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
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Bulbasaur</td>
                        <td class="px-6 py-4 whitespace-nowrap">Grass</td>
                        <td class="px-6 py-4 whitespace-nowrap">Poison</td>
                        <td class="px-6 py-4 whitespace-nowrap">49</td>
                        <td class="px-6 py-4 whitespace-nowrap">45</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="text-blue-500 hover:text-blue-700"> More Details</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>



<script>
    import Navbar from "../components/Navbar.vue";


    export default {
        name: 'PokemonTable',
        components: {
            Navbar
        },
        data(){
            return {


            }
        },
        methods: {

        }
    }
</script>
