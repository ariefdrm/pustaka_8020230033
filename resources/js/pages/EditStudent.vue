<script setup lang="ts">
import api from '@/lib/axios';
import { Student } from '@/types/globals';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps<{ message: string; data: Student }>();

const form = useForm(props.data);

async function onSubmit(e: Event) {
    e.preventDefault();
    const id = props.data.id;

    try {
        await api.patch(`/student/${id}`, form);

        router.visit('/student');
    } catch (error) {
        console.error(error);
    }
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
                <h1 class="text-3xl font-bold dark:text-white">Edit Data</h1>
                <a href="/student" class="text-lg">X</a>
            </div>

            <form @submit="onSubmit" class="flex flex-col space-y-6">
                <div>
                    <label for="nama">Nama : </label>
                    <input
                        type="text"
                        class="w-full rounded-md border px-2 py-1"
                        v-model="form.nama"
                    />
                </div>
                <div>
                    <label for="nim">Nim : </label>
                    <input
                        type="text"
                        class="w-full rounded-md border px-2 py-1"
                        v-model="form.nim"
                    />
                </div>
                <div>
                    <label for="no_hp">No Hp : </label>
                    <input
                        type="text"
                        class="w-full rounded-md border px-2 py-1"
                        v-model="form.no_hp"
                    />
                </div>
                <div>
                    <label for="alamat">Alamat : </label>
                    <input
                        type="text"
                        class="w-full rounded-md border px-2 py-1"
                        v-model="form.alamat"
                    />
                </div>

                <button
                    class="max-w-fit rounded-md bg-slate-900 px-2 py-1 text-sm text-white active:bg-slate-600 dark:bg-white dark:text-black"
                    type="submit"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>
