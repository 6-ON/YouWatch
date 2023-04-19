<script lang="ts" setup>
useHead({
    title: 'subscriptions'
})
definePageMeta({ layout: 'fixed-sidebar' })

const { $axios } = useNuxtApp()
const { data: subscriptions, pending: subscriptionsPending } = useAsyncData<VideoList>('subscriptions', async () => (await $axios.get('/api/subscriptions')).data)
</script>
<template>
    <div  class="bg-brown-1 flex flex-wrap justify-center gap-1 p-4">
        <PlaceholderVideoThumbnail v-if="subscriptionsPending || !subscriptions" v-for="n in 4" class="w-56"/>
        <VideoThumbnail v-else v-for="video in subscriptions.data" class="w-56"  :with-avatar="false" :video="video" />
    </div>

</template>