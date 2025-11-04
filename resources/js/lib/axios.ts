// lib/axios.ts
import axios from 'axios';

// Get CSRF token (for Laravel)
const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

const api = axios.create({
    baseURL: '/api', // adjust if using /api
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token || '',
    },
    withCredentials: true,
});

export default api;
