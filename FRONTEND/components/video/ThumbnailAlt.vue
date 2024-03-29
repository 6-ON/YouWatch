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
const { user } = useAuth()
</script>
<template>
    <div class="flex gap-8 max-w-full max-sm:flex-col">
        <div class="relative w-full md:w-72 lg:w-80 xl:w-96 sm:w-64">
            <NuxtLink :to="`/video/${video?.id}`">
                <img :src="video?.thumbnail_url" alt="Video thumbnail" class="w-full h-full rounded-lg object-cover" />
                <span
                    class="absolute select-none bottom-1 right-1 bg-brown-1 text-brown-4 px-1 py-1 text-xs font-bold rounded"
                    >{{ video?.duration }}</span
                >
            </NuxtLink>
        </div>
        <div class="flex gap-4 items-center flex-1">
            <div class="flex flex-col self-start font-Inter gap-2 ">
                <NuxtLink :to="`/video/${video?.id}`" class="text-xl font-semibold mb-5">{{ video?.title }}</NuxtLink>
                <div class="flex mb-2 items-center gap-2">
                    <NuxtLink :to="`/user/${video?.user.username}`">
                        <UserAvatar size="w-8 h-8" :image="video?.user.image"> </UserAvatar>
                    </NuxtLink>
                    <NuxtLink :to="`/user/${video?.user.username}`" class="text-sm font-normal">{{ video?.user.name }}</NuxtLink>
                </div>
                <p class="text-sm text-gray-600"> {{ video.description }}</p>
                <p class="text-gray-500 text-xs">
                    {{ formatter.format(video?.views_count) }} views • {{ useTimeAgo(new Date(video?.created_at)).value }}
                </p>
            </div>
            <Dropdown class="ml-auto" v-if="user?.isAdmin">
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
