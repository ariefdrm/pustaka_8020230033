<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

// Logo lokal atau URL eksternal
const projectInfo = {
    name: 'Laravel + Vue.js Project',
    description:
        'A modern web application built using Laravel as the backend and Vue.js (with Inertia) as the frontend framework.',
    techStack: [
        {
            name: 'Laravel 12',
            logo: 'https://static.cdnlogo.com/logos/l/23/laravel.svg',
        },
        {
            name: 'Vue.js 3 + TypeScript',
            logo: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg',
        },
        {
            name: 'TailwindCSS',
            logo: 'https://static.cdnlogo.com/logos/t/58/tailwind-css.svg',
        },
    ],
    features: [
        'Authentication (Login, Register, Logout)',
        'Role-based Access Control',
        'Dynamic CRUD Interface',
        'API Integration with Axios',
        'Responsive Layout with Dark Mode',
    ],
    author: 'Arief Darmawan',
    repoUrl: 'https://github.com/ariefdrm/pustaka_8020230033',
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-6"
        >
            <!-- Header -->
            <div
                class="rounded-xl border border-sidebar-border/70 bg-white/70 p-6 dark:border-sidebar-border dark:bg-sidebar/40"
            >
                <h1
                    class="mb-2 text-3xl font-bold text-gray-800 dark:text-gray-100"
                >
                    {{ projectInfo.name }}
                </h1>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ projectInfo.description }}
                </p>
            </div>

            <!-- Grid Info -->
            <div class="grid gap-4 md:grid-cols-3">
                <!-- Tech Stack -->
                <div
                    class="rounded-xl border border-sidebar-border/70 bg-white/70 p-4 dark:border-sidebar-border dark:bg-sidebar/40"
                >
                    <h2
                        class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-200"
                    >
                        Tech Stack
                    </h2>
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                        <div
                            v-for="(tech, index) in projectInfo.techStack"
                            :key="index"
                            class="flex flex-col items-center rounded-lg p-2 text-center transition hover:bg-gray-100 dark:hover:bg-sidebar-border/20"
                        >
                            <img
                                :src="tech.logo"
                                :alt="tech.name"
                                class="mb-2 h-10 w-10 object-contain"
                            />
                            <p class="text-sm text-gray-700 dark:text-gray-200">
                                {{ tech.name }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Features -->
                <div
                    class="rounded-xl border border-sidebar-border/70 bg-white/70 p-4 dark:border-sidebar-border dark:bg-sidebar/40"
                >
                    <h2
                        class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200"
                    >
                        Key Features
                    </h2>
                    <ul
                        class="list-inside list-disc space-y-1 text-gray-600 dark:text-gray-300"
                    >
                        <li
                            v-for="(feature, index) in projectInfo.features"
                            :key="index"
                        >
                            {{ feature }}
                        </li>
                    </ul>
                </div>

                <!-- Project Info -->
                <div
                    class="flex flex-col justify-between rounded-xl border border-sidebar-border/70 bg-white/70 p-4 dark:border-sidebar-border dark:bg-sidebar/40"
                >
                    <div>
                        <h2
                            class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200"
                        >
                            Project Info
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Author:</span>
                            {{ projectInfo.author }}
                        </p>
                        <p v-if="projectInfo.repoUrl" class="mt-2">
                            <a
                                :href="projectInfo.repoUrl"
                                target="_blank"
                                class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400"
                            >
                                View Repository →
                            </a>
                        </p>
                    </div>
                    <div class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                        Last updated: {{ new Date().toLocaleDateString() }}
                    </div>
                </div>
            </div>

            <!-- Footer Section -->
            <div
                class="relative flex-1 rounded-xl border border-sidebar-border/70 bg-white/70 p-6 dark:border-sidebar-border dark:bg-sidebar/40"
            >
                <h2
                    class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-200"
                >
                    About This Dashboard
                </h2>
                <p class="text-gray-600 dark:text-gray-300">
                    This dashboard serves as an overview of the project's
                    technology stack and features. It is built using Inertia.js
                    to seamlessly integrate Laravel backend routes with Vue
                    components, providing a modern single-page application
                    experience.
                </p>
            </div>
        </div>
    </AppLayout>
</template>
