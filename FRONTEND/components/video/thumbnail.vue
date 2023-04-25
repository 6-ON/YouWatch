<script lang="ts" setup>
const { formatter } = useFormatter()
const props = defineProps({
    video: {
        type: Object as PropType<Video>,
        required: true,
    },
    withAvatar: {
        type: Boolean,
        default: false,
    },
    hideUser: {
        type: Boolean,
        default: false,
    },
})

const { user } = useAuth()
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
    <div class="bg-brown-1">
        <div class="relative">
            <NuxtLink :to="`/video/${video?.id}`">
                <img
                    :src="video?.thumbnail_url"
                    alt="Video thumbnail"
                    class="w-full h-full aspect-video rounded-lg object-cover"
                />
                <span
                    class="absolute select-none bottom-1 right-1 bg-brown-1 text-brown-4 px-1 py-1 text-xs font-bold rounded"
                    >{{ video?.duration }}</span
                >
            </NuxtLink>
        </div>
        <div class="pl-3 py-2 flex items-center gap-4">
            <NuxtLink class="min-w-fit min-h-fit" v-if="withAvatar && !hideUser" :to="`/user/${video?.user.username}`">
                <UserAvatar :image="video?.user?.image"> </UserAvatar>
            </NuxtLink>
            <div class="flex flex-col font-Inter truncate">
                <div class="truncate flex-shrink">
                    <NuxtLink :to="`/video/${video?.id}`" class="text-md font-semibold">{{ video?.title }}</NuxtLink>
                </div>
                <NuxtLink v-if="!hideUser" :to="`/user/${video?.user.username}`" class="text-sm font-normal">{{
                    video?.user.name
                }}</NuxtLink>
                <p class="text-gray-500 text-xs">
                    {{ formatter.format(video?.views_count) }} views • {{ useTimeAgo(video?.created_at).value }}
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
                            <button :disabled="banPending" class="w-full flex items-center gap-2" @click="handleBan">
                                <span class="material-symbols-sharp"> report </span>
                                <span>Ban</span>
                            </button>
                        </DropdownItem>
                        <DropdownItem v-if="video.banned_at">
                            <button :disabled="unbanPending" class="w-full flex items-center gap-2" @click="handleBan">
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
