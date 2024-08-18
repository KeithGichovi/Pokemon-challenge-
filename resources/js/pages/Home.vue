<template>
    <Navbar/>
    <div class="h-screen flex flex-col items-center justify-center">
        <h1 class="text-gray-500 text-7xl font-bold ">
            CIGroup Pokemon Challenge
        </h1>
        <span class="pt-6 text-4xl text-blue-600">By Keith Gichovi :)</span>
    </div>
</template>

<script>

    import Navbar from "../components/Navbar.vue";

    export default {
        name: 'Home',
        components: {
            Navbar
        },
    }

</script>


