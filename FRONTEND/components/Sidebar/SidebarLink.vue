
<script setup>
const props = defineProps({
    'to': { required: true },
})

</script>
<template>
    <NuxtLink exact-active-class="[&>div.circle-mark]:bg-[currentColor] bg-brown-3 text-brown-1" :to="to"
        class="flex items-center py-2 justify-around w-full  relative">
        <div class="circle-mark h-full aspect-square left-0 rounded-full -translate-x-[50%] absolute"></div>
        <slot />
    </NuxtLink>
</template>
