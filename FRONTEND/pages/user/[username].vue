<script setup>
const route = useRoute()
useHead({
  title: `${route.params.username} - Youwatch`
})
// definePageMeta({ layout: 'fixed-sidebar' })
const { user } = useAuth()
const { $axios } = useNuxtApp()
const { data: userVideos, pending } = useAsyncData('userVideos', async () => (await $axios.get(`api/users/${route.params.username}/videos`)).data)
</script>

<template>
  <div class="bg-brown-1 text-brown-4 font font-Montserrat">
    <div v-if="!pending && userVideos" class="w-full flex flex-col items-center p-4">
      <UserAvatar
        :image="userVideos.user.image"
        size="w-32 h-32" />
      <h1 class="font-bold text-2xl mt-4">{{ userVideos.user.name }}</h1>
      <h5 class="font-medium mt-1">{{ userVideos.user.subscribers_count }} Followers</h5>
      <ClientOnly>
        <ButtonSubscribe v-if="user.id !== userVideos.user.id" :user="userVideos.user"/>
      </ClientOnly>
    </div>
    <div v-else class="w-full flex flex-col items-center p-4">
      <!-- avatar placeholder -->
      <div class="bg-brown-2 w-32 h-32 rounded-full animate-pulse"></div>
      <!-- name placeholder -->
      <div class="bg-brown-2 w-32 h-6 mt-4 rounded animate-pulse"></div>
      <!-- followers placeholder -->
      <div class="bg-brown-2 w-32 h-6 mt-2 rounded animate-pulse"></div>

    </div>
    <h1 class="font-bold text-3xl ml-10 mt-4">{{ userVideos?.user.name }} Videos :</h1>
    <hr class="w-auto ml-10 h-[0.1rem] bg-brown-2 bg-opacity-40">
    <div class="grid p-4 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 place-items-center gap-y-5">
      <PlaceholderVideoThumbnail class="w-96" v-if="pending" v-for="n in 4" />
      <VideoThumbnail v-else :hide-user="true" class="w-96" v-for="video in userVideos?.videos.data" :with-avatar="false" :video="video" />
    </div>
  </div>
</template>

<style scoped></style>
