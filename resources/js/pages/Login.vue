<template>
  <Navbar/>
  <div class="flex flex-col items-center justify-center h-screen px-4">
    <div v-if="errorMessage" class="bg-red-500 rounded-md text-white p-4 mb-4">
      <p class="text-center">{{ errorMessage }}</p>
    </div>
    <div class="w-full max-w-sm">
      <form @submit.prevent="handleLogin" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-blue-500 focus:shadow-outline" type="email" required v-model="email">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-blue-500 focus:shadow-outline" type="password" required v-model="password">
        </div>
        <div class="flex items-center justify-between">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Login
          </button>
          <span class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-700">
            <router-link to="/register">Register</router-link>
          </span>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
    import Navbar from "../components/Navbar.vue";
    export default {
        name: 'Login',
        components: {
            Navbar
        },
        data() {
            return {
                email: '',
                password: '',
                errorMessage: '',

            }
        },
        methods: {
            async handleLogin(){
                try{

                    const response = await axios.post('/api/login', {
                        email: this.email,
                        password: this.password
                    });

                    localStorage.setItem('token', response.data.token);
                    this.$router.push('/insertPokemon');

                } catch (error){
                    this.errorMessage = error.response.data.message;
                }
            }
        }
    }
</script>
