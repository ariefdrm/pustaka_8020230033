<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from '@/components/ui/form';
import { Input } from '@/components/ui/input';
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
    <!-- Outer container: Full-screen, fixed, and flex-centered -->
    <div
        class="bg-opacity-50 fixed inset-0 flex items-center justify-center bg-black"
    >
        <!-- Inner modal: Remove 'fixed', keep size and styling -->
        <div
            class="h-[70%] w-[50%] rounded-md border bg-white p-5 dark:bg-black"
        >
            <div class="mb-4">
                <h1 class="text-3xl font-bold dark:text-white">Tambah Data</h1>
            </div>

            <form class="space-y-6" @submit="onSubmit">
                <FormField v-slot="{ componentField }" name="nam">
                    <FormItem v-auto-animate>
                        <FormLabel>Nama : </FormLabel>
                        <FormControl>
                            <Input
                                type="text"
                                placeholder="Nama"
                                v-bind="componentField"
                                v-model="state.nama"
                            />
                        </FormControl>
                        <FormMessage />
                    </FormItem>
                </FormField>
                <FormField v-slot="{ componentField }" name="nim">
                    <FormItem v-auto-animate>
                        <FormLabel>Nim : </FormLabel>
                        <FormControl>
                            <Input
                                type="text"
                                placeholder="Nim..."
                                v-bind="componentField"
                                v-model="state.nim"
                            />
                        </FormControl>
                        <FormMessage />
                    </FormItem>
                </FormField>
                <FormField v-slot="{ componentField }" name="no_hp">
                    <FormItem v-auto-animate>
                        <FormLabel>No Hp : </FormLabel>
                        <FormControl>
                            <Input
                                type="text"
                                placeholder="No Hp"
                                v-bind="componentField"
                                v-model="state.no_hp"
                            />
                        </FormControl>
                        <FormMessage />
                    </FormItem>
                </FormField>
                <FormField v-slot="{ componentField }" name="alamat">
                    <FormItem v-auto-animate>
                        <FormLabel>Alamat : </FormLabel>
                        <FormControl>
                            <Input
                                type="text"
                                placeholder="Alamat..."
                                v-bind="componentField"
                                v-model="state.alamat"
                            />
                        </FormControl>
                        <FormMessage />
                    </FormItem>
                </FormField>
                <Button type="submit"> Submit </Button>
            </form>
        </div>
    </div>
</template>
