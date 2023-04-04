<script setup>
const emits = defineEmits(['selected'])
const props = defineProps({
  targetId: {
    required: true,
    type: String
  }
})
</script>

<template>
  <div class="bg-brown-2 bg-opacity-20 select-none font-Montserrat font-medium flex justify-center items-center aspect-video mx-auto gap-3 rounded-2xl"
    @drop.prevent="(e) => $emit('selected', e.dataTransfer.files[0])" @dragenter.prevent @dragover.prevent>
    <span class="material-symbols-sharp">
      upload
    </span>
    <span>Drop your file here or </span>
    <label :for="targetId" class="bg-brown-1 p-2 rounded-full cursor-pointer  animate-pulse">
      Select a File
    </label>
  </div>
</template>

<style scoped></style>
