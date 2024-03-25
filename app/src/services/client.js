import http from './http';
import { useStore } from 'vuex';

export default class ClientService
{
    constructor()
    {
        this.store = useStore();
    }

    async getClients(page = 1) 
    {
        const response = await http.get(`/clients?page=${page}`, {
            headers: {
                'Authorization': `Bearer ${this.store.state.token}`
            }
        });

        return response;
    }

    async createClient(client)
    {
        const response = await http.post('/clients', client, {
            headers: {
                'Authorization': `Bearer ${this.store.state.token}`
            }
        });

        return response;
    }

    async getClient(id)
    {
        const response = await http.get(`/clients/${id}`, {
            headers: {
                'Authorization': `Bearer ${this.store.state.token}`
            }
        });

        return response;
    }

    async updateClient(id, client)
    {
        const response = await http.put(`/clients/${id}`, client, {
            headers: {
                'Authorization': `Bearer ${this.store.state.token}`
            }
        });

        return response;
    }

    async deleteClient(id)
    {
        const response = await http.delete(`/clients/${id}`, {
            headers: {
                'Authorization': `Bearer ${this.store.state.token}`
            }
        });

        return response;
    }
}