<script setup>
const props = defineProps({
    withAvatar: {
        default: true,
        type: Boolean
    },
})
</script>


<template>
    <div class="bg-brown-1">
        <div class="relative">

            <NuxtLink :to="`/video/${'test'}`">
                <img src="@/assets/demo.jpg" alt="Video thumbnail" class="w-full h-full rounded-lg object-cover">
                <span
                    class="absolute select-none bottom-1 right-1 bg-brown-1 text-brown-4 px-1 py-1 text-xs font-bold rounded">02:01</span>
            </NuxtLink>
        </div>
        <div class="pl-3 py-2 flex items-center gap-4 ">

            <NuxtLink v-if="withAvatar" to="/user/test">
                <UserAvatar
                    image="https://images.pexels.com/users/avatars/353287/suzy-hazelwood-390.jpeg?auto=compress&fit=crop&h=128&w=128&dpr=1">
                </UserAvatar>
            </NuxtLink>
            <div class="flex flex-col font-Inter">
                <NuxtLink to="#" class="text-md font-semibold">How to make a cake</NuxtLink>
                <NuxtLink to="#" class="text-sm font-normal">lala hadda</NuxtLink>
                <p class="text-gray-500 text-xs">14k views • 1day ago</p>

            </div>
            <button class=" ml-auto">
                <span class="material-symbols-sharp">
                    more_vert
                </span>
            </button>
        </div>
    </div>
</template>