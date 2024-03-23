<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <ul class="list-inside">
    <li>
      <router-link :to="{name:'home'}">Home</router-link>
    </li>
    <li>
      <router-link :to="{name:'login'}">Login</router-link>
    </li>
  </ul>

  <RouterView />
</template>

<style scoped>

</style>
