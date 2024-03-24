<script setup>
import { RouterLink } from 'vue-router'
</script>

<template>
    <nav>
        <ul>
            <li>
                <router-link :to="{ name: 'clients' }">Clientes</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'companies' }">Empresas</router-link>
            </li>
        </ul>
    </nav>
</template>

<style scoped>

</style>