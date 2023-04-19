<script lang="ts" setup>
const props = defineProps<{
  video: Video
}>()

const isLiked = computed(() => props.video.user_reaction?.isLiked === 1)
const isDisliked = computed(() => props.video.user_reaction?.isLiked === 0)

const { $axios } = useNuxtApp()
onMounted(() => {
  watch(() => props.video?.user_reaction, async (newReaction, oldReaction) => {
    try {
      if (newReaction) {
        // create reaction
        if (oldReaction)
          await $axios.patch(`/api/videos/${props.video.id}/likes`, { like: newReaction.isLiked })
        else
          await $axios.post(`/api/videos/${props.video.id}/likes`, { like: newReaction.isLiked })
      } else {
        // delete reaction
        await $axios.delete(`/api/videos/${props.video.id}/likes`)
      }
    } catch (e) {
      console.log(e);
    }
  }, { immediate: false, deep: true })
})



function like() {
  // if user_reaction null create object and set isLiked to 1
  if (!props.video.user_reaction) props.video.user_reaction = { isLiked: 1 }
  else if (!props.video.user_reaction.isLiked) props.video.user_reaction.isLiked = 1
  else props.video.user_reaction = null

}
function dislike() {
  if (!props.video.user_reaction) props.video.user_reaction = { isLiked: 0 }
  else if (props.video.user_reaction.isLiked) props.video.user_reaction.isLiked = 0
  else props.video.user_reaction = null
}

</script>

<template>
  <div class="flex gap-5">
    <button class="flex items-center gap-4" @click="like">
      <iconsThumbUp :filled="isLiked" />
      like
    </button>
    <button class="flex items-center gap-4" @click="dislike">
      <iconsThumbDown :filled="isDisliked" />
      Dislike
    </button>
  </div>
</template>

<style scoped></style>
