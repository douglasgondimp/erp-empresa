import { createStore } from 'vuex'
import http from '@/services/http.js';

export default createStore({
    state: {
        user: {},
        token: ''
    },
    mutations: {
        setUser (state, user) {
            state.user = user;
            localStorage.setItem('user', JSON.stringify(user));
        },
        setToken (state, token) {
            state.token = token;
            localStorage.setItem('token', token);
        }
    },
    actions: {
        async login({commit}, user) {
            try {
                await http.post('/auth/login', user)
                .then(response => {
                    commit('setUser', response.data.user);
                    commit('setToken', response.data.token);
                    console.log(response.data);
                })
            } catch (error) {
                console.error(error);
            }
        },
        getToken({commit}) {
            if (localStorage.getItem('token')) {
                commit('setToken', localStorage.getItem('token'));
            }
        },
        getUser({commit}) {
            if (localStorage.getItem('user')) {
                commit('setUser', JSON.parse(localStorage.getItem('user')));
            }
        }
    },
})