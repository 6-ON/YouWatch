<script lang="ts" setup>
definePageMeta({
    description: 'Search for videos',
    keywords: 'search, videos',
    layout: 'fixed-sidebar',
    middleware: 'search',
})

const route = useRoute()
useHead({
    title: `Search results for ${route.query.q}`,
})
const { $axios } = useNuxtApp()
const {
    data: videos,
    pending,
    refresh,
} = useAsyncData<VideoList>('search', async () => (await $axios.get(`/api/videos?q=${route.query.q}`)).data)
watch(route, () => {
    refresh()
})
function remove(index: number) {
    videos.value?.data.splice(index, 1)
}
</script>

<template>
    <div>
        <h2 class="text-2xl font-semibold max-md:text-center md:ml-12 text-brown-4 p-2">Search results :</h2>
        <div class="flex flex-col gap-4 p-2 mt-6">
            <!-- videothumbnail -->
            <PlaceholderVideoThumbnail v-if="pending" class="w-96" v-for="n in 5" />
            <VideoThumbnailAlt
                v-else-if="videos?.data.length"
                v-for="(video, index) in videos.data"
                :video="video"
                @ban-change="remove(index)"
            />
            <p v-else>No results for : {{ route.query.q }}</p>
        </div>
    </div>
</template>

<style scoped></style>
