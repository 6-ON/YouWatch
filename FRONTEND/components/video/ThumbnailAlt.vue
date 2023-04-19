<script lang="ts" setup>
const props = defineProps<{
    video: Video
}>()
const { formatter } = useFormatter()
const emits = defineEmits(['banChange'])
const { videoBan, videoUnban } = useVideoBan(props.video.id)
const { pending: banPending, execute: banVideo } = videoBan
const { pending: unbanPending, execute: unbanVideo } = videoUnban
const handleBan = async () => {
    banVideo()
    emits('banChange')
}
const handleUnban = async () => {
    unbanVideo()
    emits('banChange')
}
</script>
<template>
    <div class="flex gap-2">
        <div class="relative w-64 md:w-72 lg:w-80 xl:w-96">
            <NuxtLink :to="`/video/${video?.id}`">
                <img :src="video?.thumbnail_url" alt="Video thumbnail" class="w-full h-full rounded-lg object-cover" />
                <span
                    class="absolute select-none bottom-1 right-1 bg-brown-1 text-brown-4 px-1 py-1 text-xs font-bold rounded"
                    >{{ video?.duration }}</span
                >
            </NuxtLink>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex flex-col justify-around h-full between font-Inter">
                <NuxtLink to="#" class="text-xl font-semibold">{{ video?.title }}</NuxtLink>
                <div class="flex items-center gap-2">
                    <NuxtLink to="/user/test">
                        <UserAvatar size="w-8 h-8" :image="video?.user.image"> </UserAvatar>
                    </NuxtLink>
                    <NuxtLink to="#" class="text-sm font-normal">{{ video?.user.name }}</NuxtLink>
                </div>
                <p class="text-gray-500 text-xs">
                    {{ formatter.format(video?.views_count) }} views • {{ useTimeAgo(new Date(video?.created_at)) }}
                </p>
            </div>
            <Dropdown class="ml-auto">
                <template #trigger>
                    <button>
                        <span class="material-symbols-sharp"> more_vert </span>
                    </button>
                </template>
                <template #content>
                    <div class="flex flex-col gap-2">
                        <DropdownItem v-if="!video.banned_at">
                            <button :disabled="banPending" class="w-full flex items-center gap-2" @click="handleBan()">
                                <span class="material-symbols-sharp"> report </span>
                                <span>Ban</span>
                            </button>
                        </DropdownItem>
                        <DropdownItem v-if="video.banned_at">
                            <button
                                :disabled="unbanPending"
                                class="w-full flex items-center gap-2"
                                @click="handleUnban()"
                            >
                                <span class="material-symbols-sharp"> report </span>
                                <span>Unban</span>
                            </button>
                        </DropdownItem>
                    </div>
                </template>
            </Dropdown>
        </div>
    </div>
</template>
