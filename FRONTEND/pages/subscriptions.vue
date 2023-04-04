<script setup>
useHead({
    title: 'subscriptions'
})
definePageMeta({ layout: 'fixed-sidebar' })
</script>
<template>
    <div class="bg-brown-1 flex flex-wrap justify-center gap-1 p-4">
        <VideoThumbnail v-for="n in 20" class="w-56"  :with-avatar="false" />
    </div>

</template>