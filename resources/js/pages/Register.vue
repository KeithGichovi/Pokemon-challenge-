<template>
  <Navbar/>
  <div class="flex flex-col items-center justify-center h-screen px-4">
    <div v-if="http.status && (http.status !== 200 && http.status !== 201)" class="bg-red-500 rounded-md text-white p-4 mb-4">
      <p class="text-center">{{ errorMessage }}</p>
    </div>
    <div class="w-full max-w-sm">
      <form @submit.prevent="handleRegister" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-blue-500 focus:shadow-outline" type="text" required v-model="name">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-blue-500 focus:shadow-outline" type="email" required v-model="email">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-blue-500 focus:shadow-outline" type="password" required v-model="password">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-blue-500 focus:shadow-outline" type="password" required v-model="password_confirmation">
        </div>

        <div class="flex items-center justify-between">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Register
          </button>
          <span class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-700">
            <router-link to="/login">Login</router-link>
          </span>
        </div>
      </form>
    </div>
  </div>
</template>


<script>

    import axios from "axios";
    import Navbar from "../components/Navbar.vue";
    import { useRouter } from "vue-router";

    const router = useRouter();

    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                errorMessage: '',
                http: {
                    status: null,
                }
            }
        },
        name: 'Register',
        components: {
            Navbar
        },
        methods: {
            async handleRegister(e) {
              //console.log({"name":this.name, "email": this.email, "password": this.password, "password_confirmation": this.password_confirmation});
                e.preventDefault();
                try {
                    const response = await axios.post('/api/register', {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation
                    });
                    if (response.status === 201) {
                        // Redirect to login page
                        this.$router.push('/login');
                    } else {
                        this.http.status = response.status;
                        this.errorMessage = response.data.message || 'An unexpected error occurred';
                    }
                } catch (error) {
                  if (error.response) {
                    // Handle errors from the server
                    this.http.status = error.response.status;
                    this.errorMessage = error.response.data.message || 'An unexpected error occurred';

                    // Display field-specific errors if available
                    if (error.response.data.errors) {
                      this.errorMessage = Object.values(error.response.data.errors).flat().join(', ');
                    }
                  } else {
                    // Handle errors that are not from the server
                    this.errorMessage = 'An unexpected error occurred';
                  }
                }
            }
        }
    }
</script>
