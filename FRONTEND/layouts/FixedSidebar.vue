<script setup>
const sidebar = useSidebar()
onMounted(() => {
    sidebar.lock()
})
onUnmounted(() => {
    sidebar.unlock()
})
</script>

<template>
    <div>
        <Navbar></Navbar>
        <Sidebar></Sidebar>
        <div class="transition-all duration-100"
            :class="{ 'pl-[15rem]': !sidebar.collapsed(), 'pl-[4rem]': sidebar.collapsed() }">
            <slot />
        </div>
    </div>
</template>