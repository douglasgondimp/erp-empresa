<script setup>
import { reactive } from 'vue';
import { useStore } from 'vuex';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import Button from 'primevue/button';

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
    <div class="h-screen flex flex-col justify-center items-center">
        <section class="box_form_login bg-slate-200 p-4 rounded shadow-2xl">
            <h1 class="text-xl font-bold text-center">
                Login
            </h1>
            <Toast />
            <form @submit.prevent="login" class="mt-3 block">
                <InputGroup>
                    <InputGroupAddon class="bg-black">
                        <i class="pi pi-user"></i>
                    </InputGroupAddon>
                    <InputText type="email" placeholder="Email do usuário" v-model="user.email" required />
                </InputGroup>
                <InputGroup class="mt-3">
                    <InputGroupAddon class="bg-black">
                        <i class="pi pi-user"></i>
                    </InputGroupAddon>
                    <Password placeholder="Sua senha" v-model="user.password" :feedback="false" required/>
                </InputGroup>
                <div class="text-center mt-3">
                    <Button type="submit" label="Entrar" severity="success" class="bg-emerald-500 py-0.5 px-2" @click="showSuccess" />
                </div>
            </form>
        </section>
    </div>
</template>

<style scoped lang="scss">
    .box_form_login {
        width: 400px;
    }
</style>