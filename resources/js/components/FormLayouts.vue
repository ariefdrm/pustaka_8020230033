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
import { X } from 'lucide-vue-next';

const props = defineProps<{
    headingMsg: string;
    formMethod?: string | 'GET';
    onSubmit?: (event: Event) => void;
}>();

defineEmits(['handleClose']);
</script>

<template>
    <div class="flex justify-center">
        <div
            class="fixed z-10 h-[70%] w-[50%] justify-center rounded-md border bg-white p-5 dark:bg-black"
        >
            <div class="mb-4 flex justify-between">
                <h1 class="text-3xl font-bold dark:text-white">Tambah Data</h1>
                <button @click="$emit('handleClose')">
                    <X />
                </button>
            </div>

            <form class="space-y-6" @submit="props.onSubmit">
                <FormField v-slot="{ componentField }" name="username">
                    <FormItem v-auto-animate>
                        <FormLabel>Username : </FormLabel>
                        <FormControl>
                            <Input
                                type="text"
                                placeholder="Nama"
                                v-bind="componentField"
                            />
                        </FormControl>
                        <FormMessage />
                        <FormLabel>Nim : </FormLabel>
                        <FormControl>
                            <Input
                                type="text"
                                placeholder="Nim"
                                v-bind="componentField"
                            />
                        </FormControl>
                        <FormMessage />
                        <FormLabel>No Hp : </FormLabel>
                        <FormControl>
                            <Input
                                type="text"
                                placeholder="No Hp "
                                v-bind="componentField"
                            />
                        </FormControl>
                        <FormMessage />
                        <FormLabel>Alamat : </FormLabel>
                        <FormControl>
                            <Input
                                type="text"
                                placeholder="Alamat... "
                                v-bind="componentField"
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
