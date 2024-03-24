<script setup>
import { RouterLink } from 'vue-router'
</script>

<template>
    <nav class="shadow">
        <ul class="flex p-2">
            <li class="p-1 hover:text-green-600">
                <router-link :to="{ name: 'clients' }">Clientes</router-link>
            </li>
            <li class="p-1 ml-3 hover:text-green-600">
                <router-link :to="{ name: 'companies' }">Empresas</router-link>
            </li>
        </ul>
    </nav>
</template>

<style scoped>

</style>