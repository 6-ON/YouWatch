<script setup>
const route = useRoute()
useHead({
  title: `${route.params.username} - Youwatch`
})
definePageMeta({ layout: 'fixed-sidebar' })

</script>

<template>
  <div class="bg-brown-1 text-brown-4 font font-Montserrat">
    <div class="w-full flex flex-col items-center p-4">
      <UserAvatar
        image="https://images.pexels.com/users/avatars/353287/suzy-hazelwood-390.jpeg?auto=compress&fit=crop&h=128&w=128&dpr=1"
        size="w-32 h-32" />
      <h1 class="font-bold text-2xl mt-4">LALA HADA</h1>
      <h5 class="font-medium mt-1">200k Followers</h5>
    </div>
    <h1 class="font-bold text-3xl ml-10 mt-4">LALA Hada Videos :</h1>
    <hr class="w-auto ml-10 h-[0.1rem] bg-brown-2 bg-opacity-40">
    <div class="grid p-4 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 place-items-center gap-y-5">
      <VideoThumbnail class="w-96" v-for="n in 10" :with-avatar="false"/>
    </div>
  </div>
</template>

<style scoped></style>
