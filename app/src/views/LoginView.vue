<script setup>
import {reactive} from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const user = reactive({
    email: '',
    password: ''
});

function login()
{
    store.dispatch('login', user);
}
</script>

<template>
    <div>
        <h1 class="text-3xl font-bold underline">
            Página de Login
        </h1>

        <form @submit.prevent="login">
            <input type="email" placeholder="Email" v-model="user.email">
            <input type="password" placeholder="Senha" v-model="user.password">
            <button type="submit">Entrar</button>
        </form>
    </div>
</template>

<style scoped>
    
</style>