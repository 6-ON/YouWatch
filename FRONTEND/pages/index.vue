<script lang="ts" setup>
definePageMeta({ layout: 'fixed-sidebar' })
useHead({
    title: 'Home',
})
const selectedTags = useState('selectedTags', () => [] as Array<string>)
selectedTags.value = []
const { $axios } = useNuxtApp()
const {
    data: videos,
    pending,
    refresh,
} = useAsyncData<VideoList>(
    'videos',
    async () =>
        (
            await $axios.get('/api/videos', {
                params: {
                    tags: selectedTags.value,
                },
            })
        ).data
)
watch(
    selectedTags,
    () => {
        refresh()
    },
    { deep: true }
)
function remove(index: number) {
    videos.value?.data.splice(index, 1)
}
</script>

<template>
    <div>
        <CategoryShips />
        <div v-if="pending" class="grid grid-cols-1 gap-y-4 xl:grid-cols-2 2xl:grid-cols-3 place-items-center p-4" tag="div">
            <PlaceholderVideoThumbnail class="w-96" v-for="(n, index) in 10" :key="index"></PlaceholderVideoThumbnail>
        </div>
        <ClientOnly v-else>
            <TransitionsList  class="grid grid-cols-1 gap-y-4 xl:grid-cols-2 2xl:grid-cols-3 place-items-center p-4">
                <VideoThumbnail
                    v-if="videos"
                    @ban-change="remove(index)"
                    class="w-96"
                    :video="video"
                    v-for="(video, index) in videos.data"
                    :key="video.id"
                    :with-avatar="true"
                >
                </VideoThumbnail>
            </TransitionsList>
        </ClientOnly>
    </div>
</template>
<style>
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateY(90px);
}
</style>
