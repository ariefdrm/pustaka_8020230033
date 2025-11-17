<script setup lang="ts">
type propsType = {
    message: string;
};

const props = defineProps<propsType>();
const emit = defineEmits(['clicked']);
</script>

<template>
    <h1>{{ props.message }}</h1>
    <button @click="emit('clicked')">click</button>
</template>
