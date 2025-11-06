<script setup lang="ts">
import api from '@/lib/axios';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

type StudentForm = {
    nama: string;
    nim: string;
    no_hp: string;
    alamat: string;
};

const state = reactive<StudentForm>({
    nama: '',
    nim: '',
    no_hp: '',
    alamat: '',
});

function onSubmit(event: Event) {
    event.preventDefault();
    // Handle form submission logic here
    api.post('student', {
        nama: state.nama,
        nim: state.nim,
        no_hp: state.no_hp,
        alamat: state.alamat,
    })
        .then((response) => {
            console.log('Student added successfully:', response.data);

            setTimeout(() => {
                router.visit('/student');
            }, 2000);
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
        <div
            class="h-[55%] w-[50%] rounded-md border bg-white p-5 dark:bg-black"
        >
            <div class="mb-4 flex justify-between">
                <h1 class="text-3xl font-bold dark:text-white">Tambah Data</h1>
                <a href="/student" class="text-lg">X</a>
            </div>

            <form @submit="onSubmit" class="flex flex-col space-y-6">
                <div>
                    <label for="nama">Nama : </label>
                    <input
                        type="text"
                        class="w-full rounded-md border px-2 py-1"
                        v-model="state.nama"
                    />
                </div>
                <div>
                    <label for="nim">Nim : </label>
                    <input
                        type="text"
                        class="w-full rounded-md border px-2 py-1"
                        v-model="state.nim"
                    />
                </div>
                <div>
                    <label for="no_hp">No Hp : </label>
                    <input
                        type="text"
                        class="w-full rounded-md border px-2 py-1"
                        v-model="state.no_hp"
                    />
                </div>
                <div>
                    <label for="alamat">Alamat : </label>
                    <input
                        type="text"
                        class="w-full rounded-md border px-2 py-1"
                        v-model="state.alamat"
                    />
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
