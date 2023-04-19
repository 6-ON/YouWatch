<script setup>
const sidebar = useSidebar()
</script>
<template>
    <div>
        <button @click="sidebar.toggle()">
            <IconsMenu class="w-8" />
        </button>
    </div>
</template>