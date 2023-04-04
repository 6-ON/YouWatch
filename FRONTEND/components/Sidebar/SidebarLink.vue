
<script setup>
const props = defineProps({
    'to': { required: true },
    'icon': { required: true, type: String },
})

const sidebar = useSidebar()
</script>
<template>
    <div class="w-full" @click="sidebar.hide">
        <NuxtLink exact-active-class="bg-brown-3 text-brown-1" :to="to"
            class="flex items-center py-2 gap-2 w-full relative "
            :class="{ 'pl-8': !sidebar.collapsed(),'justify-center': sidebar.collapsed() }">

            <span class="material-symbols-sharp">
                {{ icon }}
            </span>
            <span v-if="!sidebar.collapsed()">
                <slot />
            </span>
        </NuxtLink>
    </div>
</template>
