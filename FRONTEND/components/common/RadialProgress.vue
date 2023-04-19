<script lang="ts" setup></script>

<template>
    <div class="circular-progress">
        <span class="relative text-4xl font-semibold text-brown-4">0%</span>
    </div>
</template>

<style scoped>

.circular-progress{
  @apply relative h-64 w-64 rounded-full flex items-center justify-center bg-gradient-to-r from-red-400 to-pink-500;

}
.circular-progress::before{
  @apply absolute h-52 w-52 rounded-full bg-white ;
}

</style>
