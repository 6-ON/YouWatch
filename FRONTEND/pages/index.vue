<script setup>
useHead({
  title: 'Home'
})
definePageMeta({ layout: 'fixed-sidebar' });
</script>

<template>
  <TransitionGroup name="fade-in" class="grid grid-cols-1 gap-y-4 xl:grid-cols-2 2xl:grid-cols-3 place-items-center p-4 bg-brown-1" tag="div" appear>
      <VideoThumbnail v-for="n in 10" :key="n" ></VideoThumbnail>

  </TransitionGroup>
</template>

<style >
.fade-in-enter-active,
.fade-in-leave-active {
  transition: opacity 1s;
}

.fade-in-enter,
.fade-in-leave-to {
  opacity: 0;
}
</style>
