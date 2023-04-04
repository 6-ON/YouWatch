<script setup>
const route = useRoute()
useHead({
  title: route.params.slug
})
</script>


<template>
  <div class="flex max-xl:flex-col p-2 sm:p-4 gap-2 max-xl:items-center justify-center text-brown-4 bg-brown-1">
    <div class="flex flex-col flex-grow max-w-4xl lg:px-20 md:px-10 sm:px-5  ">
      <!-- video section -->
      <PlaceholderVideoThumbnail/>
      <!-- <viedo src="" class=" w-full aspect-video bg-brown-2 rounded-2xl ">
      </viedo> -->
      <!-- video  section -->
      <div class="flex flex-col ml-2 sm:ml-5 mt-6">
        <h1 class="text-2xl font-bold ">I Bought a dog</h1>
        <div class="flex max-sm:flex-wrap max-sm:gap-2 mt-1.5 justify-between items-center">
          <p class="text-gray-500 w-fit whitespace-nowrap">576,969 views . Oct 8, 2021</p>
          <div class="flex gap-5">
            <button class="flex items-center gap-4">
              <span class="material-symbols-sharp">
                thumb_up
              </span>
              like
            </button>
            <button class="flex items-center gap-4">
              <span class="material-symbols-sharp">
                thumb_down
              </span>
              Dislike
            </button>
          </div>
        </div>

        <div
          class="border mt-20 border-brown-3 border-opacity-25 relative w-full rounded-lg pt-12 p-4 bg-brown-2 bg-opacity-20 font-Montserrat cursor-pointer">
          <h3 class="absolute top-0 left-0 rounded-tl-lg rounded-br-lg bg-brown-3 px-2 py-1 text-md text-brown-1 ">
            Description</h3>
          <p class="w-full">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum id laborum officia magnam debitis
            expedita
            eligendi animi veritatis nam possimus mollitia tenetur architecto corrupti voluptatum, placeat quasi, aperiam
            ea. Hic!</p>
        </div>
      </div>
      <!-- end video info section -->
      <!-- comments section -->
      <div class="mt-8">
        <h2 class="text-2xl mb-4"><strong>100k</strong> Commentarios</h2>
        <input type="text"
          class="w-96 p-3 border-b-2 placeholder:text-brown-2 border-brown-4 bg-brown-1 focus:outline-none"
          placeholder="Write a comment ...">
        <div class="flex flex-col p-1 sm:p-4 mt-10">
          <!-- single comment -->
          <div class="flex gap-4">
            <UserAvatar image="" />
            <div class="flex flex-col">
              <div class="flex gap-1 items-center">
                <h1 class="font-bold">Alan Turing</h1>
                <span class="text-xs text-gray-500">1day ago</span>
              </div>
              <p class="max-w-md text-sm">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur neque reprehenderit, obcaecati hic voluptatum ad nobis architecto.</p>
            </div>
          </div>
          <!-- single comment end -->

        </div>
      </div>
      <!-- end comments section -->
    </div>

    <!-- More videos  section -->
    <div class="flex flex-col p-4 ">
      <h2 class="p-4 text-2xl font-bold">More Videos</h2>
      <VideoThumbnail v-for="n in 10" class="w-80 scale-90" :with-avatar="true" />

    </div>
    <!-- end More videos  section -->

  </div>
</template>
