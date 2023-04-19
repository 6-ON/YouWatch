<template>
    <div class="relative">
        <input v-model="query" @keydown.enter="search(e)" type="text" name=""
            class="rounded-3xl p-2 pl-10  border-2 w-80 bg-brown-1 border-brown-4 border-opacity-30 focus:border-opacity-100 focus:outline-none placeholder:text-brown-2 placeholder:text-opacity-60 "
            placeholder="Search for Video">
        <span class="material-symbols-sharp absolute left-1 top-[50%] -translate-y-[50%] ">
            search
        </span>
    </div>
</template>
<script setup>
const query = ref('')
const isNavigating = ref(false)
async function search() {
    if (isNavigating.value) return
    isNavigating.value = true
    try {
        
        await navigateTo('/search?q=' + query.value)
    } finally {
        isNavigating.value = false
    }
}
</script>