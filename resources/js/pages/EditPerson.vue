<script setup lang="ts">
import api from '@/lib/axios';
import { Persons } from '@/types/globals';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps<{ message: string; data: Persons }>();

const form = useForm(props.data);
const oldTitle = form.name

async function onSubmit() {
    const id = props.data.id;

    try {
        await api.patch(`/persons/${id}`, form);

        router.visit('/person');
    } catch (error) {
        console.error(error);
    }
}
</script>

<template>
    <div class="bg-opacity-50 fixed inset-0 flex items-center justify-center bg-white dark:bg-black">
        <div class="h-[55%] w-[50%] rounded-md border bg-white p-5 dark:bg-black">
            <div class="mb-4 flex justify-between">
                <h1 class="text-3xl font-bold dark:text-white">
                    Edit Data : {{ oldTitle }}
                </h1>
                <a href="/person" class="text-lg">X</a>
            </div>

            <form @submit.prevent="onSubmit" class="flex flex-col space-y-6">
                <div>
                    <label for="nama">Nama : </label>
                    <input type="text" class="w-full rounded-md border px-2 py-1" v-model="form.name" />
                </div>
                <div>
                    <label for="nim">Nik : </label>
                    <input type="text" class="w-full rounded-md border px-2 py-1" v-model="form.nik" />
                </div>
                <div>
                    <label for="no_hp">Email : </label>
                    <input type="text" class="w-full rounded-md border px-2 py-1" v-model="form.email" />
                </div>
                <div>
                    <label for="alamat">No Hp : </label>
                    <input type="text" class="w-full rounded-md border px-2 py-1" v-model="form.no_hp" />
                </div>

                <button
                    class="max-w-fit rounded-md bg-slate-900 px-2 py-1 text-sm text-white active:bg-slate-600 dark:bg-white dark:text-black"
                    type="submit">
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>
