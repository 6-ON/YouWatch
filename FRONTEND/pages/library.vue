<script lang="ts" setup>
useHead({
  title: 'Library'
})
definePageMeta({ layout: 'fixed-sidebar' })
const { $axios } = useNuxtApp()
const { data: historyVideos, pending: historyPending } = useAsyncData<VideoList>('history', async () => (await $axios.get('/api/history')).data)
</script>



<template>
  <div class="bg-brown-1 text-brown-4 p-2">
    <CommonSection title="History" class="p-4">
      <div class="flex flex-wrap gap-1 transition-all duration-100 justify-center ">
        <PlaceholderVideoThumbnail class="w-64" v-if="historyPending" v-for="(n, index) in 3" :key="index" />
        <VideoThumbnail class="w-56 self-baseline" v-else-if="historyVideos?.total" v-for="video in historyVideos.data"
          :with-avatar="false" :video="video" />
        <p v-else>Your history is empty enjoy watching videos</p>
      </div>
    </CommonSection>
  </div>
</template>

<style scoped></style>
