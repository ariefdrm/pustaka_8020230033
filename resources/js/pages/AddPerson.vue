<script setup lang="ts">
import { Button } from '@/components/ui/button';
import api from '@/lib/axios';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

type PersonsForm = {
    name: string;
    nik: string;
    email: string;
    no_hp: string;
};

const state = reactive<PersonsForm>({
    name: '',
    nik: '',
    email: '',
    no_hp: '',
});

function onSubmit() {
    // event.preventDefault();
    api.post('persons', state)
        .then((response) => {
            console.log('New student added successfully:', response.data);
            router.visit('/person');
        })
        .catch((error) => {
            console.error('Error adding book:', error);
        });
}
</script>

<template>
    <!-- Overlay -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4 backdrop-blur-sm">
        <!-- Modal Container -->
        <div
            class="w-full max-w-md rounded-lg border border-gray-200 bg-white p-6 shadow-xl sm:max-w-lg md:max-w-2xl dark:border-gray-700 dark:bg-gray-900">
            <!-- Header -->
            <div class="mb-6 flex items-center justify-between border-b border-gray-200 pb-3 dark:border-gray-700">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                    Tambah Student
                </h1>
                <a href="/student"
                    class="text-xl font-semibold text-gray-400 transition hover:text-gray-700 dark:hover:text-gray-300">
                    x
                </a>
            </div>

            <!-- Form -->
            <form @submit.prevent="onSubmit" class="flex flex-col gap-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                    <input id="nama" type="text" v-model="state.name" placeholder="Nama..."
                        class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100" />
                </div>

                <div>
                    <label for="nim" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nik</label>
                    <input id="nama" type="text" v-model="state.nik" placeholder="e.g. 9876"
                        class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100" />
                </div>

                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input id="no_hp" type="text" v-model="state.email" placeholder="e.g. 0935"
                        class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100" />
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Hp</label>
                    <input id="publisher" type="text" v-model="state.no_hp" placeholder="e.g. jln. jayakarta"
                        class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100" />
                </div>

                <div class="flex justify-end pt-2">
                    <Button type="submit" class="w-full sm:w-auto">
                        Submit
                    </Button>
                </div>
            </form>
        </div>
    </div>
</template>
