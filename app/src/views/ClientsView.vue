<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Paginator from 'primevue/paginator';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputGroup from 'primevue/inputgroup';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import { onMounted, ref, reactive } from 'vue';
import http from '@/services/http.js';
import { useStore } from 'vuex';
import ClientService from '@/services/client';
import CompanyService from '@/services/company';

const clientService = new ClientService();
const companyService = new CompanyService();
const store = useStore();
const clients = ref([]);
const companies = ref([]);
const paginator = ref([]);
const headerDialog = ref([]);
const visible = ref(false);
const create = ref(false);
const client = reactive({
    empresa: null,
    codigo: null,
    razao_social: '',
    tipo: '',
    cpf_cnpj: ''
})

onMounted(async () => {
    await init()
})

async function init()
{
    try {
        const responseClient = await clientService.getClients();
        const responseCompany = await companyService.getCompanies()

        if (responseClient.status === 200) {
            clients.value = responseClient.data

            for (var i = 1; i <= clients.value.last_page; i++) {
                paginator.value.push(clients.value.per_page * i);
            }
        } else {
            console.error(response)
        }

        if (responseCompany.status === 200) {
            companies.value = responseCompany.data
        }

    } catch (error) {
        console.error(error)
    }
}

async function onPageEvent(event) {
    const page = event.page + 1;

    try {
        const response = await clientService.getClients(page)

        if (response.status === 200) {
            clients.value = response.data
        } else {
            console.error(response)
        }

    } catch (error) {
        console.error('error', error)
    }
}

function dialogNewClient() {
    visible.value = true;
    headerDialog.value = 'Novo Cliente';
    create.value = true;
    client.empresa = null;
    client.codigo = null;
    client.razao_social = '';
    client.tipo = '';
    client.cpf_cnpj = '';
}

async function dialogEditClient(codigo) {
    visible.value = true;
    headerDialog.value = 'Editar Cliente';
    create.value = false;

    try {
        const responseClient = await clientService.getClient(codigo);

        if (responseClient.status === 200) {
            client.empresa = responseClient.data.empresa;
            client.codigo = responseClient.data.codigo;
            client.razao_social = responseClient.data.razao_social;
            client.tipo = responseClient.data.tipo;
            client.cpf_cnpj = responseClient.data.cpf_cnpj.replace(/[^0-9]/g, '');
        } else {
            console.error(responseClient);
        }
    } catch (error) {
        console.error(error);
    }
}

async function sendClient() {
    try {
        client.empresa = parseFloat(client.empresa);
        client.codigo = parseFloat(client.codigo);

        if (create.value) {
            const response = await clientService.createClient(client);
        } else {
            const response = await clientService.updateClient(client.codigo, client);
        }

        console.log('Cliente criado com sucesso!');
        visible.value = false;
        client.empresa = null;
        client.codigo = null;
        client.razao_social = '';
        client.tipo = '';
        client.cpf_cnpj = '';
        init();
       
    } catch (error) {
        console.error(error);
        console.error(error.message);
        console.error(error.response.data.errors);
    }
}
</script>

<template>
    <main class="p-4">
        <h1 class="text-xl font-bold text-center">Lista de clientes</h1>

        <div class="w-3/4 mx-auto">
            <div class="text-right">
                <Button type="button" class="bg-green-400 py-1 px-3" @click="dialogNewClient()"
                    label="Novo cliente"></Button>

                <Dialog v-model:visible="visible" modal :header="headerDialog" :style="{ width: '400px' }">
                    <form @submit.prevent="sendClient()">
                        <InputGroup class="flex flex-col">
                            <label for="empresa">Empresa</label>
                            <Dropdown class="w-full shadow rounded" id="empresa" v-model="client.empresa"
                                :options="companies.data" optionLabel="razao_social" optionValue="codigo"
                                placeholder="Empresa" />
                        </InputGroup>

                        <InputGroup class="flex flex-col mt-3">
                            <label for="codigo">Código</label>
                            <InputText id="codigo" class="w-full py-1.5 px-2 shadow rounded" type="number" maxlength="4"
                                v-model="client.codigo" placeholder="Código do cliente (apenas números)" required="true"
                                :disabled="!create" />
                        </InputGroup>

                        <InputGroup class="flex flex-col mt-3">
                            <label for="razao_social">Razão Social</label>
                            <InputText id="razao_social" class="w-full py-1.5 px-2 shadow rounded" type="text"
                                v-model="client.razao_social" placeholder="Razão social do cliente" required />
                        </InputGroup>

                        <InputGroup class="flex flex-col mt-3">
                            <label for="tipo">Tipo de pessoa</label>
                            <Dropdown class="w-full shadow rounded" id="tipo" v-model="client.tipo"
                                :options="['PF', 'PJ']" placeholder="Selecione o tipo de pessoa" required />
                        </InputGroup>

                        <InputGroup class="flex flex-col mt-3">
                            <label for="cpf_cnpj">CPF/CNPJ</label>
                            <InputText id="cpf_cnpj" class="w-full py-1.5 px-2 shadow rounded" type="number"
                                maxlength="14" v-model="client.cpf_cnpj" placeholder="CPF/CNPJ (apenas números)"
                                required />
                        </InputGroup>

                        <Button class="mt-3 py-1 px-2 bg-green-400" type="submit" label="Salvar"></Button>
                    </form>
                </Dialog>
            </div>

            <DataTable :value="clients.data" class="mt-5" stripedRows>
                <Column field="codigo" header="Código"></Column>
                <Column field="razao_social" header="Razão Social"></Column>
                <Column field="company.razao_social" header="Empresa"></Column>
                <Column field="cpf_cnpj" header="Documento"></Column>
                <Column headerStyle="width:130px">
                    <template #body="slotProps">
                        <Button class="bg-green-500 py-1" icon="pi pi-pencil" title="Editar"
                            @click="dialogEditClient(slotProps.data.codigo)"></Button>
                        <Button class="bg-red-500 py-1 ml-2" icon="pi pi-times" title="Excluir"></Button>
                    </template>
                </Column>
            </DataTable>

            <Paginator @page="onPageEvent($event)" :rows="clients.per_page" :totalRecords="clients.total"
                :rowsPerPageOptions="paginator"
                template="FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
                currentPageReportTemplate="{first} a {last} de {totalRecords}"></Paginator>
        </div>
    </main>
</template>

<style scoped lang="scss"></style>