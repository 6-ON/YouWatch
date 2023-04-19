<script lang="ts" setup>
const route = useRoute()


const { $axios } = useNuxtApp()
const { data: video, pending } = useAsyncData<Video>('video', async () => ((await $axios.get(`api/videos/${route.params.id}`)).data), { server: false })
const { data: videos, pending: videosPending } = useAsyncData<VideoList>(async () => (await $axios.get('/api/videos')).data)

useAsyncData(async () => (await $axios.get(`/api/videos/${route.params.id}/view`)))

useHead({
  title: video.value?.title,
})
</script>


<template>
  <div class="flex max-xl:flex-col p-2 sm:p-4 gap-2 max-xl:items-center justify-center text-brown-4 bg-brown-1">
    <div class="flex flex-col flex-grow max-w-4xl lg:px-20 md:px-10 sm:px-5 w-full ">
      <!-- video section -->
      <PlaceholderVideoThumbnail v-if="pending" class="w-full" />
      <video v-else :src="video?.url" class="w-full aspect-video  rounded-2xl " controls>
      </video>
      <!-- video  section -->
      <div class="flex flex-col ml-2 sm:ml-5 mt-6" v-if="!pending && video">
        <h1 class="text-2xl font-bold ">{{ video.title }}</h1>
        <div class="flex max-sm:flex-wrap max-sm:gap-2 mt-1.5 justify-between items-center">
          <p class="text-gray-500 w-fit whitespace-nowrap">{{ video.views_count }} views . <span class="capitalize">{{
            useTimeAgo(new Date(video.created_at)).value }}</span></p>
          <ClientOnly>
            <VideoLikes :video="video" />
          </ClientOnly>
        </div>
        <div class="p-2">
          <UserAvatar size="w-16 h-16" class="mx-auto w-fit" :image="video.user.image" />
          <div class="flex flex-col items-center">
            <NuxtLink :to="`/user/${video.user.username}`" class="text-center font-Inter mt-2">{{ video.user.name }}</NuxtLink>
            <p class="text-gray-500 text-sm">{{ video.user.subscribers_count }} subscribers</p>
            <!-- subscribe button -->
            <ClientOnly>
              <ButtonSubscribe :user="video.user"/>
            </ClientOnly>
          </div>
        </div>
        <div
          class="border mt-20 border-brown-3 border-opacity-25 relative w-full rounded-lg pt-12 p-4 bg-brown-2 bg-opacity-20 font-Montserrat cursor-pointer">
          <h3 class="absolute top-0 left-0 rounded-tl-lg rounded-br-lg bg-brown-3 px-2 py-1 text-md text-brown-1 ">
            Description</h3>
          <p class="w-full">{{ video.description }}</p>
        </div>
      </div>
      <!-- end video info section -->

      <!-- comments section -->
      <div class="mt-8" v-if="!pending && video">
        <h2 class="text-2xl mb-4"><strong>{{ video.comments_count }}</strong> Comments</h2>
        <CommonCommentSend :video="video" />
        <div class="flex flex-col gap-3 p-1 sm:p-4 mt-10">
          <!-- single comment -->
          <ClientOnly>
            <CommonComment v-for="comment in video.comments" :comment="comment" />
          </ClientOnly>
          <!-- single comment end -->

        </div>
      </div>
      <!-- end comments section -->
    </div>

    <!-- More videos  section -->
    <div class="flex flex-col p-4 " v-if="!videosPending && videos">
      <h2 class="p-4 text-2xl font-bold">More Videos</h2>

      <VideoThumbnail v-for="recommendedVideo in videos.data" class="w-80 scale-90" :with-avatar="true"
        :video="recommendedVideo" />

    </div>
    <!-- end More videos  section -->

  </div>
</template>
