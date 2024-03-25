<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Paginator from 'primevue/paginator';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputGroup from 'primevue/inputgroup';
import InputText from 'primevue/inputtext';
import { onMounted, ref, reactive } from 'vue';
import CompanyService from '@/services/company';

const companyService = new CompanyService();

const companies = ref([]);
const paginator = ref([]);
const headerDialog = ref([]);
const visible = ref(false);
const create = ref(false);
const currentPage = ref(0);

const company = reactive({
    codigo: null,
    empresa: null,
    sigla: '',
    razao_social: ''
});

onMounted(async () => {
    await init()
})

async function init() {
    try {
        currentPage.value = currentPage.value == 0 ? 1 : currentPage.value;

        const response = await companyService.getCompanies(1, currentPage.value);

        companies.value = response.data

        for (var i = 1; i <= companies.value.last_page; i++) {
            paginator.value.push(companies.value.per_page * i);
        }

    } catch (error) {
        console.error(error)
    }
}

async function onPageEvent(event) {
    currentPage.value = event.page + 1;

    try {
        const response = await companyService.getCompanies(currentPage.value);

        companies.value = response.data;

    } catch (error) {
        console.error(error)
    }
}

function dialogNewCompany() {
    visible.value = true;
    headerDialog.value = 'Nova Empresa';
    create.value = true;
    company.codigo = null;
    company.empresa = null;
    company.sigla = '';
    company.razao_social = '';
}

async function dialogEditCompany(codigo) {
    visible.value = true;
    headerDialog.value = 'Editar Cliente';
    create.value = false;

    try {
        const response = await companyService.getCompany(codigo);

        company.codigo       = response.data.codigo;
        company.empresa      = response.data.empresa;
        company.sigla        = response.data.sigla;
        company.razao_social = response.data.razao_social;

    } catch (error) {
        console.error(error);
    }
}

async function sendCompany() {
    try {
        company.codigo = parseFloat(company.codigo);
        company.empresa = parseFloat(company.empresa);

        if (create.value) {
            await companyService.createCompany(company);
        } else {
            await companyService.updateCompany(company.codigo, company);
        }

        console.log('Empresa criada com sucesso!');
        visible.value = false;
        company.codigo = null;
        company.empresa = null;
        company.sigla = '';
        company.razao_social = '';
        init();
    } catch (error) {
        console.error(error);
    }
}

async function confirmExclusion(codigo) {
    const confirmation = confirm("Deseja excluir esta empresa?");

    if (confirmation) {
        try {
            const response = await companyService.deleteComapany(codigo);

            console.log(response);

            init();
        } catch (error) {
            console.error(error)
        }
    }
}
</script>

<template>
    <main class="p-4">
        <h1 class="text-xl font-bold text-center">Lista de empresas</h1>

        <div class="w-3/4 mx-auto">
            <div class="text-right">
                <Button type="button" class="bg-green-400 py-1 px-3" @click="dialogNewCompany()"
                    label="Nova empresa"></Button>

                <Dialog v-model:visible="visible" modal :header="headerDialog" :style="{ width: '400px' }">
                    <form @submit.prevent="sendCompany()">
                        <InputGroup class="flex flex-col">
                            <label for="codigo">Código</label>
                            <InputText id="codigo" class="w-full py-1.5 px-2 shadow rounded" type="number" maxlength="4"
                                v-model="company.codigo" placeholder="Código da empresa (apenas números)" required
                                :disabled="!create" />
                        </InputGroup>

                        <InputGroup class="flex flex-col mt-3">
                            <label for="empresa">Empresa</label>
                            <InputText id="empresa" class="w-full py-1.5 px-2 shadow rounded" type="number"
                                maxlength="4" v-model="company.empresa" placeholder="Código da empresa (apenas números)"
                                required="true" />
                        </InputGroup>

                        <InputGroup class="flex flex-col mt-3">
                            <label for="razao_social">Razão Social</label>
                            <InputText id="razao_social" class="w-full py-1.5 px-2 shadow rounded" type="text"
                                v-model="company.razao_social" placeholder="Razão social da empresa" required />
                        </InputGroup>

                        <InputGroup class="flex flex-col mt-3">
                            <label for="sigla">Sigla</label>
                            <InputText id="sigla" class="w-full py-1.5 px-2 shadow rounded" type="text" maxlength="40"
                                v-model="company.sigla" placeholder="Sigla da empresa" required />
                        </InputGroup>

                        <Button class="mt-3 py-1 px-2 bg-green-400" type="submit" label="Salvar"></Button>
                    </form>
                </Dialog>
            </div>
            <DataTable :value="companies.data">
                <Column field="codigo" header="Código"></Column>
                <Column field="razao_social" header="Razão Social"></Column>
                <Column field="sigla" header="sigla"></Column>
                <Column field="empresa" header="Empresa"></Column>
                <Column headerStyle="width:130px">
                    <template #body="slotProps">
                        <Button class="bg-green-500 py-1" icon="pi pi-pencil" title="Editar"
                            @click="dialogEditCompany(slotProps.data.codigo)"></Button>
                        <Button class="bg-red-500 py-1 ml-2" icon="pi pi-times" title="Excluir"
                            @click="confirmExclusion(slotProps.data.codigo)"></Button>
                    </template>
                </Column>
            </DataTable>

            <Paginator @page="onPageEvent($event)" :rows="companies.per_page" :totalRecords="companies.total"
                :rowsPerPageOptions="paginator"
                template="FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
                currentPageReportTemplate="{first} a {last} de {totalRecords}"></Paginator>
        </div>
    </main>
</template>

<style scoped></style>