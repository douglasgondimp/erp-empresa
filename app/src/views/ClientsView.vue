<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Paginator from 'primevue/paginator';
import { onMounted, ref } from 'vue';
import http from '@/services/http.js';
import { useStore } from 'vuex';

const clients = ref([]);
const paginator = ref([]);
const store = useStore()

onMounted(async () => {
  try {
    await http.get('/clients',{
      headers: {
        'Authorization': `Bearer ${store.state.token}`
      }
    })
    .then(response => {
      clients.value = response.data

      for (var i = 1; i <= clients.value.last_page; i++) {
        paginator.value.push(clients.value.per_page * i);
      }
    })

  } catch(error) {
    console.log(error.response)
  }
})

async function onPageEvent(event) {
  const page = event.page + 1;
  console.log(page)

  try {
    await http.get(`/clients?page=${page}`,{
      headers: {
        'Authorization': `Bearer ${store.state.token}`
      }
    }).then(response => {
      clients.value = response.data
    })
  } catch(error) {
    console.log('error', error)
  }
}
</script>

<template>
  <main class="p-4">
    <h1 class="text-xl font-bold">Lista de clientes</h1>
    
    <div class="w-2/3 mx-auto">
      <DataTable :value="clients.data">
        <Column field="codigo" header="Código"></Column>
        <Column field="razao_social" header="Razão Social"></Column>
        <Column field="company.razao_social" header="Empresa"></Column>
        <Column field="cpf_cnpj" header="Documento"></Column>
      </DataTable>
      <Paginator
        @page="onPageEvent($event)"
        :rows="clients.per_page" 
        :totalRecords="clients.total" 
        :rowsPerPageOptions="paginator"
        template="FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
        currentPageReportTemplate="{first} a {last} de {totalRecords}"
      ></Paginator>
    </div>
  </main>
</template>

<style scoped>

</style>