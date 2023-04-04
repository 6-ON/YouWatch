<script setup>
const props = defineProps(['title'])
</script>

<template>
    <div class="relative rounded-lg border border-brown-3 pt-12 ">
        <h2 class="absolute left-0 top-0 rounded-br-lg rounded-tl-lg bg-brown-3 text-brown-1 px-2 py-0.5">{{ title }}</h2>
        <slot/>
    </div>
</template>