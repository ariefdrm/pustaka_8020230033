<script setup lang="ts">
import api from '@/lib/axios';
import { Student } from '@/types/globals';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps<{ message: string; data: Student }>();

const form = useForm(props.data);

async function onSubmit() {
    const id = props.data.id;

    try {
        const response = await api.put(`student/${id}`, form.data());

        console.log('Student updated successfully:', response.data);
        router.visit('/student');
    } catch (error) {
        console.error('Error updating student:', error);
    }
}
</script>

<template>
    <div
        class="bg-opacity-50 fixed inset-0 flex items-center justify-center bg-black"
    >
        <div
            class="h-[70%] w-[50%] rounded-md border bg-white p-5 dark:bg-black"
        >
            <div class="mb-4 flex justify-between">
                <h1 class="text-3xl font-bold dark:text-white">Edit Data</h1>
                <a href="/student" class="text-lg">X</a>
            </div>

            <form @submit="onSubmit" class="flex flex-col space-y-6">
                <label for="nama">Nama : </label>
                <input type="text" v-model="form.nama" />
                <label for="nim">Nim : </label>
                <input type="text" v-model="form.nim" />
                <label for="no_hp">No Hp : </label>
                <input type="text" v-model="form.no_hp" />
                <label for="alamat">Alamat : </label>
                <input type="text" v-model="form.alamat" />

                <!-- <input type="hidden" name="_method" value="PATCH" /> -->
                <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> -->
                <button
                    class="rounded-md bg-white px-2 py-1 text-sm text-black hover:bg-gray-100"
                    type="submit"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>
