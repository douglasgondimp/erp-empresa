import axios from 'axios';
import { computed } from 'vue';

const axiosInstance = axios.create({
    baseURL: 'http://localhost/api',
    headers: {
        'Content-type': 'application/json',
    }
});

export default axiosInstance;