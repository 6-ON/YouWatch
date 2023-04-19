<script setup>
useHead({
    title:'settings'
})
const auth = useAuth()
</script>
<template>
    <div class="flex flex-col items-center">
        <div class="flex">
            
        </div>
        <!-- logout button -->
        <button class="bg-red-500 text-white p-2 rounded-lg mt-4" @click="auth.logout()">Logout</button>
    </div>
</template>