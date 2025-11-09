<script setup lang="ts">
import { Button } from '@/components/ui/button';
import api from '@/lib/axios';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

type bookForm = {
    title: string;
    category?: string;
    author: string;
    publisher: string;
    description: string;
};

const state = reactive<bookForm>({
    title: '',
    category: '',
    author: '',
    publisher: '',
    description: '',
});

function onSubmit(event: Event) {
    event.preventDefault();
    api.post('books', state)
        .then((response) => {
            console.log('New book added successfully:', response.data);
            router.visit('/books');
        })
        .catch((error) => {
            console.error('Error adding book:', error);
        });
}
</script>

<template>
    <!-- Overlay -->
    <div
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4 backdrop-blur-sm"
    >
        <!-- Modal Container -->
        <div
            class="w-full max-w-md rounded-lg border border-gray-200 bg-white p-6 shadow-xl sm:max-w-lg md:max-w-2xl dark:border-gray-700 dark:bg-black"
        >
            <!-- Header -->
            <div
                class="mb-6 flex items-center justify-between border-b border-gray-200 pb-3 dark:border-gray-700"
            >
                <h1
                    class="text-2xl font-semibold text-gray-800 dark:text-gray-100"
                >
                    Tambah Data Buku
                </h1>
                <a
                    href="/books"
                    class="text-xl font-semibold text-gray-400 transition hover:text-gray-700 dark:hover:text-gray-300"
                >
                    x
                </a>
            </div>

            <!-- Form -->
            <form @submit="onSubmit" class="flex flex-col gap-4">
                <div>
                    <label
                        for="title"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >Title</label
                    >
                    <input
                        id="title"
                        type="text"
                        v-model="state.title"
                        placeholder="e.g. The Alchemist"
                        class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100"
                    />
                </div>

                <div>
                    <label
                        for="category"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >Category</label
                    >
                    <select
                        id="category"
                        v-model="state.category"
                        class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100"
                    >
                        <option value="" disabled selected>
                            Choose category
                        </option>
                        <option value="science">Science</option>
                        <option value="horror">Horror</option>
                        <option value="biography">Biography</option>
                        <option value="history">History</option>
                        <option value="novel">Novel</option>
                        <option value="romance">Romance</option>
                        <option value="comedy">Comedy</option>
                        <option value="drama">Drama</option>
                    </select>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label
                            for="author"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Author</label
                        >
                        <input
                            id="author"
                            type="text"
                            v-model="state.author"
                            placeholder="e.g. Paulo Coelho"
                            class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100"
                        />
                    </div>

                    <div>
                        <label
                            for="publisher"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Publisher</label
                        >
                        <input
                            id="publisher"
                            type="text"
                            v-model="state.publisher"
                            placeholder="e.g. HarperCollins"
                            class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100"
                        />
                    </div>
                </div>

                <div>
                    <label
                        for="description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >Description</label
                    >
                    <textarea
                        id="description"
                        v-model="state.description"
                        rows="5"
                        placeholder="Write a short description..."
                        class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100"
                    ></textarea>
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
