import axios from 'axios';
import { computed } from 'vue';
import { mapState } from 'vuex';

const state = computed(() => {
    return mapState([
        'token'
    ])
});

const axiosInstance = axios.create({
    baseURL: 'http://localhost/api',
    headers: {
        'Content-type': 'application/json',
        'Authorization': `Bearer ${state.token ?? ''}`
    }
});

export default axiosInstance;