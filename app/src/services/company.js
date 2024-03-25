import http from './http';
import { useStore } from 'vuex';

export default class CompanyService
{
    constructor()
    {
        this.store = useStore();
    }

    async getCompanies(page = 1) 
    {
        const response = await http.get(`/companies?page=${page}`, {
            headers: {
                'Authorization': `Bearer ${this.store.state.token}`
            }
        });

        return response;
    }

    async createCompany(company)
    {
        const response = await http.post('/companies', company, {
            headers: {
                'Authorization': `Bearer ${this.store.state.token}`
            }
        });

        return response.data;
    }

    async getCompany(id)
    {
        const response = await http.get(`/companies/${id}`, {
            headers: {
                'Authorization': `Bearer ${this.store.state.token}`
            }
        });

        return response.data;
    }

    async updateCompany(id, company)
    {
        const response = await http.put(`/companies/${id}`, company, {
            headers: {
                'Authorization': `Bearer ${this.store.state.token}`
            }
        });

        return response.data;
    }

    async deleteComapany(id)
    {
        const response = await http.delete(`/companies/${id}`, {
            headers: {
                'Authorization': `Bearer ${this.store.state.token}`
            }
        });

        return response.data;
    }
}