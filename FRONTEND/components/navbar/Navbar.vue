<script lang="ts" setup>
const { user,isAuthenticated } = useAuth()
</script>

<template>
  <div class="sticky flex justify-end top-0 left-0 items-center px-4 font-Inter bg-brown-1 text-brown-4 w-full z-50 h-16">
    <div class="mr-auto ">
      <NavbarLogoMenu />
    </div>
    <div class="ml-auto mr-12">
      <CommonSearch class="hidden sm:block" />
    </div>
    <div v-if="isAuthenticated" class="flex gap-8 items-center">
      <NuxtLink to="/upload">
        <IconsLibraryAdd class="w-8" />
      </NuxtLink>
      <UserAvatar :image="user?.image"></UserAvatar>
    </div>
    <NuxtLink to="/auth/login" v-else
      class="flex gap-3 items-center rounded-full border border-brown-3 px-2 py-0.5 hover:bg-brown-2 hover:bg-opacity-30">
      <span>Sign in</span>
      <IconsUser class="w-8"></IconsUser>
    </NuxtLink>
  </div>
</template>

<style scoped></style>
