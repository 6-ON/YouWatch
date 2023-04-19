<script lang="ts" setup>
const isOpen = ref(false)
defineProps({
  contentClass: {
    type: String,
    default: 'bg-brown-4 text-brown-1 w-32',
  },
})
const content = ref(null)
onClickOutside(content, () =>  isOpen.value = false)
</script>

<template>
  <div class="relative">
      <div @click="isOpen = !isOpen">
        <slot name="trigger"></slot>
      </div>
      <!-- transition pop with tailwind classes -->

        <Transition 
        enter-active-class="transition ease-out duration-75"
        enter-from-class="transform opacity-0 scale-95"
        enter-to-class="transform opacity-100 scale-100"
        leave-active-class="transition ease-in duration-75"
        leave-from-class="transform opacity-100 scale-100"
        leave-to-class="transform opacity-0 scale-95">
        <div ref="content"  v-if="isOpen"  class="absolute bottom-0 right-0 translate-y-[100%] z-50  p-1 pt-2">
          <div :class="contentClass" class=" rounded-md p-2" @click="isOpen =!isOpen">
            <slot name="content"></slot>

          </div>
        </div>
      </Transition>

  </div>
</template>

<style scoped></style>
