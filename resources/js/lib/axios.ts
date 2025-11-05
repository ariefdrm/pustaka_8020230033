// lib/axios.ts
import axios from 'axios';

// Helper to read a cookie by name
function getCookie(name: string): string | null {
    if (typeof document === 'undefined' || !document.cookie) return null;
    const match = document.cookie.match(
        new RegExp('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)'),
    );
    return match ? decodeURIComponent(match[2]) : null;
}

// Get CSRF token (for Laravel) from meta tag as primary
const token = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute('content');

// Prefer XSRF cookie if present (useful when running front-end dev server on different port)
const xsrfCookie = getCookie('XSRF-TOKEN');

const api = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        // Laravel expects X-XSRF-TOKEN header for cookie-based token; X-CSRF-TOKEN is also accepted
        'X-XSRF-TOKEN': xsrfCookie || undefined,
        'X-CSRF-TOKEN': token || undefined,
    },
    withCredentials: true,
    xsrfCookieName: 'XSRF-TOKEN',
    xsrfHeaderName: 'X-XSRF-TOKEN',
});

export default api;
