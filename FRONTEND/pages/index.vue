<script setup>
useHead({
  title: 'Home'
})
definePageMeta({ layout: 'fixed-sidebar' });
const videos = ref([])
onMounted(() => {
  setTimeout(() => {
    videos.value = Array(10)
  }, 1000);
})

</script>

<template>
  <div>
    <CategoryShips />
    <TransitionGroup v-if="!videos.length"
      class="grid grid-cols-1 gap-y-4 xl:grid-cols-2 2xl:grid-cols-3 place-items-center p-4" tag="div">
      <PlaceholderVideoThumbnail  class="w-96" v-for="(n, index) in 10" :key="index"></PlaceholderVideoThumbnail>
    </TransitionGroup>
    <TransitionGroup v-else
      class="grid grid-cols-1 gap-y-4 xl:grid-cols-2 2xl:grid-cols-3 place-items-center p-4" tag="div">
      <VideoThumbnail class="w-96" v-for="(n, index) in videos" :key="index"></VideoThumbnail>
    </TransitionGroup>
  </div>
</template>
