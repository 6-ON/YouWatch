<script setup>

const btn = ref()
const visible = useElementVisibility(btn)
watch(visible,(to,from)=>{
  console.log(to);
})
</script>

<template>
  <div>
    <Transition enter-active-class="animate-pop-in" leave-active-class="animate-pop-out">
      <button v-if="!visible" type="submit" class="fixed bottom-2 left-2 bg-brown-3 hover:bg-brown-4 text-brown-1 rounded-full w-16 h-16">
        <span class="material-symbols-sharp">
          publish
        </span>
      </button>
    </Transition>
    <button ref="btn" type="submit" class="bg-brown-3 hover:bg-brown-4 text-brown-1 py-2 rounded-full px-4 flex gap-2">
      <span class="material-symbols-sharp">
        publish
      </span>
      Publish
    </button>
  </div>
</template>

<style scoped></style>
