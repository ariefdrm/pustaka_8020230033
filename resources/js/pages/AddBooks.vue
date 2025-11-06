<script setup lang="ts">
import api from '@/lib/axios';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

/* type StudentForm = {
    nama: string;
    nim: string;
    no_hp: string;
    alamat: string;
}; */

/* type typeCategory = {
    science: 'science';
}; */

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
    // Handle form submission logic here
    api.post('books', {
        title: state.title,
        category: state.category,
        author: state.author,
        publisher: state.publisher,
        description: state.description,
    })
        .then((response) => {
            console.log('New book added successfully:', response.data);

            router.visit('/books');
        })
        .catch((error) => {
            console.error('Error adding student:', error);
        });
}
</script>

<template>
    <div
        class="bg-opacity-50 fixed inset-0 flex items-center justify-center bg-white dark:bg-black"
    >
        <div class="w-[50%] rounded-md border bg-white p-5 dark:bg-black">
            <div class="mb-4 flex justify-between">
                <h1 class="text-3xl font-bold dark:text-white">Tambah Data</h1>
                <a href="/books" class="text-lg">X</a>
            </div>

            <form @submit="onSubmit" class="flex flex-col space-y-6">
                <div>
                    <label for="title">Title : </label>
                    <input
                        type="text"
                        class="w-full rounded-md border px-2 py-1"
                        v-model="state.title"
                    />
                </div>
                <div>
                    <label for="category">Category : </label>
                    <select
                        name="category"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 shadow-sm transition duration-150 ease-in-out focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        v-model="state.category"
                    >
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
                <div>
                    <label for="author">Author : </label>
                    <input
                        type="text"
                        class="w-full rounded-md border px-2 py-1"
                        v-model="state.author"
                    />
                </div>
                <div>
                    <label for="publisher">Publisher : </label>
                    <input
                        type="text"
                        class="w-full rounded-md border px-2 py-1"
                        v-model="state.publisher"
                    />
                </div>
                <div>
                    <label for="description">Description : </label>
                    <textarea
                        name="description"
                        v-model="state.description"
                        placeholder="Description... "
                        class="w-full rounded-md border px-2 py-2"
                        rows="6"
                    ></textarea>
                </div>

                <button
                    class="max-w-fit rounded-md bg-black px-2 py-1 text-sm text-white hover:bg-gray-100 dark:bg-white dark:text-black dark:hover:bg-gray-100"
                    type="submit"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>
