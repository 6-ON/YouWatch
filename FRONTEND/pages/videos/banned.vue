<script lang="ts" setup>
definePageMeta({ layout: 'fixed-sidebar', middleware: 'auth' })
useHead({
    title: 'Banned Videos',
})
const { $axios } = useNuxtApp()
const {
    data: videos,
    pending,
    execute,
} = useAsyncData('banned', async () => (await $axios.get('/api/banned/videos')).data)
onBeforeMount(() => {
    if (!videos.value) {
        execute()
    }
})
function remove(index: number) {
    videos.value?.data.splice(index, 1)
}
</script>

<template>
    <div>
        <h1 class="text-center text-3xl font-Inter font-semibold text-red-400">Banned Videos</h1>
        <div v-if="pending" class="flex flex-col gap-4 p-2 mt-6">
			<PlaceholderVideoThumbnail class="w-96" v-for="n in 5" />
		</div>
        <TransitionsList class="flex flex-col gap-4 p-2 mt-6" v-else-if="videos?.data.length">
            <VideoThumbnailAlt v-for="(video, index) in videos.data" :video="video" @ban-change="remove(index)" :key="video.id" />
        </TransitionsList>

        <p v-else-if="!pending">No Banned videos for the momment</p>
    </div>
</template>

<style scoped></style>
