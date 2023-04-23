<script lang="ts" setup>
const props = defineProps<{
    comment: CommentT
}>()
defineEmits(['removed'])
</script>

<template>
    <div class="flex gap-4">
        <UserAvatar :image="comment.user.image" />
        <div class="flex flex-col">
            <div class="flex gap-1 items-center">
                <h1 class="font-bold">{{ comment.user.name }}</h1>
                <span class="text-xs text-gray-500">{{ useTimeAgo(new Date(comment.created_at)).value }}</span>
            </div>
            <p class="max-w-md text-sm">
                {{ comment.body }}
            </p>
        </div>
        <Dropdown class="self-center">
            <template #trigger>
                <span class="material-symbols-sharp"> more_vert </span>
            </template>
            <template #content>
                <DropdownItem>
                    <button @click="$emit('removed')" class="w-full flex items-center gap-2">
                        <span class="material-symbols-sharp"> remove </span>
                        <span>Remove</span>
                    </button>
                </DropdownItem>
            </template>
        </Dropdown>
    </div>
</template>

<style scoped></style>
