<script setup lang="ts">
import { Search } from 'lucide-vue-next';
import { ref, watch } from 'vue';

const props = defineProps<{
    search: string;
}>();

const emit = defineEmits(['update:search']);

const local = ref(props.search || '');
watch(local, (v) => emit('update:search', v));
</script>

<template>
    <div class="relative m-5 w-full max-w-sm items-center">
        <Input
            id="search"
            v-model="local"
            type="text"
            placeholder="Search by name..."
            class="pl-10"
        />
        <span
            class="absolute inset-y-0 start-0 flex items-center justify-center px-2"
        >
            <Search class="size-6 text-muted-foreground" />
        </span>
    </div>
</template>
