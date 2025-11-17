<script setup lang="ts">
import api from '@/lib/axios';
import { Books } from '@/types/globals';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps<{ message: string; data: Books }>();

const form = useForm(props.data);
const oldTitle = form.title

async function onSubmit(e: Event) {
    e.preventDefault();
    const id = props.data.id;

    try {
        await api.patch(`/books/${id}`, form);
        router.visit('/books');
    } catch (error) {
        console.error('Error updating book:', error);
    }
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
                    Edit Data: {{ oldTitle }}
                </h1>
                <a href="/books"
                    class="text-xl font-semibold text-gray-400 transition hover:text-gray-700 dark:hover:text-gray-300">
                    x
                </a>
            </div>

            <!-- Form -->
            <form @submit="onSubmit" class="flex flex-col gap-4">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input id="title" type="text" v-model="form.title" placeholder="e.g. The Alchemist"
                        class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100" />
                </div>

                <!-- Category -->
                <div>
                    <label for="category"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                    <select id="category" v-model="form.category"
                        class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100">
                        <option disabled value="">Choose category</option>
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

                <!-- Author & Publisher side by side on medium+ screens -->
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="author"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author</label>
                        <input id="author" type="text" v-model="form.author" placeholder="e.g. Paulo Coelho"
                            class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100" />
                    </div>

                    <div>
                        <label for="publisher"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Publisher</label>
                        <input id="publisher" type="text" v-model="form.publisher" placeholder="e.g. HarperCollins"
                            class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100" />
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea id="description" v-model="form.description" rows="5"
                        placeholder="Write a short description..."
                        class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="w-full cursor-pointer rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-800 active:bg-slate-600 sm:w-auto dark:bg-white dark:text-black dark:hover:bg-gray-100">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
