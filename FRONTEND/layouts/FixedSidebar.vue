<script setup>
const sidebar = useSidebar()
onMounted(() => {
    sidebar.setLocked()
})
onUnmounted(() => {
    sidebar.setUnlocked()
})
</script>

<template>
    <div class="pt-16 pl-[20rem]">
        <Sidebar></Sidebar>
        <Navbar></Navbar>
        <slot />
    </div>
</template>