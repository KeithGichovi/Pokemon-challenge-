<template>
    <div>
        <nav class="bg-blue-500 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <router-link to="/" class="text-white">CI-Group-Pokemon</router-link>
                <div v-if="!isAuthenticated">
                    <router-link to="/login" class="text-white mx-2 hover:text-gray-800">Login</router-link>
                    <router-link to="/register" class="text-white mx-2 hover:text-gray-800">Register</router-link>
                </div>
               <div v-else>
                    <router-link to="/insertPokemon" class="text-white mx-2 hover:text-gray-800">Insert Pokemon</router-link>
                    <router-link to="/pokemonTable" class="text-white mx-2 hover:text-gray-800">View Pokemon</router-link>
                    <span @click.prevent="logout" class="text-white mx-2 cursor-pointer hover:text-gray-800">Logout</span>
                </div>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: 'Navbar',
        data(){
            return{
                isAuthenticated: false,
            }
        },
        methods:{
            checkAuth(){
                const token = localStorage.getItem('token');
                this.isAuthenticated = !!token;
            },
            logout() {

                localStorage.removeItem('token');
                this.isAuthenticated = false;
                this.$router.push('/login');

            }
        },
        created() {
            this.checkAuth();
        }
    }
</script>

