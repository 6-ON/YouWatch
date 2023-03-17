<script lang="ts" setup>
const sidebar = useSidebar()
</script>

<template>
  <div class="fixed flex justify-end top-0 left-0 items-center px-4 bg-brown-1 text-brown-4 w-full z-10 h-16">
    <button class="mr-auto" @click="sidebar.toggle">
      <IconsMenu class="w-8" />
    </button>
    <div class="flex gap-3">
      <IconsLibraryAdd class="w-8" />
      <UserAvatar></UserAvatar>
    </div>
  </div>
</template>

<style scoped></style>
