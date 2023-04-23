<script lang="ts" setup>
const { $axios } = useNuxtApp()
const comment = ref('')
const props = defineProps<{
  video: Video
}>()
const { user,isAuthenticated } = useAuth()
const { execute, pending } = useAsyncData('SendComment',async () => {
  try {
    const {data:commented} = await $axios.post(`/api/videos/${props.video.id}/comments`, { body: comment.value })
    if (user.value) {
      props.video.comments?.unshift({...commented, user: user.value});
    }
  } finally {
    props.video.comments_count++
    comment.value = ''
  }
}, { immediate: false })
pending.value = false
function handleComment() {
  if (!isAuthenticated.value) {
    navigateTo('/auth/login?cameFrom=video&id=' + props.video.id)
    return
  }
  if (!pending.value) execute()
}
</script>

<template>
  <div class="flex">
    <input v-model="comment" type="text"
      class="w-96 p-3 border-b-2 placeholder:text-brown-2 border-brown-4 bg-brown-1 focus:outline-none"
      placeholder="Write a comment ..." @keydown.enter="handleComment">

    <div v-if="pending" class="animate-spin rounded-full h-4 w-4 border-t-2 border-b-2 border-gray-900"></div>
  </div>
</template>

<style scoped></style>
