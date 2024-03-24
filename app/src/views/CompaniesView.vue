<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Paginator from 'primevue/paginator';
import { onMounted, ref } from 'vue';
import http from '@/services/http.js';
import { useStore } from 'vuex';

const companies = ref([]);
const paginator = ref([]);
const store = useStore()

onMounted(async () => {
  try {
    await http.get('/companies',{
      headers: {
        'Authorization': `Bearer ${store.state.token}`
      }
    })
    .then(response => {
      companies.value = response.data

      for (var i = 1; i <= companies.value.last_page; i++) {
        paginator.value.push(companies.value.per_page * i);
      }
    })

  } catch(error) {
    console.error(error)
  }
})

async function onPageEvent(event) {
  const page = event.page + 1;

  try {
    await http.get(`/companies?page=${page}`,{
      headers: {
        'Authorization': `Bearer ${store.state.token}`
      }
    }).then(response => {
      companies.value = response.data
    })
  } catch(error) {
    console.error(error)
  }
}
</script>

<template>
  <main class="p-4">
    <h1 class="text-xl font-bold">Lista de empresas</h1>
    
    <div class="w-2/3 mx-auto">
      <DataTable :value="companies.data">
        <Column field="codigo" header="Código"></Column>
        <Column field="razao_social" header="Razão Social"></Column>
        <Column field="sigla" header="sigla"></Column>
        <Column field="empresa" header="Empresa"></Column>
      </DataTable>
      <Paginator
        @page="onPageEvent($event)"
        :rows="companies.per_page" 
        :totalRecords="companies.total" 
        :rowsPerPageOptions="paginator"
        template="FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
        currentPageReportTemplate="{first} a {last} de {totalRecords}"
      ></Paginator>
    </div>
  </main>
</template>

<style scoped>

</style>