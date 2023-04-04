<script setup>
useHead({
  title: 'Library'
})
definePageMeta({ layout: 'fixed-sidebar' })
</script>



<template>
  <div class="bg-brown-1 text-brown-4 p-2">
    <CommonSection title="History" class="p-4">
      <div class="flex flex-wrap gap-1 transition-all duration-100 justify-center ">
        <VideoThumbnail class="w-56 self-baseline" v-for="i in 10" :with-avatar="false"/>
      </div>
    </CommonSection>
  </div>
</template>

<style scoped></style>
