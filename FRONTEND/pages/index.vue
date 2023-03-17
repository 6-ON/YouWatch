<script setup>
useHead({
  title : 'Home'
})
const sidebar = useSidebar()
onMounted(()=>{
  sidebar.setLocked()
})
onUnmounted(()=>{
  sidebar.setUnlocked()
})
</script>

<template>
  <div>
    Page: Home
  </div>
</template>

<style scoped></style>
