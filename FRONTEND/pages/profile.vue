<script lang="ts" setup>
const { user } = useAuth()
</script>

<template>
  <div>

    <UserAvatar class="mx-auto mt-4 w-fit" image="https://avatars.githubusercontent.com/u/251288?v=4"
      size="w-32 h-32 md:w-48 md:h-48" />
    <div class="w-fit mx-auto font-Montserrat text-center text-brown-4 mt-4">
      <h1 class="font-bold">{{ user?.name }}</h1>
      <h2 class="text-gray-600">@{{ user?.username }}</h2>
    </div>
    <CommonSection title="Contact details" class="font-Inter mx-4">
      <div class="flex flex-wrap gap-1 ">
        <span class="text-brown-3 font-semibold">Email :</span>
        <span class="text-brown-4 ml-2">{{ user?.email }}</span>
        <!-- edit icon from matrial symbols google -->
        <span aria-labelledby="edit" class="text-brown-4 material-symbols-sharp cursor-pointer select-none">
          edit
        </span>



      </div>
    </CommonSection>
  </div>
</template>

<style scoped></style>
