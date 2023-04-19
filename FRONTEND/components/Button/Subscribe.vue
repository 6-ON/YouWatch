<script lang="ts" setup>
const props = defineProps<{
  user: User
}>()
const { $axios } = useNuxtApp()
const subscribing = ref(false)
async function subscribe() {
  try {
    subscribing.value = true
    if (props.user.is_subscribed_to) {
      await $axios.delete(`/api/users/${props.user.id}/subs`)
      props.user.is_subscribed_to = false
      props.user.subscribers_count--
    } else {
      await $axios.post(`/api/users/${props.user.id}/subs`)
      props.user.is_subscribed_to = true
      props.user.subscribers_count++
    }
  }finally {
    subscribing.value = false
  }
}
</script>

<template>
  <div class="flex flex-col items-center">
    <button @click="subscribe" :disabled="subscribing"
      :class="{ 'bg-brown-3 text-brown-1': !user.is_subscribed_to, 'text-brown-4 bg-brown-2 bg-opacity-20': user.is_subscribed_to }"
      class="flex items-center justify-center w-36 h-10 rounded-md  font-bold text-sm disabled:bg-gray-300 disabled:text-gray-700">
      <span class="mr-2">{{ user.is_subscribed_to ? 'Subscribed' : 'Subscribe' }}</span>
    </button>
  </div>
</template>

<style scoped></style>
