<script setup>
const props = defineProps(['isActive'])
</script>
<template>
    <button :class="{
        'bg-brown-1 hover:bg-brown-2 hover:text-brown-1': !isActive,
        'bg-brown-2 text-brown-1': isActive
    }" class="px-4 py-2 rounded-full border border-brown-3 ">
        <slot />
    </button>
</template>
